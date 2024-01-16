<?php
date_default_timezone_set('America/Sao_Paulo');

/**
 * SITE CONFIG
 */
define("SITE", [
    "name" => "Bloggs",
    "desc" => "",
    "domain" => "bloggs.com.br",
    "locale" => "pt_BR",
    "root" => "http://localhost/bloggs",
    "year" => date("Y"),
    "color" => "#3B82F6",
]);

/**
 * DATABASE CONNECT
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "bloggs",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("FLASH", 'FLASH_MESSAGES');
define("FLASH_ERROR", 'error');
define("FLASH_WARNING", 'warning');
define("FLASH_INFO", 'info');
define("FLASH_SUCCESS", 'success');