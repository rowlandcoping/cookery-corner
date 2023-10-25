<?php if(!isset($_SESSION)){session_start();}

$path = $_SERVER['DOCUMENT_ROOT'];
$logout=$path."/logout";
$config = "$path"."/config.php";
$searchquery = "$path"."/admin/includes/search_query.php";
$loginpath = "$path"."/publiclogin.php";
$head= "$path"."/admin/includes/head_admin.php";

if (!isset($_SESSION['loggedin'])) {
	include($loginpath);
	exit();
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
<html>
<?php

require_once($head);
require_once($config);

if(!empty($_POST['user'])) {$userrec=$_POST['user'];}
if(!empty($_POST['all'])) {$allrec=$_POST['all'];}
$stmt=$conn->prepare("SELECT ID, title, titslug, stage FROM recipes WHERE stage<9 AND user_ID=?");
$stmt->bind_param("s", $_SESSION['ID']);
$stmt->execute();
$array = $stmt->get_result();
$listing= "<h3>".$_SESSION['name']."'s Incomplete Recipes</h3>";


if (!empty($_POST['search'])) {
	
require_once($searchquery);
$listing="Search Results for \"".$_POST['search']."\":";

}else{
		
if (!empty($userrec)) {
$stmt=$conn->prepare("SELECT ID, title, titslug, stage from recipes WHERE user_ID=? AND stage<9");
$stmt ->bind_param("s", $_SESSION['ID']);
$stmt ->execute();
$array=$stmt->get_result();
$listing="Your Recipes:";	
}else{if (!empty($allrec)) {
$stmt=$conn->prepare("SELECT ID, title, titslug, stage from recipes WHERE stage<9");
$stmt ->execute();
$array=$stmt->get_result();
$listing="All Recipes:";
}}}
if (!empty($_POST['search']))
{$num_results = 0;
foreach ($array as $r) {
$try=$conn->prepare("SELECT ID FROM recipes where ID=? AND stage<9");
$try->bind_param("s", $r['ID']);
$try->execute();
$number=$try->get_result();
$outcome=$number->fetch_assoc();
if (!empty($outcome)){$num_results++;}
}}else{$num_results=$array->num_rows;}
echo"<h1>Finish Incomplete Recipes</h1><hr />";


if ((!empty($userrec))&&(!empty($allrec))&&(!empty($_POST['search']))) {
echo "<h3><span style=\"color:red;\">You have tried to search using everything.  What did you think would happen here?</span></h3>";
}else{ 

if ((!empty($userrec))&&(!empty($allrec))) {
echo "<h3><span style=\"color:red;\">You have ticked both boxes, please make your mind up.</span></h3>";
}else{if ($num_results===0){
echo"<h3>".$listing."</h3><h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

if (!empty($array)){
echo "<h3>".$listing."</h3>";

foreach ($array as $r) {

if (!empty($_POST['search'])) {
	
$stmt=$conn->prepare("SELECT ID, titslug, title, stage FROM recipes where ID=? AND stage<9");
$stmt->bind_param("s", $r['ID']);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();
if (!empty($result)){

if ($result['stage']===2) {$stage="ingredients";}
if ($result['stage']===3) {$stage="introduction";}
if ($result['stage']===4) {$stage="recipe stage 1";}
if ($result['stage']===5) {$stage="recipe stage 2 (optional)";}
if ($result['stage']===6) {$stage="recipe stage 3 (optional)";}
if ($result['stage']===7) {$stage="summary";}
if ($result['stage']===8) {$stage="review and submit";}

echo 	"<h4><a class=\"fa fa-pencil btn \" href=\"/admin/recipe_entry.php?resume-recipe=".$result['ID']."&resume-title=".$result['title']."\"></a>
		"; 
echo	"&nbsp|&nbsp <a href=\"/admin/recipe_entry.php?resume-recipe=".$result['ID']."&resume-title=".$result['title']."\">".$result['title']."</a>";
echo 	"&nbsp|&nbsp".$stage."</h4>";

}}else{
	
	if ($r['stage']===2) {$stage="ingredients";}
if ($r['stage']===3) {$stage="introduction";}
if ($r['stage']===4) {$stage="recipe stage 1";}
if ($r['stage']===5) {$stage="recipe stage 2 (optional)";}
if ($r['stage']===6) {$stage="recipe stage 3 (optional)";}
if ($r['stage']===7) {$stage="summary";}
if ($r['stage']===8) {$stage="review and submit";}

echo 	"<h4><a class=\"fa fa-pencil btn \" href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\"></a>
		"; 
echo	"&nbsp|&nbsp <a href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\">".$r['title']."</a>";
echo 	"&nbsp|&nbsp".$stage."</h4>";
}}}}}}

?>
<hr>
<form action="/admin/incomplete_recipes.php" method="POST" enctype="multipart/form-data">
<h3>Check a box or enter a search term:</h3>
<h4>List your incomplete recipes: <input type="checkbox" name="user" value="user"></h4>
<h4>List all incomplete recipes: <input type="checkbox" name="all" value="all"></h4>
<h4>Enter search term: <input type="text" name="search"/></h4>


<input type="submit" class="button" name="showtell" value="List Recipes" />
</form>
<hr>
<h4><a href="\admin\admin.php">Return to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></h4>
