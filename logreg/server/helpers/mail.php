<?php
function send_mail($r, $s, $m){
	$to = $r;
	$subject = $s;
	$message = $m;
	$message = wordwrap($message, 70, "\r\n");
	$headers = "From: optus@gmail.com";

	mail($to,$subject,$message ,$headers);
}