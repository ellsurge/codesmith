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

if(!isset($_POST['luid']) || !isset($_POST['lpwd'])){
	echo "Access Denied";
	kill();
}
$uid = $_POST['luid'];
$pwd = $_POST['lpwd'];
if(empty($uid) || empty($pwd)){
	 echo "Fill in all fields";
}else if(preg_match("/[^A-Za-z0-9 _]/", $uid)){
	echo "You can only use numbers and letters and _";
	kill();
}else if(strlen($uid) < 3 || strlen($uid) > 20){
	echo "Your username should contain 3 - 20 characters";
	kill();
}else if(strlen($pwd) < 8){
	echo "Your password should contain at least 8 characters";
	kill();
}else if(strlen($pwd) > 30){
	echo "Your password is too long";
	kill();
}else{
	$sql=" SELECT * FROM users WHERE uid='$uid' and activated = '1'";
    $q = $conn->query($sql);
     if($q->rowCount() < 1){
     	echo "Invalid Username ";
     	kill();
     }else{
    		$data = $q->fetch();
    		if(!password_verify($pwd, $data['pwd'])){
    			echo "Incorrect password";
    			kill();
    		}else{
    			setcookie('clrsuid', $uid, strtotime('+30 day'), '/', '', '', true);
				setcookie('clrspwd', $pwd, strtotime('+30 day'), '/', '', '', true);
				echo "authed";
  		  }
     }
}