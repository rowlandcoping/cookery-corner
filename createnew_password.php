 <?php
$path = $_SERVER['DOCUMENT_ROOT'];

$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$resetpass = "$path"."/reset_password.php";

require($config);

if (empty ($_GET ['selector'])){$selector = $_POST['selector'];}else{$selector = $_GET ['selector'];}
if (empty ($_GET ['validator'])){$validator = $_POST['validator'];}else{$validator = $_GET ['validator'];}

if (empty($selector) || empty($validator))
{	$errormess= "link not valid, to reset password request a new one";
	include ($resetpass);
	exit();
} else {
if ((ctype_xdigit($selector)) !== false && (ctype_xdigit($validator)) !== false) 
{	
?>

<div style="width: 40%; margin: 20px auto;">
<h2>Create New Password</h2>

<h3><span style="color:red"><?php if (!empty($errormess)) {echo "!--- ".$errormess." ---!";}?></span></h3>
<form method="post" autocomplete="off" action="/passwordchange">
	<input type="hidden" name="selector" value="<?php echo $selector;?>">
	<input type="hidden" name="validator" value="<?php echo $validator;?>">
	<p>New Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="pwd"  autocomplete="new-password" placeholder="enter a new password"></p>
<p>Confirm Password: <input type="password" name="pwd_conf"  autocomplete="new-password" placeholder="confirm new password"></p>
<p><button type="submit" name="reset-password-submit">Reset Password</button></p>
	</form>
</div>

<p><a href="/index.php">Back to Homepage</a></p>
<?php }} ?>