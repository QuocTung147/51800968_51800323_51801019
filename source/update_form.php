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
                <h1 class='mt-5 text-center text-primary'>UPDATE KHÓA HỌC</h1>
                <form method="post" enctype="multipart/form-data" action="updateobj.php"
                    class="border rounded mb-5 mx-auto px-3 pt-3 bg-light back" novalidate>
                    <table class="table table-borderless">
                        <?php
    
                            require('config.php');
                            $conn = getDB();
                            $error = array();
                            $icon = '';
                            $file = '';
                            $tenUngDung = '';
                            $detail = '';
                            $type = '';
                            $kind = '';
                            $price = '';
                            if (isset($_GET['id'])){
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM khoungdung where IDUngDung = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt -> bind_param('s',$id);
                                $stmt -> execute();
                                
                                $result = $stmt -> get_result();
                                if($stmt == TRUE && $result -> num_rows >0){
                                    while($data = $result->fetch_assoc()){
                                        $idDev = $data['ID'];
                                        $idUD = $data['IDUngDung'];
                                        $icon = $data['Icon'];
                                        $file = $data['TenFile'];
                                        $tenUngDung = $data['TenUngDung'];
                                        $detail = $data['Detail'];
                                        $type = $data['Type'];
                                        $kind = $data['TheLoai'];
                                        $price = $data['GiaTien']; 
                                        $sql1 = "select Lichhocvaday, Lichthi from lich where IDUngDung = '$idUD'";
                                        $stm1 = $conn->prepare($sql1);
                                        $stm1->execute();
                                        $result1 = $stm1->get_result();
                                        $data1 = $result1->fetch_assoc();
                                        $teachTime = $data1['Lichhocvaday'];
                                        $testTime = $data1['Lichthi']; 
                        ?>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="tenUngDung">
                                    <h4>Tên ứng dụng</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="tenUngDung" id="tenUngDung" type="text" class="form-control" value="<?php echo $tenUngDung?>"
                                        placeholder="Tên Ứng Dụng" >
                                    <input name="idUD" id="idUD" type="hidden" class="form-control" value="<?php echo $idUD?>"
                                        placeholder="Tên Ứng Dụng" >
                                    <input name="idDev" id="idDev" type="hidden" class="form-control" value="<?php echo $idDev?>"
                                        placeholder="idDev" >    
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="teachTime">
                                    <h4>Lịch dạy</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="teachTime" id="teachTime" type="text" class="form-control" value="<?php echo $teachTime?>"
                                        placeholder="Lịch dạy">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="testTime">
                                    <h4>Lịch thi</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="testTime" id="testTime" type="text" class="form-control" value="<?php echo $testTime?>"
                                        placeholder="Lịch thi">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="detail">
                                    <h4>Chi tiết</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <textarea name="detail" id="detail" type="text" class="form-control" rows="10"
                                        placeholder="Chi tiết"><?php echo $detail?> </textarea>
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="type">
                                    <h4>Loại ứng dụng</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <select name="type" class="form-control" id="typeApp"
                                        onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
                                        <option <?php if($type == ""){echo "selected";}?> value="">-- Chọn loại ứng dụng --</option>
                                        <option value="laptrinh" <?php if($type == "laptrinh"){echo "selected";}?>>Lập Trình</option>
                                        <option value="tienganh" <?php if($type == "tienganh"){echo "selected";}?>>Tiếng Anh</option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="kind">
                                    <h4>Thể loại</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <script type="text/javascript" language="JavaScript">
                                        document.write(
                                            '<select name="kind" class="form-control" id="kindApp"><option value=""></option></select>'
                                        )
                                    </script>
                                    <noscript>

                                        <select id="kindApp" name="kind">
                                           
                                        </select>
                                    </noscript>
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="price">
                                    <h4>Giá tiền</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input onkeyup="formatCurrency($(this))" 
                                        type="text" class="price form-control" name="price" id="price"
                                        placeholder="Giá tiền" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                        data-type="currency" value="<?php echo number_format($price) ?>"/>
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
                                <input class="btn btn-success px-5" type="submit" value="Update" name="updateobj">
                                <input class="btn btn-info px-5" type="submit" value="Lưu bản nháp" name="draft">
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