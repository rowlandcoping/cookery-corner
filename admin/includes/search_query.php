<?php

// pull and display results from search if it is performed

$search= "%".$_POST["search"]."%";


$searching = $conn->prepare("SELECT ID FROM recipes WHERE (user_name LIKE ? OR title LIKE ? OR complexity LIKE ? OR cuisine LIKE ? OR category LIKE ? OR keywords LIKE ?) 
						UNION SELECT recipe_ID FROM ing_index WHERE (ingredient LIKE ?) ORDER BY ID DESC"); 
$searching->bind_param("sssssss", $search, $search, $search, $search, $search, $search, $search);   
$searching ->execute();
$array = $searching->get_result();






?>
