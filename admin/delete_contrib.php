<?php if(!isset($_SESSION)){session_start();}?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = $path."/config.php";
$head = $path."/admin/includes/head_admin.php";
$imgpath = "$path"."/assets/images/liveblog";

require_once($config);
require_once($head);

if (isset($_GET['delete-yes']))

{
$ID=$_GET['delete-yes'];
$image=$_GET['image-used'];

$stmt=$conn->prepare ("DELETE FROM liveblog_contact WHERE ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();

if (!empty($image))

{
$stmt=$conn->prepare ("SELECT image FROM live_blog WHERE image=?");
$stmt->bind_param ("s", $image);
$stmt->execute();
$array = $stmt ->get_result();
$result=$array->fetch_assoc();


if (empty($result)) { if (file_exists("$imgpath"."/"."$image")) {unlink("$imgpath"."/"."$image");}}
}

$updated = "Entry Deleted";
}


	
$stmt=("SELECT ID, timestamp, origin, name, content, image FROM liveblog_contact ORDER BY ID DESC");
$result = $conn->query($stmt);
$num_results = $result->num_rows;

echo"<h1>Remove User submissions from database</h1><hr />";
if (!empty($updated)){echo "<h3><span style=\"color:red;\">".$updated."</span></h3>";}
if ($num_results===0){
echo"<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

echo "<h3>Select a submission to delete</h3>";


	

echo "<table border=1><th>Del</th><th>Date / Time</th><th>Related Liveblog</th><th>Sender</th><th>Message</th><th>Image</th>";

foreach ($result as $r) {
	
if (!empty ($r['timestamp'])) {$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$time = $new_date->format('d/m/y, H:i');		
}else{$time="";}

echo	"<tr>
		<td>&nbsp<a class=\"fa fa-trash btn edit\" href=\"delete_contrib.php?delete-contrib=".$r['ID']."\"></a>&nbsp</td>
		<td>&nbsp".$time."&nbsp</td>
		<td>&nbsp".$r['origin']."&nbsp</td>
		<td>&nbsp".$r['name']."&nbsp</td>
		<td>&nbsp".substr($r['content'], 0, 2400)."&nbsp</td>
		<td>&nbsp <a href=\"/assets/images/liveblog/".$r['image']."\" target=\"_blank\">".$r['image']."</a>&nbsp</td>
		
		</tr>";
if (isset($_GET['delete-contrib']))

{ if ($_GET['delete-contrib'] == $r['ID']) {echo "<h3><span style=\"color:red;\">You have asked to delete the message from </span>".$r['name'].	"<span style=\"color:red;\"> received at </span>".$time."<br /><span style=\"color:red;\">
Are you sure? <a href=\"delete_contrib.php?delete-yes=".$r['ID']."&image-used=".$r['image']."\">Yes</a> or <a href=\"delete_contrib.php\">No</a>?</span></h3>";}
}}
echo "</table>";
}
?>

<h4><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>

<?php 
exit();  
?>
