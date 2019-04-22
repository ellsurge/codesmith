<?php
require "server/helpers/dbh.php";
require "server/helpers/is_active.php";
$user_is_active = false;
if(!is_active($conn)){
	$user_is_active = false;
}else{
	$user_is_active = true;
}
$styles = ["public/assets/css/font-awesome.css", "pages/index/style.css"];
$scripts = ["public/assets/js/jquery.js", "pages/index/main.js"];
$themeColor = "#0045E0";
$title = "optus";
include 'public/includes/header.php';
?>
	<?php
		if($user_is_active){
			echo '<h1>You are logged in</h1><a href="server/funcs/logout.php">Logout</a>';
		}else{
			echo '<a href="pages/logreg/index.php">Login</a>';
		}
	?>
<?php
	include 'public/includes/footer.php';
?>