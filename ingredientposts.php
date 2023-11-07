<?php if(!isset($_SESSION)){session_start();}
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $process = "$path"."/includes/ingredient_process.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";
    $pagination="$path"."/includes/pagination.php"; 
    require_once($config);
    require_once($process);
    if (isset($_GET['post-slug'])) {
        $posting = getPost($_GET['post-slug']);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="maingen">	
                <div class="general">
                    <h1><?php echo ucwords($posting['ingredient']); ?></h1>
                    <div class="imgright">
                        <?php
                            if (!empty($posting['ing_image'])) {
                                echo "<img src=\"/assets/images/ingredients/".$posting['ing_image']."\">";
                            } else {
                                $ID5= $posting['ID'];
                                $ingredients1=$conn->prepare("SELECT recipe_ID FROM ing_index WHERE ingredient_ID=? ORDER BY RAND()");
                                $ingredients1->bind_param("s", $ID5);
                                $ingredients1->execute();				
                                $outcomes=$ingredients1->get_result();
                                foreach($outcomes as $r){
                                    $ID3= $r['recipe_ID'];
                                    $excellent1=$conn->prepare("SELECT rec_image, live FROM recipes WHERE ID=?");
                                    $excellent1->bind_param("s", $ID3);
                                    $excellent1->execute();
                                    $outcome3=$excellent1->get_result();
                                    $res2 = $outcome3->fetch_assoc();
                                    if ($res2['live']!==0){
                                        echo "<img src=\"/assets/images/recipes/".$res2['rec_image']."\">";
                                        break;
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="gentext">
                        <?php
                            if (!empty($posting['information'])) {
                                echo $posting['information'];
                            } else {
                                echo
                                    "<p>
                                        I could talk a lot about ".$posting['ingredient']." here, but everybody knows what ".$posting['ingredient']." is, 
                                        so I'm not going to waste anyone's time telling them things about ".$posting['ingredient'].".
                                    </p>
                                    <p>
                                        So I'll just leave you with all the recipes involving ".$posting['ingredient'].".
                                    </p>
                                    <p>
                                        Next time...... tips on hair re-growth and how to make millions out of crypto.
                                    </p>"
                                ;
                            }
                        ?>
                    </div>
                    <hr>
                        <form method="get" action="/search.php">
                            <p id="recipe-search">
                                Search for recipe:
                            </p> 
                            <input type="text" name="search" required>
                            <input type="submit" value="search">                                           
                        </form>
                    <hr>
                </div>
                <?php
                    //stores details for sortpages function to show how many there are.
                    $divbartext= "Recipes containing ".$posting['ingredient'];
                    $divbartextsing = "recipe containing ".$posting['ingredient'];
                    $pagenolink= "/ingredient/".$_GET['post-slug'];
                    //create array of recipe IDs containing the ingredient
                    $ID= $posting['ID'];
                    $stmt=$conn->prepare("SELECT DISTINCT recipe_ID FROM ing_index WHERE ingredient_ID=? ORDER BY recipe_ID DESC");
                    $stmt->bind_param("s", $ID);
                    $stmt->execute();				
                    $array=$stmt->get_result();
                    //find number of results
                    $total_rows = 0;
                    foreach ($array as $r) {
                        $stmt=$conn->prepare("SELECT ID FROM recipes where ID=? AND live=1");
                        $stmt->bind_param("s", $r['recipe_ID']);
                        $stmt->execute();
                        $number=$stmt->get_result();
                        $outcome=$number->fetch_assoc();
                        if (!empty($outcome)){
                            $total_rows++;
                        }
                    }
                    include($pagination);
                    sortpages($divbartext, $offset, $total_no, $total_rows, $divbartextsing);
                ?>
                <div class="first">                    
                    <?php
                        //display recipes using array of recipe ids
                        $bogs=0;
                        foreach ($array as $r) {
                            $excellent=$conn->prepare("SELECT ID, title, titslug, rec_image, description FROM recipes WHERE live=1 AND ID=?");
                            $excellent->bind_param("s", $r['recipe_ID']);
                            $excellent->execute();				
                            $outcome2=$excellent->get_result();
                            $next=$outcome2->fetch_assoc();
                            if (!empty($next)) {
                                $bogs++;
                                if (($bogs-1)<$offset) {
                                    continue;
                                }                            
                                displaypages($next);
                                if ($bogs==($no_of_records_per_page+$offset)) {
                                    break;
                                }
                            }
                        }
                    ?>
                </div>
                <?php
                    //displays navigation for pagination
                    pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages);
                ?>
            </div>
        </div>
    </body>
</html>