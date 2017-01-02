<?php
/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 2:26 PM
 */
/**
 *
 * create database testdb;
 * use testdb;
 * CREATE TABLE `testdb`.`testtable` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(20) NOT NULL ,
 * `other` VARCHAR(20) NOT NULL , `after` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; INSERT INTO
 * `testtable` (`id`, `name`, `other`, `after`) VALUES (NULL, 'ted', 'sam', 'frank');
 *
 *
 */

$dsn      = 'mysql:host=localhost;dbname=testdb';
$username = 'root';
$password = 'secret';
$options  = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
include 'cli_get.php';

$conn = new PDO($dsn, $username, $password, $options);
$stmt = $conn->prepare("SELECT * FROM testdb.testtable WHERE id = ?");
$r = $stmt->execute([filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT)]) or die(print_r($conn->errorInfo(), true));
var_dump((array) $stmt->fetchObject());