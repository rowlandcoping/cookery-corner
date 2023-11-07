<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $baseurl="https://cookery-corner.co.uk/";
        if (!empty($post['title'])){	
            echo "<link rel=\"canonical\" href=\"".$baseurl."recipe/".$post['titslug']."\">";	
            } else { 
                if (!empty($_GET['search'])&&isset($_GET['pageno'])){
                    echo "<link rel=\"canonical\" href=\"".$baseurl."search/".$_GET['search']."?pageno=".$_GET['pageno']."\">";
                } else {
                    if (!empty($_GET['search'])){
                        echo "<link rel=\"canonical\" href=\"".$baseurl."search/".$_GET['search']."?pageno=1\">";
                    } else { 
                        if (!empty($postserv['serves'])&&isset($_GET['pageno'])){
                        echo "<link rel=\"canonical\" href=\"".$baseurl."servings/".$postserv['slug']."?pageno=".$_GET['pageno']."\">";
                    } else {
                        if (!empty($postserv['serves'])){
                            echo "<link rel=\"canonical\" href=\"".$baseurl."servings/".$postserv['slug']."?pageno=1\">";
                        } else {
                            if (!empty($postcom['complexity'])&&isset($_GET['pageno'])){
                                echo "<link rel=\"canonical\" href=\"".$baseurl."complexity/".$postcom['slug']."?pageno=".$_GET['pageno']."\">";
                            } else {
                                if (!empty($postcom['complexity'])){
                                    echo "<link rel=\"canonical\" href=\"".$baseurl."complexity/".$postcom['slug']."?pageno=1\">";
                                } else {
                                    if (!empty($postcat['category'])&&isset($_GET['pageno'])){
                                        echo "<link rel=\"canonical\" href=\"".$baseurl."category/".$postcat['slug']."?pageno=".$_GET['pageno']."\">";
                                    } else {
                                        if (!empty($postcat['category'])){
                                            echo "<link rel=\"canonical\" href=\"".$baseurl."category/".$postcat['slug']."?pageno=1\">";
                                        } else {
                                            if (!empty($postcuis['cuisine'])&&isset($_GET['pageno'])){
                                                echo "<link rel=\"canonical\" href=\"".$baseurl."cuisine/".$postcuis['slug']."?pageno=".$_GET['pageno']."\">";
                                            } else {
                                                if (!empty($postcuis['cuisine'])){
                                                    echo "<link rel=\"canonical\" href=\"".$baseurl."cuisine/".$postcuis['slug']."?pageno=1\">";
                                                } else {
                                                    if (!empty($postaut['name'])&&isset($_GET['pageno'])){
                                                        echo "<link rel=\"canonical\" href=\"".$baseurl."author/".$postaut['slug']."?pageno=".$_GET['pageno']."\">";
                                                    } else {
                                                        if (!empty($postaut['name'])){
                                                            echo "<link rel=\"canonical\" href=\"".$baseurl."author/".$postaut['slug']."?pageno=1\">";
                                                        } else {
                                                            if (!empty($posting['ingredient'])&&isset($_GET['pageno'])){
                                                                echo "<link rel=\"canonical\" href=\"".$baseurl."ingredient/".$posting['slug']."?pageno=".$_GET['pageno']."\">";
                                                            } else {
                                                                if (!empty($posting['ingredient'])) {
                                                                    echo "<link rel=\"canonical\" href=\"".$baseurl."ingredient/".$posting['slug']."?pageno=1\">";
                                                                } else {
                                                                    if (isset($_GET['pageno'])) {
                                                                        echo "<link rel=\"canonical\" href=\"https://cookery-corner.co.uk/recipes?pageno=".$_GET['pageno']."\">";
                                                                    } else {
                                                                        echo "<link rel=\"canonical\" href=\"https://cookery-corner.co.uk/recipes?pageno=1\">";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    ?>
    <title>Cookery Corner - 
        <?php
            if (!empty($post['title'])) {
                echo "Recipe of the Week - ".$post ['title'];
            } else {
                if (!empty($postserv['serves'])){
                    echo "Recipes Serving ".$postserv['serves']." People";
                } else {
                    if (!empty($postcom['complexity'])){
                        echo ucwords($postcom['complexity'])." Recipes";
                    } else {
                        if (!empty($postcat['category'])){
                            echo ucwords($postcat['category'])." Dishes";
                        } else {
                            if (!empty($postcuis['cuisine'])){
                                echo ucwords($postcuis['cuisine'])." Cuisine";
                            } else {
                                if (!empty($postaut['name'])){
                                    echo "Recipes by ".$postaut['name'];
                                } else {
                                    if (!empty($posting['ingredient'])){
                                        echo "Ingredient - ".ucwords($posting['ingredient']);
                                    } else {
                                        echo"Recipe of the Week";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/styles/css/universal.css">
    <link rel="stylesheet" type="text/css" href="/styles/css/recipes.css">
    <?php include ($analytics);	?>
</head>
<body>
    <header>
		<div class="title">
			<banner class="section-banner">
                <img src="/assets/banners/recipeweek.png" alt="Recipe of the Week (ish)">
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

