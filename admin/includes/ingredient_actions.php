<?php session_start();

//maybe use this everywhere
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/ingredients";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
require_once($config);



function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
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
		$ingredient = esc($_POST['ingredient']);
		
		if (empty($ingredient)) {  echo "The add ingredient page does not work unless you add an ingredient
							<p><a href=\"/admin/admin.php\">Admin Home</a>
							<br><a href=\"/admin/ingrediententry.php\">Try Again</a></p>";
							;exit();}
							
		$check_query = "SELECT ingredient FROM ingredients WHERE ingredient='$ingredient' 
								LIMIT 1";

		$result = mysqli_query($conn, $check_query);
		$check = mysqli_fetch_assoc($result);

	if ($check) { // if user exists
		if (esc(strtolower($check['ingredient'])) === (strtolower($ingredient))) {
			 echo "This ingredient has been added already.
					<br>Saves a job I guess
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/ingrediententry.php\">Try Again</a></p>";
			 exit();
			}
	}
}	

///sanitise image

if(!empty($_FILES["ing_image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["ing_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["ing_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['ing_image']['tmp_name']; 

require ($imgprocess);
$ing_image = $newname;
}else{$ing_image="";} 

	
if(!empty($_POST['information'])) {
		$information = $_POST['information'];
	}else{$information="";
} 

$plural=$_POST['plural'];


$stmt = $conn->prepare("INSERT into ingredients (ingredient, plural, ing_image, information, slug)
						VALUES (?,?,?,?,?)");
						
  	$stmt->bind_param("sssss", $ingredient, $plural, $ing_image, $information, $slug);
  	$ingredient= $_POST['ingredient']; 
	$slug = makeSlug($ingredient);
  	  
	      if ($stmt->execute() === TRUE) {
					echo "<p>Ingredient Added</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}  
       
?>

 <p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/ingrediententry.php">Add another ingredient</a></p>
