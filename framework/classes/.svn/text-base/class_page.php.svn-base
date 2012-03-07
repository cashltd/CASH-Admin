<?php

	class page extends Smarty {

		private $temps;

		public function __construct() {
			$this->template_dir = realpath( SKINDIR . DEFAULTSKIN );
			$this->compile_dir = realpath( CACHEDIR . '/template_c');
			$this->cache_dir = realpath( CACHEDIR);
			$this->config_dir = realpath( CACHEDIR . '/configs');
		}

		public function addVar($title, $content) {
			$this->assign($title, $content);
		}

		public function addPage($page, $variables = null) {
			if (is_array($variables)) {
				foreach ($variables AS $key => $str) {
					$this->addVar($key, $str);
				}
			}
			$this->temps[] = $this->fetch($page);
		}

		public function addHtml($code) {
			$this->temps[] = $code;
		}

		public function render($type = PAGE_TYPE, $nocache = TRUE) {
			$fullPage = "";
			foreach ($this->temps AS $tmp) {
				$fullPage .= $tmp;
			}
			headers::setHeader($type, $nocache);
			print $fullPage;
		}

		public function fullReplace($from, $to) {
			$this->temps = str_replace($from, $to, $this->temps);
		}



		public function redirect($url) {
			headers::setHeader("redirect", FALSE, $url);
		}

	}

?>