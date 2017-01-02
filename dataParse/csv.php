<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 4:39 PM
 */
/** maps out a csv in very simplistic way to a array
 * Class csv
 * @package data
 */
class csv  implements toArray {
    /**
     * @param string $csv
     * @param string $delimiter
     *
     * @return array
     */
    static function src($csv, $delimiter = ',') {
        return array_map("str_getcsv", explode("\n", $csv), [$delimiter]);
    }
}