<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$imgprocess = "$path"."/admin/includes/imageprocess.php";


if (isset($_POST['update-basic'])) {

//SET VARIABLES
$post_id=$_POST['ID'];
$title=$_POST['title'];
$new_date=$_POST['new_date'];
$new_time=$_POST['new_time'];

//TITLE AND SLUG
if ($_POST['title'] != $_POST['oldtitle']) {
	$slug = makeslug($title);
}else{$slug=$_POST['oldslug'];}


//BLOGIMAGE:
if (!empty($_FILES["blog_image"]["name"])) {
	
$imgpath = "$path"."/assets/images/blog";	
$fileName = basename($_FILES["blog_image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["blog_image"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);
$image = $_FILES['blog_image']['tmp_name'];
$oldimage=$_POST['oldimage'];

require ($imgprocess);
if (file_exists("$imgpath"."/"."$oldimage")){unlink("$imgpath"."/"."$oldimage");}
$blog_image = $newname;
}

if (empty($_FILES["blog_image"]["name"])){
$blog_image=$_POST['oldimage'];
}
	


//////SET NEW DATETIME
//if new date filled out
if (!empty ($new_date)) {
	$newdate=$new_date;
}else{$newdate = str_replace('/', '-', $_POST['olddate']);
}
//if new time filled out
if (!empty($new_time)) {
	$newtime=$new_time;
}else{$newtime=$_POST['oldtime'];
}
//set data for article index
$datetime= $newdate." ".$newtime;
$new_datetime = DateTime::createFromFormat ("Y-m-d H:i", $datetime);
$date = $new_datetime->format('d/m/y');
$htime = $new_datetime->format('H:i');
$ttime = $new_datetime->format('g:ia');
$day = date("l", strtotime($datetime));
$monthfull =date("F", strtotime($datetime));
$month =date("M", strtotime($datetime));
$broken=date_parse($datetime);

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
//update blog table
$ID= $_POST['ID'];
$stmt=$conn->prepare("UPDATE blog SET title=?,  blog_image=?, slug=? WHERE ID=?");
$stmt->bind_param("ssss", $title, $blog_image, $slug, $ID);
$stmt->execute();

//update article index
$url="/blog/"."$slug";
$stmt= $conn->prepare("UPDATE article_index SET url=?, date=?, time=?, time_24h=?, day=?, suffix=?, day_full=?, 
						month=?, month_full=?, month_short=?, year=?, lastupdated=now() WHERE blog_ID=?");
$stmt->bind_param("ssssssssssss", $url, $date, $ttime, $htime, $sday, $suffix, $day, $broken['month'], $monthfull, $month, $broken['year'], $ID);

if ($stmt->execute()=== TRUE) {
					$updated="<h2><span style=\"color:red;\">Blog Updated</span></h2>";
					include ($editpost);
					} else {
					echo "<h2><span style=\"color:red;\">Something Went Wrong</span></h2>
					</h3>Find another recipe to try again.</h3>" . $conn->error;
					}
}
?>

