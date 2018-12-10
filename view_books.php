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
	<link rel="stylesheet" href="table.css">
	<link rel="stylesheet" href="login.css">
</head>
<body>
<center>
<br/><br/>
<h2>Available Books</h2>
<br/><br/>
<table>
	<tr> 
		<th> ID </th>
		<th> Name </th>
		<th> Author </th>
		<th> Journal </th>
		<th> Publication </th>
		<th> Year </th>
		<th> Edition </th>
		<th> Count </th>
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
			$sql = "SELECT * FROM books";
			echo $string;
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['author'].'</td><td>'.$row['journal'].'</td><td>'.$row['publication'].'</td><td>'.$row['year'].'</td><td>'.$row['edition'].'</td><td>'.$row['count'].'</td></tr>';
				}
			}
			echo '</table>';
			echo "<br/><br/><a class='button' href='index.php'>Back</a></center>";
		}
		catch(Exception $e){
			echo "Error : ".$e;
		}
	}
}

?>