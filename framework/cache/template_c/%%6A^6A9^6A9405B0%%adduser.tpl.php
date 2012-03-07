<?php /* Smarty version 2.6.14, created on 2012-03-05 13:18:20
         compiled from users/adduser.tpl */ ?>
<form id="newuser" method="POST" action="<?php echo $this->_tpl_vars['HomeUrl']; ?>
ajax/addNewUser/">
	<div class="addusermiddle">
		<div class="adduseritem" id="fname"><div class="b">First Name</div><input type="text" name="fnamex" onkeypress="$('lname').show()" id="fnames"></div>
		<div class="adduseritem" id="lname" style="display:none;"><div class="b">Last Name</div><input type="text" name="lnamex" onkeypress="$('usernamet').show()" onBlur="makeUsername()" id="snames"></div>
		<div class="adduseritem" id="usernamet" style="display:none;"><div class="b">Username</div><input type="text" name="username" id="usernamebox" onClick="makeUsername()">	
		<div id="usernameMessage" style="display:none;">Username In Use</div><div class="loginitem2" id="checkButton"><input type="button" value="Check Username" class="loginz" onClick="checkUsername()"></div></div>
		
		
	
		
		
		<div class="adduseritem" id="password" style="display:none;"><div class="b">Password</div><input type="password" name="password" onBlur="usernameNotUsed()"></div>
		
		<div class="adduseritem" id="rank" style="display:none;"><div class="b">Rank</div>
		
		<SELECT name="rank">
			<OPTION VALUE="1">User</OPTION>
			<OPTION VALUE="2">Another User</OPTION>
			<OPTION VALUE="3">Admin</OPTION>
		</SELECT>
			
		
		</div>
		<div class="loginitem2" id="submiter" style="display:none;"><input type="button" class="login" value="Add User" onClick="newUserSubmit()"></div>
	</div>
</form>