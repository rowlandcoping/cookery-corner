<?php if(!isset($_SESSION)){session_start();}?>


<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$loginpath = $path."/publiclogin.php";
$logout=$path."/logout";
$adminprofile=$path."/admin/admin_profile.php";
$publisherprofile=$path."/admin/publisher_profile.php";
$userprofile=$path."/admin/user_profile.php";


if (!isset($_SESSION['loggedin'])) {
	$messaging="Please log in first to access this page";
	include($loginpath);
	exit();
}
if ($_SESSION['role']==="admin"){
include($adminprofile);
exit();
}else{if ($_SESSION['role']==="publisher"){
include($publisherprofile);
exit();
}else{if ($_SESSION['role']==="user"){
include($userprofile);
exit();
}else{echo "<p>THERE HAS BEEN AN INEXPLICABLE ERROR
	<br>You definitely shouldn't be here, in any sense.</p>
	<p>Go <a href=\"/index.php\">Home</a></p>";
	exit();
}}}
?>
<!-- OLD ADMIN SITE
<html>
<h2>Welcome <?php echo $_SESSION['name']?>!</h2>
<?php if (!empty($message)) {echo "<h3><span style=\"color:red\">".$message."</span></h3>";}
?>
<div class="admin">

<div class="replies">
<h3>View Messages</h3>
<p><a href="/admin/replies_live.php">Live blog messages</a>
<br>
<a href="/admin/replies_gen.php">General messages</a>
</p>
</div>
<div class="entry">
<h3>Live blog</h3>
<p><a href="/admin/liveblog_update.php">Update Live Blog</a></p>

<h3>Add Info</h3>
<p>
<a href="/admin/ingrediententry.php">Add Ingredient</a>
<br>
<a href="/admin/recipe_categoryentry.php">Add Category</a>
<br>
<a href="/admin/cuisineentry.php">Add Cuisine</a>
<br>
<a href="/admin/create_admin.php">Add User</a>
</p>

<h3>Update Info</h3>
<p>
<a href="/admin/update_ingredient.php">Update Ingredient</a>
<br>
<a href="/admin/update_category.php">Update Category</a>
<br>
<a href="/admin/update_cuisine.php">Update Cuisine</a>
<br>
<a href="/admin/update_user.php">Update User</a>
<br>
<a href="/admin/dbupdate.php">Update ingredient index database</a>
<br>
<a href="/admin/dbupdate2.php">Update recipe database</a>
</p>

<h3>Create Content</h3>


<p><a href="/admin/blogentry.php">Add Blog Entry</a>
<br>
<a href="/admin/liveblog_entry.php">Create Live Blog</a>
<br>
<a href="/admin/reviewentry.php">Add Review</a>
<br>
<a href="/admin/recipe_entry.php">Add Recipe</a>
</p>
</div>

<div class="update">
	
<h3>Update Content</h3>

<p>
<a href="/admin/update_recipe.php">Update Recipe</a>
<br>
<a href="/admin/update_blog.php">Update Blog Entry</a>
<br>
<a href="/admin/update_review.php">Update Review</a>
<br>
<a href="/admin/update_liveblog.php">Update Live Blog</a>
<br>
</p>
</div>

<p><a href ="/logout">Log Out</a>
<br><a href="/index.php">Back to Homepage</a></p>
</div>


</hmtl>
-->
<html>
