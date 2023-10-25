<?php

$stage=$_POST['stage'];
if (isset($_POST['image'])) {

if(!empty($_FILES["rec_image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["rec_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["rec_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['rec_image']['tmp_name'];
$oldimage=$_POST['oldimage'];



require ($imgprocess);

if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$rec_image = $newname;
} else {echo "you must include an image to post a recipe
												<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
$ID= $_POST['ID'];									
$stmt= $conn->prepare("UPDATE recipes SET rec_image=? WHERE ID=?");
$stmt->bind_param("ss", $rec_image, $ID);
$stmt->execute();
if ($stage<9){ $messager="Image Updated";
				include($reviewsubmit);
				exit();
}
//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE recipe_ID=?");
$stmt->bind_param("i", $ID);

if ($stmt->execute()=== TRUE) {	$post_id=$ID;
		$updated="<h2><span style=\"color:red;\">Image Updated</span></h2>";
		include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}

}
?>
