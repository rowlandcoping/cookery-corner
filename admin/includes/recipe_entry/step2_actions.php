<?php
$recipe_ID=$_POST['recipe_ID'];
$step2_head=$_POST['step2_head'];
$step2_content=$_POST['step2_content'];
$stage=$_POST['stage'];
if ($stage==="5") {$stage="6";}
$stmt= $conn->prepare("UPDATE recipes SET step2_head=?, step2_content=?, stage=? where ID=?");
$stmt->bind_param("ssss", $step2_head, $step2_content, $stage, $recipe_ID);
if ($stmt->execute()){ if ($stage==="8"){$messager="Recipe step 2 updated";
										include ($reviewsubmit);										
										exit();
								}else{include ($step3entry);
									exit();
						}}else{	$message= "Something went wrong.  I don't know what. 
						If the problem persists please <a href=\"/contactform.php\" target\"_blank\">let me know</a>";
						include($step2entry);
						exit();}
						
						
?>
