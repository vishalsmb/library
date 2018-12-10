<?php
include("db.php");
if(isset($_POST['user']))
{
	$name = $_POST['user'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];
	$hpass = sha1($pass);
	$admin = 0;
	try {
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) 
		{
	    	die("Connection failed: " . $conn->connect_error);
		} 
		$stmt = $conn->prepare("INSERT INTO temp_users (username,password, email,admin) VALUES (?, ?, ?,?)");
		$stmt->bind_param("sssi", $name, $hpass, $email,$admin );
		if($stmt->execute()) 
		{
			echo "Successfully registered";
		}
		else {
			echo "Error in saving details .. ";
		}
		$stmt->close();
		$conn->close();
	}
	catch(Exception $e) 
	{
		echo "Error : " . $e;
	}

}


?>