<?php
    require_once(__DIR__ . '/../config/config.php');
    try {
        $handle = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        // set the PDO error mode to exception
        $handle->getAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // set the charset
        $handle->exec('set names utf8');
    } catch(PDOException $ex) {
        echo 'Connected failed: ' . $ex->getMessage();
    }