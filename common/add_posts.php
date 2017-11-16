<?php
require_once (__DIR__. '/connect.php');

if(isset($_POST)){

    $direction = '../images';
    $picture = '';

    // uploads picture
    if($_FILES['picture'] && ($_FILES['picture']['type'] === 'image/jpeg' || $_FILES['picture']['type'] === 'image/png')){

        $picture = date('Ymd-His-') . $_FILES['picture']['name'];

        // rename
        rename($_FILES['picture']['tmp_name'], $direction . DIRECTORY_SEPARATOR .  $picture);
    }

    $imgArr = [];
    // uploads images
    if(count($_FILES['images']['name']) > 0) {
        $images = $_FILES['images'];
        for($i = 0; $i < count($images['name']); $i++) {
            if($images['type'][$i] === 'image/jpeg' || $images['type'][$i] === 'image/png'){
                $imgArr[] = $image = date('Ymd-His-') . $images['name'][$i];
                // rename
                rename($images['tmp_name'][$i], $direction . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . $image);
            }
        }
    }

    $sql = 'INSERT INTO posts SET name=:name, title=:title, details=:details, picture=:picture, datetime=NOW()';
    $stmt = $handle->prepare($sql);
    $stmt->bindParam(":name", $_POST['name']);
    $stmt->bindParam(":title", $_POST['title']);
    $stmt->bindParam(":details", $_POST['details']);
    $stmt->bindParam(":picture", $picture);

    if($stmt->execute()){
        $post_id = $handle->lastInsertId();

        // insert product image
        foreach($imgArr as $img) {
            $sql = "INSERT INTO product_image SET post_id=:post_id, image=:image";
            $stmt = $handle->prepare($sql);
            $param[':post_id'] = $post_id;
            $param[':image'] = $img;
            $stmt->execute($param);
        }

        $_SESSION['add-posts'] = true;
        header('Location: ../index.php');
    }
    // close connect database
    $handle = null;
}

