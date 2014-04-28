<?php 
$quality=$_GET['quality'];
$watermark=$_GET['watermark'];
$imgpath="/home/danvog/vogtrv.com/";
$imgpath = $imgpath.$_GET['image'];
header('content-type: image/jpeg'); 
$watermarkfile="/home/danvog/vogtrv.com/img/";
$watermarkfile.=$watermark;
$watermark = imagecreatefrompng($watermarkfile);
list($watermark_width,$watermark_height) = getimagesize($watermarkfile);
$image = imagecreatefromjpeg($imgpath);
$size = getimagesize($imgpath);
$dest_x = ($size[0]) - ($watermark_width) - 15;
$dest_y = 15;
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
imagejpeg($image, NULL, $quality);
imagedestroy($image);
imagedestroy($watermark);
?>