</p><div class=section1>
<form action="/admin/recipe_entry.php" method="POST" enctype="multipart/form-data">
<h2>Stage 1 of 8 - Basic Info</h2>
<?php if (!empty($message)){echo "<hr><h3>&nbsp<span style=\"color:red;\">!---&nbsp".$message."&nbsp---!</h3><hr>";}?>
<div class=section>

<div class=left>

<ul>
<li id=recipe><label for="form"><span style="color:red;">*</span>Recipe Title:</li>
<li id=recform><input type="text"  name="title" value="<?php if (!empty ($title)) { echo $title;}?>" maxlength="31" required/></li>
</ul>

<ul>
<li id=serves><label for="serves"><span style="color:red;">*</span>Serves:</li>
<li id=serform><input type="text"  name="serves" value="<?php if (!empty ($serves)) { echo $serves;}?>" required/><p class=caption1>Numerical values only (eg 1,2,3)</p></li>
</ul>

<ul>
<li id=cuisine><label for="cuisine"><span style="color:red;">*</span>Cuisine Type:</label></li>
<li id=cuisform><select name='cuisine' required>
<?php           
$result = $conn->query("select cuisine, cuisine from cuisine ORDER BY cuisine ASC");
?>

<?php
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
$result = $conn->query("select category, category from recipe_category ORDER BY category ASC");
?>

<?php
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
<input type="text"  name="keywords" value="<?php if (!empty ($keywords)) { echo $keywords;}?>"><p class=caption2>Separate keywords with comma</p></li>
</ul>

<ul>
<li id=image><label for="image"><span style="color:red;">*</span>Recipe Image:</label></li>
<li id=imgform>
<input type="file" required name="rec_image"><p class=caption3>Find something online if you have no picture!</p>
</li>
</ul>
<hr />
<h4>Can't find a category? Request it <a href="/admin/request.php" target="_blank">here!</a></h4>
</div>



<div class=left>
<br><label for="description"><h4><span style="color:red;">*</span>Brief Description:</h4></label><p class=info> This appears on search results</p>
<br><textarea name="description" required rows="11" cols="53"><?php if (!empty ($description)) { echo $description;}?></textarea>
</p>

</div>
</div>
<label for="basic-entry"><input type="submit" class="button" name="basic-entry" value="Move on to Next Section" />
</form>
</div>
<h4><a href="\admin\admin.php">Return to Profile</a></h4>

<h4> Go back to the <a href="/index.php">homepage</a>
<br /><a href="/logout">Log out</a></h4>

