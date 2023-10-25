<?php session_start();
// Connection details
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgpath = "$path"."/assets/images/blog";
$imgprocess = "$path"."/admin/includes/imageprocess.php";
require_once($config);


//put stuff in blog


function makeSlug(String $string){
	$string = strtolower($string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('-', ' ', $string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

if(!empty($_FILES["blog_image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["blog_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["blog_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['blog_image']['tmp_name']; 

require ($imgprocess);
$blog_image = $newname;
}else{$blog_image="";} 

 
 
 
 
  $stmt = $conn->prepare("INSERT into blog (user_ID, title, content, keywords, blog_image, slug) VALUES (?,?, ?, ?,?,?)");
  	$stmt->bind_param("isssss", $user_ID, $title, $content, $keywords, $blog_image, $slug);
  	$user_ID = $_SESSION['ID'];
  	$title = $_POST['title']; 
	$content = $_POST['content'];
	$keywords =$_POST['keywords']; 
	$slug = makeSlug($title);

if ($stmt->execute() === TRUE) {
					echo "<p>Blog updated";
					} else {
					echo "<p>Error Updating Blog" . $conn->error;
					}


					
$time = $conn->prepare("SELECT timestamp_created, ID FROM blog WHERE slug=? 
								 LIMIT 1");
$time->bind_param("s", $slug);
$time->execute();
$timeres=$time->get_result();
$timestamp = $timeres->fetch_assoc();				
$new_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $timestamp['timestamp_created'] );
$date = $new_date->format('d/m/y');
$htime = $new_date->format('H:i');
$ttime = $new_date->format('g:ia');


echo"<br>".$htime;
echo"<br>".$ttime;
echo "<br>".$date;


$nextlevel = $timestamp['timestamp_created'];
$broken=date_parse($nextlevel);
echo "<br>".$broken['year'];
echo "<br>".$broken['month'];
echo "<br>".$broken['day'];

$sday= $broken['day'];

if ($sday=="1" || $sday=="21"||$sday=="31") {
	$suffix="st";
}else { if ($sday=="2"|| $sday=="22") {
	$suffix="nd";
}else {if ($sday=="3"|| $sday=="23") {
	$suffix="rd";
}else{$suffix="th";}
}
}	

$timestampday = strtotime($timestamp['timestamp_created']);
$day = date('l', $timestampday);
$monthfull =date('F', $timestampday);
$month =date('M', $timestampday);
$article_type="blog";
$live="1";
$url="/blog/"."$slug";

$blog_index = $conn->prepare("INSERT INTO article_index (live, blog_ID, article_type, date, time, time_24h, day, suffix, day_full, 
							month, month_full, month_short, year, url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$blog_index->bind_param("iissssississis", $live, $timestamp['ID'], $article_type, $date, $ttime, $htime, $broken['day'], $suffix, 
						$day, $broken['month'], $monthfull, $month, $broken['year'], $url);					
if ($blog_index->execute() === TRUE) {
					echo "<p>Blog Index updated";
					} else {
					echo "<p>Error Updating Blog Index" . $conn->error;
					}
?>
<p><a href="/admin/admin.php">Admin Home</a>
<br><a href="/admin/blogentry.php">Enter another entry</a></p>
