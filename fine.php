<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD','');
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
if(isset($_POST['submit']))
	{
		fine();
	}
function fine()
	{
		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
		$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
		$loanid = $_POST['loan_id'];
		$check = "select * from fines where loan_id = '$loanid'";
		$d = mysqli_query($conn,$check)or die("Error: ".mysqli_error($conn));
		$rows=mysqli_fetch_array($d);

		if($rows['paid']=="TRUE")
		{
			echo"Fine already paid.";
		}
		else
		{
		$update="UPDATE fines SET paid= 'TRUE' where loan_id='$loanid'";
    	$result = mysqli_query($conn,$update)or die("Error: ".mysqli_error($conn));
    	$update1="UPDATE book_loans SET date_in = CURRENT_TIMESTAMP() WHERE loan_id = '$loanid'";
    	$result = mysqli_query($conn,$update1)or die("Error: ".mysqli_error($conn));
    	echo"Fine paid successfully";
    	}

	}


?>