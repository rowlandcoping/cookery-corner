<?php session_start();

//maybe use this everywhere

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/config.php";
require_once($path);


function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}
function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}

//de-dupe

if (isset($_POST['submit'])) {
		// receive all input values from the form
		$cuisine = esc($_POST['cuisine']);
		
		if (empty($cuisine)) {  echo "The add cuisine page does not work unless you add a cuisine
							<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/cuisineentry.php\">Try Again</a></p>";
							;exit();}
							
		$check_query = "SELECT cuisine FROM cuisine WHERE cuisine='$cuisine' 
								LIMIT 1";

		$result = mysqli_query($conn, $check_query);
		$check = mysqli_fetch_assoc($result);

	if ($check) { // if user exists
		if (esc(strtolower($check['cuisine'])) === (strtolower($cuisine))) {
			 echo "This cuisine has been added already.
					<br>Saves a job I guess
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/cuisineentry.php\">Try Again</a></p>";
			 exit();
			}
	}
}








if(!empty($_POST['description'])) {
		$description = $_POST['description'];
	}else{$description="";
}  

$stmt = $conn->prepare("INSERT into cuisine (cuisine, description, slug)
						VALUES (?, ?, ?)");
						
  	$stmt->bind_param("sss", $cuisine, $description, $slug);
  	$cuisine = $_POST['cuisine']; 
	$slug = makeSlug($cuisine);
  	  
	      if ($stmt->execute() === TRUE) {
					echo "<p>Cuisine type added</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}  
       
?>

 <p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/cuisineentry.php">Add another cuisine type</a></p>
