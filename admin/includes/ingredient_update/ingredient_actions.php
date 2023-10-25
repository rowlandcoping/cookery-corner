<?php

$ing=$_POST['ingredient'];
$plural=$_POST['plural'];
$info=$_POST['info'];
$ID=$_POST['ID'];
$existing=$_POST['existing'];
$oldplur=$_POST['oldplur'];
$slug= makeSlug($ing);
$oldimage = $_POST['oldimage'];

if (!empty ($_POST['delete'])) {
include($ingredientdelete);
exit();
}
//handle image
if (!empty($_FILES["image"]["name"])) {
	
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['image']['tmp_name'];

require ($imgprocess);
if (!empty($oldimage)) {unlink("$imgpath"."/"."$oldimage");}
$image = $newname;
}else{if (empty($_FILES["image"]["name"]) && !empty($_POST['remove'])){
if (!empty($oldimage)){unlink("$imgpath"."/"."$oldimage");}
$image="";
}else{$image = $_POST['oldimage'];}
}


$stmt=$conn->prepare("UPDATE ingredients SET ingredient=?, plural=?, ing_image=?, information=?, slug=? WHERE ID=?");
$stmt->bind_param("ssssss", $ing, $plural, $image, $info, $slug, $ID);

if ($stmt->execute()===TRUE) {$message="Ingredient Updated";}else {$message="This did not work";}

//UPDATE RECIPES - looks like we have to go column by column

if ($existing!=$ing || $plural!=$oldplur) 
{
$stmt=$conn->prepare("UPDATE ing_index SET ingredient=? WHERE ingredient_ID=? AND plural=0");
$stmt->bind_param("ss", $ing, $ID); $stmt->execute();
$stmt=$conn->prepare("UPDATE ing_index SET ingredient=? WHERE ingredient_ID=? AND plural=1");
$stmt->bind_param("ss", $plural, $ID); $stmt->execute();
}

?>
