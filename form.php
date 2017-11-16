<?php require_once(__DIR__ . '/common/connect.php'); ?> <!------เรียกไฟล์ นี้มาใช้แค่ครั้งเดียว เมื่อเข้าเงื่อนไข------->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/icon.png">
    <title>เพิ่มกระทู้ - WTN web board</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="asset/css/bootstrap.css">
</head>
<body>

<?php
    require_once ('navber-menu.php');
?>
        <div id="header"></div>  <!---จบ ส่วนbanner-->
<!-----หน้าฟอร์ม เก็บข้อมูล โดยส่งค่าไปยัง add_posts.php------->
<div class="container">
    <form action="common/add_posts.php" enctype="multipart/form-data" method="post" style="margin-top: 40px">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">ชื่อผู้ตั้งกระทู้</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="picture">รูปโปรไฟล์</label>
                <input type="file" name="picture" id="picture">
            </div>

            <div class="form-group">
                <label for="title">หัวข้อกระทู้</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="images">รูปภาพสินค้า</label>
                <input type="file" name="images[]" multiple max="10" accept="image/x-png,image/gif,image/jpeg" id="images">
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
<!------ส่วนเรียกใช้งาน jQuery JS bootstrap------->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="asset/js/bootstrap.min.js"></script>
<script src="library/ckeditor/ckeditor.js"></script>

<script>
    CKEDITOR.replace('details'); //คำสั่งแก้ไข Details
</script>
</body>
</html>

