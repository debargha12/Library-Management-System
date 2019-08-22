<table border = "2">
	<tr>
		<th>CARD ID</th>
		<th>FINES DUE</th>
	</tr>

<?php

define('DB_HOST','localhost'); 
define('DB_NAME','library');
define('DB_USER','root');
define('DB_PASSWORD',''); 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());

if(isset($_POST['fines']))
{
	$show = "SELECT b.card_id, sum(f.fine_amt) AS Total_Fine FROM book_loans AS b left join fines AS f ON b.loan_id =  f.loan_id WHERE f.paid = 'FALSE' GROUP BY b.card_id ORDER BY b.card_id;";
	$result = mysqli_query($con,$show)or die("Error: ".mysqli_error($con));
	echo"<h1>Fine List</h1>";
	while($rows=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>";
		echo $rows['card_id'];
		echo "</td>";
		echo "<td>";
		echo $rows['Total_Fine'];
		echo "</td>";
		echo "</tr>";
		

	}
}



?>
</table>
