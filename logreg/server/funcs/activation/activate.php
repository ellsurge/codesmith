<?php
function kill(){
	exit();
	die();
}
if(!isset($_COOKIE['clrsuid']) || !isset($_COOKIE['clrspwd']) || !isset($_POST['code'])){
	echo "Access Denied";
	kill();
}else{
	if(preg_match("/[^A-Za-z0-9 ]/", $_COOKIE['clrsuid'])){
		echo 'Access denied';
		kill();
	}
	require "../../helpers/dbh.php";
	$uid = $_COOKIE['clrsuid'];
	$pwd = $_COOKIE['clrspwd'];
	$code = $_POST['code'];
	$sql = "SELECT * FROM users WHERE uid = '$uid'";
	$q = $conn->query($sql);
	if($q->rowCount() < 1){
		echo "Access Denied";
		kill();
	}else{
		$data = $q->fetch();
		if($data['activated'] == 1){
			echo 'authed';
			kill();
		}
        if(!password_verify($pwd, $data['pwd'])){
     	   echo "Access Denied";
			kill();
        }else{
          if(empty($code)){
			 echo "Enter activation code";
    	 	kill();
		  }else if(!is_numeric($code)){
   		  echo "Invalid Characters";
    	 	kill();
		  }else if(strlen(trim($code)) !== 8){
        	 echo "activation code have to be exactly 8 characters";
        	 kill();
       	}else if($code != $data['actcode']){
       		echo "Wrong activation code";
       		kill();
       	}else{
       		$sql = "UPDATE users SET activated = '1' where uid = '$uid'";
			   if($conn->query($sql)){
				  echo "authed";
			   }else{
	     	     echo "Something went wrong"; 
      		 }
       	}
        }
	}
} 

