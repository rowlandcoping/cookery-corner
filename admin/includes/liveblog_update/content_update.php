<?php

$stmt=$conn->prepare("SELECT ID, slug, title FROM liveblog WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$title = $array->fetch_assoc();

$stmt=$conn->prepare("SELECT ID, time, content FROM live_blog WHERE liveblog_ID=? ORDER BY ID DESC");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$result = $stmt ->get_result();
$num_results = $result->num_rows;



echo"<h1>Update \"<a href=\"/liveblog/".$title['slug']."\" target=\"_blank\">".$title['title']."</a>\" Entries</h1><hr />";
if (!empty($updated)){echo "<h3><span style=\"color:red;\">".$updated."</span></h3>";}
if ($num_results===0){
echo"<h3><span style=\"color:red;\">No results found, try again.</span></h3>";
}else{

echo "<h3>Select an entry to update:</h3>";
echo "<table border=1>";

foreach ($result as $r) { 
echo	"<tr>
		<td>&nbsp<a class=\"fa fa-trash btn edit\" href=\"update_liveblog.php?delete-entries=".$r['ID']."\"></a>&nbsp</td>
		<td>&nbsp<a class=\"fa fa-pencil btn edit\" href=\"update_liveblog.php?edit-entries=".$r['ID']."\"></a>&nbsp</td>
		<td>&nbsp".substr($r['content'], 0, 80)."&nbsp</td>
		<td>&nbsp".$r['time']."&nbsp</td>
		</tr>";
}}

?>
</table>
<h4><a href="\admin\update_liveblog.php?edit-liveblog=<?php echo $post_id;?>">Update a different section</a>
<br /><a href="\admin\update_liveblog.php">Select another live blog</a>
<br /><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>

<?php 
exit();  
?>


