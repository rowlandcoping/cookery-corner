<?php
$stage=$_POST['stage'];
$recipe_ID=$_POST['recipe_ID'];
$intro=$_POST['intro'];
if ($stage==="3") {$stage="4";}
$stmt= $conn->prepare("UPDATE recipes SET intro=?, stage=? where ID=?");
$stmt->bind_param("sss", $intro, $stage, $recipe_ID);
if ($stmt->execute()){ if ($stage==="8"){$messager="Introduction Updated";
										include ($reviewsubmit);										
										exit();
								}else{include ($step1entry);
									exit();
						}}else{	$message= "Something went wrong.  I don't know what. 
						If the problem persists please <a href=\"/contactform.php\" target\"_blank\">let me know</a>";
						include($introentry);
						exit();}						
?>
