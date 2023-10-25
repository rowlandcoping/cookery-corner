<head>
	
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

<?php

	$baseurl="https://cookery-corner.co.uk/liveblog/";
	echo "<link rel=\"canonical\" href=\"".$baseurl.$post['slug']."\"/>";
?>

<title>Cookery Corner - Live Blog - 
<?php
echo $post ['title']
?></title>
<link rel="stylesheet" type="text/css" href="/styles/css/universal.css" />
<link rel="stylesheet" type="text/css" href="/styles/css/liveblog.css" />

<?php
echo"
<style type=\"text/css\">

body
{";
if (!empty ($post['body_background'])) {echo "background-image: url(/assets/backgrounds/liveblog/".$post['body_background'].")";}
else {echo "background-color: ".$post['body_color'];}

echo ";
color:".$post['text_color'].";
}

div.container
{";
if (!empty ($post['blog_background'])) {echo "background-image: url(/assets/backgrounds/liveblog/".$post['blog_background'].");";}
else {echo "background-color: ".$post['blog_color'].";";}
echo"
}

div.blogcont, div.history
{";
if (!empty ($post['textarea_background'])) {echo "background-image: url(/assets/backgrounds/liveblog/".$post['textarea_background'].");";}
else {echo "background-color: ".$post['textarea_color'];}
if ($post['bgtype']=="cover"){echo "background-size: cover;";}

echo"
}

li.year {
color:".$post['h_color'];
echo "
;}

li.month {
color:".$post['text_color'].";}


h2, h3, h3.user
{
color: ".$post['h_color'].";
}

div.container a
{
color:".$post['links_color'].";
}

div.container a:hover
{
color:".$post['hover_color'].";
}
#keywords
{
color:".$post['h_color'].";
}
</style>";
?>


</head>

<body>
<div class="title">
<div class="title_bann">

<img src="/assets/banners/bloglogo.png" alt="Rowland's Blog" />

<div class="banner"><a href="http://factstofiction.co.uk"><img src="/assets/banners/facts2fiction.png"  alt="Leaderboard" /></a>
</div>

</div>
</div>

<?php include('includes/menu.php') ?>

