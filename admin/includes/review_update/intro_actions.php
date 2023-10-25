<?php

if (isset($_POST['update-intro'])) {

// set variables
$intro= $_POST['intro'];
$post_id=$_POST['ID'];

$stmt= $conn->prepare("UPDATE reviews SET intro=? WHERE ID=?");
$stmt->bind_param("ss", $intro, $post_id);
$stmt->execute();

//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE review_ID=?");
$stmt->bind_param("s", $post_id);

if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Introduction Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>
