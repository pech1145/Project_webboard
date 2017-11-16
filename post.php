<?php
require_once(__DIR__ . '/common/connect.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/icon.png">
    <title>WTN web board </title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Bootstrap -->
    <link href="asset/css/bootstrap.css" rel="stylesheet">
    <link href="asset/css/smoke.min.css" rel="stylesheet">

    <style>
        .panel-heading {
            position: relative;
        }
        .dropdown {
            position: absolute;
            right: 10px;
            top: 10px;
        }
        .dropdown-menu {
            left: -115px;
        }
        .display-none {
            display: none;
        }
    </style>
</head>
<body>

        <!-- ส่วนของ header-->
        <?php
        require 'navber-menu.php';
        ?>

        <div id="header"></div>  <!---จบ ส่วนbanner-->

        <div class="container">
            <div class="row" id="element">

            <!-------ตรวจสอบค่าว่างในกระทู้------->
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

                        <input type="hidden" value="<?php echo $_GET['id'] ?>" id="post_id">
                        
                        <div class="col-md-12" style="margin-top: 5px">
                            <div class="panel panel-primary">
                                <div class="panel-heading">


                                    <?php //เงื่อนไข เช็คค่ารูป ว่ามีไฟลรูปหรือไม่ จะดึงค่า Default รูป No images
                                    if(is_file('images/' . $post['picture'])){
                                        echo '<img src="images/'.$post['picture'] .'" class="img-responsive img-thumbnail" style="width: 150px;height: 150px">';
                                    } else {
                                        echo '<img src="images/error.png" style="width: 100px;height: 100px">';
                                    }
                                    ?>

                                    <span style="margin-left: 15px"><?php echo $post['title'] ?></span>
                                    <br>
                                    <div style="padding: 10px">ผู้ตั้งกระทู้ <?php echo $post['name'] ?></div>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button"
                                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="edit.php?id=<?php echo $post['id'] ?>">แก้ไข</a></li>
                                            <li>
                                                <a href="<?php echo $post['id'] ?>" class="btnConfirmPosts">ลบ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php
                                        $sql = 'SELECT * FROM `product_image` WHERE post_id=:post_id';
                                        $stmt2 = $handle->prepare($sql);
                                        $stmt2->bindParam(":post_id", $post['id']);
                                        $stmt2->execute();
                                        foreach($stmt2->fetchAll(PDO::FETCH_ASSOC) as $image) {
                                            ?>
                                            <div class="col-md-4 col-lg-4 col-sm-3 col-xs-3">
                                                <?php //เงื่อนไข เช็คค่ารูป ว่ามีไฟลรูปหรือไม่ จะดึงค่า Default รูป No images
                                                if (is_file('images/products/' . $image['image'])) {
                                                    echo '<img src="images/products/' . $image['image'] . '" class="img-responsive img-thumbnail">';
                                                } else {
                                                    echo '<img src="images/error.png" style="width: 50px;height: 50px">';
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <br>
                                    <?php echo $post['details'] ?>
                                </div>
                                <div class="panel-footer">
                                    <?php echo $post['datetime'] ?>
<!--                                    --><?php
//                                    include  'time.php';
//                                    echo thai_date_and_time($post['datetime']);
//                                    ?>
                                </div>
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
                                <div class="col-md-12 node-comments">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            ความคิดเห็นที่ <span class="cm-id"><?php echo $comment['comment_id'] ?></span>

                                            <div class="dropdown" style="float: right;margin-top: -6px">
                                                <button class="btn btn-default dropdown-toggle" type="button"
                                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li>
                                                        <a data-comment-id="<?php echo $comment['comment_id'] ?>"
                                                           data-post-id="<?php echo $comment['post_id'] ?>"
                                                           class="editComment">edit</a>
                                                    </li>
                                                    <li>
                                                        <a data-comment-id="<?php echo $comment['comment_id'] ?>"
                                                           data-post-id="<?php echo $comment['post_id'] ?>"
                                                           class="btnConfirmComments">delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="details"><?php echo $comment['details'] ?></div>
                                            <hr>
                                            <?php
                                            $sql = 'SELECT * FROM reply WHERE comment_id=:comment_id AND post_id=:post_id';
                                            $stmt = $handle->prepare($sql);
                                            $stmt->bindValue(':post_id', $id, PDO::PARAM_INT);
                                            $stmt->bindValue(':comment_id', $comment['comment_id'], PDO::PARAM_INT);
                                            $stmt->execute();
                                            $reply = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            // loop reply
                                            foreach ($reply as $value) { ?>

                                                <div class="col-md-12 node-reply">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">
                                                            ตอบกลับที่ <span
                                                                class="reply-id"><?php echo $value['reply_id']; ?></span>

                                                            <div class="dropdown" style="float: right;margin-top: -6px">
                                                                <button class="btn btn-default dropdown-toggle" type="button"
                                                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                    <li>
                                                                        <a data-reply-id="<?php echo $value['reply_id'] ?>"
                                                                           data-post-id="<?php echo $value['post_id'] ?>"
                                                                           data-comment-id="<?php echo $value['comment_id'] ?>"
                                                                           class="editReply">edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a data-reply-id="<?php echo $value['reply_id'] ?>"
                                                                           data-post-id="<?php echo $value['post_id'] ?>"
                                                                           data-comment-id="<?php echo $value['comment_id'] ?>"
                                                                           class="btnConfirmReply">delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="details-reply"><?php echo $value['details']; ?></div>
                                                        </div>
                                                        <div
                                                            class="panel-footer"><?php echo $value['datetime']; ?></div>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <!---------------------- reply --------------------->
                                            <div class="form-reply"></div>
                                            <!----------------------close reply------------------->


                                        </div>
                                        <div class="panel-footer">
                                            <?php echo $comment['datetime'] ?> <!-------ดึงเวลาคอมเมนออกมาแสดง------>
                                            <a style="float: right;" href="javascript:void(1)" class="btn-reply">ตอบกลับ</a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } // close loop comments
                        } // close if rowCount : comments

                        ?>
                        <!--------------------------------------- form add comment ------------------------------------------->
                        <div class="col-md-12" id="box_add_post">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <label for="details">ความคิดเห็น</label>
                                </div>
                                <div class="panel-body" style="padding: 5px">
                                    <form action="common/add_comment.php" method="post" id="form_post">
                                        <input type="hidden" name="id_post" value="<?=$id?>">
                                        <textarea name="comments" id="comments" rows="5" class="form-control"></textarea>
                                        <div class="text-right" style="margin-top: 10px">
                                            <input type="submit" value="โพส" id="comment_submit" class="btn btn-primary">
                                        </div>
                                    </form>
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
<script src="asset/js/smoke.min.js"></script>

<script src="library/ckeditor/ckeditor.js"></script>

<!--<script src="asset/js/wtn.js"></script>-->
<script src="asset/js/wtn2.js"></script>
    <script>
        CKEDITOR.replace('comments');
//        CKEDITOR.replace('reply');
    </script>
</body>
</html>
