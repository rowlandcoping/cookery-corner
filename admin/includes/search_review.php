<?php

// pull and display results from search if it is performed

$search= "%".$_POST["search"]."%";
$searching = $conn->prepare("SELECT ID, title, slug, description FROM reviews WHERE (title LIKE ? OR intro LIKE ? OR heading1 LIKE ? OR heading2 LIKE ? OR heading3 LIKE ? OR 
							heading4 LIKE ? OR heading5 LIKE ? OR heading6 LIKE ? OR heading7 LIKE ? OR heading8 LIKE ?) ORDER BY ID DESC"); 
$searching->bind_param("ssssssssss", $search, $search, $search, $search, $search, $search, $search, $search, $search, $search);
   
$searching ->execute();
$result = $searching->get_result();
$num_results = $result->num_rows;

?>
