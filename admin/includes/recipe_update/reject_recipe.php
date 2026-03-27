
<form action="/admin/update_recipe.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<input type="hidden" name="user_ID" size="1" value="<?php echo $user_ID;?>" readonly/>
<label for="message"><h2><span style="color:red">Rejection Reasons</span></h2></label>

<div id="message-editor" style="height:200px"></div>
<textarea name="message" style="display:none"><?php if (!empty($message)) {echo $message;}?></textarea>
<script>
    const quill = new Quill('#message-editor', { theme: 'snow' });
    document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('[name=message]').value = quill.root.innerHTML;
    });
</script>

<p><label for="Submit"><input type="submit" class="button" name="action-reject" value="Reject Recipe" /></p>
<hr />
</form>
