<?php if(!isset($_SESSION)){session_start();}
    $path = $_SERVER['DOCUMENT_ROOT'];
    $config = "$path"."/config.php";
    $head = "$path"."/includes/head_recipes.php";
    $latest = "$path"."/includes/latest.php";
    $search = "$path"."/includes/search.php";
    $banner = "$path"."/includes/right_banner.php";
    $analytics = "$path"."/analytics.php";  

    require_once($config); 
    if (isset($_GET['post-slug'])) {$post = getPost($_GET['post-slug']);}
    require_once($head);
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once($head); ?>
        <div class="page">
            <?php require_once($banner);?>
            <div class="maingen">	
                <div class="general">
                    <h1>Recipe of the Week<i> (ish)</i></h1>
                    <p>
                        Cookery Corner is all about sharing recipe ideas, and making them as simple as possible.  
                        We try to avoid ingredients you can only find by bribing Jamie Oliver's butler, 
                        and focus as much as possible on stuff you can pick up on your weekly shop. 
                        If you think you can't cook, well actually you can - it's just various ways of heating, chopping and pouring stuff. 
                    </p>
                    <p>
                        And for people who actually think they can cook I hope there's something for you here too.
                    </p>
                    <form method="get" action="search.php">
                        <p>
                            Search for recipe:
                            <input type="text" name="search" required>
                            <input type="submit" value="search">
                        </p>                    
                    </form>
                </div>
                <?php
                    require($latest);
                ?>
            </div>
        </div>
    </body>
    <?php
        include ($analytics);
    ?>
</html>
	

