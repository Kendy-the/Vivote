<?php
include_once 'C:/wamp64/www/Vivote/config.php';
require_once DATABASE_PATH.'/database.php';

function get_listes($input){
    $output = preg_split('/\r\n|\r|\n/', $input);
    return $output;
}

function delete_space($objectifs){
    return trim($objectifs);
}

?>