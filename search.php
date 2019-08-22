<table border = "2">
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Author</th>
		<th>Availability</th>
	</tr>

<?php

define('DB_HOST', 'localhost'); 
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD',''); 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
$set=$_POST['Search'];
if($set)
{
	$show = "SELECT b.isbn, b.title, GROUP_CONCAT(a.Name) as Authors, (case when b.isbn in(Select book_loans.isbn from library.book_loans where date_in IS NULL) then 'no' else 'yes' end) AS Available FROM library.book AS b left outer join library.book_authors AS ba on b.isbn=ba.isbn left outer join library.authors as a on ba.author_id=a.author_id group by b.isbn having b.title like '%$set%' or Authors like '%$set%' or b.isbn like '%$set%'";
	$result = mysqli_query($con,$show);
	echo"<h1>Books List</h1>";
	while($rows=mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>";
		echo $rows['isbn'];
		echo "</td>";
		echo "<td>";
		echo $rows['title'];
		echo "</td>";
		echo "<td>";
		echo $rows['Authors'];
		echo "</td>";
		echo "<td>";
		echo $rows['Available'];
		echo "</td>";
		echo "</tr>";
		

	}
}



?>
</table>
