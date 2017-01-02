<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 4:42 PM
 */
namespace data;
/**
 * Class json
 * @package data
 */
class json implements toArray {

    /**
     * json constructor.
     * @param string $json expects json encoded string
     *
     * @return array
     */
    public
    function __construct($json) {
        return $this->src($json);
    }

    /**
     * @param string $json expects json encoded string
     *
     * @return array
     */
    public
    function src($json) {
        return json_decode($json,TRUE);
    }
}