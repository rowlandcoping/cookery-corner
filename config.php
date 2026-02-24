 <?php 
//Connection details
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');		

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); 
// Check connection
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
//set root
//set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] ); 

