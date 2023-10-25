<div class="menulog">


<div class="loginfo">

<?php
if (!isset($_SESSION['loggedin'])){
echo "<p><a href =\"/publiclogin.php\">Log In</a></p>";
}else{
echo "<p><a class=\"logname\" href=\"/admin/admin.php\">".$_SESSION['name']."</a></p>";
echo "<p><a href =\"/logout\">Log Out</a></p>";
}
?>


</div>

<div class="menubar">
				<ul>

				<li id="homeimg"><a href="/index.php"><img src="/assets/menu/homeimg.bmp" alt="home" /></a></li>
				<li id="home"><a href="/index.php"><img src="/assets/menu/home.png" alt="home" /></a></li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="aboutimg"><a href="/about.php"><img src="/assets/menu/aboutimg.bmp" alt="about" /></a></li>
				<li id="about"><a href="/about.php"><img src="/assets/menu/about.png" alt="about" /></a></li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="recipeimg"><a href="/recipes.php"><img src="/assets/menu/recipeimg.bmp" alt="recipes" /></a></li>
				<li id="recipe"><a href="/recipes.php"><img src="/assets/menu/recipe.png" alt="recipes"</li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="blogimg"><a href="/blog.php"><img src="/assets/menu/rowlandimg.bmp" alt="blog" /></a></li>
				<li id="blog"><a href="/blog.php"><img src="/assets/menu/blog.png" alt="blog" /></li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="reviewimg"><a href="/reviews.php"><img src="/assets/menu/reviewsimg.bmp" alt="reviews" /></a></li>
				<li id="review"><a href="/reviews.php"><img src="/assets/menu/reviews.png" alt="reviews" /></a></li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="forumimg"><a href="/holding.php"><img src="/assets/menu/forumimg.bmp" alt="forum" /></a></li>
				<li id="forum"><a href="/holding.php"><img src="/assets/menu/forum.png" alt="forum" /></a></li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="contactimg"><a href="/feedback/feedback190609.php"><img src="/assets/menu/contributeimg.bmp" alt="contact" /></a></li>
				<li id="contact"><a href="/feedback/feedback190609.php"><img src="/assets/menu/contact.png" alt="contact" /></a></li>				
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="linksimg"><a href="/holding.php"><img src="/assets/menu/friendsimg.bmp" alt="links" /></a></li>
				<li id="links"><a href="/holding.php"><img src="/assets/menu/links.png" alt="links" /></a></li>
				<li id="line"><img src="/assets/menu/secline.png" /></li>
				<li id="indeximg"><a href="/archive/archive.php"><img src="/assets/menu/archiveimg.bmp" alt="archive" /></a></li>
				<li id="index"><a href="/archive/archive.php"><img src="/assets/menu/index.png" alt="archive" /></a></li>
						
				</ul>

</div>


</div>



