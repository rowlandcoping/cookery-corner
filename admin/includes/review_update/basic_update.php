<?php

$stmt=$conn->prepare("SELECT ID, border_text, h2h3_color, page_background, page_color, text_background, textback_color, title, slug, 
rating_name, main_image, main_caption, description FROM reviews WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();


$mainimage = $result['main_image'];
$pageback = $result['page_background'];
$textback = $result['text_background'];
$slug=$result['slug'];

?>
<form action="/admin/update_review.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<input type="hidden" name="oldtitle" value="<?php echo $result['title'];?>" readonly/>
<input type="hidden" name="oldslug" value="<?php echo $slug;?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $mainimage;?>" readonly/>
<input type="hidden" name="oldpageback" value="<?php echo $pageback;?>" readonly/>
<input type="hidden" name="oldtextback" value="<?php echo $textback;?>" readonly/>

<div class=container>
<div class=section1>

<h2>Update Review</h2>


<div class=section>
<div class=left>

<ul>
<li id=recipe><label for="form"><span style="color:red;">* </span>Update Title:</li>
<li id=recform><textarea style="resize: none;" name="title" required rows="1" cols="40" required><?php echo $result['title'];?></textarea></li>
</ul>

<hr />

<ul>
<li id=recipe><label for="border_text"><span style="color:red;">* </span>Update Border and text colour (hex):</li>
<li id=recform><input type="text"  name="border_text" required value="<?php echo $result['border_text'];?>"/></li>
</ul>

<ul>
<li id=recipe><label for="h2h3_color"><span style="color:red;">* </span>Update H2 / H3 colour (hex):</li>
<li id=recform><input type="text"  name="h2h3_color" required value="<?php echo $result['h2h3_color'];?>" /></li>
</ul>

<hr />
<ul>
<li id=recipe><label for="page">Update Page Background:</li>
</ul>

<ul>
<li id=recform><input type="file"  name="page_background"/><span style="color:grey;"><i>(currently: <?php echo $pageback;?>)</i></span></li>
</ul>

<ul>
<li id=recipe><span style="color:red;"><b><i>OR enter hex value (replaces existing background image)</i></b></span></li>
</ul>

<ul>
<li id=recipe><label for="page">Update Page Background color:</li>
<li id=recform><input type="text"  name="page_color" value="<?php echo $result['page_color'];?>"/></li>
</ul>
<hr />

<ul>
<li id=recipe><label for="text bg">Update Text Background:</label></li>
</ul>

<ul>
<li id=recform><input type="file"  name="text_background" /><span style="color:grey;"><i>(currently: <?php echo $textback;?>)</i></span></li>
</ul>

<ul>
<li id=recipe><span style="color:red;"><b><i>OR enter hex value (replaces existing background image)</i></b></span></li>
</ul>

<ul>
<li id=recipe><label for="text bg">Update Text Background color:</li>
<li id=recform><input type="text"  name="textback_color" value="<?php echo $result['textback_color'];?>" /></li>
</ul>
<hr/>
<ul>
<li id=recipe><label for="form"><span style="color:red;">* </span>Update Rating Name:</li>
<li id=recform><textarea style="resize: none;" name="rating_name" required rows="2" cols="40" required><?php echo $result['rating_name'];?></textarea></li>
</ul>

<ul>
<li id=recipe><label for="Submit"><input type="submit" class="button" name="update-basic" value="Update Info" /></li>
</ul>

</div>



<div class=left>
<ul>
<li id=recipe><h4><label for="image">Update Main Image:</label></h4></li>
</ul>


<?php echo "<img src=\"/assets/images/reviews/".$mainimage."\"width=\"100\"/>";?>


<ul>
<li id=recipe><input type="file" name="main_image"></li>
</ul>

<ul>
<li id=recipe><h4><label for="form">Update Image Caption:</h4></li>
</ul>

<ul>
<li id=recipe><textarea style="resize: none;" name="main_caption" rows="2" cols="40" ><?php echo $result['main_caption'];?></textarea>
</li></ul>
<br>
<hr />

<ul>
<li id=recipe><label for="description"><h4><span style="color:red;">* </span>Brief Description:</label></h4><p class=info> This appears on search results</p></li>
</ul>

<ul>
<li id=recipe><textarea name="description" required rows="11" cols="53" required><?php echo $result['description'];?></textarea></li>
</ul>



</div>
</div>

</div>
</form>
<h4><a href="\admin\update_review.php?edit-review=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_review.php">Select a different review</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
</div>
<?php


exit();
?>
