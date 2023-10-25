<?php session_start();?>
<html>
	<head>
		<script src="https://cdn.ckeditor.com/4.17.2/basic/ckeditor.js"></script>
	<title>Cookery Corner - Contact</title>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$doctype="$path"."/includes/doctype.php";
$head = "$path"."/includes/head_publicform.php";
$worlds = "$path"."/includes/destroyerofworlds.php";

require_once($config);
require_once($doctype);
require_once($head);
?>


<body>
<form action="/includes/contactform_action.php" method="POST" enctype="multipart/form-data">
	
<div class="form">
	
<div class="section">
<h1>Get in Touch</h1>
<?php if (!empty($successmess)){echo "<hr/><h3><span style=\"color:#83f28f;\">".$successmess."</span><hr/></h3>"; unset ($name, $subject, $email, $message);}
				  if (!empty($messaging)) {echo "<hr/><h3><span style=\"color:red;\">".$messaging."</span><hr/></h3>";}?>
<br><span style="color:red;font-size:1.5em;">*</span> Signifies a compulsary field.
</div>

<div class="section">
<h3><span style="color:red;">*</span> Name</h3><label for="name"><input type="text" name="name" size="40" value="<?php if (!empty($name)){echo $name;}?>" required/></label>
</div>

<div class="section">
<h3><span style="color:red;">*</span> Subject</h3><label for="subject"><input type="text" name="subject" size="40" value="<?php if (!empty($subject)) {echo $subject;}?>" required/></label>
</div>

<div class="section">
<h3>e-mail (important if you want a reply!)</h3>
<label for="If you can read this then please leave this field blank"><input type="text"  name="email" size="40"/></label>
<label for="e-mail"><input type="text"  name="realone" size="40" value="<?php if (!empty($email)) {echo $email;}?>"/></label>
</div>

<div class="section">
<h3><span style="color:red;">*</span> Message
</h3><label for="message"><textarea type="text"  name="message"rows="10" cols="50"  required><?php if (!empty($message)) {echo $message;}?></textarea></label>
<script>
            CKEDITOR.replace( 'message');
</script>
</div>
<?php
//require_once($worlds);
?>
<div class="section">
<p><input type="submit" class="button" name="submit" value="Submit" /></p>
All details requested are only for the purposes of handling enquiries and any such information will be deleted on request.
<p>Nothing whatsoever is used for marketing purposes on this site; if that ever changes every user will first have to proactively opt in.</p>
</div>
</div>
</form>

</body>
</html>
