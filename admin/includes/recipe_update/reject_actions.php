<?php

//update notifications


$type="1";
$admin="0";
$user_ID=$_POST['user_ID'];
$recipe_ID=$_POST['recipe_ID'];

$stmt = $conn->prepare("SELECT email, name, slug, e_urgent from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$email=$result['email'];
$user=$result['name'];
$userslug=$result['slug'];
$e_urgent=$result['e_urgent'];
$stmt= $conn->prepare("SELECT titslug, title FROM recipes WHERE ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$titslug=$result['titslug'];
$title=$result['title'];
$subject="Recipe Rejected";
$message= "<p>Your recipe \"<a href=\"/recipe/".$title."\" target=\"_blank\">".$title."</a>\" has been rejected.</p>
<p>Please update as outlined and re-submit:</p>".$_POST['message'];



$stmt= $conn->prepare("INSERT INTO notifications (user_ID, recipe_ID, user, userslug, slug, title, subject, message, type, admin) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss", $user_ID, $recipe_ID, $user, $userslug, $titslug, $title, $subject, $message, $type, $admin);
$stmt->execute();



//send notification e-mail
if ($e_urgent=="1") {
    require($path . "/mailconfig.php");

    $mailbody ="<p>Your recipe \"<a href=\"https://cookery-corner.co.uk/recipe/".$title."\" target=\"_blank\">".$title."</a>\" has been rejected.</p>";
    $mailbody.="<p>Please update as outlined and re-submit</p>";
    $mailbody.= $_POST['message'];

    try {
        $mail = createMailer();
        $mail->addAddress($email);
        $mail->Subject = "Your Recipe has been Rejected";
        $mail->Body    = $mailbody;
        $mail->send();
    } catch (Exception $e) {
        $errormess = "Mailer error: " . $mail->ErrorInfo;
    }
}
//delete pending notification
$stmt=$conn->prepare("DELETE FROM notifications WHERE type=2 and recipe_ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();
//set recipe stage back to 8
$stmt=$conn->prepare("UPDATE recipes SET stage=8 WHERE ID=?");
$stmt->bind_param("s", $recipe_ID);
$stmt->execute();

echo "<h2><a href=\"/recipe/".$result['titslug']."\" target=\"_blank\" rel=\"noreferrer noopener\">".$result['title']."</a></h2>";
echo "<h3><span style=\"color:red\">Recipe Rejected</span></h3>";
echo "<h4><a href=\"\admin\update_recipe.php?user-id=".$user_ID."\">Approve another recipe</a>";
echo "<br><a href=\"\admin\admin.php\">Return to Admin Home</a></h4>";

exit();
