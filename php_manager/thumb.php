<?
header('Content-type: image/jpeg');
function resizeImage($originalImage,$new_height,$ext){
   
    // Get the original geometry and calculate scales
    list($width_orig, $height_orig) = getimagesize($originalImage);
        
	/*	if($width<$height)
		$new_width = round(($width * $new_height) / $height);
		else
		$new_width = round(($width * $new_height) / $height);*/
		$width=$height=$new_height;
		$ratio_orig = $width_orig/$height_orig;

		//if ($width/$height > $ratio_orig) {
		$width = $height*$ratio_orig;
		//} else {
		//$height = $width/$ratio_orig;
	//	}
		
    
	// Resize the original image
	if($new_height>$height_orig)	
		{
		$width = $width_orig;
		$height = $height_orig;
		}
	$imageResized = imagecreatetruecolor($width, $height);
	
	if($ext=="jpg" OR $ext=="jpeg")
		$imageTmp = imagecreatefromjpeg ($originalImage);
	elseif($ext=="gif")
		$imageTmp = imagecreatefromgif ($originalImage);
	elseif($ext=="png")
		$imageTmp = imagecreatefrompng ($originalImage);
		
	
    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	

    // Output
    imagejpeg($imageResized, null, 100);
    imageDestroy($imageResized);
    return;
}

$f = urldecode($_GET['pic']);
$ext = strtolower(substr($f,strrpos($f,".")+1,strlen($f)));


ResizeImage(urldecode($_GET['pic']),$_GET['height'],$ext)	; //this one shows on the browser






?>