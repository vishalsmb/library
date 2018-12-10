<?php
session_start();
$string = '
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
<center>
<br/><br/>
<h2>Users</h2>
<br/><br/>
<table>
	<tr> 
		<th> Username </th>
		<th> Email </th>
		<th> Book1 </th>
		<th> Book2 </th>
		<th> Book3 </th>
	</tr>';
include_once("db.php");
if(isset($_SESSION['user'])){
	if($_SESSION['admin']==1){
		try{
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) 
			{
	    		die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT * FROM users";
			echo $string;
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					if($row['admin'] != 1) {
						echo '<tr><td>'.$row['username'].'</td><td>'.$row['email'].'</td><td>'.$row['book1'].'</td><td>'.$row['book2'].'</td><td>'.$row['book3'].'</td></tr>';
					}
				}
			}
			echo "</table>";
			echo "<br/><br/><a class='button' href='index.php'>Back</a></center>";
		}
		catch(Exception $e){
			echo "Error : ".$e;
		}

	}
}

?>