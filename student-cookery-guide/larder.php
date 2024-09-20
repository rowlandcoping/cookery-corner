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
				<div class="container">	
					<!--this one is just a series of boxes maybe add expandable comments for each review-->	
					<div class="homecontent">
						<!--intro-->
						<div class ="fltright">
							<img src="/assets/images/equipment.webp" width="350">
							<p>The real thing was so much worse than this stock image.</p>
						</div>
						<div class="review">
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
                    <div class="homecontent">
                        <div class="review">
                        <h2>Larder Basics</h2>
                            <h3>Onions</h3>
                            Onions form a base for pretty much anything.  If you have onions, you're making a start on most recipes.  If you don't like onions I feel bad for you.
                            <h3>Garlic</h3>
                            Most ready meals and processed foods list garlic as an ingredient. This is because it provides instant flavour.
                            <br>NB: garlic can make your breath smell bad.  Like really bad. Although it is an outstanding ingredient, use it with caution, especially if you're likely to be in proximity of someone you have your eye on.
                            <h3>Pasta</h3>
                            You can cook pasta in 10 minutes.  Then you can add things to it.  Hey presto, you've done cooking. Always have pasta.
                            <h3>Tinned Tomatoes</h3>
                            In combination with pasta, onion, and one or more of the aforementioned herbs, if you have all these things on hand you basically have instant food.
                            <h3>Olive Oil</h3>
                            If you only have one oil, get some basic olive oil (not extra virgin).  You can use it for frying (you don't need much), roasting, baking, making flatbread, or you can even use it as a dressing at a push.
                            <br>The Extra Virgin variety is really just for dressings.  I always put a bit in my pasta to add that lovely grassy flavour.
                            <h3>Bread</h3>
                            Bread begats toast.  It incorporates sandwiches and cheese on toast and toasties and many other toast base things.
                            <h3>Eggs</h3>
                            It's always useful to have eggs about the place. You can boil, fry, scramble (in a microwave even) or poach (good luck with that) them.
                            <br>You can also make things like omlettes which are great.  Much like cheese, eggs make everything better.
                            <h3>I can't believe it's not I can't believe it's not butter</h3>
                            Buy whatever cheap non-butter containing spread your supermarket has to offer.  Use in combination with toast or bread or crumpets or anything really.
                            <h3>Plain Flour</h3>
                            You can use this to make flatbread, basic sauces and thicken things like stews.  It might not seem like you need it now.  But you probably will.
                            
                            
                            <h2>Herbs and Spices</h2>
                            These are the little fellows that provide you with everything a Toby Carvery lacks - that's right, flavour!  
                            <br>There are many, many of them, but here are some of the basics that you can use in almost any situation to make life better.  
                            <br>As you try more ambitious recipes, you will learn more about what does and doesn't work together.  Hey presto, you can cook!
                            <br>Purchase dried herbs for your larder.  If you want to get fancy, buy them fresh for particular recipes.  If you think you're a gardener and want to brighten the place up a bit, you can even grow these in a pot on your window.
                            <br>NB: Growing herbs takes time, often weeks or months.  Plants often die in student houses. I would advise not to rely too hard on this method.
                            <h3>Black Pepper</h3>
                            Invest in a black pepper grinder and put more black pepper corns in it when it runs out.  Use this in everything.
                            <br>As a first year, I had catered halls, but I brought one of these with me every night to dinner just so the food tasted of... something.
                            <br>Initially my cohort was sceptical, but soon they were all borrowing it!
                            <h3>Salt</h3>
                            Ideally use sea salt rather than pure msg. Either way, use this ingredient very sparingly.
                            <h3>Oregano</h3>
                            A strong, fragrent herb, it adds an extra layer of flavour to any tomato sauce and is also great with pretty much any roasted meat.
                            <h3>Basil</h3>
                            Adds a sweet, peppery, aniseedy flavour and is particularly excellent with any tomato based sauce.  Fresh basil also works great in salads.
                            <br>NB: Oregano and Basil are often found in combination in 'Mixed Herbs'.  You can chuck mixed herbs in about anything.
                            <h3>Cumin</h3>
                            Cumin is a spice which plays a important role in flavouring curries (could be said to be the taste of curry!).  You can add it to all sorts to add that warm, earthy flavour.
                            <br> It is also a key component in a lot of mexican cuisine, for example the fahita kits that cost about billion pounds for a small sachet and 4 tortillas are mostly cumin.
                            <h3>Paprika</h3>
                            Paprika is basically ground up red peppers, and is a splendid addition to most soups or stews.  I used to add it to chicken and mushroom pasta 'n' sauce to great effect.
                            <br>Even better is its sporty cousin smoked paprika, which adds a smokey chipolte flavour to your cooking - but use smoked paprika sparingly, less is more with this one.
                            <h3>Cayenne Pepper</h3>
                            Cayenne pepper adds heat to dishes along with a lovely smooth chilli flavour.  If you want to add a bit of spice it's the most delicious way of doing so.
                            <br>If you want more kick you can always pick up some hot chilli powder.
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>