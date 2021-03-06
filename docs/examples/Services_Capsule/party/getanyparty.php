<?php
set_include_path(get_include_path() . PATH_SEPARATOR . (dirname(dirname(dirname(dirname(dirname(__FILE__)))))));
require_once 'Services/Capsule.php';
include '../config.php';

// Fetch "Any" by email
$getAnyParameters = array(
    'tag' => 'sales',
);

try {
    $capsule = new Services_Capsule($config['appName'], $config['token']);
    $res = $capsule->party->getAny($getAnyParameters);
} catch (Services_Capsule_Exception $e) {
    print_r($e);
    die();
}

var_dump($res); die();
