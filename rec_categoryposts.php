<?php if(!isset($_SESSION)){session_start();}
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $process = "$path"."/includes/rec_category_process.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";
    $pagination="$path"."/includes/pagination.php";
    require_once($config);
    require_once($process);
    if (isset($_GET['post-slug'])) {
        $postcat = getPost($_GET['post-slug']);	
    }
    $category= $postcat['category'];
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="maingen">	
                <div class="general">
                    <h1><?php echo ($category); ?> Dishes</h1>
                    <div class="imgright">
                        <?php                            
                            $servings=$conn->prepare("SELECT rec_image FROM recipes WHERE category=? AND live=1 ORDER BY RAND() LIMIT 1");
                            $servings->bind_param("s", $category);
                            $servings->execute();
                            $servim=$servings->get_result();
                            $resultat = $servim->fetch_assoc();
                            echo "<img src=\"/assets/images/recipes/".$resultat['rec_image']."\"/>";
                        ?>
                    </div>
                    <div class="gentext">
                        <?php
                            if (empty($postcat['description'])) {
                                echo
                                    "<p>
                                    Here's the thing.  If you're reading text like this then it means I need to add a new field to the database.  In this case I've suddenly recognised:
                                    </p>
                                    <p>
                                        <strong>(i)</strong> The need for some text in this section and
                                    </p>
                                    <p>
                                        <strong>(ii)</strong> The utter futility of trying to cover off all possible categories in this section of the page, right now, with a series of 'if' statements. 
                                        (It's possible I might have done this elsewhere, in a hurry.  It will be recognisible by the shabbiness of the content. Not this bad, mind.)
                                    </p>
                                    <p>
                                        With this in mind, do not judge me.  Just look at all the lovely ".lcfirst($category)." dishes I've got for you.
                                        <br>What's that? Oh I know. But the <i>potential</i> is there, am I right?
                                    </p>"
                                ;
                            } else {
                                echo $postcat['description'];
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
                    //retrieves details of recipes with selected category for sortpages function to show how many there are.
                    $divbartext= "Recipes for ".lcfirst($category)." dishes";
                    $divbartextsing = "recipe for a ".lcfirst($category)." dish";
                    $pagenolink= "/category/".$_GET['post-slug'];
                    $total_pages_sql = "SELECT COUNT(*) FROM recipes WHERE live=1 and category='$category'";
                    $total_pages = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($total_pages)[0];
                    include($pagination);
                    sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);
                ?>
                <div class="first">                    
                    <?php
                        //displays recipes of selected category for current page
                        $serving=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE category=? AND live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
                        $serving->bind_param("s", $category);
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