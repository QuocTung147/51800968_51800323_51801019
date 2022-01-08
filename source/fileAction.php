<?php
    require('./config.php');
    $conn = getDB();
    if(isset($_GET['id']) && isset($_GET['tus'])){
        $tus = $_GET['tus'];
        $id = $_GET['id'];
        
        $query = "UPDATE khoungdung SET TrangThai = ?  where IDUngDung=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is",$tus, $id);
        $stmt -> execute();
        if ($stmt) {
            // reload page after update

            $url=$_SERVER['HTTP_REFERER'];
            header("location:$url");
        }

        else {
            // reload page after update
            $url=$_SERVER['HTTP_REFERER'];
            header("location:$url");
        }
    }
    
?>