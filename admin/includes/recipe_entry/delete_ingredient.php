<?php

$stmt=$conn->prepare("SELECT ingredient FROM ing_index WHERE ID=?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$ingredient=$result['ingredient'];
?> 


	<hr>
<h4><span style="color:red">WARNING</span></h4>
<p>This will delete the ingredient: "<?php echo $ingredient?>". Are you sure?</p>
<hr>


<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $ID;?>" readonly/>
<input type="hidden" name="type" size="1" value="delete" readonly/>
<input type="hidden" name="order" size="1" value=<?php echo $order;?> readonly/>
<input type="hidden" name="recipe_ID" size="1" value="<?php echo $recipe_ID;?>" readonly/>
<input type="hidden" name="complexity" size="1" value="<?php echo $complexity;?>" readonly/>	
<label for="Submit"><input type="submit" class="button" name="action-ingredient" value="Make It So" />

</form>
