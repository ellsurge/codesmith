<?php
if(!isset($_COOKIE['clrsuid']) && !isset($_COOKIE['clrspwd'])){
	header("Location: ../../index.php");
}else{
	$uid = $_COOKIE['clrsuid'];
	setcookie('clrsuid', $uid, strtotime('-30 day'), '/', '', '', true);
	setcookie('clrspwd', $uid, strtotime('-30 day'), '/', '', '', true);
	unset($_COOKIE['clrsuid']);
	unset($_COOKIE['clrspwd']);
	header("Location: ../../index.php");
}