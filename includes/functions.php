<?php
function Sanitizer($data){
        $data = stripcslashes($data);
        $data = stripslashes($data);
        return $data;
    }

// function successMessage(){
//         echo
// }

// Make the post Url SEO friendly
// Function to Create Url from String
function url_slug($string){
$slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string)));
return $slug;
}
?>
