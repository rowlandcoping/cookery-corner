<?php if(!isset($_SESSION)){session_start();};
	$path = $_SERVER['DOCUMENT_ROOT'];
	$config = "$path"."/config.php";
	$head = "$path"."/includes/head_home.php";
	$banner = "$path"."/includes/right_banner.php";
	$analytics = "$path"."/analytics.php";
	$doctype="$path"."/includes/doctype.php";
	$menu="$path"."/includes/menu.php";
	require_once($config);
?>
<!DOCTYPE html>
<html lang="en">	
	<?php require_once($head);?>
		<div class="page">
			<?php require_once($banner); ?>
			<div class="main">
				<div id="home-container">
					<!--container for left div (provides padding ext)-->
					<div id="section-container">
						<!--section1-->
						<div class="section">
							<a href="/recipes.php"><img src="/assets/banners/recipeweek.png" width="210", height="50" /></a>
								<p>
									A veritable cookery encyclopedia with every recipe you could ever dream of.
								</p>
						</div>
						<!--section2-->
						<div class="section">
							<a href="/blog.php"><img src="/assets/banners/bloglogo.png" width="210", height="50" /></a>
							<p>
								The rambling thoughts of a diseased <br>(yet inspired) lunatic.
							</p>
						</div>
						<!--section3-->
						<div class="section">
							<a href="/reviews.php"><img src="/assets/banners/reviewstitle.png" width="210", height="50" /></a>
								<p>
									Rowland reviews things that no reviewer has ever dared review before. 
								</p>
						</div>						
					</div>
					<div id="content-container">
						<div id="intro-section">
							<div id="introtext">
								<h1>Welcome to Cookery Corner</h1>
								<p>
									So glad you could stop by!  I've been, uh, redecorating.
								</p>
								<p>
									Here you will find recipes, cookery tips, fun features and even a very badly written blog by site
									progenitor <a href="/author/rowland-coping">Rowland Coping</a> himself.
								</p>
								<p>
									It's not a cult of personality any more though, because soon you can all add your favourite recipes and tell Rowland how bad his are too! 
								</p>
								<p>
									Not yet mind.  But you can sign up though and get all ready for it.
								</p>
							</div>
							<div id="login-container">
								<?php if(!isset ($_SESSION['loggedin'])){?>
									<h3><b>Log in or sign up!</b></h3>
									<form method="post" action="/login" >
										<ul class="form">
											<li id="realone">
												<label for="email">e-mail: </label>
												<input type="text" name="realone" placeholder="e-mail">
											</li>
											<li id="password">
												<label for="password">password: </label>	
												<input type="password" name="password" placeholder="password">
											</li>
											<label for="If you can read this then please leave this field blank"></label>
											<input id="email" type="text"  name="email" size="40"/>
										</ul>
									</form>
									<button type="submit" class="btn" name="login_btn">Login</button>		
									<p>
										Not registered yet? <a href="/register_user.php" target="blank">Get involved!</a>
										<br />Forgot Password? <a href="/reset_password.php" target="blank">No Problem!</a>
									</p>
								<?php } else { ?> 
									<h2>Welcome to the party<br><?php echo $_SESSION['name'];?></h2>
									<h3>Are you here for a good time...<br>...or are you just passing through?</h3>
									<h2><a href="/admin/admin.php">Visit Profile</a></h2>
									<h3><a href="/logout">Log Out</a></h3>
								<?php } ?>			
							</div>
							
						</div>
						<div class="recommends">
							<h3>Rowland Recommends... <a href="/reviews/exotic-meat-review">Exotic Meat Review</a></h3>
							<p>
								It's like 'My Family and Other Animals', except everything is dead and has been minced into sausages.
							</p>
						</div>
						<div class="latest">
							<h2>Latest Features:</h2>
							<table>
								<?php
									$latest=$conn->prepare("SELECT * FROM article_index WHERE live=1 ORDER BY year DESC, MONTH DESC, day DESC, time_24h DESC LIMIT 3");
									$latest->execute();				
									$product=$latest->get_result();
									foreach ($product as $row) {
										if (!empty($row['blog_ID'])){
											$blogID=$row['blog_ID'];
											$blog=$conn->prepare("SELECT title, content, slug FROM blog WHERE ID=?");
											$blog->bind_param("s", $blogID);
											$blog->execute();				
											$answer=$blog->get_result();
											$rows = $answer->fetch_assoc();
											echo "
												<tr>
													<td><img src=\"/assets/logos/blogbig.jpeg\" /></td>
													<td><h3><a href=\"/blog/".$rows['slug']."\">".$rows['title']."</a></h3>".substr($rows['content'], 3, 60)."...</td>
												</tr>
												";
										}
										if (!empty($row['recipe_ID'])){
											$recipeID=$row['recipe_ID'];
											$recipe=$conn->prepare("SELECT title, description, titslug FROM recipes WHERE ID=?");
											$recipe->bind_param("s", $recipeID);
											$recipe->execute();				
											$answer=$recipe->get_result();
											$rows = $answer->fetch_assoc();
											echo "
												<tr>
												<td><img src=\"/assets/logos/kniforkbig.jpeg\" /></td>
												<td><h3><a href=\"/recipe/".$rows['titslug']."\">".$rows['title']."</a></h3>".substr($rows['description'], 3, 60)."...</td>
												</tr>
												";
										}
										if(!empty($row['review_ID'])){
											$reviewID=$row['review_ID'];
											$recipe=$conn->prepare("SELECT title, description, slug FROM reviews WHERE ID=?");
											$recipe->bind_param("s", $reviewID);
											$recipe->execute();				
											$answer=$recipe->get_result();
											$rows = $answer->fetch_assoc();
											echo "
												<tr>
												<td><img src=\"/assets/logos/penbig.jpeg\" /></li>
												<td><h3><a href=\"/reviews/".$rows['slug']."\">".$rows['title']."</a></h3>".substr($rows['description'], 3, 60)."...</tr>
												</tr>
												";
										}
										if(!empty($row['liveblog_ID'])){
											$reviewID=$row['liveblog_ID'];
											$recipe=$conn->prepare("SELECT title, intro, slug FROM liveblog WHERE ID=?");
											$recipe->bind_param("s", $reviewID);
											$recipe->execute();				
											$answer=$recipe->get_result();
											$rows = $answer->fetch_assoc();
											echo "
												<tr>
												<td><img src=\"/assets/logos/blogbig.jpeg\" /></td>
												<td><h3><a href=\"/liveblog/".$rows['slug']."\">".$rows['title']."</a></h3>".substr($rows['intro'], 3, 60)."...</td>
												</tr>
												";
										}
									}
								?>
								<!--end php-->
							</table>
						</div>
					</div>
				</div>
			</div>
		
			<div class="footer">
				<hr>
				<div class="footseg2">
					<p>
						Disclaimer: Cookery Corner accepts no responsibility for phsical and/or mental damage caused by the adoption or adaptation of its cookery tips.
					</p>
					<p>
						This website is meant to be FUN, yet it is the work of but one man and sometimes things slip through the net.
						<br>Any issues regarding the material herein should be addressed directly to the site owner via the contact page.
					</p>
				</div>
				<div class="footseg1">
					<p>
						<a href="/contactform.php" target="blank">Contact Us</a>
					</p>
				</div>
				<hr>
			</div>
		</div>
		<?php
		include ($analytics);
		?>
	</body>
</html>
