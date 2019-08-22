<?php
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD',''); 

function SignIn() { 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
session_start(); 
$x=$_POST['Card_ID'];
$y=$_POST['Ssn'];
if(!empty($x)) 
{ 
$sql="SELECT * FROM borrower where Card_ID ='$x' AND Ssn ='$y'";

$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_array($query); 
if(!empty($row['Card_ID']) AND !empty($row['Ssn'])) 
{
$_SESSION['Card_ID'] = $row['Card_ID'];
echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE... ".$_SESSION['Card_ID'];
header("location:Welcome1.php");
} 
else 
{ 
echo "SORRY... YOU ENTERD WRONG Card_ID AND Ssn... PLEASE RETRY...";
} 
} 
} 
if(isset($_POST['submit'])) 
{ 
SignIn(); 
} 
?>