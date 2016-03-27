<?php
require_once(__DIR__ . '/common/connect.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WTN web board</title>

    <!-- Bootstrap -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .display-none {
            display: none;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="row" id="element">


        <?php
        if (isset($_GET['id']) || $_GET != '') {
        $id = $_GET['id'];
        $output = [];

        $sql = 'SELECT * FROM posts WHERE id=:id';
        $stmtPosts = $handle->prepare($sql);
        $stmtPosts->bindValue(':id', $id, PDO::PARAM_INT);
        $stmtPosts->execute();

        // posts row = 0 = false
        if ($stmtPosts->rowCount()) {
            $post = $stmtPosts->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <?php echo $post['title'] ?> - picture <?php echo $post['picture'] ?><br>
                        ผู้ตั้งกระทู้ <?php echo $post['name'] ?>
                        <div class="text-right">
                            <a href="edit.php?id=<?php echo $post['id'] ?>" style="color: #FFFFFF;">edit</a>
                            |
                            <a href="common/delete_posts.php?id=<?php echo $post['id']?>" style="color: #FFFFFF;">delete</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo $post['details'] ?>
                    </div>
                    <div class="panel-footer"><?php echo $post['datetime'] ?></div>
                </div>
            </div>

            <!-------------------------- comments -------------------------------->
            <?php
            // select table comments
            $sql = 'SELECT * FROM comments WHERE post_id=:post_id ORDER BY comment_id ASC ';
            $stmtComments = $handle->prepare($sql);
            $stmtComments->bindValue(':post_id', $id, PDO::PARAM_INT);
            $stmtComments->execute();

            // comments row = 0 = false
            if ($stmtComments->rowCount()) {
                $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

                // loop comments
                foreach ($comments as $comment) {
                    ?>
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                ความคิดเห็นที่  <span class="cm-id"><?php echo $comment['comment_id'] ?></span>
                                <div class="text-right">
                                    <a href="javascript:void(0)" class="edit-comment" data-post-id="<?php echo $id ?>">edit</a>
                                    |
                                    <a href="common/delete_comment.php?post_id=<?php echo $id ?>&cm_id=<?php echo $comment['comment_id'] ?>">delete</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="details"><?php echo $comment['details'] ?></div>
                                <hr>
                                <?php
                                $sql = 'SELECT * FROM replys WHERE comment_id=:comment_id';
                                $stmt = $handle->prepare($sql);
                                $stmt->bindValue(':comment_id', $comment['comment_id'], PDO::PARAM_INT);
                                $stmt->execute();
                                $reply = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // loop reply
                                foreach ($reply as $value) { ?>

                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                ตอบกลับที่ <span class="reply-id"><?php echo $value['reply_id']; ?></span>
                                                <div class="text-right">
                                                    <a href="javascript:void(0)" class="edit-reply" data-comment-id="<?php echo $value['comment_id'] ?>">edit</a>
                                                    |
                                                    <a href="common/delete_reply.php?post_id=<?php echo $comment['post_id']; ?>&comment_id=<?php echo $value['comment_id']; ?>&reply_id=<?php echo $value['reply_id']; ?>">delete</a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <?php echo $value['details']; ?>
                                            </div>
                                            <div class="panel-footer"><?php echo $value['datetime']; ?></div>
                                        </div>
                                    </div>

                                <?php } ?>

                                <!---------------------- reply --------------------->

                                <div class="form-group reply text-center display-none">
                                    <label for="reply">ตอบกลับ</label>
                                    <textarea name="reply" id="reply" rows="2" class="form-control"></textarea>
                                    <div class="text-right" style="margin-top: 5px">
                                        <input type="reset" value="ล้าง" class="reply_reset btn btn-warning">
                                        <input type="submit" value="ตอบกลับ" class="reply_submit btn btn-primary">
                                    </div>
                                </div>
                                <!----------------------close reply------------------->


                            </div>
                            <div class="panel-footer">
                                <?php echo $comment['datetime'] ?>
                                <a style="float: right;" href="javascript:void(1)" class="btn-reply">ตอบกลับ</a>
                            </div>
                        </div>
                    </div>

                    <?php
                } // close loop comments
            } // close if rowCount : comments

                ?>
                <!--------------------------------------- form add comment ------------------------------------------->
                <div class="col-md-12" id="form_post">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <label for="details">ความคิดเห็น</label>
                        </div>
                        <div class="panel-body" style="padding: 5px">
                            <textarea name="details" id="details" rows="5" class="form-control"></textarea>
                            <div class="text-right" style="margin-top: 10px">
                                <input type="reset" value="ล้างข้อมูล" id="comment_reset" class="btn btn-warning">
                                <input type="submit" value="โพส" id="comment_submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------------------  close form add comment --------------------------------------->
                <?php

            } // close if rowCount : posts
        } // close if isset($_GET['id'])
        ?>
    </div> <!-- row -->
</div> <!-- container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="asset/js/bootstrap.min.js"></script>

<script src="library/ckeditor/ckeditor.js"></script>

<script src="asset/js/wtn.js"></script>
</body>
</html>