<?php require_once (__DIR__. '/common/connect.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>แก้ไขข้อมูล- WTN web board</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="asset/css/bootstrap.css">

</head>
<body>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = 'SELECT * FROM posts WHERE id=:id';
        $stmt = $handle->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
?>



        <div class="container-fluid">
            <a class="navbar-brand"><img src="image/welcome.png" style="width: 120px;height: 50px;margin-top: -15px"></a>
            <div class="navbar-header" style="float: left">
                <a href="index.php" class="btn btn-primary navbar-btn">หน้าแรก</a>
                <a href="form.php" class="btn btn-primary navbar-btn">สร้างกระทู้</a>
            </div>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group" style="">
                    <input type="text" class="serach" placeholder="Search">
                </div>

            </form>
        </div>


        <div id="header"></div>

        <div class="container">
            <form action="common/update_posts.php" enctype="multipart/form-data" method="post"style="margin-top: 5px" >
                <input type="hidden" name="id" value="<?=$post['id'] ?>">
                <div class="form-group">
                    <label for="name">ชื่อผู้ตั้งกระทู้</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?=$post['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="title">หัวกระทู้</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?=$post['title'] ?>">
                </div>

                <div class="form-group">
                    <label for="picture">รูปภาพ</label> <br>
                    <img src="images/<?=$post['picture'] ?>" alt="<?=$post['picture'] ?>" class="img-responsive">
                    <input type="file" name="picture" id="picture">
                </div>

                <div class="form-group">
                    <label for="details">รายละเอียด</label>
                    <textarea name="details" id="details" rows="5" class="form-control"><?=$post['details'] ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn-info">บันทึกการเปลี่ยนแปลง</button>
                </div>
            </form>
        </div>



<?php } ?>

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