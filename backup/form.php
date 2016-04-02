<?php require_once(__DIR__ . '/common/connect.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>เพิ่มกระทู้ - WTN web board</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
</head>
<body>

<div class="container-fluid" style="border:1px solid #c0c0c0;">
    <a class="navbar-brand"><img src="../image/welcome.png" style="width: 120px;height: 50px;"></a>
    <div class="navbar-header" style="float: left">
        <a href="index.php" class="btn btn-primary navbar-btn">หน้าแรก</a>
        <a href="form.php" class="btn btn-primary navbar-btn">สร้างกระทู้</a>
    </div>
    <form class="navbar-form navbar-left" role="search">
        <div class="form-group" style="">
            <input type="text" class="serach" placeholder="Search">
        </div>
        <!--                    <button type="submit" class="btn btn-default">Submit</button>-->
    </form>
</div>
        <div id="header"></div>  <!---จบ ส่วนbanner-->

<div class="container">
    <form action="../common/add_posts.php" enctype="multipart/form-data" method="post" style="margin-top: 40px">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">ชื่อผู้ตั้งกระทู้</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="title">หัวกระทู้</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="picture">รูปภาพ</label>
                <input type="file" name="picture" id="picture">
            </div>

            <div class="form-group">
                <label for="details">รายละเอียด</label>
                <textarea name="details" id="details" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="form-control btn btn-info">เพิ่มข้อมูล</button>
            </div>
        </div>
    </form>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../library/ckeditor/ckeditor.js"></script>

<script>
    CKEDITOR.replace('details');
</script>
</body>
</html>

