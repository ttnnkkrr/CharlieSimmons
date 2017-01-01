<?php

/**
 * Created by PhpStorm.
 * User: tank
 * Date: 1/1/17
 * Time: 4:04 PM
 */

/** if called from CLI sets get variables for $_GET
 * Class CLI_GET
 */

class CLI_GET {

    /**
     * CLI_GET constructor.
     */
    public
    function __construct($argv) {
        // this way it works from CLI or web page exactly the same
        if (php_sapi_name() === 'cli') {
            // the first param is the name of the file so lets just trash it
            unset($argv[0]);
            foreach ($argv as $arg) {
                $e = explode("=", $arg);
                if (count($e) == 2) {
                    $_GET[ $e[0] ] = $e[1];
                }
                else {
                    $_GET[ $e[0] ] = 0;
                }
            }
        }
        if (empty($_GET)){
            die("You didnt pass any parameters\n");
        }
    }
}
// autoexecute
new CLI_GET($argv);