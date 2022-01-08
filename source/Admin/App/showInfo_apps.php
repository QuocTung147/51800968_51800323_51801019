<?php

require('../config.php');
$conn = getDB();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM khoungdung where IDUngDung = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $res = $stmt -> get_result();
    if($res){
        while ($data = $res-> fetch_assoc()) {
            $id = $data['IDUngDung'];
            $idDev = $data['ID'];
            $name = $data['TenUngDung'];
            $fileName = $data['TenFile'];
            $icon = $data['Icon'];
            $brief = $data['Brief'];
            $detail = $data['Detail'];
            $pic = $data['Pictures'];
            $dungluong = $data['DungLuong'];
            $giatien = $data['GiaTien'];
            $trangthai = $data['TrangThai'];
            $date = $data['ThoiGianUpLoad'];
            $type = $data['TheLoai'];
            $price = $data['GiaTien'];
            $lydo = $data['LyDo'];
            $kind = $data['Type'];
            $lichday = $data['Lichday'];
            $lichthi = $data['Lichthi'];
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Thông tin sản phẩm</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-5 text-center text-info"><?=$name?></h1>
        </div>
       
        <div class="row mt-5">
            <div class="col text-right">
                <a class="btn btn-md btn-outline-danger" href="index.php?page=index_apps">Trở về</a>
            </div>
        </div>
        <div class="row">
            <div class="col my-5">
                <table class="table table-hover table-striped table-bordered ">
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Icon</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <img class="img-thumbnail" src="../<?=$icon?>" style="height:200px;" alt="">
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Nhà phát triển</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h5><?php echo $lastname.' '.$firstname ?></h5>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>File</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <a href="../download.php?file=<?=$fileName?>"><?=explode("/",$fileName)[3]?></a>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Chi tiết</h5>
                        </td>
                        <td class=" d-flex justify-content-center align-middle">
                            <p style="font-size:14px; max-width: 100ch;"><?=nl2br($detail)?></p>
                        </td>
                    </tr>
                    <tr class="item ">
                        <td class=" align-middle">
                            <h5>Dung lượng</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?=convert_filesize($dungluong)?></h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Khóa học</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7> <?php
                                if($kind == 'laptrinh'){
                                    echo "Lập Trình";
                                }else if ($kind == 'tienganh'){
                                    echo "Tiếng Anh";
                                }else if ($kind == 'ungdung'){
                                    echo 'Ứng Dụng';
                                }
                                ?></h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Lịch dạy</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?=$lichday?></h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Lịch thi</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?=$lichthi?></h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Thể loại</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?=$type?></h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Trạng thái</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7>
                                <?php
                                if($trangthai == 0){
                                    echo "Từ chối";
                                }else if ($trangthai == 1){
                                    echo "Đã duyệt";
                                }else if ($trangthai == 2){
                                    echo "Nháp";
                                }else if ($trangthai == 3){
                                    echo "Chờ duyệt";
                                }else if ($trangthai == 4){
                                    echo "Gỡ";
                                }
                                ?>
                            </h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Giá tiền</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?php
                                    if($price == 0){
                                        echo "Free";
                                    }else {
                                        echo number_format($price).' VND';
                                    }
                                ?></h7>
                        </td>
                    </tr>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Thời gian upload</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?=$date?></h7>
                        </td>
                    </tr>
                    <?php
                        if($trangthai == 0 || $trangthai == 1 || $trangthai == 4 ){
                    ?>
                    <tr class="item">
                        <td class=" align-middle">
                            <h5>Lý do</h5>
                        </td>
                        <td class=" text-center align-middle">
                            <h7><?=$lydo?></h7>
                        </td>
                    </tr>
                    <?php
                        } 
                    ?>

                    <tr class="item">
                        <td class=" align-middle text-center" colspan='2'>
                            <?php
                                if($trangthai == 0){
                                    ?>

                            <form action="App/deleteApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idDel" id="deleteForm">
                                <button name='del' type="submit" class="btn btn-danger mr-3" id="del">Xóa</button>
                            </form>
                            <form action="App/yesApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idYes">
                                <button name='yes' type="submit" class="btn btn-success mr-3" id="del"
                                    disabled>Duyệt</button>
                            </form>

                            <form action="App/noApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idNo" id="deleteForm">
                                <button name='no' type="submit" class="btn btn-dark mr-3" id="del" disabled>Từ
                                    Chối</button>
                            </form>
                            <form action="App/uninstallApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idUninstall"
                                    id="deleteForm">
                                <button name='uninstall' type="submit" class="btn btn-secondary mr-3" id="del"
                                    disabled>Gỡ</button>
                            </form>

                            <?php 
                                }else if ($trangthai == 1){
                                    ?>
                            <form action="App/deleteApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idDel" id="deleteForm">
                                <button name='del' type="submit" class="btn btn-danger" id="del" disabled>Xóa</button>
                            </form>
                            <form action="App/yesApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idYes" id="deleteForm">
                                <button name='yes' type="submit" class="btn btn-success" id="del"
                                    disabled>Duyệt</button>
                            </form>
                            <form action="App/noApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idNo" id="deleteForm">
                                <button name='no' type="submit" class="btn btn-dark" id="del" disabled>Từ Chối</button>
                            </form>


                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="#uninstallModal">Gỡ</button>
                            <form action="App/uninstallApp.php" method="post" style="display: inline;">
                                <div id="uninstallModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lý do</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <textarea class="form-control rounded-0" rows="3"
                                                        name="reason"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">

                                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idUninstall"
                                                    id="deleteForm">
                                                <button name='uninstall' type="submit" class="btn btn-secondary"
                                                    id="del">Gỡ</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                                }else if ($trangthai == 3){
                                    ?>
                            <form action="App/deleteApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idDel" id="deleteForm">
                                <button name='del' type="submit" class="btn btn-danger" id="del" disabled>Xóa</button>
                            </form>
                            <form action="App/yesApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idYes" id="deleteForm">
                                <button name='yes' type="submit" class="btn btn-success" id="del">Duyệt</button>
                            </form>

                            <!-- Decline -->
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#noModal">Từ
                                chối</button>

                            <!-- Modal -->
                            <form action="App/noApp.php" method="post" style="display: inline;">
                                <div id="noModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lý do</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <textarea class="form-control rounded-0" rows="3" name="reason"
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idNo"
                                                    id="deleteForm">
                                                <button name='no' type="submit" class="btn btn-dark" id="del">Từ
                                                    Chối</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form action="App/uninstallApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idUninstall"
                                    id="deleteForm">
                                <button name='uninstall' type="submit" class="btn btn-secondary" id="del">Gỡ</button>
                            </form>
                            <?php
                                }else if ($trangthai == 4){
                                    ?>
                            <form action="App/deleteApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idDel" id="deleteForm">
                                <button name='del' type="submit" class="btn btn-danger" id="del">Xóa</button>
                            </form>
                            <form action="App/yesApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idYes" id="deleteForm">
                                <button name='yes' type="submit" class="btn btn-success" id="del"
                                    disabled>Duyệt</button>
                            </form>
                            <form action="App/noApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idNo" id="deleteForm">
                                <button name='no' type="submit" class="btn btn-dark" id="del" disabled>Từ Chối</button>
                            </form>
                            <form action="App/uninstallApp.php" method="post" style="display: inline;">
                                <input value="<?=$data['IDUngDung'];?>" type="hidden" name="idUninstall"
                                    id="deleteForm">
                                <button name='uninstall' type="submit" class="btn btn-secondary" id="del"
                                    disabled>Gỡ</button>
                            </form>
                            <?php
                                }
                                ?>

                        </td>
                    </tr>

                    <?php 
                        } 
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

    </div>
</body>

</html>
