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

    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Bootstrap -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="../asset/css/smoke.min.css" rel="stylesheet">

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
    </style>
</head>
<body>


<!-- ส่วนของ header-->
<div class="container-fluid">
    <a class="navbar-brand"><img src="../image/welcome.png" style="width: 120px;height: 50px;"></a>

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
<!---จบ ส่วนbanner-->

<div class="container">
    <div class="row">

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
                            <div>

                                <?php
                                if (is_file('images/' . $value['picture'])) {
                                    echo '<img src="images/' . $value['picture'] . '" class="img-responsive img-thumbnail" style="width: 50px;height: 50px">';
                                } else {
                                    echo '<img src="../images/error.png" style="width: 50px;height: 50px">';
                                }
                                ?>

                                <?php echo 'ผู้ตั้งกระทู้ : ' . $value['name'] . ' - Image : ' . $value['picture'] ?>
                            </div>


                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="edit.php?id=<?php echo $value['id'] ?>">edit</a></li>
                                    <li>
                                        <a href="<?php echo $value['id'] ?>" class="btnConfirmPosts">delete</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="panel-body">
                            <?php echo $value['details'] ?>
                            <div class="text-right">
                                <a href="post.php?id=<?php echo $value['id'] ?>">อ่านต่อ >>></a>
                            </div>
                        </div>
                        <div class="panel-footer"><?php echo $value['datetime'] ?></div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/smoke.min.js"></script>
<script src="../asset/js/wtn2.js"></script>


</body>
</html>
