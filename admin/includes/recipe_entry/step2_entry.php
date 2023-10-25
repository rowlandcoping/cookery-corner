<?php
$stmt=$conn->prepare("SELECT user_ID, title, titslug, step2_head, step2_content, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $recipe_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();	
$title= $result['title'];
$slug=$result['titslug'];
$step2_head=$result['step2_head'];
$step2_content=$result['step2_content'];
$stage=$result['stage'];
$rec_usr = $result['user_ID'];
$user = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}

?>

<div class=section3>
	<h2>Stage 5 of 8 - Recipe Part 2 - <?php echo "<a href=\"/recipe/".$slug."\" target=\"_blank\">".$title."</a></h2>";?></h2>
	<div class=regular>
<?php if (!empty($message)){echo "<h3>&nbsp<span style=\"color:red;\">!---&nbsp".$message."&nbsp---!</h3><hr>";}?>	
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<input type="hidden" name="stage" size="1" value="<?php echo $stage;?>" readonly/>

	<h3>Recipe Part 2 (optional)</h3>
	<p>This section is normally the cooking process.
	<br>You have up to 3 stages you can use in total.</p>

<label for="Header 2"><h4>Heading</label></h4>
<p><input type="text"  name="step2_head" size="20" value="<?php echo $step2_head;?>"></p>
<label for="Content 2"><h4>Content</label></h4>
<p><textarea name="step2_content" rows="15" cols="60"><?php echo $step2_content;?></textarea>
</p>
<script>
            CKEDITOR.replace( 'step2_content' );
</script>

<?php
if ($stage<8) {
echo "<label for=\"step2-entry\"><input type=\"submit\" class=\"button\" name=\"step2-entry\" value=\"Move on to Next Section\" />";
}else{
echo"<label for=\"step2-entry\"><input type=\"submit\" class=\"button\" name=\"step2-entry\" value=\"Update Section\" />";}
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

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}
exit();
?>
