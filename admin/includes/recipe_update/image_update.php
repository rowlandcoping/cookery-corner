<?php

$stmt=$conn->prepare("SELECT ID, user_ID, rec_image, stage FROM recipes WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$image=$result['rec_image'];
$stage= $result['stage'];
$size=filesize("$imgpath"."/"."$image")/1000;
$rec_usr = $result['user_ID'];
$user = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}

if ($stage<9) {echo"
<form action=\"/admin/recipe_entry.php\" method=\"POST\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"ID\" size=\"1\" value=\"".$post_id."\" readonly/>
<input type=\"hidden\" name=\"stage\" size=\"1\" value=\"".$stage."\" readonly/>
<input type=\"hidden\" name=\"oldimage\" value=\"".$image."\" readonly/>";
}else{echo"
<form action=\"/admin/update_recipe.php\" method=\"POST\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"ID\" size=\"1\" value=\"".$post_id."\" readonly/>
<input type=\"hidden\" name=\"stage\" size=\"1\" value=\"".$stage."\" readonly/>
<input type=\"hidden\" name=\"oldimage\" value=\"".$image."\" readonly/>";
}
?>
	
<table>
<th>Current Image</th>
<th>Image Size</th>
<th>Update Image</th>

<tr><td><?php echo "<img src=\"/assets/images/recipes/".$image."\"width=\"291\"/>";
?>
</td>
<td>Size: <?php echo round($size, 2)." kb";?></td>
<td>  
<ul>
<li id=image><label for="image"><span style="color:red;">*</span>Recipe Image:</label></li>
<li id=imgform>
<input type="file" required name="rec_image"><p class=caption3>Find something online if you have no picture!</p>
<input type="hidden" name="oldimage" value="<?php echo $image;?>" readonly/>
</li>
</ul></td></tr>


</table>
<p>
<label for="Submit"><input type="submit" class="button" name="image" value="Update Image" />
</p>
</form>
<?php if ($stage<9){echo"<h4>

<a href=\"/admin/recipe_entry.php?review-submit=".$post_id."\">Review a different section or finalise recipe</a><br>";
if ($_SESSION['role']==="admin") {echo "<a href=\"/admin/recipe_entry.php\">Go back to add recipe page</a><br />";}
echo "<a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";;
}else{echo"

<h4><a href=\"/admin/update_recipe.php?edit-recipe=".$post_id."\">Update a different section</a>
<br><a href=\"/admin/update_recipe.php\">Select a different recipe</a>
<br /><a href=\"/admin/admin.php\">Return to profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";
}
exit();
?>























?>
