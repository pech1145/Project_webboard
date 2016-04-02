<?php
require_once (__DIR__. '/connect.php');

if(isset($_POST)){

    $direction = '../images';
    $picture = '';

    // uploads
    if($_FILES['picture'] && ($_FILES['picture']['type'] === 'image/jpeg' || $_FILES['picture']['type'] === 'image/png')){

        $picture = date('Ymd-His-') . $_FILES['picture']['name'];

        // rename
        rename($_FILES['picture']['tmp_name'], $direction . DIRECTORY_SEPARATOR .  $picture);
    }

    $sql = 'INSERT INTO posts SET name=:name, title=:title, details=:details, picture=:picture, datetime=NOW()';
    $stmt = $handle->prepare($sql);
    $param[':name'] = $_POST['name'];
    $param[':title'] = $_POST['title'];
    $param[':details'] = $_POST['details'];
    $param[':picture'] = $picture;

    if($stmt->execute($param)){
        $_SESSION['add-posts'] = true;
        header('Location: ../index.php');
    }
    // close connect database
    $handle = null;
}

