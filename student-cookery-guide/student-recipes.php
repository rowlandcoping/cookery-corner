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
							<h1>Recipe Ideas</h1>
							<p>
                            Yeah, this is what you were waiting for.  Actual new content, that isn't just a thrown together mess, or a barely coherent wall of text.
                            </p>
							<p>
						    I've split these into categories, some of which are little more than guides, some already exist right here, and some have needed doing a while. 
							<p>
                            Some are highly self-indulgent.  Additionally I just realised there is not much here for vegetarians.  Honestly it's not really written for a vegetarian.
                            </p>
                            <p>
                            NB: Lily you'd tell me if you were vegetarian again, right?
                            </p>
						</div>
                        
					</div>
                    <div class="homecontent">
                        <div class="review">
                        <h2>Pasta Dishes</h2>
                            With pasta dishes if you are having leftovers I recommend re-heating the sauce bit and cooking the pasta you need as you go.
                            <br>Pasta is really not great re-heated.
                            <h3>Italian Sausage Pasta</h3>
                            So simple, and originally made using sausages from a lovely italian deli down my road.  Nowadays I just chuck anything in there.
                            <h3>Chicken and Bacon pasta</h3>
                            The chicken and bacon combo is great and it has a lovely smoky flavour.
                            <h3>Chicken with Lemon and Tarragon</h3>
                            Included largely because it is already on this website.
                            <h3>Pasta & Pesto</h3>
                            Pesto from a jar. Includes some handy variations to make your life better.
                            <h3>Spaghetti Bolognese</h3>
                            If you only take one thing away from this mess of a feature, make it this recipe.  I'll do lasagne too one day, promise.
                            <h2>Bread Based stuff</h2>
                            <h3>The Bacon Sandwich</h3>
                            My Favorite version of this, plus variations
                            <h3>Cheese on Toast</h3>
                            Did you know you can cook this in an air fryer?  I didn't, until my grill broke
                            <h3>Ham Cheese and Pickle</h3>
                            This is a rapid go-to sandwich that will change your life.
                            <h3>Beans on Toast</h3>
                            I'm including this on account of some useful methodology.
                                                      
                            
                            <h2>Other Dishes</h2>
                            <h3>Sausage Pie</h3>
                            A Saturday night special, handed down over generations, from back in the day when there were only four TV channels.  And when people actually watched TV for that matter.
                            <h3>Chilli</h3>
                            It's a very simple recipe really, but you could make it simpler by using a supermarket packet chilli mix rather than all the individual ones.  It won't be as good though.
                            <h3>Student Fahita Wraps</h3>
                            Using only the stuff in your <a href="/student-cookery-guide/larder.php">larder</a>, no more expensive fahita kits.
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>