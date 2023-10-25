<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";


if (isset($_POST['update-basic'])) {



//SET VARIABLES
$post_id=$_POST['ID'];
$title=$_POST['title'];
$border_text=$_POST['border_text'];
$h2h3_color=$_POST['h2h3_color'];
$rating_name=$_POST['rating_name'];
$main_caption=$_POST['main_caption'];
$description=$_POST['description'];
$textback_color= $_POST['textback_color'];



//TITLE AND SLUG
if ($_POST['title'] != $_POST['oldtitle']) {
	$slug = makeslug($title);
}else{$slug=$_POST['oldslug'];}


//PAGE BACKGROUND


if (empty ($_POST['oldpageback']) && empty ($_POST['page_color'])&& empty($_FILES["page_background"]["name"])){
	echo "<br>You have deleted the old page background colour without replacing it.  Sort it out why don't you.
	<h4><a href=\"\admin\update_review.php?edit-review=".$post_id."\">Update a different section</a>
	<br /><a href=\"\admin\update_review.php\">Select another review</a>
	<br /><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty($_FILES['page_background']['name']) && !empty($_POST['page_color'])){
	echo"<p>you have selected both page background and colour, 
	<br/>you must delete the color in the form to update to a background image</p>
	<h4><a href=\"\admin\update_review.php?edit-review=".$post_id."\">Update a different section</a>
	<br/><a href=\"\admin\update_review.php\">Select another review</a>
	<br/><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty ($_POST['page_color'])) {
$page_color=$_POST['page_color'];
$page_background="";

if (!empty ($_POST ['oldpageback'])) {
$imgpath = "$path"."/assets/backgrounds/reviews";
$oldimage=$_POST['oldpageback'];
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
}}else{ if (!empty ($_FILES["page_background"]["name"])) {
	
$imgpath = "$path"."/assets/backgrounds/reviews";	
$fileName = basename($_FILES["page_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["page_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['page_background']['tmp_name'];
$oldimage=$_POST['oldpageback'];

require ($imgprocess);

if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$page_background = $newname;
$page_color="";
}else{
$page_color="";
$page_background=$_POST['oldpageback'];
}}

//TEXT BACKGROUND
if (empty($_POST['oldtextback']) && empty($_POST['textback_color']) && empty($_FILES["text_background"]["name"])){
	echo"<br>You have deleted the old text background colour without replacing it.
	<h4><a href=\"\admin\update_review.php?edit-review=".$post_id."\">Update a different section</a>
	<br><a href=\"\admin\update_review.php\">Select another review</a>
	<br><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}
if (!empty ($_FILES["text_background"]["name"]) && !empty($_POST['textback_color'])){
	echo"<p>you have selected both textbox background and colour.
	<br/>you must delete the color in the form to update to a background image</p>
	<h4><a href=\"\admin\update_review.php?edit-review=".$post_id."\">Update a different section</a>
	<br><a href=\"\admin\update_review.php\">Select another review</a>
	<br><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty ($_POST['textback_color'])) {
$textback_color=$_POST['textback_color'];
$text_background="";

if (!empty ($_POST ['oldtextback'])) {
$imgpath = "$path"."/assets/backgrounds/reviews";
$oldimage=$_POST['oldtextback'];
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
}}else{ if (!empty ($_FILES["text_background"]["name"])) {
	
$imgpath = "$path"."/assets/backgrounds/reviews";	
$fileName = basename($_FILES["text_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["text_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['text_background']['tmp_name'];
$oldimage=$_POST['oldtextback'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$text_background = $newname;
$textback_color="";
}else{
$textback_color="";
$text_background=$_POST['oldtextback'];
}}
	


//MAIN IMAGE:
if (!empty($_FILES["main_image"]["name"])) {
	
$imgpath = "$path"."/assets/images/reviews";	
$fileName = basename($_FILES["main_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["main_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['main_image']['tmp_name'];
$oldimage=$_POST['oldimage'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$main_image = $newname;
}

if (empty($_FILES["main_image"]["name"])){
$main_image=$_POST['oldimage'];
}

	
//update review table
$ID= $_POST['ID'];
$stmt=$conn->prepare("UPDATE reviews SET border_text=?,  h2h3_color=?, page_background=?, page_color=?, text_background=?, textback_color=?, title=?, slug=?, 
rating_name=?, main_image=?, main_caption=?, description=? WHERE ID=?");
$stmt->bind_param("sssssssssssss", $border_text, $h2h3_color, $page_background, $page_color, $text_background, $textback_color, $title, $slug, 
$rating_name, $main_image, $main_caption, $description, $ID);
$stmt->execute();

//update article index
$url="/reviews/"."$slug";
$stmt= $conn->prepare("UPDATE article_index SET url=?, lastupdated=now() WHERE review_ID=?");
$stmt->bind_param("ss", $url, $ID);

if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Review Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>

