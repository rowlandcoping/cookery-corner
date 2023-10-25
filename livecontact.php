<html>
	<head>
	<title>Cookery Corner - Live Blog Contact</title>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$doctype="$path"."/includes/doctype.php";
$head = "$path"."/includes/head_publicform.php";

require_once($config);
require_once($doctype);
require_once($head);
if (isset ($_GET['live-origin'])) {

$stmt=$conn->prepare("SELECT title, slug FROM liveblog WHERE ID=?");
$stmt->bind_param("s", $_GET['live-origin']);
$stmt->execute();
$array=$stmt->get_result();
$result= $array->fetch_assoc();
$origin = $result['title']; $slug = $result['slug'];
}else {if (!empty($origin)) {$origin=$origin; $slug=$slug;}else{$origin="unknown";$slug="";}}

?>


<body>

<form action="/includes/livecontact_action.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="origin" value="<?php echo $origin;?>" readonly/>
<input type="hidden" name="slug" value="<?php echo $slug;?>" readonly/>
<div class="form">
	
<div class="section">
<h1>Get Involved!</h1>

<?php if (!empty($error)){ echo "<h3><span style=\"color:red\">$error</span></h3>";}
if (!empty($winner)){ echo "<h3><span style=\"color:green\">$winner</span></h3>";unset($name, $content);}	?>

<br><span style="color:red;font-size:1.5em;">*</span> Signifies a compulsary field.  Do be sure to fill those out! 
<br>Well, unless you REALLY want to read the error messages.
</div>

<div class="section">
<h3><span style="color:red;">*</span> How would you like to be known?</h3><input type="text"  name="name" size="40" value="<?php if(!empty($name)){echo $name;}?>" required/>
<label for="If you can read this then please leave this field blank"><input type="text"  name="email" size="40"/></label>
</div>


<div class="section">
<h3><span style="color:red;">*</span> Say your piece....
</h3><textarea type="text" name="content" rows="10" cols="50" required><?php if(!empty($content)){echo $content;}?></textarea>
</div>

<div class="section">
<h3>A picture speaks a thousand words:</h3><input type="file" name="image"/>
</div>

<div class="section">
<p><input type="submit" class="button" name="submit" value="Submit" /></p>
</div>
</div>
</form>

</body>
</html>
