<?php

$no_of_records_per_page = 12;


if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
$offset = ($pageno-1) * $no_of_records_per_page;
//ceil rounds up to nearest integer
$total_pages = ceil($total_rows / $no_of_records_per_page);
$number_on_page = $offset+$no_of_records_per_page;
if ($number_on_page<$total_rows) {$total_no = $number_on_page;}else {$total_no=$total_rows;}

//displays top bar with numbers on page and total
function sortpages ($divbartext, $offset, $total_no, $total_rows, $divbartextsing) {
if ($total_rows==1) {echo "<div class=\"divbar\">1 ".$divbartextsing.":</div>";
}else{echo "<div class=\"divbar\">".$divbartext." (";
if (($offset+1)==$total_no){echo $total_no;
}else{echo ($offset+1)."-".$total_no;}
echo " of ".$total_rows.")</div>";
}
}

//displays recipe listings
function displaypages($next) {
echo"<div class=leftres><a href=\"/recipe/";
    echo $next['titslug'];
    echo "\"<h2>";
    echo $next['title'];
    echo "</h2></a>";
    echo "<p><img src=\"/assets/images/recipes/".$next['rec_image']."\"width=\"250\", height=\"200\"/></p>";
    echo "<p>";
	echo $next['description'];
	echo "</p></div>";
}

//displays bottom bar with navigation
function pageNav($no_of_records_per_page, $total_rows, $pageno, $pagenolink, $total_pages) {

if ($no_of_records_per_page< $total_rows) {
	
echo "<div class=\"navbar\">";		
//if ($pageno > 1) {echo "<a href=\"".$pagenolink."?pageno=1\"><< </a>";}
if ($pageno > 1) {echo "<a href=\"".$pagenolink."?pageno=".($pageno - 1); echo "\">< </a>"; }
if (($pageno-4)>0) {echo "<a href=\"".$pagenolink."?pageno=".($pageno-4); echo "\">".($pageno-4)." </a>";}
if (($pageno-3)>0) {echo "<a href=\"".$pagenolink."?pageno=".($pageno-3); echo "\">".($pageno-3)." </a>";}
if (($pageno-2)>0) {echo "<a href=\"".$pagenolink."?pageno=".($pageno-2); echo "\">".($pageno-2)." </a>";}
if (($pageno-1)>0) {echo "<a href=\"".$pagenolink."?pageno=".($pageno-1); echo "\">".($pageno-1)." </a>";}
echo $pageno." ";
if (($pageno+1)<=$total_pages) {echo "<a href=\"".$pagenolink."?pageno=".($pageno+1); echo "\">".($pageno+1)." </a>";}
if (($pageno+2)<=$total_pages) {echo "<a href=\"".$pagenolink."?pageno=".($pageno+2); echo "\">".($pageno+2)." </a>";}
if (($pageno+3)<=$total_pages) {echo "<a href=\"".$pagenolink."?pageno=".($pageno+3); echo "\">".($pageno+3)." </a>";}
if (($pageno+4)<=$total_pages) {echo "<a href=\"".$pagenolink."?pageno=".($pageno+4); echo "\">".($pageno+4)." </a>";}
if($pageno < $total_pages) { echo "<a href=\"".$pagenolink."?pageno=".($pageno + 1); echo "\">> </a>";}
//if ($pageno < $total_pages) {echo "<a href=\"".$pagenolink."?pageno=".$total_pages; echo "\">>></a>";}
echo "</div>";
}
}	







?>

