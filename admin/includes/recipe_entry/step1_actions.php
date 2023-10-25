<?php
$stage=$_POST['stage'];
$recipe_ID=$_POST['recipe_ID'];
$step1_head=$_POST['step1_head'];
$step1_content=$_POST['step1_content'];
if ($stage==="4") {$stage="5";}
$stmt= $conn->prepare("UPDATE recipes SET step1_head=?, step1_content=?, stage=? where ID=?");
$stmt->bind_param("ssss", $step1_head, $step1_content, $stage, $recipe_ID);
if ($stmt->execute()){ if ($stage==="8"){$messager="Recipe step 1 updated";
										include ($reviewsubmit);										
										exit();
								}else{include ($step2entry);
									exit();
						}}else{	$message= "Something went wrong.  I don't know what. 
						If the problem persists please <a href=\"/contactform.php\" target\"_blank\">let me know</a>";
						include($step1entry);
						exit();}
						
						
?>
