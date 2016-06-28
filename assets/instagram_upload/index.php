<?php
require 'src/Instagram.php';
/////// CONFIG ///////
$username = 'frans_tunti';
$password = 'janganl4h';
$debug    = false;
$photo    = 'pictures/1.jpg';     // path to the photo
//$video = 'videos/lucu.mov';
$caption  = 'slank again';   // caption
//////////////////////
$i = new Instagram($username, $password, $debug);
try{
  $i->login();
} catch (InstagramException $e)
{
  $e->getMessage();
  exit();
}
try {
  $i->uploadPhoto($photo, $caption);
  //$i->uploadVideo($video, $caption);
} catch (Exception $e)
{
  echo $e->getMessage();
}