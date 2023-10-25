<?php session_start();
 
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$backpath = "$path"."/assets/backgrounds/reviews";
$imgpath = "$path"."/assets/images/reviews";
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

if (!empty ($_FILES ["page_background"]["name"]) && !empty ($_POST ['page_color'])){
	echo"<br>you have selected both page background and colour, you must pick one or the other.";
	exit ();
}
if (empty ($_FILES ["page_background"]["name"]) && empty ($_POST ['page_color'])){
	echo"<br>you have selected neither a page background nor a colour, you must pick one or the other.";
	exit ();
}

if (!empty ($_FILES ["text_background"]["name"]) && !empty ($_POST ['textback_color'])){
	echo"<br>you have selected both textbox background and colour, you must pick one or the other.";
	exit ();
}
if (empty ($_FILES ["text_background"]["name"]) && empty ($_POST ['textback_color'])){
	echo"<br>you have selected neither a textbox background nor a colour, you must pick one or the other.";
	exit ();
}


//----------------MAIN IMAGE----------------

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

//----------------IMAGE 1----------------

if(!empty($_FILES["image1"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image1"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image1"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset($splitname);
$image = $_FILES['image1']['tmp_name'];  

//process image
require ($imgprocess);
$image1 = $newname;
}else{$image1="";}

//----------------IMAGE 2----------------

if(!empty($_FILES["image2"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image2"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image2"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname); 
$image = $_FILES['image2']['tmp_name']; 

//process image
require ($imgprocess);
$image2 = $newname;
}else{$image2="";}

//----------------IMAGE 3----------------

if(!empty($_FILES["image3"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image3"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image3"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);  
$image = $_FILES['image3']['tmp_name']; 

//process image
require ($imgprocess);
$image3 = $newname;
}else{$image3="";} 

//----------------IMAGE 4----------------

if(!empty($_FILES["image4"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image4"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image4"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);  
$image = $_FILES['image4']['tmp_name']; 

//process image
require ($imgprocess);
$image4 = $newname;
}else{$image4="";}
 
//----------------IMAGE 5----------------

if(!empty($_FILES["image5"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image5"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image5"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);  
$image = $_FILES['image5']['tmp_name']; 

//process image
require ($imgprocess);
$image5 = $newname;
}else{$image5="";}

//----------------IMAGE 6----------------

if(!empty($_FILES["image6"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image6"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image6"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);  
$image = $_FILES['image6']['tmp_name']; 

//process image
require ($imgprocess);
$image6 = $newname;
}else{$image6="";}

//----------------IMAGE 7----------------

  if(!empty($_FILES["image7"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image7"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image7"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);  
$image = $_FILES['image7']['tmp_name']; 

//process image
require ($imgprocess);
$image7 = $newname;
}else{$image7="";}

///----------------IMAGE 8----------------

if(!empty($_FILES["image8"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image8"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["image8"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $imgpath;
$imgName = reset ($splitname);  
$image = $_FILES['image8']['tmp_name']; 

//process image
require ($imgprocess);
$image8 = $newname;
}else{$image8="";} 

//optional fields

//main caption

if(!empty($_POST['main_caption'])) {
		$main_caption = $_POST['main_caption'];
	}else{$main_caption="";
}
           
//reviews segments

//4

if(!empty($_POST['heading4'])) {
		$heading4 = $_POST['heading4'];
	}else{$heading4="";
}
if(!empty($_POST['review4'])) {
		$review4 = $_POST['review4'];
	}else{$review4="";
}
if(!empty($_POST['rating4'])) {
		$rating4 = $_POST['rating4'];
	}else{$rating4="";
}
if(!empty($_POST['caption4'])) {
		$caption4 = $_POST['caption4'];
	}else{$caption4="";
}


//5

if(!empty($_POST['heading5'])) {
		$heading5 = $_POST['heading5'];
	}else{$heading5="";
}
if(!empty($_POST['review5'])) {
		$review5 = $_POST['review5'];
	}else{$review5="";
}
if(!empty($_POST['rating5'])) {
		$rating5 = $_POST['rating5'];
	}else{$rating5="";
}
if(!empty($_POST['caption5'])) {
		$caption5 = $_POST['caption5'];
	}else{$caption5="";
}


//6
if(!empty($_POST['heading6'])) {
		$heading6 = $_POST['heading6'];
	}else{$heading6="";
}
if(!empty($_POST['review6'])) {
		$review6 = $_POST['review6'];
	}else{$review6="";
}
if(!empty($_POST['rating6'])) {
		$rating6 = $_POST['rating6'];
	}else{$rating6="";
}
if(!empty($_POST['caption6'])) {
		$caption6 = $_POST['caption6'];
	}else{$caption6="";
}


//7
if(!empty($_POST['heading7'])) {
		$heading7 = $_POST['heading7'];
	}else{$heading7="";
}
if(!empty($_POST['review7'])) {
		$review7 = $_POST['review7'];
	}else{$review7="";
}
if(!empty($_POST['rating7'])) {
		$rating7 = $_POST['rating7'];
	}else{$rating7="";
}
if(!empty($_POST['caption7'])) {
		$caption7 = $_POST['caption7'];
	}else{$caption7="";
}



//8
if(!empty($_POST['heading8'])) {
		$heading8 = $_POST['heading8'];
	}else{$heading8="";
}
if(!empty($_POST['review8'])) {
		$review8 = $_POST['review8'];
	}else{$review8="";
}
if(!empty($_POST['rating8'])) {
		$rating8 = $_POST['rating8'];
	}else{$rating8="";
}
if(!empty($_POST['caption8'])) {
		$caption8 = $_POST['caption8'];
	}else{$caption8="";
}
/*text bgs/colours*/

if (!empty($_FILES["page_background"]["name"])){
	$fileName = basename($_FILES["page_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["page_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $backpath;
$imgName = reset ($splitname);  
$image = $_FILES['page_background']['tmp_name'];
 
require ($imgprocess);
$page_background = $newname;
echo "<br/>".$page_background;
}else{$page_background="";
}

if (!empty ($_POST ['page_color'])){
	$page_color = $_POST['page_color'];
	}else{$page_color="";
}

if (!empty($_FILES["text_background"]["name"])){
$fileName = basename($_FILES["text_background"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES["text_background"]["size"];
$fileName= preg_replace('[^A-Za-z0-9]','', $fileName);
$splitname= explode(".",$fileName);
$filepath= $backpath;
$imgName = reset ($splitname);  
$image = $_FILES['text_background']['tmp_name'];
 
require ($imgprocess);
$text_background = $newname;
}else{$text_background="";
}
if (!empty ($_POST ['textback_color'])){
	$textback_color = $_POST['textback_color'];
	}else{$textback_color="";
}
echo "<br/>".$page_background;
$stmt = $conn->prepare("INSERT into reviews (user_ID, border_text, h2h3_color, page_background, page_color, text_background, textback_color, title, slug,
						rating_name, main_image, main_caption, description, intro, summary, heading1, review1, rating1, image1, caption1,
						heading2, review2, rating2, image2, caption2, heading3, review3, rating3, image3, caption3,
						heading4, review4, rating4, image4, caption4,heading5, review5, rating5, image5, caption5,
						heading6, review6, rating6, image6, caption6,heading7, review7, rating7, image7, caption7,
						heading8, review8, rating8, image8, caption8
						)
						VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
						?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
						
  	$stmt->bind_param("issssssssssssssssssssssssssssssssssssssssssssssssssssss", $user_ID, $border_text, $h2h3_color, $page_background, $page_color, 
					$text_background, $textback_color, $title, $slug, $rating_name, $main_image, $main_caption, $description, $intro, $summary, $heading1, 
					 $review1, $rating1, $image1, $caption1, $heading2, $review2, $rating2, $image2, $caption2, $heading3, $review3, $rating3, $image3, 
					 $caption3, $heading4, $review4, $rating4, $image4, $caption4, $heading5, $review5, $rating5, $image5, $caption5, $heading6, $review6, 
					 $rating6, $image6, $caption6, $heading7, $review7, $rating7, $image7, $caption7, $heading8, $review8, $rating8, $image8, $caption8
					);
  	
  	//compulsary fields
  	
  	$user_ID = $_SESSION['ID'];
  	$border_text = $_POST['border_text'];
  	$h2h3_color = $_POST['h2h3_color'];
  	$title = $_POST['title'];
  	$slug = makeSlug($title);
	$rating_name = $_POST['rating_name'];
	$description = $_POST['description'];
	$intro = $_POST['intro'];
	$summary = $_POST['summary'];
	
	//content
	//1
	$heading1 = $_POST['heading1'];
	$review1 = $_POST['review1'];
	$rating1 = $_POST['rating1'];
	$caption1 = $_POST['caption1'];
	//2
	$heading2 = $_POST['heading2'];
	$review2 = $_POST['review2'];
	$rating2 = $_POST['rating2'];
	$caption2 = $_POST['caption2'];
	//3
	$heading3 = $_POST['heading3'];
	$review3 = $_POST['review3'];
	$rating3 = $_POST['rating3'];
	$caption3 = $_POST['caption3'];



if ($stmt->execute() === TRUE) {
					echo "<p>Review Added</p>";
					} else {
					echo "<p>Something was bound to go wrong</p>" . $conn->error;
					}  

/*enter index info*/
$time = $conn->prepare("SELECT timestamp, ID FROM reviews WHERE slug=? 
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
$article_type='review';
$url="/reviews/"."$slug";

echo "<br>".$live;
echo "<br>".$day;
echo "<br>".$month;
echo "<br>".$monthfull;

$article_index = $conn->prepare("INSERT INTO article_index (review_ID, article_type, date, time, time_24h, day, suffix, day_full, month, month_full, month_short, year, url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
$article_index->bind_param("sssssssssssss", $timestamp['ID'], $article_type, $date, $ttime, $htime, $broken['day'], $suffix, $day, $broken['month'], $monthfull, $month, $broken['year'], $url);					
if ($article_index->execute() === TRUE) {
					echo "<p>Index updated";
					} else {
					echo "<p>Error Updating Index" . $conn->error;
					}
?>	

 <p><a href="/admin/admin.php">Admin Home</a></p>
 <p><a href="/admin/reviewentry.php">Add another review</a></p>
