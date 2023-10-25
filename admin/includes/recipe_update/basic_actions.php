<?php


if (isset($_POST['update-basic'])) {


$ID= $_POST['ID'];
$stmt = $conn->prepare("SELECT user_ID, titslug, title, stage FROM recipes WHERE ID=?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();


$title=$_POST['title'];
$serves=$_POST['serves'];
$cuisine=$_POST['cuisine'];
$category=$_POST['category'];
$keywords=$_POST['keywords'];
$description=$_POST['description'];
$user = $result['user_ID'];
$titslug=$result['titslug'];
$stage=$result['stage'];

//update slug
if ($title !== $result['title'])

{
$stmt= $conn->prepare("SELECT title FROM recipes WHERE title=?
								LIMIT 1");
$stmt->bind_param("s", $title);
$stmt->execute();
$array = $stmt ->get_result();
$result2 = $array->fetch_assoc();

if ($result2) {			
$titslug = longSlug($title, $user);
}else {$titslug = makeslug($title);}
}

//checks servings are numeric
if (is_numeric($serves)) {$serves = round($serves);}else{echo
										"you need to enter the number of servings as an integer.  ie a number.  ie, 1 2, 3, etc
											<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/update_recipe.php?edit-basic=".$ID."\">Try Again</a></p>";
										exit();}
		if ($serves == 0)     {echo	"<p>I'm not sure what you're cooking but it needs to at least serve somebody.
											<br>Zero, honestly.  Stop testing me.</p>
											<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/update_recipe.php?edit-basic=".$ID."\">Try Again</a></p>";
										exit();}
		if(empty($serves)){echo "you need to enter a number of servings.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/update_recipe.php?edit-basic=".$ID."\">Try Again</a></p>";
									exit();}
//update recipes table
$stmt= $conn->prepare("UPDATE recipes SET title=?, titslug=?, serves=?, cuisine=?,category=?, keywords=?, description=? WHERE ID=?");
$stmt->bind_param("ssssssss", $title, $titslug, $serves, $cuisine, $category, $keywords, $description, $ID);
$stmt->execute();
if ($stage<9){$messager="Basic Info Updated";
				include($reviewsubmit);
				exit();
}
//checks if data exists in serves table
$servesist = $conn->prepare("SELECT serves FROM serves WHERE serves=?");
$servesist->bind_param("i", $serves);
$servesist->execute();
$resultser=$servesist->get_result();
$compser = $resultser->fetch_assoc();
if (empty($compser)) { //if it doesn't exist enter new one.	 
$serv = $conn->prepare("INSERT into serves (serves, slug) VALUES (?,?)");
$serv->bind_param("is", $serves, $serslug);
$serslug=makeservSlug($_POST['serves']);
if ($serv->execute() === TRUE) {
					echo "<p>serving Added</p>";
					} else {
					echo "<p>did not work</p>" . $conn->error;
					}  
}



//update cuisine index					
$stmt= $conn->prepare("SELECT ID FROM cuisine WHERE cuisine=?");
$stmt->bind_param("s", $cuisine);
$stmt->execute();
$array = $stmt ->get_result();
$result3 = $array->fetch_assoc();
$cuis_ID = $result3['ID'];
$stmt= $conn->prepare("UPDATE cuisine_index SET cuisine_ID=? WHERE recipe_ID=?");
$stmt->bind_param("ss", $cuis_ID, $ID);
$stmt->execute();
//update category index	
$stmt= $conn->prepare("SELECT ID FROM recipe_category WHERE category=?");
$stmt->bind_param("s", $category);
$stmt->execute();
$array = $stmt ->get_result();
$result4 = $array->fetch_assoc();
$cat_ID = $result4['ID'];
$stmt= $conn->prepare("UPDATE recipe_cat_index SET category_ID=? WHERE recipe_ID=?");
$stmt->bind_param("ss", $cat_ID, $ID);
$stmt->execute();

//update article index
$url="/recipe/"."$titslug";
$stmt= $conn->prepare("UPDATE article_index SET url=?, lastupdated=now() WHERE recipe_ID=?");
$stmt->bind_param("ss", $url, $ID);

if ($stmt->execute()=== TRUE) {
					$post_id=$ID;
					$updated="Basic Information Updated";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}


