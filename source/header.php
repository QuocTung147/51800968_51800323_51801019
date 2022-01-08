<?php
  ob_start();
  require('config.php');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
  integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<nav class="navbar navbar-expand-md bg-dark navbar-dark px-5">
  <!-- Brand -->
  <a class="navbar-brand" href="./index.php">
    Trung tâm tin học
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse " id="collapsibleNavbar">

    <ul class="nav navbar-nav ml-auto mr-auto form-inline ">
      <li class="nav-item">
        <div class="justify-content-md-center ">
          <form method="get" class="form-inline my-2 my-lg-0 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm" aria-label="Search"
              style="width: 600px;">

            <button class="btn btn-info my-2 my-sm-0" type="submit">Tìm kiếm</button>
          </form>
        </div>
      </li>
    </ul>
    <ul class="nav navbar-nav ml-auto mr-5 form-inline ">

      <?php

          if(isset($_SESSION['name'])){
            if($_SESSION['role'] == 0){
                ?>
      <li class="nav-item dropdown dropleft ml-5">
        <a class="nav-link dropdown-toggle text-light" id="navbardrop" data-toggle="dropdown"><img id="avt"
            class="rounded-circle" src="./img/<?=$_SESSION['avt']?>"></a>
        <div class="dropdown-menu">
          <h7 class="dropdown-item-text"><b><?=$_SESSION['name']?></b></h7>
          <h7 class="dropdown-item-text">Số dư: <?= number_format($_SESSION['sodu'])?><span>&#8363;</span></h7>
          <hr>
          <a class="dropdown-item" href="index.php?page=userProfile">Thông tin cá nhân</a>
          <a class="dropdown-item" href="index.php?page=serial_history">Lịch sử nạp thẻ</a>
          <a class="dropdown-item" href="index.php?page=app_history">Khóa học đã tải</a>
          <a class="dropdown-item" href="index.php?page=score_history">Điểm</a>
          <a class="dropdown-item" href="#myModal" data-toggle="modal" data-target="#myModal">Nạp tiền</a>
          <!--<a class="dropdown-item" href="#upgrade" data-toggle="modal" data-target="#upgrade">Nâng cấp tài khoản</a>-->
          <a class="dropdown-item" href="index.php?page=changePass">Đổi mật khẩu</a>
          <a class="dropdown-item" href="./logout.php">Đăng xuất</a>
        </div>


      </li><?php
            }else{
              ?>
      <li class="nav-item ml-auto form-inline ">
        <a href="./upload_form.php" class="btn btn-success mr-3"><i class="fas fa-upload"></i></a>
      </li>
      <li class="nav-item dropdown dropleft">
        <a class="nav-link dropdown-toggle text-light" id="navbardrop" data-toggle="dropdown"><img id="avt"
            class="rounded-circle" src="./img/<?=$_SESSION['avt']?>"></a>
        <div class="dropdown-menu">
          <h7 class="dropdown-item-text"><b><?=$_SESSION['name']?></b></h7>
          <h7 class="dropdown-item-text">Số dư: <?=number_format($_SESSION['sodu'])?><span>&#8363;</span></h7>
          <hr>
          <a class="dropdown-item" href="index.php?page=userProfile">Thông tin cá nhân</a>
          <a class="dropdown-item" href="index.php?page=serial_history">Lịch sử nạp thẻ</a>
          <a class="dropdown-item" href="index.php?page=app_history">Lịch sử tải</a>
          <a class="dropdown-item" href="index.php?page=my_app">Khóa học của tôi</a>
          <a class="dropdown-item" href="index.php?page=score_history">Điểm</a>
          <a class=" dropdown-item" href="#myModal" data-toggle="modal" data-target="#myModal">Nạp tiền</a>
          <a class="dropdown-item" href="index.php?page=changePass">Đổi mật khẩu</a>
          <a class="dropdown-item" href="./logout.php">Đăng xuất</a>
        </div>
      </li>
      <?php
              
            }
            ?>
      <?php
          }else{
            ?>
      <li class="nav-item ml-auto form-inline ">
        <a href="./login.php" class="btn btn-success mr-3"><i class="fas fa-user">&nbsp; Đăng nhập</i></a>
        <a href="./register.php" class="btn btn-info"><i class="fas fa-key">&nbsp; Đăng ký</i></a>
      </li>
      <?php
          }
      ?>

    </ul>
  </div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nạp tiền</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form class="modal-body" method="post" action="naptien.php">
          <div class="form-group">
            <label for="soseri">Mã thẻ :</label>
            <input type="input" class="form-control" id="soseri" name="soseri" placeholder="Nhập mã thẻ" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success ml-0">Nạp tiền</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php 
   $conn = getDB();
   $gioithieu='';
   if (isset($_POST['gioithieu']) ) {
       if (empty($_POST['gioithieu'])) {
           echo "<script> alert(\"Vui lòng nhập thông tin công ty.\"); </script>";
       }
       else {
           $gioithieu = $_POST['gioithieu'];
           echo "<script> console.log(\"".$gioithieu."\"); </script>";
           if ($_SESSION['sodu'] < 500000) {
               echo "<script> alert(\"Số dư trong tài khoản không đủ vui lòng nạp thêm.\"); </script>";
               $error="lỗi";
           }
           else {
                $stmt = "SELECT ID FROM account WHERE Username = '".$_SESSION['username']."'";
                $result = $conn ->query($stmt);
                echo "bug1";
                if($result == TRUE && $result -> num_rows >0){
                  $data = $result->fetch_assoc();
                  $id = $data['ID'];
                  $stmt = $conn->prepare("INSERT INTO developer (ID, GioiThieu) VALUES (?, ?)");
                  $stmt->bind_param("ss", $id, $gioithieu);
                  $stmt->execute();

                  $stmt1 = $conn->prepare("UPDATE account SET Role = ?, Sodu = ? WHERE ID=?");
                  $stmt1->bind_param("iis", $check, $sodu, $id);
                  $check = 1;
                  $sodu = $_SESSION['sodu']-500000;
                  $stmt1->execute();
                  $_SESSION['user'] = 'dev';
                  $stmt->close();
                  $conn->close();
                  echo "<script> alert(\"Nâng cấp thành công.\"); </script>";
                  header("Refresh:2");
                }else{
                  echo $conn -> error;
                }
            
           }
       }
       
   }
?>
  <div class="modal fade" id="upgrade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nâng cấp thành Nhà phát triển</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form class="modal-body" method="post" action="">

          <div class="form-group">
            <label for="soseri">Tên công ty:</label>
            <input type="text" class="form-control" id="gioithieu" name="gioithieu" placeholder="Tên công ty">
          </div>
          <strong>Lưu ý</strong>
          <p>Nâng cấp thành nhà phát triển sẽ giúp bạn có thể đăng tải ứng dụng của mình và sẽ tốn 500000 VNĐ. Bấm đồng
            ý để xác nhận nâng cấp.</p>
          <div class="modal-footer">
            <div class="form-group">

              <button class="btn btn-success">Đồng ý</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  </div>
</nav>
<?php
  ob_end_flush();
?>