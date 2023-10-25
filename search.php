<?php if(!isset($_SESSION)){session_start();}

$path = $_SERVER['DOCUMENT_ROOT'];
$config = "$path"."/config.php";
$head = "$path"."/includes/head_recipes.php";
$search = "$path"."/includes/search.php";
$banner = "$path"."/includes/right_banner.php";
$analytics = "$path"."/analytics.php";
$doctype="$path"."/includes/doctype.php";
$pagination="$path"."/includes/pagination.php";

require_once($config); 
require_once($doctype);
if (isset($_GET['post-slug'])) {$post = getPost($_GET['post-slug']);}
require_once($head);
?>
<body>

<div class="page">
<?php require_once($banner);?>
<div class="maingen">
	
<div class="general">
<h1>Search Me</h1>

<p>If you don't like what you see, try again!
<br />But don't blame me, I can't do all this on my own you know.</p>
<p>Why not <a href="/register_user.php" target="_blank">register</a> and put your own recipes on, and join in the FUN?</p>

<form method="get" action="search.php">
 <p>Search for recipe:
  <input type="text" name="search" required/>
  <input type="submit" value="search"/></p>
  
</form>
</div>
<?php
// pull and display results from search if it is performed
if (isset($_GET['search'])) {
$search= "%".$_GET["search"]."%";

$searching = $conn->prepare("SELECT ID FROM recipes WHERE (user_name LIKE ? OR title LIKE ? OR complexity LIKE ? OR cuisine LIKE ? OR category LIKE ? OR keywords LIKE ?) 
						UNION SELECT recipe_ID FROM ing_index WHERE (ingredient LIKE ?) ORDER BY ID DESC"); 
$searching->bind_param("sssssss", $search, $search, $search, $search, $search, $search, $search);   
$searching ->execute();
$array = $searching->get_result();


$term= $_GET['search'];
$divbartext= "Search results for ".$term;
$divbartextsing = "search result for ".$term;
$pagenolink= "/search/".$term;

//set number of results
$total_rows = 0;
foreach ($array as $r) {
$stmt=$conn->prepare("SELECT ID FROM recipes where ID=? AND live=1");
$stmt->bind_param("s", $r['ID']);
$stmt->execute();
$number=$stmt->get_result();
$outcome=$number->fetch_assoc();
if (!empty($outcome)){$total_rows++;}
}

include($pagination);

if ($total_rows>0) {
	
sortpages($divbartext, $offset, $total_no, $total_rows, $divbartextsing);
}else{
echo "<div class=\"divbarempty\"><p>No results found</p></div>";}

echo "<div class=\"first\">";
$bogs=0;
foreach ($array as $r) {
	
$stmt=$conn->prepare("SELECT titslug, title, rec_image, description FROM recipes where ID=? AND live=1");
$stmt->bind_param("s", $r['ID']);
$stmt->execute();
$array=$stmt->get_result();
$next=$array->fetch_assoc();


	if (!empty($next)){	
$bogs++;
if (($bogs-1)<$offset) continue;

displaypages($next);  
    
if ($bogs==($no_of_records_per_page+$offset)) break;
}
}


echo "</div>";
pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages);
}

?>
</div>
</div>

