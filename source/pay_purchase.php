<?php
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    require('config.php');
    $conn = getDB();
  ?>
    <!DOCTYPE html>
<html lang="en">
  <head>
    <title>Đăng xuất</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
  <body>
  <?php
    if(isset($_GET['id_app'])){
        $idApp = $_GET['id_app'];
        $idUser = $_SESSION['user_id'];
        $sodu = $_SESSION['sodu'];

        $query = "SELECT * FROM khoungdung WHERE IDUngDung = ? ";
        $query2 = "SELECT * FROM account WHERE ID = '$idUser' ";
        
        $stmt1 = $conn->prepare($query);
        $stmt2 = $conn->query($query2);
      
        $stmt1 -> bind_param('s', $idApp);
        $stmt1 -> execute();
        $result1 = $stmt1 -> get_result();
      
        if($stmt2 -> num_rows > 0 && $result1 -> num_rows > 0){
            
            $data1 = $result1 -> fetch_assoc();
            $data2 = $stmt2 -> fetch_assoc();

            if($data1['GiaTien'] <= $data2['SoDu']){

              $soDu = $data2['SoDu'];
              $giaTien = $data1['GiaTien'];
              $name = $data1['TenFile'];
              $fileDir = __DIR__.'/';
              $filePath = $fileDir . $name;
              if(!file_exists($filePath)) {
                  die('Tập tin không tồn tại');
              }
          
              $newSoDu = $soDu - $giaTien;
              $query_update = "UPDATE account SET SoDu=$newSoDu WHERE ID = '$idUser' ";
              $res = $conn -> query($query_update);
              
              $query_insert = "INSERT INTO lichsutai (ID,IDUngDung,GiaTien) VALUES('$idUser','$idApp',$giaTien)";
              $res2 = $conn -> query($query_insert);
              
              $_SESSION['sodu'] = $data2['SoDu'];
              header('Content-Description: File Transfer');
              header('Content-Transfer-Encoding: binary');
              header('Content-Type: application/octet-stream');
              header('Content-Disposition: attachment; filename="'.basename($filePath).'"'); 
              flush();
              readfile($filePath);
              $conn -> close();
                
                
            }else{?>

    <div class="container">
      <div class="row">
        <div class="mb-5 text-center col-md-6 mt-5 mx-auto p-3 border rounded">
            <h4>Hãy nạp thêm tiền</h4>
            <a class="btn btn-success px-5" href="index.php?page=detail_app&&id=<?=$idApp?>"> Nhấn đây để quay lại</a>
        </div>
      </div>
    </div>

            <?php
                
            }
        }else{
            die("Alo");
        }
    }
?>
  </body>
</html>