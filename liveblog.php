<?php session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$functions = "$path"."/includes/liveblog_functions.php";
$analytics = "$path"."/analytics.php";
$doctype="$path"."/includes/doctype.php";
$banner = "$path"."/includes/right_banner.php";
$head = "$path"."/includes/head_liveblog.php";
$livecontact = "$path"."/livecontact.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<?php

require_once($config);
require_once($doctype);
require_once($functions);


 if (isset($_GET['live-origin'])) {
include($livecontact);
exit();}?>


<?php 
$article_type='liveblog';

if (isset($_GET['post-slug'])) {
$post = getPost($_GET['post-slug']);
$blog_ID= $post['ID'];
$timedate = $conn->prepare("SELECT day_full, day, suffix, month_short, month_full, year FROM article_index WHERE liveblog_ID=?
								LIMIT 1");
$timedate ->bind_param("s", $blog_ID);
$timedate ->execute();				
$dateres = $timedate ->get_result();
$dmr = $dateres->fetch_assoc();
}elseif (isset($_GET['ID'])) {
$blog_ID= $_GET['ID'];
$query = $conn->prepare("SELECT liveblog_ID, day_full, day, suffix, month, month_short, month_full, year from article_index WHERE liveblog_ID=? 
							LIMIT 1");
$query ->bind_param("s", $blog_ID);
$query ->execute();				
$dateres = $query ->get_result();
$dmr = $dateres->fetch_assoc();
$query2 = $conn->prepare("SELECT * FROM liveblog WHERE ID=? 
								LIMIT 1");
$query2 ->bind_param("i", $dmr['liveblog_ID']);
$query2 ->execute();				
$blogres = $query2 ->get_result();
$post = $blogres->fetch_assoc();

}else{
/*if coming via main menu get most recent*/
$query = $conn->prepare("SELECT liveblog_ID, day_full, day, suffix, month, month_short, month_full, year from article_index WHERE article_type=? 
							ORDER by year DESC, MONTH DESC, day DESC, time_24h DESC LIMIT 1");
$query ->bind_param("s", $article_type);
$query ->execute();				
$dateres = $query ->get_result();
$dmr = $dateres->fetch_assoc();
$query2 = $conn->prepare("SELECT * FROM liveblog WHERE ID=? 
								LIMIT 1");
$query2 ->bind_param("i", $dmr['liveblog_ID']);
$query2 ->execute();				
$blogres = $query2 ->get_result();
$post = $blogres->fetch_assoc();
$blog_ID=$dmr['liveblog_ID'];
}
?>
<?php require_once($head); ?>
<body>
<div class="page">
	<?php require_once($banner); ?>
<div class="main">
	
<div class="container">

<div class="history">
<div class="historytext">
<h2 style="text-align:center;"><b><a href="/blog.php">Visit Blog</a></b></h2>

<hr />
<h2>Search Live Blogs</h2>
<hr />
<?php
//menu totally collapsed, shows years only
if (isset($_GET['collapse'])) {
	getAllyears($article_type);
	foreach ($allyears as $y) {
		displayYears (TRUE, $y['year'], $blog_ID, $article_type);
		foreach ($show_year as $sy) {
			displayMonths (TRUE, TRUE, $sy['month_full'], $sy['year'], $blog_ID);
		}
		echo "</ul></li>";
	}
	echo "</ul>";
//shows months for selected year
}elseif (isset ($_GET['year']) && !isset($_GET['month'])) {
	$selected_year = $_GET['year'];
	getAllyears($article_type);
	foreach ($allyears as $y) {
		if ($selected_year==$y['year']) {			
			displayYears (FALSE, $y['year'], $blog_ID, $article_type);
			foreach ($show_year as $sy) {
				displayMonths (TRUE, FALSE, $sy['month_full'], $sy['year'], $blog_ID);
			}
			echo "</ul></li>";
		}else{displayYears (TRUE, $y['year'], $blog_ID, $article_type);
			foreach ($show_year as $sy) {
				displayMonths (TRUE, TRUE, $sy['month_full'], $sy['year'], $blog_ID);
			}
			echo "</ul></li>";
		}		
	}
	echo "</ul>";
//shows articles for selected month
}elseif (isset ($_GET['year']) && isset($_GET['month'])) {
	$selected_year = $_GET['year'];
	$selected_month = $_GET['month'];
	getAllyears($article_type);
	foreach ($allyears as $y) {
		if ($selected_year==$y['year']) {
			displayYears (FALSE, $y['year'], $blog_ID, $article_type);
			foreach ($show_year as $sy) {
				$current_month = $sy['month_full'];
				if ($current_month==$selected_month) {
					displayMonths (FALSE, FALSE, $sy['month_full'], $sy['year'], $blog_ID);
				}else{displayMonths (TRUE, FALSE, $sy['month_full'], $sy['year'], $blog_ID);
				}
			}
			echo "</ul></li>";
		}else{displayYears (TRUE, $y['year'], $blog_ID, $article_type);
			foreach ($show_year as $sy) {
				displayMonths (TRUE, TRUE, $sy['month_full'], $sy['year'], $blog_ID);
			}
			echo "</ul></li>";
		}		
	}
	echo "</ul>";
//shows articles for month based on current URL if nothing selected from menu
}elseif (!isset($_GET['year'])) {
	$selected_year = $dmr['year'];
	$selected_month = $dmr['month_full'];
	getAllyears($article_type);
	foreach ($allyears as $y) {
		if ($selected_year==$y['year']) {
			displayYears (FALSE, $y['year'], $blog_ID, $article_type);
			foreach ($show_year as $sy) {
				$current_month = $sy['month_full'];
				if ($current_month==$selected_month) {
					displayMonths (FALSE, FALSE, $sy['month_full'], $sy['year'], $blog_ID);
				}else{displayMonths (TRUE, FALSE, $sy['month_full'], $sy['year'], $blog_ID);
				}
			}
			echo "</ul></li>";
		}else{displayYears (TRUE, $y['year'], $blog_ID, $article_type);
			foreach ($show_year as $sy) {
				displayMonths (TRUE, TRUE, $sy['month_full'], $sy['year'], $blog_ID);
			}
			echo "</ul></li>";
		}		
	}
	echo "</ul>";
}
?>



<hr />
</div>
</div>

<div class="blogcont">


<div class ="blogimgright">
<?php
if (!empty($post['main_image'])){
echo "<img src=\"/assets/images/liveblog/".$post['main_image']."\" width=\"350\" />"; }
?>
</div>

<div class="blogentry">
<h1>
<?php
echo $post ['title'];
?>
</h1>
<h3 class="user">
<?php
$user_ID= $post['user_ID'];
$author = $conn->prepare("SELECT name, slug FROM users WHERE ID=? 
								LIMIT 1");
$author->bind_param("s", $user_ID);
$author->execute();				
$authres = $author->get_result();
$res = $authres->fetch_assoc();
$name= $res['name'];
$aslug= $res['slug'];
	
echo "<a href=\"/author/";
echo $aslug;
echo "\">";
echo $name;
echo "</a>";
	
//get blog index

$blog_ID= $post['ID'];
$timedate = $conn->prepare("SELECT day_full, day, suffix, month_full, year FROM article_index WHERE liveblog_ID=? 
								LIMIT 1");
$timedate ->bind_param("s", $blog_ID);
$timedate ->execute();				
$dateres = $timedate ->get_result();
$dmr = $dateres->fetch_assoc();

echo ", ".$dmr['day_full']." ".$dmr['day'].$dmr['suffix']." ".$dmr['month_full']." ".$dmr['year']
?>
</h3>

<?php
echo $post ['intro'];
?>
</div>

<?php if ($post['closed']===0) {echo "<ul class=\"contact\">
<li id=\"contact\"><a href=\"/liveblog.php?live-origin=".$post['ID']."\" target=\"blank\"><img src=\"/assets/logos/contactcc.png\" /></a></li>
<li id=\"contacttext\"><h3><a href=\"/liveblog.php?live-origin=".$post['ID']."\" target=\"blank\">Contribute Here... please...</a></h3></li>
</ul>";}?>


<hr/>
<ul class="introbar">
<li id="logkey"><a href=""><img src="/assets/logos/keylog.png" /></a></li>
<li id="keywords"><a href=""></a>
<?php
echo $post['keywords'];
?>
</li>
<li id="facebook"><a href=""><img src="/assets/logos/fbook.jpg" /></a></li>
<li id="twitter"><a href=""><img src="/assets/logos/twitter.jpg" /></a></li>
<li id="insta"><a href=""><img src="/assets/logos/insta.png" /></a></li>
</ul>
<hr/>
</div>
<div class="blogcont">
<div class="blogentry">
<?php

$liveblog_ID=$post['ID'];
if ($post['closed']===0) {$blogquery= $conn->prepare("SELECT * from live_blog WHERE liveblog_ID=? ORDER BY ID DESC");}
else{$blogquery= $conn->prepare("SELECT * from live_blog WHERE liveblog_ID=? ORDER BY ID");}
$blogquery->bind_param("i", $liveblog_ID);
$blogquery ->execute();
$blogposts = $blogquery ->get_result();


foreach ($blogposts as $row) {
	
	
echo "<div class=\"segment\">";
echo "<div class=\"linethin\"></div>";
echo "<div class=\"segmentimage\">";
if ($row['image'] != NULL) {
echo "<img src=\"/assets/images/liveblog/".$row['image']."\" width=\"350\" /></div>";
}else {
echo "</div>";
}	
echo "<p class=\"time\">";
echo ($row['time']);
echo "</p>";
echo "<p>";
echo ($row['content']);
echo "</p>";
echo "</div>";

}
?>
</div>
</div>
</div>
</div>
</div>










<?php
include ($analytics);
?>


</body>


</html>
