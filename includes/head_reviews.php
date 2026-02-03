<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		if (isset($_GET['post-slug'])) {
			$post = getPost($_GET['post-slug']);
			$baseurl="https://cookery-corner.co.uk/reviews/";
			echo "<link rel=\"canonical\" href=\"".$baseurl.$post['slug']."\"/>";
		} else {
			echo "<link rel=\"canonical\" href=\"https://cookery-corner.co.uk/reviews.php\"/>";
		}
	?>
	<title>Cookery Corner - Random Reviews
		<?php
			if (!empty($post['title'])) {
				echo " - ". $post ['title'];
			}
		?>
	</title>
	<link rel="stylesheet" type="text/css" href="/styles/css/universal.css" />
	<link rel="stylesheet" type="text/css" href="/styles/css/reviews.css" />
	<style type="text/css">
		<?php
			if(!empty($post['title'])) {
				echo "
					body {"
				;
				if (!empty ($post['page_background'])) {
					echo "background-image: url(/assets/backgrounds/reviews/".$post['page_background'].")";
				} else {
					echo "background-color: ".$post['page_color'];
				}
				echo ";
						color:".$post['border_text'].";>
					}
					.reviewbox-left, .reviewbox-right, .reviewbox {"
				;
				if (!empty ($post['text_background'])) {
					echo "background-image: url(/assets/backgrounds/reviews/".$post['text_background'].")";
				} else {
					echo "background-color: ".$post['textback_color'];
				}
				echo ";
						border-color:".$post['border_text'].";
					}
					.title {"
				;
				if ($post['title'] =="Useless Present Review" || $post['title']=="Present Review Feedback"){
					echo "background-image: url(/assets/backgrounds/snow.bmp)";
				}
				echo "}

					h2, h3 {
						color: ".$post['h2h3_color'].";
					}
					.reviewbox-left a, .reviewbox-right a, .reviewbox a {
						text-decoration: none;
						color:".$post['h2h3_color'].";
					}
					.reviewbox-left a:hover, .reviewbox-right a:hover, .reviewbox a:hover {
						text-decoration: none;
						color:".$post['border_text'].";
					}"
				;
			} else {
				echo "body {
					background-image: url(/assets/backgrounds/unicorn.jpeg);
					}"
				;
			}
		?>
	</style>
    <?php include ($analytics);	?>
</head>
<body>
	<header>
		<div class="title">
			<banner class="section-banner">
				<?php
					if (isset($post) && ($post['title'] =="Useless Present Review" || $post['title']=="Present Review Feedback")){
						echo "<img src=\"/assets/banners/Reviewsxmas.bmp\" alt=\"Random Reviews\" />";
					} else {
						echo "<img src=\"/assets/banners/reviewstitle.png\" alt=\"Random Reviews\" />";
					}
				?>
			</banner>
			<span class="banner">--Advertisement--</span>
			<banner class="title-bann">
				<a href="http://factstofiction.co.uk" target="_blank"><img src="/assets/banners/facts2fiction.png" alt="This banner contains a link for 'Facts to Fiction' featuring articles, fiction and sci-fi"></a> 
			</banner>
			<span class="banner">--Advertisement--</span>
		</div>
	</header>
	<nav>
		<?php include('includes/menu.php') ?>
	</nav>
