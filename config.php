 <?php 
//Connection details
$servername = "localhost";
$username = "root";
$password = "ss001jrh";
$dbname = "cookery_corner_test";
//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); 
// Check connection
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
//set root
//set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] ); 

