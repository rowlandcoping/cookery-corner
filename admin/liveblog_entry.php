<?php session_start();?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
require_once($head);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>Create Live Blog</title>

<link rel="stylesheet" type="text/css" href="/admin/styles/recipe_input.css" />


<style type="text/css">


</style>

</head>

<body>

<form action="/admin/includes/liveblog_actions.php" method="POST" enctype="multipart/form-data">



<div class=container>

<p><b>Set up new Live Blog</b></p>
<div class=section1>
	
<div class=left>
<label for="body_background">Page Background Image<input type="file"  name="body_background" /></label>OR
<br><label for="body_color">Page Background colour (hex)<input type="text"  name="body_color" /></label>
<hr/>
<label for="blog_background">Background image for content<input type="file"  name="blog_background" /></label> OR 
<br><label for="blog_color">Background colour for content (hex)<input type="text"  name="blog_color" /></label>
<hr/>
<label for="textarea_background">Text Background image<input type="file"  name="textarea_background" /></label> OR
<br><label for="textarea_color">Text Background colour (hex)<input type="text"  name="textarea_color" /></label>
<br>Background type:<label for="cover"><input type="radio" name="bgtype" value="cover">cover</label><label for="tile"><input type="radio" name="bgtype" value="tile" checked="checked">tile</label>
<hr/>
<label for="text_color">Main text colour (hex)<input type="text"  name="text_color" /></label>
<hr/>
<label for="h_color">Headline Color<input type="text"  name="h_color" /></label>
<hr/>
<label for="links_color">Link colour<input type="text"  name="links_color" /></label>
<hr/>
<label for="hover_color">Hover colour (hex)<input type="text"  name="hover_color" /></label>

</div>


<div class=middle>
	
<br><label for="title">Live blog title</label><input type="text"  name="title"></label>
<br><label for="main_image">Main image for page</label><input type="file"  name="main_image"></label>

<br><label for="keywords">keywords (pointless)</label><input type="text"  name="keywords"></label>
<br><label class=textarea for="intro">Intro text</label><textarea name="intro" rows="10" cols="60"></textarea></label>

</div>
</div>


<p>
<label for="Submit"><input type="submit" class="button" name="submit" value="Submit" />
</p>

</form>
</div>

<p><a href="/admin/admin.php">Back to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></p>

</body>
</html>
