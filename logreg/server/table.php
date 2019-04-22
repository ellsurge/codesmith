<?php
require 'helpers/dbh.php';
$sqlA = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `actcode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
if($conn->query($sqlA)){
  echo "sqlA done<br>";
  header("location: ../index.php");
}