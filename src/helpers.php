<?php

function arg($name) {
    if( array_key_exists($_POST, $name) )
        return $_POST[$name];

    if( array_key_exists($_GET, $name) )
        return $_GET[$name];

    return false;
}
