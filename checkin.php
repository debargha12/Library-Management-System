<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD','');
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
if(isset($_POST['submit']))
	{
		checkin();
	}

function checkin()
	{
		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
		$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
		$isbn = $_POST['isbn'];
		$card_id = $_POST['card_id'];
		$sql1="SELECT loan_id,date_out, due_date, card_id, isbn FROM book_loans WHERE isbn='$isbn' AND card_id ='$card_id'";
  		$d = mysqli_query($conn,$sql1)or die("Error: ".mysqli_error($conn));
		$rows=mysqli_fetch_array($d);
		$dateout=$rows['date_out'];
        $duedate=$rows['due_date'];
        $cardid=$rows['card_id'];
        $loanid=$rows['loan_id'];
        $checkindate=date("Y-m-d");
        $dateout=strtotime($dateout);
    	$duedate=strtotime($duedate);
    	$checkindate=strtotime($checkindate);
    	$day = round(($checkindate-$dateout) / 86400);//86400 is the number of seconds in a day. This calculates the number of days
    	if($day<=14)
    	{
    		echo"No fines due.";
    		$update1="UPDATE book_loans SET date_in=CURRENT_TIMESTAMP () WHERE isbn='$isbn' and card_id='$card_id'";
    		$result = mysqli_query($conn,$update1)or die("Error: ".mysqli_error($conn));
  			echo"Check In successful";
  			$link_address1 = 'Welcome1.php';
			echo "<br>";
			echo "<a href='$link_address1'>Home Page</a>";
    	}
    	else
    	{
    		$fine=round(($checkindate-$duedate) / 86400)*0.25;
    		echo "You have a Fine of $".$fine;
    		echo "<br>";
    		echo "The loan id is:".$loanid;
    		echo "<br>";
    		$link_address1 = 'fine.html';
			echo "<br>";
			echo "<a href='$link_address1'>Pay fine now.</a>";
			$link_address1 = 'Welcome1.php';
			echo "<br>";
			echo "<a href='$link_address1'>Go to Home page.</a>";
			echo "<br>";
			$check = "select count(loan_id) = 1 from fines where loan_id = '$loanid'";
			$d = mysqli_query($conn,$check)or die("Error: ".mysqli_error($conn));
			$rows=mysqli_fetch_array($d);
			if($rows['count(loan_id) = 1']=="1")
			{
				$update3="UPDATE fines SET fine_amt= '$fine' where loan_id='$loanid'";
    			$result = mysqli_query($conn,$update3)or die("Error: ".mysqli_error($conn));

			}
			else
			{
    		$update2="INSERT INTO fines values('$loanid','$fine','FALSE')";//FALSE  for not paid yet
    		$result = mysqli_query($conn,$update2)or die("Error: ".mysqli_error($conn));
    		}

    	}
	}
?>