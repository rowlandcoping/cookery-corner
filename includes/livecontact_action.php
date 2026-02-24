<?php

//maybe use this everywhere

$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/liveblog";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
$return = "$path"."/livecontact.php";

require_once($config);
require($path . "/mailconfig.php");

$honey=$_POST['email'];
if (!empty($honey)){
	echo "Your response indicates you are a malevolent force.
	<br/>This is the end.
	<p><a href=\"/index.php\">Home</a>
	<br><a href=\"/livecontact.php\">Try again</a></p>";
	exit();
}



/*

				
if (empty($name)) {  echo "<p>You have FAILED.</p>
							<p>You must provide an identity, even if it is not your true identity....
							<br>Batman, is that you?</p>							
							<p><a href=\"/liveblog.php\">Back to the FUN!</a>
							<br><a href=\"/livecontact.php\">Again, Again</a></p>";
							exit();}
		
		
if (empty($content)) { echo "<p>You have FAILED.</p>
							<p></p>Strong silent type, eh?  I love the intrigue, but there's not much point submitting the form without anything in it.
							<br>That said I do write the best error messages, am I right?</p>
							
							<p><a href=\"/liveblog.php\">Back to the FUN!</a>
							<br><a href=\"/livecontact.php\">Again, Again</a></p>";
							exit();}
							
*/
if(!empty($_FILES["image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['image']['tmp_name'];
require ($imgprocess);
$image = $newname;
}else{$image="";}

$content=$_POST['content'];
$name = $_POST['name'];
if (!empty ($_POST['origin'])) {$origin=$_POST['origin'];}else{$origin="";};
$slug= $_POST['slug'];

$check_query = $conn->prepare("SELECT content FROM liveblog_contact WHERE content=?");
$check_query->bind_param("s", $content);
$check_query ->execute();				
$contchk = $check_query ->get_result();
$something = $contchk->fetch_assoc();

if (!empty($something['content'])) {
				$error= "<p>You have FAILED.</p>
				<p>You have already submitted this entry, please stop using the back button already.</p>";
				include($return);
				exit();
				}
				
$stmt = $conn->prepare("INSERT into liveblog_contact (origin, name, content, image) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $origin, $name, $content, $image);
$stmt->execute();

$type='5';
$admin='1';
$subject="Live Blog Contact";
if (!empty($image)) {$imgtext="<p>Image link: <a href=\"/assets/images/liveblog/".$image."\" target=\"_blank\">".$image."</a></p>";}else{$imgtext="";}
$mailbody="<p>You have received the Liveblog contribution from ".$name.":</p><p>".$content."</p>".$imgtext;
$stmt= $conn->prepare("INSERT INTO notifications (user, slug, title, subject, message, type, admin) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $name, $slug, $origin, $subject, $mailbody, $type, $admin);
$stmt->execute();

try {
    $mail = createMailer();
    $mail->addAddress(getenv('MAIL_ADMIN'));
    $mail->Subject = $subject;
    $mail->Body    = $mailbody;
    $mail->send();
} catch (Exception $e) {
    error_log("Mailer error: " . $mail->ErrorInfo);
}

$winner= "Congratulations, you have just achieved a thing.";
include($return);
exit();
?>				
					
