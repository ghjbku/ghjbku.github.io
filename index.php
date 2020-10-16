<?php
/**
 * Autoload betöltése, hogy minden zökkenőmentesen menjen.
 */
require_once 'autoload.php';
/**
 * Fejrész betöltése
 */
require_once Config::get('page/render/head');

/** 
*Ha a felhasználó nincs bejelntkezve, 
*irányítsuk át a bejelentkezési oldalra.  
*/
if(!User::isLoggedIn()) { 
    include 'login.php';  
    die();
}

/**  * Menü betöltése  */
/**
 * Menü betöltése
 */
require_once Config::get('page/render/navbar');

/**
 * A /oldalnév (url kódolásban a ?path értéke) alapján betölteni az oldalt
 */
$path = explode('/',$_SERVER['REQUEST_URI'])[2];
if($path != 'logout' && $path != '') {
    if(file_exists('pages/'.$path.'.php')) {
        include 'pages/'.$path.'.php';
    } else {
        include 'pages/404.php';
    }
} else if($path == 'logout') {
    User::logout();
} else {
    header('Location: gallery');
}

/**
 * Lábrész betöltése
 */
require_once Config::get('page/render/footer');
