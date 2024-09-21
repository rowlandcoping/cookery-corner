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
                                <img src="/assets/images/batch.jpg" width="350">
                                <p>Yup, should be sorted for the week now!</p>
                            </div>
                            <div class="blogentry">
                                <h1>Helpful Hacks</h1>
                                <p>
                                This IS probably all on Tik-Tok already.  Screw Tik-Tok though.  You realise it's just another echo chamber right?  God I'm old.  Anyway.
                                </p>
                                <p>
                                Student life is different to what you've been used to. Duh. 
                                <p> 
                                Anyway, here's some tips that may or may not have already been shouted at you through a phone screen in 40 seconds. You're welcome??
                                </p>
                            </div>                            
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/shopping.php"><h3>&#60;&#60; SHOPS</h3></a></div>
                            <div class="centre-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/larder.php"><h3>LARDER &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                        <div class="blogcont">
                            <div class="blogentry">
                                <div class="segment">
                                    <h2>Food Security</h2>
                                    <p>You will be sharing a fridge-space with strangers.  I want to prepare you for this.  Your food will no longer be totally secure.  The following, in my experience, are genuinely considered to be common property:</p>
                                    <ul>
                                        <li>Cheese</li>
                                        <li>Milk</li> 
                                        <li>Eggs</li> 
                                        <li>Bread</li> 
                                        <li>Alcohol</li>
                                        <li>Actually any drink at all really</li>
                                        <li>Any kind of spread</li> 
                                    </ul> 
                                    <p>Anything else you leave in a communal area is also at risk.  Don't say I didn't warn you.</p>
                                    <p>Look, this is not to say you won't get lucky and live in jolly harmony, it has been known.</p>
                                    
                                    <p>But either way you'll be happier not getting too attached or up-tight about that last bit of cheddar. If late night cheese theft happens to you, simply accept it as a fact of life and move on with a light heart.</p>
                                    <p>Of course, this brutal reality doesn't mean that there aren't ways of counteracting the attention of drunken fridge raiders.  I'm here to help.</p>
                                    
                                    <h3>Keep All Your Food Together</h3>
                                    <p>Cling-film anything that's been opened, put all of your own food in the fridge in a plastic bag, and knot that plastic bag to prohibit easy access.  Obvioulsy this is a pain in the ass, but nothing is without a cost in life.</p>
                                    <p>Think of it like the old joke about two men being chased by a lion - it's not the lion you have to out-run, it's the other guy. The less obvious and accessible your cheese is, the more likely the 3am drunk will turn their attention elsewhere. </p>
                                    <p><em>NB: When executing this strategy, be sure to keep things upright that need to be kept upright (ie liquid or semi-liquid things).  But then you know this.</em></p>
                                    <h3>Buy/Cook Stuff Only You Like</h3>
                                    <p>Over the years I've found this to be tremendously effective.  Keep note of the likes and dislikes of the most likely theif.  Buy the stuff they hate.</p>
                                    <h3>Don't Put Everything in the Fridge.</h3>
                                    <p>Things like eggs and bread, not to mention veg like potatoes and onions don't need to be in the fridge (also consider this a top tip).</p> 
                                    <p>If you find they are going missing, they don't even need to be in the kitchen. Same goes for beer.  Don't leave these high value items lying around.</p>
                                    <p><em>NB: Don't keep eggs on top of the radiator in your room.  You're not trying to hatch them.
                                    <br>NNB: Lily, I know you don't like eggs.  But I would hate to waste the above one-liner, wouldn't you?</em></p>
                                </div>
                                <div class="segment">
                                    <h2>Other Advice</h2>
                                    <h3>Batch Cook</h3>
                                    <p>Cooking for one can be an endless chore, but it's much easier if you cook once and then microwave all week.  I do this even now.</p>
                                    <p>Stuff like bolognese is great for this.  It'll keep (covered) in the fridge for about a week, assuming nobody steals it or leaves the fridge door open.</p>
                                    <p><em>NB: don't leave the fridge door open.  Whilst modern fridges are very good they are not powerful enough to chill an entire building or city.  Mould will ensue.</em></p>
                                    <h3>Cook with Friends</h3>
                                    <p>Assuming you have friends or flat-mates who are interested in cooking, maybe you could set aside a day a week where you take turns?</p>
                                    <p>In my experience this sort of arrangement tends to break down awfully quickly, but you got to try right?</p>                        
                                    <h3>Plan for Laziness</h3>
                                    <p>Always have something on hand for those days when you just can't be bothered.</p>
                                    <p>Pasta 'n' sauce, packet noodles, jars of pesto, emergency leftovers, cheap frozen pizza, or even just bread you can toast and drop beans on.  If cooking is a chore, don't cook.  Life is too short and your student years are even shorter.</p>
                                    <p><em>NB: If all else fails you can always have spaghetti and gravy.  It's not as bad as it sounds.</em></p>
                                    <h3>Don't Run Out of Things</h3>
                                    <p>Keep track of the basic essentials in your larder (I mean cupboard or shelf obviously, no student has a larder). Add them to a list of things you need to buy.  Buy them when you shop.</p>
                                    <h3>Don't Put Anything Metal in a Microwave</h3>
                                    <p>Please don't put anything metal in a microwave.  Or anything that is alive for that matter.  Take my word for this.</p>
                                </div>
                            </div>
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/shopping.php"><h3>&#60;&#60; SHOPS</h3></a></div>
                            <div class="centre-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/larder.php"><h3>LARDER &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                    </div>                    
				</div>
			</div>
		</div>
	</body>
</html>