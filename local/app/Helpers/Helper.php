<?php

namespace App\Helpers;

class Helper {

    public static function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    public static function time_since_for_classified($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'y'),
            array(60 * 60 * 24 * 30 , 'M'),
            array(60 * 60 * 24 * 7, 'w'),
            array(60 * 60 * 24 , 'd'),
            array(60 * 60 , 'h'),
            array(60 , 'm'),
            array(1 , 's')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1'.$name : "$count{$name}";
        return $print;
    }

    /**
     * Some urls may not have any protocol included. This function will add a protocol to show
     * the URL on the web properly.
     * 
     * @param string $url
     * @return mixed
     */
    public static function show_url($url = null) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }

}

?>