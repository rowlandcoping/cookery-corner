<?php session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	$config = "$path"."/config.php";
	$head = "$path"."/includes/head_reviews.php";
	$banner = "$path"."/includes/right_banner.php";
	$analytics = "$path"."/analytics.php"; 
	require_once($config);
?>

<!DOCTYPE html>
<html lang="en">
	<?php require_once($head); ?>
		<div class="page">
			<?php require_once($banner); ?>
			<div class="main">
				<div class="container">	
					<!--this one is just a series of boxes maybe add expandable comments for each review-->	
					<div class="homecontent">
						<!--intro-->
						<div class ="fltright">
							<img src="/assets/images/delia_nutter.jpg" width="350">
							<p>Delia? Why are you here Delia?</p>
						</div>
						<div class="review">
							<h1>Random Reviews</h1>
							<div id="reviews-social">
								<a href=""><img src="/assets/logos/fbook.jpg"></a>
								<a href=""><img src="/assets/logos/twitter.jpg"></a>
								<a href=""><img src="/assets/logos/insta.png"></a>
							</div>
							<p>
								Welcome to the fantastical home of Random Reviews, the beating heart of this website for the last 20 years.
							</p>
							<p>
								These pages have historically been home to eye-aching colour schemes, head-scratching content and unparalleled artistic bravery.
							</p>
							<p>
								Plus a lot of text.  Too much text, some would say.
							</p>
							<p>
								At present you can find every review ever on this page, because there are only 
								<?php
									$sql = "SELECT ID FROM reviews";
									$result = $conn->query($sql);
									$num_results = $result->num_rows;
									echo $num_results;
								?>
								of them - but don't worry, I'll do a search thingy in the unlikely event things ever get out of hand.
							</p>
						</div>
					</div>
				</div>
				<div id="reviews-box-container">
					<?php
						$latest=$conn->prepare("SELECT * FROM article_index WHERE article_type='review' AND live='1' ORDER BY year DESC, MONTH DESC, day DESC, time_24h DESC");
						$latest->execute();				
						$product=$latest->get_result();
						foreach ($product as $row) {					
							$reviewID=$row['review_ID'];
							$blog=$conn->prepare("SELECT page_background, page_color, border_text,main_image, image1, text_background, textback_color, slug, h2h3_color, title, description FROM reviews WHERE ID=?");
							$blog->bind_param("s", $reviewID);
							$blog->execute();				
							$answer=$blog->get_result();
							$rows = $answer->fetch_assoc();
							if (!empty ($rows['main_image'])) {
								$main=$rows['main_image'];
							} else {
								$main=$rows['image1'];
							}
							echo "<div class=\"overview\"style=\"";
								//sets inline styles for each review box
								if (!empty ($rows['page_background'])) {
									echo "background-image: url(/assets/backgrounds/reviews/".$rows['page_background'].")";
								} else {
									echo "background-color: ".$rows['page_color'];
								}
								echo "; border-color: ".$rows['border_text']."; 
									color: ".$rows['border_text']."\">
									<div class=\"smallcont\">	
										<div class=\"smallimg\">
											<img src=\"/assets/images/reviews/".$main."\" style=\"border-color: ".$rows['border_text']."; object-fit:cover; width:150px; height:100px;\">
										</div>
										<div class=\"minititle\" style=\"border-color: ".$rows['border_text'].";";
										// sets inner background (behind text)
										if (!empty ($rows['text_background'])) {
											echo "background-image: url(/assets/backgrounds/reviews/".$rows['text_background'].")";
										} else { 
											echo "background-color: ".$rows['textback_color'];
										}
										//sets link behaviour using inline JavaScript
										echo"\"><h2>
											<a href=\"/reviews/".$rows['slug']."\" style=\"color:".$rows['border_text']."\" onmouseover=\"this.style.color = '".$rows['h2h3_color']."'\"onmouseout=\"this.style.textDecoration = 'none'; this.style.color='".$rows['border_text']."'\">".$rows['title']."</a></h2>
											<h3 style=\"color: ".$rows['h2h3_color']."\">".$row['date']."</h3>
										</div>
									</div>
									<div class=\"miniinfo\" style=\"border-color:".$rows['border_text'].";"; 
										if (!empty ($rows['text_background'])) {
											echo "background-image: url(/assets/backgrounds/reviews/".$rows['text_background'].")";
										} else { 
											echo "background-color: ".$rows['textback_color'];
										}
										echo"\"><p>".$rows['description']."</p>
									</div>
								</div>"
							;
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
