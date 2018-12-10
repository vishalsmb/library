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
	</head>';
	echo $string;
if(isset($_SESSION["user"]))
{
	if($_SESSION['admin'] == 1){
		
		$string = '
				<body>
					<center>
					<p> Hello, Admin </p> <br/><br/>
					<a class="button" href="confirm_users.php">Confirm users</a> <br/><br/>
					<a class="button" href="view_users.php">View users</a> <br/><br/>
					<a class="button" href="view_books.php">View Books</a><br/><br/>
					<a class="button" href="books.php">Books Section</a> <br/><br/>
					<a class="button" href="logout.php">Logout</a>
					</center>
				</body>
				</html>
		';
		echo $string;
	}
	else if($_SESSION['admin'] == 0){
		$string = '
				<body>
				<center>
					<p> Hello ,'.$_SESSION['user'].' </p> <br/><br/>
					<a class="button" href="your_books.php">Your Books</a> <br/><br/>
					<a class="button" href="book_borrow.php">Lend Books</a> <br/><br/>
					<a class="button" href="returns.php">Book returns</a> <br/><br/>
					<a class="button" href="logout.php">Logout</a>
				</center>
				</body>
				</html>
		';
		echo $string;
	}
	
}
else {
	echo "Login to see the index page";
	echo "<br/><br/>Click <a href='login.php'>here</a> to login</a>";
}

?>

