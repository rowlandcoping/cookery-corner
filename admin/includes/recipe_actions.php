<?php session_start();
 
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$recpath = "$path"."/assets/images/recipes";
$imgprocess = "$path"."/admin/includes/imageprocess.php";

require_once($config);



//create slug function

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
function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}

//set variables for compulsary fields
$title = esc($_POST['title']);
$user = $_SESSION['ID'];	
$description = $_POST['description'];





//de-dupe

if (isset($_POST['submit'])) {
		// receive all input values from the form
		$title = esc($_POST['title']);
		$user = $_SESSION['ID'];	
		$description = $_POST['description'];	
		$check_query = "SELECT user_ID, title, description FROM recipes WHERE title='$title'
								LIMIT 1";

		$result = mysqli_query($conn, $check_query);
		$check = mysqli_fetch_assoc($result);

	if ($check) { // if title
		if (esc(strtolower($check['description'])) === (strtolower($description))) {
			 echo "This recipe has been added already.
					<br>Saves a job I guess
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
			 exit();
			}
		if (esc(strtolower($check['user_ID'])) === (strtolower($user))) {
			 echo "You have already added a recipe with exactly this name.
					<br>Give the world something new, why don't you!
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
			 exit();
			}
			
	

		
		if (esc(strtolower($check['title'])) === (strtolower($title))) 
{$titslug = longSlug($title, $user);}
}else {$titslug = makeslug($title);}

		$check_query2 = "SELECT description FROM recipes WHERE description='$description'
								LIMIT 1";
		$result2 = mysqli_query($conn, $check_query2);
		$check2 = mysqli_fetch_assoc($result2);
		if ($check2) { // if user exists
		if (esc(strtolower($check2['description'])) === (strtolower($description))) {
			 echo "This recipe has been added already.
					<br>Saves a job I guess
			 <p><a href=\"/admin/admin.php\">Admin Home</a>
			<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
			 exit();
			}}

}

///sanitise image

if(!empty($_FILES["rec_image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["rec_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["rec_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $recpath;
$imgName = reset ($splitname);
$image = $_FILES['rec_image']['tmp_name']; 

require ($imgprocess);
$rec_image = $newname;
} else {echo "you must include an image to post a recipe
												<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}

   
            
            
        

//set dish complexity - unlock masterchef if needed! 
         
if (!empty ($_POST['ing24'])) {
	$complexity="Masterchef";
}else{   
          
if (!empty ($_POST['ing16'])) {
	$complexity="Date night";
 }else {
 if   (!empty ($_POST['ing8'])) {
	$complexity="Everyday"; 
} else {$complexity="Simple";}}}
	     

//optional fields
           
 //ingredients
if(!empty($_POST['quan1'])) {
		$quan3 = $_POST['quan1'];
	}else{$quan1="";
	}
	
if(!empty($_POST['quan2'])) {
		$quan3 = $_POST['quan2'];
	}else{$quan2="";
	}
 	
if(!empty($_POST['ing3'])) {
		$ing3 = $_POST['ing3'];
	}else{$ing3="";
	}
if(!empty($_POST['quan3'])) {
		$quan3 = $_POST['quan3'];
	}else{$quan3="";
	}
if(!empty($_POST['ing4'])) {
		$ing4 = $_POST['ing4'];
	}else{$ing4="";
	}
if(!empty($_POST['quan4'])) {
		$quan4 = $_POST['quan4'];
	}else{$quan4="";
	}
if(!empty($_POST['ing5'])) {
		$ing5 = $_POST['ing5'];
	}else{$ing5="";
	}
if(!empty($_POST['quan5'])) {
		$quan5 = $_POST['quan5'];
	}else{$quan5="";
	}
if(!empty($_POST['ing6'])) {
		$ing6 = $_POST['ing6'];
	}else{$ing6="";
	}
if(!empty($_POST['quan6'])) {
		$quan6 = $_POST['quan6'];
	}else{$quan6="";
	}
if(!empty($_POST['ing7'])) {
		$ing7 = $_POST['ing7'];
	}else{$ing7="";
	}
if(!empty($_POST['quan7'])) {
		$quan7 = $_POST['quan7'];
	}else{$quan7="";
	}
if(!empty($_POST['ing8'])) {
		$ing8 = $_POST['ing8'];
	}else{$ing8="";
	}
if(!empty($_POST['quan8'])) {
		$quan8 = $_POST['quan8'];
	}else{$quan8="";
	}
if(!empty($_POST['ing9'])) {
		$ing9 = $_POST['ing9'];
	}else{$ing9="";
	}
if(!empty($_POST['quan9'])) {
		$quan9 = $_POST['quan9'];
	}else{$quan9="";
	}
if(!empty($_POST['ing10'])) {
		$ing10 = $_POST['ing10'];
	}else{$ing10="";
	}
if(!empty($_POST['quan10'])) {
		$quan10 = $_POST['quan10'];
	}else{$quan10="";
	}
if(!empty($_POST['ing11'])) {
		$ing11 = $_POST['ing11'];
	}else{$ing11="";
	}
if(!empty($_POST['quan11'])) {
		$quan11 = $_POST['quan11'];
	}else{$quan11="";
	}
if(!empty($_POST['ing12'])) {
		$ing12 = $_POST['ing12'];
	}else{$ing12="";
	}
if(!empty($_POST['quan12'])) {
		$quan12 = $_POST['quan12'];
	}else{$quan12="";
	}
if(!empty($_POST['ing13'])) {
		$ing13 = $_POST['ing13'];
	}else{$ing13="";
	}
if(!empty($_POST['quan13'])) {
		$quan13 = $_POST['quan13'];
	}else{$quan13="";
	}
if(!empty($_POST['ing14'])) {
		$ing14 = $_POST['ing14'];
	}else{$ing14="";
	}
if(!empty($_POST['quan14'])) {
		$quan14 = $_POST['quan14'];
	}else{$quan14="";
	}
if(!empty($_POST['ing15'])) {
		$ing15 = $_POST['ing15'];
	}else{$ing15="";
	}
if(!empty($_POST['quan15'])) {
		$quan15 = $_POST['quan15'];
	}else{$quan15="";
	}
	
//info
if(!empty($_POST['add_ingred'])) {
		$add_ingred = $_POST['add_ingred'];
	}else{$add_ingred="";
}

if(!empty($_POST['keywords'])) {
		$keywords = $_POST['keywords'];
	}else{$keywords="";
}

//content

if(!empty($_POST['step2_head'])) {
		$step2_head = $_POST['step2_head'];
	}else{$step2_head="";
}
if(!empty($_POST['step2_content'])) {
		$step2_content = $_POST['step2_content'];
	}else{$step2_content="";
}
if(!empty($_POST['step3_head'])) {
		$step3_head = $_POST['step3_head'];
	}else{$step3_head="";
}
if(!empty($_POST['step3_content'])) {
		$step3_content = $_POST['step3_content'];
	}else{$step3_content="";
}



$stmt = $conn->prepare("INSERT into recipes (user_ID, title, titslug, serves, complexity, cuisine, category, keywords, description, rec_image, add_ingred, intro, 
						step1_head, step1_content, step2_head, step2_content, step3_head, step3_content, conclusion,
						main_ing, quan1, ing2, quan2, ing3, quan3, ing4, quan4, ing5, quan5, ing6, quan6, ing7, quan7, ing8, quan8,
						ing9, quan9, ing10, quan10, ing11, quan11, ing12, quan12, ing13, quan13, ing14, quan14, ing15, quan15) 
						VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
						,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
						
  	$stmt->bind_param("ississsssssssssssssssssssssssssssssssssssssssssss", $user_ID, $title, $titslug, $serves, $complexity, $cuisine, $category, $keywords,
					$description, $rec_image, $add_ingred, $intro, $step1_head, $step1_content, $step2_head, $step2_content, $step3_head, $step3_content, $conclusion,
					$main_ing, $quan1, $ing2, $quan2, $ing3, $quan3, $ing4, $quan4, $ing5, $quan5, $ing6, $quan6, $ing7, $quan7, $ing8, $quan8, $ing9, $quan9
					,$ing10, $quan10, $ing11, $quan11, $ing12, $quan12, $ing13, $quan13, $ing14, $quan14, $ing15, $quan15);
  	
  	
  	
  	//compulsary fields
  	
  	
  	
  	$user_ID = $_SESSION['ID'];
  	$title = $_POST['title']; 
	$servesup = esc($_POST['serves']);
	$cuisine = $_POST['cuisine'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$main_ing = $_POST['main_ing'];
	
	
	//content
	
	$intro = $_POST['intro'];
	$step1_head = $_POST['step1_head'];
	$step1_content = $_POST['step1_content'];
	$conclusion = $_POST['conclusion'];
		
	//ingredients
		
	$quan1 = $_POST['quan1'];
	$ing2 = $_POST['ing2'];
	$quan2 = $_POST['quan2'];

//check compulsary fields


	
	if(empty($title)){echo "you need to enter a title.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
								
		if (is_numeric($servesup)) {$serves = round($servesup);}else{echo
										"you need to enter the number of servings as an integer.  ie a number.  ie, 1 2, 3, etc
											<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
										exit();}
		if ($serves == 0)     {echo	"<p>I'm not sure what you're cooking but it needs to at least serve somebody.
											<br>Zero, honestly.  Stop testing me.</p>
											<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
										exit();}
		if(empty($serves)){echo "you need to enter a number of servings.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($cuisine)){echo "you need to select a type of cuisine.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($category)){echo "you need to select a category.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($description)){echo "you must enter a description.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($main_ing)){echo "you must enter a main ingredient.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($main_ing)){echo "you must enter quantity for your main ingredient.  I didn't put the red stars there for fun you know.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	
	if(empty($ing2)){echo "you must enter more than one ingredient.  Otherwise it's not a recipe, it's just a foodstuff.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($quan2)){echo "But how much of the second ingredient though?
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($intro)){echo "An introduction is deemed essential by this website.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($step1_head)){echo "The opening section requires a heading
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($step1_content)){echo "A recipe without content is just a random collection of ingredients, sorry.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
	if(empty($conclusion)){echo "You are expected to summarise. Bit harsh this one but this website has its format.
							<p><a href=\"/admin/admin.php\">Admin Home</a>
									<br><a href=\"/admin/recipeentry.php\">Try Again</a></p>";
									exit();}
									
								
			
	
	
	
	
	     if ($stmt->execute() === TRUE) {
					echo "<p>Recipe Added</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}  
 
 //adds data to serves table
$servesist = $conn->prepare("SELECT serves FROM serves WHERE serves=? 
								 LIMIT 1");
$servesist->bind_param("i", $serves);
$servesist->execute();
$resultser=$servesist->get_result();
$compser = $resultser->fetch_assoc();

if ($compser) { echo"No need to add more servings<br>";}// if result exists
	
	if (empty($compser)) { //if it doesn't exist enter new one.  damn this is unecessary	 


$serv = $conn->prepare("INSERT into serves (serves, slug) VALUES (?,?)");
$serv->bind_param("is", $serves, $serslug);
$serslug=makeservSlug($_POST['serves']);
if ($serv->execute() === TRUE) {
					echo "<p>serving Added</p>";
					} else {
					echo "<p>didnot work</p>" . $conn->error;
					}  
}
//adds data to complexity table
$compexist = $conn->prepare("SELECT complexity FROM complexity WHERE complexity=? 
								 LIMIT 1");
$compexist->bind_param("s", $complexity);
$compexist->execute();
$resultcom=$compexist->get_result();
$compres = $resultcom->fetch_assoc();

if ($compres) { echo"No need to add more complexity";}// if result exists
	
	if (empty($compres)) { //if it doesn't exist enter new one.  damn this is unecessary	 


$comp = $conn->prepare("INSERT into complexity (complexity, slug) VALUES (?,?)");
$comp->bind_param("ss", $complexity, $comslug);
$comslug=makeSlug($complexity);
if ($comp->execute() === TRUE) {
					echo "<p>Complexity Added</p>";
					} else {
					echo "<p>Something was bound to go wrong (comp)</p>" . $conn->error;
					}  
}
// update recipe category index
$user_check_query = $conn->prepare("SELECT ID FROM recipe_category WHERE category=? LIMIT 1");
$user_check_query->bind_param("s", $category);
$user_check_query->execute();				
$result=$user_check_query->get_result();
$catID=$result->fetch_assoc();
$catID=$catID['ID'];
  
$user_check_query2 = $conn->prepare("SELECT ID FROM recipes WHERE titslug=? 
								LIMIT 1");
$user_check_query2->bind_param("s", $titslug);
$user_check_query2->execute();				
$result2 = $user_check_query2->get_result();
$recID = $result2->fetch_assoc();
$recID= $recID['ID'];	

$stmt2 = $conn->prepare("INSERT into recipe_cat_index (recipe_ID, category_ID) VALUES (?,?)");
$stmt2->bind_param("ss", $recID, $catID); 
if ($stmt2->execute() === TRUE) {
					echo "<p>recipe category index updated</p>";
					} else {
					echo "<p>Something indexy was bound to go wrong</p>";
				}
//update cuisine index  

$user_check_query3 = $conn->prepare( "SELECT ID FROM cuisine WHERE cuisine=?
								LIMIT 1");
$user_check_query3->bind_param("s", $cuisine);
$user_check_query3->execute();				
$result3 = $user_check_query3->get_result();
$cuisID=  $result3->fetch_assoc();
$cuisID=$cuisID['ID'];

$stmt3 = $conn->prepare("INSERT into cuisine_index (recipe_ID, cuisine_ID) VALUES (?,?)");
$stmt3->bind_param("ss", $recID, $cuisID); 
if ($stmt3->execute() === TRUE) {
					echo "<p>cuis index updated</p>";
					} else {
					echo "<p>cuis fail</p>";}
//update ingredient index
//1
$user_check_query4 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query4->bind_param("s", $main_ing);
$user_check_query4->execute();				
$result4 = $user_check_query4->get_result();
$ingID=  $result4->fetch_assoc();
$ingID=$ingID['ID'];

$stmt4 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt4->bind_param("ss", $recID, $ingID); 
if ($stmt4->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing1 fail</p>";
				}

//2
$user_check_query5 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query5->bind_param("s", $ing2);
$user_check_query5->execute();				
$result5 = $user_check_query5->get_result();
$ing2ID=  $result5->fetch_assoc();
$ing2ID=$ing2ID['ID'];

$stmt5 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt5->bind_param("ss", $recID, $ing2ID); 
if ($stmt5->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing2 fail</p>";}

//3
if(!empty($_POST['ing3'])) {
	
$user_check_query6 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query6->bind_param("s", $ing3);
$user_check_query6->execute();				
$result6 = $user_check_query6->get_result();
$ing3ID=  $result6->fetch_assoc();
$ing3ID=$ing3ID['ID'];

$stmt6 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt6->bind_param("ss", $recID, $ing3ID); 
if ($stmt6->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing3 fail</p>";}
}

//4
if(!empty($_POST['ing4'])) {
$user_check_query7 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query7->bind_param("s", $ing4);
$user_check_query7->execute();				
$result7 = $user_check_query7->get_result();
$ing4ID=  $result7->fetch_assoc();
$ing4ID=$ing4ID['ID'];


$stmt7 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt7->bind_param("ss", $recID, $ing4ID); 
if ($stmt7->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing4 fail</p>";}
}
//5
if(!empty($_POST['ing5'])){
$user_check_query8 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query8->bind_param("s", $ing5);
$user_check_query8->execute();				
$result8 = $user_check_query8->get_result();
$ing5ID=  $result8->fetch_assoc();
$ing5ID=$ing5ID['ID'];

$stmt8 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt8->bind_param("ss", $recID, $ing5ID); 
if ($stmt8->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing5 fail</p>";} 
}
//6
if(!empty($_POST['ing6'])){
$user_check_query9 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query9->bind_param("s", $ing6);
$user_check_query9->execute();				
$result9 = $user_check_query9->get_result();
$ing6ID=  $result9->fetch_assoc();
$ing6ID=$ing6ID['ID'];

$stmt9 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt9->bind_param("ss", $recID, $ing6ID);
 
if ($stmt9->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing6 fail</p>";}
}

//7
if(!empty($_POST['ing7'])){
$user_check_query10 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query10->bind_param("s", $ing7);
$user_check_query10->execute();				
$result10 = $user_check_query10->get_result();
$ing7ID=  $result10->fetch_assoc();
$ing7ID=$ing7ID['ID'];

$stmt10 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt10->bind_param("ss", $recID, $ing7ID); 
if ($stmt10->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing7 fail</p>";}
}
//8
if(!empty($_POST['ing8'])){
$user_check_query11 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query11->bind_param("s", $ing8);
$user_check_query11->execute();				
$result11 = $user_check_query11->get_result();
$ing8ID=  $result11->fetch_assoc();
$ing8ID=$ing8ID['ID'];
$stmt11 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt11->bind_param("ss", $recID, $ing8ID); 
if ($stmt11->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing8 fail</p>";}
}
//9
if(!empty($_POST['ing9'])){
$user_check_query12 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query12->bind_param("s", $ing9);
$user_check_query12->execute();				
$result12 = $user_check_query12->get_result();
$ing9ID=  $result12->fetch_assoc();
$ing9ID=$ing9ID['ID'];
$stmt12 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt12->bind_param("ss", $recID, $ing9ID); 
if ($stmt12->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing9 fail</p>";}
}
//10
if(!empty($_POST['ing10'])){
$user_check_query13 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query13->bind_param("s", $ing10);
$user_check_query13->execute();				
$result13 = $user_check_query13->get_result();
$ing10ID=  $result13->fetch_assoc();
$ing10ID=$ing10ID['ID'];
$stmt13 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt13->bind_param("ss", $recID, $ing10ID); 
if ($stmt13->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing10 fail</p>";}
}
//11
if(!empty($_POST['ing11'])){
$user_check_query14 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query14->bind_param("s", $ing11);
$user_check_query14->execute();				
$result14 = $user_check_query14->get_result();
$ing11ID=  $result14->fetch_assoc();
$ing11ID=$ing11ID['ID'];
$stmt14 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt14->bind_param("ss", $recID, $ing11ID); 
if ($stmt14->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing11 fail</p>";}
}
//12
if(!empty($_POST['ing12'])){
$user_check_query15 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query15->bind_param("s", $ing12);
$user_check_query15->execute();				
$result15 = $user_check_query15->get_result();
$ing12ID=  $result15->fetch_assoc();
$ing12ID=$ing12ID['ID'];
$stmt15 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt15->bind_param("ss", $recID, $ing12ID); 
if ($stmt15->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing12 fail</p>";}
}
//13
if(!empty($_POST['ing13'])){
$user_check_query16 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query16->bind_param("s", $ing13);
$user_check_query16->execute();				
$result16 = $user_check_query16->get_result();
$ing13ID=  $result16->fetch_assoc();
$ing13ID=$ing13ID['ID'];
$stmt16 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt16->bind_param("ss", $recID, $ing13ID); 
if ($stmt16->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing13 fail</p>";}
}
//14
if(!empty($_POST['ing14'])){
$user_check_query17 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query17->bind_param("s", $ing14);
$user_check_query17->execute();				
$result17 = $user_check_query17->get_result();
$ing14ID=  $result17->fetch_assoc();
$ing14ID=$ing14ID['ID'];
$stmt17 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt17->bind_param("ss", $recID, $ing14ID); 
if ($stmt17->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing14 fail</p>";}
}
//15
if(!empty($_POST['ing15'])){
$user_check_query18 = $conn->prepare("SELECT ID FROM ingredients WHERE ingredient=? 
								LIMIT 1");
$user_check_query18->bind_param("s", $ing15);
$user_check_query18->execute();				
$result18 = $user_check_query18->get_result();
$ing15ID=  $result18->fetch_assoc();
$ing15ID=$ing15ID['ID'];
$stmt18 = $conn->prepare("INSERT into ing_index (recipe_ID, ingredient_ID) VALUES (?,?)");
$stmt18->bind_param("ss", $recID, $ing15ID); 
if ($stmt18->execute() === TRUE) {
					echo "<p>ing index updated</p>";
					} else {
					echo "<p>ing15 fail</p>";
}
}

/*enter index info*/
$time = $conn->prepare("SELECT timestamp, ID FROM recipes WHERE titslug=? 
					LIMIT 1");
$time->bind_param("s", $titslug);
$time->execute();
$timeres=$time->get_result();
$timestamp = $timeres->fetch_assoc();				
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $timestamp['timestamp'] );
$date = $new_date->format('d/m/y');
$htime = $new_date->format('H:i');
$ttime = $new_date->format('g:ia');


echo"<br>".$htime;
echo"<br>".$ttime;
echo "<br>".$date;


$nextlevel = $timestamp['timestamp'];
$broken=date_parse($nextlevel);
echo "<br>".$broken['year'];
echo "<br>".$broken['month'];
echo "<br>".$broken['day'];

if ($broken['day']=="1, 21, 31") {
	$suffix="st";
}else { if ($broken['day']=="2, 22") {
	$suffix="nd";
}else {if ($broken['day']=="3, 23") {
	$suffix="rd";
}else{$suffix="th";}
}
}		

$timestampday = strtotime($timestamp['timestamp']);
$day = date('l', $timestampday);
$monthfull =date('F', $timestampday);
$month =date('M', $timestampday);
$article_type='recipe';
$url="/recipe/"."$titslug";

echo "<br>".$day;
echo "<br>".$month;
echo "<br>".$monthfull;

$article_index = $conn->prepare("INSERT INTO article_index (recipe_ID, article_type, date, time, time_24h, day, suffix, day_full, month, month_full, month_short, year, url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
$article_index->bind_param("issssississis", $timestamp['ID'], $article_type, $date, $ttime, $htime, $broken['day'], $suffix, $day, $broken['month'], $monthfull, $month, $broken['year'], $url);					
if ($article_index->execute() === TRUE) {
					echo "<p>Index updated";
					} else {
					echo "<p>Error Updating Index" . $conn->error;
					}
?>	

 <p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/recipeentry.php">Add another recipe</a></p>
