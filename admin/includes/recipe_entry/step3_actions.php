<?php
$recipe_ID=$_POST['recipe_ID'];
$step3_head=$_POST['step3_head'];
$step3_content=$_POST['step3_content'];
$stage=$_POST['stage'];
if ($stage==="6") {$stage="7";}
$stmt= $conn->prepare("UPDATE recipes SET step3_head=?, step3_content=?, stage=? where ID=?");
$stmt->bind_param("ssss", $step3_head, $step3_content, $stage, $recipe_ID);
if ($stmt->execute()){ if ($stage==="8"){$messager="Recipe step 3 updated";
										include ($reviewsubmit);										
										exit();
								}else{include ($summaryentry);
									exit();
						}}else{	$message= "Something went wrong.  I don't know what. 
						If the problem persists please <a href=\"/contactform.php\" target\"_blank\">let me know</a>";
						include($step3entry);
						exit();}
						
						
?>
