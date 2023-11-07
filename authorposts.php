<?php if(!isset($_SESSION)){session_start();}
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $process = "$path"."/includes/author_process.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";
    $pagination="$path"."/includes/pagination.php";
    require_once($config);
    require_once($process);
    if (isset($_GET['post-slug'])) {
        $postaut = getPost($_GET['post-slug']);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="mainaut">	
                <div class="author">
                    <div class="profile">
                        <h2><?php echo $postaut['name']; ?></h2>
                        <h3><em><?php echo $postaut['food_pro']; ?></em></h3>
                        <?php
                            if (!empty($postaut['profile_pic'])) {
                                echo "<img class=\"segment\" src=\"/assets/images/profile/".$postaut['profile_pic']."\" width=\"250\">";
                            } else {
                                echo "<img src=\"/assets/images/testcard.jpeg\" width=\"250\">";
                            }
                        ?>
                    </div>
                    <hr id="author-divider">
                    <div class="autext">	
                        <h1>Author Profile</h1>
                        <?php
                            if (!empty($postaut['profile'])) {
                                echo $postaut['profile'];
                            } else {
                                echo "<p>"
                                        .$postaut['name']." has not got a profile yet - they are probably quite shy.
                                    </p>
                                    <p>
                                        See below for the fabulous recipes they have uploaded and let their food do the talking! 
                                    </p>
                                    <p>
                                        Or if you don't see anything you like, search away for more recipes.
                                    </p>"
                                ;
                            }
                        ?>
                        <hr>
                        <!--search bar for page - note current url needs to be pulled in for everything else to work-->
                        <form method="get" action="/search.php">
                            <p id="recipe-search">
                                Search for recipe: 
                            </p>
                            <input type="text" name="search" required/>
                            <input type="submit" value="search"/>
                        </form>	
                        <hr>
                    </div>
                </div>
                <?php
                    //set info to retrieve recipes by author
                    $divbartext= "Recipes by ".$postaut['name'];
                    $divbartextsing = "recipe by ".$postaut['name'];
                    $pagenolink="/author/".$_GET['post-slug'];
                    $user_ID= $postaut['ID'];
                    $total_pages_sql = "SELECT COUNT(*) FROM recipes WHERE live=1 and user_ID=$user_ID";
                    $total_pages = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($total_pages)[0];                            
                    include($pagination);
                    sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);
                ?>
            </div>
            <div class="first">
                <?php
                    //display recipes by author
                    $recipes=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE user_ID=? and live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
                    $recipes->bind_param("s", $user_ID);
                    $recipes->execute();				
                    $outcome=$recipes->get_result();
                    foreach ($outcome as $next) {                                    
                        displaypages($next);
                    }
                ?>
            </div>
            <?php
                //display navigation between pages                    
                pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages);
            ?>
        </div>
    </body>
</html>





