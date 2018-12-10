<?php
session_start();
include_once("db.php");
if(isset($_SESSION['user']))
{
	if(isset($_GET['book'])){
		$user = $_SESSION['user'];
		$book = $_GET['book'];
		$count = $_GET['count'];
		try{
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) 
			{
	    		die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT book1,book2,book3 FROM users where username='$user'";
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$book1 = $row['book1'];
					$book2 = $row['book2'];
					$book3 = $row['book3'];
				}
			}
			if($book1 == ''){
				$sql1 = "UPDATE users set book1 = '$book' where username = '$user'";
				$result1 = $conn->query($sql1);
				if($result1){
					$sql2 = "UPDATE books set count = '$count' where name='$book'";
					$result2 = $conn->query($sql2);
					if($result2){
						echo "success";
					}
				}
			}
			else if($book2 == ''){
				$sql1 = "UPDATE users set book2 = '$book' where username = '$user'";
				$result1 = $conn->query($sql1);
				if($result1){
					$sql2 = "UPDATE books set count = '$count' where name='$book'";
					$result2 = $conn->query($sql2);
					if($result2){
						echo "success";
					}
				}
			}
			else if($book3 == ''){
				$sql1 = "UPDATE users set book3 = '$book' where username = '$user'";
				$result1 = $conn->query($sql1);
				if($result1){
					$sql2 = "UPDATE books set count = '$count' where name='$book'";
					$result2 = $conn->query($sql2);
					if($result2){
						echo "success";
					}
				}
			}
		}
		catch(Exception $e){
			echo $e;
		}
	}
}
?>