<?php if(!isset($_SESSION)){session_start();}?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$loginpath = "$path"."/publiclogin.php";
$logout=$path."/logout";
$config = "$path"."/config.php";
$head= "$path"."/admin/includes/head_pubprofile.php";
$delete ="$path"."/admin/includes/recdel_actions.php";
$name= $_SESSION['name'];
$user_ID = $_SESSION['ID'];

require_once($head);
require_once($config);

?>



<div class=overall>

<div class=user>
	

<div class=information>
<h1>Cookery Corner Dashboard</h1>
<hr />
<?php if (!empty($messager)){echo "<h3><span style=\"color:red\";>".$messager."</span></h3><hr/>";}?>
<?php if (!empty($message)){echo $message."<hr/>";}?>

<div class="profilecont">

<div class="menutree">

<?php
if (isset($_GET['profile-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/user_profile.php\"></a> Profile</h2>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_profile.php?update-profile=".$_SESSION['ID']."\"></a> Update Profile</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/notifications.php\"></a> Notification Settings</h3>";
			}else{echo "<h2><a class=\"fa fa-angle-double-right\" href=\"/admin/user_profile.php?profile-options\"></a> Profile</h2>";}


if (isset($_GET['recipe-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/user_profile.php\"></a> Recipes</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_entry.php?create-recipe\"></a> Add a new recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-question btn\"href=\"/admin/request.php\" target=\"_blank\"></a>&nbsp Make a Request</h3>";
}else{ echo "<h2><a class=\"fa fa-angle-double-right btn\" href=\"/admin/user_profile.php?recipe-options\"></a> Recipes</h2>";}

?>
</div>
<div class ="profileimg">

<?php 

$stmt=$conn->prepare("SELECT ID, name, slug, food_pro, profile_pic, profile, email FROM users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();

if (!empty($result['profile_pic'])) {$profile_pic=$result['profile_pic'];}

?>
	<h2><?php echo $result['name']?></h2>


<?php

if (!empty($profile_pic)) {echo "<img class=\"segment\" src=\"/assets/images/profile/".$profile_pic."\" width=\"280\"/>";
}else{echo "<img class=\"segment\" src=\"/assets/images/testcard.jpeg\" width=\"280\"/>";}
?>

</div>
</div>


<hr />
<h3>Notifications</h3>
<?php


if (isset($_GET['delete-notification'])) {

$not_ID=$_GET['delete-notification'];

$stmt=$conn->prepare("DELETE FROM notifications WHERE ID=?");
$stmt->bind_param("s", $not_ID);
$stmt->execute();
}

$stmt=$conn->prepare("SELECT ID, user_ID, recipe_ID, user, userslug, title, slug, subject, message, type, timestamp FROM notifications WHERE user_ID=? ORDER BY timestamp DESC");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array = $stmt->get_result();
$result=$array->fetch_assoc();

if ($result) {

$check=$conn->prepare("SELECT e_contact, e_urgent, e_request, e_pending, e_approval, contact, pending, approval FROM users WHERE ID=?");
$check->bind_param("i", $user_ID);
$check ->execute();
$numbers= $check ->get_result();
$notifs = $numbers->fetch_assoc();

$e_contact=$notifs['e_contact']; 
$e_urgent=$notifs['e_urgent'];
$e_request=$notifs['e_request'];
$e_pending=$notifs['e_pending'];
$e_approval=$notifs['e_approval']; 
$contact=$notifs['contact'];
$pending=$notifs['pending']; 
$approval=$notifs['approval'];	
?>

	
<div class="notification">	
	
	<div class="header">
<div class="open">View</div>
<div class="bar">|</div>
<div class="icon">Action</div>
<div class="bar">|</div>
<div class="date">Date/Time</div>
<div class="bar">|</div>
<div class="subject">Subject</div>
<div class="bar">|</div>
<div class="title">Recipe</div>

</div>
	
<?php
foreach ($array as $r) {
	
if ($r['type']===2 && $pending=="0") {continue;}
if ($r['type']===3 && $approval=="0")  {continue;}
	
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	

?>

<?php

//if view message selected

if (isset($_GET['view-message'])&&$r['ID']==($_GET['view-message'])) {
echo "<div class=\"msgbar\">";
echo "<div class=\"close\"><a class=\"fa fa-angle-double-down btn\" href=\"/admin/user_profile.php?message-reduce\"></a></div><div class=\"bar\">|</div>";

if ($r['type']===1) 
{ echo "<div class=\"icon\"><a href=\"/admin/recipe_entry.php?resume-recipe=".$r['recipe_ID']."&resume-title=".$r['title']."\"><img src=\"/assets/logos/exclam.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===2) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/clock.jpg\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===3) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/check.png\" width=\"20\" /></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===4)
{ echo "<div class=\"icon\"><img src=\"/assets/logos/question.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";	
}else{ if ($r['type']===6) 
{ echo "<div class=\"icon\"><img src=\"/assets/logos/check.png\" width=\"20\" /></div><div class=\"bar\">|</div>";
}}}}}
echo "<div class=\"date\">".$date."</div><div class=\"bar\">|</div>";
echo "<div class=\"subject\">".$r['subject']."</div><div class=\"bar\">|</div>";
echo "<div class=\"title\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\">".$r['title']."</a></div></div>";

//message content
echo "<div class=\"message\">";
echo $r['message'];
echo "<a href=\"/admin/user_profile.php?delete-notification=".$r['ID']."\">Remove notifiction</a></div>";
}else{

//if message not selected

echo "<div class=\"subjectbar\">";
echo "<div class=\"open\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/user_profile.php?view-message=".$r['ID']."\"></a></div><div class=\"bar\">|</div>";

if ($r['type']===1) 
{ echo "<div class=\"icon\"><a href=\"/admin/recipe_entry.php?resume-recipe=".$r['recipe_ID']."&resume-title=".$r['title']."\"><img src=\"/assets/logos/exclam.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===2) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/clock.jpg\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===3) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/check.png\" width=\"20\" /></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===4)
{ echo "<div class=\"icon\"><img src=\"/assets/logos/question.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";	
}else{ if ($r['type']===6) 
{ echo "<div class=\"icon\"><img src=\"/assets/logos/check.png\" width=\"20\" /></div><div class=\"bar\">|</div>";
}}}}}
echo "<div class=\"date\">".$date."</div><div class=\"bar\">|</div>";
echo "<div class=\"subject\">".$r['subject']."</div><div class=\"bar\">|</div>";
echo "<div class=\"title\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\">".$r['title']."</a></div></div>";
}
}echo "</div>";}else{echo "<h4>You have nothing of which to be notified...</h4>";}



?>
<hr />

<?php
$ID= $_SESSION['ID'];
$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, stage FROM recipes WHERE stage<9 AND user_ID=? ORDER BY ID DESC");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array=$stmt->get_result();
$result= $array->fetch_assoc();


if (!empty($result)){
echo"<h3>Update Incomplete Recipes</h3>";

foreach ($array as $r) {

if ($r['stage']===2) {$stage="ingredients";}
if ($r['stage']===3) {$stage="introduction";}
if ($r['stage']===4) {$stage="recipe stage 1";}
if ($r['stage']===5) {$stage="recipe stage 2 (optional)";}
if ($r['stage']===6) {$stage="recipe stage 3 (optional)";}
if ($r['stage']===7) {$stage="summary";}
if ($r['stage']===8) {$stage="review and submit";}

if (isset($_GET['delete-recipe'])&&$r['ID']==($_GET['delete-recipe']))
{
echo 	"<h4><a class=\"fa fa-pencil btn \" href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\"></a>"; 
echo	" | <a class=\"fa fa-trash btn \"href=\"/admin/user_profile.php?delete-recipe=".$r['ID']."\"></a>";
echo " | <a href=\"/recipe/".$r['titslug']."\" target=\"_blank\">".$r['title']."</a>";
echo 	" | ".$stage."</h4>";
?>
<div class="message">
<p>Do you really want to delete the recipe:</p>
<p>
<?php echo "	<a href=\"/recipe/".$r['titslug']."\" target=\"_blank\">".$r['title']."</a>???</p>
<p><b><a href=\"/admin/includes/recdel_actions.php?recipe-delete=".$r['ID']."\"><span style=\"color:green\">YES</span></a> | 
<a href=\"/admin/user_profile.php\"><span style=\"color:red\">NO</span></a></b></p>
</div>";
}else
{echo 	"<h4><a class=\"fa fa-pencil btn \" href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\"></a>"; 
echo	" | <a class=\"fa fa-trash btn \"href=\"/admin/user_profile.php?delete-recipe=".$r['ID']."\"></a>";
echo " | <a href=\"/recipe/".$r['titslug']."\" target=\"_blank\">".$r['title']."</a>";
echo 	" | ".$stage."</h4>";

}}
echo "<hr />";
}

$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, stage, timestamp FROM recipes WHERE stage=9 AND user_ID=? ORDER BY ID DESC");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result= $array->fetch_assoc();


if (!empty($result)){
	
echo "
<h3>Pending Recipes</h3>
<p>Published recipes which are not yet live - either at your request or awaiting approval.</p>";
foreach ($array as $r) {
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	
echo 	"<h4>".$date;
echo    " | <a href=\"/recipe/".$r['titslug']."\" target=\"_blank\">".$r['title']."</a></h4>";
}
echo "<hr />";
}


$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, timestamp FROM recipes WHERE stage=10 AND user_ID=? ORDER BY ID DESC");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result= $array->fetch_assoc();


if (!empty($result)){

echo "
<h3>Live Recipes</h3>";

foreach ($array as $r) {
	
if (isset($_GET['edit-public'])&&$r['ID']==($_GET['edit-public']))
{ 
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	
echo 	"<h4>";
echo "<a class=\"fa fa-pencil btn\" href=\"update_recipe.php?edit-recipe=".$r['ID']."\"></a> | ";
echo $date;
echo    " | <a href=\"/recipe/".$r['titslug']."\" target=\"_blank\">".$r['title']."</a></h4>";
?>
<div class="message">
<p>Editing this recipe will return it to an unpublished state.
<br />Are you sure you want to do this?</p>
<?php 
echo "<p><b><a href=\"/admin/includes/recipe_update/publish_post.php?unpublish=".$r['ID']."&resume-recipe=".$r['ID']."&resume-title=".$r['title']."\">
<span style=\"color:green\">YES</span></a> | <a href=\"/admin/user_profile.php\"><span style=\"color:red\">NO</span></a></b></p>
</div>";

}else{
 $new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	
echo 	"<h4>";
echo "<a class=\"fa fa-pencil btn\" href=\"user_profile.php?edit-public=".$r['ID']."\"></a> | ";
echo $date;
echo    " | <a href=\"/recipe/".$r['titslug']."\"target=\"_blank\">".$r['title']."</a></h4>";
	
	
}}
echo "<hr />";
}




?>
</div>
</div>
</div>
<h3>&nbsp &nbsp Go back to the <a href="/index.php">homepage</a>
<br />&nbsp &nbsp <a href="/logout">Log out</a></h3>
 
