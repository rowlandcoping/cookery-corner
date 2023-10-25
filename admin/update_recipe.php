<?php session_start();
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/recipes";
$searchquery = "$path"."/admin/includes/search_query.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
$commonincludes = $path."/admin/includes/update_includes.php";
$returnhome=$path."/admin/update_recipe.php";

//paths to recipe includes
$editpost= "$path"."/admin/includes/recipe_update/edit_post.php";
$publishpost= "$path"."/admin/includes/recipe_update/publish_post.php";
//path to approval includes (rejection)
$rejectrecipe="$path"."/admin/includes/recipe_update/reject_recipe.php";
$rejectactions="$path"."/admin/includes/recipe_update/reject_actions.php";

include($commonincludes);
require_once($config);
require_once($head);


function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

function longSlug(String $string, $string2){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace("-", ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string.'-'.$string2);
	return $slug;
}

function makeservSlug(String $string){
	$string = strtolower($string);
	$serslug = ('serves-'.$string);
	return $serslug;
}

///////////EDIT POST SECTION/////////////

//on pressing 'EDIT POST' button
if (isset($_GET['edit-recipe'])) {
$post_id = $_GET['edit-recipe'];
include($editpost);
}
///////PUBLISH POST SECTION//////////
include($publishpost);

//////////UPDATE FORM SECTION/////////////

//BASIC INFO UPDATE
if (isset($_GET['edit-basic'])) {
$post_id = $_GET['edit-basic'];
include($basicupdate);
}

//IMAGE UPDATE
if (isset($_GET['edit-image'])) {
$post_id = $_GET['edit-image'];
include($imageupdate);
}

//INGREDIENTS UPDATE
if (isset ($_GET['edit-ingredients'])) {
$recipe_ID=$_GET['edit-ingredients'];
include ($ingredientsentry);
exit();
}



//add ingredient
if (isset ($_GET['ingredient-add'])) {
$recipe_ID=$_GET['ingredient-add'];
$display_order=$_GET['display-order'];
$form_ID="add";
include ($ingredientsentry);
exit();
}

//edit ingredient
if (isset ($_GET['edit-ingredient'])) {
$ID= $_GET['edit-ingredient'];
$recipe_ID= $_GET['recipe-id'];
$form_ID="edit";
include ($ingredientsentry);
exit();
}

//delete ingredient
if (isset ($_GET['delete-ingredient'])) {
$ID= $_GET['delete-ingredient'];
$recipe_ID= $_GET['recipe-id'];
$order=$_GET['display-order'];
$form_ID="delete";
include ($ingredientsentry);
exit();
}

//add notes
if (isset ($_GET['ingredient-notes'])) {
$recipe_ID= $_GET['ingredient-notes'];
$form_ID="notes";
include ($ingredientsentry);
exit();
}

//display order

if (isset ($_GET['order-up'])) {
$ID=$_GET['order-up'];
$display_order=$_GET['display-order'];
$recipe_ID=$_GET['recipe-id'];
$form_ID="up";
include ($displayorder);
include ($ingredientsentry);

exit();
}

if (isset ($_GET['order-down'])) {
$ID=$_GET['order-down'];
$display_order=$_GET['display-order'];
$recipe_ID=$_GET['recipe-id'];
$form_ID="down";
include ($displayorder);
include ($ingredientsentry);

exit();
}
/*if (isset($_GET['edit-ingredients'])) {
$post_id = $_GET['edit-ingredients'];
include($ingredientupdate);
}*/

//CONTENT UPDATE
if (isset($_GET['edit-content'])) {
$post_id = $_GET['edit-content'];
include($contentupdate);
}
//REJECT RECIPE
if (isset ($_GET['reject-recipe'])) {
$recipe_ID=$_GET['reject-recipe'];
$user_ID=$_GET['user-id'];
$form_ID="reject";
include ($editpost);
exit();
}





//////////ACTION FORM SECTION/////////////

//BASIC ACTIONS
if (isset($_POST['update-basic'])) {
include($basicact);
}

//IMAGE ACTIONS
if (isset($_POST['image'])) {
include($imageactions);
}

//INGREDIENTS ACTIONS
if (isset ($_POST['action-ingredient'])) {
include ($ingredientsactions);
exit();
}

if (isset($_GET['finish-update'])) {
$post_id= $_GET['recipe_ID'];
$updated="Ingredients updated";
include ($editpost);
exit();
}

//include($ingredientactions);

//CONTENT ACTIONS
include($contentactions);

//REJECT ACTIONS
if (isset ($_POST ['action-reject'])){
include ($rejectactions);
exit();
}

/////////////// RECIPE SELECT SECTION //////////////////////
$ID=$_SESSION['ID'];

if (!isset($_POST['do-search'])) {
if (isset($_GET['user-id'])) {$user_ID=$_GET['user-id'];}

if (!empty($user_ID)) {
//show user submitted recipes
echo"<h1>Recipe Update Tool</h1><hr />";
if (!empty($updated)) {echo "<hr><h2><span style=\"color:red\">".$updated."</span></h2><hr>";}

$stmt="SELECT ID, user_name, titslug, title, description, timestamp FROM recipes where stage=9";
$array=$conn->query($stmt);
$result=$array->fetch_assoc();
$listing="Pending Recipes:";

if(!empty($result)){
	echo "<h3>".$listing."</h3>";
echo "<table>";
	foreach ($array as $r) {
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$date = $new_date->format('d/m/y | H:i');	
		
echo	"<tr>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_recipe.php?edit-recipe=".$r['ID']."&user-id=".$user_ID."\"></a></td>";
echo	"<td> | ".$date."</td>";
echo	"<td> | <a href=\"/recipe/".$r['titslug']."\" target=\"_blank\">".$r['title']."</a></td>";
echo	"<td> | ".$r['user_name']."</td>";

echo	"</tr>";
}
echo "</table>";
}
echo "<hr /><h4><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
exit();

}else{
$listing="Your Recipes:";
echo"<h1>Recipe Update Tool</h1><hr />";

$stmt=$conn->prepare("SELECT ID, titslug, title, rec_image, description FROM recipes where user_ID=? AND stage>8");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();


if(!empty($result)){
	echo "<h3>".$listing."</h3>";
echo "<table>";
	foreach ($array as $r) {
		
echo	"<tr>
		<td><a href=\"/recipe/".$r['titslug']."\"<h2 class=\"result\">".$r['title']."</h2></a></td>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_recipe.php?edit-recipe=".$r['ID']."\"></a></td>
		</tr>";
}
echo "</table>";
}
}}else{if (isset($_POST['do-search'])) {

if(!empty($_POST['user'])) {$userrec=$_POST['user'];}
if(!empty($_POST['all'])) {$allrec=$_POST['all'];}
if ((!empty($userrec))&&(!empty($allrec))&&(!empty($_POST['search']))) {
echo "<h3><span style=\"color:red;\">You have tried to search using everything.  What did you think would happen here?</span></h3>";
}else{ 

if ((!empty($userrec))&&(!empty($allrec))) {
echo "<h3><span style=\"color:red;\">You have ticked both boxes, please make your mind up.</span></h3>";
}else{


if (!empty($_POST['search'])) {
	

	
$listing="Search Results for \"".$_POST['search']."\":";


require_once($searchquery);




$num_results = 0;
foreach ($array as $r) {
$try=$conn->prepare("SELECT ID FROM recipes where ID=? AND stage>8");
$try->bind_param("s", $r['ID']);
$try->execute();
$number=$try->get_result();
$outcome=$number->fetch_assoc();
if (!empty($outcome)){$num_results++;}
}

if ($num_results===0){echo "<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{echo "<h3>".$listing."</h3>";
echo "<table>";

foreach ($array as $r) {

$stmt=$conn->prepare("SELECT ID, titslug, title, rec_image, description FROM recipes where ID=? AND stage>8");
$stmt->bind_param("s", $r['ID']);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();

if(!empty($result)){	
echo	"<tr>
		<td><a href=\"/recipe/".$result['titslug']."\"<h2 class=\"result\">".$result['title']."</h2></a></td>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_recipe.php?edit-recipe=".$result['ID']."\"></a></td>
		</tr>";
}}
}
}

if (!empty($userrec)) {

$stmt=$conn->prepare("SELECT ID, title, titslug from recipes WHERE user_ID=? AND stage>8");
$stmt ->bind_param("s", $ID);
$stmt ->execute();
$array=$stmt->get_result();
$listing="Your Recipes:";
$num_results=$array->num_rows;
if ($num_results===0){echo "<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

echo "<h3>".$listing."</h3>";
echo "<table>";
foreach ($array as $r) { 
echo	"<tr>
		<td><a href=\"/recipe/".$r['titslug']."\"<h2 class=\"result\">".$r['title']."</h2></a></td>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_recipe.php?edit-recipe=".$r['ID']."\"></a></td>
		</tr>";	
}
}
}


if (!empty($allrec)) {
$stmt=$conn->prepare("SELECT ID, title, titslug from recipes WHERE stage>8");
$stmt ->execute();
$array=$stmt->get_result();
$listing="All Recipes:";
$num_results=$array->num_rows;
if ($num_results===0){echo "<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{
echo "<h3>".$listing."</h3>";
echo "<table>";
foreach ($array as $r) { 
echo	"<tr>
		<td><a href=\"/recipe/".$r['titslug']."\"<h2 class=\"result\">".$r['title']."</h2></a></td>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_recipe.php?edit-recipe=".$r['ID']."\"></a></td>
		</tr>";
}
}
}
}}
}}



/*if ((empty($userrec))&&(empty($allrec))&&(empty($_POST['search']))) {
echo "<h3><span style=\"color:red;\">You have searched for nothing, and you have found nothing.</span></h3>";
}else{*/


?>

</table>
<hr>
<form action="/admin/update_recipe.php" method="POST" enctype="multipart/form-data">
<h3>Check a box or enter a search term:</h3>
<h4>List your recipes: <input type="checkbox" name="user" value="user"></h4>
<h4>List all recipes: <input type="checkbox" name="all" value="all"></h4>
<h4>Enter search term: <input type="text" name="search"/></h4>


<input type="submit" class="button" name="do-search" value="List Recipes" />
</form>
<hr>
<h4><a href="\admin\admin.php">Return to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></h4>
<?php

/* if user clicks the Delete post button (do we really want this so EASY???)
if (isset($_GET['delete-recipe'])) {
$post_id = $_GET['delete-recipe'];
deletePost($post_id);
}

function deletePost($post_id)
{
global $conn;
$sql = "DELETE FROM recipes WHERE ID=$post_id";
if (mysqli_query($conn, $sql)) {
$_SESSION['message'] = "Post successfully deleted";
exit(0);
}
}*/




