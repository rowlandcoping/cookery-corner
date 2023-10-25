<?php

$stmt=$conn->prepare("SELECT ID, title, blog_image, slug FROM blog WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();
$stmt=$conn->prepare("SELECT year, month, day, date, time_24h FROM article_index WHERE blog_ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result2 = $array->fetch_assoc();

$image = $result['blog_image'];
$slug = $result['slug'];
$date= $result2['year']."-".$result2['month']."-".$result2['day'];
$time= $result2['time_24h'];

?>
<form action="/admin/update_blog.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $image;?>" readonly/>
<input type="hidden" name="oldtitle" value="<?php echo $result['title'];?>" readonly/>
<input type="hidden" name="oldslug" value="<?php echo $slug;?>" readonly/>
<input type="hidden" name="olddate" value="<?php echo $date;?>" readonly/>
<input type="hidden" name="oldtime" value="<?php echo $time;?>" readonly/>

<div class=container>
<div class=section1>

<h2>Update Blog Post</h2>


<div class=section>
<div class=left>

<ul>
<li id=recipe><label for="form"><span style="color:red;">* </span>Update Title:</li>
</ul>

<ul>
<li id=recipe><textarea style="resize: none;" name="title" required rows="1" cols="60" required><?php echo $result['title'];?></textarea></li>
</ul>

<hr />

<ul>
<li id=recipe>Current Date of Post:</li>
<h4><li id=recipe><?php echo "&nbsp&nbsp".$result2['date'];?></li></h4>
</ul>


<ul>
<li><label for="new_date">Alter Date: </li>
<li id=recform><input id="new_date" type="date"  name="new_date" /></li>
</ul>
<hr>
<ul>
<p><li id=recipe>Current Time of Post:</li></p>
<h4><li id=recipe><?php echo "&nbsp&nbsp".$time;?></li></h4>
</ul>


<ul>
<li><label for="new_date">Alter Date: </li>
<li id=recform><input type="time"  name="new_time" /></li>
</ul>

</div>



<div class=left>
<ul>
<li id=recipe><h4><label for="image">Update Blog Image:</label></h4></li>
</ul>


<?php echo "<img class=\"segment\" src=\"/assets/images/blog/".$image."\"width=\"100\"/>";?>


<ul>
<li id=recipe><input type="file" name="blog_image"></li>
</ul>

</div>

</div>
<label for="Submit"><input type="submit" class="button" name="update-basic" value="Update Info" />

</div>
</form>
<h4><a href="\admin\update_blog.php?edit-blog=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_blog.php">Select a different blog post</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
</div>
<?php


exit();
?>
