<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <title>Chỉnh sửa</title>
</head>
<script>

</script>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class='mt-5 text-center text-primary'>UPDATE ĐIỂM</h1>
                <form method="post" enctype="multipart/form-data" action="updatescore.php"
                    class="border rounded mb-5 mx-auto px-3 pt-3 bg-light back" novalidate>
                    <table class="table table-borderless">
                        <?php
    
                            require('../../config.php');
                            $conn = getDB();
                            $error = array();
                            $IDUngDung = '';
                            $diem1 = '';
                            $diem2 = '';
                            $giuaky = '';
                            $ghichu = '';
                            if(isset($_GET['id'])){
                                //print_r($_GET['id']);

                                $id = $_GET['id'];
                                $idsv = $_GET['idsv']; 
                                $sql = "SELECT * FROM khoungdung where IDUngDung = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt -> bind_param('s',$id);
                                $stmt -> execute();
                                
                                $result = $stmt -> get_result();
                                if($stmt == TRUE && $result -> num_rows >0){
                                    while($data = $result->fetch_assoc()){
                                        $idUD = $data['IDUngDung'];
                                        $tenUngDung = $data['TenUngDung'];
                                        $sql1 = "select diem1, diem2, giuaky, cuoiky, ghichu from diem where ID = '$id'";
                                        $stm1 = $conn->prepare($sql1);
                                        $stm1->execute();
                                        $result1 = $stm1->get_result();
                                        $data1 = $result1->fetch_assoc();
                                        $diem1 = $data1['diem1'];
                                        $diem2 = $data1['diem2']; 
                                        $giuaky = $data1['giuaky'];
                                        $cuoiky = $data1['cuoiky'];
                                        $ghichu = $data1['ghichu'];
                                        

                                        $sql_select = "SELECT ID from lichsutai where IDUngDung = '$id'";
                                        $ress = $conn->query($sql_select);
                                        $data2 = $ress->fetch_array();
                                        $IDnguoimua =  $data2['ID'];

                                        $sql_select1 = "SELECT Firstname, Lastname FROM account where ID='$IDnguoimua' ";
                                        $resss = $conn-> query($sql_select1);
                                        $data3 = $resss->fetch_array();
                                        $tensv = $data3['Firstname'] . " ". $data3['Lastname'];
                        ?>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="tenUngDung">
                                    <h4>Tên môn học</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="tenUngDung" id="tenUngDung" type="text" class="form-control" value="<?php echo $tenUngDung?>"
                                        placeholder="Tên Ứng Dụng" disabled>
                                    <input name="idUD" id="idUD" type="hidden" class="form-control" value="<?php echo $idUD?>"
                                        placeholder="idUD" >
                                    <input name="idsv" id="idsv" type="hidden" class="form-control" value="<?php echo $IDnguoimua?>"
                                        placeholder="idsv" >   
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="tensv">
                                    <h4>Họ và tên</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="tensv" id="tensv" type="text" class="form-control" value="<?php echo $tensv?>"
                                        placeholder="Họ và tên" disabled>
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="diem1">
                                    <h4>Điểm kiểm tra 1</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="diem1" id="diem1" type="text" class="form-control" value="<?php echo $diem1?>"
                                        placeholder="Điểm kiểm tra 1">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="diem2">
                                    <h4>Điểm kiểm tra 2</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="diem2" id="diem2" type="text" class="form-control" value="<?php echo $diem2?>"
                                        placeholder="Điểm kiểm tra 2">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="diem3">
                                    <h4>Điểm kiểm giữa kỳ</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="diem3" id="diem3" type="text" class="form-control" value="<?php echo $giuaky?>"
                                        placeholder="Điểm giữa kỳ">
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="diem4">
                                    <h4>Điểm cuối kỳ</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="diem4" id="diem4" type="text" class="form-control" value="<?php echo $cuoiky?>"
                                        placeholder="Điểm cuối kỳ">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="note">
                                    <h4>Ghi chú</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <textarea name="note" id="note" type="text" class="form-control" rows="10"
                                        placeholder="Ghi chú"><?php echo $ghichu?> </textarea>
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle" colspan="2">
                                <div class="form-group">
                                    <?php
                                    if (!empty($error)) {
                                        ?><div class='alert alert-danger'>
                                        <ul>
                                            <?php 
                                        for($i=0;$i<count($error);$i++){
                                            echo "<li>$error[$i]</li>";  
                                        }?>
                                        </ul>
                                    </div><?php
                                    }
                                ?>
                                </div>

                            </td>
                        </tr>
                        <tr class="item">
                            <td class=" mx-5 text-center align-middle" colspan="2">
                                <input class="btn btn-success px-5" type="submit" value="Update" name="updatescore">
                                <input class="btn btn-danger px-5" type="submit" value="Delete" name="deletescore">
            </div>

            </td>
            </tr>
            </table>
            </form>
            <?php
            
                }
            }
        }  

       
                
                ?>
        </div>
    </div>
    </div>

</body>

</html>
</div>

</body>

</html>