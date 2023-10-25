
<?php
$pagination="$path"."/includes/pagination.php";

$divbartext= "Latest recipes";
$divbartextsing = "recipe online";
$itemsing= "";
$pagenolink= "/recipes";
$total_pages_sql = "SELECT COUNT(*) FROM recipes WHERE live=1";
$total_pages = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($total_pages)[0];

include($pagination);

sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);


?>
<div class="first">

<?php
//get latest recipes, to a max of 6
$latest=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
$latest->execute();				
$product=$latest->get_result();
$num_results = $product->num_rows; 
//$i=0;
foreach ($product as $next) {
		  
displaypages($next);
//if (++$i == 6) break;
}
?>
</div>
<?php
pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages);
?>


