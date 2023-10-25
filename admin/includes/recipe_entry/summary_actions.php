<?php
$recipe_ID=$_POST['recipe_ID'];
$summary=$_POST['summary'];
$stage=$_POST['stage'];
if ($stage==="7") {$stage="8";}
$stmt= $conn->prepare("UPDATE recipes SET conclusion=?, stage=? where ID=?");
$stmt->bind_param("sss", $summary, $stage, $recipe_ID);
if ($stmt->execute()){ if ($stage==="8"){$messager="Summary updated";
										include ($reviewsubmit);										
										exit();
								}else{include ($reviewsubmit);
									exit();
						}}else{	$message= "Something went wrong.  I don't know what. 
						If the problem persists please <a href=\"/contactform.php\" target\"_blank\">let me know</a>";
						include($summaryentry);
						exit();}
						
						
?>
