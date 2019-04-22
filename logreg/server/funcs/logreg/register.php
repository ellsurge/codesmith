<?php
function kill(){
	exit();
	die();
}

require "../../helpers/dbh.php";
if(isset($_COOKIE['clrsuid']) && isset($_COOKIE['clrspwd'])){
	$cuid =  $_COOKIE['clrsuid'];
	$cpwd =  $_COOKIE['clrspwd'];
	require "../../helpers/is_active.php";
	if(is_active($conn)){
		echo "authed";
		kill();
	}
}

if(!isset($_POST['uid']) || !isset($_POST['email']) || !isset($_POST['pwd']) || !isset($_POST['cpwd'])){
	echo "Access Denied";
	kill();
}


$uid = $_POST['uid'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$cpwd= $_POST['cpwd'];
if(empty($uid) || empty($email) || empty($pwd) || empty($cpwd)){
	echo "Fill in all fields";
	kill();
}else if(preg_match("/[^A-Za-z0-9 _]/", $uid) || preg_match("/[^A-Za-z0-9@._]/", $email)){
	echo "You can only use numbers and letters and _";
	kill();
}else if(strlen(trim($uid)) < 3 || strlen(trim($uid)) > 20){
	echo "Your username should contain 3 - 20 characters";
	kill();
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo "Entered email is not valid";
	kill();
}else if(strlen(trim($pwd)) < 8){
	echo "Your password should contain at least 8 characters";
	kill();
}else if(strlen(trim($pwd)) > 30){
	echo "Your password is too long";
	kill();
}else if($pwd !== $cpwd){
	echo "Your passwords does not matches";
	kill();
}else{
    $sql = "SELECT * FROM users WHERE uid = '$uid'";
	$q = $conn->query($sql);
	if($q->rowCount() > 0){
		echo "This username is already taken";
	}else{
		$newpwd = password_hash($pwd, PASSWORD_BCRYPT);
		$sql = "INSERT INTO `users` VALUES (NULL, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$code = rand(10000000, 99999999);
		$mesage= "Your activation code is: " . $code . "<br> click the link below to activate your account <br> <a href='' style='border: 1px solid green; background-color:lemongreen;padding:5px;color:whitesmoke;'>click me!! to activate your account</a>";
		require "../../helpers/mail.php";
		if( @send_mail($email, "Account activation",$mesage)){
			echo "could not send you an email for some reason,  pls click the link below to activate your account";			
		}
		if($stmt->execute([$uid, $email,  $newpwd, '0', $code])){
			setcookie('clrsuid', $uid, strtotime('+30 day'), '/', '', '', true);
			setcookie('clrspwd', $pwd, strtotime('+30 day'), '/', '', '', true);
			echo "authed";
		}else{
			echo "could not send you an email for some reason,  pls click the link below to activate your account";
			}
		
	}
}