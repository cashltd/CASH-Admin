<?php /* Smarty version 2.6.14, created on 2012-02-14 21:01:24
         compiled from loginform.tpl */ ?>
<form id="loginForm" method="POST" action="<?php echo $this->_tpl_vars['HomeUrl']; ?>
login/doLogin/">
	<div id="loginpage">
		<div class="loginmiddle">
			<div class="loginitem"><div class="b">Username</div><input type="text" name="username"></div>
			
			<div class="loginitem"><div class="b">Password</div><input type="password" name="password"></div>
			<?php echo $this->_tpl_vars['error']; ?>

			<div class="loginitem2"><input type="button" class="login" value="Login" onClick="loginSubmit()"></div>
		</div>
	</div>
</form>