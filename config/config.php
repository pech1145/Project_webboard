<?php

    ob_start();

    // start session
    session_start();

    // close error php
    error_reporting(1);

    // ประกาศเป็นค่าคงที่ (constant)
    // parameter 3 is case-sensative
    define('DB_HOST', 'localhost', true);
    define('DB_USER', 'root', true);
    define('DB_PASS', '', true);
    define('DB_NAME', 'project_webboard', true);