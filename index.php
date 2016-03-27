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
</head>
<body>

<div class="container">
    <div class="row">
        
        <?php   
            $sql = 'SELECT * FROM posts';
            $stmt = $handle->prepare($sql);
            $stmt->execute();

            // row = 0 = false
            if($stmt->rowCount()){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($data as $value){
        ?>
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div><?php echo 'ผู้ตั้งกระทู้ : ' . $value['name'] . ' - Image : '. $value['picture'] ?></div>
                                <div>
                                    <a href="edit.php?id=<?php echo $value['id'] ?>">edit</a>
                                    |
                                    <a href="common/delete_posts.php?id=<?php echo $value['id']?>">delete</a>
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
<script src="asset/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>
    
