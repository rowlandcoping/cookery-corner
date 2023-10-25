<?php session_start();
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$backpath = "$path"."/assets/backgrounds/liveblog";
$imgpath = "$path"."/assets/images/liveblog";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
require_once($config);



//create slug function

function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

/*alternate page formatting rules

if (!empty ($_FILES ['body_background']) && !empty ($_POST ['body_color'])){
	echo"<br>you have selected both page background and colour, you must pick one or the other.";
	exit ();
}
if (empty ($_FILES ['body_background']) && empty ($_POST ['body_color'])){
	echo"<br>you have selected neither a page background nor a colour, you must pick one or the other.";
	exit ();
}

if (!empty ($_FILES ['blog_background']) && !empty ($_POST ['blog_color'])){
	echo"<br>you have selected both textbox background and colour, you must pick one or the other.";
	exit ();
}
if (empty ($_FILES ['blog_background']) && empty ($_POST ['blog_color'])){
	echo"<br>you have selected neither a textbox background nor a colour, you must pick one or the other.";
	exit ();
}

if (!empty ($_FILES ['textarea_background']) && !empty ($_POST ['textarea_color'])){
	echo"<br>you have selected both textbox background and colour, you must pick one or the other.";
	exit ();
}
if (empty ($_FILES ['textarea_background']) && empty ($_POST ['textarea_color'])){
	echo"<br>you have selected neither a textbox background nor a colour, you must pick one or the other.";
	exit ();
}
*/

///sanitise main image

if(!empty($_FILES["main_image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["main_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["main_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['main_image']['tmp_name']; 

require ($imgprocess);
$main_image = $newname;
}else{$main_image="";} 


//////text bgs/colours////////

//body background

if (!empty($_FILES["body_background"]["name"])){
	$fileName = basename($_FILES["body_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["body_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $backpath;
$imgName = reset ($splitname);  
$image = $_FILES['body_background']['tmp_name'];
 
require ($imgprocess);
$body_background = $newname;
$body_color="";
}

if (!empty ($_POST ['body_color'])){
	$body_color = $_POST['body_color'];
	$body_background = "";
}

//blog background

if (!empty($_FILES["blog_background"]["name"])){
$fileName = basename($_FILES["blog_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["blog_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $backpath;
$imgName = reset ($splitname);  
$image = $_FILES['blog_background']['tmp_name'];
 
require ($imgprocess);
$blog_background = $newname;
$blog_color="";
}

if (!empty ($_POST ['blog_color'])){
	$blog_color = $_POST['blog_color'];
	$blog_background = "";
}

//text background

if (!empty($_FILES["textarea_background"]["name"])){
$fileName = basename($_FILES["textarea_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["textarea_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $backpath;
$imgName = reset ($splitname);  
$image = $_FILES['textarea_background']['tmp_name'];
 
require ($imgprocess);
$textarea_background = $newname;
$textarea_color="";
}

if (!empty ($_POST ['textarea_color'])){
	$textarea_color = $_POST['textarea_color'];
	$textarea_background = "";
}





$stmt = $conn->prepare("INSERT into liveblog (user_ID, body_background, body_color, blog_background, blog_color, textarea_background, textarea_color, bgtype,
						text_color, hover_color, h_color, links_color, title, main_image, slug, intro, keywords
						)
						VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
						
  	$stmt->bind_param("issssssssssssssss", $user_ID, $body_background, $body_color, $blog_background, $blog_color, $textarea_background, $textarea_color, $bgtype,
						$text_color, $hover_color, $h_color, $links_color, $title, $main_image, $slug, $intro, $keywords
					);
  	
  	//compulsary fields
  	
  	
  	$user_ID = $_SESSION['ID'];
  	$text_color = $_POST['text_color']; 
  	$hover_color = $_POST['hover_color']; 
  	$h_color = $_POST['h_color']; 
  	$keywords = $_POST['keywords'];
  	$title = $_POST['title'];
  	$slug = makeSlug($title);	
	$intro = $_POST['intro'];
	$bgtype = $_POST['bgtype'];
	$links_color= $_POST['links_color'];


if ($stmt->execute() === TRUE) {
					echo "<p>Live Blog set up</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}

/*enter index info*/
$time = $conn->prepare("SELECT timestamp, ID FROM liveblog WHERE slug=? 
					LIMIT 1");
$time->bind_param("s", $slug);
$time->execute();
$timeres=$time->get_result();
$timestamp = $timeres->fetch_assoc();				
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $timestamp['timestamp'] );
$date = $new_date->format('d/m/y');
$htime = $new_date->format('H:i');
$ttime = $new_date->format('g:ia');


echo"<br>".$htime;
echo"<br>".$ttime;
echo "<br>".$date;

$nextlevel = $timestamp['timestamp'];
$broken=date_parse($nextlevel);
echo "<br>".$broken['year'];
echo "<br>".$broken['month'];
echo "<br>".$broken['day'];

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
$month =date('M', $timestampday);
$article_type='liveblog';
$live='1';

echo "<br>".$day;
echo "<br>".$month;
echo "<br>".$monthfull;

$url="/liveblog/"."$slug";

$article_index = $conn->prepare("INSERT INTO article_index (live, liveblog_ID, article_type, date, time, time_24h, day, suffix, day_full, month, month_full, month_short, year, url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$article_index->bind_param("iissssississis", $live, $timestamp['ID'], $article_type, $date, $ttime, $htime, $broken['day'], $suffix, $day, $broken['month'], $monthfull, $month, $broken['year'], $url);					
if ($article_index->execute() === TRUE) {
					echo "<p>Index updated";
					} else {
					echo "<p>Error Updating Index" . $conn->error;
					}
?>	

 <p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/liveblog_entry.php">Add another live blog</a></p>
