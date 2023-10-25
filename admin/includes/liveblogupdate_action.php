<?php if(!isset($_SESSION)){session_start();}
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'];
$head= "$path"."/admin/includes/head_admin.php";
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/liveblog";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
$return = "$path"."/admin/liveblog_update.php";

require ($config);

$content=$_POST['content'];
$title = $_POST['title'];
$time="";
$format=$_POST['format'];
$link=$_POST['link'];


$check_query = $conn->prepare("SELECT content FROM live_blog WHERE content=?");
$check_query->bind_param("s", $content);
$check_query ->execute();				
$contchk = $check_query ->get_result();
$something = $contchk->fetch_assoc();


if (!empty($something['content'])) {
				$error= "<p>You have FAILED.</p>
				<p>You have already submitted this entry, please stop using the refresh button already.</p>";
				include($return);			
				exit();
				}

if (empty($title)) {  echo "<p>You have FAILED.</p>
							<p>select which liveblog you wish to update otherwise it will not be updated.  Obvs.</p>							
							<p><a href=\"/liveblog.php\">Back to the FUN!</a>
							<br><a href=\"/admin/liveblog_update.php\">Again, Again</a></p>";
							exit();}
		
if (empty($content)) { echo "<p>You have FAILED.</p>
							<p>Content is king.  Pull it together.</p>
							
							<p><a href=\"/liveblog.php\">Back to the FUN!</a>
							<br><a href=\"/admin/liveblog_update.php\">Again, Again</a></p>";
							exit();}

if (!empty($_POST['link'])) { 
	
	$link=$_POST['link'];
	if (file_exists("$imgpath"."/"."$link")) {$image=$link;}else{$error = "The image you have specified does not exist.  Please try again."; include($return); exit();}}


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
} else { if (!empty ($link)) {$image=$link;}else{$image="";}}


$liveID = $conn->prepare("SELECT ID from liveblog WHERE title=?");
$liveID->bind_param("s", $title);
$liveID->execute();
$IDres=$liveID->get_result();
$resulting = $IDres->fetch_assoc();
$ID=$resulting['ID'];

$stmt = $conn->prepare("INSERT INTO live_blog (liveblog_ID, content, image, time) VALUES (?,?,?,?)");

$stmt->bind_param("ssss", $ID, $content, $image, $time);

$stmt->execute(); 
					


$time = $conn->prepare("SELECT timestamp, ID FROM live_blog WHERE content=?
								 LIMIT 1");
$time->bind_param("s", $content);
$time->execute();
$timeres=$time->get_result();
$timestamp = $timeres->fetch_assoc();				
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $timestamp['timestamp'] );
$date = $new_date->format('d/m/y');
$htime = $new_date->format('H:i');
$ttime = $new_date->format('g:ia');
$updateID= $timestamp['ID'];

$nextlevel = $timestamp['timestamp'];
$broken=date_parse($nextlevel);
if ($broken['day']=="1, 21, 31") {
	$suffix="st";
}else { if ($broken['day']=="2, 22") {
	$suffix="nd";
}else {if ($broken['day']=="3, 23") {
	$suffix="rd";
}else{$suffix="th";}
}
}

$timestampday = strtotime($timestamp['timestamp']);
$day = date('l', $timestampday);
$monthfull =date('F', $timestampday);


if ($_POST['format']=="time"){$time=$htime;}else{$time=
	
	($day." ".$broken['day'].$suffix." ".$monthfull."<br>".$htime);}

$update = "UPDATE live_blog SET time='$time' WHERE ID='$updateID'";


if ($conn->query($update) === TRUE) {
  $winner= "<p>Congratulations, you have just achieved a thing.";
  include($return); exit();	} else {
					$error= "<p>You have failed, sad times.<br>Not sure how you managed it really. Did you copy and paste weird special characters in or something?
							<br>Was your name enormous?  Did you write more than two and a half thousand words?  I'm all out of ideas now.";
					include($return); exit();
					}


?>


 <p><a href="/liveblog.php">Back to the FUN!</a>
 <br><a href="/admin/liveblog_update.php">Again, Again</a></p>





