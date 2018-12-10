<?php
	include('db.php');
	if(isset($_POST['add_book'])) {
				$name = $_POST['add_book'];
				$author = $_POST['author'];
				$journal = $_POST['journal'];
				$publication = $_POST['publication'];
				$year = $_POST['year'];
				$edition = $_POST['edition'];
				$count = $_POST['count'];
				$conn = new mysqli($servername, $username, $password, $dbname);
				$stmt = $conn->prepare("INSERT INTO books(name,author,journal,publication,year,edition,count) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param('ssssssi',$name,$author,$journal,$publication,$year,$edition,$count);
				if($stmt->execute()){
					echo "Record added successfully .. <br/> Click <a href='index.php'>here</a> to go to index page";
				}
				$conn->close();
	}
	elseif (isset($_POST['delete_book'])) {
		$name = $_POST['delete_book'];
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "DELETE FROM books where name='$name'";
		$result = $conn->query($sql);
		if($result){
			echo "Deleted successfully .. <br/> Click <a href='index.php'>here</a> to go to index page";
		}
		$conn->close();
	}
	elseif(isset($_POST['update_book'])){
		$name = $_POST['update_book'];
		$author = $_POST['author'];
		$journal = $_POST['journal'];
		$publication = $_POST['publication'];
		$year = $_POST['year'];
		$edition = $_POST['edition'];
		$count = $_POST['count'];
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "UPDATE books set author = '$author',journal = '$journal', publication = '$publication', year = '$year', edition = '$edition', count ='$count' where name = '$name'";
		$result = $conn->query($sql);
		if($result) {
			echo "Updated successfully  .. <br/> Click <a href='index.php'>here</a> to go to index page";
		}

	}
?>