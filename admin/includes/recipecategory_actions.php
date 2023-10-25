<?php session_start();
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
		$category = esc($_POST['category']);
		
		if (empty($category)) {  echo "The add category page does not work unless you add a category
							<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/recipe_categoryentry.php\">Try Again</a></p>";
							;exit();}
							
		$check_query = "SELECT category FROM recipe_category WHERE category='$category' 
								LIMIT 1";

		$result = mysqli_query($conn, $check_query);
		$check = mysqli_fetch_assoc($result);
		echo $category;
		echo $check['category'];

	if ($check) { // if user exists
		if (esc(strtolower($check['category'])) === (strtolower($category))) {
			 echo "This cuisine has been added already.
					<br>Saves a job I guess
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/recipe_categoryentry.php\">Try Again</a></p>";
			 exit();
			}
	}
}



if(!empty($_POST['description'])) {
		$description = $_POST['description'];
	}else{$description="";
} 

$stmt = $conn->prepare("INSERT into recipe_category (category, description, slug)
						VALUES (?,?,?)");
						
  	$stmt->bind_param("sss", $category, $description, $slug);
  	$category = $_POST['category']; 
	$slug = makeSlug($category);
  	  
	      if ($stmt->execute() === TRUE) {
					echo "<p>Category Added</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}  
       
?>

 <p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/recipe_categoryentry.php">Add another category</a></p>
</html>
