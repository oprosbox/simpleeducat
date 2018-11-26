<?php

function get_home_url() {
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
    return ($protocol . $_SERVER['HTTP_HOST']);
}





