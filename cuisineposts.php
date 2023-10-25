<?php if(!isset($_SESSION)){session_start();}
$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$process = "$path"."/includes/cuisine_process.php";
$head = "$path"."/includes/head_recipes.php";
$latest = "$path"."/includes/latest.php";
$search = "$path"."/includes/search.php";
$banner = "$path"."/includes/right_banner.php";
$analytics = "$path"."/analytics.php";
$doctype="$path"."/includes/doctype.php";
$pagination="$path"."/includes/pagination.php";

require_once($config);
require_once($doctype);
require_once($process);
if (isset($_GET['post-slug'])) {$postcuis = getPost($_GET['post-slug']);	}
require_once($head);
?>
<body>
<div class="page">
<?php require_once($banner);?>
<div class="maingen">
	
<div class="general">

<div class="imgright">

<?php
$cuisine= $postcuis['cuisine'];
$servings=$conn->prepare("SELECT rec_image FROM recipes WHERE cuisine=? AND live=1 ORDER BY RAND() LIMIT 1");
$servings->bind_param("s", $cuisine);
$servings->execute();
$servim=$servings->get_result();
$resultat = $servim->fetch_assoc();

echo "<p><img src=\"/assets/images/recipes/".$resultat['rec_image']."\"/></p>";
?>

</div>

<div class="gentext">
<h1>
<?php
echo ($cuisine);
?>
 Cuisine</h1>
<?php
if (empty($postcuis['description'])) {
echo
"<p>Here's some extremely interesting text telling you about how great ".$cuisine. " cuisine is but without actually
going into any detail about what is so amazing about ".$cuisine." food in particular.
<p>This is on the grounds I have no idea what type of food I'm supposed to be referring to as yet. 
There's a lot of this sort of stuff on the internet though, so I reckon nobody will notice.</p>
<p>Because this is a generic placeholder, you'll have to trust me when I say that ".$cuisine." food is really tasty, 
and accept any recipes you find on this page as excellent examples of why.</p>
<p>This will do until the next update in about 5 years, don't you think?</p>";

}else{
echo $postcuis['description'];
}
?>

<form method="get" action="/search.php">


 <p>Search for recipe:
  <input type="text" name="search" required/>
  <input type="submit" value="search" /></p>
  
</form>

</div>
</div>
<?php

//section for cuisine listing

$divbartext= $cuisine." recipes";
$divbartextsing = $cuisine." recipe";
$pagenolink= "/cuisine/".$_GET['post-slug'];
$cuisine= $postcuis['cuisine'];
$total_pages_sql = "SELECT COUNT(*) FROM recipes WHERE live=1 and cuisine='$cuisine'";
$total_pages = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($total_pages)[0];

include($pagination);

sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);



?>

<div class="first">
	
<?php
$results=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE cuisine=? AND live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
$results->bind_param("s", $cuisine);
$results->execute();				
$outcoms=$results->get_result();

foreach ($outcoms as $next) {

    displaypages($next);
}

?>

</div>



<?php
pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages);
?>
</div>
</div>
</div>
</div>


<?php
include ($analytics);
?>

</body>
</html>
