<?php
function is_active($conn){
	if(!isset($_COOKIE['clrsuid']) || !isset($_COOKIE['clrspwd'])){
		return false;
	}else if(preg_match("/[^A-Za-z0-9 ]/", $_COOKIE['clrsuid'])){
		return false;
	}else{
		$uid = $_COOKIE['clrsuid'];
		$pwd = $_COOKIE['clrspwd'];
		$sql = "SELECT * FROM users WHERE uid = '$uid'";
		$q = $conn->query($sql);
		if($q->rowCount() < 1){
			return false;
		}else{
			$data = $q->fetch();
			if($data['activated'] == 1 && password_verify($pwd, $data['pwd'])){
				return true;
			}else{
				return false;
			}
		}
	}
}