<?php
define('DEFAULT_IMAGE_PATH', 'res/icon');

function randomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function checkFileType($extension) {
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    return in_array($extension, $allowedTypes);
}

function getColorByColor($color)
{
    switch($color) {
        case 'marrone':
            return '#8B4513';
        case 'verde':
            return '#008000'; 
        case 'rossa':
            return '#FF0000'; 
        default:
            return '#000000'; 
    }
}

function getShitImage($color)
{
    switch($color) {
        case 'marrone':
            return DEFAULT_IMAGE_PATH . '/brownshit.png'; 
        case 'verde':
            return DEFAULT_IMAGE_PATH . '/greenshit.png'; 
        case 'rossa':
            return DEFAULT_IMAGE_PATH . '/redshit.png'; 
        default:
            return DEFAULT_IMAGE_PATH . '/brownshit.png';
    }
}
?>