<?php


$stmt=$conn->prepare("SELECT ID, ingredient_ID, plural, quantity FROM ing_index WHERE ID=?");
$stmt ->bind_param("s", $ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

$ingredient_ID=$result['ingredient_ID'];
$ID=$result['ID'];
$quantity = $result['quantity'];

$stmt=$conn->prepare("SELECT ingredient, plural FROM ingredients WHERE ID=?");
$stmt ->bind_param("s", $ingredient_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$setup= $array->fetch_assoc();

$ingredient=$setup['ingredient'];


?>	
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="type" size="1" value="edit" readonly/>	
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>	
<input type="hidden" name="ID" size="1" value="<?php echo $ID;?>" readonly/>	

<p>
<hr />
<ul>
<li id=quant><label for="quantity"><span style="color:red;">*</span> Quantity:</label></li>
<li id=quantform><input type="text"  name="quantity" size="7" value ="<?php if (!empty($quantity)){ echo $quantity;}?>" required/></li>
</ul>


<ul>
<li id=ing><label for="ingredient"><span style="color:red;">*</span> Ingredient:</label></li>
<li id=ingform><select name='ingredient' required><option value=""></option>


<?php           
$result2 = $conn->query("select ingredient, ingredient from ingredients ORDER BY ingredient ASC");
   while ($row = $result2->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['ingredient'];
                  $name = $row['ingredient']; 
                  if ($name == $ingredient) { echo '<option value="'.$id.'"selected>'.$name.'</option>';} 
                  else{echo '<option value="'.$id.'">'.$name.'</option>';}                
}
?>
</select>
</li></ul>
<?php

if (!empty($setup['plural'])){
	


echo "<ul><li id=quant><label for=\"quantity\">Tick box for plural: </label></li>
<li id=quantform><input type=\"checkbox\"  name=\"plural\"";
if ($result['plural']===1){echo "checked";}
echo"/></li></ul>"; 
}
?>

<hr>

<label for="Submit"><input type="submit" class="button" name="action-ingredient" value="Update Ingredient" /></p>
</form>
