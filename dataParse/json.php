<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 4:42 PM
 */
/**
 * Class json
 * @package data
 */
class json implements toArray {
    /**
     * @param string $json expects json encoded string
     *
     * @return array
     */
    static
    function src($json) {
        return json_decode($json,TRUE);
    }
}