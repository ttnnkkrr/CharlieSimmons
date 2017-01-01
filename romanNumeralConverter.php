<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 3:21 PM
 */
include 'CLI_GET.php';
// Create a lookup array that contains all of the Roman numerals.
$model = empty($_GET['model']) ? [] : json_decode($_GET['model'], true);
$whenInRome = new romanNumeralConverter($model);
var_dump($whenInRome->integerToRoman(filter_var($_GET['convert'], FILTER_SANITIZE_NUMBER_INT)));


/** based on some code found here  http://www.hashbangcode.com/blog/php-function-turn-integer-roman-numerals
 * Class romanNumeralConverter
 */
class romanNumeralConverter {

    /**
     * @type array
     */
    var $model
        = ['M'  => 1000,
           'CM' => 900,
           'D'  => 500,
           'CD' => 400,
           'C'  => 100,
           'XC' => 90,
           'L'  => 50,
           'XL' => 40,
           'X'  => 10,
           'IX' => 9,
           'V'  => 5,
           'IV' => 4,
           'I'  => 1];

    /** allows alternat model to be loaded
     * romanNumeralConverter constructor.
     *
     * @param array $model
     */
    public
    function __construct(array $model = []) {
        if(!empty($model)){
            $this->model = $model;
        }
    }


    /** accepts a number and converts it to roman numerals
     * @param int $integer
     *
     * @return string
     */
    public
    function integerToRoman($integer) {
        $result  = '';

        foreach ($this->model as $roman => $value) {
            // Determine the number of matches
            $matches = intval($integer / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }
}