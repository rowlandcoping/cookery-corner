<?php

if (isset($_POST['update-content'])) {

// set variables
$content= $_POST['content'];
$keywords=$_POST['keywords'];
$post_id=$_POST['ID'];

$stmt= $conn->prepare("UPDATE blog SET content=?, keywords=? WHERE ID=?");
$stmt->bind_param("sss", $content, $keywords, $post_id);
$stmt->execute();

//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE blog_ID=?");
$stmt->bind_param("s", $post_id);

if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Blog Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>
