




<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input id="type" type="hidden" name="type" size="1" value="add" readonly/>	
<input id="recipe_ID" type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>	
<input id="display_order" type="hidden" name="display_order" size="1" value="<?php echo $display_order;?>" readonly/>
<input id="complexity" type="hidden" name="complexity" size="1" value="<?php echo $complexity;?>" readonly/>		
	
<p class=inglist>
	<hr>
<ul>
<li id=quant><label for="quantity"><span style="color:red;">*</span> Quantity:</label></li>
<li id=quantform><input id="quantity" type="text"  name="quantity" size="7" required/></li>
</ul>
<ul>
<li id=ing><label for="ingredient"><span style="color:red;">*</span> Ingredient:</label></li>
<li id=ingform><select name='ingredient' required><option value =""></option>
</ul>
<hr>
<?php          
$result = $conn->query('select ingredient, ingredient from ingredients ORDER BY ingredient ASC');
while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['ingredient'];
                  $name = $row['ingredient']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';               
}

?>
</select>
</li></ul>
<hr>
<label for="Submit"><input type="submit" class="button" name="action-ingredient" value="Add Ingredient" /></p>
</form>
