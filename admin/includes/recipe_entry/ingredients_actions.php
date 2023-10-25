<?php

$recipe_ID=$_POST['recipe_ID'];
if (!empty($_POST['complexity'])) {$complexity=$_POST['complexity'];}


/////HANDLE COMPLEXITY/////
if (!empty($complexity)) {

$stmt=$conn->prepare("UPDATE recipes SET complexity=? WHERE ID=?");
$stmt->bind_param("ss", $complexity, $recipe_ID);
$stmt->execute();


$stmt = $conn->prepare("SELECT complexity FROM complexity WHERE complexity=? LIMIT 1");
$stmt->bind_param("s", $complexity);
$stmt->execute();
$array=$stmt->get_result();
if (empty($array)) {
$slug=makeSlug($complexity);
$stmt = $conn->prepare("INSERT into complexity (complexity, slug) VALUES (?,?)");
$stmt->bind_param("ss", $complexity, $slug);
$stmt->execute();
}
}

/////ADD INGREDIENT/////
if ($_POST['type']==="add") {
$display_order=$_POST['display_order'];
$ingredient=$_POST['ingredient'];
$plur="0";
//check for dupes
$stmt = $conn->prepare("SELECT display_order FROM ing_index WHERE display_order=? AND recipe_ID=? LIMIT 1");
$stmt->bind_param("ss", $display_order, $recipe_ID);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();
if ($result) {include($ingredientsentry);
						exit();}
//retrieve info					
$stmt = $conn->prepare("SELECT ID, slug, plural FROM ingredients WHERE ingredient=?");
$stmt->bind_param("s", $ingredient); 
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$ingredient_ID=$result['ID'];
$quantity=$_POST['quantity'];
$slug=$result['slug'];

if (!empty($_POST['plural'])) {$ingredient=$result['plural']; $plur="1";}

//add to index
$stmt = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID, ingredient, plural, quantity, slug, display_order) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss",$recipe_ID, $ingredient_ID, $ingredient, $plur, $quantity, $slug, $display_order);
if ($stmt->execute()===TRUE) {
						include($ingredientsentry);
						exit();
					}else {$message="Noooooooo";}
}
////EDIT INGREDIENT/////
if ($_POST['type']==="edit") {
$ID=$_POST['ID'];
$ingredient=$_POST['ingredient'];
$quantity=$_POST['quantity'];
$plur="0";
$stmt = $conn->prepare("SELECT plural FROM ingredients WHERE ingredient=?");
$stmt->bind_param("s", $ingredient); 
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
if (!empty($_POST['plural'])) {$ingredient=$result['plural']; $plur="1";}

$stmt = $conn->prepare("UPDATE ing_index SET ingredient=?, plural=?, quantity=? WHERE ID=?");
$stmt->bind_param("ssss",$ingredient, $plur, $quantity, $ID);
if ($stmt->execute()===TRUE) {
						include($ingredientsentry);
						exit();
					}else {$message="Noooooooo";}
}
/////DELETE INGREDIENT/////
if ($_POST['type']==="delete") {
$ID=$_POST['ID'];
$order=$_POST['order'];
$stmt = $conn->prepare("SELECT ID, display_order from ing_index WHERE recipe_ID=? AND display_order>?");
$stmt->bind_param("ss", $recipe_ID, $order);
$stmt->execute();
$array = $stmt->get_result();

foreach ($array as $r) {
$neworder=$r['display_order']-1;
$nextID=$r['ID'];
$stmt = $conn->prepare("UPDATE ing_index SET display_order=? WHERE ID=?");
$stmt->bind_param("ss",$neworder, $nextID);
$stmt->execute();
}

$stmt=$conn->prepare ("DELETE FROM ing_index WHERE ID=?");
$stmt->bind_param ("s", $ID);
if ($stmt->execute()===TRUE) {
						include($ingredientsentry);
						exit();
					}else {$message="Noooooooo";}
}


/////ADD INGREDIENT INFO/////
if ($_POST ['type']==="notes") {
$add_ingred=$_POST['add_ingred'];
$stmt=$conn->prepare("UPDATE recipes SET add_ingred=? WHERE ID=?");
$stmt->bind_param("ss", $add_ingred, $recipe_ID);
if ($stmt->execute()===TRUE) {
						include($ingredientsentry);
						exit();
					}else {$message="Noooooooo";}
}


	

