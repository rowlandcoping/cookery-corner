<?php

//if they hit publish to toggle just have to pull all the edit code back in using the include since header won't work
if (isset($_GET['publish'])) {
$post_id=$_GET['publish'];

$stmt = $conn ->prepare ("UPDATE blog SET live=1 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=1 WHERE blog_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live FROM blog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}
//same with unpublish
if (isset($_GET['unpublish'])) {

$post_id=$_GET['unpublish'];
$stmt = $conn ->prepare ("UPDATE blog SET live=0 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=0 WHERE blog_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live FROM blog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}

?>
