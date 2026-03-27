<hr>
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="type" size="1" value="notes" readonly/>	
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>	
<label for="notes"><h4>Ingredient Notes:</h4>
<p>Include any notes on the ingredients here - for example substitutes, alternative cuts of meat or the best places to buy stuff from!</label></p>

<div id="message-editor" style="height:200px"><?php echo $add_ingred; ?></div>
<textarea name="add_ingred" style="display:none"><?php if (!empty($add_ingred)) {echo $add_ingred;}?></textarea>
<script>
const quill = new Quill('#message-editor', { theme: 'snow' });
document.querySelector('form').addEventListener('submit', function() {
    document.querySelector('[name=add_ingred]').value = quill.root.innerHTML;
});
</script>

<hr><label for="Submit"><input type="submit" class="button" name="action-ingredient" value="Submit Ingredient Notes" /></p>
</form> 
