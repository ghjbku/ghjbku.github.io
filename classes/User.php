<?php

/**
 * A felhasználó adataihoz hozzáférést biztosító osztály.
 */
class User {
    /**
     * Be van-e jelentkezve a felhasználó.
     * @return bool
     */
    public static function isLoggedIn() {
        return isset($_SESSION['userData']);
    }

    /**
     * Bejelentkezés. Elmentjük a felhasználónevet, a nevet és az API kulcsot session-be.
     * @param $username A felhasználó felhasználóneve.
     * @param $password A felhasználó jelszava.
     * @return bool
     */
    public static function login($username, $password) {
        if(!self::isLoggedIn()) {
            $db = DB::getInstance();
            $res = $db->query("SELECT * FROM users WHERE username = ? and password = ?", [$username, Encrypt::password($password)]);
            if(!empty($res->results()) && empty($res->error())) {
                self::setUserData($res->results()[0]);
                self::setApiKey();
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Eltároljuk a felhasználó adatait.
     */
    public static function setUserData($userData) {
        $_SESSION['userData'] = (object) $userData;
    }

    /**
     * Visszaadjuk  a felhasználó tárolt adatait.
     * @return Object
     */
    public static function getUserData() {
        return $_SESSION['userData'];
    }

    /**
     * A felhasználóhoz tartozó API kulcs. Ha még nincs, akkor létrehozzuk és mentjük session-be.
     * @return String Az API kulcs.
     * @return bool
     */
    public static function setApiKey() {
        if(self::isLoggedIn()){
            $user = User::getUserData();
            if(!empty($user->api)) {
                $_SESSION['userData']->api = $user->api;
            } else {
                $apiKey = md5(md5(uniqid()));
                $db = DB::getInstance();
                $res = $db->query("UPDATE users SET api = ? where username = ?", [$apiKey, self::getUserData()->username]);
                if(empty($res->error())) {
                    $_SESSION['userData']->api = $apiKey;
                } else {
                    $_SESSION['userData']->api = "HIBA AZ ADATBÁZIS KAPCSOLATBAN";
                    return false;
                }
            }
        }
    }

    /**
     * Új API kulcs generálása a felhasználónak. Maximum 1 sessionben 5 alkalommal.
     */
    public static function regenApiKey() {
        if($_SESSION['regen'] > 5) return false;
        $_SESSION['userData']->api = null;
        self::setApiKey();
        return true;
    }

    /**
    * A felhasználó kijelentkeztetése a session megszüntetésével.
    */
    public static function logout() {
        session_destroy();
        header('Location: .');
    }
}
