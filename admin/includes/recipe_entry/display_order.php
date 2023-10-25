<?php

if ($form_ID==="up") {
$new_order=$display_order-1;


$stmt = $conn->prepare("SELECT ID FROM ing_index WHERE display_order=? AND recipe_ID=?");
$stmt->bind_param("ss", $new_order, $recipe_ID); 
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$exist_ID= $result['ID'];


$stmt = $conn->prepare("UPDATE ing_index SET display_order=? WHERE ID=?");
$stmt->bind_param("ss", $display_order, $exist_ID); 
$stmt->execute();
$stmt = $conn->prepare("UPDATE ing_index SET display_order=? WHERE ID=?");
$stmt->bind_param("ss", $new_order, $ID); 
$stmt->execute();
}

if ($form_ID==="down") {
$new_order=$display_order+1;

$stmt = $conn->prepare("SELECT ID FROM ing_index WHERE display_order=? AND recipe_ID=?");
$stmt->bind_param("ss", $new_order, $recipe_ID); 
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$exist_ID= $result['ID'];

$stmt = $conn->prepare("UPDATE ing_index SET display_order=? WHERE ID=?");
$stmt->bind_param("ss", $display_order, $exist_ID); 
$stmt->execute();

$stmt = $conn->prepare("UPDATE ing_index SET display_order=? WHERE ID=?");
$stmt->bind_param("ss", $new_order, $ID); 
$stmt->execute();
}

?>
