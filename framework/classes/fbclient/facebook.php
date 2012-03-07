<?php
//
// +---------------------------------------------------------------------------+
// | Facebook Platform PHP5 client                                 |
// +---------------------------------------------------------------------------+
// | Copyright (c) 2007 Facebook, Inc.                                         |
// | All rights reserved.                                                      |
// |                                                                           |
// | Redistribution and use in source and binary forms, with or without        |
// | modification, are permitted provided that the following conditions        |
// | are met:                                                                  |
// |                                                                           |
// | 1. Redistributions of source code must retain the above copyright         |
// |    notice, this list of conditions and the following disclaimer.          |
// | 2. Redistributions in binary form must reproduce the above copyright      |
// |    notice, this list of conditions and the following disclaimer in the    |
// |    documentation and/or other materials provided with the distribution.   |
// |                                                                           |
// | THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR      |
// | IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES |
// | OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.   |
// | IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,          |
// | INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT  |
// | NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY     |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT       |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF  |
// | THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.         |
// +---------------------------------------------------------------------------+
// | For help with this library, contact developers-help@facebook.com          |
// +---------------------------------------------------------------------------+
//

include_once 'facebookapi_php5_restlib.php';

class Facebook {
  public $api_client;

  public $api_key;
  public $secret;

  public $fb_params;
  public $user;

  public function __construct($api_key, $secret) {
    $this->api_key    = $api_key;
    $this->secret     = $secret;

    $this->api_client = new FacebookRestClient($api_key, $secret);

    $this->validate_fb_params();
    if (isset($this->fb_params['friends'])) {
      $this->api_client->friends_list = explode(',', $this->fb_params['friends']);
    }
    if (isset($this->fb_params['added'])) {
      $this->api_client->added = $this->fb_params['added'];
    }
  }

  public function validate_fb_params() {
    $this->fb_params = $this->get_valid_fb_params($_POST, 48*3600, 'fb_sig');
    if (!$this->fb_params) {
      $this->fb_params = $this->get_valid_fb_params($_GET, 48*3600, 'fb_sig');
    }
    if ($this->fb_params) {
      // If we got any fb_params passed in at all, then either:
      //  - they included an fb_user / fb_session_key, which we should assume to be correct
      //  - they didn't include an fb_user / fb_session_key, which means the user doesn't have a
      //    valid session and if we want to get one we'll need to use require_login().  (Calling
      //    set_user with null values for user/session_key will work properly.)
      // Note that we should *not* use our cookies in this scenario, since they may be referring to
      // the wrong user.
      $user        = isset($this->fb_params['user'])        ? $this->fb_params['user'] : null;
      $session_key = isset($this->fb_params['session_key']) ? $this->fb_params['session_key'] : null;
      $expires     = isset($this->fb_params['expires'])     ? $this->fb_params['expires'] : null;
      $this->set_user($user, $session_key, $expires);
    } else if (!empty($_COOKIE) && $cookies = $this->get_valid_fb_params($_COOKIE, null, $this->api_key)) {
      // use $api_key . '_' as a prefix for the cookies in case there are
      // multiple facebook clients on the same domain.
      $this->set_user($cookies['user'], $cookies['session_key']);
    } else if (isset($_GET['auth_token']) && $session = $this->do_get_session($_GET['auth_token'])) {
      $this->set_user($session['uid'], $session['session_key'], $session['expires']);
    }

    return !empty($this->fb_params);
  }

  public function do_get_session($auth_token) {
    try {
      return $this->api_client->auth_getSession($auth_token);
    } catch (FacebookRestClientException $e) {
      // API_EC_PARAM means we don't have a logged in user, otherwise who
      // knows what it means, so just throw it.
      if ($e->getCode() != FacebookAPIErrorCodes::API_EC_PARAM) {
        throw $e;
      }
    }
  }

  public function redirect($url) {
    if ($this->in_fb_canvas()) {
      echo '<fb:redirect url="' . $url . '"/>';
    } else if (preg_match('/^https?:\/\/([^\/]*\.)?facebook\.com(:\d+)?/i', $url)) {
      // make sure facebook.com url's load in the full frame so that we don't
      // get a frame within a frame.
      echo "<script type=\"text/javascript\">\ntop.location.href = \"$url\";\n</script>";
    } else {
      header('Location: ' . $url);
    }
    exit;
  }

  public function in_frame() {
    return isset($this->fb_params['in_canvas']) || isset($this->fb_params['in_iframe']);
  }
  public function in_fb_canvas() {
    return isset($this->fb_params['in_canvas']);
  }

  public function get_loggedin_user() {
    return $this->user;
  }

  public static function current_url() {
    return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  public function require_login() {
    if ($user = $this->get_loggedin_user()) {
      return $user;
    }
    $this->redirect($this->get_login_url(self::current_url(), $this->in_frame()));
  }

  public function require_install() {
    // this was renamed, keeping for compatibility's sake
    return $this->require_add();
  }

  public function require_add() {
    if ($user = $this->get_loggedin_user()) {
      if ($this->fb_params['added']) {
        return $user;
      }
    }
    $this->redirect($this->get_add_url(self::current_url()));
  }

  public function require_frame() {
    if (!$this->in_frame()) {
      $this->redirect($this->get_login_url(self::current_url(), true));
    }
  }

  public static function get_facebook_url($subdomain='www') {
    return 'http://' . $subdomain . '.facebook.com';
  }

  public function get_install_url($next=null) {
    // this was renamed, keeping for compatibility's sake
    return $this->get_add_url($next);
  }

  public function get_add_url($next=null) {
    return self::get_facebook_url().'/add.php?api_key='.$this->api_key .
      ($next ? '&next=' . urlencode($next) : '');
  }

  public function get_login_url($next, $canvas) {
    return self::get_facebook_url().'/login.php?v=1.0&api_key=' . $this->api_key .
      ($next ? '&next=' . urlencode($next)  : '') .
      ($canvas ? '&canvas' : '');
  }

  public static function generate_sig($params_array, $secret) {
    $str = '';

    ksort($params_array);
    // Note: make sure that the signature parameter is not already included in
    //       $params_array.
    foreach ($params_array as $k=>$v) {
      $str .= "$k=$v";
    }
    $str .= $secret;

    return md5($str);
  }

  public function set_user($user, $session_key, $expires=null) {
    if (!$this->in_fb_canvas() && (!isset($_COOKIE[$this->api_key . '_user'])
                                   || $_COOKIE[$this->api_key . '_user'] != $user)) {
      $cookies = array();
      $cookies['user'] = $user;
      $cookies['session_key'] = $session_key;
      $sig = self::generate_sig($cookies, $this->secret);
      foreach ($cookies as $name => $val) {
        setcookie($this->api_key . '_' . $name, $val, (int)$expires);
        $_COOKIE[$this->api_key . '_' . $name] = $val;
      }
      setcookie($this->api_key, $sig, (int)$expires);
      $_COOKIE[$this->api_key] = $sig;
    }
    $this->user = $user;
    $this->api_client->session_key = $session_key;
  }

  /**
   * Tries to undo the badness of magic quotes as best we can
   * @param     string   $val   Should come directly from $_GET, $_POST, etc.
   * @return    string   val without added slashes
   */
  public static function no_magic_quotes($val) {
    if (get_magic_quotes_gpc()) {
      return stripslashes($val);
    } else {
      return $val;
    }
  }

  public function get_valid_fb_params($params, $timeout=null, $namespace='fb_sig') {
    $prefix = $namespace . '_';
    $prefix_len = strlen($prefix);
    $fb_params = array();
    foreach ($params as $name => $val) {
      if (strpos($name, $prefix) === 0) {
        $fb_params[substr($name, $prefix_len)] = self::no_magic_quotes($val);
      }
    }
    if ($timeout && (!isset($fb_params['time']) || time() - $fb_params['time'] > $timeout)) {
      return array();
    }
    if (!isset($params[$namespace]) || !$this->verify_signature($fb_params, $params[$namespace])) {
      return array();
    }
    return $fb_params;
  }

  public function verify_signature($fb_params, $expected_sig) {
    return self::generate_sig($fb_params, $this->secret) == $expected_sig;
  }
  
  // For internationalizing text
  public function fbt($text /* , ... */) {
    $orig_args = func_get_args();

    if (count($orig_args) == 1) {
      // No values to substitute.
      $name_map = null;
      $description = null;
    } else {
      // Start off with the second argument to fbt()
      $arg_index = 1;
      $name_map = array();

      $exploded = explode('{', $text);
      if (strpos($exploded[0], '}') !== false) {
        error_log("Closing brace without opening brace; malformed token?");
      }

      for ($t = 1; $t < count($exploded); $t++) {
        // If this token is empty, it's a literal "{"; skip it and the next
        // element, which won't be a token either.
        if ($exploded[$t] === "") {
          $t++;
        } else {
          $tokens = explode('}', $exploded[$t], 2);
          $token = $tokens[0];    // stupid PHP won't let us do explode()[0]

          // Make sure there aren't unbalanced plaintext right curly braces
          if (count($tokens) > 1) {
            $closing = strpos($tokens[1], '}');
            if ($closing !== false) {
              $opening = strpos($tokens[1], '{{');
              if ($opening === false || $opening > $closing) {
                error_log("Closing brace without opening brace; malformed token?");
              }
            }
          }

          // If we don't know this token's value yet...
          while (!isset($name_map[$token])) {
            // Fetch it from the argument list.
            if ($arg_index < count($orig_args)) {
              $arg = $orig_args[$arg_index++];
              if (is_array($arg)) {
                // Add this array's elements to our name map.
                $name_map = array_merge($name_map, $arg);
              } else if (is_scalar($arg)) {
                // This is a value for the token we're looking for.
                $name_map[$token] = $arg;
              } else {
                error_log("Argument " . $arg_index . " isn't array or scalar");
                $name_map[$token] = "";

              }
            } else {
              error_log("Not enough arguments to fill in tokens");
              break;
            }
          }
        }
      }

      // Is there a description?
      if ($arg_index < count($orig_args)) {
        $description = $orig_args[$arg_index++];
        if (!is_scalar($description)) {
          error_log("Non-scalar description");
          $description = "";
        }
      } else {
        $description = null;
      }

      if ($arg_index < count($orig_args)) {
        error_log("Extra arguments to fbt(); may be substituting wrong values");
      }
    }

    $result = '<fb:intl';
    if ($description != null) {
      $result .= ' desc="' . htmlspecialchars($description) . '"';
    }

    $result .=  '>' . $text;

    if ($name_map != null) {
      foreach ($name_map as $k => $v) {
        $result .= '<fb:intlvar name="' . $k . '">' . $v . '</fb:intlvar>';
      }
    }

    $result .=  '</fb:intl>';
    return $result;
  }
  
}

?>
