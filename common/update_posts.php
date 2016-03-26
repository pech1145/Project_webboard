<?php
    require_once (__DIR__.'/../common/connect.php');

    if(isset($_POST['id']) && $_POST['id'] !== ''){

        $id = $_POST['id'];
        $direction = '../images' . DIRECTORY_SEPARATOR;


        // uploads file
        if( ($_FILES['picture']['type'] === 'image/jpeg' || $_FILES['picture']['type'] === 'image/png') &&
            ($_FILES['picture']['error'] !== 4 || $_FILES['picture']['size'] === 0)){

            // select picture
            $sql = 'SELECT picture FROM posts WHERE id=:id';
            $stmt = $handle->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $getPicture = $stmt->fetch(PDO::FETCH_ASSOC);
            // unlink image file
            unlink($direction . $getPicture['picture']);

            // set name file image
            $picture = date('Ymd-His-') . $id . '.jpg';

            // rename move file
            rename($_FILES['picture']['tmp_name'], $direction . DIRECTORY_SEPARATOR .  $picture);

            // update picture
            $sql = 'UPDATE posts SET picture=:picture WHERE id=:id';
            $stmt = $handle->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':picture', $picture);
            $stmt->execute();
        }

        // update posts
        $sql = 'UPDATE posts SET name=:name, title=:title, details=:details, datetime=NOW() WHERE id=:id';
        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':details', $_POST['details']);
        
        if($stmt->execute()){
            echo 'update posts id = ' . $id . ' success';
            echo "<meta http-equiv='refresh' content='3;URL=../index.php'>";
        }
    }