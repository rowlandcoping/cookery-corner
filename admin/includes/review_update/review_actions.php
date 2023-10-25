<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/reviews";
$imgprocess = "$path"."/admin/includes/imageprocess.php";

if (isset($_POST['update-review'])) {
//pull review section from form
$heading=$_POST['headtype'];
$imageballs= $_POST['imgtype'];
$caption= $_POST['captype'];
$review= $_POST['revtype'];
$rating= $_POST['rattype'];


// set variables
$revheading= $_POST['heading'];
$revreview = $_POST['review'];
$revcaption= $_POST['caption'];
$revrating= $_POST['rating'];
//sort image:


if (!empty($_FILES["revimage"]["name"])) {
	
$fileName = basename($_FILES["revimage"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["revimage"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['revimage']['tmp_name'];
$oldimage=$_POST['oldimage'];

require ($imgprocess);
if (!empty($_POST['oldimage'])){if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}}
$image1 = $newname;
}




if (empty($_FILES["revimage"]["name"])){
$image1=$_POST['oldimage'];
}
	
//update review table
$ID= $_POST['ID'];
$stmt= $conn->prepare("UPDATE reviews SET $heading=?, $review=?, $rating=?, $imageballs=?, $caption=? WHERE ID=?");
$stmt->bind_param("ssssss", $revheading, $revreview, $revrating, $image1, $revcaption, $ID);
$stmt->execute();

//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE review_ID=?");
$stmt->bind_param("s", $ID);

if ($stmt->execute()=== TRUE) {
					$post_id=$ID;
					$updated="<h2><span style=\"color:red;\">Review Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>


