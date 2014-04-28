<?php

function imageResize ($quality, $image) {
	//Put them all together to get the full path to the image:
	$imgpath = $image;
	//output image with watermark
	header('content-type: image/jpeg'); //HTTP header - assumes your images in the gallery are JPGs
	//$watermarkfile is the filepath for your watermark image as a PNG-24 Transparent (ex: your logo)
	$watermarkfile="/home/danvog/vogtrv.com/img/logos/vogt.png";
	//Get the attributes of the watermark file so you can manipulate it
	$watermark = imagecreatefrompng($watermarkfile);
	//Get the width and height of your watermark - we will use this to calculate where to put it on the image
	list($watermark_width,$watermark_height) = getimagesize($watermarkfile);
	//Now get the main gallery image (at $imgpath) so we can maniuplate it
	$image = imagecreatefromjpeg($imgpath);
	//Get the width and height of your image - we will use this to calculate where the watermark goes
	$size = getimagesize($imgpath);
	//Calculate where the watermark is positioned
	//In this example, it is positioned in the lower right corner, 15px away from the bottom & right edges
	$dest_x = $size[0] - $watermark_width - 15;
	$dest_y = $size[1] - $watermark_height - 15;
	//I used to use imagecopymerge to apply the watermark to the image
	//However it does not preserve the transparency and quality of the watermark
	//imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 70);
	//So I now use this function which works beautifully:
	//Refer here for documentation: http://www.php.net/manual/en/function.imagecopy.php
	imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
	//Finalize the image:
	imagejpeg($image, NULL, $quality);
	//Destroy the image and the watermark handles
	imagedestroy($image);
	imagedestroy($watermark);
	return($image);
}

imageResize(70, '/home/danvog/vogtrv.com/unit-img/DC077257/DSC_0002.jpg')

?>

