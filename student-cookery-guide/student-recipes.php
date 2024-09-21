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
                                <img src="/assets/images/recipe.jpg" width="350">
                                <p>Actually I have no idea what I put in this.</p>
                            </div>
                            <div class="blogentry">
                                <h1>Recipe Ideas</h1>
                                <p>
                                Yeah, this is what you were waiting for.  Actual new content that isn't just a thrown together mess, or a barely coherent wall of text.
                                </p>
                                <p>
                                I've split these into categories, some of which are little more than guides, some already exist right here, and some have needed doing a while. 
                                <p>
                                Some are highly self-indulgent.  Additionally I just realised there is not much here for vegetarians.  Honestly it's not really written for a vegetarian.
                                </p>
                                <p><em>
                                NB: Lily, you'd tell me if you were vegetarian again, right?
                                </em></p>
                            </div>                            
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/larder.php"><h3>&#60;&#60; LARDER</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                        <div class="blogcont">
                            <div class="blogentry">
                                <div class="segment">
                                <h2>Pasta Dishes</h2>
                                    <p>With pasta dishes if you are having leftovers I recommend re-heating the sauce bit and cooking the pasta you need as you go.</p>
                                    <p>Pasta is really not great re-heated.</p>
                                    <h3><a href="/recipe/italian-sausage-pasta" target="_blank">Italian Sausage Pasta</a></h3>
                                    <p>So simple, and originally made using sausages from a lovely italian deli down my road.  Nowadays I just chuck anything in there.</p>
                                    <h3><a href="/recipe/chicken-bacon-and-tomato-pasta" target="_blank">Chicken and Bacon pasta</a></h3>
                                    <p>The chicken and bacon combo is great and it has a lovely smoky flavour.</p>
                                    <h3><a href="/recipe/chicken-with-lemon-and-tarragon" target="_blank">Chicken with Lemon and Tarragon</a></h3>
                                    <p>Included largely because it is already on this website.</p>
                                    <h3>Pasta & Pesto</h3> 
                                    <p>Pesto from a jar. Includes some handy variations to make your life better.</p>
                                    <h3>Spaghetti Bolognese</h3>
                                    <p>If you only take one thing away from this mess of a feature, make it this recipe.  I'll do lasagne too one day, promise.</p>
                                </div>
                                <div class="segment">
                                    <h2>Bread Based stuff</h2>
                                    <h3>The Bacon Sandwich</h3>
                                    <p>My Favorite version of this, plus variations.</p>
                                    <h3>Cheese on Toast</h3>
                                    <p>Did you know you can cook this in an air fryer?  I didn't, until my grill broke.</p>
                                    <h3>Ham Cheese and Pickle</h3>
                                    <p>This is a rapid go-to sandwich that will change your life.</p>
                                    <h3>Beans on Toast</h3>
                                    <p>I'm including this on account of some useful methodology.</p>
                                </div>
                                <div class="segment">
                                    <h2>Other Dishes</h2>
                                    <h3>Sausage Pie</h3>
                                    <p>A Saturday night special, handed down over generations, from back in the day when there were only four TV channels.  And when people actually watched TV for that matter.</p>
                                    <h3><a href="/recipe/chilli-con-carne" target="_blank">Chilli</a></h3>
                                    <p>It's a very simple recipe really, but you could make it simpler by using a supermarket packet chilli mix rather than all the individual ones.  It won't be near as good though.</p>
                                    <h3>Student Fajita Wraps</h3>
                                    <p>Using only the stuff in your <a href="/student-cookery-guide/larder.php" target="_blank">larder</a>! Say goodbye to expensive and rubbish fahita kits.</p>
                                    <h3>Tray Bake Thing</h3>
                                    <p>This is a regular go-to.  Take a cheap cut of chicken (or whatever), a load of veg, put it in the oven for a while, then eat it.</p>
                                </div>
                            </div>
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/larder.php"><h3>&#60;&#60; LARDER</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                    </div>                    
                </div>
			</div>
		</div>
	</body>
</html>