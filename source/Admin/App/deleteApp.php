<?php
    require('../../config.php');
    $conn = getDB();
    if(isset($_POST['del'])){
        $id = $_POST['idDel'];

        $query = "DELETE FROM khoungdung where IDUngDung=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt -> execute();

        if ($stmt) {
            // reload page after update
            header("location:../index.php?page=index_apps");
        }

        else {
            // reload page after update
            $url=$_SERVER['HTTP_REFERER'];
            header("location:$url");
        }
    }
    
?>