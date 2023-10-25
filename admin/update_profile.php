<?php session_start();?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_pubprofile.php";
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/profile";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
$return="$path"."/admin/admin.php";

require_once ($config);
require_once ($head);

if (isset($_POST['update-profile'])) {

function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

$ID=$_POST['ID'];
$user=$_POST['user'];
$stmt = $conn->prepare("SELECT name FROM users WHERE name=? AND ID!=?");
$stmt->bind_param("si", $user, $ID);
$stmt ->execute();				
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

if (!empty($result)) {$notice="<span style=\"color:red;\">Update failed - this name is already in use.</span>";}

else{

$user=$_POST['user'];
$slug= makeSlug($user);
if (!empty($_POST['description'])) {$description=$_POST['description'];}else{$description="";}
if (!empty($_POST['profile'])) {$profile= $_POST['profile'];}else{$profile="";}
if (!empty($_POST['oldimage'])){$oldimage=$_POST['oldimage'];}


if(!empty($_FILES["image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['image']['tmp_name'];
$oldimage=$_POST['oldimage'];

require ($imgprocess);

if (!empty($oldimage)) {if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}}
$image = $newname;
}else{if (empty($_FILES["image"]["name"]) && !empty($_POST['remove'])){
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$image="";
}else{$image = $oldimage;}
}


$stmt=$conn->prepare("UPDATE users SET name=?, slug=?, food_pro=?, profile_pic=?, profile=? WHERE ID=?");
$stmt ->bind_param("ssssss", $user, $slug, $description, $image, $profile, $ID);
if ($stmt->execute()=== TRUE) {$message="<h3><span style=\"color:green;\">Profile Updated</span></h3>"; include ($return); exit();}
else{$message="<h3><span style=\"color:red;\">You Have Failed - Profile Not Updated</span></h3>";include ($return); exit();}
}}

///Form section

if(empty($ID)) {$ID=$_GET['update-profile'];}

$stmt=$conn->prepare("SELECT ID, name, slug, food_pro, profile_pic, profile FROM users WHERE ID=?");
$stmt ->bind_param("i", $ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

$user=$result['name'];
$slug=$result['slug'];
$food_pro=$result['food_pro'];
$image=$result['profile_pic'];
$profile=$result['profile'];
$rec_usr = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!=$ID)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}
?>

<form action="/admin/update_profile.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" value="<?php echo $ID;?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $image;?>" readonly/>

<div class=container>
<div class=section1>

<h2>Update Profile</h2>

<div class=section>
<div class=left>
<?php if (isset($notice)) {echo "$notice";}?>

<ul>
<li id=recipe><label for="user"><span style="color:red;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp* </span>Name:</li>
<li id=recform><input type="text"  name="user" value="<?php echo $user;?>" maxlength="40" required/></li>
</ul>

<ul>
<li id=recipe><label for="description">Description:</li>
<li id=recform><input type="text"  name="description" value="<?php echo $result['food_pro'];?>" size="50"/>
</ul>
<hr />
<ul>
<li id=recipe><label for="image">Update Main Image:</label></li>
</ul>


<?php if (!empty($image)) {echo "<img src=\"/assets/images/profile/".$image."\"width=\"100\"/>";}else{echo"<i>No image uploaded</i>";}?>


<ul>
<li id=recipe><input type="file" name="image"></li>
<p>Remove Image: <input type="checkbox" name="remove" value="YES"></p>
</ul>

<hr />
<ul>
<li id=recipe>Update Profile:
<p><textarea name="profile"><?php echo $profile;?></textarea></p>
</ul>
<script>
            CKEDITOR.replace( 'profile' );
</script>

<p>
<label for="Submit"><input type="submit" class="button" name="update-profile" value="Update" />
</p>
</form>
</div>
</div>
</div>


<h4><a href="/admin/admin.php">Return to profile</a>
<br /><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
