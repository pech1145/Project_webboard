<?php

    ob_start();

    // start session
    session_start();

    // close error php
    error_reporting(1);

    // ประกาศเป็นค่าคงที่ (constant)
    define('DB_HOST', 'localhost', true);
    define('DB_USER', 'localhost', true);
    define('DB_PASS', 'localhost', true);
    define('DB_NAME', 'localhost', true);