<?php

// pull and display results from search if it is performed

$search= "%".$_POST["search"]."%";
echo $search;
$searching = $conn->prepare("SELECT ID, title, slug FROM blog WHERE (title LIKE ? OR keywords LIKE ?) ORDER BY ID DESC"); 
$searching->bind_param("ss", $search, $search);
   
$searching ->execute();
$result = $searching->get_result();
$num_results = $result->num_rows;

?>
