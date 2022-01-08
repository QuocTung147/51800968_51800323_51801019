<?php 
    require('../config.php');
    $conn = getDB();

    $productNum = 0;
    $sql = 'SELECT * FROM thecao';
    $res = $conn->query($sql);
    $daNap = 0;
    $chuaNap = 0;
    $productNum = 0;
    if($res == TRUE && $res->num_rows > 0){
        $productNum += $res->num_rows;
        while ($data = $res->fetch_array()) {
            $check = $data['Checked'];
            if($check == 0){
                $chuaNap += 1;
            }else{
                $daNap += 1;
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Home</title>
</head>

<body>
    <div class="container">
        <div class="row my-5 ">
            <div class="col my-5">
                <div class="card" style="width:400px">
                    <div class="card-header">
                        <h2 class="text-primary">Thẻ cào</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-info">Số lượng thẻ: <?=$productNum?> </h4>
                        <h6 class="card-text text-danger">Đã nạp: <?=$daNap?></h6>
                        <h6 class="card-text text-success">Chưa nạp: <?=$chuaNap?></h6>
                    </div>
                </div>
            </div>

            <div class="col my-5">
                <?php

                $sql_ungdung = 'SELECT * FROM khoungdung';
                $res_ungdung = $conn->query($sql_ungdung);
                $tuchoi = 0;
                $duyet = 0;
                $nhap = 0;
                $go = 0;
                $choduyet = 0;
                $ungDungNum = 0;
                if($res_ungdung == TRUE && $res_ungdung->num_rows > 0){
                    $ungDungNum += $res_ungdung->num_rows;
                    while ($data_ungdung = $res_ungdung->fetch_array()) {
                        $check = $data_ungdung['TrangThai'];
                        if($check == 0){
                            $tuchoi += 1;
                        }else if($check == 1){
                            $duyet += 1;
                        }else if($check == 2){
                            $nhap += 1;
                        }else if($check == 3){
                            $choduyet += 1;
                        }else if($check == 4){
                            $go += 1;
                        }
                    }
                }
                
                ?>
                <div class="card" style="width:400px">
                    <div class="card-header">
                        <h2 class="text-primary">Khóa học</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-info">Số lượng khóa học: <?=$ungDungNum?></h4>
                        <h6 class="card-text ">Nháp: <?=$nhap?></h6>
                        <h6 class="card-text text-success ">Đã duyệt: <?=$duyet?></h6>
                        <h6 class="card-text ">Chờ duyệt: <?=$choduyet?></h6>
                        <h6 class="card-text text-danger">Từ chối: <?=$tuchoi?></h6>
                        <h6 class="card-text text-danger">Gỡ: <?=$go?></h6>
                    </div>
                </div>
            </div>
            <?php

                    $sql_account = 'SELECT * FROM account';
                    $res_account = $conn->query($sql_account);
                    $user = 0;
                    $dev = 0;
                    $accountNum = 0;
                    if($res_account == TRUE && $res_account->num_rows > 0){
                        $accountNum += $res_account->num_rows;
                        while ($data_account = $res_account->fetch_array()) {
                            $check = $data_account['Role'];
                            if($check == 0){
                                $user += 1;
                            }else if($check == 1){
                                $dev += 1;
                            }
                        }
                    }
            ?>
            <div class="col my-5">
                <div class="card" style="width:400px">
                    <div class="card-header">
                        <h2 class="text-primary">Tài khoản người dùng</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-info">Số lượng tài khoản: <?=$accountNum?> </h4>
                        <h6 class="card-text text-danger">Tài khoản học viên: <?=$user?></h6>
                        <h6 class="card-text text-success">Tài khoản giảng viên: <?=$dev?></h6>
                    </div>
                </div>
            </div>

            <div class="col my-5">
            <?php
                    $sql_comment = 'SELECT * FROM comment';
                    $res_comment= $conn->query($sql_comment);
                    $commentNum = 0;
                    if($res_comment == TRUE && $res_comment->num_rows > 0){
                        $commentNum += $res_comment->num_rows;     
                    }
            ?>
                <div class="card" style="width:400px">
                    <div class="card-header">
                        <h2 class="text-primary">Bình luận</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Số lượng bình luận: <?=$commentNum?></h4>

                    </div>
                </div>
            </div>
        </div>
</body>

</html>