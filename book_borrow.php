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
<script>
	var bookcount =';
include_once("db.php");
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
	if($_SESSION['admin']==0){
		try{
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) 
			{
	    		die("Connection failed: " . $conn->connect_error);
			} 

			$books = 0;
			$sql1 = "SELECT book1,book2,book3 FROM users where username='$user'";
			$result = $conn->query($sql1);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$book1 = $row['book1'];
					$book2 = $row['book2'];
					$book3 = $row['book3'];
				}
			}
			if($book1 == ''){
				$books += 1;
			}
			if($book2 == ''){
				$books += 1;
			}
			if($book3 == ''){
				$books += 1;
			}
			$string .= $books;
			$string .= ';';
			echo $string;
			echo '
	function lend(name,count){
		if(bookcount > 0) {
			var temp = count.innerHTML;
			book = name.innerHTML;
			var xhttp = new XMLHttpRequest();
	  		xhttp.onreadystatechange = function() {
	  			if (this.readyState == 2){
	  				document.getElementById("status").innerHTML = "working on .. ";
	  			}
		   		if (this.readyState == 4 && this.status == 200) {
		     		if(this.responseText == "success"){
		     			document.getElementById("status").innerHTML = "";
		     			bookcount -= 1;
						document.getElementById("count").innerHTML = bookcount;
						count.innerHTML = temp-1;
		     		}
		   		}
	   		};
	   		var t1 = temp - 1;
	   		console.log("confirm_borrow.php?book="+book+"&count="+t1);
	    	xhttp.open("GET", "confirm_borrow.php?book="+book+"&count="+t1, true);
	    	xhttp.send();
		}
		else {
			alert("Your limit has been exceeded");
		}
	}

</script>
<center>
<br/><br/>
<h2>Available Books</h2>
<p> Maximum Books : <p id="count">'.$books.'  </p> </p>
<p id="status"></p>
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
		<th> Action </th>
	</tr>';
			$sql = "SELECT * FROM books";
			$result = $conn->query($sql);
			$count = 0;
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo '<tr id="row'.$count.'"><td>'.$row['id'].'</td><td id="name'.$count.'">'.$row['name'].'</td><td>'.$row['author'].'</td><td>'.$row['journal'].'</td><td>'.$row['publication'].'</td><td>'.$row['year'].'</td><td>'.$row['edition'].'</td><td id="count'.$count.'">'.$row['count'].'</td><td><button class="button" onclick=lend(name'.$count.',count'.$count.')>Lend</button>'.'</td></tr>';
					$count += 1;
				}
			}
			echo '</table>';
			echo "<br/><br/><a class='button' href='index.php'>Back</a>";
		}
		catch(Exception $e){
			echo "Error : ".$e;
		}
	}
}
?>