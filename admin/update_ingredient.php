<?php session_start();?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/ingredients";
$imgprocess = "$path"."/admin/includes/imageprocess.php";

//paths to ingredient includes
$ingredientupdate = "$path"."/admin/includes/ingredient_update/ingredient_update.php";
$ingredientdelete = "$path"."/admin/includes/ingredient_update/ingredient_delete.php";
//
$ingredientactions = "$path"."/admin/includes/ingredient_update/ingredient_actions.php";
$deleteactions = "$path"."/admin/includes/ingredient_update/delete_actions.php";

require_once($config);
require_once($head);

function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

/////WHEN INGREDIENT SELECTED (STRAIGHT TO UPDATE PAGE) /////

if (isset($_POST['select'])) {
if (!empty($_POST['ing'])){
include($ingredientupdate);
}}

////INGREDIENT ACTIONS////

if (isset ($_POST['submit'])) {
	
include($ingredientactions);
}

////DELETE ACTIONS//
if (isset ($_POST['delete-ingredient'])) {
	
include($deleteactions);
}



////////SELECT INGREDIENT TO UPDATE///////
?>
<h3>Update Ingredient</h3>
<hr />
<?php if (isset ($_POST['select']) && empty($_POST['ing'])){echo "<span style=\"color:red;\"><h4><ul><li id=ing>*Please select ingredient to update*</h4></span></li></ul>";}?>
<form action="/admin/update_ingredient.php" method="POST" enctype="multipart/form-data">
<ul>
<li id=ing>Select ingredient to update from drop-down: &nbsp</li>
<li id=ing><select name="ing"><option value =""></option>
<?php           
$result = $conn->query("select ingredient, ingredient from ingredients ORDER BY ingredient ASC");
?>

<?php
   while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['ingredient'];
                  $name = $row['ingredient']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';               
}
?>
</select>
</li></ul>
<hr />
<input type="submit" class="button" name="select" value="Select" />
</form>
<h4><a href="\admin\admin.php">Return to Profile</a></h4>

