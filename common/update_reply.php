<?php
require_once(__DIR__ . '/connect.php');

if(isset($_POST['comment_id']) && isset($_POST['reply_id'])){

    $sql = 'UPDATE replys SET details=:details, datetime=NOW() 
            WHERE comment_id=:comment_id AND reply_id=:reply_id';

    $stmt = $handle->prepare($sql);
    $stmt->bindValue(':comment_id', $_POST['comment_id'], PDO::PARAM_INT);
    $stmt->bindValue(':reply_id', $_POST['reply_id'], PDO::PARAM_INT);
    $stmt->bindValue(':details', $_POST['details']);

    if($stmt->execute()){
        echo 'อัพเดทข้อมูล ตอบกลับที่ '.$_POST['reply_id'].' สำเร็จ';
    }

}
// close connect database
$handle = null;