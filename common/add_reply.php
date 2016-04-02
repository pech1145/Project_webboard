<?php
require_once(__DIR__ . '/connect.php');
//print_r($_POST);
//if (false) {
if (isset($_POST['post_id']) && isset($_POST['comment_id'])) {

    // variable
    $post_id = $_POST['post_id'];
    $comment_id = $_POST['comment_id'];
    $details = $_POST['reply'];

    try {
        // insert table reply
        $sql = 'INSERT INTO reply SET post_id=:post_id, comment_id=:comment_id, datetime=NOW(), details=:details,
            reply_id=(SELECT sum(num_reply + 1) FROM comments WHERE comment_id=:comment_id AND  post_id=:post_id)';

        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt->bindValue(':details', $details);

        // insert success
        if ($stmt->execute()) {

            // update table comments column num_reply
            $sql = 'UPDATE comments SET num_reply=(SELECT MAX(reply_id) FROM reply WHERE comment_id=:comment_id)
                    WHERE post_id=:post_id and comment_id=:comment_id';
            $stmt = $handle->prepare($sql);
            $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);

            // update value success
            if ($stmt->execute()) {
                $sql = 'SELECT * FROM reply WHERE comment_id=:comment_id ORDER BY reply_id DESC LIMIT 1';
                $stmt = $handle->prepare($sql);
                $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
                $stmt->execute();
                $reply = $stmt->fetch(PDO::FETCH_ASSOC); ?>

                <div class="col-md-12 node-reply">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            ตอบกลับที่ <span class="reply-id"><?php echo $reply['reply_id'] ?></span>
                            
                            <div class="dropdown" style="float: right;margin-top: -6px">
                                <button class="btn btn-default dropdown-toggle" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li>
                                        <a data-reply-id="<?php echo $reply['reply_id'] ?>"
                                           data-post-id="<?php echo $reply['post_id'] ?>"
                                           data-comment-id="<?php echo $reply['comment_id'] ?>"
                                           class="editReply">edit</a>
                                    </li>
                                    <li>
                                        <a data-reply-id="<?php echo $reply['reply_id'] ?>"
                                           data-post-id="<?php echo $reply['post_id'] ?>"
                                           data-comment-id="<?php echo $reply['comment_id'] ?>"
                                           class="btnConfirmReply">delete</a>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        <div class="panel-body">
                            <div class="details-reply"><?php echo $reply['details']; ?></div>
                        </div>
                        <div class="panel-footer"><?php echo $reply['datetime'] ?></div>
                    </div>
                </div>
                <?php
            }

        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

    // close connect database
    $handle = null;
}