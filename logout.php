<?php
session_start();
if(isset($_SESSION['user'])){
	session_destroy();
	echo "Logged out successfully <br/>";
	echo "<a href='login.php'>Login</a>";
}
else{
	echo "No user has logged in <br/>";
	echo "<a href='login.php'>Login</a>";
}

?>