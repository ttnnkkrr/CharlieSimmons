<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 6:44 PM
 */

/** the papi for parsing files. this file is consumable as the interface to implement the NABC code test
 * Class parse
 * @package data
 */
class parse {
    /**
     * @type array
     */
    private $mapping
        = ['id'         => 0,
           'name'       => 1,
           'quantity'   => 2,
           'categories' => 3];
    /**
     * @type array
     */
    private $data = [];

    /** Load and determin the file type.
     * @api
     *
     * @param string|path $resource technically could be a data string or a file path
     *
     * @return array data from parsed resource
     */
    public
    function __construct($resource) {
        $type = 'csv';
        $data = $resource;
        if (is_string($resource)) {

            if (file_exists($resource)) {
                $path_parts = pathinfo($resource);
                switch ($path_parts['extension']) {
                    case 'csv':
                    case 'txt':
                        $type = 'csv';
                        break;
                    case'xml':
                        $type = 'xml';
                        break;
                    default:
                        $type = 'csv';
                }
                $data = file_get_contents($resource);
            }
        }
        if ($this->isJson($data)) {
            $type = 'json';
        }

        $this->data = $type::src($data);
        $this->data = $this->parse();
    }

    /**
     * @param $string
     *
     * @return bool
     */
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * @return array
     */
    private
    function getMap() {
        return $this->mapping;
    }

    /*
     * @param        $data
     * @param string $categoryDelimiter
     *
     * @return array
     */
    /**
     * @param string $categoryDelimiter
     *
     * @return array
     */
    private
    function parse($categoryDelimiter = ';') {
        $data = $this->data;
        $parsedFile = [];
        if (!empty($data)){
            $mapping    = $this->getMap();
            $data = $this->getLines($data);
            foreach ($data as $line) {

                $categories = $line[ $mapping['categories'] ];
                if (strlen(trim($categories)) > 0) {
                    $line[ $mapping['categories'] ] = explode($categoryDelimiter, $categories);
                }
                else {
                    $line[ $mapping['categories'] ] = [];
                }
                $parsedFile[] = $line;

            }
        }
        return $parsedFile;
    }
private function getLines($data){

    if (@is_array($data['row'])){
        $rdata=$data['row'];
        unset($data);
        foreach ($rdata as $i=>$row) {

            $data[$i][0] = empty($row["FIELD1"])?'':$row["FIELD1"];
            $data[$i][1] = empty($row["FIELD2"])?'':$row["FIELD2"];
            $data[$i][2] = empty($row["FIELD3"])?'':$row["FIELD3"];
            ;
            $data[$i][3] = empty($row["FIELD4"])?'':$row["FIELD4"];
        }

    }
    if (@$data[0]['FIELD1']){
        $rdata=$data;
        unset($data);
        foreach ($rdata as $i=>$row) {

            $data[$i][0] = empty($row["FIELD1"])?'':$row["FIELD1"];
            $data[$i][1] = empty($row["FIELD2"])?'':$row["FIELD2"];
            $data[$i][2] = empty($row["FIELD3"])?'':$row["FIELD3"];
            ;
            $data[$i][3] = empty($row["FIELD4"])?'':$row["FIELD4"];
        }

    }
    return $data;
}
    /**
    */
    public
    function format() {
        $data       = $this->data;
        $outPut = '';
        if (!empty($data)) {
            $mapping = $this->getMap();
            foreach ($data as $line) {
                $id         = $line[ $mapping['id'] ];
                $name       = $line[ $mapping['name'] ];
                $quantity   = strlen(trim($line[ $mapping['quantity'] ])) > 0
                    ? '(' . $line[ $mapping['quantity'] ] . ')'
                    : '';
                $categories = $line[ $mapping['categories'] ];
                $heading    = "{$id} {$name} {$quantity}";
                if (strlen(trim($heading)) > 0) {
                    $outPut .= $heading . "\n";
                }
                foreach ($categories as $category) {
                    if (strlen(trim($category)) > 0) {
                        $outPut .= '- ' . $category . "\n";
                    }
                }
            }
        }
        return $outPut;
    }
}