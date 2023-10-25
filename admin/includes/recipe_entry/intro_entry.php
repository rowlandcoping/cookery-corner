<?php
$stmt=$conn->prepare("SELECT user_ID, title, titslug, intro, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $recipe_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();	
$title= $result['title'];
$slug=$result['titslug'];
$intro=$result['intro'];
$stage=$result['stage'];
$rec_usr = $result['user_ID'];
$user = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}

if ($stage<8) {
$stmt=$conn->prepare("UPDATE recipes SET stage=3 WHERE ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
$stage="3";
}



?>

<div class=section3>
	<h2>Stage 3 of 8 - Introduction -  <?php echo "<a href=\"/recipe/".$slug."\" target=\"_blank\">".$title."</a></h2>";?></h2>
<div class=regular>
<?php if (!empty($message)){echo "<h3>&nbsp<span style=\"color:red;\">!---&nbsp".$message."&nbsp---!</h3><hr>";}?>
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="stage" size="1" value="<?php echo $stage;?>" readonly/>
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<label for="Intro"><h3><span style="color:red;">*</span> Introdution:</label></h3>
<p>What's this recipe all about then?</p>
<textarea name="intro" rows="10" cols="60" required><?php echo $intro;?></textarea>
<script>
            CKEDITOR.replace( 'intro');
</script>
</div>

<?php
if ($stage<8) {
echo "<label for=\"intro-entry\"><input type=\"submit\" class=\"button\" name=\"intro-entry\" value=\"Move on to Next Section\" />";
}else{
echo"<label for=\"intro-entry\"><input type=\"submit\" class=\"button\" name=\"intro-entry\" value=\"Update Section\" />";}
?>


</form>
</div>
</div>
<?php if ($stage<9){ echo"<h4>";
					if ($stage===8) {echo"
<a href=\"/admin/recipe_entry.php?review-submit=".$recipe_ID."\">Review a different section or finalise recipe</a><br />";}
if ($_SESSION['role']==="admin") {echo "<a href=\"/admin/incomplete_recipes.php\">Go back to incomplete recipes page</a><br />";}
echo "<a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}else{echo"

<h4><a href=\"/admin/update_recipe.php?edit-recipe=".$recipe_ID."\">Update a different section</a>
<br /><a href=\"/admin/update_recipe.php\">Select a different recipe</a>
<br /><a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4> Go back to the <a href=\"/index.php\">homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}
exit();
?>


