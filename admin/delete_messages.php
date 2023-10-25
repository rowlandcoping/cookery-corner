<?php session_start();?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = $path."/config.php";
$head = $path."/admin/includes/head_admin.php";

require_once($config);
require_once($head);

if (isset($_GET['delete-yes']))

{
$ID=$_GET['delete-yes'];

$stmt=$conn->prepare ("DELETE FROM general_contact WHERE ID=?");
$stmt->bind_param ("i", $ID);
$stmt->execute();

$updated = "Entry Deleted";
}

//Select Message to Delete
	
$stmt=("SELECT ID, timestamp, name, subject, email, message FROM general_contact ORDER BY ID DESC");
$result = $conn->query($stmt);
$num_results = $result->num_rows;

echo"<h1>Remove messages from database</h1><hr />";
if (!empty($updated)){echo "<h3><span style=\"color:red;\">".$updated."</span></h3>";}
if ($num_results===0){
echo"<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

echo "<h3>Select a submission to delete</h3>";


	

echo "<table border=1><th>Del</th><th>Date / Time</th><th>Sender</th><th>e-mail</th><th>Message</th>";

foreach ($result as $r) {
	
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $r['timestamp']);
$time = $new_date->format('d/m/y, H:i');		
	
echo	"<tr>
		<td>&nbsp<a class=\"fa fa-trash btn edit\" href=\"delete_messages.php?delete-message=".$r['ID']."\"></a>&nbsp</td>
		<td>&nbsp".$time."&nbsp</td>
		<td>&nbsp".$r['name']."&nbsp</td>
		<td>&nbsp".$r['email']."&nbsp</td>
		<td width=500>&nbsp".$r['message']."&nbsp</td>
		
		</tr>";
if (isset($_GET['delete-message']))

{ if ($_GET['delete-message'] == $r['ID']) {echo "<h3><span style=\"color:red;\">You have asked to delete the message from </span>".$r['name'].	"<span style=\"color:red;\"> received at </span>".$time."<br /><span style=\"color:red;\">
Are you sure? <a href=\"delete_messages.php?delete-yes=".$r['ID']."\">Yes</a> or <a href=\"delete_messages.php\">No</a>?</span></h3>";}
}}
echo "</table>";
}
?>

<h4><a href="\admin\admin.php">Return to Profile</a>
<br /><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>

<?php 
exit();  
?>
