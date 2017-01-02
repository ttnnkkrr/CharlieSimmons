<?php
/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 8:44 PM
 */
include 'dataParse/toArray.php';
include 'dataParse/csv.php';
include 'dataParse/json.php';
include 'dataParse/parse.php';
include 'dataParse/xml.php';

include 'cli_get.php';
$parser = new \parse($_GET['resource']);
print $parser->format();