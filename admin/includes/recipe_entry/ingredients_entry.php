<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

if (empty($recipe_ID)) {

$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, description, add_ingred, stage FROM recipes WHERE description=?");
$stmt ->bind_param("s", $description);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$recipe_ID=$result['ID'];
}else{
$stmt=$conn->prepare("SELECT ID, user_ID, title, titslug, description, add_ingred, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $recipe_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();	
}	
$stage=$result['stage'];
$title= $result['title'];
$slug=$result['titslug'];
$description = $result['description'];
$add_ingred = $result['add_ingred'];
$rec_usr = $result['user_ID'];
$user = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}



$stmt=$conn->prepare("SELECT ID, ingredient_ID, ingredient, quantity, slug, display_order FROM ing_index WHERE recipe_ID=? ORDER BY display_order ASC");
$stmt ->bind_param("s", $recipe_ID);
$stmt ->execute();
$result = $stmt ->get_result();
$num_results = $result->num_rows;
$display_order=$num_results+1;

if ($num_results>24) {
	$complexity="Masterchef";
}else{   
          
if ($num_results>14) {
	$complexity="Date night";
 }else {
 if   ($num_results>5) {
	$complexity="Everyday"; 
} else {$complexity="Simple";}}}
?>
<div class=section2>
<h2><?php if ($stage<9) {echo "Stage 2 of 8 - ";}?>Ingredients for "<?php echo "<a href=\"/recipe/".$slug."\" target=\"_blank\">".$title."</a>\"</h2>";?>
<?php if (!empty($message)){echo "<hr><h3>&nbsp<span style=\"color:red;\">!---&nbsp".$message."&nbsp---!</h3><hr>";}?>
<div class=ingredients>
<div class=holding>
<div class=left>

<div class=listing>
<h3>Ingredients:</h3>

<?php
if (!empty($result)) {
foreach ($result as $r) {
	
echo "<p><a class=\"fa fa-trash btn edit\" href=\"/admin/recipe_entry.php?delete-ingredient=".$r['ID']."&recipe-id=".$recipe_ID."&display-order=".$r['display_order']."\"></a>&nbsp|";
echo" <a class=\"fa fa-pencil btn edit\" href=\"/admin/recipe_entry.php?edit-ingredient=".$r['ID']."&recipe-id=".$recipe_ID."\"></a>&nbsp|&nbsp";
		if ($r['display_order']>"1"){
echo"<a class=\"fa fa-arrow-up\" href=\"/admin/recipe_entry.php?order-up=".$r['ID']."&display-order=".$r['display_order']."&recipe-id=".$recipe_ID."\"></a>&nbsp";
	}else{
echo "<a class=\"fa fa-ban\"></a>&nbsp";}
		if ($r['display_order']<$num_results){
echo "<a class=\"fa fa-arrow-down\" href=\"/admin/recipe_entry.php?order-down=".$r['ID']."&display-order=".$r['display_order']."&recipe-id=".$recipe_ID."\"></a>&nbsp|&nbsp";
	}else{
echo "<a class=\"fa fa-ban\"></a>&nbsp|&nbsp";}
echo $r['quantity']."&nbsp<a href=\"/ingredient/".$r['slug']."\"target=\"_blank\">".$r['ingredient']."</a></p>";
		
}}
?>
</div>
<h4>current complexity - <?php echo lcfirst($complexity)."</h4>";

echo "<p><a class=\"fa fa-plus btn basic\" href=\"/admin/recipe_entry.php?ingredient-add=".$recipe_ID."&display-order=".$display_order."\"></a> Add an Ingredient</p>";
if ($stage<8) {echo "<p><a class=\"fa fa-plus btn basic\" href=\"/admin/recipe_entry.php?ingredient-notes=".$recipe_ID."\"></a> Add Ingredient Notes</p>";
		}else{echo "<p><a class=\"fa fa-plus btn basic\" href=\"/admin/recipe_entry.php?ingredient-notes=".$recipe_ID."\"></a> Edit Ingredient Notes</p>";}

If (!empty($form_ID)){ if ($form_ID==="add") {include($addingredient);
}else{ if ($form_ID==="edit") {include($editingredient);
}else{ if ($form_ID==="delete") {include($deleteingredient);
}else{ if ($form_ID==="notes") {include($ingrednotes);
}}}}}
?>
<hr />
<h4>Can't find an ingredient? Request it <a href="/admin/request.php" target="_blank">here!</a></h4>


</div>
	
<div class=left>
	

<h3>Weights and Measures:</h3>
<p>Please list all ingredients using metric measurements.</p>
<p>Click <a href ="https://www.inchcalculator.com/convert/weight/" target="_blank">here</a> to convert weight.
<br>Click <a href ="https://www.inchcalculator.com/convert/volume/" target="_blank">here</a> to convert volume.</p>
<p>Cookery Corner suggests rounding to the nearest 5 ml/g/whatever.</p>



<p>Quantity can be either an amount or a description.
<br /> Ingredients appear here as they will on the page.</p>

<hr />

<h3>Current Ingredient Notes:</h3>
<?php if(!empty($add_ingred)){ echo $add_ingred;}else{echo"<i>Select 'Add Ingredient Notes' to update this section</i>";}?>


</div>
</div>
</div>
<?php if ($num_results>"1") { if ($stage===8){echo"<form>
<form action=\"/admin/recipe_entry.php\" method=\"GET\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"recipe_ID\" size=\"1\" value=\"".$recipe_ID."\" readonly/>
<label for=\"reviewsubmit\"><input type=\"submit\" class=\"button\" name=\"reviewsubmit\" value=\"Finish Updating Ingredients\" />
</form>";
}else{if ($stage<8) {
echo "<form>
<form action=\"/admin/recipe_entry.php\" method=\"GET\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"recipe_ID\" size=\"1\" value=\"".$recipe_ID."\" readonly/>
<label for=\"finish\"><input type=\"submit\" class=\"button\" name=\"finish\" value=\"Move on to Next Section\" />
</form>";
}else{if ($stage>8) {echo "<form>
<form action=\"/admin/update_recipe.php\" method=\"GET\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"recipe_ID\" size=\"1\" value=\"".$recipe_ID."\" readonly/>
<label for=\"finish\"><input type=\"submit\" class=\"button\" name=\"finish-update\" value=\"Finish Updating Ingredients\" />
</form>";
}}}}
?>
</div>

</div>
<?php 

if ($stage<9){ echo"<h4>";
					if ($stage===8) {echo"
<a href=\"/admin/recipe_entry.php?review-submit=".$recipe_ID."\">Review a different section or finalise recipe</a><br />";}
if ($_SESSION['role']==="admin") {echo "<a href=\"/admin/incomplete_recipes.php\">Go back to incomplete recipe page</a><br />";}
echo "<a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}else{echo"

<h4><a href=\"/admin/update_recipe.php?edit-recipe=".$recipe_ID."\">Update a different section</a>
<br /><a href=\"/admin/update_recipe.php\">Select a different recipe</a>
<br /><a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4> Go back to the <a href=\"/index.php\">homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}
exit();
?>
