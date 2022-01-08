<?php
    require('./config.php');
    $conn = getDB();
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "DELETE FROM khoungdung where IDUngDung=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
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