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
                                <img src="/assets/images/liveblog/20230505_163652.jpg" width="350">
                                <p>The amazing things you could do with that penny...</p>
                            </div>
                            <div class="blogentry">
                                <h1>Doing Shopping</h1>
                                <p>
                                Much of what I'm about to share probably isn't that popular on Tik-Tok.  But keep in mind most influencers live at home with their Mum and/or Dad and/or Other.  They don't have to deal with what you have to deal with.  They live in pampered luxury in fact.
                                </p>
                                <p>
                                Also, supermarkets are cut-throat opportunitsts, super keen to make bad deals look good in order to shift their profit margins.  Inflation, shrink-flation, yellow label and other chicanery abounds.
                                </p>
                                <p>
                                There are also some general shopping principles that it's wise to stick to.  Good job I'm here really, isn't it.
                                </p>
                            </div>                          
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/equipment.php"><h3>&#60;&#60; EQUIP</h3></a></div>
                            <div class="centre-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/helpful-hacks.php"><h3>HACKS &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                        <div class="blogcont">
                            <div class="blogentry">
                                <div class="segment">
                                    <h2>Preparation</h2>
                                    <h3>Make a List</h3>
                                    <p>Here's the thing.  In the average student fridge you will have a miniscule sliver of shelf-space. You might have your own cupboard but you'll be amazed how quickly it fills.</p>
                                    <p>So your various Tik-Tok memes where you come home with a pineapple and half a cow won't cut it here.  You're going to have to down-scale your ambitions.</p>
                                    <p>Think about what you want to cook before you leave the house, and only buy the stuff you need to cook it.  That is all.</p>
                                    <h3>Don't Shop Hungry</h3>
                                    <p>This is true.  But if you're anything like me you've put off shopping all day, you're utterly starving, and are staring at the shelves with no idea what you actually want to eat.</p>
                                    <p>Look at this one as more of an aspiration.</p>
                                    <h3>The Basket Rule</h3>
                                    <p>Unless you are one of the lucky ones who has a housemate with a car (or you ARE the housemate with the car, still better), then I have a simple rule of thumb for you.</p>
                                    <p>Use a basket.  If you buy more that you can fit in a basket, you won't be able to carry it home.  I learned this the hard way when I was a student (funny story).</p>
                                    <p>As ever, you are welcome.</p>
                                    <h3>Shop Around</h3>
                                    <p>Don't be afraid to do this.  You'll learn which places are better depending on what you need.  Brand loyalty is for suckers.</p>
                                </div>
                                <div class="segment">
                                    <h2>Making Purchases</h2>
                                    <h3>Price Per Kilo/Litre</h3>
                                    <p>Supermarkets will try to make you think things are value for money when they are not. Some amazing looking offers really aren't. This is known as supermarkets being total bastards.</p>
                                    <p>The trick is don't just look at the price, look at the weight or volume as well.  Supermarkets legally have to show the the price per kilo or price per item, or whatever.</p>
                                    <p>Most people ignore it because they don't have the benefit of this guide. This is how you beat shrink-flation.</p>
                                    <p>Yet again, you're welcome.</p>
                                    <p><em>NB: This is especially important when buying cheese.</em></p>
                                    <h3>Loyalty Cards/Apps</h3>
                                    <p>Some supermarkets insist on these to get the best deals, so that they can sell all your lovely juicy data (the bastards).  Always make sure at least one person present has one.</p>
                                    <p><em>NB: If you really don't have one, or your phone is dead, or whatever, then it never hurts to ask a nearby friendly stranger if they'd like some free loyalty points.  They never say no.  And that REALLY screws with the algorithms.  Heh heh.</em></p>
                                    <h3>Buy Stuff on Offer</h3>
                                    <p>For all my insistance on planning, sometimes reduced items are too good to refuse.  This is what your freezer is for (assuming it's not already full of God Knows What). HOWEVER not all offers are good offers.</p>
                                    <ul>
                                        <li>NEVER pay more than about £1.50 for a ready-meal or pizza.</li>
                                        <li>Never buy coffee at full price.  Nescafe Azera, for example, will always be on offer somewhere. Same goes for Lurpack.</li>
                                        <li>Sometimes the reduced item isn't actually the best value for money (see image), even for the same item.  ALWAYS check the price per kilo/litre.</li>
                                        <li>Because a price is on a yellow background, it doesn't actually always mean it's on offer.  This is because supermarkets are bastards.</li>
                                    </ul>                            
                                    <h3>Avoid Branded Products</h3>
                                    <p>I used to be a sucker for this. Heinz beans and ketchup, Hellman's mayo, etc.  I was wrong.  I may produce a feature on this one day, if I can be bothered, but in the meantime here are some examples.</p>
                                    <ul>
                                        <li>Morrisson's ketchup is in many ways better than the OG. Sainsbury's is also good.  Tesco is NOT.</li>
                                        <li>Morrisson's Hash Browns and Potato Waffles are not only a third of the price of McCain's, they're actually significantly better. Don't buy McCain's anything.</li>
                                        <li>Birdseye peas.  Why???</li>
                                        <li>Do not buy branded oats.  Ever. Just buy the cheapest oats possible.  It's all just 100% oats. I mean seriously.</li>
                                        <li>Lidl Mayonnaise (Batts) is the business.  Anecdotally Morrisson's is pretty good too.</li>
                                        <li>The Lidl fake Magnums are incredible value for money.</li>
                                        <li>Tesco Beans are excellent.</li>
                                        <li>Lurpack may taste great but it's an such an unholy rip-off (as is butter in general). Learn to live without it.</li>
                                    </ul>
                                    <h3>Keep Track of What You're Spending</h3>
                                    <p>Even with the best of intentions, things can mount up.  Make sure you know roughly how much you're spending.  Keep a mental tally.  Budget, even.  Aim for a max of about £1.50-£2.00 per portion.  Most meals should be less. You'll get better at this the more you do it.</p>
                                </div>
                            </div>
                        </div>
                        <div class="linethin"></div>
                        <div class="nav-container">
                            <div class="left-nav-button"><a href="/student-cookery-guide/equipment.php"><h3>&#60;&#60; EQUIP</h3></a></div>
                            <div class="centre-nav-button"><a href="/student-cookery-guide.php"><h3>HOME</h3></a></div>
                            <div class="right-nav-button"><a href="/student-cookery-guide/helpful-hacks.php"><h3>HACKS &#62;&#62;</h3></a></div>
                        </div>
                        <div class="linethin"></div>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>