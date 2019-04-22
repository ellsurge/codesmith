<?php 
require "../../server/helpers/dbh.php";
require "../../server/helpers/is_active.php";
if(is_active($conn)){
	header("Location: ../../index.php");
	exit();
	die();
}
$styles = ["style.css"];
$scripts = ["../../public/assets/js/jquery.js", "main.js"];
$themeColor = "#0045E0";
$title = "ColorCodes Login Registration Page";
include "../../public/includes/header.php";
?>
	<nav class="navbar">
		<a href="?" class="brand">
			ColorCodes
		</a>
		<ul>
			<li class="logToggle"><a href="#">SignIn</a></li>
			<li class="regToggle"><a href="#">SignUp</a></li>
		</ul>
	</nav>
	

		<form method="post" action="login.php" class="loginForm">
			<h1 class="form-title">Login Below</h1>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="luid" class="validate" validate="char">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="lpwd" class="validate" validate="password">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<p class="err-msg"></p>
			<button type="submit" class="block">Login</button>
			<br><br>
			<small class="forgotPwd">forgot password?</small>
		</form>
		<form method="post" action="../../server/funcs/logreg/register.php" class="registerForm">
			<h1 class="form-title">Create A New Account</h1>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="uid" class="validate" validate="char">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>Email Address</label>
				<input type="text" name="email" class="validate" validate="email">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="pwd" class="validate" validate="password">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>Confirm password</label>
				<input type="password" name="cpwd" class="validate" validate="password">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<p class="err-msg"></p>
			<button type="submit" class="block">Register</button>
		</form>
		<form method="post" action="recover.php" class="recoverForm">
			<h1 class="form-title">Change Password</h1>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="ruid" class="validate" validate="char">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>Email Address</label>
				<input type="text" name="remail" class="validate" validate="email">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>New password</label>
				<input type="password" name="rpwd" class="validate" validate="password">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<div class="input-group">
				<label>Confirm new password</label>
				<input type="password" name="rcpwd" class="validate" validate="password">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<p class="err-msg"></p>
			<button type="submit" class="block">Change Password</button>
		</form>
		
<?php
include "../../public/includes/footer.php";
?>