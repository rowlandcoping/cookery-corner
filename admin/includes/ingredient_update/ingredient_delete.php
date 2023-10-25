<?php
$ID=$_POST['ID'];
$stmt=$conn->prepare("SELECT slug, ingredient FROM ingredients WHERE ID=?");
$stmt ->bind_param("i", $ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result1 = $array->fetch_assoc();

//get array of recipe IDs with this ingredient
$stmt=$conn->prepare("SELECT recipe_ID FROM ing_index WHERE ingredient_ID=? ORDER BY ID ASC");
$stmt->bind_param("s", $ID);
$stmt->execute();				
$array2=$stmt->get_result();

//get number of results affected
$i=0;
foreach ($array2 as $recid) {

$ID2= $recid['recipe_ID'];
$excellent=$conn->prepare("SELECT ID FROM recipes WHERE ID=?");
$excellent->bind_param("s", $ID2);
$excellent->execute();				
$outcome2=$excellent->get_result();


foreach ($outcome2 as $index){

	$i++;
}
}
$num_results=$i;

?>



<h1><span style="color:red;">-----IMPORTANT QUESTION-----</span></h1>

<h2>Do you <span style="color:red;">REALLY</span> want to delete forever the ingredient: "<?php echo "<a href=\"/ingredient/".$result1['slug']."\" target=\"_blank\">".$existing."</a>";?>"</h2>
<h2>I mean, really really???</h2>




<hr />
<h2><span style="color:red;">--WARNING--</h2></span>
<h3>The following <span style="color:red;"><?php echo $num_results;?></span> recipes will be affected:</h3>

<?php

//select details of affected recipes
foreach ($array2 as $recid) {

$ID2= $recid['recipe_ID'];
$stmt2=$conn->prepare("SELECT title, titslug FROM recipes WHERE ID=?");
$stmt2->bind_param("s", $ID2);
$stmt2->execute();				
$array3=$stmt2->get_result();
	
	foreach ($array3 as $row) {
  
    echo"<div><h3><a href=\"/recipe/".$row['titslug']."\" target=\"_blank\">".$row['title']."</h3></a></p></div>";
	
}
}
?>


<h4>Please note that on deletion all above listed recipes will be set to preview and should be checked before setting back live.
<br />You will receive notification of this in your profile.</h4>

<hr />
<form action="/admin/update_ingredient.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $ID;?>" readonly/>

<label for="delete-ingredient"><input type="submit" class="button" name="delete-ingredient" value="I don't care about your 'warnings', DO IT" />
</form>
<hr />
<h2><a href="https://c.tenor.com/9mLPT5v1ah8AAAAd/how-to-introduce-your-cat-to-a-bunny-cat.gif" target=_blank>Noooooooo..... Wait.....Stop..... Help me!!!</a></h2>

<h4><a href="\admin\update_ingredient.php">Update a different ingredient</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
<?php
exit ();
?>

