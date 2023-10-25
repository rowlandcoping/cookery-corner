<?php session_start();?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_pubprofile.php";
$loginpath = "$path"."/publiclogin.php";
$logout=$path."/logout";
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/recipes";
$searchquery = "$path"."/admin/includes/search_query.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
$commonincludes = $path."/admin/includes/update_includes.php";
$return=$path."/admin/admin.php";
//paths to recipe includes
$basicentry = "$path"."/admin/includes/recipe_entry/basic_entry.php";
//
$introentry = "$path"."/admin/includes/recipe_entry/intro_entry.php";
$step1entry = "$path"."/admin/includes/recipe_entry/step1_entry.php";
$step2entry = "$path"."/admin/includes/recipe_entry/step2_entry.php";
$step3entry = "$path"."/admin/includes/recipe_entry/step3_entry.php";
$summaryentry = "$path"."/admin/includes/recipe_entry/summary_entry.php";
$reviewsubmit = "$path"."/admin/includes/recipe_entry/review_submit.php";
//
$basicactions = "$path"."/admin/includes/recipe_entry/basic_actions.php";
$order_actions = "$path"."/admin/includes/recipe_entry/order_actions.php";
$introactions = "$path"."/admin/includes/recipe_entry/intro_actions.php";
$step1actions = "$path"."/admin/includes/recipe_entry/step1_actions.php";
$step2actions = "$path"."/admin/includes/recipe_entry/step2_actions.php";
$step3actions = "$path"."/admin/includes/recipe_entry/step3_actions.php";
$summaryactions = "$path"."/admin/includes/recipe_entry/summary_actions.php";
$finalactions = "$path"."/admin/includes/recipe_entry/finalise_actions.php";
//path to send updates back to update page after changin ingredients
$editpost= "$path"."/admin/includes/recipe_update/edit_post.php";


require_once($commonincludes);
require_once($config);
require_once($head);

function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

function longSlug(String $string, $string2){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace("-", ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string.'-'.$string2);
	return $slug;
}

function makeservSlug(String $string){
	$string = strtolower($string);
	$serslug = ('serves-'.$string);
	return $serslug;
}
?>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>


<body>

<div class=container>
<?php

/////RESUME A RECIPE/////

if (isset ($_GET['resume-recipe'])) {
$recipe_ID = $_GET['resume-recipe'];
$title = $_GET['resume-title'];
include ($basicactions);
exit();
}
///////ADD SECTIONS//////

//BASIC INFO

if (isset ($_GET['create-recipe'])) {include ($basicentry);exit();}

//INGREDIENTS

//add ingredient

if (isset ($_GET['ingredient-add'])) {
$recipe_ID=$_GET['ingredient-add'];
$display_order=$_GET['display-order'];
$form_ID="add";
include ($ingredientsentry);
exit();
}
		//search for ing

		if (isset($_POST['ing-search'])) {
		$recipe_ID=$_POST['recipe_ID'];
		$form_ID = "add";
		include ($ingredientsentry);
		exit();
		}
		//select ing from results	

		if (isset($_GET['selected-ingredient'])) {
		$ingredient=$_GET['selected-ingredient'];
		$recipe_ID=$_GET['recipe-id'];
		$form_ID = "add";
		include ($ingredientsentry);
		exit();
		}
		
//edit ingredient
if (isset ($_GET['edit-ingredient'])) {
$ID= $_GET['edit-ingredient'];
$recipe_ID= $_GET['recipe-id'];
$form_ID="edit";
include ($ingredientsentry);
exit();
}

//delete ingredient
if (isset ($_GET['delete-ingredient'])) {
$ID= $_GET['delete-ingredient'];
$recipe_ID= $_GET['recipe-id'];
$order=$_GET['display-order'];
$form_ID="delete";
include ($ingredientsentry);
exit();
}

	
//add notes
if (isset ($_GET['ingredient-notes'])) {
$recipe_ID= $_GET['ingredient-notes'];
$form_ID="notes";
include ($ingredientsentry);
exit();
}
//Display Order

		//move up order
		if (isset ($_GET['order-up'])) {
		$ID=$_GET['order-up'];
		$display_order=$_GET['display-order'];
		$recipe_ID=$_GET['recipe-id'];
		$form_ID="up";
		include ($displayorder);
		include ($ingredientsentry);
		exit();
		}
		//move down order
		if (isset ($_GET['order-down'])) {
		$ID=$_GET['order-down'];
		$display_order=$_GET['display-order'];
		$recipe_ID=$_GET['recipe-id'];
		$form_ID="down";
		include ($displayorder);
		include ($ingredientsentry);
		exit();
		}
/*----NOTE!!----//
 
all other sections call the update page via actions page of previous segment

//----NOTE!!----*/

//REVIEW & SUBMIT INCLUDES

//return:
if (isset($_GET['review-submit'])) {
$recipe_ID = $_GET['review-submit'];
include($reviewsubmit);
exit();
}


//basic:
if (isset($_GET['edit-basic'])) {$post_id = $_GET['edit-basic'];include($basicupdate);}
//image
if (isset($_GET['edit-image'])) {$post_id = $_GET['edit-image'];include($imageupdate);}
//ingredient
if (isset($_GET['edit-ingredients'])) {$recipe_ID = $_GET['edit-ingredients'];include($ingredientsentry);}
//introduction
if (isset($_GET['edit-intro'])) {$recipe_ID = $_GET['edit-intro']; include($introentry);}
//step1
if (isset($_GET['edit-step1'])) {$recipe_ID = $_GET['edit-step1']; include($step1entry);}
//step2
if (isset($_GET['edit-step2'])) {$recipe_ID = $_GET['edit-step2']; include($step2entry);}
//step3
if (isset($_GET['edit-step3'])) {$recipe_ID = $_GET['edit-step3']; include($step3entry);}
//summary
if (isset($_GET['edit-summary'])) {$recipe_ID = $_GET['edit-summary']; include($summaryentry);}

//////ACTION UPDATES///////

//BASIC ACTIONS

if (isset ($_POST['basic-entry'])) {
include ($basicactions);
exit();
}

//INGREDIENT ACTIONS

if (isset ($_POST['action-ingredient'])) {
include ($ingredientsactions);
exit();
}

if (isset($_GET['finish'])) {
$recipe_ID= $_GET['recipe_ID'];
include ($introentry);
exit();
}

//if it is an update to existing set of ingredients send back to update page

if (isset($_GET['finish-update'])) {
$post_id= $_GET['recipe_ID'];
$updated="Ingredients updated";
include ($editpost);
exit();
}

//INTRO ACTIONS
if (isset ($_POST['intro-entry'])) {
include ($introactions);
exit();
}

//STEP 1 ACTIONS
if (isset ($_POST['step1-entry'])) {
include ($step1actions);
exit();
}

//STEP 2 ACTIONS
if (isset ($_POST['step2-entry'])) {
include ($step2actions);
exit();
}

//STEP 3 ACTIONS
if (isset ($_POST['step3-entry'])) {
include ($step3actions);
exit();
}

//SUMMARY ACTIONS
if (isset ($_POST['submit-summary'])) {
include ($summaryactions);
exit();
}

//REVIEW & SUBMIT ACTIONS

//basic:
if (isset($_POST['update-basic'])) {$recipe_ID = $_POST['ID'];include($basicact);}
//image:
if (isset($_POST['image'])) {$recipe_ID = $_POST['ID'];include($imageactions);}
//ingredient
if (isset($_GET['reviewsubmit'])) {$recipe_ID = $_GET['recipe_ID'];$messager="Ingredients Updated"; include($reviewsubmit); exit();}
//FINALISE!
if (isset($_POST['finalise-actions'])) {$recipe_ID = $_POST['recipe_ID']; include($finalactions);}

//RETURN VIA NOTIFICATIONS
if (isset($_GET['fix-recipe'])) {$recipe_ID = $_GET['fix-recipe']; include($reviewsubmit); exit();}
?>

<!--INTRO SECTION-->
<!--WE DON'T NEED THIS
<h1>Cookery Corner Recipe Publishing Tool v0.115</h1>
<?php // if (!empty($message)){echo "<hr/><h3><span style=\"color:red\";>".$message."</span></h3><hr/>";}?>
<p>Welcome to the next level Cookery Corner recipe pushishing tool.
<p>You will have the opportunity to review your work, so don't worry if you missed anything out!
<br>Once a recipe has been submitted it will not go live until it has been reviewed to ensure it meets site standards.</p>
<p>I know, <i><b>'what standards???'</i></b> I hear you ask.</p>

<h3><a class="fa fa-plus btn basic" href="/admin/recipe_entry.php?create-recipe=?"></a> | <a href="/admin/recipe_entry.php?create-recipe=?">Create New Recipe</a></h3>

<?php
/*
$stmt="SELECT ID, title, titslug, stage FROM recipes WHERE stage<9";
$array = $conn->query($stmt);


if (!empty($array)){
echo"<hr />
<h3>Incomplete Recipes</h3>";
foreach ($array as $r) {

if ($r['stage']==="2") {$stage="ingredients";}
if ($r['stage']==="3") {$stage="introduction";}
if ($r['stage']==="4") {$stage="recipe stage 1";}
if ($r['stage']==="5") {$stage="recipe stage 2 (optional)";}
if ($r['stage']==="6") {$stage="recipe stage 3 (optional)";}
if ($r['stage']==="7") {$stage="summary";}
if ($r['stage']==="8") {$stage="review and submit";}

echo 	"<h4><a class=\"fa fa-pencil btn \" href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\"></a>
		"; 
echo	"&nbsp|&nbsp <a href=\"/admin/recipe_entry.php?resume-recipe=".$r['ID']."&resume-title=".$r['title']."\">".$r['title']."</a>";
echo 	"&nbsp|&nbsp".$stage."</h4>";

}
}
*/
?>

<hr>
<h4><a href="\admin\admin.php">Return to Profile</a></h4>
-->
