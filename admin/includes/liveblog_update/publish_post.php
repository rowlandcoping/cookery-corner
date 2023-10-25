<?php

/////PUBLISH & UNPUBLSH/////

//if they hit publish to toggle just have to pull all the edit code back in using the include since header won't work
if (isset($_GET['publish'])) {
$post_id=$_GET['publish'];

$stmt = $conn ->prepare ("UPDATE liveblog SET live=1 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=1 WHERE liveblog_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live FROM liveblog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}
//same with unpublish
if (isset($_GET['unpublish'])) {

$post_id=$_GET['unpublish'];
$stmt = $conn ->prepare ("UPDATE liveblog SET live=0 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=0 WHERE liveblog_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live FROM liveblog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}

/////OPEN & CLOSE FOR ENTRIES/////


//if hit open toggle

if (isset($_GET['open'])) {
$post_id=$_GET['open'];

$stmt = $conn ->prepare ("UPDATE liveblog SET closed=0 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt=$conn->prepare("SELECT ID, title, slug, live FROM liveblog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}

//same with close
if (isset($_GET['close'])) {

$post_id=$_GET['close'];
$stmt = $conn ->prepare ("UPDATE liveblog SET closed=1 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();

$stmt=$conn->prepare("SELECT ID, title, slug, live FROM liveblog WHERE ID=?");
$stmt ->bind_param("i", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

include($editpost);
}

?>
