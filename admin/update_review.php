<?php session_start();?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$revpath = "$path"."/assets/images/reviews";
$searchreview = "$path"."/admin/includes/search_review.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";

//paths to review includes
$editpost= "$path"."/admin/includes/review_update/edit_post.php";
$publishpost= "$path"."/admin/includes/review_update/publish_post.php";
//
$basicupdate = "$path"."/admin/includes/review_update/basic_update.php";
$introupdate = "$path"."/admin/includes/review_update/intro_update.php";
$reviewupdate = "$path"."/admin/includes/review_update/review_update.php";
$concupdate = "$path"."/admin/includes/review_update/conc_update.php";
//
$basicactions = "$path"."/admin/includes/review_update/basic_actions.php";
$introactions = "$path"."/admin/includes/review_update/intro_actions.php";
$reviewactions = "$path"."/admin/includes/review_update/review_actions.php";
$concactions = "$path"."/admin/includes/review_update/conc_actions.php";
//
$reviewdelete ="$path"."/admin/includes/review_update/review_delete.php";
$deleteactions="$path"."/admin/includes/review_update/delete_actions.php";


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

///////////EDIT POST SECTION/////////////

//on pressing 'EDIT POST' button
if (isset($_GET['edit-review'])) {
$post_id = $_GET['edit-review'];
include($editpost);
}
///////PUBLISH POST SECTION//////////
include($publishpost);

//////////UPDATE FORM SECTION/////////////

//BASIC UPDATE
if (isset($_GET['edit-basic'])) {
$post_id = $_GET['edit-basic'];
include($basicupdate);
}

//INTRO UPDATE
if (isset($_GET['edit-intro'])) {
$post_id = $_GET['edit-intro'];
include($introupdate);
}

//REVIEW 1 UPDATE
if (isset($_GET['edit-review1'])) {
$post_id = $_GET['edit-review1'];
$heading="heading1";
$image="image1";
$review="review1";
$caption="caption1";
$rating="rating1";
include($reviewupdate);
}

//REVIEW 2 UPDATE
if (isset($_GET['edit-review2'])) {
$post_id = $_GET['edit-review2'];
$heading="heading2";
$image="image2";
$review="review2";
$caption="caption2";
$rating="rating2";
include($reviewupdate);
}

//REVIEW 3 UPDATE
if (isset($_GET['edit-review3'])) {
$post_id = $_GET['edit-review3'];
$heading="heading3";
$image="image3";
$review="review3";
$caption="caption3";
$rating="rating3";
include($reviewupdate);
}

//REVIEW 4 UPDATE
if (isset($_GET['edit-review4'])) {
$post_id = $_GET['edit-review4'];
$heading="heading4";
$image="image4";
$review="review4";
$caption="caption4";
$rating="rating4";
include($reviewupdate);
}

//REVIEW 5 UPDATE
if (isset($_GET['edit-review5'])) {
$post_id = $_GET['edit-review5'];
$heading="heading5";
$image="image5";
$review="review5";
$caption="caption5";
$rating="rating5";
include($reviewupdate);
}

//REVIEW 6 UPDATE
if (isset($_GET['edit-review6'])) {
$post_id = $_GET['edit-review6'];
$heading="heading6";
$image="image6";
$review="review6";
$caption="caption6";
$rating="rating6";
include($reviewupdate);
}

//REVIEW 7 UPDATE
if (isset($_GET['edit-review7'])) {
$post_id = $_GET['edit-review7'];
$heading="heading7";
$image="image7";
$review="review7";
$caption="caption7";
$rating="rating7";
include($reviewupdate);
}

//REVIEW 8 UPDATE
if (isset($_GET['edit-review8'])) {
$post_id = $_GET['edit-review8'];
$heading="heading8";
$image="image8";
$review="review8";
$caption="caption8";
$rating="rating8";
include($reviewupdate);
}

/////////DELETE REVIEW SECTION/////////

//REVIEW 4 UPDATE
if (isset($_GET['delete-review4'])) {
$post_id = $_GET['delete-review4'];
$heading="heading4";
$image="image4";
$review="review4";
$caption="caption4";
$rating="rating4";
include($reviewdelete);
}

//REVIEW 5 UPDATE
if (isset($_GET['delete-review5'])) {
$post_id = $_GET['delete-review5'];
$heading="heading5";
$image="image5";
$review="review5";
$caption="caption5";
$rating="rating5";
include($reviewdelete);
}

//REVIEW 6 UPDATE
if (isset($_GET['delete-review6'])) {
$post_id = $_GET['delete-review6'];
$heading="heading6";
$image="image6";
$review="review6";
$caption="caption6";
$rating="rating6";
include($reviewdelete);
}

//REVIEW 7 UPDATE
if (isset($_GET['delete-review7'])) {
$post_id = $_GET['delete-review7'];
$heading="heading7";
$image="image7";
$review="review7";
$caption="caption7";
$rating="rating7";
include($reviewdelete);
}

//REVIEW 8 UPDATE
if (isset($_GET['delete-review8'])) {
$post_id = $_GET['delete-review8'];
$heading="heading8";
$image="image8";
$review="review8";
$caption="caption8";
$rating="rating8";
include($reviewdelete);
}

//CONCLUSIONS UPDATE
if (isset($_GET['edit-conclusion'])) {
$post_id = $_GET['edit-conclusion'];
include($concupdate);
}

//////////ACTION FORM SECTION/////////////

//BASIC ACTIONS
if (isset ($_POST['update-basic'])) {
	include($basicactions);
	exit();
}

//INTRODUCTION ACTIONS
if (isset ($_POST['update-intro'])) {
	include($introactions);
	exit();
}

//REVIEW ACTIONS
if (isset ($_POST['update-review'])) {
	include($reviewactions);
	exit();
}

//CONCLUSION ACTIONS
if (isset ($_POST['update-conc'])) {
	include($concactions);
	exit();
}

//DELETE ACTIONS
if (isset ($_POST['delete-review'])) {
	include($deleteactions);
	exit();
}

/////////////// REVIEW SELECT SECTION //////////////////////

if (!empty($_POST['search'])) {	
require_once($searchreview);
$listing="Search Results for \"".$_POST['search']."\":";

}else{
	
$ID=$_SESSION['ID'];
$stmt=$conn->prepare("SELECT * from reviews");
$stmt ->execute();
$result=$stmt->get_result();
$listing="All Reviews:";
$num_results = $result->num_rows;
}


echo"<h1>Review Update Tool</h1><hr>";

if ($num_results===0){
echo"<h3>".$listing."</h3><h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

echo "<h3>".$listing."</h3>";
echo "<table>";

foreach ($result as $r) { 
echo	"<tr>
		<td><a href=\"/reviews/".$r['slug']."\"<h2>".$r['title']."</h2></a></td>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_review.php?edit-review=".$r['ID']."\"></a></td>
		</tr>";
}}


?>

</table>
<hr>
<form action="/admin/update_review.php" method="POST" enctype="multipart/form-data">
<h3>Check a box or enter a search term:</h3>
<h4>Enter search term: <input type="text" name="search"/></h4>


<input type="submit" class="button" name="showtell" value="List Reviews" />
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


