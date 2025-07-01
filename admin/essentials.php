<?php

define('SITE_URL', 'http://127.0.0.1/Projects/HBS/');
define('ABOUT_IMG_PATH', SITE_URL.'images/about/');
define('FACILITIES_IMG_PATH', SITE_URL.'images/facilities/');
define('CAROUSEL_IMG_PATH', SITE_URL.'images/carousel/');
define('ROOMS_IMG_PATH', SITE_URL.'images/rooms/');
define('USER_IMG_PATH', SITE_URL.'images/user/');
define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/Projects/HBS/images/');
define('ABOUT_FOLDER', 'about/');
define('FACILITIES_FOLDER', 'facilities/');
define('CAROUSEL_FOLDER', 'carousel/');
define('ROOMS_FOLDER', 'rooms/');
define('USER_FOLDER', 'user/');
define('SENDGRID_API_KEY', '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');
define('EMAIL_FROM', 'championarenaofficial@gmail.com');
define('EMAIL_SUBJECT', 'HBS SUPPORT TEAM');

require('filter.php');

function alert($msg, $type){
    echo $alert = <<< alert
                        <div class="alert alert-$type alert-dismissible fade show" role="alert" id="alert_custom">
                            <strong>$msg!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    alert;    
}

function remove_alert(){
    
}

function redirect($url){
    echo "<script>
            window.location.href = '$url';
        </script>";
}

function login(){
    session_start();
    if(!(isset($_SESSION['admin']) && $_SESSION['admin'] == true)){
        echo "<script>
            window.location.href = 'index.php';
        </script>";
    }
}

function uploadImage($image, $folder){
    $valid_mime = ['image/jpg', 'image/png', 'image/jpeg'];
    $img_mime   = $image['type'];
    
    // EXTENSIONS
    if(!in_array($img_mime, $valid_mime)){
        return "inv_type"; 
    }
    // IMAGE SIZE
    elseif($image['size']/(1024*1024) > 2){
        return "inv_size";
    }else{
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $image_name = 'img-'.time().'.'.$ext;
        $img_path   = UPLOAD_IMAGE_PATH.$folder.$image_name;
        if(move_uploaded_file($image['tmp_name'], $img_path)){
            return $image_name;
        }else{
            return "inv_upload";
        }
    }

}

function uploadSVGImage($image, $folder){
    $valid_mime = ['image/svg+xml'];
    $img_mime   = $image['type'];
    
    // EXTENSIONS
    if(!in_array($img_mime, $valid_mime)){
        return "inv_type"; 
    }
    // IMAGE SIZE
    elseif($image['size']/(1024*1024) > 2){
        return "inv_size";
    }else{
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $image_name = 'img-'.time().'.'.$ext;
        $img_path   = UPLOAD_IMAGE_PATH.$folder.$image_name;
        if(move_uploaded_file($image['tmp_name'], $img_path)){
            return $image_name;
        }else{
            return "inv_upload";
        }
    }

}

function delete_image($image, $folder){
    
    $img = $folder.$image;
    if(unlink($img)){
        return true;
    }
    else{
        return false;
    }
}


function uploadUserImage($image, $folder){
    $valid_mime = ['image/jpg', 'image/png', 'image/jpeg'];
    $img_mime   = $image['type'];
    
    // EXTENSIONS
    if(!in_array($img_mime, $valid_mime)){
        return "inv_type"; 
    }
    // IMAGE SIZE
    elseif($image['size']/(1024*1024) > 5){
        return "inv_size";
    }
    else{
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $image_name = 'img-'.time().'.jpg';
        $img_path   = UPLOAD_IMAGE_PATH.$folder.$image_name;
        if(move_uploaded_file($image['tmp_name'], $img_path)){
            return $image_name;
        }else{
            return "inv_upload";
        }
    }

}


?>

