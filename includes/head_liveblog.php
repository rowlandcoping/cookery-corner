<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		$baseurl="https://cookery-corner.co.uk/liveblog/";
		echo "<link rel=\"canonical\" href=\"".$baseurl.$post['slug']."\"/>";
	?>
	<title>Cookery Corner - Live Blog - 
		<?php
			echo $post ['title']
		?>
	</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/styles/css/universal.css" />
	<link rel="stylesheet" type="text/css" href="/styles/css/liveblog.css" />
	<style type="text/css">
		<?php
			echo "
				body {"
			;
			if (!empty ($post['body_background'])) {
				echo "background-image: url(/assets/backgrounds/liveblog/".$post['body_background'].")";
			} else {
				echo "background-color: ".$post['body_color'];
			}
			echo ";color:".$post['text_color'].";
				}
				#liveblog-container {";
			if (!empty ($post['blog_background'])) {
				echo "background-image: url(/assets/backgrounds/liveblog/".$post['blog_background'].");";
			} else {
				echo "background-color: ".$post['blog_color'].";";
			}
			echo "}
				.blogcont, #history {"
            ;
            if (!empty ($post['textarea_background'])) {
                echo "background-image: url(/assets/backgrounds/liveblog/".$post['textarea_background'].");";
            } else {
                echo "background-color: ".$post['textarea_color'].";";
            }
            if ($post['bgtype']=="cover"){
                echo "background-size: cover;";
            }
            echo"}
				h2, h3, .user	{
					color: ".$post['h_color'].";
				}
				#liveblog-container a	{
					color:".$post['links_color'].";
				}
				#liveblog-container a:hover {
					color:".$post['hover_color'].";
				}
				#keywords {
					color:".$post['h_color'].";
				}"
			;
		?>
	</style>
    <?php include ($analytics);	?>
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

