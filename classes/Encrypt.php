<?php 

/**
 * A titkosításhoz és biztonságos tároláshoz használt funkciók osztálya.
 */
class Encrypt {
    /**
     * MD5 és SHA1 kódolás sóval.
     * @param String $pwd A plain text jelszó.
     * @return String A titkosított jelszó.
     */
    public static function password($pwd) {
        return md5(sha1("*".$pwd));
    }

    /**
     * Csak betűk és számok engedélyezése a felhasználónévben.
     * @param String $username A felhasználó felhasználóneve.
     * @return String  A felhasználó biztonságos felhasználóneve.
     */
    public static function safeUsername($username) {
        return preg_replace("/\W/", "", $username);
    }

    /**
     * Csak a megadott karakterekkel lehet dolgozni.
     * @param String $username A típusok string értéke.
     * @return String  Biztonságos string.
     */
    public static function safeTypes($types) {
        return preg_replace("/[^a-z0-9,']/", "", $types);
    }

    /**
     * Random string generálása megadott hosszal.
     * @param int $length A string hossza. Alapértelmezetten 7.
     * @return String Random string.
     */
    public static function randomStr($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}