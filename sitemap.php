<?php
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$path=$_SERVER['DOCUMENT_ROOT'];
$config="$path"."/config.php";
include("config.php");
$links=$conn->query("SELECT url,lastupdated FROM article_index WHERE live=1");
$base_url="https://cookery-corner.co.uk";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
while($link=$links->fetch_assoc()){
$datetime=new DateTime($link['lastupdated']);
$date_final=$datetime->format('Y-m-d\TH:i:sP');
echo"<url><loc>".$base_url.$link['url']."</loc>";
echo"<lastmod>".$date_final."</lastmod>";
echo"<changefreq>daily</changefreq>";
echo"</url>";}
echo '</urlset>' . PHP_EOL;
?>
