<?php
session_start();
include_once("db.php");
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
	<script>
		function return_book(row,book){
			console.log(book);
			var bookname = book.innerHTML;
			console.log(bookname);
			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
  			if (this.readyState == 2){
  				document.getElementById("status").innerHTML = "working on";
  			}
	   		if (this.readyState == 4 && this.status == 200) {
	     		if(this.responseText == "success"){
	     			console.log("here");
	     			document.getElementById("status").innerHTML = "";
	     			row.innerHTML = "";
	     		}
	   		}
   		};
    	xhttp.open("GET", "confirm_return.php?book="+bookname, true);
    	xhttp.send();

		}
	</script>
		<center>
		<br/><br/>
		<h2> Your books </h2> <br/><br/>
		<p id="status"></p>
		<table>
			<tr> 
				<th> ID </th>
				<th> Name </th>
				<th> Author </th>
				<th> Journal </th>
				<th> Publication </th>
				<th> Year </th>
				<th> Edition </th>
				<th> Action </th>
			</tr>
';

if(isset($_SESSION["user"]))
{
	$user = $_SESSION["user"];
	if($_SESSION['admin'] == 0){
		echo $string;
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
			$sql1 = "select * from books where name = '$book1' OR name = '$book2' OR name = '$book3'";
			$result = $conn->query($sql1);
			$count = 0;
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo '<tr id="row'.$count.'"><td>'.$row['id'].'</td><td id="name'.$count.'">'.$row['name'].'</td><td>'.$row['author'].'</td><td>'.$row['journal'].'</td><td>'.$row['publication'].'</td><td>'.$row['year'].'</td><td>'.$row['edition'].'</td>'.'<td><button onclick = return_book(row'.$count.',name'.$count.') class="button" >Return</button>'.'</td></tr>';
					$count+=1;
				}
			}
			echo "</table><br/><br/><a class='button' href='index.php'>Back</a>";
		}
		catch(Exception $e){
			echo $e;
		}
	}
	
}

?>