<div class='latest'>

<h2>Latest Features:</h2>

<?php

require_once('includes/recipe_process.php');

$query=("SELECT * from recipes ORDER BY ID DESC
");

$posts = $conn->query($query);  //runs the query - returns result object (as opposed to result resource with procedural version).  Either way result stored as variable $result for later use, and returns FALSE on failure.
// Procedural Version:  $result = mysqli_query($db, $query);
$num_results = $posts->num_rows;  //with object oriented approach, number of rows is stored in the num_rows member of the $result object.  This stores it as $num_results
//Preocedural Approach:  $num_results = mysqli_num_rows($result);
	//Procedural Version:  $row = mysqli_fetch_assoc($result); 

for ($i=0;  $i <$num_results ; $i++) {   //knowing the number of results means you can loop through them when displaying them - code processes these results
	$row = $posts->fetch_assoc();  //takes each row from the resultset and returns as an array, with each key an attribute name and the value, well, you know, the value.
	//Procedural Version:  $row = mysqli_fetch_assoc($result);
	
echo "<div class=\"segment\">";
echo "<p class=\"time\"><a href=\"recipe/";
echo $row['titslug'];
echo "\"><h3>";
echo $row['title'];
echo "</h3></a>";
echo "</p>";
echo "<p class=\"content\">";
echo ($row['description']);
echo "</p>";
echo "</div>";

}

?>
</div>
