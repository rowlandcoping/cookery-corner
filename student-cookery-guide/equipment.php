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
							<h1>Cookery Equipment</h1>
							<p>
								Cooking is very simple, but there are some basic items required to make the magic happen.
							</p>
							<p>
								Being mindful of student restrictions on storage space, I've attempted to reduce this list to the bare minimum.
							</p>
							<p>
								I've also included some optional luxury items and substitutions you can make for things you probably won't own that you're used to having at home.
                            </p>
						</div>
                        
					</div>
                    <div class="homecontent">
                        <div class="review">
                            <h2>Essentials</h2>
                            <h3><a href="/student-cookery-guide/equipment.php">A Knife</a></h3>
                            A half-decent knife ticks just about every box going. Ask any chef. Aside from more obvious chopping activity, your knife is also adept at squishing things like garlic, transferring stuff from chopping board to pan, removing meat from the bone, carving, and such like.
                            <br>  With all this in mind, and given you will probably only have one knife, at least to start with, I'd go for a chef's knife but with a serrated edge.  It stays sharp longer, goes through anything and can double up to slice bread and stuff.  It can also go through a finger with enough force so do be careful won't you.
                            <h3>Frying Pan</h3>
                            You ought to be able to cook pretty much anything in a frying pan. Stainless steel is great but it can be a bugger to clean, so I recommend a large, deep, cheap non-stick one (the non-stick will wear off after about a week whatever the brand).  If you can get one with a lid that is ovenable so much the better, it'll be all you ever need, but those tend to be a bit steep too.  
                            <br>With this in mind, to make sure that anything you put in the oven does not have plastic handles or such like.  You'll have to trust me when I tell you this does not ever end well.
                            <h3>Baking Dish (metal)</h3>
                            Essential for heating oven chips or chicken dippers.  Or putting anything in the oven really.  Rather than a flat tray I'd get a deeper one - you can still do chips but it's also great for more advanced stuff too.
                            <h3>Fork</h3>
                            You need at least one fork.  It might even be a good idea to have more than one.  You might know the fork as a simple eating tool.  In fact it's all you need really to eat anything.  However, the fork can also be used alongside your frying pan to stir or turn stuff, it can be used as a potato masher to squish up potatoes, on its side it can be used to cut more or less anything, or retrieve butter or such like from a tub.   It is also excellent at squidging stuff.  It is the do everything tool of the kitchen, in the absence of more specialist implements.  
                            <br>I know, right!  You're welcome.
                            <br>NB great as a fork is, it doesn't really work for soup, that is, if you're planning on eating a lot of soup..
                            <h3>Plate</h3>
                            Calling this an essential might be a stretch, since you can eat out of the pan after all (saves washing up).  However if you want to preserve your cheap frying pan's non-stick coating I recommend not doing this.  You can also use your plate as a chopping board (albeit an unsatisfactory one on account of it not being flat and all).
                            <br>But you know what you're a student, you don't need luxuries like chopping boards.  You just spent all your money on <s>beer and drugs</s> academic textbooks, after all.
                            <h3>Mug</h3>
                            A mug can be used to drink tea, or coffee, or water, or vodka and coke.  This ought to be enough.  However, combined with a microwave it can be used to make scrambled eggs, heat a mug of beans or peas or soup or.. well you know.  Mugs are the best.
                            <h3>Tea-Towel</h3>
                            Speaking of decadent, what's this doing in the essentials section?  I know.  But a tea towel is very useful.  Most obviously in the rare event any washing up is done.  But also it can double as an oven glove, and has many supplemental utilities in the field of last-minute fancy dress.  You'll see.

                            <h2>Nice to Haves</h2>
                            <h3>Full set of Cutlery</h3>
                            Adding a knife and spoon to your fork opens up a whole new world of possibilities.  Try it!
                            <h3>Chopping Board</h3>
                            The more chopping you do, the more glad you will be to own one of these.  Can also be used to protect surfaces from hot pans (unless it's plastic and the pan is very, very very hot indeed. Like on fire.)
                            <h3>Saucepan</h3>
                            From boiling eggs to cooking pasta, a saucepan can be used in all sorts of ways.  OK so you're a student.  Boiling eggs and cooking pasta.  Or vegetalbes I guess.  Vegetables. Hahahahahaha.  Anyway. Aim to get one with a lid to increase it's utility.  You can use the lid to drain water, or steam stuff.
                            <br>NB: I am assuming here that you have a microwave.  If you don't, then believe it or not the saucepan does all the things you would normally use a microwave for, just a bit more slowly.
                            <h3>Bowl</h3>
                            I was very close to putting this in the essentials, but in the end you can at a push use your mug for most of the stuff a bowl does.  It excels at containing liquids, or backed beans, or leftovers, or such like. Used in conjunction with a microwave and cling-film all sorts of magic can happen.  Speaking of which...
                            <h3>Cling Film</h3>
                            Student fridges are horrendous places.  In order to protect your food, wrap it in cling film.  Wrap bowls of leftovers in cling film to both protect and contain (Still be sure to store them upright though.  Come on now.).  If you microwave something in your mug or bowl, cover it with cling film to stop it going everywhere.  If you freeze something, wrap it in cling film.
                            <br>Going to a fancy dress party?  Wear cling film.  Believe me there is always one.
                            <h3>Spatula</h3>
                            A spatula is useful for prodding or poking food.  Get a flat one, and you can flip things over with it like fried eggs.  If you get a plastic one, your cheap frying pan might even last longer than a week.
                            <h3>Sandwich Toaster</h3>
                            This narrowly misses the essentials section because there is a chance one of your housemates will have one.  If they don't, you have to work together to get one.  Urgently.
                            <br>I am a fierce advocate of the Breville Cafe-Style Sandwich Press. It has simply incredible utility. You won't be disappointed.
                            <h3>Tin Opener</h3>
                            Although no longer an essential, you will find that some of the cheaper supermarket own brand stuff still needs one of these.  Notably Lidl Tuna.
                            <br>NB:  In the likely event you don't have one of these when you need it, it might seem like your knife is a superb alternative.  Using your good kitchen knife in such a way is a bad idea.  Although it may work (assuming no serious injury occurs), your knife will never be the same again and you will forever curse the day.
                            <h3>Toaster</h3>
                            Somebody probably needs to get hold of one of these.  You will likely have some sort of grill element in your cooker, but in the fast-paced no-holds-barred cut-throat environment of a student kitchen this item means you can have precious toast ready in an instant, no matter who is using the oven.
                            <h3>Tupperware Container</h3>
                            Can efficiently contain anything. Allows stacking of otherwise squidgy items. Can be frozen or microwaved and double as bowl. Crikey!

                            <h2>Advanced Equipment</h2>
                            <h3>Oven Gloves</h3>
                            For the student who is serious about heating food by convection.
                            <h3>Garlic Press</h3>
                            For the student who has no time for chopping garlic, but all the time in the world for the impossible task of cleaning the dried on garlic off their gardlic press.
                            <h3>Colander</h3>
                            For the student who (a) has no lid with which to drain their pan and (b) prefers not to have too much added water in their pasta sauce.
                            <h3>Holey Spoon</h3>
                            This spoon will be with you all your life.  The holey spoon.
                            <h3>Potato Masher</h3>
                            For the student who is too bourgeois to use a fork to mash potatoes.  Probably a third year.
                            <h3>Casserole Dish / Pie Dish / Other</h3>
                            More specialised ovenware.  For the most part your deep-sided baking dish (above) can cover most of these eventualities, including essentials like lasagne.
                            <h3>Freezer Bags</h3>
                            These things are incredibly useful if you are batch cooking or bulk buying meat and freezing it. Trust me, you will swiftly tire of using cling-film in such cases.
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>