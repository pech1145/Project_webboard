<?php
require_once(__DIR__ . '/connect.php');

if (isset($_POST['post_id']) && isset($_POST['comment_id']) && isset($_POST['reply_id'])) {

    $post_id = $_POST['post_id'];

    $sql = 'DELETE FROM reply WHERE comment_id=:comment_id AND reply_id=:reply_id AND post_id=:post_id';
    $stmt = $handle->prepare($sql);
    $stmt->bindValue(':post_id', $_POST['post_id'], PDO::PARAM_INT);
    $stmt->bindValue(':comment_id', $_POST['comment_id'], PDO::PARAM_INT);
    $stmt->bindValue(':reply_id', $_POST['reply_id'], PDO::PARAM_INT);

    if($stmt->execute()){
        // close connect database
        $handle = null;

        // echo 'DELETE reply id : ' . $_GET['reply_id'] . ' from comment id : '. $_GET['comment_id'];
        // echo "<meta http-equiv='refresh' content='3;URL=../post.php?id=$post_id'>";
        echo true;
    } else {
        echo false;
    }

}
// close connect database
$handle = null;
