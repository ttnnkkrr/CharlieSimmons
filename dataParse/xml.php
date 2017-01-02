<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 4:41 PM
 */
/**
 * Class xml
 * @package data
 */
class xml implements toArray {

    /**
     * @param string $xml
     * @return array
     */
    static
    function src($xml) {
        /**
         * @var SimpleXMLElement
         */
        $doc = simplexml_load_string($xml) or die("Expects well formed XML");
        return json::src(json_encode($doc)) ;
    }


}