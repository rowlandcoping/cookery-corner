<?php
$stmt=$conn->prepare("SELECT slug, $heading, $image, $caption, $review, $rating FROM reviews WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();

$oldimage = $result["$image"];
?>

<h1><span style="color:red;">-----IMPORTANT QUESTION-----</span></h1>

<h2>Do you <span style="color:red;">REALLY</span> want to delete forever the review:</h2>
<h2>"<?php echo "<a href=\"/reviews/".$result['slug']."\">".$result["$heading"]."</a>";?>"</h2>
<h2>I mean, really really???</h2>



<form action="/admin/update_review.php" method="POST" enctype="multipart/form-data">
<input id="ID" type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<input id="heading" type="hidden" name="heading" size="1" value="<?php echo $heading;?>" readonly/>
<input id="image" type="hidden" name="image" size="1" value="<?php echo $image;?>" readonly/>
<input id="review" type="hidden" name="review" size="1" value="<?php echo $review;?>" readonly/>
<input id="caption" type="hidden" name="caption" size="1" value="<?php echo $caption;?>" readonly/>
<input id="rating" type="hidden" name="rating" size="1" value="<?php echo $rating;?>" readonly/>
<input id="oldimage" type="hidden" name="oldimage" value="<?php echo $oldimage;?>" readonly/>
<p>
<hr>
<label for="delete-review"><input type="submit" class="button" name="delete-review" value="Yes, really really really really..." /?</p>
<h2><a href="https://c.tenor.com/9mLPT5v1ah8AAAAd/how-to-introduce-your-cat-to-a-bunny-cat.gif" target=_blank>Noooooooo..... Wait.....Stop..... Help me!!!</a></h2>

<h4><a href="\admin\update_review.php?edit-review=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_review.php">Select a different review</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
<?php
exit ();
?>


