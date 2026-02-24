<?php

//maybe use this everywhere

$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$return="$path"."/contactform.php";

require_once($config);
require($path . "/mailconfig.php");

$type='5';
$admin='1';
$honey=$_POST['email'];
$message=$_POST['message'];
$name = $_POST['name'];
if (!empty($_POST['realone'])) {$email=$_POST['realone'];
}else{$email="";}
$subject=$_POST['subject'];

//////////ANTI SPAM CHECKBOX CODE/////////
/* 
$option1=$_POST['option1'];
$option2=$_POST['option2'];
$option3=$_POST['option3'];
*/


if (!empty($honey)){
	$messaging= "Your response indicates you are a malevolent force.
	<br/>This is the end.
	<p><a href=\"/index.php\">Home</a>
	<br><a href=\"/contactform.php\">Try again</a></p>";
	exit();
}

//////////ANTI SPAM CHECKBOX CODE/////////
/*
if (!empty($option1)){
	echo "Your response indicates you are a malevolent force.
	<br/>This is the end.
	<p><a href=\"/index.php\">Home</a>
	<br><a href=\"/contactform.php\">Try again</a></p>";
	exit();
}

if (!empty($option2)){
	echo "Your response indicates that you are not sound of mind.
	<br/>This is the end.
	<p><a href=\"/index.php\">Home</a>
	<br><a href=\"/contactform.php\">Try again</a></p>";
	exit();
}

if(empty($option3)){
	echo "You need to prove you are neither machine nor lunatic by checking the right box.
	<br/>This is the end.
	<p><a href=\"/index.php\">Home</a>
	<br><a href=\"/contactform.php\">Try again</a></p>";
	exit();
}
*/


$check_query = $conn->prepare("SELECT message FROM general_contact WHERE message=?");
$check_query->bind_param("s", $message);
$check_query ->execute();				
$contchk = $check_query ->get_result();
$something = $contchk->fetch_assoc();


if (!empty($something['message'])) {
				$messaging="<p>Message not submitted<br />
				You have already submitted this message";
				include($return);
				exit();
				}	
if (empty($message)) { $messaging="<p>Message not submitted</p>
							<p>You have not entered a message.</p>";
							include($return);
							exit();}
/*
if (empty($email)) { echo "<p>Message not submitted</p>
							<p>You have not provided an e-mail address</p>
							<p><a href=\"/index.php\">Home</a>
							<br><a href=\"/contactform.php\">Try again</a></p>";
							exit();}
		
		if (!preg_match('#^[a-zA-Z0-9_\-\.]+@[a-zA-z0-9\-]+\.[a-zA-Z0-9\-\.]+$#i', $email)) {
					echo "<p>Message not submitted</p>
							<p>You must enter a valid e-mail address</p>
							<p><a href=\"/index.php\">Home</a>
							<br><a href=\"/contactform.php\">Try again</a></p>";
							exit();
		}
*/
$stmt = $conn->prepare("INSERT into general_contact (name, subject, email, message) VALUES (?,?,?,?)");
  $stmt->bind_param("ssss", $name, $subject, $email, $message);
  $stmt->execute();



$mailbody="<p>You have received the following message from<br /> ".$name." at ".$email.":</p>".$message;
$stmt= $conn->prepare("INSERT INTO notifications (user, title, subject, message, type, admin) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $name, $email, $subject, $mailbody, $type, $admin);
$stmt->execute();

try {
    $mail = createMailer();
    $mail->addAddress(getenv('MAIL_ADMIN'));
    $mail->setFrom($email, $name);
    $mail->Subject = $subject;
    $mail->Body    = $mailbody;
    $mail->send();
} catch (Exception $e) {
    error_log("Mailer error: " . $mail->ErrorInfo);
}

$successmess="Message Submitted <br /> Thank you for your interaction, it's always a thrill!";
include($return);
exit();


?>
