<?php
require_once (__DIR__. '/connect.php');

    if(isset($_GET['id'])) {

        // variable
        $id = $_GET['id'];
        $direction = 'images' . DIRECTORY_SEPARATOR;

        // select picture
        $sql = 'SELECT picture FROM posts WHERE id=:id';
        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $picture = $stmt->fetch(PDO::FETCH_ASSOC);

        // unlink picture
        unlink($direction . $picture['picture']);

        // delete posts
        $sql = 'DELETE FROM posts WHERE id=:id';
        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // check delete success
        if ($stmt->execute()) {
            echo 'delete posts id = ' . $id . ' success';
            echo "<meta http-equiv='refresh' content='3;URL=../index.php'>";
        }
    }