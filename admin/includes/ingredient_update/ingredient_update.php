<?php
$ing =$_POST['ing'];
$stmt=$conn->prepare("SELECT ID, ingredient, plural, ing_image, information, slug from ingredients WHERE ingredient=? LIMIT 1");
$stmt ->bind_param ("s", $ing);
$stmt ->execute();
$ingredients=$stmt->get_result();
$result= $ingredients->fetch_assoc();

$information=$result['information'];
$image=$result['ing_image'];
$slug=$result['slug'];
$size=filesize("$imgpath"."/"."$image")/1000;
$ingredient=$result['ingredient'];
$plural=$result['plural'];
$ID=$result['ID'];

echo "<h2>Update <a href=\"/ingredient/".$slug."\" target=\"_blank\" rel=\"noreferrer noopener\">".$ingredient."</a></h2>";
if (!empty($message)) {echo "<h3><span style=\"color:red;\">".$message."</span></h3>";}
?>
<form action="/admin/update_ingredient.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" value="<?php echo $ID;?>" readonly/>
<input type="hidden" name="existing" value="<?php echo $ingredient;?>" readonly/>
<input type="hidden" name="oldplur" value="<?php echo $plural;?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $image;?>" readonly/>

<?php

echo "<div class=regular2>


<h3><span style=\"color:red;\">Delete <input type=\"checkbox\"  name=\"delete\" value =\"delete\"/></span>
<hr />
<h3>Update ingredient name:  <input type=\"text\"  name=\"ingredient\" value =\"".$ingredient."\" required/>
<h3>Update/add plural: <input type=\"text\"  name=\"plural\" value =\"".$plural."\"/></h3>
</div>";



//IMAGE UPDATE

?>

	<div class=regular2>
	<h3>Update Image:</h3>
	


<table border=1>

<th>Current Image</th>
<th>Image Size</th>
<th>Update Image</th>

<tr><td><?php if (!empty($image)){echo "<img class=\"segment\" src=\"/assets/images/ingredients/".$image."\"width=\"150\"/></div>";
}else{echo"&nbsp No image uploaded at present &nbsp";}?>
</td>
<td>&nbsp Size: <?php echo $size." kb &nbsp";?></td>
<td>  
<ul>

<li id=imgform>
<br /><input type="file" name="image">
<p>Remove Image: <input type="checkbox" name="remove" value="YES"></p>
</li>

</ul></td></tr>


</table>
</div>




<div class=regular2>
	<h3>Update Information:</h3>
<p><textarea name="info" rows="5" cols="50"><?php echo $information;?></textarea>
</p>
</div>
<script>
            CKEDITOR.replace( 'info' );
</script>



<?php


?>
<p>
<label for="Submit"><input type="submit" class="button" name="submit" value="Update Ingredient" />
</p>
</form>

<?php echo "<h4><a href=\"\admin\update_ingredient.php\">Select a different ingredient</a>
<br /><a href=\"\admin\admin.php\">Return to Profile</a></h4>

<h4><a href=\"/index.php\">Go back to the homepage</a>
<br /><a href=\"/logout\">Log out</a></h4>";


exit();

?>

