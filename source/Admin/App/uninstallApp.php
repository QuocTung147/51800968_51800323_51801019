<?php
    require('../../config.php');
    $conn = getDB();
    if(isset($_POST['uninstall']) && isset($_POST['reason'])){
        $id = $_POST['idUninstall'];
        $reason = $_POST['reason'];
        
        $query = "UPDATE khoungdung SET TrangThai = 4 , LyDo = ? where IDUngDung=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $reason, $id);
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