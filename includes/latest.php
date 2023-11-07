<?php
    $pagination="$path"."/includes/pagination.php";
    $divbartext= "Latest recipes";
    $divbartextsing = "recipe online";
    $itemsing= "";
    $pagenolink= "/recipes";
    //fetches the total number of results for the query (ie all recipes) to pass to pagination page and sortpages function.
    $total_results_sql = "SELECT COUNT(*) FROM recipes WHERE live=1";
    $total_results = mysqli_query($conn,$total_results_sql);
    $total_rows = mysqli_fetch_array($total_results)[0];
    include($pagination);
    sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);
?>
<div class="first">
    <?php
        //get latest recipes for current page, to a max of however many 'pagination.php' states
        $latest=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
        $latest->execute();				
        $product=$latest->get_result();
        $num_results = $product->num_rows;
        //displays latest recipes, top bar and bottom bar (if more than one page)
        foreach ($product as $next) {            
            displaypages($next);
        }
    ?>
</div>
<?php
    pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages);
?>


