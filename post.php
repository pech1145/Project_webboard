<?php
require_once(__DIR__. '/config/connect.php');
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
</head>
<body>

<div class="container">
    <div class="row">
    <?php
        if(isset($_GET['id']) || $_GET != ''){
            $id = $_GET['id'];
            $output = [];

            $sql = 'SELECT * FROM posts WHERE id=:id';
            $stmtPosts = $handle->prepare($sql);
            $stmtPosts->bindValue(':id', $id, PDO::PARAM_INT);
            $stmtPosts->execute();

            // posts row = 0 = false
            if($stmtPosts->rowCount()){
                $post = $stmtPosts->fetch(PDO::FETCH_ASSOC);

    ?>
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <?php echo 'id:'.$post['id'] . ' - ผู้ตั้งกระทู้ : ' . $post['name'] . ' - Image : '. $post['picture'] ?>
                        </div>
                        <div class="panel-body"><?php echo $post['details'] ?></div>
                        <div class="panel-footer"><?php echo $post['time'] ?></div>
                    </div>
                </div>
    <?php


                $sql = 'SELECT * FROM comments WHERE post_id=:post_id AND comment_id=0';
                $stmtComments = $handle->prepare($sql);
                $stmtComments->bindValue(':post_id', $post['id'], PDO::PARAM_INT);
                $stmtComments->execute();

                // comments row = 0 = false
                if($stmtComments->rowCount()){
                    $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

                    // loop comments
                    foreach ($comments as $comment) {
    ?>
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <?php echo 'id:'.$comment['id'] . ' - ' . $comment['comply'] ?>
                                </div>
                                <div class="panel-body">
                                    <?php echo $comment['details'] ?> <br>
                                    <?php //echo $comment['time'] ?>
                                    <hr>

    <?php

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

                            foreach ($reply as $value){
    ?>
                                <div class="col-md-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <?php echo 'id:'.$value['id'] . ' - ' . $value['comply'] ?>
                                        </div>
                                        <div class="panel-body"><?php echo $value['details'] ?>

                                        </div>
                                        <div class="panel-footer"><?php echo $value['time'] ?></div>
                                    </div>
                                </div>
    <?php
                            }
                        }
    ?>
                                </div>
                                <div class="panel-footer"><?php echo $comment['time'] ?></div>
                            </div>
                        </div>
    <?php

                    }
                }
                $print['post'] = $post;
                $print['comments_reply'] = $output;
            }
//            echo '<pre>';
//            print_r( $print);
        }
    ?>
    </div>
</div>









<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>

