<?php if(!isset($_SESSION)){session_start();}
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$process = "$path"."/includes/recipe_process.php";
$head = "$path"."/includes/head_recipes.php";
$latest = "$path"."/includes/latest.php";
$search = "$path"."/includes/search.php";
$banner = "$path"."/includes/right_banner.php";
$analytics = "$path"."/analytics.php";
$doctype="$path"."/includes/doctype.php";

require_once($config);
require_once($doctype);
require_once($process);
if (isset($_GET['post-slug'])) {$post = getPost($_GET['post-slug']);	}
require_once($head);
?>
<body>
<div class="page">
<?php require_once($banner);?>
<div class="main">
<div class="intro">

<?php 
if (empty($post)) {echo "<div class=\"introtext\"><h1>This recipe is no more!</h1>
	<p>Either it's been deleted, updated or for some reason google is still indexing pages from 10 years ago (It does that).</p>
	<p>In the meantime I hope you enjoy the various other bounties this site has to offer.</p>";
?>

<hr>
 <form method="get" action="/search.php">
 <br><h3>Search for another recipe:
  <input type="text" name="search" required/>
  <input type="submit" value="search"/></h3>
  
</form>

</div>
</div>


<?php
require($latest);
exit();
}


if ($post['live']=="0") {
	
	if ($_SESSION['role']!=="admin" & $_SESSION['ID']!=$post['user_ID']) {

echo "<div class=\"introtext\">
		<h1>".$post['title']."</h1><p>This recipe is not yet live.</p>
	<p>If you have created it and wish to see a preview, please <a href=\"/publiclogin.php\">log in</a> first.</p>";
?>	
<hr>
  <form method="get" action="/search.php">
 <br><h3>Search for another recipe:
  <input type="text" name="search" required/>
  <input type="submit" value="search"/></h3>
  
</form>
</div>
</div>


<?php
require($latest);
exit();
}}

?>

<div class="mainimage">
	<?php 
echo "<img src=\"/assets/images/recipes/".$post['rec_image']."\"/></div>"; 
?>

<div class="introtext">

<h1>
<?php 
echo $post['title'];
?>
</h1>


<h3 class="user">
<?php
/*get author name & slug*/
$user_ID= $post['user_ID'];
$author = $conn->prepare("SELECT name, slug FROM users WHERE ID=? 
								LIMIT 1");
$author->bind_param("s", $user_ID);
$author->execute();				
$authres = $author->get_result();
$res = $authres->fetch_assoc();
$name= $res['name'];
$aslug= $res['slug'];

echo "<a href=\"/author/";
echo $aslug;
echo "\"class=\"auth\">";
echo $name;
echo "</a>";
?>	
</h3>
<hr />
<div class="second">
	
	
<ul class="introbar">

<li id="logserv"><img src="/assets/logos/knifork.jpg" /></li>
<li id="serves">
<?php
$serves= $post['serves'];
$serveno = $conn->prepare("SELECT slug FROM serves WHERE serves=? 
								LIMIT 1");
$serveno->bind_param("i", $serves);
$serveno->execute();				
$servres = $serveno->get_result();
$res2 = $servres->fetch_assoc();
$servslug= $res2['slug'];	
echo "<a href=\"/servings/";
echo $servslug;
echo "\">";
echo $serves;
echo "</a>";
?>
</li>

<li id="logcomp"><img src="/assets/logos/cog.jpg" /></li>
<li id="complexity">
<?php
$comp= $post['complexity'];
$compthough = $conn->prepare("SELECT slug FROM complexity WHERE complexity=? 
								LIMIT 1");
$compthough->bind_param("s", $comp);
$compthough->execute();				
$compres = $compthough->get_result();
$res3 = $compres->fetch_assoc();
$compslug= $res3['slug'];	
echo "<a href=\"/complexity/";
echo $compslug;
echo "\">";
echo $comp;
echo "</a>";
?>
</li>

<li id="logcat"><img src="/assets/logos/dnight.jpg" /></li>
<li id="category">
<?php
$categ= $post['category'];
$catthough = $conn->prepare("SELECT slug FROM recipe_category WHERE category=? 
								LIMIT 1");
$catthough->bind_param("s", $categ);
$catthough->execute();				
$catres = $catthough->get_result();
$resu4 = $catres->fetch_assoc();
$catslug= $resu4['slug'];	
echo "<a href=\"/category/";
echo $catslug;
echo "\">";
echo $categ;
echo "</a>";
?>
</li>

<li id="logcuis"><img src="/assets/logos/globe.jpg" /></li>
<li id="cuisine"><a href="">
<?php
$cuisine= $post['cuisine'];
$cuisthough = $conn->prepare("SELECT slug FROM cuisine WHERE cuisine=? 
								LIMIT 1");
$cuisthough ->bind_param("s", $cuisine);
$cuisthough ->execute();				
$cuires = $cuisthough ->get_result();
$resu5 = $cuires->fetch_assoc();
$cuislug= $resu5['slug'];	
echo "<a href=\"/cuisine/";
echo $cuislug;
echo "\">";
echo $cuisine;
echo "</a>";
?>
</a></li>

<li id="facebook"><a href=""><img src="/assets/logos/fbook.jpg" /></a></li>
<li id="twitter"><a href=""><img src="/assets/logos/twitter.jpg" /></a></li>
<li id="insta"><a href=""><img src="/assets/logos/insta.png" /></a></li>
</ul>



<hr />
<?php
echo $post ['intro'];
?>

<hr />
</div>

<div class="second">
	

<ul class="review">
<li id="user">User Rating:</li>
<li id="userrat">N/A</li>
<li id="rowland">Rowland Rating:</li>
<li id="rowrat">N/A</li>
</ul>

<hr />

<p class="rowland">
<b><i>Rowland says: </i></b>Well, nothing yet.</p>
</div>


</div>

</div>

<div class="segment">




<div class="ing">
<h2><b>Ingredients</b></h2>
<?php
//bring in ingredients
$stmt=$conn->prepare("SELECT quantity, ingredient, display_order, slug FROM ing_index WHERE recipe_ID=? ORDER BY display_order");
$stmt->bind_param("s", $post['ID']);
$stmt->execute();
$array=$stmt->get_result();

foreach($array as $r) 
{
echo "<p>- ";
echo $r['quantity'];
echo " ";
echo "<a href=\"/ingredient/";
echo $r['slug'];
echo "\">";
echo $r['ingredient'];
echo "</a></p>";
}
?>

<?php

if(!empty($post['add_ingred'])){
echo"<hr><h2>Notes</h2>".$post['add_ingred'];
}
?>



</div>
	

<div class="content">
<h3><b>
<?php
echo $post['step1_head'];
?>
</b></h3>

<?php
echo $post['step1_content'];
?>



<?php
//check for/display step 2
if (!empty ($post['step2_head'])){
echo "<hr>
<h3>

".$post['step2_head'].
"
</h3>


".$post['step2_content'];
}

if (!empty ($post['step3_head'])){
echo "<hr>
<h3>

".$post['step3_head'].
"
</h3>


".$post['step3_content'];
}

if (!empty ($post['step4_head'])){
echo "<hr>
<h3>

".$post['step4_head'].
"
</h3>


".$post['step4_content'];
}
?>
<hr>
<h3>Summary</h3>

<?php
echo $post['conclusion'];
?>
<form method="get" action="/search.php">
<hr>
 
 <br><h3>Search for another recipe:
  <input type="text" name="search" required/>
  <input type="submit" value="search"/></h3>
  
</form>
</div>
</div>


<?php

require($latest);
?>
</div>

</div>




</div>




<?php
include ($analytics);
?>


</body>


</html>
