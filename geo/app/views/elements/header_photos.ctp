<?php 
$photo_array = array('photo1.jpg', 'photo2.jpg', 'photo3.jpg', 'photo4.jpg', 'photo5.jpg', 'photo6.jpg', 'photo7.jpg');
$path = '/files/header_images/';
$photo_array_length = count($photo_array);
srand((double)microtime()*1234567 );
$rand_index = rand(0, $photo_array_length-1);
echo $html->image($path.$photo_array[$rand_index]);
?>