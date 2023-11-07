<?php session_start();
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $process = "$path"."/includes/complexity_process.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";
    $pagination="$path"."/includes/pagination.php";
    require_once($config);
    require_once($process);    
    if (isset($_GET['post-slug'])) {
        $postcom = getPost($_GET['post-slug']);	
    }
    $complex= $postcom['complexity'];   
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="maingen">	
                <div class="general">
                    <h1><?php echo ($complex); ?> Recipes</h1>
                    <div class="imgright">
                        <?php
                            $servings=$conn->prepare("SELECT rec_image FROM recipes WHERE complexity=? AND live=1 ORDER BY RAND() LIMIT 1");
                            $servings->bind_param("s", $complex);
                            $servings->execute();
                            $servim=$servings->get_result();
                            $resultat = $servim->fetch_assoc();
                            echo "<img src=\"/assets/images/recipes/".$resultat['rec_image']."\">";
                        ?>
                    </div>
                    <div class="gentext">                        
                        <?php
                            if ($complex==="Simple") {
                                echo
                                    "<p>
                                        Wham, bam, thank you mate! You want something quick and simple, ideally without having to get out of your pyjamas, right?
                                    Either that or you just can't handle too much going on at once.  I know the feeling.
                                    </p>
                                    <p>Just because you're not pushing the boat out doesn't mean you have to eat Pot Noodles though.  
                                    Not that I have anything against Pot Noodles.  Oh no.
                                    </p>"
                                ;
                            }
                            if ($complex==="Everyday") {
                                echo
                                "<p>
                                    Here is proof that to eat well does not mean you have to source vine leaves rolled on the hairy thighs of Greek maidens. 
                                </p>
                                <p>
                                    These recipes don't take too much work, but you can still eat well every day and have time left to watch Eastenders!
                                </p>
                                <p>
                                    Although being frank... 'Awww Pat, what have you daahhhnn to me Pat....' etc.
                                    <br>No seriously, I haven't watched it since Dennis died.
                                </p>";
                            }
                            if ($complex==="Date night") {
                                echo
                                    "<p>
                                        Sometimes knocking up a spag bol is not enough.  Sometimes food is about more than just eating.
                                    </p>
                                    <p>
                                        Sometimes, you've got to get some.
                                    </p>
                                    <p>
                                        These recipes are usually a bit more involved, and if you are cooking for that special someone 
                                        it might be best to do some of the prep ahead of time, lest they fall asleep before it's ready.
                                    </p>
                                    <p>
                                        In no way do I speak from experience.
                                    </p>"
                                ;
                            }
                            if ($complex==="Masterchef") {
                                echo
                                    "<p>
                                        And in the bluueeerr kichaaun we heerve Raaahlaaaand Cohhhhping... etc.
                                    </p>
                                    <p>
                                        I luv a bit aaaaf craamble, yeeees ahhhh do a <a href=\"https://www.youtube.com/watch?v=OMg3epr53Ns\">baaahttry biscuit base</a>....etc.
                                    </p>
                                    <p>
                                        If you're looking at these recipes, you might be trying too hard - either that or you're actually going on Masterchef.
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
                    //retrieves details of recipes with selected complexity for sortpages function to show how many there are.
                    $divbartext= $complex." recipes";
                    $divbartextsing = $complex." recipe";
                    $pagenolink= "/complexity/".$_GET['post-slug'];
                    $total_pages_sql = "SELECT COUNT(*) FROM recipes WHERE live=1 and complexity='$complex'";
                    $total_pages = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($total_pages)[0];
                    include($pagination);
                    sortpages($divbartext, $offset, $total_no, $total_rows,$divbartextsing);
                ?>
                <div class="first">	
                    <?php
                        //displays recipes of selected complexity for current page
                        $serving=$conn->prepare("SELECT title, titslug, rec_image, description FROM recipes WHERE complexity=? AND live=1 ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page");
                        $serving->bind_param("s", $complex);
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