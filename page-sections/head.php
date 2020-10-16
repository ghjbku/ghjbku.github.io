<?php 
/**
 * A fejrész felépítése. Ez a fájl kívülről nem érhető el.
 */
if(basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') die();?>
<!doctype html>
<html lang="hu">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <?php if($currPage == 'gallery' && User::isLoggedIn()) { ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.8.3/css/lightgallery.min.css" integrity="sha512-gk6oCFFexhboh5r/6fov3zqTCA2plJ+uIoUx941tQSFg6TNYahuvh1esZVV0kkK+i5Kl74jPmNJTTaHAovWIhw==" crossorigin="anonymous" />
    <?php } ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" />
    <?php if($currPage == 'upload' && User::isLoggedIn()) { ?>
    <link rel="stylesheet" href="assets/libs/css/dropzone.css">
    <?php } ?>
    <?php if(!User::isLoggedIn()) { ?>
    <link rel="stylesheet" href="assets/libs/css/login.css">
    <?php } ?>
    <title>Gallery</title>
</head>
<body>
