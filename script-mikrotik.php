<?php
require_once './vendor/autoload.php';
use PEAR2\Net\RouterOS;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

# create connection 
try {
	$client = new RouterOS\Client('192.168.88.1', 'admin', 'password');
} catch (Exception $e) {
	error_log("Cannot create connection => " . var_export($e, true));
	die();
}

# create query string
$request = new RouterOS\Request('/system/resource/print');

# run quesry
try {
	$responses = $client->sendSync($request);
} catch (Exception $e) {
	error_log("Cannot query your request => " . var_export($e, true));
	die();
}

# display result
foreach ($responses as $response) {
	foreach ($response as $name => $value) {
		echo "{$name}: {$value}\n";
	}
}
