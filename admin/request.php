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
$return=$path."/admin/admin.php";

require_once($config);
require_once($head);

if (isset($_POST['action-request'])) {
	
$user_ID= $_POST['user_ID'];
$issue = $_POST['request'];
$message = "<p>Request Submitted:</p>
<p>\"<i>".$issue."</i>\"</p>";
$admin="1";
$subject="Request Submitted";
$type="4";
$stmt = $conn->prepare("SELECT email, name, slug from users WHERE ID=?");
$stmt->bind_param("s", $user_ID);
$stmt->execute();
$array= $stmt->get_result();
$result=$array->fetch_assoc();
$email=$result['email'];
$user=$result['name'];
$userslug=$result['slug'];

$stmt= $conn->prepare("INSERT INTO notifications (user_ID, recipe_ID, user, userslug, subject, message, type, admin) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssss", $user_ID, $recipe_ID, $user, $userslug, $subject, $message, $type, $admin);
$stmt->execute();


//notification e-mail

$to=$email;
$subject="Cookery Corner request submitted";
$message ="<p>You have requested the following:</p>";
$message .="<p>\"<i>".$issue."</i>\"</p>";
$message.="<p>One of our team will respond as soon as possible, usually within 48 hours.</p>";
$headers ="From: <noreply@cookery-corner.co.uk>\r\n";
$headers.="Content-type: text/html\r\n";
	
mail($to, $subject, $message, $headers);


$message="<h2><span style=\"color:green\">Request Submitted</span></h2>";
include($return);
exit();
}
?>

<div class=section2>
<h2>Request Form</h2>






<?php
if (!empty($message)){echo "<hr><h4>&nbsp<span style=\"color:red;\">!---&nbsp".$message."&nbsp---!</h3><hr>";}?>
<div class=ingredients>
<div class=holding>
<div class=left>

<div class=listing>
	
	
	
	
	
	
	
<form action="/admin/request.php" method="POST" enctype="multipart/form-data">	
<input type="hidden" name="user_ID" size="1" value="<?php echo $_SESSION['ID'];?>" readonly/>	
<label for="request"><h3>Please outline your request here:</h3></label>
<p>For ingredients please be as specific as possible (eg basamati rice NOT just rice).
<br>For anything else please be clear on the section to which you need your request added (eg cuisine, category, etc).
<br />&nbsp; </p>
<p><textarea name="request" cols="50" rows="5" required></textarea></p>
<p><label for="Submit"><input type="submit" class="button" name="action-request" value="Submit Request" /></p>
</form>


</div>

</div>
</div>
</div>
</div>
<h4><a href="/admin/admin.php">Return to profile</a>
<br /><a href="/index.php">Back to Homepage</a>
<br /><a href="/logout">Log out</a></h4>
