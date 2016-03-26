<?php
require_once(__DIR__ . '/../config/connect.php');

if(isset($_GET['id']) || $_GET != ''){
    $id = $_GET['id'];
    $output = $print = [];

    $sql = 'SELECT * FROM posts WHERE id=:id';
    $stmtPosts = $handle->prepare($sql);
    $stmtPosts->bindValue(':id', $id, PDO::PARAM_INT);
    $stmtPosts->execute();

    // posts row = 0 = false
    if($stmtPosts->rowCount()){
        $post = $stmtPosts->fetch(PDO::FETCH_ASSOC);

        $sql = 'SELECT * FROM comments WHERE post_id=:post_id AND comment_id=0';
        $stmtComments = $handle->prepare($sql);
        $stmtComments->bindValue(':post_id', $post['id'], PDO::PARAM_INT);
        $stmtComments->execute();

        // comments row = 0 = false
        if($stmtComments->rowCount()){
            $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

            // loop comments
            foreach ($comments as $comment) {
                $sql = 'SELECT * FROM comments WHERE post_id=:post_id AND comment_id=:comment_id';
                $stmtReply = $handle->prepare($sql);
                $stmtReply->bindValue(':post_id', $post['id'], PDO::PARAM_INT);
                $stmtReply->bindValue(':comment_id', $comment['id'], PDO::PARAM_INT);
                $stmtReply->execute();

                // reply row = 0 = false
                if($stmtReply->rowCount()){
                    $reply = $stmtReply->fetchAll(PDO::FETCH_ASSOC);

                    $comment['reply'] = $reply;
                    $output[] = $comment;
                }

            }
        }
        $print['post'] = $post;
        $print['comments_reply'] = $output;
    }
    echo '<pre>';
    print_r( $print);
}

