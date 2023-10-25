<?php

$ID=$_POST['ID'];
$oldimage=$_POST['oldimage'];

$stmt=$conn->prepare ("DELETE FROM live_blog WHERE ID=?");
$stmt->bind_param ("i", $ID);
if (file_exists("$blogpath"."/"."$oldimage")){unlink("$blogpath"."/"."$oldimage");}

if ($stmt->execute()=== TRUE) {
					$post_id= $_POST['liveblog_ID'];
					$updated="<h2><span style=\"color:red;\">Live blog entry Deleted</span></h2>";
					include ($contentupdate);
					} else {
					include ($contentupdate);
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another live blog to try again.</h3>" . $conn->error;
					}
?>
