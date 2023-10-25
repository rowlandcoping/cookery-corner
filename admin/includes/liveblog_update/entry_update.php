<?php

$stmt=$conn->prepare("SELECT ID, liveblog_ID, time, content, image FROM live_blog WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

$stmt=$conn->prepare("SELECT ID, title FROM liveblog WHERE ID=?");
$stmt ->bind_param("s", $result['liveblog_ID']);
$stmt ->execute();
$array = $stmt ->get_result();
$title = $array->fetch_assoc();

?>


<form action="/admin/update_liveblog.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<input type="hidden" name="liveblog_ID" size="1" value="<?php echo $result['liveblog_ID'];?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $result['image'];?>" readonly/>

<div class=container>
<div class=section1>
	
	
<h1>Update "<?php echo $title['title'];?>"</h1>


<div class=section>
<div class=left>
	
<ul>
<li id=recipe><label for="intro"><h4><span style="color:red;">* </span>Update time of entry:</h4></label></li>
</ul>

<ul>
<li id=recipe><textarea style="resize: none;" name="time" rows="3" cols="30" required><?php echo $result['time'];?></textarea></li>
</ul>
<br />
<br />
<ul>
<li id=recipe><label for="intro"><h4><span style="color:red;">* </span>Update live blog entry:</h4></label></li>
</ul>

<ul>
<li id=recipe><textarea name="content" rows="15" cols="60" required><?php echo $result['content'];?></textarea></li>
</ul>

</div>

<div class=left>
<ul>
<li id=recipe><h4><label for="image">Update Entry Image:</label></h4></li>
</ul>


<?php echo "<img src=\"/assets/images/liveblog/".$result['image']."\"width=\"100\"/>";?>


<ul>
<li id=recipe><input type="file" name="image"></li>
</ul>

</div>

</div>


<label for="update-entry"><input type="submit" class="button" name="update-entry" value="Update Entry" />


</form>
</div>
</div>

<h4><a href="\admin\update_liveblog.php?edit-content=<?php echo $result['liveblog_ID'];?>">Update a different entry</a>
<br><a href="\admin\update_liveblog.php">Select a different live blog</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
</div>
<?php

exit();


?>
