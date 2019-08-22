<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'library');
define('DB_USER','root');
define('DB_PASSWORD','');
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
function newuser(){
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
$Ssn = $_POST['Ssn'];
$Bname = $_POST['Bname'];
$Address = $_POST['Address'];
$Phone = $_POST['Phone'];


if($Ssn=="" || $Bname=="" || $Address=="" || $Phone==""){
				echo"Null Fields";
			}
else{
	$query = "insert into borrower values(default,'$Ssn','$Bname','$Address','$Phone')";
$data = mysqli_query($conn,$query)or die("Error: ".mysqli_error($conn));
if($data)
{
echo "YOUR REGISTRATION IS COMPLETE...";
$show = "SELECT * from borrower where Ssn = '$Ssn'";
$result = mysqli_query($conn,$show);
$rows=mysqli_fetch_array($result);
echo "<br>";

echo "The card number is : ".$rows['Card_ID'];
$link_address1 = 'Welcome1.php';
echo "<br>";
echo "<a href='$link_address1'>Home Page</a>";
}
}
}
function signup()
{
$Ssn=$_POST['Ssn'];
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db = mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
if(!empty($Ssn))
{

$sql="SELECT * FROM borrower WHERE Ssn = '$Ssn'";
$query = mysqli_query($conn,$sql);
if(!$row = mysqli_fetch_array($query))
{
newuser();
}
else
{
echo "SORRY...YOU ARE ALREADY REGISTERED USER...";
$link_address1 = 'Welcome1.php';
echo "<br>";
echo "<a href='$link_address1'>Go to Home Page</a>";
}
}
}
if(isset($_POST['submit']))
{
SignUp();
}


?>