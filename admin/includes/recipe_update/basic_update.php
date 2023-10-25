<?php

$stmt=$conn->prepare("SELECT ID, user_ID, title, serves, cuisine, category, keywords, description, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

$title=$result['title'];
$serves=$result['serves'];
$cuisine=$result['cuisine'];
$category=$result['category'];
$keywords=$result['keywords'];
$description=$result['description'];
$stage=$result['stage'];

$rec_usr = $result['user_ID'];
$user = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}


if ($stage<9){echo"<form action=\"/admin/recipe_entry.php\" method=\"POST\" enctype=\"multipart/form-data\">";
}else{echo "<form action=\"/admin/update_recipe.php\" method=\"POST\" enctype=\"multipart/form-data\">";}
?>
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<div class=container>
<div class=section1>

<h2>Update Recipe</h2>


<div class=section>
<div class=left>

<ul>
<li id=recipe><label for="form"><span style="color:red;">*</span>Recipe Title:</li>
<li id=recform><input type="text"  name="title" value="<?php echo $result['title'];?>" maxlength="31" required/></li>
</ul>

<ul>
<li id=serves><label for="serves"><span style="color:red;">*</span>Serves:</li>
<li id=serform><input type="text"  name="serves" value="<?php echo $result['serves'];?>"required/>
<p class=caption1>Numerical values only (eg 1,2,3)</p></li>
</ul>

<ul>
<li id=cuisine><label for="cuisine"><span style="color:red;">*</span>Cuisine Type:</label></li>
<li id=cuisform><select name='cuisine' required>
<?php           
$result = $conn->query("select cuisine from cuisine ORDER BY cuisine ASC");

    while ($row = $result->fetch_assoc()) {
		
		
                  unset($id, $name);
                  $id = $row['cuisine'];
                  $name = $row['cuisine'];
                  if ($name == $cuisine) { echo '<option value="'.$id.'"selected>'.$name.'</option>';}
                   else{ echo '<option value="'.$id.'">'.$name.'</option>';}        
}
?>

</select>



 </ul>
 
 <ul>
<li id=category><label for="category"><span style="color:red;">*</span>Meal Category:</label></li>
<li id=catform><select name='category' required>
<?php        
$result = $conn->query("select category from recipe_category ORDER BY category ASC");

   while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['category'];
                  $name = $row['category'];
                  if ($name == $category) { echo '<option value="'.$id.'"selected>'.$name.'</option>';} 
                  else{echo '<option value="'.$id.'">'.$name.'</option>';}             
}
?>



</select>
</li>
</ul>
<ul>
<li id=keywords><label for="keywords">Keywords:</label></li>
<li id=keyform>
<input type="text" name="keywords" value="<?php echo $keywords;?>"><p class=caption2>Separate keywords with comma</p></li>
</ul>
<hr />
<h4>Can't find a category? Request it <a href="/admin/request.php" target="_blank">here!</a></h4>
</div>


<div class=left>
<br><label for="description"><h4><span style="color:red;">*</span>Brief Description:</h4></label><p class=info> This appears on search results</p>
<br><textarea name="description" required rows="11" cols="53"><?php echo $description;?></textarea>
</p>

</div>
</div>
<p>
<label for="Submit"><input type="submit" class="button" name="update-basic" value="Update Info" />
</p>
</div>
</form>
<?php if ($stage<9){echo"

<h4><a href=\"/admin/recipe_entry.php?review-submit=".$post_id."\">Review a different section or finalise recipe</a>";
if ($_SESSION['role']==="admin") {echo "<br><a href=\"/admin/recipe_entry.php\">Go back to add recipe page</a>";}
echo "<br /><a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}else{echo"

<h4><a href=\"/admin/update_recipe.php?edit-recipe=".$post_id."\">Update a different section</a>
<br /><a href=\"/admin/update_recipe.php\">Select a different recipe</a>
<br /><a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}
exit();
?>

