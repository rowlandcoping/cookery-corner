<?php
dirname(__FILE__);
$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $recipe_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();	
$title= $result['title'];
$slug=$result['titslug'];
$rec_usr = $result['user_ID'];
$user = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}

echo "<h2>Stage 8 of 8 - Review and Submit \"<a href=\"/recipe/".$result['titslug']."\" target=\"_blank\" rel=\"noreferrer noopener\">".$result['title']."</a>\"</h2>";

?>

<p>Once submitted, your recipe will be reviewed by the Cookery Corner team before going live.
<br>We aim to complete this within 48 hours.</p>

<p>Use the links below to complete any final updates.
<br>This is your last chance to make it perfect!</p>
<hr/>
<?php if (!empty($messager)){echo "<h3><span style=\"color:red\";>".$messager."</span></h3><hr/>";} 

echo "
<h3><a class=\"fa fa-pencil btn basic\" href=\"/admin/recipe_entry.php?edit-basic=".$result['ID']."\">&nbsp</a>Update Basic Info</h3>
<h3><a class=\"fa fa-pencil btn image\" href=\"/admin/recipe_entry.php?edit-image=".$result['ID']."\">&nbsp</a>Update Image</h3>
<h3><a class=\"fa fa-pencil btn ingredients\" href=\"/admin/recipe_entry.php?edit-ingredients=".$result['ID']."\">&nbsp</a>Update Ingredients</h3>
<h3><a class=\"fa fa-pencil btn intro\" href=\"/admin/recipe_entry.php?edit-intro=".$result['ID']."\">&nbsp</a>Update Introduction</h3>
<h3><a class=\"fa fa-pencil btn step1\" href=\"/admin/recipe_entry.php?edit-step1=".$result['ID']."\">&nbsp</a>Update Recipe Step 1</h3>
<h3><a class=\"fa fa-pencil btn step2\" href=\"/admin/recipe_entry.php?edit-step2=".$result['ID']."\">&nbsp</a>Update Recipe Step 2</h3>
<h3><a class=\"fa fa-pencil btn step3\" href=\"/admin/recipe_entry.php?edit-step3=".$result['ID']."\">&nbsp</a>Update Recipe Step 3</h3>
<h3><a class=\"fa fa-pencil btn summary\" href=\"/admin/recipe_entry.php?edit-summary=".$result['ID']."\">&nbsp</a>Update Summary</h3>";

?>

<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<label for="finalise-actions"><input type="submit" class="button" name="finalise-actions" value="OK, THIS IS IT!  SEND IT!" />
</form>
<h4><a href="\admin\admin.php">Return to Profile</a></h4>
<h4> Go back to the <a href="/index.php">Homepage</a>
<br /><a href="/logout">Log out</a></h4>
