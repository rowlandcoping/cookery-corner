<?php session_start();
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
<link rel="canonical" href="https://cookery-corner.co.uk/about.php" />
<title>Cookery Corner - For when the cupboard is almost bare</title>
<link rel="stylesheet" type="text/css" href="/styles/css/universal.css" />
<style type="text/css">


body
{
background-color: #EEEEE;
}

h1, h2

{
line-height: 120%;
margin: 0px;
border:0px;
padding: 0px 0px 15px 0px;
}

div.title{
background-color:#7ffffe;
padding: 10px;
margin-bottom:10px;
border-radius: 6px 6px 6px 6px;
}

div.main
{
font-size:1.05em;
background-color: #EEEEE;
position:absolute;
vertical-align:top;
left:8px;
right:132px;
padding: 10px 30px 20px 30px;
margin:10px 0px 0px 0px;
border-radius: 6px 6px 6px 6px;

}

div.right

{
position:absolute;
vertical-align:top;
text-align:right;
right:8px;
width:120px;
margin:10px 0px 0px 0px;
}

div.image
{
float:right;
vertical-align:top;
text-align:center;
margin: 0px 0px 0px 0px;
border-radius: 6px 6px 6px 6px;
}
ul.contact {
    margin:0px 0px 20px 0px;
    padding:0px;
    list-style:none;
    height:41px;
}

ul.contact li

{
    float: left;
}

#contacttext 
{
margin:10px 0px 0px 15px;
}
</style>
</head>
<div class="title">

<img src="/assets/banners/cookerycornermain.png" alt="Cookery Corner" />

<div class="banner"><a href="http://factstofiction.co.uk"><img class="banner" src="/assets/banners/facts2fiction.png"  alt="Leaderboard" /></a>
</div>

</div>
<?php include($menu);?>

<body>

<div class="page">
<?php require_once($banner) ?>
<div class="main">
<div class="image"><img src="/assets/images/marmite.jpg"></div>

<h1><b>What's this Cookery Corner all about then?</b></h1>



<h3>You mean you really, really want to know?  Oh, go on then, but I know you're only being nice....</h3>

<p>  Cookery Corner is the brainchild of <a href="/author/rowland-coping">Rowland Coping</a>, misunderstood Westcounty gastronomic genius, and master of exaggeration.</p>
 
<p>Forged in dark corridors of culinary despair, Cookery Corner is the vision that one man, no matter how dishevelled or disorganised, 
can turn <a href="archive/120105.php">a few choice ingredients</a> into gastonomic Valhalla and in doing so bring joy to people's lives. </p>

<p>OK one person's life.  And they got tired of it as well.</p>

<p>Still, from those humble beginnings an <a href="/archive/homepage/index311206.php">MSPaint sculpted monstrosity</a> was formed; over <i>(vast amounts of)</i> time it has become
the highly advanced <i>(for the mid 2000s)</i> web application you see before you today.</p>

<p>If through it one person's life can be changed for the better then all the effort will have been worthwhile. 
In fact, if one person raises so much as a wry grin or polite chuckle then it will all have been worthwhile.  
Including re-typing this after accidentally deleting it.  It was better the first time, honest.</p>

<p>If you think any part of the site could be improved (no sniggering) or (important!!) you somehow have any of the original lost e-mails, or anything really, 
then <a href="/contactform.php" target="blank">contact me</a> using the all new spam-proof submission system. Or you could simply get in touch using the power of 
<a href="http://www.facebook.com/pages/Cookery-Corner/251747153043" target="blank">Facebook</a> or <a href="http://twitter.com/rowlandcoping" target="blank">Twitter</a>. </p>
<p>Because this site is for you.</p>

<ul class="contact">
<li id="contact"><a href="/contactform.php" target="blank"><img src="/assets/logos/contactcc.png" /></a></li>
<li id="contacttext"><h3><a href="/contactform.php" target="blank">Get in touch</a></h3></li>
</ul>

<p><a href="http://twitter.com/rowlandcoping" target="blank"><img class="social" src="/archive/homepage/images/twitterhome.JPG" alt="Follow Rowland on Twitter" /></a>
	<a href="http://www.facebook.com/pages/Cookery-Corner/251747153043" target="blank"><img  class="social" src="/archive/homepage/images/facebookhome.JPG" alt="Become a fan on Facebook" /></a>
	</p>
	
</div>

</div>




</div>









<?php
include ($analytics);
?>


</body>


</html>
