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
                                <?php echo 'id:'.$value['id'] . ' - ผู้ตั้งกระทู้ : ' . $value['name'] . ' - Image : '. $value['picture'] ?>
                            </div>
                            <div class="panel-body"><?php echo $value['details'] ?></div>
                            <div class="panel-footer"><?php echo $value['time'] ?></div>
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
    
