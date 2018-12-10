<?php
session_start();
include_once("db.php");
if(isset($_SESSION['user']))
{
	if(isset($_GET['book'])){
		$user = $_SESSION['user'];
		$book = $_GET['book'];
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
			if($book1 == $book){
				echo "e";
			}
			if($book1 == $book){
				$sql1 = "UPDATE users set book1 = '' where username = '$user'";
				$result = $conn->query($sql1);
				if($result){
					$sql2 = "UPDATE books set count = count+1 where name = '$book'";
					$result1 = $conn->query($sql2);
					if($result1){
						echo "success";
					}
				}
			}
			else if($book2 == $book){
				$sql1 = "UPDATE users set book2 = '' where username = '$user'";
				$result = $conn->query($sql1);
				if($result){
					$sql2 = "UPDATE books set count = count+1 where name = '$book'";
					$result1 = $conn->query($sql2);
					if($result1){
						echo "success";
					}
				}
			}
			else if($book3 == $book){
				$sql1 = "UPDATE users set book3 = '' where username = '$user'";
				$result = $conn->query($sql1);
				if($result){
					$sql2 = "UPDATE books set count = count+1 where name = '$book'";
					$result1 = $conn->query($sql2);
					if($result1){
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