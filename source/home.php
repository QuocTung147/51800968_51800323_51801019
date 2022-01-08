<?php
    ob_start();
    require_once('config.php');
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
    <link rel="stylesheet" href="./style.css">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <h4>Lập trình</h4>
            <div class="col text-right">
                <a class="btn btn-md btn-outline-success" href="index.php?page=ungdung">Xem thêm</a>
            </div>
        </div>
        <div class="row" id="trochoi_section">

            <?php
                $conn = getDB();
                $sql = "SELECT * FROM khoungdung WHERE Type='laptrinh' && TrangThai = 1 Limit 4";
                $res = $conn->query($sql);
                if($res == TRUE && $res->num_rows > 0){
                    while ($data = $res->fetch_array()) {
                        $id = $data['IDUngDung'];
                        $idDev = $data['ID'];
                        $name = $data['TenUngDung'];
                        $fileName = $data['TenFile'];
                        $icon = $data['Icon'];
                        $type = $data['TheLoai'];
                        $price = $data['GiaTien'];
                        $kind = $data['Type'];
                        $firstname='';
                        $lastname='';
                        $sql1 = "SELECT Firstname, Lastname FROM account where ID='$idDev'";
                        $res1 = $conn->query($sql1);
                        if($res1 == TRUE && $res1->num_rows >0){
                            while ($info = $res1 -> fetch_array()){
                                $firstname .= $info['Firstname'];
                                $lastname .= $info['Lastname'];
                            }
                        }else{
                            echo "False";
                        }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12 app_index">
                <a href="index.php?page=detail_app&&id=<?=$id?>">
                    <div class="card">
                        <img class="card-img-top d-flex " src="<?=$icon?>" alt="Card image">
                        <div class="card-body mb-5 ">
                            <h4 class="card-title text-dark text"><?=$name?></h4>
                            <?php   
                                if($price > 0){
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Giá: <?=number_format($price)?> VNĐ</h6>
                            <?php
                                }else{
                                    ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Free </h6>
                            <?php
                                }
                            
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3"><?=$type?></h6>
                        </div>

                        <div class="card-footer">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                        }
                    }
                ?>
        </div>
        <hr>
        <div class="row mt-5">
            <h4>Tiếng Anh</h4>
            <div class="col text-right">
                <a class="btn btn-md btn-outline-info" href="index.php?page=trochoi">Xem thêm</a>
            </div>
        </div>
        <div class="row">
            <?php
                $conn = getDB();
                $sql = "SELECT * FROM khoungdung WHERE Type='tienganh' && TrangThai = 1 Limit 4";
                $res = $conn->query($sql);
                if($res == TRUE && $res->num_rows > 0){
                    while ($data = $res->fetch_array()) {
                        $id = $data['IDUngDung'];
                        $idDev = $data['ID'];
                        $name = $data['TenUngDung'];
                        $fileName = $data['TenFile'];
                        $icon = $data['Icon'];
                        $type = $data['TheLoai'];
                        $price = $data['GiaTien'];
                        $kind = $data['Type'];
                        $firstname='';
                        $lastname='';
                        $sql1 = "SELECT Firstname, Lastname FROM account where ID='$idDev'";
                        $res1 = $conn->query($sql1);
                        if($res1 == TRUE && $res1->num_rows >0){
                            while ($info = $res1 -> fetch_array()){
                                $firstname .= $info['Firstname'];
                                $lastname .= $info['Lastname'];
                            }
                        }else{
                            echo $conn -> error;
                        }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12 app_index">
                <a href="index.php?page=detail_app&&id=<?=$id?>">
                    <div class="card">
                        <img class="card-img-top d-flex " src="<?=$icon?>" alt="Card image">
                        <div class="card-body mb-5 ">
                            <h4 class="card-title text-dark text"><?=$name?></h4>
                            <?php   
                                if($price > 0){
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Giá: <?=number_format($price)?> VNĐ</h6>
                            <?php
                                }else{
                                    ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Free </h6>
                            <?php
                                }
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3"><?=$type?></h6>
                        </div>

                        <div class="card-footer">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                        }
                    }
                ?>

        </div>

        <!-- FREE -->
        <hr>
        <div class="row mt-5">
            <h4>Miễn phí tải nhiều nhất</h4>
            <div class="col text-right">
                <a class="btn btn-md btn-outline-danger" href="index.php?page=most_free_app">Xem thêm</a>
            </div>
        </div>
        <div class="row">
            <?php
                $conn = getDB();
                $sql = "SELECT * FROM khoungdung WHERE GiaTien = 0 && TrangThai = 1 ORDER BY Luottai DESC Limit 4";
                $res = $conn->query($sql);
                if($res == TRUE && $res->num_rows > 0){
                    while ($data = $res->fetch_array()) {
                        $id = $data['IDUngDung'];
                        $idDev = $data['ID'];
                        $name = $data['TenUngDung'];
                        $fileName = $data['TenFile'];
                        $icon = $data['Icon'];
                        $type = $data['TheLoai'];
                        $price = $data['GiaTien'];
                        $kind = $data['Type'];
                        $luottai = $data['Luottai'];
                        $firstname='';
                        $lastname='';
                        $sql1 = "SELECT Firstname, Lastname FROM account where ID='$idDev'";
                        $res1 = $conn->query($sql1);
                        if($res1 == TRUE && $res1->num_rows >0){
                            while ($info = $res1 -> fetch_array()){
                                $firstname .= $info['Firstname'];
                                $lastname .= $info['Lastname'];
                            }
                        }else{
                            echo $conn -> error;
                        }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12 app_index">
                <a href="index.php?page=detail_app&&id=<?=$id?>">
                    <div class="card">
                        <img class="card-img-top d-flex " src="<?=$icon?>" alt="Card image">
                        <div class="card-body mb-5 ">
                            <h4 class="card-title text-dark text"><?=$name?></h4>
                            <?php   
                                if($price > 0){
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Giá: <?=number_format($price)?> VNĐ</h6>
                            <?php
                                }else{
                                    ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Free </h6>
                            <?php
                                }
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3"><?=$type?></h6>
                        </div>

                        <div class="card-footer">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                        }
                    }
                ?>

        </div>

        <!-- COST -->
        <hr>
        <div class="row mt-5">
            <h4>Trả phí tải nhiều nhất</h4>
            <div class="col text-right">
                <a class="btn btn-md btn-outline-dark" href="index.php?page=most_cost_app">Xem thêm</a>
            </div>
        </div>
        <div class="row">
            <?php
                $conn = getDB();
                $sql = "SELECT * FROM khoungdung WHERE GiaTien > 0 && TrangThai = 1 ORDER BY Luottai DESC Limit 4";
                $res = $conn->query($sql);
                if($res == TRUE && $res->num_rows > 0){
                    while ($data = $res->fetch_array()) {
                        $id = $data['IDUngDung'];
                        $idDev = $data['ID'];
                        $name = $data['TenUngDung'];
                        $fileName = $data['TenFile'];
                        $icon = $data['Icon'];
                        $type = $data['TheLoai'];
                        $price = $data['GiaTien'];
                        $kind = $data['Type'];
                        $firstname='';
                        $lastname='';
                        $sql1 = "SELECT Firstname, Lastname FROM account where ID='$idDev'";
                        $res1 = $conn->query($sql1);
                        if($res1 == TRUE && $res1->num_rows >0){
                            while ($info = $res1 -> fetch_array()){
                                $firstname .= $info['Firstname'];
                                $lastname .= $info['Lastname'];
                            }
                        }else{
                            echo $conn -> error;
                        }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12 app_index">
                <a href="index.php?page=detail_app&&id=<?=$id?>">
                    <div class="card">
                        <img class="card-img-top d-flex " src="<?=$icon?>" alt="Card image">
                        <div class="card-body mb-5 ">
                            <h4 class="card-title text-dark text"><?=$name?></h4>
                            <?php   
                                if($price > 0){
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Giá: <?=number_format($price)?> VNĐ</h6>
                            <?php
                                }else{
                                    ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Free </h6>
                            <?php
                                }
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3"><?=$type?></h6>
                        </div>

                        <div class="card-footer">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
                        }
                    }
                ?>

        </div>
    </div>
</body>

</html>
<?=ob_end_flush();?>