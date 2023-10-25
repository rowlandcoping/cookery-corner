<?php


$tab='<table cellspacing="0" class="menu">';

$home='<tr>
<td class="menu"><a href="/index.php"><img src="/menu/homeimg.bmp" alt="home" /></a></td>
<td class="menu"><a href="/index.php"><img src="/menu/home.png" alt="home" /></a></td>
</tr>';

$about='<tr>
<td class="menu"><a href="/about.php"><img src="/menu/aboutimg.bmp" alt="about" /></a></td>
<td class="menu"><a href="/about.php"><img src="/menu/about.png" alt="about" /></a></td>
</tr>';

$recipe='<tr>
<td class="menu"><a href="/recipes.php"><img src="/menu/recipeimg.bmp" alt="recipes" /></a></td>
<td class="menu"><a href="/recipes.php"><img src="/menu/recipe.png" alt="recipes" /></a></td>
</tr>';

$blog='<tr>
<td class="menu"><a href="/blog.php"><img src="/menu/rowlandimg.bmp" alt="blog" /></a></td>
<td class="menu"><a href="/blog.php"><img src="/menu/blog.png" alt="blog" /></a></td>
</tr>';

$review='<tr>
<td class="menu"><a href="/reviews.php"><img src="/menu/reviewsimg.bmp" alt="reviews" /></a></td>
<td class="menu"><a href="/reviews.php"><img src="/menu/reviews.png" alt="reviews" /></a></td>
</tr>';


$forum='<tr>
<td class="menu"><a href="/holding.php"><img src="/menu/forumimg.bmp" alt="forum" /></a></td>
<td class="menu"><a href="/holding.php"><img src="/menu/forum.png" alt="forum" /></a></td>
</tr>';

$contribute='<tr>
<td class="menu"><a href="/feedback/feedback190609.php"><img src="/menu/contributeimg.bmp" alt="contribute" /></a></td>
<td class="menu"><a href="/feedback/feedback190609.php"><img src="/menu/contact.png" alt="contribute" /></a></td>
</tr>';

$friends='<tr>
<td class="menu"><a href="/holding.php"><img src="/menu/friendsimg.bmp" alt="friends" /></a></td>
<td class="menu"><a href="/holding.php"><img src="/menu/links.png" alt="friends" /></a></td>
</tr>';

$archive='<tr>
<td class="menu"><a href="/archive/archive.php"><img src="/menu/archiveimg.bmp" alt="archive" /></a></td>
<td class="menu"><a href="/archive/archive.php"><img src="/menu/index.png" alt="archive" /></a></td>
</tr>';

$end='</table>';

?>


<?php

if ($page==0){
print $tab; print $home;print $about; print $recipe; print$blog; print$review;
print$forum; print$contribute; print$friends; print$archive; print$end;}

if ($page==1){
print $tab; print $about; print $recipe; print$blog; print$review;
print$forum; print$contribute; print$friends; print$archive; print$end;}

if ($page==2){
print $tab; print $home; print $recipe; print$blog; print$review;
print$forum; print$contribute; print$friends; print$archive;print$end;}

if ($page==3){
print $tab; print $home; print $about; print$blog; print$review;
print$forum; print$contribute; print$friends; print$archive;print$end;}

if ($page==4){
print $tab; print $home; print $about; print $recipe; print$review;
print$forum; print$contribute; print$friends; print$archive;print$end;}

if ($page==5){
print $tab; print $home; print $about; print $recipe; print$blog; 
print$forum; print$contribute; print$friends; print$archive;print$end;}

if ($page==6){
print $tab; print $home; print $about; print $recipe; print$blog; print$review;
print$contribute; print$friends; print$archive;print$end;}

if ($page==7){
print $tab; print $home; print $about; print $recipe; print$blog; print$review;
print$forum; print$friends; print$archive;print$end;}

if ($page==8){
print $tab; print $home; print $about; print $recipe; print$blog; print$review;
print$forum; print$contribute; print$archive;print$end;}

if ($page==9){
print $tab; print $home; print $about; print $recipe; print$blog; print$review;
print$forum; print$contribute; print$friends;print$end;}

?>
