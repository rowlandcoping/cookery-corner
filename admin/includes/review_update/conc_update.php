<?php

$stmt=$conn->prepare("SELECT title, summary FROM reviews WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
?>
<h1>Update <?php echo $result['title'];?></h1>
<form action="/admin/update_review.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>

<div>
<p><hr>
<label for="summary"><h4><span style="color:red;">* </span>Update Conclusion:</h4></label></p>
<p><textarea name="summary" rows="20" cols="100" required><?php echo $result['summary'];?></textarea>
</p>
</div>

<p>
<hr>
<label for="update-conc"><input type="submit" class="button" name="update-conc" value="Update" />
</p>

</form>
<h4><a href="\admin\update_review.php?edit-review=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_review.php">Select a different review</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>

<?php

exit();


?>
