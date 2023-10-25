<?php

if (isset($_POST['update-conc'])) {

// set variables
$summary= $_POST['summary'];
$post_id=$_POST['ID'];

$stmt= $conn->prepare("UPDATE reviews SET summary=? WHERE ID=?");
$stmt->bind_param("ss", $summary, $post_id);
$stmt->execute();

//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE review_ID=?");
$stmt->bind_param("s", $post_id);

if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Conclusions Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>
