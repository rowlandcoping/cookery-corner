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
                    <div class="homecontent">
                        <div class="review">
                            <h2>Food Security</h2>
                            You will be sharing a fridge-space with strangers.  I want to prepare you for this.  Your food will no longer be totally secure.  The following, in my experience, are genuinely considered to be common property:
                                cheese
                                milk
                                eggs
                                bread
                                alcohol
                                any kind of spread
                            Anything else you leave in a communal area is also at risk.  Don't say I didn't warn you. It's not to say you won't get lucky and live in jolly harmony, it has been known.  
                            
                            <br>But either way you'll be happier not getting too attached or up-tight about that last bit of cheddar. If late night cheese theft happens to you, simply accept it as a fact of life and move on with a light heart.
                            <br>Of course, this brutal reality doesn't mean that there aren't ways of counteracting the attention of drunken fridge raiders.
                            
                            <h3>Keep All Your Food Together</h3>
                            What I tended to do was cling-film anything that's been opened, put all of my own food in the fridge in a plastic bag, and knot that plastic bag to prohibit easy access.  
                            It's like the tale about the two men outrunning the lion - it's not the lion you have to out-run, it's the other guy. The less obvious and accessible your cheese is, the more likely the 3am drunk will turn their attention elsewhere. 
                            <br>NB: When executing this strategy, be sure to keep things upright that need to be kept upright (ie liquid or semi-liquid things).  But then you know this.
                            <h3>Buy/Cook Stuff Only You Like</h3>
                            Over the years I've found this to be tremendously effective.  Keep note of the most likely theif's likes and dislikes.  Buy the stuff they hate.
                            <h3>Don't Put Everything in the Fridge.</h3>
                            Things like eggs and bread, not to mention veg like potatoes and onions don't need to be in the fridge.  If you find they are going missing, they don't even need to be in the kitchen. Same goes for beer.  Don't leave these high value items lying around.
                            <br>NB: Don't keep eggs on top of the radiator in your room.  You're not trying to hatch them.
                            
                            <h2>Other Advice</h2>
                            <h3>Batch Cook</h3>
                            Cooking for one can be an endless chore, but it's much easier if you cook once and then microwave all week.  I do this even now. Stuff like bolognese is great for this.  It'll keep (covered) in the fridge for about a week, assuming nobody steals it or leaves the fridge door open.
                            <br>NB don't leave the fridge door open.  Whilst modern fridges are very good they are not powerful enough to chill an entire building or city.  Mould will ensue.
                            <h3>Cook with Friends</h3>
                            Assuming you have friends or flat-mates who are interested in cooking, maybe you could set aside a day a week where you take turns?
                            <br>In my experience this sort of arrangement tends to break down awfully quickly, but you got to try right?                            
                            <h3>Plan for Laziness</h3>
                            Always have something on hand for those days when you just can't be bothered.  Pasta 'n' sauce, packet noodles, jars of pesto, emergency leftovers, cheap frozen pizza, or even just bread you can toast and drop beans on.  If cooking is a chore, don't cook.  Life is too short and your student years are even shorter.
                            <br>NB: If all else fails you can always have spaghetti and gravy.  It's not as bad as it sounds.
                            <h3>Don't Run Out of Things</h3>
                            Keep track of the basic essentials in your larder (I mean cupboard or shelf obviously, no student has a larder).  Add them to a list of things you need to buy.  Buy them when you shop.
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>