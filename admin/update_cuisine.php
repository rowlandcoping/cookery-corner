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
	
if (!empty($_POST['cuisine'])) {

$cuisine =$_POST['cuisine'];
$stmt=$conn->prepare("SELECT ID, cuisine, description from cuisine WHERE cuisine=? LIMIT 1");
$stmt ->bind_param ("s", $cuisine);
$stmt ->execute();
$cuisines=$stmt->get_result();
$result= $cuisines->fetch_assoc();

$description=$result['description'];
$cuisine=$result['cuisine'];
$ID=$result['ID'];

?>
<form action="/admin/update_cuisine.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $ID;?>">
<input type="hidden" name="existing" size="1" value="<?php echo $cuisine;?>">
<?php

echo "<h2>Update <a href=\"/cuisine/".$cuisine."\" target=\"_blank\" rel=\"noreferrer noopener\">".$cuisine."</a></h2>
<h4><a href=\"\admin\update_cuisine.php\">Select a different cuisine</a>
<br><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>
<div class=regular2>



<h3>Enter new value:</h3>
<input type=\"text\"  name=\"cuisine\" value =\"".$cuisine."\"/>
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
</div>


<?php


?>
<p>
<label for="Submit"><input type="submit" class="button" name="submit" value="Update Cuisine" />
</p>



<?php
echo "</form>";
exit();
}else{echo"<h3><span style =\"color:red\">Please select a cuisine</span></h3>";} 

}

// UPDATE CATEGORY

echo "<h3>";
if (isset ($_POST['submit'])) {



$cuisine=$_POST['cuisine'];
$description=$_POST['description'];
$ID=$_POST['ID'];
$existing=$_POST['existing'];
$slug= makeSlug($cuisine);


$stmt=$conn->prepare("UPDATE cuisine SET cuisine=?, description=?, slug=? WHERE ID=?");
$stmt->bind_param("ssss", $cuisine, $description, $slug, $ID);
$stmt->execute();

$stmt=$conn->prepare("UPDATE recipes SET cuisine=? WHERE cuisine=?");
$stmt->bind_param("ss", $cuisine, $existing);
if ($stmt->execute()===TRUE) {echo "<span style =\"color:green\">Cuisine updated</span></h3>";}else {echo"This did not work";}
}


?>
</h3></i>
<form action="/admin/update_cuisine.php" method="POST" enctype="multipart/form-data">
<ul>
<li id=cuisine>Select category to update from drop-down: </li>
<li id=cuisine><select name="cuisine"><option value =""></option>
<?php           
$result = $conn->query("select cuisine, cuisine from cuisine ORDER BY cuisine ASC");
?>

<?php
   while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['cuisine'];
                  $name = $row['cuisine']; 
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
