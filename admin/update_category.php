<?php session_start();?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";

require_once($config);
require_once($head);

function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace("'", '', $string);
	$string = str_replace("-", ' ', $string);	
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

if (isset($_POST['select'])) {
	
if (!empty($_POST['category'])) {

$category =$_POST['category'];
$stmt=$conn->prepare("SELECT ID, category, description from recipe_category WHERE category=? LIMIT 1");
$stmt ->bind_param ("s", $category);
$stmt ->execute();
$categories=$stmt->get_result();
$result= $categories->fetch_assoc();

$description=$result['description'];
$category=$result['category'];
$ID=$result['ID'];
?>
<form action="/admin/update_category.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $ID;?>">
<input type="hidden" name="existing" size="1" value="<?php echo $category;?>">
<?php

echo "<h2>Update <a href=\"/category/".$category."\" target=\"_blank\" rel=\"noreferrer noopener\">".$category."</a></h2>
<h4><a href=\"\admin\update_category.php\">Select a different category</a>
<br><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>
<div class=regular2>



<h3>Enter new value:</h3>
<input type=\"text\"  name=\"category\" value =\"".$category."\"/>
</div>";

?>





<div class=regular2>
	<h3>Update Information:</h3>
<p>Update general info about this category.</p>
<p><textarea name="description" rows="10" cols="60"><?php echo $description;?></textarea>
</p>
</div>
<script>
            CKEDITOR.replace( 'description' );
</script>


<?php


?>
<p>
<label for="Submit"><input type="submit" class="button" name="submit" value="Update Category" />
</p>



<?php
echo "</form>";
exit();
}else{echo"<h3><span style =\"color:red\">Please select a category</span></h3>";} 

}

// UPDATE CATEGORY

echo "<h3>";
if (isset ($_POST['submit'])) {



$category=$_POST['category'];
$description=$_POST['description'];
$ID=$_POST['ID'];
$existing=$_POST['existing'];
$slug= makeSlug($category);


$stmt=$conn->prepare("UPDATE recipe_category SET category=?, description=?, slug=? WHERE ID=?");
$stmt->bind_param("ssss", $category, $description, $slug, $ID);
$stmt->execute();

$stmt=$conn->prepare("UPDATE recipes SET category=? WHERE category=?");
$stmt->bind_param("ss", $category, $existing);
if ($stmt->execute()===TRUE) {echo "<span style =\"color:green\">Category updated</span></h3>";}else {echo"This did not work";}
}


?>
</h3></i>
<form action="/admin/update_category.php" method="POST" enctype="multipart/form-data">
<ul>
<li id=category>Select category to update from drop-down: </li>
<li id=category><select name="category"><option value =""></option>
<?php           
$result = $conn->query("select category, category from recipe_category ORDER BY category ASC");
?>

<?php
   while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['category'];
                  $name = $row['category']; 
                  echo '<option value="'.$id.'">'.$name.'</option>';               
}
?>
</select>
</li></ul>

<input type="submit" class="button" name="select" value="Select" />
</form>
<h4><a href="\admin\admin.php">Return to Profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></h4>
