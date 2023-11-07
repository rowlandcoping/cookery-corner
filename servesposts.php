<?php if(!isset($_SESSION)){session_start();}
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $process = "$path"."/includes/serves_process.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";
    $pagination="$path"."/includes/pagination.php";
    require_once($config);
    require_once($process);
    if (isset($_GET['post-slug'])) {
        $postserv = getPost($_GET['post-slug']);
    }
    $serves= $postserv['serves'];
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="maingen">	
                <div class="general">
                    <h1>Food for <?php echo $serves; ?></h1>
                    <div class="imgright">
                        <?php                    
                            $servings=$conn->prepare("SELECT rec_image FROM recipes WHERE serves=? AND live=1 ORDER BY RAND() LIMIT 1");
                            $servings->bind_param("s", $serves);
                            $servings->execute();
                            $servim=$servings->get_result();
                            $resultat = $servim->fetch_assoc();
                            echo "<p><img src=\"/assets/images/recipes/".$resultat['rec_image']."\"/></p>";
                        ?>
                    </div>
                    <div class="gentext">                        
                        <?php
                            if ($serves==1) {
                                echo 
                                    "<p>
                                        Eating alone doesn't have to be sad - often it's comfort food, stuff thrown together with all your favourite stuff.  Happiness is cheese on toast after all.
                                    </p>
                                    <p>
                                        There's nothing complicated about these recipes, but that doesn't mean there isn't anything special about them.
                                    </p>"
                                ;
                            }
                            if ($serves==2) {
                                echo 
                                    "<p>
                                        Tea for two? Two for tea? There's never a bad time for tea is there.  Or for two actually.
                                    </p>
                                    <p>
                                        Two is the best number for food.  It could be a romantic dinner, a nice brunch, or something random knocked together with a bit of love and care.
                                    </p>
                                    <p>
                                        Eating together is better.
                                    </p>"
                                ;
                            }
                            if ($serves>2 && $serves<7) {
                                echo
                                    "<p>
                                        If you manage to get all your family or enough friends sat in the same place these recipes may be of use.  Sometimes it can be stressful coming up with meal ideas, 
                                        but I always see it as an excuse to push the boat out.
                                    </p>
                                    <p>
                                        Whether it's whacking some meat in the oven, perfecting absolute classic staples, trying something new or pulling together whatever you can find in the cupboard, 
                                        there will be something here for you.  Eventually. 
                                    </p>"
                                ;
                            }
                            if ($serves>6 && $serves<11) {
                                echo 
                                    "<p>
                                        If you're cooking this much food one of 3 things is going on:
                                    </p>
                                    <p>
                                        <strong>1)</strong> You're batch cooking - so whether you live alone and you're lazy like Rowland, or you need something on hand when the kids start moaning, it's always a winning move.
                                    </p>
                                    <p>
                                        <strong>2)</strong> You have an absolutely enormous family.  If you have to cook this much food on a regular basis and you are not a professional chef, then I am truly sorry.
                                    </p>
                                    <p>
                                        <strong>3)</strong> You are having a food party of some sort.  How exciting!
                                    </p>
                                    <p>
                                        Whatever it is, I do hope I can help!
                                    </p>"
                                ;
                            }
                            if ($serves>10) {
                                echo 
                                    "<p>
                                        Are you having a wedding?  Congratulations!
                                    </p>
                                    <p>
                                        Either that or you run a restaurant, in which case you really must be desperate.  Or I GUESS extreme batch cooking, but even so wherever do you get a pan big enough??
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
                    //retrieves details of recipes with selected number of servings for sortpages function to show how many there are.
                    $divbartext= "Recipes serving ".$serves." people";
                    $divbartextsing = "recipe serving ".$serves." people";
                    $pagenolink= "/servings/".$_GET['post-slug'];
                    $total_pages_sql = "SELECT COUNT(*) FROM recipes WHERE live=1 and serves='$serves'";
                    $total_pages = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($total_pages)[0];
                    include($pagination);
                    sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);
                ?>
                <div class="first">	
                    <?php
                        //displays recipes of selected number of servings for current page
                        $serving=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE serves=? AND live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
                        $serving->bind_param("i", $serves);
                        $serving->execute();				
                        $outcome=$serving->get_result();
                        foreach ($outcome as $next) {
                            displaypages($next);
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