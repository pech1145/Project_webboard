<?php
require_once(__DIR__ . '/connect.php');

if (isset($_GET['post_id']) && isset($_GET['comment_id']) && isset($_GET['reply_id'])) {

    $post_id = $_GET['post_id'];

    $sql = 'DELETE FROM replys WHERE comment_id=:comment_id AND reply_id=:reply_id';
    $stmt = $handle->prepare($sql);
    $stmt->bindValue(':comment_id', $_GET['comment_id'], PDO::PARAM_INT);
    $stmt->bindValue(':reply_id', $_GET['reply_id'], PDO::PARAM_INT);
    
    if($stmt->execute()){
        // close connect database
        $handle = null;
        echo 'DELETE reply id : ' . $_GET['reply_id'] . ' from comment id : '. $_GET['comment_id'];
        echo "<meta http-equiv='refresh' content='3;URL=../post.php?id=$post_id'>";
    }

}
// close connect database
$handle = null;