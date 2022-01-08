<?php  
    require('../../config.php');
    $conn = getDB();

    if(isset($_POST['del'])){
        $id = $_POST['id'];

        $sql = "delete from account where ID='$id'";
        $status = $conn->query($sql);
        if ($status) {
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