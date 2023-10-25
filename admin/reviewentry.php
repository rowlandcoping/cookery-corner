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

<title>Review Entry</title>

<link rel="stylesheet" type="text/css" href="/admin/styles/recipe_input.css" />


<style type="text/css">


</style>

</head>

<body>

<form action="/admin/includes/review_actions.php" method="POST" enctype="multipart/form-data">



<div class=container>

<h2>Create Review</h2>
<div class=section1>
	
<div class=left>
<label for="border_text"><span style="color:red;">* </span>Border and text colour<input type="text"  name="border_text" required />
<br><label for="h2h3_color"><span style="color:red;">* </span>H2 / H3 colour<input type="text"  name="h2h3_color" required />
<hr/>
<br><label for="page">Page Background (filename)<input type="file"  name="page_background" /> OR 
<br><label for="page">Page Background color (hex)<input type="text"  name="page_color" />
<hr/>
<br><label for="text bg">Text Background (filename)<input type="file"  name="text_background" /> OR
<br><label for="text bg">Text Background color (hex)<input type="text"  name="textback_color" />
<hr/>
<br><label for="title"><span style="color:red;">* </span>Title<input type="text"  name="title" required />
<br><label for="rating_name"><span style="color:red;">* </span>Rating type for each review</label><input type="text"  name="rating_name" required />
</div>


<div class=middle>

<br><label for="main_image">Main image for page</label><input type="file"  name="main_image">
<br><label for="main_caption">Image caption</label><input type="text"  name="main_caption">
<br><label for="description"><span style="color:red;">* </span>Brief description of article</label><input type="text"  name="description" required />
<br><label class=textarea for="intro"><span style="color:red;">* </span>Intro text</label><textarea name="intro" rows="10" cols="60" required /></textarea>

</div>
</div>





<!-- 1  -->
<div class=section1>
<div class=middle>
<h3>Review 1</h3>
<p>
<br><label for="heading1"><span style="color:red;">* </span>Heading<input type="text"  name="heading1" required />
<br><label for="image1"><span style="color:red;">* </span>Image for review</label><input type="file"  name="image1" required />
<br><label for="caption1"><span style="color:red;">* </span>Image caption</label><input type="text"  name="caption1" required />
<br><label class=textarea for="review1"><span style="color:red;">* </span>Review</label><textarea name="review1" rows="20" cols="100" required /></textarea>
<br><label for="rating1"><span style="color:red;">* </span>Rating</label><input type="text"  name="rating1" required />
</p>
</div>
</div>

<!-- 2  -->

<div class=section1>
<div class=middle>
<h3>Review 2</h3>
<p>
<br><label for="heading2"><span style="color:red;">* </span>Heading<input type="text"  name="heading2" required />
<br><label for="image2"><span style="color:red;">* </span>Image for review</label><input type="file"  name="image2" required />
<br><label for="caption2"><span style="color:red;">* </span>Image caption</label><input type="text"  name="caption2" required />
<br><label class=textarea for="review2"><span style="color:red;">* </span>Review</label><textarea name="review2" rows="20" cols="100" required /></textarea>
<br><label for="rating2"><span style="color:red;">* </span>Rating</label><input type="text"  name="rating2" required />
</p>
</div>
</div>



<!-- 3  -->

<div class=section1>
<div class=middle>
	<h3>Review 3</h3>
<p>
<br><label for="heading3"><span style="color:red;">* </span>Heading<input type="text"  name="heading3" required />
<br><label for="image3"><span style="color:red;">* </span>Image for review</label><input type="file"  name="image3" required />
<br><label for="caption3"><span style="color:red;">* </span>Image caption</label><input type="text"  name="caption3" required />
<br><label class=textarea for="review3"><span style="color:red;">* </span>Review</label><textarea name="review3" rows="20" cols="100" required></textarea>
<br><label for="rating3"><span style="color:red;">* </span>Rating</label><input type="text"  name="rating3" required />
</p>
</div>
</div>




<!-- 4  -->

<div class=section1>
<div class=middle>
	<h3>Review 4</h3>
<p>
<br><label for="heading4">Heading<input type="text"  name="heading4" />
<br><label for="image4">Image for review</label><input type="file"  name="image4">
<br><label for="caption4">Image caption</label><input type="text"  name="caption4">
<br><label class=textarea for="review4">Review</label><textarea name="review4" rows="20" cols="100"></textarea>
<br><label for="rating4">Rating</label><input type="text"  name="rating4">
</p>
</div>
</div>


<!-- 5  -->

<div class=section1>
<div class=middle>
<h3>Review 5</h3>
<p>
<br><label for="heading5">Heading<input type="text"  name="heading5" />
<br><label for="image5">Image for review</label><input type="file"  name="image5">
<br><label for="caption5">Image caption</label><input type="text"  name="caption5">
<br><label class=textarea for="review5">Review</label><textarea name="review5" rows="20" cols="100"></textarea>
<br><label for="rating5">Rating</label><input type="text"  name="rating5">
</p>
</div>
</div>


<!-- 6  -->

<div class=section1>
<div class=middle>
<h3>Review 6</h3>
<p>
<br><label for="heading6">Heading<input type="text"  name="heading6" />
<br><label for="image6">Image for review</label><input type="file"  name="image6">
<br><label for="caption6">Image caption</label><input type="text"  name="caption6">
<br><label class=textarea for="review6">Review</label><textarea name="review6" rows="20" cols="100"></textarea>
<br><label for="rating6">Rating</label><input type="text"  name="rating6">
</p>
</div>
</div>


<!-- 7  -->

<div class=section1>
<div class=middle>
<h3>Review 7</h3>

<p>
<br><label for="heading7">Heading<input type="text"  name="heading7" />
<br><label for="image7">Image for review</label><input type="file"  name="image7">
<br><label for="caption7">Image caption</label><input type="text"  name="caption7">
<br><label class=textarea for="review7">Review</label><textarea name="review7" rows="20" cols="100"></textarea>
<br><label for="rating7">Rating</label><input type="text"  name="rating7">
</p>
</div>
</div>


<!-- 8  -->

<div class=section1>
<div class=middle>
<h3>Review 8</h3>

<p>
<br><label for="heading8">Heading<input type="text"  name="heading8" />
<br><label for="image8">Image for review</label><input type="file"  name="image8">
<br><label for="caption8">Image caption</label><input type="text"  name="caption8">
<br><label class=textarea for="review8">Review</label><textarea name="review8" rows="20" cols="100"></textarea>
<br><label for="rating8">Rating</label><input type="text"  name="rating8">
</p>
</div>
</div>

<div class=section1>
<div class=middle>
<br><label class=textarea for="summary">Article Summary</label><textarea name="summary" rows="10" cols="60" required /></textarea>

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
