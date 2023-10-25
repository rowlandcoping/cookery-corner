<?php session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$analytics = "$path"."/analytics.php";
$doctype="$path"."/includes/doctype.php";
$banner = "$path"."/includes/right_banner.php";
$head = "$path"."/includes/head_blog.php";
$functions = "$path"."/includes/blog_functions.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<?php
require_once($config);
require_once($doctype);
require_once($functions);
?>

<?php 
$article_type='blog';

//if coming from external link
if (isset($_GET['post-slug'])) {	
$post = getPost($_GET['post-slug']);
$blog_ID= $post['ID'];
$timedate = $conn->prepare("SELECT day_full, day, suffix, month_short, month_full, year FROM article_index WHERE blog_ID=?
								LIMIT 1");
$timedate ->bind_param("s", $blog_ID);
$timedate ->execute();				
$dateres = $timedate ->get_result();
$dmr = $dateres->fetch_assoc();
//if browsing the history maintain current blog entry	
}elseif (isset($_GET['ID'])) {
$blog_ID= $_GET['ID'];
$query = $conn->prepare("SELECT blog_ID, day_full, day, suffix, month, month_short, month_full, year from article_index WHERE blog_ID=? 
							LIMIT 1");
$query ->bind_param("s", $blog_ID);
$query ->execute();				
$dateres = $query ->get_result();
$dmr = $dateres->fetch_assoc();
$query2 = $conn->prepare("SELECT * FROM blog WHERE ID=? 
								LIMIT 1");
$query2 ->bind_param("i", $dmr['blog_ID']);
$query2 ->execute();				
$blogres = $query2 ->get_result();
$post = $blogres->fetch_assoc();
/*if coming via main menu get most recent*/
}else{
$query = $conn->prepare("SELECT blog_ID, day_full, day, suffix, month, month_short, month_full, year from article_index WHERE article_type=? 
							ORDER by year DESC, MONTH DESC, day DESC, time_24h DESC LIMIT 1");
$query ->bind_param("s", $article_type);
$query ->execute();				
$dateres = $query ->get_result();
$dmr = $dateres->fetch_assoc();
$query2 = $conn->prepare("SELECT * FROM blog WHERE ID=? 
								LIMIT 1");
$query2 ->bind_param("i", $dmr['blog_ID']);
$query2 ->execute();				
$blogres = $query2 ->get_result();
$post = $blogres->fetch_assoc();
$blog_ID= $dmr['blog_ID'];	
}

?>
<?php require_once($head); ?>
<body>
<div class="page">
	<banner>
	<?php require_once($banner); ?>
	</banner>
<div class="main">
	
<div class="container">
<nav class="history">
<div class="historytext">
<h2><a href="/liveblog.php"><b>Visit Live Blog</b></a></h2>

<hr />
<h2>Search Blog Archive</h2>
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
</nav>

<main>
<article class="blogcont">

<?php
$blog_ID= $post['ID'];
$timedate = $conn->prepare("SELECT day_full, day, suffix, month_short, month_full, year FROM article_index WHERE blog_ID=? AND live=1
								LIMIT 1");
$timedate ->bind_param("s", $blog_ID);
$timedate ->execute();				
$dateres = $timedate ->get_result();
$dmr = $dateres->fetch_assoc();
?>

<figure class ="blogimgright">
<?php
if (!empty($post['blog_image'])){
echo "<img src=\"/assets/images/blog/".$post['blog_image']."\" width=\"350\" />"; }
?>
</figure>

<div class="blogentry">
<header>
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
$timedate = $conn->prepare("SELECT day_full, day, suffix, month_full, year FROM article_index WHERE blog_ID=? AND live=1
								LIMIT 1");
$timedate ->bind_param("s", $blog_ID);
$timedate ->execute();				
$dateres = $timedate ->get_result();
$dmr = $dateres->fetch_assoc();

echo ", ".$dmr['day_full']." ".$dmr['day'].$dmr['suffix']." ".$dmr['month_full']." ".$dmr['year']
?>
</h3>
</header>
<?php
echo $post ['content'];
?>
</div>
<footer>
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
</footer>
</article>
</main>

</div>
</div>
</div>
</div>



<?php
include ($analytics);
?>


</body>


</html>
