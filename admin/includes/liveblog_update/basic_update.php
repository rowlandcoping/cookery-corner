<?php

$stmt=$conn->prepare("SELECT ID, body_background, body_color, blog_background, blog_color, textarea_background, textarea_color, 
					bgtype, text_color, hover_color, h_color, links_color, title, main_image, slug, intro, keywords FROM liveblog WHERE ID=?");
$stmt ->bind_param("s", $post_id);
$stmt ->execute();
$array = $stmt ->get_result();
$result = $array->fetch_assoc();


$mainimage = $result['main_image'];
$bodyback = $result['body_background'];
$blogback = $result['blog_background'];
$textback = $result['textarea_background'];
$slug=$result['slug'];

?>
<form action="/admin/update_liveblog.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="ID" size="1" value="<?php echo $post_id;?>" readonly/>
<input type="hidden" name="oldtitle" value="<?php echo $result['title'];?>" readonly/>
<input type="hidden" name="oldslug" value="<?php echo $slug;?>" readonly/>
<input type="hidden" name="oldimage" value="<?php echo $mainimage;?>" readonly/>
<input type="hidden" name="oldbodyback" value="<?php echo $bodyback;?>" readonly/>
<input type="hidden" name="oldblogback" value="<?php echo $blogback;?>" readonly/>
<input type="hidden" name="oldtextback" value="<?php echo $textback;?>" readonly/>

<div class=container>
<div class=section1>

<h2>Update <?php echo "<a href =\"/liveblog/".$result['slug']."\" target=\"_blank\">".$result['title']."</a>";?></h2>


<div class=section>
<div class=left>

<ul>
<li id=recipe><label for="page">Update Page Background Image:</li>
</ul>

<ul>
<li id=recform><input type="file"  name="body_background"/><span style="color:grey;"><i>(currently: <?php echo $bodyback;?>)</i></span></li>
</ul>

<ul>
<li id=recipe><span style="color:red;"><b><i>OR enter hex value (replaces existing file)</i></b></span></li>
</ul>

<ul>
<li id=recipe><label for="page">Update Page Background color:</li>
<li id=recform><input type="text"  name="body_color" value="<?php echo $result['body_color'];?>"/></li>
</ul>
<hr />

<ul>
<li id=recipe><label for="text bg">Update background image for content:</label></li>
</ul>

<ul>
<li id=recform><input type="file"  name="blog_background" /><span style="color:grey;"><i>(currently: <?php echo $blogback;?>)</i></span></li>
</ul>

<ul>
<li id=recipe><span style="color:red;"><b><i>OR enter hex value (replaces existing file)</i></b></span></li>
</ul>

<ul>
<li id=recipe><label for="blog_color">Update background colour for content:</li>
<li id=recform><input type="text"  name="blog_color" value="<?php echo $result['blog_color'];?>" /></li>
</ul>

<hr />

<ul>
<li id=recipe><label for="text bg">Update Text Background image:</label></li>
</ul>

<ul>
<li id=recform><input type="file"  name="textarea_background" /><span style="color:grey;"><i>(currently: <?php echo $textback;?>)</i></span></li>
</ul>
<ul<li id=recipe>Background type: </li></ul>
<ul<li id=recipe><label for="cover"><input type="radio" name="bgtype" value="cover" <?php if ($result['bgtype']=="cover") {echo "checked=\"checked\"";}?>>cover</label></li></ul>
<ul<li id=recipe><label for="tile"><input type="radio" name="bgtype" value="tile" <?php if ($result['bgtype']=="tile") {echo "checked=\"checked\"";}?>>tile</label></li></ul>
<ul>
<li id=recipe><span style="color:red;"><b><i>OR enter hex value (replaces existing file)</i></b></span></li>
</ul>

<ul>
<li id=recipe><label for="textarea_color">Update Text Background color:</li>
<li id=recform><input type="text"  name="textarea_color" value="<?php echo $result['textarea_color'];?>" /></li>
</ul>



<hr />

<ul><li id=recipe><label for="text_color">Main text colour (hex): </li>
<li id=recform><input type="text"  name="text_color" required value="<?php echo $result['text_color'];?>" /></label></li></ul>

<ul><li id=recipe><label for="h_color">Headline Color: </li>
<li id=recform><input type="text"  name="h_color" required value="<?php echo $result['h_color'];?>" /></label></li></ul>

<ul><li id=recipe><label for="links_color">Link colour: </li>
<li id=recform><input type="text"  name="links_color" required value="<?php echo $result['links_color'];?>"/></label></li></ul>

<ul><li id=recipe><label for="hover_color">Hover colour (hex): </li>
<li id=recform><input type="text"  name="hover_color"required value="<?php echo $result['hover_color'];?>" /></label></li></ul>

<hr/>


</div>


<div class=left>

<ul>
<li id=recipe><label for="form"><span style="color:red;">* </span>Update Title:</li>
<li id=recform><textarea style="resize: none;" name="title" required rows="1" cols="40" required><?php echo $result['title'];?></textarea></li>
</ul>

<hr />	
	
<ul>
<li id=recipe><h4><label for="image">Update Main Image:</label></h4></li>
</ul>


<?php echo "<img src=\"/assets/images/liveblog/".$mainimage."\"width=\"100\"/>";?>


<ul>
<li id=recipe><input type="file" name="main_image"></li>
</ul>


<hr />
<ul><li id=recipe><label for="keywords">Keywords: </li></label>
<li id=recform><input type="text"  name="keywords" value="<?php echo $result['keywords']?>" /></label></li></ul>
<hr />
<ul><li id=recipe><label for="intro">Intro text:</label></li></ul></label>
<ul><li id=recform><textarea name="intro" rows="10" cols="60"><?php echo $result['intro']?></textarea></label></li></ul>


<label for="Submit"><input type="submit" class="button" name="update-basic" value="Update Info" />



</div>




</div>

</div>
</form>
<h4><a href="\admin\update_liveblog.php?edit-liveblog=<?php echo $post_id;?>">Update a different section</a>
<br><a href="\admin\update_liveblog.php">Select a different live blog</a>
<br><a href="\admin\admin.php">Return to Profile</a></h4>

<h4><a href="/index.php">Go back to the homepage</a>
<br /><a href="/logout">Log out</a></h4>
</div>
<?php


exit();
?>
