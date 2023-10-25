<?php

$stmt=$conn->prepare("SELECT ID, $heading, $image, $caption, $review, $rating, slug FROM reviews WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();


$revheading= $result["$heading"];
$revimage = $result["$image"];
$revcaption =$result["$caption"];
$revreview = $result["$review"];
$revrating = $result["$rating"];

$slug=$result['slug'];
?>

<form action="/admin/update_review.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $revimage;?>" readonly/>
<input type="hidden" name="headtype" value="<?php echo $heading;?>" readonly/>
<input type="hidden" name="imgtype" value="<?php echo $image;?>" readonly/>
<input type="hidden" name="captype" value="<?php echo $caption;?>" readonly/>
<input type="hidden" name="revtype" value="<?php echo $review;?>" readonly/>
<input type="hidden" name="rattype" value="<?php echo $rating;?>" readonly/>


<h1>Update Review Section</h1>
<div>
<hr>
<h4><label for="form"><span style="color:red;">*</span> Update Heading:</h4>
<p><input type="text"  name="heading" value="<?php echo $revheading;?>" /></p>
<hr>
</div>

<div>
<h4><label for="image"><span style="color:red;">*</span> Update Image:</label></h4>
<p><?php echo "<img src=\"/assets/images/reviews/".$revimage."\"width=\"100\"/></div></td></tr>";
?></p>

<p>
<input type="file" name="revimage"></p>
<h4><label for="form"><span style="color:red;">*</span> Update Caption:</h4>
<p><input type="text" name="caption" value="<?php echo $revcaption;?>" /></p>
</div>

<div>
<p><hr>
<label for="description"><h4><span style="color:red;">*</span>Update Review Segment:</h4></label><p class=info></p>
<p><textarea name="review" rows="20" cols="100"><?php echo $revreview;?></textarea>
</p>

<h4><label for="form"><span style="color:red;">*</span> Update Rating:</h4>
<p><input type="text"  name="rating" value="<?php echo $revrating;?>" /></p>

</div>

<p>
<hr>
<label for="update-review"><input type="submit" class="button" name="update-review" value="Update Section" />
</p>

</form>
<h4><a href="\admin\update_review.php?edit-review=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_review.php">Select a different review</a>
<br><a href="\admin\admin.php">Return to Admin Home</a></h4>
<?php

exit();


?>
