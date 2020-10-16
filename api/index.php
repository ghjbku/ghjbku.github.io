<?php

/**
 * Újradefiniálni a ROOT_DIR konstanst, hogy az előző mappára mutasson.
 */
define("ROOT_DIR", "../");

/**
 * Autolad betöltése.
 */
include '../autoload.php';

/**
 * Content-Type header beállítása, mint JSON.
 */
header("Content-Type: application/json");

/**
 * Ajax kéréssel van dolgunk?
 */
if (!$REQUEST->isAjax) {
    header('Location: doc.html');
}

/**
 * Ha létezik a metódus, futtassuk le.
 */
if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'uploadFile':
            Ajax::onlyLoggedIn();
            if (!empty($_FILES)) {
                $destFolder = Config::get('uploadFolder');
                $uploadFolder = explode('/',Config::get('uploadFolder'))[count(explode('/',Config::get('uploadFolder')))-1];
                $tempFile = $_FILES['file']['tmp_name'];
                $random = Encrypt::randomStr();
                $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, Config::get('allowedExtensions'))) Ajax::error(['message' => 'Nem támogatott kiterjesztés (' . $extension . ')!']);
                $filename = $random . '.' . $extension;
                $target = $destFolder . DIRECTORY_SEPARATOR . $filename;
                if (move_uploaded_file($tempFile, $target)) {
                    File::toDB($random, $extension);
                    Ajax::success(['message' => 'Sikeres fájlfeltöltés!', 'link' => Config::get('url') . $uploadFolder . "/" . $filename]);
                } else {
                    Ajax::error(['message' => 'Fájl feltöltés sikertelen!']);
                }
            } else {
                Ajax::error(['message' => 'Nincs fájl megadva!!']);
            }
            break;
        case 'deleteFile':
            Ajax::onlyLoggedIn();
            break;
        case 'getFiles':
            Ajax::onlyLoggedIn();
            if (!isset($_POST['type'])) {
                if($fileDb = File::getAllFiles()) {
                    foreach ($fileDb as $file)
                        $files[] = $file->filename . "." . $file->extension;
                } else {
                    Ajax::error(['message' => 'Hiba történt az adatbázis-kapcsolatban!']);
                }
            } else {
                $type = "'" . implode("','", $_POST['type']) . "'";
                if($fileDb = File::getAllFiles($type)) {
                    foreach ($fileDb as $file)
                    $files[] = $file->filename . "." . $file->extension;
                } else {
                    Ajax::error(['message' => 'Hiba történt az adatbázis-kapcsolatban!']);
                }
            }
            Ajax::success(['files' => $files]);
            break;
        case 'login':
            if (User::login($_POST['username'], $_POST['password'])) {
                Ajax::success();
            } else {
                Ajax::error(['message' => 'Hibás adatok!']);
            }
            break;
        case 'addCategory':
            Ajax::onlyLoggedIn();
            break;
        case 'keyRegen':
            Ajax::onlyLoggedIn(true);
            if (isset($_SESSION['regen'])) $_SESSION['regen']++;
            else $_SESSION['regen'] = 1;
            if (!User::regenApiKey()) {
                Ajax::error(['message' => 'Túl sokszor akartál API kulcsot váltani!']);
            }
            Ajax::success();
            break;
        case 'getCategory':
            Ajax::onlyLoggedIn();
            break;
        case 'deleteCategory':
            Ajax::onlyLoggedIn();
            break;
        default:
            Ajax::error(['message' => 'A rendszer nem tudta feldolgozni a kérésed!']);
    }
} else {
    Ajax::error(['message' => 'Nincs megadva metódus!']);
}
