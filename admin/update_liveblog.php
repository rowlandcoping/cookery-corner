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
$blogpath = "$path"."/assets/images/liveblog";
$searchliveblog = "$path"."/admin/includes/search_liveblog.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";

//paths to blog includes
$editpost= "$path"."/admin/includes/liveblog_update/edit_post.php";
$publishpost= "$path"."/admin/includes/liveblog_update/publish_post.php";
//
$basicupdate = "$path"."/admin/includes/liveblog_update/basic_update.php";
$contentupdate = "$path"."/admin/includes/liveblog_update/content_update.php";
$entryupdate = "$path"."/admin/includes/liveblog_update/entry_update.php";
$entrydelete = "$path"."/admin/includes/liveblog_update/entry_delete.php";
//
$basicactions = "$path"."/admin/includes/liveblog_update/basic_actions.php";
$contentactions = "$path"."/admin/includes/liveblog_update/content_actions.php";
$entryactions = "$path"."/admin/includes/liveblog_update/entry_actions.php";
$deleteactions = "$path"."/admin/includes/liveblog_update/delete_actions.php";

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
if (isset($_GET['edit-liveblog'])) {
$post_id = $_GET['edit-liveblog'];
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

//CONTENT UPDATE
if (isset($_GET['edit-content'])) {
$post_id = $_GET['edit-content'];
include($contentupdate);
}

//ENTRY UPDATE
if (isset($_GET['edit-entries'])) {
$post_id = $_GET['edit-entries'];
include($entryupdate);
}

//DELETE ENTRY
if (isset($_GET['delete-entries'])) {
$post_id = $_GET['delete-entries'];
include($entrydelete);
}


//////////ACTION FORM SECTION/////////////

//BASIC ACTIONS
if (isset($_POST['update-basic'])) {
	include($basicactions);
	exit();
}

//Entry ACTIONS
if (isset($_POST['update-entry'])) {
include($entryactions);
exit();
}

//DELETE ACTIONS
if (isset($_POST['delete'])) {
include($deleteactions);
exit();
}

/////////////// LIVE BLOG SELECT SECTION //////////////////////

if (!empty($_POST['search'])) {	
require_once($searchliveblog);
$listing="Search Results for \"".$_POST['search']."\":";

}else{
	
$ID=$_SESSION['ID'];
$stmt=$conn->prepare("SELECT ID, title, slug, timestamp from liveblog ORDER BY timestamp DESC");
$stmt ->execute();
$result=$stmt->get_result();
$listing="All Blog Posts:";
$num_results = $result->num_rows;
}


echo"<h1>Live Blog Update Tool</h1><hr>";

if ($num_results===0){
echo"<h3>".$listing."</h3><h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

echo "<h3>".$listing."</h3>";
echo "<table>";

foreach ($result as $r) { 
echo	"<tr>
		<td><a href=\"/liveblog/".$r['slug']."\"<h2>".$r['title']."</h2></a></td>";
echo 	"<td><a class=\"fa fa-pencil btn edit\" href=\"update_liveblog.php?edit-liveblog=".$r['ID']."\"></a></td>
		</tr>";
}}


?>

</table>
<hr>
<form action="/admin/update_liveblog.php" method="POST" enctype="multipart/form-data">
<h3>Check a box or enter a search term:</h3>
<h4>Enter search term: <input type="text" name="search"/></h4>


<input type="submit" class="button" name="showtell" value="List Live Blogs" />
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
