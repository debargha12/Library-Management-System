<?php
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD',''); 

function SignIn() { 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
session_start(); 
$x=$_POST['Lib_ID'];
$y=$_POST['Password'];
if(!empty($x)) 
{ 
$sql="SELECT * FROM librarian where Lib_ID ='$x' AND Password ='$y'";

$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_array($query); 
if(!empty($row['Lib_ID']) AND !empty($row['Password'])) 
{
$_SESSION['Lib_ID'] = $row['Lib_ID'];
echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE... ".$_SESSION['Lib_ID'];
header("location:Welcome1.php");
} 
else 
{ 
echo "SORRY... YOU ENTERD WRONG Lib_ID AND Password... PLEASE RETRY...";
} 
} 
} 
if(isset($_POST['submit'])) 
{ 
SignIn(); 
} 
?>