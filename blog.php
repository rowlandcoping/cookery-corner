<?php session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	$config = "$path"."/config.php";
	$analytics = "$path"."/analytics.php";
	$doctype="$path"."/includes/doctype.php";
	$banner = "$path"."/includes/right_banner.php";
	$head = "$path"."/includes/head_blog.php";
	$functions = "$path"."/includes/blog_functions.php";

	require_once($config);
	require_once($functions);

	$article_type='blog';	
	if (isset($_GET['post-slug'])) {
		//if coming from external link
		$post = getPost($_GET['post-slug']);
		$blog_ID= $post['ID'];
		$timedate = $conn->prepare("SELECT day_full, day, suffix, month_short, month_full, year FROM article_index WHERE blog_ID=?
										LIMIT 1");
		$timedate ->bind_param("s", $blog_ID);
		$timedate ->execute();				
		$dateres = $timedate ->get_result();
		$dmr = $dateres->fetch_assoc();
	} elseif (isset($_GET['ID'])) {
		//if browsing the history maintain current blog entry	
		$blog_ID = $_GET['ID'];
		$query = $conn -> prepare("SELECT blog_ID, day_full, day, suffix, month, month_short, month_full, year from article_index WHERE blog_ID=? 
									LIMIT 1");
		$query -> bind_param("s", $blog_ID);
		$query -> execute();				
		$dateres = $query ->get_result();
		$dmr = $dateres->fetch_assoc();
		$query2 = $conn->prepare("SELECT * FROM blog WHERE ID=? 
									LIMIT 1");
		$query2 ->bind_param("i", $dmr['blog_ID']);
		$query2 ->execute();				
		$blogres = $query2 ->get_result();
		$post = $blogres->fetch_assoc();	
	} else{ 
		/*if coming via main menu get most recent*/
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
<!DOCTYPE html>
<html lang="en">
	<?php require_once($head); ?>
		<div class="page">
			<?php require_once($banner); ?>
			<div class="main">
				<div id="blog-container">					
					<article id="blog-content">
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
									echo "<img src=\"/assets/images/blog/".$post['blog_image']."\" width=\"350\">"; 
								}
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
										//get blog author
										$user_ID= $post['user_ID'];
										$author = $conn->prepare("SELECT name, slug FROM users WHERE ID=? 
																	LIMIT 1");
										$author->bind_param("s", $user_ID);
										$author->execute();				
										$authres = $author->get_result();
										$res = $authres->fetch_assoc();
										$name= $res['name'];
										$aslug= $res['slug'];

										//get blog date
										$blog_ID= $post['ID'];
										$timedate = $conn->prepare("SELECT day_full, day, suffix, month_full, year FROM article_index WHERE blog_ID=? AND live=1
																	LIMIT 1");
										$timedate ->bind_param("s", $blog_ID);
										$timedate ->execute();				
										$dateres = $timedate ->get_result();
										$dmr = $dateres->fetch_assoc();

										//display blog author and date
										echo "<a href=\"/author/";
										echo $aslug;
										echo "\">";
										echo $name;
										echo "</a>";
										echo ", ".$dmr['day_full']." ".$dmr['day'].$dmr['suffix']." ".$dmr['month_full']." ".$dmr['year'];
									?>
								</h3>
							</header>
							<?php
								//display blog content
								echo $post ['content'];
							?>
							<hr>
							<div id="bottom-article">
								<div id="blog-keywords">
									<img src="/assets/logos/keylog.png">
									<?php
											echo $post['keywords'];
									?>
								</div>
								<hr id="blog-divider">
								<div id="blog-social">
									<a href=""><img src="/assets/logos/fbook.jpg"></a>
									<a href=""><img src="/assets/logos/twitter.jpg"></a>
									<a href=""><img src="/assets/logos/insta.png"></a>
								</div>
							</div>
							<hr>
						</div>						
					</article>
					<div id="history">
						<div id="history-text">
							<h2><a href="/liveblog.php"><b>Visit Live Blog</b></a></h2>
							<hr>
							<h2>Search Blog Archive</h2>
							<hr>
							<?php							
								if (isset($_GET['collapse'])) {
									//menu totally collapsed, shows years only
									getAllyears($article_type);
									foreach ($allyears as $y) {
										displayYears (TRUE, $y['year'], $blog_ID, $article_type);
										foreach ($show_year as $sy) {
											displayMonths (TRUE, TRUE, $sy['month_full'], $sy['year'], $blog_ID);
										}
										echo "</ul></li>";
									}
									echo "</ul>";
								} elseif (isset ($_GET['year']) && !isset($_GET['month'])) {
									//shows months for selected year
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
								} elseif (isset ($_GET['year']) && isset($_GET['month'])) {
									//shows articles for selected month
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
								} else {
									//shows articles for month based on current URL if nothing selected from menu
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
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php
		include ($analytics);
	?>
</html>
