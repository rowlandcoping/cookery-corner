<?php if (!empty($ingredient))	{

?>	

<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="type" size="1" value="add" readonly/>	
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>	
<input type="hidden" name="display_order" size="1" value="<?php echo $display_order;?>" readonly/>
<input type="hidden" name="complexity" size="1" value="<?php echo $complexity;?>" readonly/>		
	
<p>
	<hr>
<ul>
<li id=quant><label for="quantity"><span style="color:red;">*</span> Quantity:</label></li>
<li id=quantform><input type="text"  name="quantity" size="7" required/></li>
</ul>
<ul>
<li id=ing><label for="ingredient"><span style="color:red;">*</span> Ingredient:</label></li>
<li id=ingform><select name='ingredient' required><option value =""></option>
</ul>

<?php           
$result = $conn->query("select ingredient, ingredient from ingredients ORDER BY ingredient ASC");
   while ($row = $result->fetch_assoc()) {
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
$stmt=$conn->prepare("SELECT plural FROM ingredients WHERE ingredient=?");
$stmt->bind_param("s", $ingredient);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();

if (!empty($result['plural'])){

echo "<ul><li id=quant><label for=\"quantity\">Tick box for plural: </label></li>
<li id=quantform><input type=\"checkbox\"  name=\"plural\"/></li>
</ul>"; 
}
?>

<hr>
<label for="Submit"><input type="submit" class="button" name="action-ingredient" value="Add Ingredient" /></p>
</form>
<?php

}else{
?>

<hr />	

<?php


if (empty($_POST['search'])) {}else{

	
$listing="Search Results for \"".$_POST['search']."\":";


$search= "%".$_POST["search"]."%";
$stmt = $conn->prepare("SELECT ID, ingredient FROM ingredients WHERE (ingredient LIKE ?) ORDER BY ID DESC"); 
$stmt->bind_param("s", $search);   
$stmt ->execute();
$array = $stmt->get_result();
$result=$array->fetch_assoc();
$num_results=$array->num_rows;

if ($num_results===0){echo "<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{echo "<h4>Click to select an ingredient:</h4><p>";

foreach ($array as $r) {

echo	"<a href=\"/admin/recipe_entry.php?selected-ingredient=".$r['ingredient']."&recipe-id=".$recipe_ID."\"> - ".$r['ingredient']."</a><br />";
}}
}





?>
</p>
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>	
<p>Find ingredient: <input type="text" name="search"/>&nbsp;&nbsp;<input type="submit" class="ingsearch" name="ing-search" value="^^^" /></p>
</form>

<?php
}
?>
