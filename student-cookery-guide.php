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
							<img src="/assets/images/students.jpg" width="350">
							<p>Ahhhhhhh students....</p>
						</div>
						<div class="review">
							<h1>Student Cookery Guide</h1>
							<p>
								We all know what being a student is all about.  It's about drinking and partying and exploring the limits of acceptable human behaviour.
							</p>
							<p>
								It's about drama and chaos, a journey of self-discovery.
							</p>
							<p>
								It's about accruing crippling debt, acquiring various STDs, and destroying your liver.
							</p>
							<p>
								BUT... at some point every student has to break up their busy day with eating something.  And the price of take-away these days, not to mention the likelihood of scurvey, it's probable that all students will at some point have to suck it up and do some actual cooking.
							</p>
                            <p>
								If that sounds difficult, then FEAR NOT!  Cookery Corner is here to save the day.  Read on, rosy faced future of our nation that you are.
                            </p>
						</div>
                        
					</div>
                    <div class="homecontent">
                        <div class="review">
                            <h2>Guide to the Guide</h2>
                            <h3><a href="/student-cookery-guide/equipment.php">Equipment</a></h3>
                            <em>It is known that you can't cook anything without the appropriate cooking stuff.</em>
                            <h3><a href="/student-cookery-guide/shopping.php">Shopping</a></h3>
                            <em>In order to begin cooking you first need things to cook.</em>
                            <h3><a href="/student-cookery-guide/helpful-hacks.php">Helpful Hacks</a></h3>
                            <em>Helpful advice to ignore, so that I can say 'I told you so' later.</em>
                            <h3><a href="/student-cookery-guide/larder.php">Your Larder</a></h3>
                            <em>There are certain things you should always keep on hand.</em>
                            <h3><a href="/student-cookery-guide/student-recipes.php">Recipes</a></h3>
                            <em>A bunch of simple recipes to get you started.  Feel free to add your own!</em>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>