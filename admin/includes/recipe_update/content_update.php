<?php

$stmt=$conn->prepare("SELECT ID, intro, step1_head, step1_content, step2_head, step2_content, step3_head, step3_content, conclusion FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();


$intro=$result['intro'];
$step1_head=$result['step1_head'];
$step1_content=$result['step1_content'];
$step2_head=$result['step2_head'];
$step2_content=$result['step2_content'];
$step3_head=$result['step3_head'];
$step3_content=$result['step3_content'];
$conclusion=$result['conclusion'];

?>
<form action="/admin/update_recipe.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<h4><a href="\admin\update_recipe.php?edit-recipe=<?php echo $post_id;?>">Update a different section</a>
<br /><a href="\admin\update_recipe.php">Select a different recipe</a>
<br /><a href="/admin/admin.php">Return to profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>";
<div class=section3>

<h2>Update Content</h2>

<div class=recipe>
<div class=regular>
<label for="Intro"><h3><span style="color:red;">*</span>Introdution:</label></h3>
<p>What's this recipe all about then?</p>
<textarea name="intro" rows="10" cols="60" required><?php echo $intro;?></textarea>
</div>
<script>
            CKEDITOR.replace( 'intro' );
</script>

<div class=regular>
<h3>Recipe Part 1</h3>
<p>First part of the recipe - normally chopping peeling and such like.
<br>Most recipes benefit from being broken down into easy to follow stages.</p>

<label for="Header 1"><h4><span style="color:red;">*</span>Heading</h4></label>
<p>Heading for the first part of the recipe (eg Preparation, Method, whatever).</p>
<p><input type="text"  name="step1_head" size="20" value="<?php echo $step1_head;?>" required/></p>
<label for="Content 1"><h4><span style="color:red;">*</span>Content</label></h4>
<p><textarea name="step1_content" required rows="15" cols="60"><?php echo $step1_content;?></textarea></p>
</div>
<script>
            CKEDITOR.replace( 'step1_content' );
</script>


<div class=regular>
	<h3>Recipe Part 2</h3>
	<p>This section is normally the cooking process.
	<br>You have up to 4 stages you can use in total.</p>

<label for="Header 2"><h4>Heading</label></h4>
<p><input type="text"  name="step2_head" size="20" value="<?php echo $step2_head;?>"></p>
<label for="Content 2"><h4>Content</label></h4>
<p><textarea name="step2_content" rows="15" cols="60"><?php echo $step2_content;?></textarea>
</p>
</div>
<script>
            CKEDITOR.replace( 'step2_content' );
</script>

<div class=regular>
	<h3>Recipe Part 3</h3>
	<p>Use this part for any additional steps and serving instructions</p>
<label for="Header 3"><h4>Heading</label></h4>
<p><input type="text"  name="step3_head" size="20" value="<?php echo $step3_head;?>"></p>
<h4><label for="Content 3">Content</label></h4>
<p><textarea name="step3_content" rows="15" cols="60"><?php echo $step3_content;?></textarea></p>
</div>
<script>
            CKEDITOR.replace( 'step3_content' );
</script>


<div class=regular>
	<h3><label for="Conclusion"><span style="color:red;">*</span>Summary</h3></label>
<p>Summarise your recipe and perhaps include serving suggestions or alternatives here.</p>
<p><textarea name="conclusion" required rows="10" cols="60"><?php echo $conclusion;?></textarea>
</p>
</div>
<script>
            CKEDITOR.replace( 'conclusion' );
</script>
</div>

<p>
<label for="Submit"><input type="submit" class="button" name="content" value="Update Recipe" />
</p>
</div>



</form>



<?php
exit();

?>
