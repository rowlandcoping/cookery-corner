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
<br /><a href="/logout">Log out</a></h4>
<div class=section3>

<h2>Update Content</h2>

<div class=recipe>
<div class=regular>
<label for="intro"><h3><span style="color:red;">*</span>Introdution:</label></h3>
<p>What's this recipe all about then?</p>

<div id="message-editor1" style="height:200px"><?php echo $intro; ?></div>
<textarea name="intro" style="display:none"><?php if (!empty($intro)) {echo $intro;}?></textarea>
<script>
    const quill = new Quill('#message-editor1', { theme: 'snow' });
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('[name=intro]').value = quill.root.innerHTML;
    });
</script>
</div>

<div class=regular>
<h3>Recipe Part 1</h3>
<p>First part of the recipe - normally chopping peeling and such like.
<br>Most recipes benefit from being broken down into easy to follow stages.</p>

<label for="step1_head"><h4><span style="color:red;">*</span>Heading</h4></label>
<p>Heading for the first part of the recipe (eg Preparation, Method, whatever).</p>
<p><input type="text"  name="step1_head" size="20" value="<?php echo $step1_head;?>" required/></p>
<label for="step1_content"><h4><span style="color:red;">*</span>Content</label></h4>


<div id="message-editor2" style="height:200px"><?php echo $step1_content; ?></div>
<textarea name="step1_content" style="display:none"><?php if (!empty($step1_content)) {echo $step1_content;}?></textarea>
<script>
    const quill2 = new Quill('#message-editor2', { theme: 'snow' });
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('[name=step1_content]').value = quill.root.innerHTML;
    });
</script>
</div>


<div class=regular>
	<h3>Recipe Part 2</h3>
	<p>This section is normally the cooking process.
	<br>You have up to 4 stages you can use in total.</p>

<label for="step2_head"><h4>Heading</label></h4>
<p><input type="text"  name="step2_head" size="20" value="<?php echo $step2_head;?>"></p>
<label for="step2_content"><h4><span style="color:red;">*</span>Content</label></h4>


<div id="message-editor3" style="height:200px"><?php echo $step2_content; ?></div>
<textarea name="step2_content" style="display:none"><?php if (!empty($step2_content)) {echo $step2_content;}?></textarea>
<script>
    const quill3 = new Quill('#message-editor3', { theme: 'snow' });
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('[name=step2_content]').value = quill.root.innerHTML;
    });
</script>
</div>

<div class=regular>
	<h3>Recipe Part 3</h3>
	<p>Use this part for any additional steps and serving instructions</p>
<label for="Header 3"><h4>Heading</label></h4>
<p><input type="text"  name="step3_head" size="20" value="<?php echo $step3_head;?>"></p>
<label for="step3_content"><h4><span style="color:red;">*</span>Content</label></h4>

<div id="message-editor4" style="height:200px"><?php echo $step3_content; ?></div>
<textarea name="step3_content" style="display:none"><?php if (!empty($step3_content)) {echo $step3_content;}?></textarea>
<script>
    const quill4 = new Quill('#message-editor4', { theme: 'snow' });
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('[name=step3_content]').value = quill.root.innerHTML;
    });
</script>
</div>


<div class=regular>
	<h3><label for="Conclusion"><span style="color:red;">*</span>Summary</h3></label>
<p>Summarise your recipe and perhaps include serving suggestions or alternatives here.</p>


<div id="message-editor5" style="height:200px"><?php echo $conclusion; ?></div>
<textarea name="conclusion" style="display:none"><?php if (!empty($conclusion)) {echo $conclusion;}?></textarea>
<script>
    const quill5 = new Quill('#message-editor5', { theme: 'snow' });
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('[name=conclusion]').value = quill.root.innerHTML;
    });
</script>
</div>


</div>

<p>
<label for="Submit"><input type="submit" class="button" name="content" value="Update Recipe" />
</p>
</div>



</form>



<?php
exit();

?>
