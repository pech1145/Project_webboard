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
    <link href="image/icon.png" rel="icon" >
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Bootstrap -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/smoke.min.css" rel="stylesheet">

    <style>
        .panel-heading {
            position: relative;
            height: 120px;
        }
        .panel-body {
            overflow: hidden;
            /*height: 100px;*/
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
        .image-show {
            width: 80px;
        }
        .name-posts {
            position: absolute;
            top: 10px;
            left: 115px;
        }
        .btn-reply {
            /*position: absolute;*/
            width: 100px;
            /*right: 20px;
            top: 70px;*/
        }
    </style>
</head>
<body>


<!-- ส่วนของ header-->
<?php
    require ('navber-menu.php');
?>


<div id="header"></div>


    <div class="container">
        <div class="row">
            <!--ส่วนเรียกค่าจากฐานข้อมูลมาเรียงลำดับ-->
            <?php
            $sql = 'SELECT * FROM posts ORDER BY datetime DESC';
            $stmt = $handle->prepare($sql);
            $stmt->execute();

            // row = 0 = false
            if ($stmt->rowCount()) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data as $value) {
                    ?>
                    <div class="col-md-12 box" style="margin-top: 5px">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="image-show">
                                    <?php //เงื่อนไข เช็คค่ารูป ว่ามีไฟลรูปหรือไม่ จะดึงค่า Default รูป No images
                                    if (is_file('images/' . $value['picture'])) {
                                        echo '<img src="images/' . $value['picture'] . '" class="img-responsive img-thumbnail">';
                                    } else {
                                        echo '<img src="images/error.png" style="width: 50px;height: 50px">';
                                    }
                                    ?>
                                </div>
                                <div class="name-posts">
                                    <h3><?php echo $value['title'] ?></h3>
                                    <h4><?php echo 'ผู้ตั้งกระทู้ : ' . $value['name'] ?></h4>
                                </div>

                                <!--------เมนูแก้ไข / ลบ---------->
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                            id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="true">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="edit.php?id=<?php echo $value['id'] ?>">แก้ไข</a></li> <!----แก้ไขข้อมูล id หรือกระทู้------->
                                        <li>
                                            <a href="<?php echo $value['id'] ?>" class="btnConfirmPosts">ลบ</a> <!----ลบข้อมูล id หรือกระทู้------->
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <?php
                                    $sql = 'SELECT * FROM `product_image` WHERE post_id=:post_id';
                                    $stmt2 = $handle->prepare($sql);
                                    $stmt2->bindParam(":post_id", $value['id']);
                                    $stmt2->execute();
                                    foreach($stmt2->fetchAll(PDO::FETCH_ASSOC) as $image) {
                                        ?>
                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
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

                                <?php //echo $value['details'] ?> <!----แสดง รายละเอียด ---->
                                <div class="text-right">
                                    <a href="post.php?id=<?php echo $value['id'] ?>" class="btn-reply">อ่านต่อ >>></a><!-------คำสั่งอ่านต่อ เมื่อมีการกดอ้างอิงจาก id ของกระทู้------->
                                </div>
                            </div>
                            <div class="panel-footer">
                                <?php echo $value['datetime'] ?> <!-------ส่วนที่เวลาที่ตั้งกระทู้--------->
                                <!--                            --><?php
                                //                             include  'time.php';
                                //                                echo thai_date_and_time($value['datetime']);
                                //                            ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/smoke.min.js"></script>
<script src="asset/js/wtn2.js"></script>

<?php
    if(isset($_SESSION['add-posts']) && $_SESSION['add-posts']){
        unset($_SESSION['add-posts']);
        ?>
        <script>
            $.smkAlert({text: 'เพิ่มข้อมูล<strong>สำเร็จ</strong>', type:'success'});
        </script>
<?php
    }
?>
</body>
</html>
