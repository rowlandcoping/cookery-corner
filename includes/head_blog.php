<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		$baseurl="https://cookery-corner.co.uk/blog/";
		echo "<link rel=\"canonical\" href=\"".$baseurl.$post['slug']."\">";
	?>
	<title>
		Cookery Corner - Rowland's Blog - 
		<?php
			echo $post['title'];
		?>
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/styles/css/universal.css">
	<link rel="stylesheet" type="text/css" href="/styles/css/blog.css">
</head>

<body>
	<header>
		<div class="title">
			<banner class="section-banner">
				<img src="/assets/banners/bloglogo.png" alt="Rowland's Blog">
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

