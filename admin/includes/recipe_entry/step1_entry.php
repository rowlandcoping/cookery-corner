<?php
$stmt=$conn->prepare("SELECT user_ID, title, titslug, step1_head, step1_content, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $recipe_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();	
$title= $result['title'];
$slug=$result['titslug'];
$step1_head=$result['step1_head'];
$step1_content=$result['step1_content'];
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
	<h2>Stage 4 of 8 - Recipe Part 1 - <?php echo "<a href=\"/recipe/".$slug."\" target=\"_blank\">".$title."</a></h2>";?></h2>
	<div class=regular>
<?php if (!empty($message)){echo "<h3>&nbsp<span style=\"color:red;\">!---&nbsp".$message."&nbsp---!</h3><hr>";}?>	
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<input type="hidden" name="stage" size="1" value="<?php echo $stage;?>" readonly/>


<p>First part of the recipe - normally chopping peeling and such like.
<br>Most recipes benefit from being broken down into easy to follow stages.</p>

<label for="Header 1"><h4><span style="color:red;">*</span> Heading</h4></label>
<p>Heading for the first part of the recipe (eg Preparation, Method, whatever).</p>
<p><input type="text"  name="step1_head" size="20" value="<?php echo $step1_head;?>" required/></p>
<label for="Content 1"><h4><span style="color:red;">*</span> Content</label></h4>
<p><textarea name="step1_content" required rows="15" cols="60"><?php echo $step1_content;?></textarea></p>
</div>
<script>
            CKEDITOR.replace( 'step1_content' );
</script>
<?php
if ($stage<8) {
echo "<label for=\"step1-entry\"><input type=\"submit\" class=\"button\" name=\"step1-entry\" value=\"Move on to Next Section\" />";
}else{
echo"<label for=\"step1-entry\"><input type=\"submit\" class=\"button\" name=\"step1-entry\" value=\"Update Section\" />";}
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
