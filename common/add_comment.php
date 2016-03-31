<?php
    require_once (__DIR__ . '/connect.php');

if (isset($_POST['id_post']) && $_POST['comments'] !== '') {

    $id_post = $_POST['id_post'];
    $details = $_POST['comments'];

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
            <div class="col-md-12 node-comments">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        ความคิดเห็นที่  <span class="cm-id"><?php echo $comment['comment_id'] ?></span>
                        <div class="dropdown" style="float: right;margin-top: -6px">
                            <button class="btn btn-default dropdown-toggle" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="edit.php?id=<?php echo $comment['id'] ?>">edit</a></li>
                                <li>
                                    <a href="<?php echo $comment['id'] ?>">delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="details"><?php echo $comment['details'] ?></div>
                        <hr>
                        <div class="form-reply"></div>
                    </div>
                    <div class="panel-footer">
                        <?php echo $comment['datetime'] ?>
                        <a style="float: right;" href="javascript:void(1)"
                           class="btn-reply">ตอบกลับ</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    // close connect database
    $handle = null;

} 