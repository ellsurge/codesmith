<html>
<head> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title><?php echo $title; ?></title> 
  <link href="" rel="stylesheet">
  <?php 
  foreach($styles as $style){
 	echo '<link rel="stylesheet" href="'.$style.'">';
  }
  ?>
  <link href="style.css" rel="stylesheet">
  <meta name="theme-color" content="<?php echo $themeColor; ?>">
</head> 
<body>
	
