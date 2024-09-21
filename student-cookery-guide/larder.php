<?php session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	$config = "$path"."/config.php";
	$head = "$path"."/includes/head_features.php";
	$banner = "$path"."/includes/right_banner.php";
	$analytics = "$path"."/analytics.php"; 
    $doctype="$path"."/includes/doctype.php";
	$menu="$path"."/includes/menu.php";
	require_once($config);
?>

<!DOCTYPE html>
<html lang="en">
	<?php require_once($head); ?>
		<div class="page">
			<?php require_once($banner); ?>
			<div class="main">
                <div id="liveblog-container">
                    <div id="content-container">
					<!--this one is just a series of boxes maybe add expandable comments for each review-->	
                        <div class="blogcont">
                            <!--intro-->
                            <div class ="blogimgright">
                                <img src="/assets/images/bread.jpg" width="350">
                                <p>Some bread, yesterday.</p>
                            </div>
                            <div class="blogentry">
                                <h1>Cupboard Love</h1>
                                <p>
                                If you are to become a Cookery Expert like Rowland, who can knock delicious stuff up in a jiffy, then you need a basic larder.
                                </p>
                                <p>
                                I would use a Ready Steady Cook reference here (Percy Pepper and so on), but none of you will have the slightest idea what I'm on about. 
                                <p>
                                Hey ho. Crack on then eh?
                                </p>
                            </div>                            
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/helpful-hacks.php"><h3>&#60;&#60; HACKS</h3></a></div>
                            <div class="centre-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/student-recipes.php"><h3>RECIPES &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                        <div class="blogcont">
                            <div class="blogentry">
                                <div class="segment">
                                    <h2>Larder Basics</h2>
                                    <h3>Onions</h3>
                                    <p>Onions form a base for pretty much anything.  If you have onions, you're making a start on most recipes.  If you don't like onions I feel bad for you.</p>
                                    <h3>Garlic</h3>
                                    <p>Most ready meals and processed foods list garlic as an ingredient. This is because it provides instant flavour.</p>
                                    <p><em>NB: garlic can make your breath smell bad.  Although it is an outstanding ingredient, use it with caution, especially if you're just about to go out.</em></p>
                                    <h3>Pasta</h3>
                                    <p>You can cook pasta in 10 minutes.  Then you can add things to it.  Hey presto, you've done cooking. Always have pasta.</p>
                                    <h3>Tinned Tomatoes</h3>
                                    <p>In combination with pasta, onion, and one or more of the aforementioned herbs, if you have all these things on hand you basically have instant food.</p>
                                    <h3>Olive Oil</h3>
                                    <p>If you only have one oil, get some basic olive oil (not extra virgin).</p>
                                    <p>You can use it for frying (you don't need much), roasting, baking, making flatbread, or you can even use it as a dressing at a push.</p>
                                    <p>The Extra Virgin variety is really just for dressings.  I always put a bit in my pasta to add that lovely grassy flavour.</p>
                                    <h3>Bread</h3>
                                    <p>Bread begets toast.  It incorporates sandwiches and cheese on toast and toasties and many other toast base things.</p>
                                    <h3>I Can't Believe It's Not I Can't Believe It's Not Butter</h3>
                                    <p>Buy whatever cheap non-butter containing spread your supermarket has to offer.  Use in combination with toast or bread or crumpets or anything really.</p>
                                    <h3>Plain Flour</h3>
                                    <p>You can use this to make flatbread, basic sauces and thicken things like stews.  It might not seem like you need it now.  But you probably will.</p>
                                </div>
                                <div class="segment">
                                    <h2>Herbs and Spices</h2>
                                    <p>These are the little fellows that provide you with everything a Toby Carvery lacks - that's right, flavour!</p>
                                    <p>There are many, many of them, but here are some of the basics that you can use in almost any situation to make life better. </p>
                                    <p>As you try more ambitious recipes, you will learn more about what does and doesn't work together.  Hey presto, you can cook!</p>
                                    <p>Purchase dried herbs for your larder.  If you want to get fancy, buy them fresh for particular recipes.  If you think you're a gardener and want to brighten the place up a bit, you can even grow these in a pot on your window.</p>
                                    <p><em>NB: Growing herbs takes time, often weeks or months.  Plants often die in student houses. I would advise not to rely too hard on this method.</em></p>
                                    <h3>Black Pepper</h3>
                                    <p>Invest in a black pepper grinder and buy more black pepper corns to put in it when it runs out.  Use this in everything.</p>
                                    <p><em>NB: If you live in catered halls bring this with you to dinner, so you can make your food actually tastes of something.</em></p>
                                    <h3>Salt</h3>
                                    <p>Ideally use sea salt rather than pure msg. Either way, use this ingredient very sparingly.</p>
                                    <h3>Oregano</h3>
                                    <p>A strong, fragrent herb, it adds an extra layer of flavour to any tomato sauce and is also great with pretty much any roasted meat.</p>
                                    <h3>Basil</h3>
                                    <p>Adds a sweet, peppery, aniseedy flavour and is particularly excellent with any tomato based sauce.  Fresh basil also works great in salads.</p>
                                    <p><em>NB: Oregano and Basil are often found in combination in 'Mixed Herbs'.  You can chuck mixed herbs in about anything.</em></p>
                                    <h3>Cumin</h3>
                                    <p>Cumin is a spice which plays a important role in flavouring curries (could be said to be the taste of curry!).  You can add it to all sorts to add that warm, earthy flavour.</p>
                                    <p> It is also a key component in a lot of mexican cuisine, for example the fahita kits that cost about billion pounds for a small sachet and 4 tortillas are mostly cumin.</p>
                                    <h3>Paprika</h3>
                                    <p>Paprika is basically ground up red peppers, and is a splendid addition to most soups or stews.  I used to add it to chicken and mushroom pasta 'n' sauce to great effect.</p>
                                    <p>Even better is its sporty cousin smoked paprika, which adds a smokey chipolte flavour to your cooking - but use smoked paprika sparingly, less is more with this one.</p>
                                    <h3>Cayenne Pepper</h3>
                                    <p>Cayenne pepper adds heat to dishes along with a lovely smooth chilli flavour.  If you want to add a bit of spice it's the most delicious way of doing so.</p>
                                    <p>If you want more kick you can always pick up some hot chilli powder.</p>
                                </div>
                            </div>
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/helpful-hacks.php"><h3>&#60;&#60; HACKS</h3></a></div>
                            <div class="centre-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/student-recipes.php"><h3>RECIPES &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>