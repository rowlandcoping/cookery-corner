<?php session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	$config = "$path"."/config.php";
	$functions = "$path"."/includes/liveblog_functions.php";
	$analytics = "$path"."/analytics.php";
	$banner = "$path"."/includes/right_banner.php";
	$head = "$path"."/includes/head_liveblog.php";
	$livecontact = "$path"."/livecontact.php";
	require_once($config);
	require_once($functions);
	if (isset($_GET['live-origin'])) {
		include($livecontact);
		exit();
	}
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
	} elseif (isset($_GET['ID'])) {
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
	} else {
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
<!DOCTYPE html>
	<html lang="en">
	<?php require_once($head); ?>
		<div class="page">
			<?php require_once($banner); ?>
			<div class="main">	
				<div id="liveblog-container">					
					<main id="content-container">
						<!--container to ensure switch in flex direction affects correct elements -->
						<section class="blogcont">
							<!--Intro section for live blog (same layout as blog) -->	
							<div class ="blogimgright">
								<?php
									if (!empty($post['main_image'])) {
										echo "<img src=\"/assets/images/liveblog/".$post['main_image']."\" width=\"350\">"; 
									}
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
										//get author info
										$user_ID= $post['user_ID'];
										$author = $conn->prepare("SELECT name, slug FROM users WHERE ID=? 
																		LIMIT 1");
										$author->bind_param("s", $user_ID);
										$author->execute();				
										$authres = $author->get_result();
										$res = $authres->fetch_assoc();
										$name= $res['name'];
										$aslug= $res['slug'];

										//get blog index
										$blog_ID= $post['ID'];
										$timedate = $conn->prepare("SELECT day_full, day, suffix, month_full, year FROM article_index WHERE liveblog_ID=? 
																		LIMIT 1");
										$timedate ->bind_param("s", $blog_ID);
										$timedate ->execute();				
										$dateres = $timedate ->get_result();
										$dmr = $dateres->fetch_assoc();

										//dispay author and date posted info
										echo "<a href=\"/author/".$aslug."\">".$name."</a>";
										echo ", ".$dmr['day_full']." ".$dmr['day'].$dmr['suffix']." ".$dmr['month_full']." ".$dmr['year'];
									?>
								</h3>
								<?php
									//display intro to live blog
									echo $post ['intro'];
									//display contribute option if liveblog is open
									if ($post['closed']===0) {
										echo "<ul class=\"contact\">
												<li id=\"contact\">
													<a href=\"/liveblog.php?live-origin=".$post['ID']."\" target=\"blank\"><img src=\"/assets/logos/contactcc.png\"></a>
												</li>
												<li id=\"contacttext\">
													<h3><a href=\"/liveblog.php?live-origin=".$post['ID']."\" target=\"blank\">Contribute Here...</a></h3>
												</li>
											</ul>";
									}
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
						</section>
						<section class="blogcont">
							<!--Section for each liveblog post -->
							<div class="blogentry">
								<?php
									$liveblog_ID=$post['ID'];
									//orders liveblog in first to last order if it's closed, otherwise vice-versa.
									if ($post['closed']===0) {
										$blogquery= $conn->prepare("SELECT * from live_blog WHERE liveblog_ID=? ORDER BY ID DESC");
									} else {
										$blogquery= $conn->prepare("SELECT * from live_blog WHERE liveblog_ID=? ORDER BY ID");
									}
									$blogquery->bind_param("i", $liveblog_ID);
									$blogquery ->execute();
									$blogposts = $blogquery ->get_result();

									//iterates over and displays each liveblog post
									foreach ($blogposts as $row) {									
										echo "<div class=\"segment\">";
										echo "<div class=\"linethin\"></div>";											
										echo "<p class=\"time\">".$row['time']."</p>";										
										//displays image if available
										if ($row['image'] != NULL) {
											echo "<div class=\"blogimgright\">";
											echo "<img src=\"/assets/images/liveblog/".$row['image']."\" width=\"350\">";
											echo "</div>";
										}
										echo "<p>".$row['content']."</p>";
										echo "</div>";
									}
								?>
							</div>
						</section>
					</main>
					<section id="history">
						<div id="history-text">
							<h2 style="text-align:center;"><b><a href="/blog.php">Visit Blog</a></b></h2>
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
								} elseif (!isset($_GET['year'])) {
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
					</section>
				</div>
			</div>
		</div>
	</body>
</html>