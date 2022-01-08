<?php
    require_once('config.php');
    $conn = getDB();
    if(empty($_GET['file']) && empty($_GET['id_app'])){
        die('Cung cap bien file');
    }

    $id_app = $_GET['id_app'];
    $name = $_GET['file'];
    $id_user = $_SESSION['user_id'];


    $fileDir = __DIR__.'/';
    $filePath = $fileDir . $name;
    if(!file_exists($filePath)) {
        die('Tập tin không tồn tại');
    }

    $query1 = "SELECT * FROM khoungdung WHERE IDUngDung = ?";
    $stmt = $conn->prepare($query1);
    $stmt -> bind_param('s',$id_app);
    
    if(!$stmt -> execute()){
        die('FALSE');
    }
    $result = $stmt -> get_result();
    if($result -> num_rows > 0){
        $data = $result ->fetch_array();
        $Luottai = $data['Luottai']+1;
        $price = $data['GiaTien'];
        $query_insert = "INSERT INTO lichsutai (ID, IDUngDung, GiaTien) VALUES ('$id_user', '$id_app', '$price')";
        
        if(!$conn -> query($query_insert)){
            die("Error");
        }
        $query_update_luottai = "UPDATE khoungdung SET Luottai = $Luottai WHERE IDUngDung = ?";
        $stmt_update = $conn -> prepare($query_update_luottai);
        $stmt_update -> bind_param('s', $id_app);
        if(!$stmt_update -> execute()){
            die();
        }
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        readfile($filePath);         
            
    }else{
        echo " khong co ket qua";
    }

   

   
    

?>
