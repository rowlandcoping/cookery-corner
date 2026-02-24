<?php
$ID=$_POST['ID'];
$stmt=$conn->prepare("SELECT slug, ingredient, ing_image FROM ingredients WHERE ID=?");
$stmt ->bind_param("i", $ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result1 = $array->fetch_assoc();

$ingredient=$result1['ingredient'];
$oldimage=$result1['ing_image'];

//get array of recipe IDs with this ingredient
$stmt=$conn->prepare("SELECT recipe_ID FROM ing_index WHERE ingredient_ID=? ORDER BY ID ASC");
$stmt->bind_param("s", $ID);
$stmt->execute();				
$array2=$stmt->get_result();



echo "<h3><span style=\"color:red;\">".$ingredient." deleted</span></h3>";
echo "<h3>Recipes Affected:</h3>";

//list affected recipes and send info to notification table
foreach ($array2 as $recid) {

$ID2= $recid['recipe_ID'];
$excellent=$conn->prepare("SELECT ID, user_ID, titslug, title FROM recipes WHERE ID=? AND stage>8");
$excellent->bind_param("s", $ID2);
$excellent->execute();				
$outcome2=$excellent->get_result();


foreach ($outcome2 as $problem){
	
    echo"<div class=leftres><h3><a href=\"/recipe/".$problem['titslug']."\" target=\"_blank\">".$problem['title']."</h3></a></p></div>";

//send notification
$IDN=$problem['ID'];
$slug=$problem['titslug'];
$title=$problem['title'];
$user_ID=$problem['user_ID'];
$message= "The ingredient \"".$ingredient."\" has been removed from Cookery Corner.</p>
<p>Your recipe \"<a href=\"https://cookery-corner.co.uk/recipe/".$title."\" target=\"_blank\">".$title."</a>\" has been affected.</p>
<p>Please replace the ingredient and re-submit.</p>";
$subject="Recipe Needs Updating";
$type=1;
$admin=1;
$stmt = $conn->prepare("SELECT email, name, slug, e_urgent from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$email=$result['email'];
$user=$result['name'];
$userslug=$result['slug'];
$e_urgent=$result['e_urgent'];

$stmt= $conn->prepare("INSERT INTO notifications (user_ID, recipe_ID, user, userslug, slug, title, subject, message, type, admin) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss", $user_ID, $recipe_ID, $user, $userslug, $titslug, $title, $subject, $message, $type, $admin);
$stmt->execute();

if ($e_urgent=="1") {

    require($path . "/mailconfig.php");

    $mailbody ="The ingredient \"".$ingredient."\" has been removed from Cookery Corner.</p>
    <p>Your recipe \"<a href=\"https://cookery-corner.co.uk/recipe/".$title."\" target=\"_blank\">".$title."</a>\" has been affected.</p>";
    $mailbody.="<p>Please replace the ingredient and re-submit.</p>";

    try {
        $mail = createMailer();
        $mail->addAddress($email);
        $mail->Subject = "Recipe Needs Updating";
        $mail->Body    = $mailbody;
        $mail->send();
    } catch (Exception $e) {
        $errormess = "Mailer error: " . $mail->ErrorInfo;
    }
}


//set to preview, review stage
$stmt=$conn->prepare("UPDATE recipes SET live=0, stage=8 WHERE ID=?");
$stmt -> bind_param("i", $IDN);
$stmt->execute();
$stmt=$conn->prepare("UPDATE article_index SET live=0 WHERE recipe_ID=?");
$stmt -> bind_param("i", $IDN);
$stmt->execute();
}
}
//delete all trace!
$stmt=$conn->prepare ("DELETE FROM ingredients WHERE ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();
$stmt=$conn->prepare ("DELETE FROM ing_index WHERE ingredient_ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();

if (!empty($oldimage)) { if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}}

?>
<h4><a href="\admin\update_ingredient.php">Update a different ingredient</a>
<br><a href="\admin\admin.php">Return to Admin Home</a></h4>
<?php
exit ();
?>
