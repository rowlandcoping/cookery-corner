<?php

/////FETCH BLOG POST/////

function getPost($slug)
{
	global $conn;
	$post_slug =$_GET['post-slug'];
	$sql = $conn->prepare("SELECT * FROM blog WHERE slug=?");
	$sql->bind_param("s", $post_slug);
	$sql->execute();
	$result=$sql->get_result();
	$post = $result->fetch_assoc();
	return $post;
}

/////NAVIGATION FUNCTIONS/////

/////////////////
//GET ALL YEARS//
////////////////

function getAllyears($article_type) {
	echo "<ul class=\"years\">";
	global $conn;
	global $allyears;
	$getallyears=$conn->prepare("SELECT DISTINCT year from article_index WHERE article_type=? AND live=1 ORDER by year DESC");
	$getallyears ->bind_param("s", $article_type);
	$getallyears ->execute();				
	$allyears = $getallyears ->get_result();
	
}
//////////////////
//SHOW EACH YEAR//
//////////////////

function displayYears($collapsed, $current_year, $blog_ID, $article_type) {
	global $conn;
	global $show_year;
	echo "<li class=\"year\">";
	if ($collapsed == TRUE) {
		echo "<a class=\"fa fa-angle-double-right\" href=\"/blog.php?year=".$current_year; 
		} else {
		echo "<a class=\"fa fa-angle-double-down\" href=\"/blog.php?collapse=?";
		}	
	echo "&ID=".$blog_ID."\"></a>&nbsp".$current_year;
	echo "<ul class=\"months\">";
	$year = $current_year;	
	$get_year=$conn->prepare("SELECT DISTINCT month, month_full, year from article_index WHERE year=? AND article_type=? AND live=1 ORDER BY month DESC");
	$get_year ->bind_param("ss", $year, $article_type);
	$get_year ->execute();				
	$show_year = $get_year ->get_result();
	
}			

///////////////////
//SHOW EACH MONTH//
///////////////////

function displayMonths ($collapsed, $hidden, $month, $year, $blog_ID) {
	global $conn;
	if ($hidden==TRUE) {echo "<li class=\"hidden\"><a class=\"fa fa-angle-double-right\" 
				href=\"/blog.php?year=".$year."&ID=".$blog_ID."\"></a>&nbsp".$month;
	} elseif ($collapsed==TRUE) {echo "<li class=\"month\"><a class=\"fa fa-angle-double-right\"
				href=\"/blog.php?year=".$year."&month=".$month."&ID=".$blog_ID."\"></a>&nbsp".$month;
	} else {echo "<li class=\"month\"><a class=\"fa fa-angle-double-down\"
				href=\"/blog.php?year=".$year."&ID=".$blog_ID."\"></a>&nbsp".$month;
	}
	echo "<ul class=\"articles\">";
	$select_article=$conn->prepare("SELECT blog_ID, date FROM article_index WHERE month_full=? AND year=?");
	$select_article ->bind_param("ss", $month, $year);
	$select_article ->execute();				
	$article_info = $select_article ->get_result();
	$date_res = $article_info->fetch_assoc();
	foreach ($article_info as $article) {
		$article_ID=$article['blog_ID'];
		$get_content =$conn->prepare("SELECT title, slug FROM blog WHERE ID=?");
		$get_content ->bind_param("s", $article_ID);
		$get_content ->execute();				
		$content = $get_content ->get_result();
		foreach ($content as $c) {
			if ($collapsed == TRUE) {
				echo "<li class=\"hidden\">";
			} else {echo "<li class=\"article\">";
			} 
		echo "<a href=\"/blog/".$c['slug']."\">".$date_res['date'].": ".$c['title']."</a></li>";
		}					
	}
echo "</ul></li>";
}

?>
