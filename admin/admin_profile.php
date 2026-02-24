<?php if(!isset($_SESSION)){session_start();}

$path = $_SERVER['DOCUMENT_ROOT'];
$loginpath = "$path"."/publiclogin.php";
$logout=$path."/logout";
$config = $path."/config.php";
$head= "$path"."/admin/includes/head_admin.php";
$ID=$_SESSION['ID'];
require_once($config);
require_once($head);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
<html>
<?php
ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);

?>
<div class=overall>

<div class=user>
	

<?php
//RESPOND TO REQUESTS
if (isset($_POST['request-reply'])) {
	
$ID=$_POST['ID'];
$reply=$_POST['reply'];	
$stmt=$conn->prepare("SELECT user_ID, user, userslug, message FROM notifications WHERE ID=?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array = $stmt->get_result();
$result= $array->fetch_assoc();	
$user_ID= $result['user_ID'];
$user= $result['user'];
$userslug= $result['userslug'];
$message=$result['message'];


$subject="Request Response";
if (!empty($_POST['reply'])) {$message="<p>".$reply."</p><p>-------------</p>".$result['message'];	
	}else{$message="<p>The below request has been approved and the database updated.</p>".$result['message'];}
$type="6";
$admin="0";
$stmt= $conn->prepare("INSERT INTO notifications (user_ID, user, userslug, subject, message, type, admin) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $user_ID, $user, $userslug, $subject, $message, $type, $admin);
$stmt->execute();
$stmt=$conn->prepare("DELETE FROM notifications WHERE ID=?");
$stmt->bind_param ("s", $ID);
$stmt->execute();

//notification e-mail
$stmt = $conn->prepare("SELECT email, e_request from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result2=$array->fetch_assoc();
$email=$result2['email'];
$e_request=$result2['e_request'];

if ($e_request=="1"){
    require($path . "/mailconfig.php");
    try {
        $mail = createMailer();
        $mail->addAddress($email);
        $mail->Subject = "Cookery Corner request reviewed";
        $mail->Body    = "<p>".$message."</p>";
        $mail->send();
    } catch (Exception $e) {
        $errormess = "Mailer error: " . $mail->ErrorInfo;
    }
}}

?>
	
<div class=information>	
<h1>Cookery Corner Management Tool</h1>
<hr />
<?php if (!empty($message)){echo "<h3><span style=\"color:red\";>".$message."</span></h3><hr/>";}?>
<div class="profilecont">

<div class="menutree">
<?php
//PROFILE MENU TREE

if (isset($_GET['profile-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php\"></a> Profile</h2>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_profile.php?update-profile=".$_SESSION['ID']."\"></a> Update Profile</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/notifications.php\"></a> Notification Settings</h3>
			<h3 class=\"indent\"><a class=\"fa fa-trash btn\" href=\"/admin/delete_messages.php\"></a> Delete Messages</h3>";
			}else{echo "<h2><a class=\"fa fa-angle-double-right\" href=\"/admin/admin_profile.php?profile-options\"></a> Profile</h2>";}



//RECIPE MENU TREE

if (isset($_GET['recipe-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php\"></a> Recipes</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_entry.php?create-recipe\"></a> Add new recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/incomplete_recipes.php\"></a> Complete recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_recipe.php\"></a> Update recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?recipe-info\"></a> Add recipe info</h3>			
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?info-update\"></a> Update recipe info</h3>";
}else {if  (isset($_GET['recipe-info'])) {echo"
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php\"></a> Recipes</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_entry.php?create-recipe\"></a> Add new recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/incomplete_recipes.php\"></a> Complete recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_recipe.php\"></a> Update recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?recipe-info-reduce\"></a> Add recipe info</h3>
						<h3 class=\"indent2\"><a class=\"fa fa-plus btn\" href=\"/admin/ingrediententry.php\"></a> Add new ingredient</h3>
						<h3 class=\"indent2\"><a class=\"fa fa-plus btn\" href=\"/admin/cuisineentry.php\"></a> Add new cuisine</h3>
						<h3 class=\"indent2\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_categoryentry.php\"></a> Add new category</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?info-update\"></a> Update recipe info</h3>";}
else{if (isset($_GET['recipe-info-reduce'])) {echo "
		<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php\"></a> Recipes</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_entry.php?create-recipe\"></a> Add new recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/incomplete_recipes.php\"></a> Complete recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_recipe.php\"></a> Update recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?recipe-info\"></a> Add recipe info</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?info-update\"></a> Update recipe info</h3>";
}else{if (isset($_GET['info-update'])) {echo "
		<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php\"></a> Recipes</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_entry.php?create-recipe\"></a> Add new recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/incomplete_recipes.php\"></a> Complete recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_recipe.php\"></a> Update recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?recipe-info\"></a> Add recipe info</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?update-info-reduce\"></a> Update recipe info</h3>
						<h3 class=\"indent2\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_ingredient.php\"></a> Update ingredient</h3>
						<h3 class=\"indent2\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_cuisine.php\"></a> Update cuisine</h3>
						<h3 class=\"indent2\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_category.php\"></a> Update category</h3>";
}else{if (isset($_GET['update-info-reduce'])) {echo "
		<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php\"></a> Recipes</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/recipe_entry.php?create-recipe\"></a> Add new recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/admin_profile.php?complete-recipe\"></a> Complete recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_recipe.php\"></a> Update recipe</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?recipe-info\"></a> Add recipe info</h3>
			<h3 class=\"indent\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?info-update\"></a> Update recipe info</h3>";
}else{ echo "<h2><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?recipe-options\"></a> Recipes</h2>";}}}}}
			
//REVIEW MENU TREE			

if (isset($_GET['review-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?review-reduce\"></a> Reviews</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/reviewentry.php\"></a> Add new review</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_review.php\"></a> Update review</h3>";
}else{echo "<h2><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?review-options\"></a> Reviews</h2>";}


//BLOG MENU TREE
if (isset($_GET['blog-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?blog-reduce\"></a> Blog</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/blogentry.php\"></a> Add new blog post</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_blog.php\"></a> Update blog post</h3>";
}else{echo "<h2><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?blog-options\"></a> Blog</h2>";}

//LIVE BLOG MENU TREE
if (isset($_GET['liveblog-options'])) {echo "
			<h2><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?liveblog-reduce\"></a> Live blog</h2>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/liveblog_entry.php\"></a> Add new live blog</h3>
			<h3 class=\"indent\"><a class=\"fa fa-plus btn\" href=\"/admin/liveblog_update.php\"></a> Add new live blog post</h3>
			<h3 class=\"indent\"><a class=\"fa fa-pencil btn\" href=\"/admin/update_liveblog.php\"></a> Update live blog</h3>
			<h3 class=\"indent\"><a class=\"fa fa-trash btn\" href=\"/admin/delete_contrib.php\"></a> Delete user contributions</h3>";
}else{echo "<h2><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?liveblog-options\"></a> Live blog</h2>";}

?>
</div>
<div class ="profileimg">

<?php 
$ID=$_SESSION['ID'];
$stmt=$conn->prepare("SELECT ID, name, slug, food_pro, profile_pic, profile, email FROM users WHERE ID=?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();
if (!empty($result['profile_pic'])) {$profile_pic=$result['profile_pic'];}

?>
	<h2><?php echo $result['name']?></h2>

<?php

if (!empty($profile_pic)) {echo "<img class=\"segment\" src=\"/assets/images/profile/".$profile_pic."\" width=\"200\"/>";
}else{echo "<img class=\"segment\" src=\"/assets/images/testcard.jpeg\" width=\"200\"/>";}
?>

</div>
</div>
<hr />
<h3>Notifications:</h3>

<?php
$ID= $_SESSION['ID'];

if (isset($_GET['delete-notification'])) {

$not_ID=$_GET['delete-notification'];

$stmt=$conn->prepare("DELETE FROM notifications WHERE ID=?");
$stmt->bind_param("s", $not_ID);
$stmt->execute();
}

$stmt=$conn->prepare("SELECT ID, user_ID, recipe_ID, user, userslug, title, slug, subject, message, type, timestamp FROM notifications WHERE admin=1 OR user_ID=? ORDER BY timestamp DESC");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();


if ($result) {
	
$check=$conn->prepare("SELECT e_contact, e_urgent, e_request, e_pending, e_approval, contact, pending, approval FROM users WHERE ID=?");
$check->bind_param("i", $ID);
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
<div class="from">From</div>
<div class="bar">|</div>
<div class="title">Content</div>
</div>	

<?php

foreach ($array as $r) {
	
if ($r['type']===2 && $pending=="0") {continue;}
if ($r['type']===3 && $approval=="0")  {continue;}
if ($r['type']===5 && $contact=="0")  {continue;}
	
	


$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	



//if view message selected

if (isset($_GET['view-message'])&&$r['ID']==($_GET['view-message'])) {
echo "<div class=\"msgbar\">";
echo "<div class=\"close\"><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?message-reduce\"></a></div><div class=\"bar\">|</div>";

if ($r['type']===1) 
{ echo "<div class=\"icon\"><a href=\"/admin/recipe_entry.php?resume-recipe=".$r['recipe_ID']."&resume-title=".$r['title']."\"><img src=\"/assets/logos/exclam.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===2) 
{ echo "<div class=\"icon\"><a href=\"/admin/update_recipe.php?edit-recipe=".$r['recipe_ID']."&user-id=".$r['user_ID']."\"><img src=\"/assets/logos/clock.jpg\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===3) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/check.png\" width=\"20\" /></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===4)
{ echo "<div class=\"icon\"><a href=\"/admin/admin_profile.php?respond-request=".$r['ID']."&user-id=".$r['user_ID']."\"><img src=\"/assets/logos/question.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";	
}else{ if ($r['type']===5)
{ echo "<div class=\"icon\"><img src=\"/assets/logos/message.png\" width=\"20\" /></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===6) 
{ echo "<div class=\"icon\"><img src=\"/assets/logos/check.png\" width=\"20\" /></div><div class=\"bar\">|</div>";
}}}}}}

echo "<div class=\"date\"><b>".$date."</b></div><div class=\"bar\">|</div>";
echo "<div class=\"subject\">".$r['subject']."</div><div class=\"bar\">|</div>";
if (!empty($r['userslug'])) {echo "<div class=\"from\"><a href=\"/author/".$r['userslug']."\"target=\"blank\">".$r['user']."</a></div><div class=\"bar\">|</div>";}
else{echo "<div class=\"from\">".$r['user']."</div><div class=\"bar\">|</div>";}	
if (!empty($r['recipe_ID'])) {echo "<div class=\"title\"><a href=\"/recipe/".$r['slug']."\" target=\"blank\">".$r['title']."</a></div></div>";}
else{echo "<div class=\"title\"><a href=\"/liveblog/".$r['slug']."\" target=\"blank\">".$r['title']."</a></div></div>";}

//message content
echo "<div class=\"message\">";
echo $r['message'];
echo "<a href=\"/admin/admin_profile.php?delete-notification=".$r['ID']."\">Remove notifiction</a></div>";
}else{
	
//respond to request

if (isset($_GET['respond-request'])&&$r['ID']==($_GET['respond-request']))
{
echo "<div class=\"msgbar\">";
echo "<div class=\"close\"><a class=\"fa fa-angle-double-down btn\" href=\"/admin/admin_profile.php?message-reduce\"></a></div><div class=\"bar\">|</div>";

if ($r['type']===1) 
{ echo "<div class=\"icon\"><a href=\"/admin/recipe_entry.php?resume-recipe=".$r['recipe_ID']."&resume-title=".$r['title']."\"><img src=\"/assets/logos/exclam.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===2) 
{ echo "<div class=\"icon\"><a href=\"/admin/update_recipe.php?edit-recipe=".$r['recipe_ID']."&user-id=".$r['user_ID']."\"><img src=\"/assets/logos/clock.jpg\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===3) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/check.png\" width=\"20\" /></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===4)
{ echo "<div class=\"icon\"><a href=\"/admin/admin_profile.php?respond-request=".$r['ID']."&user-id=".$r['user_ID']."\"><img src=\"/assets/logos/question.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";		
}else{ if ($r['type']===5)
{ echo "<div class=\"icon\"><img src=\"/assets/logos/message.png\" width=\"20\" /></div><div class=\"bar\">|</div>";
{ if ($r['type']===6) 
{ echo "<div class=\"icon\"><img src=\"/assets/logos/check.png\" width=\"20\" /></div><div class=\"bar\">|</div>";
}}}}}}}
echo "<div class=\"date\"><b>".$date."</b></div><div class=\"bar\">|</div>";
echo "<div class=\"subject\">".$r['subject']."</div><div class=\"bar\">|</div>";
if (!empty($r['userslug'])) {echo "<div class=\"from\"><a href=\"/author/".$r['userslug']."\"target=\"blank\">".$r['user']."</a></div><div class=\"bar\">|</div>";}
else{echo "<div class=\"from\">".$r['user']."</div><div class=\"bar\">|</div>";}
if (!empty($r['recipe_ID'])) {echo "<div class=\"title\"><a href=\"/recipe/".$r['slug']."\" target=\"blank\">".$r['title']."</a></div></div>";}
else{echo "<div class=\"title\"><a href=\"/liveblog/".$r['slug']."\" target=\"blank\">".$r['title']."</a></div></div>";}

echo "<div class=\"message\">";
echo $r['message'];
?>
<p><form action="/admin/admin_profile.php" method="POST" enctype="multipart/form-data">
<input id="ID" type="hidden" name="ID" size="1" value="<?php echo $r['ID'];?>" readonly/>		
<textarea id="reply" name="reply" cols="50" rows="5"></textarea></p>
<label for="Submit"><input type="submit" class="button" name="request-reply" value="Respond" /></p>
</form>
<?php
echo "<a href=\"/admin/admin_profile.php?delete-notification=".$r['ID']."\">Remove notifiction</a></div>";
}else{

//if message not selected

echo "<div class=\"subjectbar\">";
echo "<div class=\"open\"><a class=\"fa fa-angle-double-right btn\" href=\"/admin/admin_profile.php?view-message=".$r['ID']."\"></a></div><div class=\"bar\">|</div>";

if ($r['type']===1) 
{ echo "<div class=\"icon\"><a href=\"/admin/recipe_entry.php?resume-recipe=".$r['recipe_ID']."&resume-title=".$r['title']."\"><img src=\"/assets/logos/exclam.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===2) 
{ echo "<div class=\"icon\"><a href=\"/admin/update_recipe.php?edit-recipe=".$r['recipe_ID']."&user-id=".$r['user_ID']."\"><img src=\"/assets/logos/clock.jpg\" width=\"20\"></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===3) 
{ echo "<div class=\"icon\"><a href=\"/recipe/".$r['slug']."\" target=\"_blank\"><img src=\"/assets/logos/check.png\" width=\"20\" /></a></div><div class=\"bar\">|</div>";
}else{ if ($r['type']===4)
{ echo "<div class=\"icon\"><a href=\"/admin/admin_profile.php?respond-request=".$r['ID']."&user-id=".$r['user_ID']."\"><img src=\"/assets/logos/question.png\" width=\"20\"></a></div><div class=\"bar\">|</div>";	
}else{ if ($r['type']===5)
{ echo "<div class=\"icon\"><img src=\"/assets/logos/message.png\" width=\"20\" /></div><div class=\"bar\">|</div>";	
}else{ if ($r['type']===6)
{ echo "<div class=\"icon\"><img src=\"/assets/logos/check.png\" width=\"20\"></div><div class=\"bar\">|</div>";
}}

}}}}
echo "<div class=\"date\"><b>".$date."</b></div><div class=\"bar\">|</div>";
echo "<div class=\"subject\">".$r['subject']."</div><div class=\"bar\">|</div>";
if (!empty($r['userslug'])) {echo "<div class=\"from\"><a href=\"/author/".$r['userslug']."\"target=\"blank\">".$r['user']."</a></div><div class=\"bar\">|</div>";}
else{echo "<div class=\"from\">".$r['user']."</div><div class=\"bar\">|</div>";}
if (!empty($r['recipe_ID'])) {echo "<div class=\"title\"><a href=\"/recipe/".$r['slug']."\" target=\"blank\">".$r['title']."</a></div></div>";}
else{echo "<div class=\"title\"><a href=\"/liveblog/".$r['slug']."\" target=\"blank\">".$r['title']."</a></div></div>";}
}
}}echo "</div>";}else{echo "<h4>You have nothing of which to be notified...</h4>";}

	
?>

<hr />



<?php


$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, stage FROM recipes WHERE stage<9 AND user_ID=? ORDER BY ID DESC");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result= $array->fetch_assoc();


if (!empty($result)){
echo"<h3>Update Incomplete Recipes:</h3>";
foreach ($array as $r) {

if ($r['stage']===2) {$stage="ingredients";}
if ($r['stage']===3) {$stage="introduction";}
if ($r['stage']===4) {$stage="recipe stage 1";}
if ($r['stage']===5) {$stage="recipe stage 2 (optional)";}
if ($r['stage']===6) {$stage="recipe stage 3 (optional)";}
if ($r['stage']===7) {$stage="summary";}
if ($r['stage']===8) {$stage="review and submit";}

echo 	"<h4><a class=\"fa fa-pencil btn \" href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\"></a>
		"; 
echo	" | <a href=\"/recipe/".$r['titslug']."\"<h2 class=\"result\">".$r['title']."</a>";
echo 	" | ".$stage;

}
echo "<hr />";
}

$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, stage, timestamp FROM recipes WHERE stage=9 AND user_ID=? ORDER BY ID DESC");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result= $array->fetch_assoc();


if (!empty($result)){
	
echo "
<h3>Pending Recipes:</h3>";
foreach ($array as $r) {
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	
echo 	"<h4>";
echo "<a class=\"fa fa-pencil btn\" href=\"update_recipe.php?edit-recipe=".$r['ID']."\"></a> | ";
echo $date;
echo    " | <a href=\"/recipe/".$r['titslug']."\"<h2 class=\"result\">".$r['title']."</a></h4>";
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
<h3>Live Recipes:</h3>";
foreach ($array as $r) {
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y');	
echo 	"<h4>";
echo "<a class=\"fa fa-pencil btn\" href=\"update_recipe.php?edit-recipe=".$r['ID']."\"></a> | ";
echo $date;
echo    " | <a href=\"/recipe/".$r['titslug']."\"<h2 class=\"result\">".$r['title']."</a></h4>";
}
echo "<hr />";
}




?>
</div>



</div>
</div>
<h3>&nbsp &nbsp Go back to the <a href="/index.php">homepage</a>
<br />&nbsp &nbsp <a href="/logout">Log out</a></h3>
