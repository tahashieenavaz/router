<?php

function arg($name) {
    $correctedPostParams = [];
    foreach($_POST as $key => $value) {
        $key = trim($key, '_');
        $correctedPostParams[$key] = $value;
    }


    if( array_key_exists($name, $correctedPostParams) )
        return $correctedPostParams[$name];

    if( array_key_exists($name, $_GET) )
        return $_GET[$name];

    return false;
}
