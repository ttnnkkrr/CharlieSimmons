<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 4:41 PM
 */
namespace data;
/**
 * Class xml
 * @package data
 */
class xml extends json implements toArray {

    /**
     * xml constructor.
     *
     * @param string $xml
     * return array
     */
    public
    function __construct($xml) {
        /**
         * @var SimpleXMLElement
         */
        $doc = simplexml_load_string($xml) or die("Expects well formed XML");
        return $this->src(json_encode($doc)) ;
    }


}