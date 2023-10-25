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
$return="$path"."/admin/admin.php";

require_once ($config);
require_once ($head);
$ID=$_SESSION['ID'];


//ACTION IT

if (isset($_POST['update-settings'])){
	
$e_contact=$_POST['e_contact']; 
$e_urgent=$_POST['e_urgent'];
$e_request=$_POST['e_request'];
$e_pending=$_POST['e_pending'];
$e_approval=$_POST['e_approval']; 
$contact=$_POST['contact'];
$pending=$_POST['pending']; 
$approval=$_POST['approval'];	
	
	
$stmt=$conn->prepare("UPDATE users SET e_contact=?, e_urgent=?, e_request=?, e_pending=?, e_approval=?, contact=?, pending=?, approval=? WHERE ID=?");
$stmt ->bind_param("iiiiiiiii", $e_contact, $e_urgent, $e_request, $e_pending, $e_approval, $contact, $pending, $approval, $ID);

if ($stmt->execute()=== TRUE) {$message="<h3><span style=\"color:green;\">Notification Settings Updated</span></h3>"; include ($return); exit();}
else{$message="<h3><span style=\"color:red;\">You Have Failed - Notification Settings Not Updated</span></h3>";include ($return); exit();}
}




//FORM SECTION


$rec_usr = $_SESSION['ID'];

if ($_SESSION['role']==="user" & $rec_usr!=$ID)
{ echo "<p>I don't know how you did that but it is not allowed.
		<br><a href=\"\admin\admin.php\">Return to Profile</a></p>";
		exit();
}

$stmt=$conn->prepare("SELECT e_contact, e_urgent, e_request, e_pending, e_approval, contact, pending, approval FROM users WHERE ID=?");
$stmt ->bind_param("i", $ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();





?>
<form action="/admin/notifications.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" value="<?php echo $ID;?>" readonly/>



<div class=overall>
<div class=user>
<div class=information>
<?php if ($_SESSION['role']=="user"){echo"
	
<h2>Change Your Notification Settings</h2>

<p> If you're anything like me you'll want to turn all these off - but keep in mind urgent notifications and anything to do with an active request will
always be sent to your profile page (ie stuff that requires an action).</p>";}else{echo"<h2>Change Notification Settings</h2>";}
?>
<hr />
<h3>e-mail Alerts</h3>

<table class="notifications">

<th>Type of Alert</th><th><span style="color:green">YES</span></th><th><span style="color:red">NO</span></th>

<?php if ($_SESSION['role']=="admin"){
echo"<tr><td>Contact alerts:</td><td><input type=\"radio\" name=\"e_contact\" value=\"1\"";
if ($result['e_contact']=="1") {echo"checked";}
echo"></td><td><input type=\"radio\" name=\"e_contact\" value=\"0\"";
if ($result['e_contact']=="0") {echo"checked";}
echo"></td></tr>";
}else{echo "<input type=\"hidden\" name=\"e_contact\" value=\""; echo $result['e_contact']; echo"\" readonly/>";}
	
?>

<tr><td>Urgent action alerts:</td><td><input type="radio" name="e_urgent" value="1"<?php if ($result['e_urgent']=="1") {echo"checked";}?>></td><td><input type="radio" name="e_urgent" value="0"<?php if ($result['e_urgent']=="0") {echo"checked";}?>></td></tr>
<tr><td>Alerts for active requests:</td><td><input type="radio" name="e_request" value="1"<?php if ($result['e_request']=="1") {echo"checked";}?>></td><td><input type="radio" name="e_request" value="0"<?php if ($result['e_request']=="0") {echo"checked";}?>></td></tr>
<tr><td>Pending action alerts:</td><td><input type="radio" name="e_pending" value="1" <?php if ($result['e_pending']=="1") {echo"checked";}?>></td><td><input type="radio" name="e_pending" value="0"<?php if ($result['e_pending']=="0") {echo"checked";}?>></td></tr>
<tr><td>Recipe approval alerts:</td><td><input type="radio" name="e_approval" value="1" <?php if ($result['e_approval']=="1") {echo"checked";}?>></td><td><input type="radio" name="e_approval" value="0"<?php if ($result['e_approval']=="0") {echo"checked";}?>></td></tr>

</table>

<hr />
<h3>Profile Page Notifications</h3>

<table class="notifications">

<th>Notification</th><th><span style="color:green">YES</span></th><th><span style="color:red">NO</span></th>

<?php if ($_SESSION['role']=="admin"){
echo"<tr><td>Contact notifications:</td><td><input type=\"radio\" name=\"contact\" value=\"1\"";
if ($result['contact']=="1") {echo"checked";}
echo"></td><td><input type=\"radio\" name=\"contact\" value=\"0\"";
if ($result['contact']=="0") {echo"checked";}
echo"></td></tr>";
}else{echo "<input type=\"hidden\" name=\"contact\" value=\""; echo $result['contact']; echo"\" readonly/>";}
 ?>

<tr><td>Pending actions notifications:</td><td><input type="radio" name="pending" value="1"<?php if ($result['pending']=="1") {echo"checked";}?>></td><td><input type="radio" name="pending" value="0"<?php if ($result['pending']=="0") {echo"checked";}?>></td></tr>
<tr><td>Recipe approval notifications:</td><td><input type="radio" name="approval" value="1"<?php if ($result['approval']=="1") {echo"checked";}?>></td><td><input type="radio" name="approval" value="0"<?php if ($result['approval']=="0") {echo"checked";}?>></td></tr>
</table>

<hr />

<label for="Submit"><input type="submit" class="button" name="update-settings" value="Update Settings" />
<hr />
</form>
</div>
</div>
</div>
<h4><a href="/admin/admin.php">Return to profile</a>
<br /><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
