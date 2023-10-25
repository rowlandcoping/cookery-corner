
<form action="/admin/update_recipe.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<input type="hidden" name="user_ID" size="1" value="<?php echo $user_ID;?>" readonly/>
<label for="notes"><h2><span style="color:red">Rejection Reasons</span></h2></label>
<textarea name="message"></textarea>
<script>
            CKEDITOR.replace('message');
</script>
<p><label for="Submit"><input type="submit" class="button" name="action-reject" value="Reject Recipe" /></p>
<hr />
</form>
