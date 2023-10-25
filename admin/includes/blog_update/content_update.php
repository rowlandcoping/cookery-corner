<?php

$stmt=$conn->prepare("SELECT title, content, keywords FROM blog WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
?>
<h1>Update <?php echo $result['title'];?></h1>
<form action="/admin/update_blog.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>

<div>
<p><hr>
<label for="content"><h4><span style="color:red;">* </span>Update Content:</h4></label></p>
<p><textarea name="content" rows="20" cols="100" required><?php echo $result['content'];?></textarea>
</p>

<p>
<label for="form"><span style="color:red;">*</span>Update Keywords:
</p>
<p>
<input type="text"  name="keywords" value="<?php echo $result['keywords'];?>" required/>
</p>
</div>

<p>
<hr>
<label for="update-content"><input type="submit" class="button" name="update-content" value="Update" />
</p>

</form>
<h4><a href="\admin\update_blog.php?edit-blog=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_blog.php">Select a different blog post</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>

<?php

exit();


?>
