<?php
require_once(__DIR__ . '/connect.php');

if(isset($_POST['post_id']) && isset($_POST['comment_id'])){

    $sql = 'UPDATE comments SET details=:details, datetime=NOW() 
            WHERE comment_id=:comment_id AND post_id=:post_id';

    $stmt = $handle->prepare($sql);
    $stmt->bindValue(':post_id', $_POST['post_id'], PDO::PARAM_INT);
    $stmt->bindValue(':comment_id', $_POST['comment_id'], PDO::PARAM_INT);
    $stmt->bindValue(':details', $_POST['details']);

    if($stmt->execute()){
        echo 'อัพเดทข้อมูล ความคิดเห็นที่ '.$_POST['comment_id'].' สำเร็จ';
    }

}
// close connect database
$handle = null;