<div id="menu-main">
	<div id="menu-bar">
		<ul>
			<li>
				<a href="/index.php"><img src="/assets/menu/homeimg.bmp" alt="home"><img src="/assets/menu/home.png" alt="home"><img src="/assets/menu/secline.png"></a>
			</li>
			<li>
				<a href="/about.php"><img src="/assets/menu/aboutimg.bmp" alt="about"><img src="/assets/menu/about.png" alt="about"><img src="/assets/menu/secline.png"></a>
			</li>
			<li>
				<a href="/recipes.php"><img src="/assets/menu/recipeimg.bmp" alt="recipes"><img src="/assets/menu/recipe.png" alt="recipes"><img src="/assets/menu/secline.png"></a>
			</li>
			<li>
				<a href="/blog.php"><img src="/assets/menu/rowlandimg.bmp" alt="blog"><img src="/assets/menu/blog.png" alt="blog"><img src="/assets/menu/secline.png"></a>
			</li>
			<li>
				<a href="/reviews.php"><img src="/assets/menu/reviewsimg.bmp" alt="reviews"><img src="/assets/menu/reviews.png" alt="reviews"><img src="/assets/menu/secline.png"></a>
			</li>
			<!--
			<li>
				<a href="/holding.php"><img src="/assets/menu/forumimg.bmp" alt="forum"><img src="/assets/menu/forum.png" alt="forum"><img src="/assets/menu/secline.png"></a>
			</li>
			-->
			<li>
				<a href="/feedback/feedback190609.php"><img src="/assets/menu/contributeimg.bmp" alt="contact"><img src="/assets/menu/contact.png" alt="contact"><img src="/assets/menu/secline.png"></a>
			</li>
			<!--
			<li>
				<a href="/holding.php"><img src="/assets/menu/friendsimg.bmp" alt="links"><img src="/assets/menu/links.png" alt="links"><img src="/assets/menu/secline.png"></a>
			</li>
			-->
			<li class = "no-divline">
				<a href="/archive/archive.php"><img src="/assets/menu/archiveimg.bmp" alt="archive"><img src="/assets/menu/index.png" alt="archive"></a>
			</li>
		</ul>
	</div>
	<div id="log-info">
		<?php
			if (!isset($_SESSION['loggedin'])){
				echo "<p><a href =\"/publiclogin.php\">Log In</a></p>";
			} else{ 
				echo "<p><a class=\"logname\" href=\"/admin/admin.php\">".$_SESSION['name']."</a></p>";
				echo "<p><a href =\"/logout\">Log Out</a></p>";
			}
		?>
	</div>
</div>



