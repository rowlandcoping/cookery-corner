<?php if(!isset($_SESSION)){session_start();}
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $process = "$path"."/includes/recipe_process.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";
    require_once($config);
    require_once($process);

    //fetch array of data for current recipe
    if (isset($_GET['post-slug'])) {
        $post = getPost($_GET['post-slug']);	
    }

    //set variables for key data from current recipe
    $user_ID= $post['user_ID'];
    $serves= $post['serves'];
    $comp= $post['complexity'];
    $categ= $post['category'];
    $cuisine= $post['cuisine'];

    //get author name & slug    
    $author = $conn->prepare("SELECT name, slug FROM users WHERE ID=? 
                                    LIMIT 1");
    $author->bind_param("s", $user_ID);
    $author->execute();				
    $authres = $author->get_result();
    $res = $authres->fetch_assoc();
    $aname= $res['name'];
    $aslug= $res['slug'];

    //get slug for current recipe number of servings    
    $serveno = $conn->prepare("SELECT slug FROM serves WHERE serves=? 
                                    LIMIT 1");
    $serveno->bind_param("i", $serves);
    $serveno->execute();				
    $servres = $serveno->get_result();
    $res2 = $servres->fetch_assoc();
    $servslug= $res2['slug'];

    //get slug for current recipe complexity    
    $compthough = $conn->prepare("SELECT slug FROM complexity WHERE complexity=? 
                                    LIMIT 1");
    $compthough->bind_param("s", $comp);
    $compthough->execute();				
    $compres = $compthough->get_result();
    $res3 = $compres->fetch_assoc();
    $compslug= $res3['slug'];

    //get slug for current recipe category
    $catthough = $conn->prepare("SELECT slug FROM recipe_category WHERE category=? 
                                    LIMIT 1");
    $catthough->bind_param("s", $categ);
    $catthough->execute();				
    $catres = $catthough->get_result();
    $resu4 = $catres->fetch_assoc();
    $catslug= $resu4['slug'];

    //get slug for current recipe cuisine    
    $cuisthough = $conn->prepare("SELECT slug FROM cuisine WHERE cuisine=? 
                                    LIMIT 1");
    $cuisthough ->bind_param("s", $cuisine);
    $cuisthough ->execute();				
    $cuires = $cuisthough ->get_result();
    $resu5 = $cuires->fetch_assoc();
    $cuislug= $resu5['slug'];
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="main">                
                <?php 
                    if (empty($post)) {
                        echo 
                            "<div class=\"intro\">
                                <div class=\"introtext\">
                                    <h1>This recipe is no more!</h1>
                                    <p>
                                        Either it's been deleted, updated or for some reason google is still indexing pages from 10 years ago (It does that).
                                    </p>
                                    <p>
                                        In the meantime I hope you enjoy the various other bounties this site has to offer.
                                    </p>
                                    <hr>
                                    <form method=\"get\" action=\"/search.php\">
                                        <p id=\"recipe-search\">
                                            Search for another recipe:
                                        </p> 
                                        <input type=\"text\" name=\"search\" required>
                                        <input type=\"submit\" value=\"search\">                                           
                                    </form>
                                    <hr>
                                </div>
                            </div>"
                        ;               
                        require($latest);
                        exit();
                    }
                    if ($post['live']=="0") {	
                        if ($_SESSION['role']!=="admin" & $_SESSION['ID']!=$post['user_ID']) {
                            echo
                                "<div class=\"intro\">
                                    <div class=\"introtext\">
                                        <h1>".$post['title']."</h1>
                                        <p>This recipe is not yet live.</p>
                                        <p>
                                            If you have created it and wish to see a preview, please <a href=\"/publiclogin.php\">log in</a> first.
                                        </p>
                                        <hr>
                                        <form method=\"get\" action=\"/search.php\">
                                            <p id=\"recipe-search\">
                                                Search for another recipe:
                                            </p> 
                                            <input type=\"text\" name=\"search\" required>
                                            <input type=\"submit\" value=\"search\">                                           
                                        </form>
                                        <hr>
                                    </div>
                                </div>"
                            ;
                            require($latest);
                            exit();
                        }
                    }
                ?>
                <div class="intro">
                    <div id="desktop-image" class="mainimage">
	                    <?php echo "<img src=\"/assets/images/recipes/".$post['rec_image']."\">"; ?>
                    </div>
                    <div class="introtext">
                        <h1>
                            <?php echo $post['title']; ?>
                        </h1>
                        <h3 class="user">
                            <?php echo "<a href=\"/author/".$aslug."\"class=\"auth\">".$aname."</a>"; ?>
                        </h3>
                        <hr>
                        <div class="second">
                            <div id="recipe-links">
                                <div id="recipe-sections">
                                    <div id="section-one">
                                        <img src="/assets/logos/knifork.jpg">                                
                                        <?php echo "<a href=\"/servings/".$servslug."\">".$serves."</a>"; ?>                                
                                        <img src="/assets/logos/cog.jpg"></li>
                                        <?php echo "<a href=\"/complexity/".$compslug."\">".$comp."</a>"; ?>
                                    </div>
                                    <div id="section-two">                               
                                        <img src="/assets/logos/dnight.jpg">                                
                                        <?php echo "<a href=\"/category/".$catslug."\">".$categ."</a>"; ?>                                
                                        <img src="/assets/logos/globe.jpg">                                                                    
                                        <?php echo "<a href=\"/cuisine/".$cuislug."\">".$cuisine."</a>"; ?>
                                    </div>
                                </div>
                                <hr id="social-divider">
                                <div id="recipe-social">
                                    <a href=""><img src="/assets/logos/fbook.jpg"></a>
                                    <a href=""><img src="/assets/logos/twitter.jpg"></a>
                                    <a href=""><img src="/assets/logos/insta.png"></a>
                                </div>
                            </div>
                            <hr>
                            <div id="mobile-image" class="mainimage">
	                            <?php echo "<img src=\"/assets/images/recipes/".$post['rec_image']."\">"; ?>
                            </div>
                            <?php echo $post ['intro']; ?>
                            <hr>
                        </div>
                        <div class="second">                            
                            <p id="user-rating">User Rating: N/A</p>
                            <p id="rowland-rating">Rowland Rating: N/A</p>                        
                            <hr>
                            <p class="rowland">
                                <strong><em>Rowland says: </em></strong>Well, nothing yet.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="segment">
                    <div class="ing">
                        <h2><strong>Ingredients</strong></h2>
                        <?php
                            //retrieve and display ingredients for current recipe
                            $stmt=$conn->prepare("SELECT quantity, ingredient, display_order, slug FROM ing_index WHERE recipe_ID=? ORDER BY display_order");
                            $stmt->bind_param("s", $post['ID']);
                            $stmt->execute();
                            $array=$stmt->get_result();
                            foreach($array as $r) {
                                echo 
                                    "<p>- "
                                        .$r['quantity']." <a href=\"/ingredient/".$r['slug']."\">".$r['ingredient']."</a>
                                    </p>"
                                ;
                            }
                            //display notes for ingredients if present
                            if (!empty($post['add_ingred'])) {
                                echo
                                    "<hr>
                                    <h2>Notes</h2>"
                                    .$post['add_ingred']
                                ;
                            }
                        ?>
                    </div>
                    <div class="content">
                        <h3><?php echo $post['step1_head']; ?></h3>
                        <?php
                            echo $post['step1_content'];
                            //check for/display step 2
                            if (!empty ($post['step2_head'])){
                                echo 
                                    "<hr>
                                    <h3>".$post['step2_head']."</h3>"
                                    .$post['step2_content']
                                ;
                            }
                            //check for/display step 3
                            if (!empty ($post['step3_head'])){
                                echo 
                                    "<hr>
                                    <h3>".$post['step3_head']."</h3>"
                                    .$post['step3_content']
                                ;
                            }
                            //check for/display step 4
                            if (!empty ($post['step4_head'])){
                                echo 
                                    "<hr>
                                    <h3>".$post['step4_head']."</h3>"
                                    .$post['step4_content']
                                ;
                            }
                        ?>
                        <hr>
                        <h3>Summary</h3>
                        <?php echo $post['conclusion']; ?>
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
                </div>
                <?php
                    require($latest);
                ?>
            </div>
        </div>
    </body>
</html>