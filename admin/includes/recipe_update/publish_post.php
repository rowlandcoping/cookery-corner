<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$reviewsubmit ="$path"."/admin/recipe_entry.php";


require_once($config);
//if they hit publish to toggle just have to pull all the edit code back in using the include since header won't work
if (isset($_GET['publish'])) {
$post_id=$_GET['publish'];
//delete pending notification
$stmt=$conn->prepare("DELETE FROM notifications WHERE type=2 AND recipe_ID=?");
$stmt->bind_param ("s", $post_id);
$stmt->execute();

$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, live FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$url="/recipe/".$result['titslug'];
$user_ID=$result['user_ID'];
$titslug=$result['titslug'];
$title=$result['title'];
$stmt = $conn->prepare("SELECT email, name, slug, role, e_approval from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$email=$result['email'];
$user=$result['name'];
$userslug=$result['slug'];
$role=$result['role'];
$e_approval=$result['e_approval'];

$stmt = $conn ->prepare ("UPDATE recipes SET live=1, stage=10 WHERE ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=1, url=?, lastupdated=now() WHERE recipe_ID=?");
$stmt->bind_param("ss", $url, $post_id);
$stmt->execute();

//update notifications

$type="3";
$admin="0";
$subject="Recipe Published";
if ($role==="admin")  {$message= "<p>You have published \"<a href=\"/recipe/".$titslug."\" target=\"_blank\">".$title."</a>\"</p>";}
else{
$message="<p><h4>Great news!</h4></p>
<p>Your recipe \"<a href=\"/recipe/".$titslug."\" target=\"_blank\">".$title."</a>\" is now live!</p>
<p>You should definitely tell all your friends and share it on social media and stuff.</p>";
}
$stmt= $conn->prepare("INSERT INTO notifications (user_ID, recipe_ID, user, userslug, slug, title, subject, message, type, admin) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss", $user_ID, $post_id, $user, $userslug, $titslug, $title, $subject, $message, $type, $admin);
$stmt->execute();

//send notification e-mail
if ($role!=="admin"){
	
if ($e_approval=="1") {
	
$to=$email;
$subject="Your recipe is now live";
$message ="<h4>Great news!</h4>";
$message .="<p>Your recipe \"<a href=\"https://cookery-corner.co.uk/recipe/".$titslug."\" target=\"_blank\">".$title."</a>\" is now live!</p>";
$message.="<p>You should definitely tell all your friends and share it on social media and stuff.</p>";
$headers ="From: <noreply@cookery-corner.co.uk>\r\n";
$headers.="Content-type: text/html\r\n";
	
mail($to, $subject, $message, $headers);
}}

include($editpost);
}
//same with unpublish
if (isset($_GET['unpublish'])) {
$post_id=$_GET['unpublish'];

$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, live FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$user_ID=$result['user_ID'];
$titslug=$result['titslug'];
$title=$result['title'];
$stmt = $conn->prepare("SELECT email, name, slug, role, e_pending from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$email=$result['email'];
$user=$result['name'];
$userslug=$result['slug'];
$role = $result['role'];
$e_pending=$result['e_pending'];


if ($role==="admin")  {
$stage="9";
$message="<p>You have unpublished \"<a href=\"/recipe/".$titslug."\" target=\"_blank\">".$title."</a>\"</p>";
}else{
$stage="8";
$message="<p>Your recipe \"<a href=\"/recipe/".$titslug."\" target=\"_blank\">".$title."</a>\" is no longer live.</p>
<p>This is most likely at your request, but if there has been a mistake please <a href=\"/contactform.php\" target=\"_blank\">contact us</a></p>";
}

$stmt = $conn ->prepare ("UPDATE recipes SET live=0, stage=? WHERE ID=?");
$stmt->bind_param("ss", $stage, $post_id);
$stmt->execute();
$stmt = $conn ->prepare ("UPDATE article_index SET live=0 WHERE recipe_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();


//update notifications

$type="2";
$admin="0";
$subject="Recipe Unpublished";
$stmt= $conn->prepare("INSERT INTO notifications (user_ID, recipe_ID, user, userslug, slug, title, subject, message, type, admin) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss", $user_ID, $post_id, $user, $userslug, $titslug, $title, $subject, $message, $type, $admin);
$stmt->execute();

//send notification e-mail
if ($role!=="admin"){
if ($e_pending=="1") {
	
$to=$email;
$subject="Your recipe has been unpublished";
$message ="<p>Your recipe \"<a href=\"https://cookery-corner.co.uk/recipe/".$titslug."\" target=\"_blank\">".$title."</a>\" is no longer live.</p>";
$message.="<p>This is most likely at your request, but if there has been a mistake please <a href=\"https://cookery-corner.co.uk/contactform.php\" target=\"_blank\">contact us</a></p>";
$headers ="From: <noreply@cookery-corner.co.uk>\r\n";
$headers.="Content-type: text/html\r\n";
	
mail($to, $subject, $message, $headers);
}}
//delete published notification
$stmt=$conn->prepare("DELETE FROM notifications WHERE type=3 and recipe_ID=?");
$stmt->bind_param("s", $post_id);
$stmt->execute();

if ($role==="admin"){
include($editpost);
}else{
$recipe_ID=$post_id;
include ($reviewsubmit);
}
}

?>
