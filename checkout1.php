<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD','');
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
function newuser()
{
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
$isbn = $_POST['isbn'];
$card_id = $_POST['card_id'];
$date_out = $_POST['date_out'];
$due_date = $_POST['due_date'];
$date_in = $_POST['date_in'];
$checks = "SELECT COUNT(isbn) = 1 from book_loans where isbn = '$isbn' and date_in IS NULL";
$de = mysqli_query($conn,$checks)or die("Error: ".mysqli_error($conn));
$row=mysqli_fetch_array($de);
if($row['COUNT(isbn) = 1']=="1"){
echo "Book already taken.";
echo "<br>";
$link_address1 = 'checkout.html';
echo "<a href='$link_address1'>CHECK OUT</a>";
}
else{
	$check = "SELECT COUNT(card_id) = 3 FROM book_loans where card_id = '$card_id' and date_in IS NULL";
$d = mysqli_query($conn,$check)or die("Error: ".mysqli_error($conn));
$rows=mysqli_fetch_array($d);
if($rows['COUNT(card_id) = 3']=="1")
{
echo "You have already taken three books";
echo "<br>";

}
else
{
$query = "insert into book_loans values(default,'$isbn','$card_id',CURRENT_TIMESTAMP (),DATE_ADD(now(), INTERVAL 14 DAY),NULL)";
$data = mysqli_query($conn,$query)or die("Error: ".mysqli_error($conn));
if($data)
{
echo "CHECK OUT SUCCESSFUL";
$link_address1 = 'Welcome1.php';
echo "<br>";
echo "<a href='$link_address1'>Home Page</a>";
}
}
}
}
if(isset($_POST['submit']))
{
newuser();
}

?>

