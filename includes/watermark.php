<?php 
//reduce image by
$quality=$_GET['quality'];
//$imgpath is where images in this gallery reside
$imgpath="/home/danvog/vogtrv.com/";
//Put them all together to get the full path to the image:
$imgpath = $imgpath.$_GET['image'];
//Start the process of outputting the image with a watermark
header('content-type: image/jpeg'); //HTTP header - assumes your images in the gallery are JPGs
//$watermarkfile is the filepath for watermark image as a PNG-24 Transparent (ex: your logo)
$watermarkfile="/home/danvog/vogtrv.com/img/website-watermark.png";
//Get the attributes of the watermark file so you can manipulate it
$watermark = imagecreatefrompng($watermarkfile);
//Get the width and height of your watermark - we will use this to calculate where to put it on the image
list($watermark_width,$watermark_height) = getimagesize($watermarkfile);
//Now get the main gallery image (at $imgpath) so we can maniuplate it
$image = imagecreatefromjpeg($imgpath);
//Get the width and height of your image - we will use this to calculate where the watermark goes
$size = getimagesize($imgpath);
//Calculate where the watermark is positioned
//In this example, it is positioned in the lower right corner, 0px away from the bottom & right edges
$dest_x = $size[0] - $watermark_width;
$dest_y = $size[1] - $watermark_height;
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
//Finalize the image: 
imagejpeg($image, NULL, $quality);
//Destroy the image and the watermark handles
imagedestroy($image);
imagedestroy($watermark);
?>