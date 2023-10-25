<?php
/*limit image size to 4MB
if ($fileSize>4194304){
	echo "Your file is too big.  Please upload something less than 4MB.
	<br>This is on account of me skimping on hosting fees.  I'm sure you understand";
	exit();
}*/
// Allow certain file formats
$allowTypes = array('jpg','png','jpeg','gif', 'JPG', 'JPEG', 'GIF', 'PNG', 'bmp', 'BMP', 'gd2', 'GD2', 'WEBP', 'webp'); 
if(in_array($fileType, $allowTypes))
{	    
//set path and projected filename

$name = $imgName;
$ext = ".jpg";
$oldname="$name"."$ext";
$newpath = $filepath.'/'.$oldname;
$newname = $oldname;      
//search for duplicates and create new file name if it clashes      
if(file_exists($newpath)){
$counter = 1;
$newname = $name.$counter.$ext; 
$newpath = $filepath . '/' . $newname;          
while (file_exists($newpath)) {
$newname = $name.$counter.$ext;
$newpath = $filepath.'/'.$newname;
$counter++;
}
}

//convert image to jpeg and save, quality based on file size

imagejpeg(imagecreatefromstring(file_get_contents($image)), "$filepath".'/'."$newname", 99);

//check filesize of resized image & resize image to max width of 350


$target_file=$filepath . '/' . $newname;
$resized_file=$filepath . '/' . $newname;


//doing it with imagescale - simpler, uploads faster but a little larger (like 20kb)
/*
$img = imagecreatefromjpeg($target_file);
$tci = imagescale($img, 350);
imagejpeg($tci, $resized_file, 99);
*/


//my version with working out them ratios (simplified maths innit)

	$wmax=700;
    list($w_orig, $h_orig) = getimagesize($target_file);
    if ($w_orig>700) {
    $scale_ratio = $wmax / $w_orig;
    $hmax = $h_orig*$scale_ratio;
    $img = "";
    $img = imagecreatefromjpeg($target_file);
    $tci = imagecreatetruecolor($wmax, $hmax);
    //imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig);
    imagejpeg($tci, $resized_file, 89);

}}else{echo "<p>invalid image format, image not added</p>
			<p><a href=\"/admin/admin.php\">Admin Home</a>";
			exit ();
}
?>
