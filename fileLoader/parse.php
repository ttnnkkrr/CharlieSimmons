<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 6:44 PM
 */
namespace data;
/** the papi for parsing files. this file is consumable as the interface to implement the NABC code test
 * Class parse
 * @package data
 */
abstract
class parse implements toArray {
    /**
     * @type array
     */
    private $mapping = ['id'         => 0,
                        'name'       => 1,
                        'quantity'   => 2,
                        'categories' => 3];

    /** Load and determin the file type.
     * @api
     * @param string|path $resource technically could be a data string or a file path
     *
     * @return array data from parsed resource
     */
    function src($resource) {
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
        if (isJson($data)) {
            $type = 'json';
        }
        return new $type($data);
    }

    /**
     * @return array
     */
    private
    function getMap() {
        return $this->mapping;
    }

    /**
     * @param        $data
     * @param string $categoryDelimiter
     *
     * @return array
     */
    public function parse($data, $categoryDelimiter = ';')
    {
        $mapping = $this->getMap();
        $parsedFile = [];
        foreach($data as $line){
            $categories = $line[$mapping['categories']];
            if(strlen(trim($categories)) > 0)
            {
                $line[$mapping['categories']] = explode($categoryDelimiter, $categories);
            }
            else {
                $line[$mapping['categories']] = [];
            }
            $parsedFile[] = $line;

        }
        return $parsedFile;
    }

    /**
     * @param $data
     */
    public function format($data)
    {
        $mapping = $this->getMap();
        foreach($data as $line) {
            $id = $line[$mapping['id']];
            $name = $line[$mapping['name']];
            $quantity = strlen(trim($line[$mapping['quantity']])) > 0 ? '(' . $line[$mapping['quantity']] . ')' : '';
            $categories = $line[$mapping['categories']];
            $heading = "{$id} {$name} {$quantity}";
            if (strlen(trim($heading)) > 0) {
                echo $heading . "\n";
            }
            foreach ($categories as $category) {
                if (strlen(trim($category)) > 0) {
                    echo '- ' . $category . "\n";
                }
            }
        }
    }
}