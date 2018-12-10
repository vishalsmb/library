<?php
include("db.php");
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
	function setcookie(number){
		var username = document.getElementsByClassName("username")[number].innerHTML;
		var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
  			if (this.readyState == 2){
  				document.getElementsByClassName("confirm")[number].innerHTML = "working on .. ";
  			}
	   		if (this.readyState == 4 && this.status == 200) {
	     		if(this.responseText == "added"){
	     			document.getElementsByClassName("confirm")[number].innerHTML = "Confirmed";
	     		}
	   		}
   		};
    	xhttp.open("GET", "confirm.php?username="+username, true);
    	xhttp.send();
	}
</script>
<center>
<br/><br/>
<h2>Registered users</h2>
<br/><br/>
<table>
	<tr> 
		<th> Username </th>
		<th> Email </th>
		<th> Action </th>
	</tr>';
try {
		$conn = new mysqli($servername, $username, $password, $dbname);
		echo $string;
		if ($conn->connect_error) 
		{
	    	die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM temp_users";
		$result = $conn->query($sql);
		$num = 0;
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) 
				{
					echo '<tr><td class="username">'.$row['username'].'</td><td>'.$row['email'].'</td><td>';
					echo '<button  class="confirm" onclick = "setcookie('.$num.')">Confirm</button></td></tr></form>';
					$num += 1;
				}
		}
		echo '</table>';
		echo "<br/><br/><a class='button' href='index.php'>Back</a></center>";

	}
	catch(Exception $e){
		echo "Error : ".$e;
	}


?>