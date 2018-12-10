<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";
if(isset($_SESSION['user']))
{
	if($_SESSION['admin'] == 1) {
		if($_GET['username']){
			$username = $_GET['username'];
			$conn = new mysqli($servername, $username, $password, $dbname);
			$sql = "SELECT * FROM temp_users WHERE username='$username'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
			$stmt = $conn->prepare("INSERT INTO users(username,password,email,admin) VALUES (?, ?, ?,?)");
			$stmt->bind_param("sssi",$row['username'],$row['password'],$row['email'],$row['admin']);
			if($stmt->execute()){
				$sql1 = "DELETE FROM temp_users WHERE username = '$username'";
				$result = $conn->query($sql1);
				if($result){
					echo "added";
				}
			}
		}
	}	
}


?>