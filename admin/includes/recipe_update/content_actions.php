<?php

if (isset($_POST['content'])) {
	
$ID=$_POST['ID'];
$intro = $_POST['intro'];
$step1_head = $_POST['step1_head'];
$step1_content = $_POST['step1_content'];
$step2_head = $_POST['step2_head'];
$step2_content = $_POST['step2_content'];
$step3_head = $_POST['step3_head'];
$step3_content = $_POST['step3_content'];
$conclusion = $_POST['conclusion'];

$stmt=$conn->prepare("UPDATE recipes SET intro=? ,step1_head=?, step1_content=?, step2_head=?, step2_content=?, 
					step3_head=?, step3_content=?, conclusion=? WHERE ID=?");
$stmt->bind_param("sssssssss", $intro, $step1_head, $step1_content, $step2_head, $step2_content, $step3_head, $step3_content, $conclusion, $ID);
$stmt->execute();


//update article index
$stmt= $conn->prepare("UPDATE article_index SET lastupdated=now() WHERE recipe_ID=?");
$stmt->bind_param("i", $ID);

if ($stmt->execute()===TRUE){
					$post_id=$ID;
					$updated="<h2><span style=\"color:red;\">Content Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}

}

?>
