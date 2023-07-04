<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'amanz');
define('DB_PASSWORD', 'password0');
define('DB_DATABASE', 'core_php_cms');

// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', 'localpass');
// define('DB_DATABASE', 'temp_fundermax_cmsdb');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
or die("Connection error: " . mysqli_connect_error());

//set site url
$domain = "http://localhost/core_php_cms/";
// $domain = "http://localhost/core_php_cms";
define( 'SITE_URL', $domain );
$site_url = $domain;

// if( $site_url == ""){
//   $actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//   $actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
//   $fullurl =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
//   $domain  =  "//{$_SERVER['HTTP_HOST']}/";
//   $fileurl = ($_SERVER['REQUEST_URI']);
//   define( 'SITE_URL', $domain );
// }
