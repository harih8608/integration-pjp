<?php

// Command add by Rajeshkumar
// Before run on server make sure that php5-gd module installed
// To install php5-gd module, Please refer below link :
// https://stackoverflow.com/questions/13338339/imagecreatefromjpeg-and-similar-functions-are-not-working-in-php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start(); // Staring Session
//$captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz'; // Initializing PHP variable with string
$captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; // Initializing PHP variable with string
$captchanumber = substr(str_shuffle($captchanumber), 0, 6); // Getting first 6 word after shuffle.
$_SESSION["code"] = $captchanumber; // Initializing session variable with above generated sub-string
$image = imagecreatefromjpeg("../images/captcha.jpg"); // Generating CAPTCHA
$foreground = imagecolorallocate($image, 255, 20, 147); // Font Color
imagestring($image, 5, 4, 3, $captchanumber, $foreground);
header('Content-type: image/png');
imagepng($image);

?>