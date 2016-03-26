<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = str_shuffle($characters);
    return substr($characters, 0, $length);
}

//echo generateRandomString();

//echo ceil(microtime(true));

//echo md5(rand(0,999));

echo date('Ymd-His-') . DIRECTORY_SEPARATOR;