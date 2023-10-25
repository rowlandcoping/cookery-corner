<?php

$stmt=$conn->prepare("SELECT ID, liveblog_ID, time, content, image FROM live_blog WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$ID=$result['ID'];
$live_ID=$result['liveblog_ID'];
$image= $result['image'];

$stmt=$conn->prepare("SELECT title, slug FROM liveblog WHERE ID=?");
$stmt ->bind_param("s", $live_ID);
$stmt ->execute();
$array = $stmt ->get_result();
$result2 = $array->fetch_assoc();

?>
<h2><span style="color:red">-----CAUTION-----</span></h2> 
<h3>You are about to delete the following post from "<?php echo"<a href=\"/liveblog/".$result2['slug']."\" target=\"_blank\">".$result2['title']."\"</a></h3><hr />";
?>


	
	
	
<?php
if ($image != NULL) {
echo "<img src=\"/assets/images/liveblog/".$image."\" width=\"350\" /></div>";
}else {
echo "</div>";
}	
echo "<p>";
echo ($result['time']);
echo "</p>";
echo "<p>";
echo ($result['content']);
echo "</p>";
echo "</div><hr />";

echo "<h3>Are you sure??</h3>
		<hr />";
		
?>
<form action="/admin/update_liveblog.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="oldimage" value="<?php echo $image;?>" readonly/>
<input type="hidden" name="ID" size="1" value="<?php echo $ID;?>" readonly/>
<input type="hidden" name="liveblog_ID" size="1" value="<?php echo $live_ID;?>" readonly/>

<label for="delete"><input type="submit" class="button" name="delete" value="Obviously I'm sure, this content is so bad" />	
</form>
<h4><a href="\admin\update_liveblog.php?edit-content=<?php echo $result['liveblog_ID'];?>">Update a different entry</a>
<br><a href="\admin\update_liveblog.php">Select a different live blog</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
<?php
exit();
?>
