<?php require_once (__DIR__. '/common/connect.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>เพิ่มกระทู้ - WTN web board</title>

    <link rel="stylesheet" href="asset/css/bootstrap.css">
</head>
<body>

<br><br>

    <div class="container">
        <form action="common/add_posts.php" enctype="multipart/form-data" method="post">
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
        </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="asset/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="library/ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('details');
    </script>
</body>
</html>