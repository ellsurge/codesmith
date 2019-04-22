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
$title = "optus User Activation Page";
include "../../public/includes/header.php";
?>
	<nav class="navbar">
		<a href="?" class="brand">
			ColorCodes
		</a>
	</nav>

		<form method="post" action="activate.php">
			<div class="announcement">


				<p>Your account is successfully created 
				but its not activated yet. We have sent 
				the activation code in your email address
				type the code and click "Activate" button to 
				continue.</p>
			</div>
			<h1 class="form-title">Activate Account</h1>
			<div class="input-group">
				<label>Enter Activation Code</label>
				<input type="number" name="code" class="validate">
				<span class="indicator"></span>
				<small class="msg"></small>
			</div>
			<p class="err-msg"></p>
			<button type="submit" class="block">ACTIVATE</button>
			<br><br>
		</form>
		
<?php
include "../../public/includes/footer.php";
?>