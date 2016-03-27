<?php
    require_once (__DIR__ . '/connect.php');

if (isset($_POST['id_post']) && $_POST['details'] !== '') {

    $id_post = $_POST['id_post'];
    $details = $_POST['details'];

    // read comment from table posts


    $sql = 'INSERT INTO comments 
            SET post_id=:post_id, details=:details, datetime=NOW(), 
            comment_id=(SELECT SUM(num_comment + 1) FROM posts WHERE id=:post_id)';
    $stmt = $handle->prepare($sql);
    $stmt->bindValue(':post_id', $id_post);
    $stmt->bindValue(':details', $details);

    if($stmt->execute()){
        // update comment_id
        $sql = 'UPDATE posts 
                SET num_comment=(SELECT MAX(comment_id) FROM comments WHERE post_id=:post_id) 
                WHERE posts.id=:post_id';
        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':post_id', $id_post);

        if ($stmt->execute()) {
//            echo 'success';
            $sql = 'SELECT * FROM comments WHERE post_id=:post_id ORDER BY comment_id DESC LIMIT 1';
            $stmt = $handle->prepare($sql);
            $stmt->bindValue(':post_id', $id_post, PDO::PARAM_INT);
            $stmt->execute();
            $comment = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        ความคิดเห็นที่  <span class="cm-id"><?php echo $comment['comment_id'] ?></span>
                        <div class="text-right">
                            <a href="javascript:void(0)" class="edit-comment" data-post-id="<?php echo $id_post ?>">edit</a>
                            |
                            <a href="common/delete_comment.php?post_id=<?php echo $id_post ?>&cm_id=<?php echo $comment['comment_id'] ?>">delete</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="details"><?php echo $comment['details'] ?></div>
                        <hr>
                    </div>
                    <div class="panel-footer">
                        <?php echo $comment['datetime'] ?>
                        <a style="float: right;" href="javascript:void(1)" class="btn-reply">ตอบกลับ</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    // close connect database
    $handle = null;

} 