<?php
$recipe_ID=$_POST['recipe_ID'];

$stmt=$conn->prepare("SELECT user_ID, serves, cuisine, category, title, titslug, timestamp FROM recipes WHERE ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
$array = $stmt->get_result();
$result = $array->fetch_assoc();

$user_ID=$result['user_ID'];
$serves=$result['serves'];
$titslug=$result['titslug'];
$title=$result['title'];
$cuisine=$result['cuisine'];
$category=$result['category'];
$timestamp=$result['timestamp'];



//Set serves index
$stmt = $conn->prepare("SELECT serves FROM serves WHERE serves=?");
$stmt->bind_param("i", $serves);
$stmt->execute();
$array=$stmt->get_result();
$result = $array->fetch_assoc();	
if (empty($result)) {
$serslug=makeservSlug($serves);
$stmt = $conn->prepare("INSERT into serves (serves, slug) VALUES (?,?)");
$stmt->bind_param("is", $serves, $serslug);
$stmt->execute();

}

//set cuisine index	**de-dupe index**	
$stmt= $conn->prepare("SELECT recipe_ID FROM cuisine_index WHERE recipe_ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
if (!empty($result)) {}else{			
$stmt= $conn->prepare("SELECT ID FROM cuisine WHERE cuisine=?");
$stmt->bind_param("s", $cuisine);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$cuis_ID = $result['ID'];
$stmt= $conn->prepare("INSERT INTO cuisine_index (cuisine_ID,recipe_ID) VALUES (?,?)");
$stmt->bind_param("ss", $cuis_ID, $recipe_ID);
$stmt->execute();
}

//set category index
$stmt= $conn->prepare("SELECT recipe_ID FROM recipe_cat_index WHERE recipe_ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

if (!empty($result)) {}else{

$stmt= $conn->prepare("SELECT ID FROM recipe_category WHERE category=?");
$stmt->bind_param("s", $category);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$cat_ID = $result['ID'];
$stmt= $conn->prepare("INSERT INTO recipe_cat_index (category_ID, recipe_ID) VALUES (?,?)");
$stmt->execute();
}

//update article index **de-dupe index**
$stmt= $conn->prepare("SELECT recipe_ID FROM article_index WHERE recipe_ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

if (!empty($result)) {}else{	

$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $timestamp );
$date = $new_date->format('d/m/y');
$htime = $new_date->format('H:i');
$ttime = $new_date->format('g:ia');




$broken=date_parse($timestamp);
$sday= $broken['day'];

if ($sday=="1" || $sday=="21"||$sday=="31") {
	$suffix="st";
}else { if ($sday=="2"|| $sday=="22") {
	$suffix="nd";
}else {if ($sday=="3"|| $sday=="23") {
	$suffix="rd";
}else{$suffix="th";}
}
}	



$timestampday = strtotime($timestamp);
$day = date('l', $timestampday);
$monthfull =date('F', $timestampday);
$month =date('M', $timestampday);

$article_type='recipe';
$url="/recipe/"."$titslug";


$stmt = $conn->prepare("INSERT INTO article_index (recipe_ID, article_type, date, time, 
								time_24h, day, suffix, day_full, month, month_full, month_short, year) 
								VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("issssississi", $recipe_ID, $article_type, $date, $ttime, $htime, $broken['day'], $suffix, 
											$day, $broken['month'], $monthfull, $month, $broken['year']);	
$stmt->execute();
}

$stmt = $conn->prepare("SELECT email, name, slug, e_pending from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$email=$result['email'];
$user=$result['name'];
$userslug=$result['slug'];
$e_pending=$result['e_pending'];

//set notification to pending
$subject="Recipe Pending Approval";
$type="2";
$admin="1";
$message="<p><h4>Thank you for your submission!</h4></p>
<p>Your recipe \"<a href=\"/recipe/".$title."\" target=\"_blank\">".$title."</a>\" is now awaiting validation.</p>
<p>If everything is in order it will be live within the next 48 hours.</p>";

//delete existing notifications

$stmt=$conn->prepare("DELETE FROM notifications WHERE recipe_ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();

$stmt= $conn->prepare("INSERT INTO notifications (user_ID, recipe_ID, user, userslug, slug, title, subject, message, type, admin) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss", $user_ID, $recipe_ID, $user, $userslug, $titslug, $title, $subject, $message, $type, $admin);
$stmt->execute();


//send e-mail notification

if ($e_pending=="1") {

$to=$email;
$subject="Your recipe is being approved";
$message ="<h4>Thank you for your submission!</h4>";
$message .="<p>Your recipe \"<a href=\"https://cookery-corner.co.uk/recipe/".$title."\" target=\"_blank\">".$title."</a>\" is now awaiting validation.</p>";
$message.="<p>If everything is in order it will be live within the next 48 hours.</p>";
$headers ="From: <noreply@cookery-corner.co.uk>\r\n";
$headers.="Content-type: text/html\r\n";
	
mail($to, $subject, $message, $headers);
};



//if successful update recipe to preview stage and return to publisher page.		
 
$stmt = $conn->prepare("UPDATE recipes SET stage=9 WHERE ID=?");
$stmt->bind_param("s", $recipe_ID);
if ($stmt->execute()===true){$messager = "Recipe Submitted";
								include($return);
								exit();}

?>	
