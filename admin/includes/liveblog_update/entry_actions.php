<?php

if (isset($_POST['update-entry'])) {

// set variables
$time=$_POST['time'];
$content= $_POST['content'];
$post_id=$_POST['ID'];
$liveblog_ID=$_POST['liveblog_ID'];

//IMAGE:
if (!empty($_FILES["image"]["name"])) {
	
$imgpath = "$path"."/assets/images/liveblog";	
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['image']['tmp_name'];
$oldimage=$_POST['oldimage'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$image = $newname;
}

if (empty($_FILES["image"]["name"])){
$image=$_POST['oldimage'];
}




$stmt= $conn->prepare("UPDATE live_blog SET time=?, content=?, image=? WHERE ID=?");
$stmt->bind_param("ssss", $time, $content, $image, $post_id);
$stmt->execute();



//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE liveblog_ID=?");
$stmt->bind_param("s", $liveblog_ID);

if ($stmt->execute()=== TRUE) {
					$post_id= $liveblog_ID;
					$updated="<h2><span style=\"color:red;\">Live blog entry Updated</span></h2>";
					include ($contentupdate);
					} else {
						include ($contentupdate);
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another live blog to try again.</h3>" . $conn->error;
					}
}
?>
