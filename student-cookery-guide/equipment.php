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
					<!--this one is just a series of boxes maybe add expandable comments for each review-->	
					<div id="content-container">
                        <div class="blogcont">
                            <!--intro-->
                            <div class ="blogimgright">
                                <img src="/assets/images/equipment.webp" width="350">
                                <p>The real thing was so much worse than this stock image.</p>
                            </div>
                            <div class="blogentry">
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
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide.php"><h3>&#60;&#60; HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/shopping.php"><h3>SHOPS &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                        <div class="blogcont feature-segment">
                            <div class="blogentry">
                                <div class="segment">
                                    <h2>Essentials</h2>
                                    <h3>A Knife</h3>
                                    <p>Aside from chopping, a knife can squish things like garlic, carve meat and slice bread.</p>
                                    <p>Given you will probably only have one knife, at least to start with, I'd go for a chef's knife but with a serrated edge.  It stays sharp longer, goes through anything and can double up to slice bread and stuff.</p>
                                    <p>It can also go through a finger with enough force so do be careful won't you.</p>
                                    <h3>Frying Pan</h3>
                                    <p>You ought to be able to cook pretty much anything in a frying pan.</p>
                                    <p>I recommend a large, deep, cheap non-stick one (the non-stick will last about a week whatever you spend).  If you can get one with a lid that is ovenable so much the better.  
                                    <p><em>NB: Do make sure that anything you put in the oven does not have plastic handles or such like.  You'll have to trust me on this one.</em></p>
                                    <h3>Baking Pan (metal)</h3>
                                    <p>Essential for heating oven chips or chicken dippers.  Or putting anything in the oven really.</p>
                                    <p>I recommend the pan over a flat tray - you can still do chips and stuff in it but you can also do so much more. You'll see</p>
                                    <h3>Fork</h3>
                                    <p>You need at least one fork.  It might even be a good idea to have more than one.</p>
                                    <p>As well as eating you can use it to prod or stir or turn stuff, to mash potatoes, or actually more or less anything else you can think of.</p>
                                    <p>If all else fails, use a fork. I know, right!  You're welcome.</p>
                                    <p><em>NB: great as a fork is, it doesn't really work for soup...</em></p>
                                    <h3>Mug</h3>
                                    <p>A mug can be used to drink tea, or coffee, or water, or vodka and coke.  This ought to be enough.</p>
                                    <p>However, combined with a microwave it can be used to make scrambled eggs, heat a mug of beans or peas or soup or... well you know.</p>
                                    <p>Mugs are the best. Treasure them.</p>
                                    <h3>Plate</h3>
                                    <p>If you'd rather not scratch your pan up by eating from it with your fork, you can put your food on one of these.</p>
                                    <p>You can also use your plate as a chopping board (albeit an unsatisfactory one on account of it not being flat and all).</p>
                                    <p>But you know what you're a student, you don't need luxuries like chopping boards.  You already spent all your money on <s>beer and drugs</s> academic textbooks, after all.</p>
                                    <h3>Tea-Towel</h3>
                                    <p>Speaking of decadent, what's this doing in the essentials section?  I know.  But a tea towel is very useful.</p>
                                    <p>Most obviously in the rare event any washing up is done.  But also it can double as an oven glove, and has many supplemental utilities in the field of last-minute fancy dress.  You'll see.</p>
                                </div>
                                <div class="segment">
                                    <h2>Nice to Haves</h2>
                                    <h3>Full set of Cutlery</h3>
                                    <p>Adding a knife and spoon to your fork opens up a whole new world of possibilities.  Try it!</p>
                                    <h3>Chopping Board</h3>
                                    <p>The more chopping you do, the more glad you will be to own one of these.  Can also be used to protect surfaces from hot pans (unless it's plastic and the pan is very, very very hot indeed. Like on fire.)</p>
                                    <h3>Saucepan</h3>
                                    <p>From boiling eggs to cooking pasta, a saucepan can be used in all sorts of ways.  OK so you're a student.  Boiling eggs and cooking pasta.  Or vegetables I guess.  Vegetables. Hahahahahaha.</p>
                                    <p>Anyway. Aim to get one with a lid to increase it's utility.  You can use the lid to drain water, or steam stuff.</p>
                                    <p><em>NB: I am assuming here that you have a microwave.  If you don't, then believe it or not the saucepan does all the things you would normally use a microwave for, just a bit more slowly.  Incredible, am I right?</em></p>
                                    <h3>Bowl</h3>
                                    <p>I was very close to putting this in the essentials, but in the end you can at a push use your mug for most of the stuff a bowl does.</p>
                                    <p>It excels at containing liquids, or baked beans, or leftovers, or such like. Used in conjunction with a microwave and cling-film all sorts of magic can happen.</p>
                                    <h3>Cling Film</h3>
                                    <p>Student fridges are horrendous places.  In order to protect your food, wrap it in cling film.</p>
                                    <p>Wrap bowls of leftovers in cling film to both protect and contain (Still be sure to store them upright though.  Come on now.).</p>
                                    <p>If you microwave something in your mug or bowl, cover it with cling film to stop it going everywhere.</p>
                                    <p>If you freeze something, wrap it in cling film.</p>
                                    <p>Going to a fancy dress party?  Wear cling film.  Believe me there is always one.</p>
                                    <h3>Spatula/Wooden Spoon</h3>
                                    <p>A spatula is useful for prodding or poking food.  If you get a flat one, and you can flip things over with it like fried eggs.</p>
                                    <p><em>NB: If you get a plastic one, your cheap frying pan might even last longer than a week.</em></p>
                                    <h3>Sandwich Toaster</h3>
                                    <p>This narrowly misses the essentials section because there is a chance one of your housemates will have one. If they don't, you have to work together to get one.  Urgently.</p>
                                    <p>I am a fierce advocate of the Breville Cafe-Style Sandwich Press. Get one. You won't be disappointed.</p>
                                    <h3>Tin Opener</h3>
                                    <p>Although no longer an essential, you will find that some of the cheaper supermarket own brand stuff still needs one of these.  Notably Lidl Tuna.</p>
                                    <p><em>NB:  In the likely event you don't have one of these when you need it, it might seem like your knife is a superb alternative.  Using your good kitchen knife in such a way is a bad idea.  Although it may work (assuming no serious injury occurs), your knife will never be the same again and you will forever curse the day.</em></p>
                                    <h3>Toaster</h3>
                                    <p>Somebody probably needs to get hold of one of these.</p>
                                    <p>You will likely have some sort of grill element to your cooker, but in the fast-paced no-holds-barred cut-throat environment of a student kitchen this item means you can have precious toast ready in an instant, no matter who is using the oven.</p>
                                    <h3>Tupperware Container</h3>
                                    <p>Can efficiently contain anything. Allows stacking of otherwise squidgy items. Can be frozen or microwaved and double as bowl. Crikey!</p>
                                </div>
                                <div class="segment">
                                    <h2>Advanced Equipment</h2>
                                    <h3>Oven Gloves</h3>
                                    <p>For the student who is serious about heating food by convection.</p>
                                    <h3>Garlic Press</h3>
                                    <p>For the student who has no time for chopping garlic, but all the time in the world for the impossible task of cleaning the dried on garlic off their garlic press.</p>
                                    <h3>Colander</h3>
                                    <p>For the student who (a) has no lid with which to drain their pan and (b) prefers not to have too much added water in their pasta sauce.</p>
                                    <h3>Holey Spoon</h3>
                                    <p>This spoon will be with you all your life.  It can take food from one place and put it in another.  A bit like Jesus. The Holey Spoon.</p>
                                    <h3>Potato Masher</h3>
                                    <p>For the student who is too bourgeois to use a fork to mash potatoes.  Probably a third year.</p>
                                    <h3>Casserole Dish / Pie Dish / Other</h3>
                                    <p>More specialised ovenware.  For the most part your baking pan (above) will cover most eventualities, including essentials like lasagne.</p>
                                    <h3>Freezer Bags</h3>
                                    <p>These things are incredibly useful if you are batch cooking or bulk buying meat and freezing it. Trust me, you will swiftly tire of using cling-film in such cases.</p>
                                </div>
                            </div>
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide.php"><h3>&#60;&#60; HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/shopping.php"><h3>SHOPS &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>