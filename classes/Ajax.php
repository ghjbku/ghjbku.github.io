<?php

/**
 * Ajax válaszfunkciók
 */
class Ajax {
    /**
     * Ha a kérés sikeres volt.
     * @param array $array A választ tartalmazó tömb.
     */
    public static function success($array = []) {
        $array['error'] = false;
        die(json_encode($array));
    }

    /**
     * API kérés esetén ellenőrzi az API kulcs valódiságát.
     * @param String $key API kulcs
     * @return bool
     */
    public static function checkApiKey($key) {
        if(!User::isLoggedIn() && self::apiRequest()) {
            $db = DB::getInstance();
            if(!empty($db->query("SELECT * FROM users where api = ?", [$key])->results())) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * API kulcsos request-e a kérés?
     * @return bool
     */
    public static function apiRequest() {
        return isset($_POST['api']);
    }
    /**
     * Ha a kérés sikertelen volt.
     * @param array $array A választ tartalmazó tömb.
     */
    public static function error($array = []) {
        $array['error'] = true;
        die(json_encode($array));
    }

    /**
     * Csak jogosult felhasználók férjenek hozzá a kéréshez.
     * @param bool $onlyWeb Csak webes felületről hozzáférhető-e API endpoint?
     * @return mixed
     */
    public static function onlyLoggedIn($onlyWeb = false) {
        if(User::isLoggedIn()){
            return true;
        } else if(self::apiRequest() && !$onlyWeb){
            if(!Ajax::checkApiKey($_POST['api']))
                die(self::error(['message' => 'Hibás API kulcs!']));   
        } else {
            die(self::error(['message' => 'A rendszer nem tudta feldolgozni a kérésed!']));
        }
    }
}