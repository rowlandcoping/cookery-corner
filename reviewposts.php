<?php session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	$config = "$path"."/config.php";
	$process = "$path"."/includes/review_process.php";
	$head = "$path"."/includes/head_reviews.php";
	$banner = "$path"."/includes/right_banner.php";
	$analytics = "$path"."/analytics.php";
	require_once($config);
	require_once($process);
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$user_ID= $post['user_ID'];
	$author = $conn->prepare("SELECT name, slug FROM users WHERE ID=? 
								LIMIT 1");
	$author->bind_param("s", $user_ID);
	$author->execute();				
	$authres = $author->get_result();
	$res = $authres->fetch_assoc();
	$name= $res['name'];
	$aslug= $res['slug'];
	$timedate = $conn->prepare("SELECT date FROM article_index WHERE review_ID=? 
									LIMIT 1");
	$timedate ->bind_param("s", $post['ID']);
	$timedate ->execute();				
	$dateres = $timedate ->get_result();
	$dmr = $dateres->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
	<?php require_once($head); ?>
		<div class="page">
			<?php require_once($banner); ?>
			<div class="main">	
				<div class="container">
					<!--this one is just a series of boxes maybe add expandable comments for each review-->	
					<div class="reviewbox">
						<!--intro-->
						<?php 
							echo "
								<h1>".$post['title']."</h1>
								<h2><a href=\"/author/".$aslug."\">".$name."</a>, ".$dmr['date']."</h2>"
							;
						?>
						<div id="reviews-social">
							<!-- change css for this (currently .review img)-->
							<a href=""><img src="/assets/logos/fbook.jpg"></a>
							<a href=""><img src="/assets/logos/twitter.jpg"></a>
							<a href=""><img src="/assets/logos/insta.png"></a>
						</div>
						<div class="review-container">
							<div class ="fltright">
								<?php
									if (!empty ($post['main_image'])) {
										echo"<img src=\"/assets/images/reviews/".$post['main_image']."\" width=\"310\"/>";
									}
								?>
							</div>
							<div class="review">
								<?php echo $post['intro']; ?>
								<h3>LET THE REVIEWS BEGIN</h3>
							</div>
						</div>
					</div>
					<!-- container for first 2 reviews -->
					<div class="flex-container-reviews">						
						<?php
							echo "
								<div class=\"reviewbox-left\">
									<h2>".$post['heading1']."</h2>
									<!-- ensure this container behaves like reviewbox without the border to make image float -->
									<div class=\"review-container\">									
										<div class =\"fltright\">
											<img src=\"/assets/images/reviews/".$post['image1']."\" width=\"310\">
											<p>".$post['caption1']."</p>
										</div>
										<div class=\"review\">
											".$post['review1']."
											<h3>".$post['rating_name'].":  ".$post['rating1']."</h3>
										</div>
									</div>
								</div>
								<div class=\"reviewbox-right\">
									<h2>".$post['heading2']."</h2>
									<div class=\"review-container\">
										<div class =\"fltright\">
											<img src=\"/assets/images/reviews/".$post['image2']."\" width=\"310\">
											<p>".$post['caption2']."</p>
										</div>
										<div class=\"review\">
											".$post['review2']."
											<h3>".$post['rating_name'].":  ".$post['rating2']."</h3>
										</div>
									</div>
								</div>"
							; 
						?>
					</div>
					<!-- container for reviews 3 and 4 -->
					<div class="flex-container-reviews">						
						<?php
							echo "
								<div class=\"reviewbox-left\">
									<h2>".$post['heading3']."</h2>
									<div class=\"review-container\">
										<div class =\"fltright\">
											<img src=\"/assets/images/reviews/".$post['image3']."\" width=\"310\">
											<p>".$post['caption3']."</p>
										</div>
										<div class=\"review\">
											".$post['review3']."
											<h3>".$post['rating_name'].":  ".$post['rating3']."</h3>
										</div>
									</div>
								</div>"
							;
							if (!empty($post['heading4'])) {
								echo "
									<div class=\"reviewbox-right\">
										<h2>".$post['heading4']."</h2>
										<div class=\"review-container\">
											<div class =\"fltright\">
												<img src=\"/assets/images/reviews/".$post['image4']."\" width=\"310\">
												<p>".$post['caption4']."</p>
											</div>
											<div class=\"review\">										
												".$post['review4']."
												<h3>".$post['rating_name'].":  ".$post['rating4']."</h3>
											</div>
										</div>
									</div>"
								;
							}
						?>
					</div>
					<!-- container for reviews 5 and 6 -->
					<div class="flex-container-reviews">
						<?php		
							if (!empty($post['heading5'])) {
								echo "
									<div class=\"reviewbox-left\">
										<h2>".$post['heading5']."</h2>
										<div class=\"review-container\">
											<div class =\"fltright\">
												<img src=\"/assets/images/reviews/".$post['image5']."\" width=\"310\">
												<p>".$post['caption5']."</p>
											</div>
											<div class=\"review\">
												".$post['review5']."
												<h3>".$post['rating_name'].":  ".$post['rating5']."</h3>
											</div>
										</div>
									</div>"
								;
							}
							if (!empty($post['heading6'])) {
								echo "
									<div class=\"reviewbox-right\">
										<h2>".$post['heading6']."</h2>
										<div class=\"review-container\">
											<div class =\"fltright\">
												<img src=\"/assets/images/reviews/".$post['image6']."\" width=\"310\">
												<p>".$post['caption6']."</p>
											</div>
											<div class=\"review\">
												".$post['review6']."
												<h3>".$post['rating_name'].":  ".$post['rating6']."</h3>
											</div>
										</div>
									</div>"
								;
							}
						?>
					</div>
					<!-- container for reviews 7 and 8 -->
					<div class="flex-container-reviews">
						<?php
							if (!empty($post['heading7'])) {
								echo "
									<div class=\"reviewbox-left\">
										<h2>".$post['heading7']."</h2>
										<div class=\"review-container\">
											<div class =\"fltright\">
												<img src=\"/assets/images/reviews/".$post['image7']."\" width=\"310\">
												<p>".$post['caption7']."</p>
											</div>
											<div class=\"review\">
												".$post['review7']."
												<h3>".$post['rating_name'].":  ".$post['rating7']."</h3>
											</div>
										</div>
									</div>"
								;
							}
							if (!empty($post['heading8'])) {
								echo "
									<div class=\"reviewbox-right\">
										<h2>".$post['heading8']."</h2>
										<div class=\"review-container\">
											<div class =\"fltright\">
												<img src=\"/assets/images/reviews/".$post['image8']."\" width=\"310\">
												<p>".$post['caption8']."</p>
											</div>
											<div class=\"review\">
												".$post['review8']."
												<h3>".$post['rating_name'].":  ".$post['rating8']."</h3>
											</div>
										</div>
									</div>"
								;
							}
						?>
					</div>
					<?php
						//summary
						echo "
							<div class=\"reviewbox\">
								<div class=\"review\">
									<h2>Conclusions</h2>
									".$post['summary']
						;
					?>
				</div>
			</div> 
		</div>
	</body>
	<?php
		include ($analytics);
	?>
</html>