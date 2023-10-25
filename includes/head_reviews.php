<head>
	
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

<?php
if (isset($_GET['post-slug'])) {
	$post = getPost($_GET['post-slug']);
	$baseurl="https://cookery-corner.co.uk/reviews/";
	echo "<link rel=\"canonical\" href=\"".$baseurl.$post['slug']."\"/>";
	}else{
	echo "<link rel=\"canonical\" href=\"https://cookery-corner.co.uk/reviews.php\"/>";
}
?>

<title>Cookery Corner - Random Reviews
<?php
if (!empty($post['title'])) {echo " - ". $post ['title'];}
?></title>
<link rel="stylesheet" type="text/css" href="/styles/css/universal.css" />
<link rel="stylesheet" type="text/css" href="/styles/css/reviews.css" />
<style type="text/css">
<?php
if(!empty($post['title'])) {

echo"


body
{";
if (!empty ($post['page_background'])) {echo "background-image: url(/assets/backgrounds/reviews/".$post['page_background'].")";}
else {echo "background-color: ".$post['page_color'];}

echo ";
color:".$post['border_text'].";>
}

div.reviewbox
{";
if (!empty ($post['text_background'])) {echo "background-image: url(/assets/backgrounds/reviews/".$post['text_background'].")";}
else {echo "background-color: ".$post['textback_color'];}
echo"
;
border-color:".$post['border_text'].";
}

div.title
{";
if ($post['title'] =="Useless Present Review" || $post['title']=="Present Review Feedback"){
echo "background-image: url(/assets/backgrounds/snow.bmp)";}

echo"
}
h2, h3
{
color: ".$post['h2h3_color'].";
}

div.reviewbox a
{
text-decoration: none;
color:".$post['h2h3_color'].";
}

div.reviewbox a:hover
{
text-decoration: none;
color:".$post['border_text'].";
}";


}else{echo "body{background-image: url(/assets/backgrounds/unicorn.jpeg);}";}
?>
</style>
</head>

<body>


<div class="title">
<div class="title_bann">
	
<?php
if (!empty ($post['title'])) {

if ($post['title'] =="Useless Present Review" || $post['title']=="Present Review Feedback"){
echo "<img src=\"/assets/banners/Reviewsxmas.bmp\" alt=\"Random Reviews\" />";
}else{echo "<img src=\"/assets/banners/reviewstitle.png\" alt=\"Random Reviews\" />";}
}
if (empty ($post['title'])) {echo "<img src=\"/assets/banners/reviewstitle.png\" alt=\"Random Reviews\" />";}
?>

<div class="banner"><a href="http://factstofiction.co.uk"><img class="banner" src="/assets/banners/facts2fiction.png"  alt="Leaderboard" /></a>
</div>

</div>
</div>

<?php include('includes/menu.php') ?>
