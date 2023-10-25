<?php if(!isset($_SESSION)){session_start();}
$path = $_SERVER['DOCUMENT_ROOT'];
$loginpath = "$path"."/publiclogin.php";
$logout=$path."/logout";
$config = "$path"."/config.php";
$head= "$path"."/admin/includes/head_pubprofile.php";
$return="$path"."/admin/user_profile.php";
$imgpath = "$path"."/assets/images/recipes";

require_once($config);
require_once($head);


	
$ID=$_GET['recipe-delete'];



$stmt=$conn->prepare("SELECT user_ID, rec_image FROM recipes WHERE ID=?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array=$stmt->get_result();
$result=$array->fetch_assoc();

if (!empty($result)){
if ($_SESSION['role']!="admin") {
	if ($_SESSION['ID']==$result['user_ID']){
		
$oldimage=$result['rec_image'];
		
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}		


$stmt=$conn->prepare ("DELETE FROM cuisine_index WHERE recipe_ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();
$stmt=$conn->prepare ("DELETE FROM recipe_cat_index WHERE recipe_ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();
$stmt=$conn->prepare ("DELETE FROM ing_index WHERE recipe_ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();
$stmt=$conn->prepare ("DELETE FROM notifications WHERE recipe_ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();
$stmt=$conn->prepare ("DELETE FROM recipes WHERE ID=?");
$stmt->bind_param ("i", $ID);
if ($stmt->execute()=== TRUE) {$message="<h3><span style=\"color:green;\">Incomplete Recipe Deleted</span></h3>"; include ($return); exit();}
}else {$messager="Something went wrong"; include ($return); exit();}}}else {include ($return); exit();}

