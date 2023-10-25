<?php if(!isset($_SESSION)){session_start();}?>

<html>
	<head>
	<title>Cookery Corner - Live Blog Contact</title>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$head = "$path"."/includes/head_publicform.php";
$loginpath = "$path"."/publiclogin.php";
$logout=$path."/logout";

require_once($config);
require_once($head);

if (!isset($_SESSION['loggedin'])) {
	$messaging= "Please log in first to access this page";
	include($loginpath);
	exit();
}

if ($_SESSION['role']!="admin"){
	echo "Hello ";
	if (isset($_SESSION['loggedin'])) {
	
	echo $_SESSION['name']."!";
}
	echo "<p>You are not authorised to access this section of the site... yet!</p>
<p>Submit some recipes, tickle some tastebuds, who knows one day you too could be like Rowland.</p>

<p><a href=\"/index.php\">Home</a></p>";
exit();
}
?>
<form action="/admin/includes/liveblogupdate_action.php" method="POST" enctype="multipart/form-data">


<div class="form">
	
<div class="section">
<h1>Live Blog Update</h1>
<?php if (!empty($error)){ echo "<h3><span style=\"color:red\">$error</span></h3>";}
if (!empty($winner)){ echo "<h3><span style=\"color:green\">$winner</span></h3>"; unset($title, $content, $format);}	?>
<span style="color:red;font-size:1.5em;">*</span> Compulsary field

</div>

<div class="section">
<h3><span style="color:red;">* </span>Select Live Blog</h3><select name='title'>
<?php           
$result = $conn->query("select timestamp, title from liveblog WHERE closed=0 ORDER BY timestamp ASC");
?>

<?php
    while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['title'];
                  $name = $row['title']; 
                  if ($name == $title) { echo '<option value="'.$id.'"selected>'.$name.'</option>';}
                   else{ echo '<option value="'.$id.'">'.$name.'</option>';}            
}
?>
</select>
</div>

<div class="section">
	<h3><span style="color:red;">*</span> Select time format
</h3><input type="radio" name="format" value="day_time" <?php if (!empty($_POST['format'])) {if ($_POST['format']=="day_time") {echo "checked=\"checked\"";}}?>>Day and time</label><label for="tile">
	<input type="radio" name="format" value="time" <?php if (!empty($_POST['format'])) {if ($_POST['format']=="time") {echo "checked=\"checked\"";}}?>>Time only</label>
</div>

<div class="section">
<h3><span style="color:red;">*</span> Liveblog Entry
</h3><textarea type="text"  name="content" rows="10" cols="50" required><?php if(!empty($content)){echo $content;}?></textarea>
</div>

<div class="section">
<h3>A picture speaks a thousand words:</h3>
<input type="file"  name="image"/>
<h3><br />Or post link to user supplied image</h3>
<input type="text" name="link"/>
</div>

<div class="section">
<p><input type="submit" class="button" name="submit" value="Submit" /></p>
</div>
</div>
</form>

</body>
</html>
