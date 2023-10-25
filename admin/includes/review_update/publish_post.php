<?php

//if they hit publish to toggle just have to pull all the edit code back in using the include since header won't work
if (isset($_GET['publish'])) {
$post_id=$_GET['publish'];

$stmt = $conn ->prepare ("UPDATE reviews SET live=1 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=1 WHERE review_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live, image1, heading1, image2, heading2, image3, heading3, image4, heading4, image5, heading5,
					 image6, heading6, image7, heading7, image8, heading8 FROM reviews WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}
//same with unpublish
if (isset($_GET['unpublish'])) {

$post_id=$_GET['unpublish'];
$stmt = $conn ->prepare ("UPDATE reviews SET live=0 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=0 WHERE review_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live, image1, heading1, image2, heading2, image3, heading3, image4, heading4, image5, heading5,
					 image6, heading6, image7, heading7, image8, heading8 FROM reviews WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}

?>
