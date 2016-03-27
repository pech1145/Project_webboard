<?php
require_once(__DIR__ . '/connect.php');

if (isset($_POST['post_id']) && isset($_POST['comment_id'])) {

    // variable
    $post_id = $_POST['post_id'];
    $comment_id = $_POST['comment_id'];
    $details = $_POST['details'];

    try {
        // insert table reply
        $sql = 'INSERT INTO replys SET comment_id=:comment_id, datetime=NOW(), details=:details,
            reply_id=(SELECT sum(num_reply + 1) FROM comments WHERE comment_id=:comment_id AND  post_id=:post_id)';

        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt->bindValue(':details', $details);

        // insert success
        if ($stmt->execute()) {

            // update table comments column num_reply
            $sql = 'UPDATE comments SET num_reply=(SELECT MAX(reply_id) FROM replys WHERE comment_id=:comment_id)
                    WHERE post_id=:post_id and comment_id=:comment_id';
            $stmt = $handle->prepare($sql);
            $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);

            // update value success
            if ($stmt->execute()) {
                $sql = 'SELECT * FROM replys WHERE comment_id=:comment_id ORDER BY reply_id DESC LIMIT 1';
                $stmt = $handle->prepare($sql);
                $stmt->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
                $stmt->execute();
                $reply = $stmt->fetch(PDO::FETCH_ASSOC); ?>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            ตอบกลับที่ <span class="reply-id"><?php echo $reply['reply_id'] ?></span>
                            <div class="text-right">
                                <a href="javascript:void(0)" onclick="editReply()" class="edit-reply" data-comment-id="<?php echo $reply['comment_id'] ?>">edit</a>
                                |
                                <a href="common/delete_reply.php?post_id=<?php echo $post_id; ?>&comment_id=<?php echo $reply['comment_id']; ?>&reply_id=<?php echo $reply['reply_id']; ?>">delete</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $details ?>
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