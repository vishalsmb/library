<!doctype html>
<html lang="en">
<head>
	<title> Books </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login.css">
	<link rel="stylesheet" href="table.css">
</head>
<body>
	<script>
		function insert(){
			document.getElementById('insert').className = "active";
			document.getElementById('update').className = "button";
			document.getElementById('delete').className = "button";
			document.getElementsByClassName('login-form')[0].innerHTML = `<form method="POST" action="books1.php">
						<input type="text" name="add_book" placeholder="Enter book name" />
						<input type="text" name="author" placeholder="Enter author name" />
						<input type="text" name="journal" placeholder="Enter journal name" />
						<input type="text" name="publication" placeholder="Enter publication name" />
						<input type="text" name="year" placeholder="Enter published year" />
						<input type="text" name="edition" placeholder="Enter edition number" />
						<input type="number" name="count" placeholder="Enter count" />
						<input class="button" type="submit" value="Add book">
					</form>`;
		}
		function update(){
			document.getElementById('update').className = "active";
			document.getElementById('insert').className = "button";
			document.getElementById('delete').className = "button";
			document.getElementsByClassName('login-form')[0].innerHTML = `<form method="POST" action="books1.php">
						<input type="text" name="update_book" placeholder="Enter book name" />
						<input type="text" name="author" placeholder="Enter author name" />
						<input type="text" name="journal" placeholder="Enter journal name" />
						<input type="text" name="publication" placeholder="Enter publication name" />
						<input type="text" name="year" placeholder="Enter published year" />
						<input type="text" name="edition" placeholder="Enter edition number" />
						<input type="number" name="count" placeholder="Enter count" />
						<input class="button" type="submit" value="Update book">
					</form>`;
		}
		function delete1(){
			document.getElementById('delete').className = "active";
			document.getElementById('update').className = "button";
			document.getElementById('insert').className = "button";
			document.getElementsByClassName('login-form')[0].innerHTML = `<form method="POST" action="books1.php">
						<input type="text" name="delete_book" placeholder="Enter book name" />
						<input class="button" type="submit" value="Delete book">
					</form>`;
		}	
	</script>
		<center>
			<br/><br/>
			<div>
				<button class="button" id="insert" onclick=insert()>Insert Books</button> 
				<button class="button" id="update" onclick=update()>Update Books</button> 
				<button class="button" id="delete" onclick=delete1()>Delete Books</button> 		
			</div>
			<br/>
			<a class="button" href="index.php">Back</a>
			<div class="login">
				<div class="login-form">
				</div>
			</div>
		</center>
</body>
</html>