<link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
<?php

    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }

    require "config.php";
    $conn = getDB();
    $mathe = $_POST['soseri'];
    $stmt = $conn->prepare("SELECT * FROM thecao WHERE SoSeri=?");
    $stmt->bind_param("s",$mathe);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {                
        while($row = $result->fetch_assoc()) {
            $giatien = $row["GiaTien"];
            $check = $row["Checked"];
        }   
        if ($check==0) {
            $check = 1;
            $stmt = $conn->prepare("UPDATE thecao SET Checked = ? WHERE SoSeri= ?");
            $stmt->bind_param("is",$check,$mathe);
            $stmt->execute();

            $sodu = $_SESSION['sodu']+ $giatien;
            $stmt = $conn->prepare("UPDATE account SET SoDu = ? WHERE Username=?");
            $stmt->bind_param("is",$sodu,$_SESSION['username']);
            $stmt->execute();
    
            $stmt = $conn->prepare("SELECT ID, SoDu FROM account WHERE Username=?");
            $stmt->bind_param("s",$_SESSION['username']);
            $stmt->execute();
            $result = $stmt->get_result();
            $id = '';
            if ($stmt == TRUE) {                
                while($row = $result->fetch_assoc()) {          
                    $id =  $row["ID"];
                 
                }    
            }
            $stmt = $conn->prepare("INSERT INTO hoadonnapthe (SoSeri, ID, GiaTien, NgayNap)  VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis",$mathe, $id, $giatien, $date);
            $date = date('Y-m-d h:i:s');
            $stmt->execute();
            $_SESSION['sodu']=$sodu;
            $_SESSION['thongtinnapthe']= 1; //thành công
            
        }
        else {
            $_SESSION['thongtinnapthe']= 2; //thẻ đã có ng nạp
            
        } 
    }
    else {
        $_SESSION['thongtinnapthe']= 0; //sai mã thẻ
    }
    if (isset($_SESSION['thongtinnapthe'])) {
        $info = $_SESSION['thongtinnapthe'];
        if ($info == 1) {
            ?>
            <div class="container">
            <div class="row">
              <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                  <h4>Nạp tiền thành công thành công</h4>
                  <p>Số tiền trong tài khoản của bạn là: <?=number_format($_SESSION['sodu'])?></p>
                  <a class="btn btn-success px-5" href="<?=$previous?>">Quay về</a>
              </div>
            </div>
          </div>"
          <?php
            
        }
        elseif ($info == 0) {
            ?>
            <div class="container">
            <div class="row">
              <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                  <h4>Thẻ không hợp lệ vui lòng kiểm tra lại</h4>
                  <p>Vui lòng kiểm tra lại số seri trên thẻ</p>
                  <a class="btn btn-success px-5" href="<?=$previous?>">Quay về</a>
              </div>
            </div>
          </div>"
          <?php
        }
        else {
            ?>
            <div class="container">
            <div class="row">
              <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                  <h4>Thẻ đã đc sử dụng</h4>
                  <p>Có vẻ như thẻ này đã được sử dụng !!!</p>
                  <a class="btn btn-success px-5" href="<?=$previous?>">Quay về</a>
              </div>
            </div>
          </div>"
          <?php
        }
        $_SESSION['thongtinnapthe']=null;
    }
    exit();
    $stmt->close();
    $conn->close();
    
?>
