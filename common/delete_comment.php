<?php
require_once (__DIR__. '/connect.php');

if ((isset($_POST['post_id']) && $_POST['post_id'] !== '')
    && (isset($_POST['comment_id']) && $_POST['comment_id'] !== '')) {

    // variable
    $post_id = $_POST['post_id'];
    $comment_id = $_POST['comment_id'];

    $sql = 'DELETE FROM comments WHERE post_id=:post_id AND comment_id=:comment_id';
    $stmt = $handle->prepare($sql);
    $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // close connect database
        $handle = null;
//        echo 'DELETE comment id : ' . $comment_id . ' from post id : '. $post_id;
//        echo "<meta http-equiv='refresh' content='3;URL=../post.php?id=$post_id'>";
        echo true;
    } else {
        echo false;
    }

}
// close connect database
$handle = null;
