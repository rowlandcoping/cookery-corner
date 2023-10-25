<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if(empty($recipe_ID)) {
$title=$_POST['title'];
$serves=$_POST['serves'];
$cuisine=$_POST['cuisine'];
$category=$_POST['category'];
$stage="2";
if (!empty($_POST['keywords'])) {$keywords=$_POST['keywords'];}else{$keywords="";} 
$description=$_POST['description'];
$user_name=$_SESSION['name'];
}


$stmt= $conn->prepare("SELECT user_ID, title, description, stage FROM recipes WHERE title=?");
$stmt->bind_param("s", $title);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

$user = $_SESSION['ID'];
if (!empty($recipe_ID)) {$rec_usr = $result['user_ID'];}else{
$rec_usr= $user;}

if ($_SESSION['role']==="user" & $rec_usr!==$user)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}

if (!empty ($result['stage'])) {$stage = $result['stage'];}


if ($result) { if ($stage>1) { if ($stage===2) {include ($ingredientsentry);
								exit();
							}else if ($stage===3) {include($introentry);
								exit();
							}else if ($stage===4) {include($step1entry);
								exit();
							}else if ($stage===5) {include($step2entry);
								exit();
							}else if ($stage===6) {include($step3entry);
								exit();
							}else if ($stage===7) {include($summaryentry);
								exit();
							}else if ($stage===8) {include($reviewsubmit);
								exit();
		}else{	if ($result['description'] === $description) {
				$message	= "This recipe has been added already. Saves a job I guess.";
				include($basicentry);
				exit();}
				if (($result['user_ID']) === $user) {
				$message	= "You have already added a recipe with exactly this name. 
								Give the world something new, why don't you!";
				include($basicentry);
				exit();}
				
			} $titslug = longSlug($title, $user);
	}
}else{	$titslug = makeslug($title);}

//sort image
if(!empty($_FILES["rec_image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["rec_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["rec_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['rec_image']['tmp_name']; 

require ($imgprocess);
$rec_image = $newname;
}

//checks servings are numeric
if (is_numeric($serves)) {	$serves = round($serves);
					}else{$message	= "You need to enter the number of servings as an integer.  ie a number.  ie, 1 2, 3, etc";
										include($basicentry);
										exit();}
if ($serves == 0)     	{$message	= "I'm not sure what you're cooking but it needs to at least serve somebody. 
										Zero, honestly. Stop testing me.";
										include($basicentry);
										exit();}
																				
//Add info to new recipe!

$stmt= $conn->prepare("INSERT INTO recipes (user_ID, user_name, title, titslug, serves, cuisine, category, keywords, description, rec_image, stage) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssssssi", $user, $user_name, $title, $titslug, $serves, $cuisine, $category, $keywords, $description, $rec_image, $stage);
if ($stmt->execute()===true){include ($ingredientsentry);
						exit();
				}else{	$message= "Something went wrong.  I don't know what. 
						If the problem persists please <a href=\"/contactform.php\" target\"_blank\">let me know</a>";
						include($basicentry);
						exit();}

