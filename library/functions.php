<?php


//=======================================================
// FUNCTIONS LIBRARY
//=======================================================

//----------------------------------
// Check Email Function
//----------------------------------
function checkEmail($clientEmail) {
    // Check if email looks valid -- return status
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

//------------------------
// Check Password Function
//------------------------
function checkPassword($clientPassword) {
    // Returns one if the password matches, 0 if it doesn't
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

//----------------------------
// Dynamic Navigation Function
//----------------------------
function navBuilder($classifications) {
    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page' class='navoption'>Home</a></li>";
    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=Classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line' class='navoption'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

//------------------------------------
// Dynamic Classification Select List
//------------------------------------
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

//--------------------------------------
// Build Vehicles Display
//--------------------------------------
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $formattedPrice = "$".number_format($vehicle['invPrice'],2);
     $dv .= '<li>';
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=cardisplay&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= "<h2><a href='/phpmotors/vehicles/?action=cardisplay&invId=".urlencode($vehicle['invId'])."'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
     $dv .= "<span>$formattedPrice</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

//--------------------------------------
// Build Specific Vehicle Display
//--------------------------------------
function buildVehicleDisplay($vehicle){
    $formattedPrice = "$".number_format($vehicle['invPrice'],2);
    $dv = '<section id="car-display">';
    $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= "<div>";
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] - $vehicle[invColor]</h2>";
    $dv .= "<span><strong>$formattedPrice</strong></span>";
    $dv .= "<h4><strong>$vehicle[invStock]</strong> in stock.</h4>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .= "</div>";
    $dv .= '</section>';
    return $dv;
}
// Related Function to display thumbnails
function thumbnailBuildVehicleDisplay($images) {
    $dv = '<section id="thumbnail-display">';
    $dv .= '<h3>Vehicle Images</h3>';
    foreach ($images as $image) {
        $dv .= "<img src='$image[imgPath]' alt='Thumbnail for $image[invModel]'>";
    }
    $dv .= '</section>';
    return $dv;
}

//-----------------------------------------
// Build Reviews Display for Vehicle Detail
//-----------------------------------------
function buildReviewsDisplayVehicleDetail($reviews){
    $dv = '<ul class="review-display">';
    foreach ($reviews as $review) {
        $screenName = substr($review['clientFirstname'],0,1).$review['clientLastname'];
        $formattedDate = date('m-d-Y',strtotime($review['reviewDate']));
        $dv .= '<li>';
        $dv .= '<hr>';
        $dv .= "<span>$screenName: </span>";
        $dv .= "<span>$formattedDate</span>";
        $dv .= "<p>$review[reviewText]</p>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

//-----------------------------------------
// Build Reviews Display for Client Admin
//-----------------------------------------
function buildReviewsDisplayClientAdmin($reviews){
    $dv = '<h4>Your Reviews</h4><ul class="review-display">';
    foreach ($reviews as $review) {
        $formattedDate = date('m-d-Y',strtotime($review['reviewDate']));
        $dv .= '<li>';
        $dv .= '<hr>';
        $dv .= "<span>$formattedDate</span>";
        $dv .= "<p>$review[reviewText]</p>";
        $dv .= "<p><a href='/phpmotors/reviews/index.php?action=editReview&reviewId=$review[reviewId]'>Review</a> | <a href='/phpmotors/reviews/index.php?action=deleteReview&reviewId=$review[reviewId]'>Delete</a></p>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

//-----------------------------------------
// Build Review Submit Form
//-----------------------------------------
function buildReviewSubmitForm($invId,$clientInfo){
    $screenName = substr($clientInfo['clientFirstname'],0,1).$clientInfo['clientLastname'];
    $clientId = $clientInfo['clientId'];
    $dv = '<div class="form">';
    $dv .= '<form method="post" action="/phpmotors/reviews/index.php">';
    $dv .= '<fieldset class="form">';
    $dv .= '<legend>Submit Your Own Experience</legend>';
    $dv .= "<span>$screenName  </span>";
    $dv .= '<label for="reviewText">Review:</label>';
    $dv .= '<input name="reviewText" id="reviewText" type="text" required>';
    $dv .= '<input type="submit" name="submit" id="addRbtn" value="Post Review">';
    $dv .= '<input type="hidden" name="action" value="submitReview">';
    $dv .= "<input type='hidden' name='invId' value='$invId'>";
    $dv .= "<input type='hidden' name='clientId' value='$clientId'>";
    $dv .= '</fieldset></form></div>';
    return $dv;
}
/*****************************************************
* Functions for working with images
******************************************************/
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}
// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}
// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}
// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
        return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}
// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}
// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
        $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagecolortransparent($new_image, $alpha);
     }
    
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
    
        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    
        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
     } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends resizeImage function   
?>