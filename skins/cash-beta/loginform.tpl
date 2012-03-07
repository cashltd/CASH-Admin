<form id="loginForm" method="POST" action="{$HomeUrl}login/doLogin/">
	<div id="loginpage">
		<div class="loginmiddle">
			<div class="loginitem"><div class="b">Username</div><input type="text" name="username"></div>
			
			<div class="loginitem"><div class="b">Password</div><input type="password" name="password"></div>
			{$error}
			<div class="loginitem2"><input type="button" class="login" value="Login" onClick="loginSubmit()"></div>
		</div>
	</div>
</form>