<?php
if (isset($_POST['delete-review'])) {
//set reveiw variables
$post_id=$_POST['ID'];
$heading= $_POST['heading'];
$image=$_POST['image'];
$review = $_POST['review'];
$caption= $_POST['caption'];
$rating= $_POST['rating'];
$oldimage=$_POST['oldimage'];
//set blank value to delete
$removed="";




$stmt= $conn->prepare("UPDATE reviews SET $heading=?, $image=?, $review=?, $caption=?, $rating=? WHERE ID=?");
$stmt->bind_param("ssssss", $removed, $removed, $removed, $removed, $removed, $post_id);
$stmt->execute();
if (file_exists("$revpath"."/"."$oldimage")){unlink("$revpath"."/"."$oldimage");}


$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE review_ID=?");
$stmt->bind_param("s", $ID);


if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Review Deleted</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}

?>
