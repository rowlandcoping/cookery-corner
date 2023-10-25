<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";


if (isset($_POST['update-basic'])) {



//SET VARIABLES
$post_id=$_POST['ID'];
$title=$_POST['title'];
$bgtype=$_POST['bgtype'];
$text_color=$_POST['text_color'];
$hover_color=$_POST['hover_color'];
$h_color=$_POST['h_color'];
$links_color=$_POST['links_color'];
$intro=$_POST['intro'];
$keywords=$_POST['keywords'];





//TITLE AND SLUG
if ($_POST['title'] != $_POST['oldtitle']) {
	$slug = makeslug($title);
}else{$slug=$_POST['oldslug'];}


//BODY BACKGROUND


if (empty ($_POST['oldbodyback']) && empty ($_POST['body_color'])&& empty($_FILES["body_background"]["name"])){
	echo "<br>You have deleted the old background colour without replacing it.  Sort it out why don't you.
	<h4><a href=\"\admin\update_review.php?edit-review=".$post_id."\">Update a different section</a>
	<br /><a href=\"\admin\update_review.php\">Select another review</a>
	<br /><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty($_FILES['body_background']['name']) && !empty($_POST['body_color'])){
	echo"<p>you have selected both background and colour, 
	<br/>you must delete the color in the form to update to a background image</p>
	<h4><a href=\"\admin\update_liveblog.php?edit-liveblog=".$post_id."\">Update a different section</a>
	<br/><a href=\"\admin\update_liveblog.php\">Select another live blog</a>
	<br/><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty ($_POST['body_color'])) {
$body_color=$_POST['body_color'];
$body_background="";

if (!empty ($_POST ['oldbodyback'])) {
$imgpath = "$path"."/assets/backgrounds/liveblog";
$oldimage=$_POST['oldbodyback'];
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
}}else{ if (!empty ($_FILES["body_background"]["name"])) {
	
$imgpath = "$path"."/assets/backgrounds/liveblog";	
$fileName = basename($_FILES["body_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["body_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['body_background']['tmp_name'];
$oldimage=$_POST['oldbodyback'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$body_background = $newname;
$body_color="";
}else{
$body_color="";
$body_background=$_POST['oldbodyback'];
}}

//BLOG BACKGROUND


if (empty ($_POST['oldblogback']) && empty ($_POST['blog_color'])&& empty($_FILES["blog_background"]["name"])){
	echo "<br>You have deleted the old blog background colour without replacing it.  Sort it out why don't you.
	<h4><a href=\"\admin\update_liveblog.php?edit-blog=".$post_id."\">Update a different section</a>
	<br /><a href=\"\admin\update_liveblog.php\">Select another live blog</a>
	<br /><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty($_FILES['blog_background']['name']) && !empty($_POST['blog_color'])){
	echo"<p>you have selected both blog background and colour, 
	<br/>you must delete the color in the form to update to a background image</p>
	<h4><a href=\"\admin\update_liveblog.php?edit-liveblog=".$post_id."\">Update a different section</a>
	<br/><a href=\"\admin\update_liveblog.php\">Select another live blog</a>
	<br/><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty ($_POST['blog_color'])) {
$blog_color=$_POST['blog_color'];
$blog_background="";

if (!empty ($_POST ['oldblogback'])) {
$imgpath = "$path"."/assets/backgrounds/liveblog";
$oldimage=$_POST['oldblogback'];
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
}}else{ if (!empty ($_FILES["blog_background"]["name"])) {
	
$imgpath = "$path"."/assets/backgrounds/liveblog";	
$fileName = basename($_FILES["blog_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["blog_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['blog_background']['tmp_name'];
$oldimage=$_POST['oldblogback'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$blog_background = $newname;
$blog_color="";
}else{
$blog_color="";
$blog_background=$_POST['oldblogback'];
}}

//TEXT BACKGROUND

if (empty ($_POST['oldtextback']) && empty ($_POST['textarea_color'])&& empty($_FILES["textarea_background"]["name"])){
	echo "<br>You have deleted the old blog background colour without replacing it.  Sort it out why don't you.
	<h4><a href=\"\admin\update_liveblog.php?edit-blog=".$post_id."\">Update a different section</a>
	<br /><a href=\"\admin\update_liveblog.php\">Select another live blog</a>
	<br /><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty($_FILES['textarea_background']['name']) && !empty($_POST['textarea_color'])){
	echo"<p>you have selected both blog background and colour, 
	<br/>you must delete the color in the form to update to a background image</p>
	<h4><a href=\"\admin\update_liveblog.php?edit-liveblog=".$post_id."\">Update a different section</a>
	<br/><a href=\"\admin\update_liveblog.php\">Select another live blog</a>
	<br/><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";
	exit ();
}

if (!empty ($_POST['textarea_color'])) {
$textarea_color=$_POST['textarea_color'];
$textarea_background="";

if (!empty ($_POST ['oldtextback'])) {
$imgpath = "$path"."/assets/backgrounds/liveblog";
$oldimage=$_POST['oldtextback'];
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
}}else{ if (!empty ($_FILES["textarea_background"]["name"])) {
	
$imgpath = "$path"."/assets/backgrounds/liveblog";	
$fileName = basename($_FILES["textarea_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["textarea_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['textarea_background']['tmp_name'];
$oldimage=$_POST['oldtextback'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$textarea_background = $newname;
$textarea_color="";
}else{
$textarea_color="";
$textarea_background=$_POST['oldtextback'];
}}
	


//MAIN IMAGE:
if (!empty($_FILES["main_image"]["name"])) {
	
$imgpath = "$path"."/assets/images/liveblog";	
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

	
//update liveblog table
$ID= $_POST['ID'];
$stmt=$conn->prepare("UPDATE liveblog SET body_background=?, body_color=?, blog_background=?, blog_color=?, textarea_background=?, textarea_color=?, 
					bgtype=?, text_color=?, hover_color=?, h_color=?, links_color=?, title=?, main_image=?, slug=?, intro=?, keywords=? WHERE ID=?");
$stmt->bind_param("sssssssssssssssss", $body_background, $body_color, $blog_background, $blog_color, $textarea_background, $textarea_color, $bgtype, 
										$text_color, $hover_color, $h_color, $links_color, $title, $main_image, $slug, $intro, $keywords, $ID);
$stmt->execute();

//update article index
$url="/liveblog/"."$slug";
$stmt= $conn->prepare("UPDATE article_index SET url=?, lastupdated=now() WHERE liveblog_ID=?");
$stmt->bind_param("ss", $url, $ID);

if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Live Blog Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>

