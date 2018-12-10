<!doctype html>
<html lang="en">
<head>
	<title>Library Management System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:500" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="login.css">
	<link rel="stylesheet" href="table.css">
</head>
<body>
<?php
session_start();
include("db.php");
if(isset($_POST['user']))
{
	$name = $_POST['user'];
	$pass = $_POST['pass'];
	$hpass = sha1($pass);
	try {
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) 
		{
	    	die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM users";
		if($result = $conn->query($sql)) 
		{
			if($result->num_rows>0)
			{
				while($row = $result->fetch_assoc()) 
				{
					if($name == $row['username']) 
					{
						if($hpass == $row['password'])
						{
							if($row['admin']==1){
								$_SESSION["user"] = $name;
								$_SESSION["admin"] = 1;
								echo " Hello , Admin <br/><br/>";
								echo "Click <a href='index.php'>here</a> to go to index page</body>";
							}
							else {
								$_SESSION["user"] = $name;
								$_SESSION["admin"] = 0;
								echo "Hello , ".$name."<br/><br/>";
								echo "Click <a href='index.php'>here</a> to go to index page</body>";
							}
						}
					}
				}
			}
		}
		else
		{
			echo "Error in saving details .. ";
		}
		$conn->close();
	}
	catch(Exception $e) 
	{
		echo "Error : " . $e;
	}
	
}
else if(isset($_SESSION['user'])){
	echo "Some user logged in already ..";
	echo "<br/> <a href='logout.php'>Logout</a> and try again !!!";
}
else {
	echo '<div class="login">
  <div class="login-header">
    <h1>Login</h1>
  </div>
  <div class="login-form">
    <form method="POST" action="login.php">
    <h3>Username:</h3>
    <input type="text" placeholder="Username" name="user"/><br>
    <h3>Password:</h3>
    <input type="password" placeholder="Password" name="pass"/>
    <br>
    <input type="Submit" value="Login" class="login-button"/>
  </form>
    <br>
    <a class="sign-up" href="register.html">Sign Up!</a>
    <br>
  </div>
</div>

</body></html>';
}
	
?>