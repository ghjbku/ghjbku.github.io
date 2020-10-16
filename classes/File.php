<?php

/**
 * Fájlfunkciók.
 */
class File {
    /**
     * Feltöltött fájl bejegyzése az adatbázisba a feltöltő alá.
     * @param String $filename A fájl neve.
     * @param String $extension A fájl kiterjesztése. 
     * @return bool
     */
    public static function toDB($filename, $extension) {
        $db = DB::getInstance();
        if(Ajax::apiRequest() && !User::isLoggedIn()) {
            $id = $db->query("SELECT id FROM users WHERE api = ?", [$_POST['api']])->results()[0]->id;
        } else {
            $id = User::getUserData()->id;
        }
        $db->query("INSERT INTO `files`(`filename`,`extension`,`userId`,`dateAdded`) VALUES(?,?,?,?)", [$filename, $extension, $id, self::now()]);
    }

    /**
     * A jelenlegi dátum YYYY/MM/DD HH:ii:ss formátumban.
     * @return DateTime Dátum. 
     */
    public static function now() {
        return date('Y-m-d H:i:s');
    }

    /**
     * A felhasználó minden fájlának lekérése.
     * @return Array Fájlbejegyzéseket tartalmazó array.
     * @return mixed
     */
    public static function getAllFiles($type = "") {
        $db = DB::getInstance();
        if(Ajax::apiRequest() && !User::isLoggedIn()) {
            $id = $db->query("SELECT id FROM users where api = ?", [$_POST['api']])->results()[0]->id;
        } else {
            $id = User::getUserData()->id;
        }
        if($type != "") {
            $type = Encrypt::safeTypes($type);
            $res = $db->query("SELECT * from files where userId = ? and extension in ($type)", [$id]);
            if(empty($res->error())) {
                return $res->results();
            } else {
                return false;
            }
        } else {
            $res = $db->query("SELECT * from files where userId = ?", [$id]);
            if(empty($res->error())) {
                return $res->results();
            } else {
                return false;
            }
        }
    }
}