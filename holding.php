<?php if(!isset($_SESSION)){session_start();};
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";

$banner = "$path"."/includes/right_banner.php";
$analytics = "$path"."/analytics.php";
$doctype="$path"."/includes/doctype.php";
$menu="$path"."/includes/menu.php";

require_once($config);
require_once($doctype);

?>

<head>
	
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="canonical" href="https://cookery-corner.co.uk" />
<title>Cookery Corner - For when the cupboard is almost bare</title>
<link rel="stylesheet" type="text/css" href="/styles/css/universal.css" />

<style>
div.title	{
background-color:#7ffffe;
padding: 10px;
margin-bottom:10px;
}

div.content	{
overflow: hidden;
padding: 8px 8px 8px 8px;
margin: 40px 40px 7px 40px;
background-image:url(/assets/backgrounds/tea.jpg);
}
body {background-image:url(/assets/backgrounds/bendyned.jpg);
}
	
 </style>
</head>
<div class="title">
<div class="title_bann">

<img src="/assets/banners/cookerycornermain.png" alt="Cookery Corner" />

<div class="banner"><a href="http://factstofiction.co.uk"><img src="/assets/banners/facts2fiction.png"  alt="Leaderboard" /></a>
</div>

</div>
</div>
<?php include($menu); ?>




<div class="content">

<h1 align=center>Cookery Corner</h1>


<font size=3><p align=center>This small but tasty corner of the web is still under construction, 
or I moved it to another location, or something like that...</p>

<p align=center>Anyway... fear not, for all is not lost. The <a href="/index.php">homepage</a> is but a short click away, and I'm pretty sure you'll be able to find what you were looking for there. <br />Unless I haven't built it yet, of course.  
</div>
<?php
include ($analytics);
?>


</body>


</html>
