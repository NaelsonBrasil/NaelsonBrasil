<?php

date_default_timezone_set('America/Sao_Paulo');
$timeJwt = time();
$keyJwt = 'example_key2';

$host = 'localhost';
$db   = 'lin2rpg';
$user = 'root';
$pass = '123';
$charset = 'utf8mb4';

define('DB_HOST', $host);
define('DB_NAME', $db);
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB_CHARSET', $charset);

$baseUrl = 'http://localhost/lin2rpg/admin/';
$baseUrlOne = 'http://localhost/lin2rpg/';
define('BASE_URL', $baseUrl);

$reportErros = 0;
$system_operational = "windows";
define('SYSTEM_OPRATIONAL', "windows");
define('EMAIL_CONTACT', "naelson.g.saraiva@gmail.com");
$secretKeyRecaptcha = "6LdvOLEUAAAAAFBN1duGLDJDGbs-i-zNw4CZpWK1";
$recaptchaEnable = false;
