<?php
require 'vendor/autoload.php';

/** @var Altorouter */
$router = new AltoRouter();

// map Homepage
$router->map('GET', '/', function(){
    require ('home.php');

});

// Dynamic named route
$router->map('GET', '/contact', function(){
	require ('contact.php');
});

$match = $router-> match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}