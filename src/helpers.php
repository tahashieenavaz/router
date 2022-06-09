<?php

function arg($name) {
    if( array_key_exists($name, $_POST) )
        return $_POST[$name];

    if( array_key_exists($name, $_GET) )
        return $_GET[$name];

    return false;
}
