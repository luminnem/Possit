<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < 4; $i++)
{
	$randomString .= $chars[rand(0, strlen($chars)-1)];
}

$_SESSION['captcha'] = strtolower($randomString);

$im = @imagecreatefrompng("resources/captcha_bg.png");
imagettftext($im, 30, 0, 0, 38, imagecolorallocate($im, 0, 0, 0), 'resources/larabiefont.ttf', $_SESSION['captcha']);
header ('Content-type: image/png');
imagepng($im, NULL, 0);
imagedestroy($im);