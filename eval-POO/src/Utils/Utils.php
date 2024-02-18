<?php

namespace App\Utils ; 

use Exception ; 

class Utils {

    public static $format = "d-m-Y";
    public static function dateFormat ($date) {
            return date(self::$format, strtotime($date) );
    }
}
?>