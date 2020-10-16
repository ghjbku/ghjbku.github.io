<?php
/** Gyökérkönyvtár konstans inicializálása */
if (!defined('ROOT_DIR')) define('ROOT_DIR', '');

/**
 * Configfájl betöltése
 */
include 'config.php';

/**
 * A szükséges osztályok automatikus betöltése
 */
function autoload($class){
    $class = str_replace("\\", "/", $class);
    if(file_exists(ROOT_DIR . "classes/" . $class . ".php"))
        include ROOT_DIR . "classes/" . $class . ".php";
}

/**
 * Autoload funkció regisztrálása
 */
spl_autoload_register("autoload");
    
/**
 * Session inicializálása
 */
session_start();

/** 
 * Jeleleg megnyitott oldal 
 */
$currPage = @$_GET['path'];

/**
 * A kérés tulajdonságainak lekérése
 */
$REQUEST = new Browser();