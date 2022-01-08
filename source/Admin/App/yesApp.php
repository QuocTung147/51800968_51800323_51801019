<?php
    require('../../config.php');
    $conn = getDB();
    if(isset($_POST['yes'])){
        $id = $_POST['idYes'];

        $query = "UPDATE khoungdung SET TrangThai = 1 , LyDo = 'OK' where IDUngDung=?";
        $email = "SELECT Email,Lastname, Firstname from account where ID =
                    (SELECT ID
                    FROM khoungdung
                    WHERE IDUngDung = ?)
        ";
        $name = "SELECT TenUngDung from khoungdung where IDUngDung=? ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt -> execute();

        $stmt2 = $conn->prepare($email);
        $stmt2->bind_param("s", $id);
        $stmt2 -> execute();
        $result = $stmt2->get_result();

        $stmt3 = $conn->prepare($name);
        $stmt3->bind_param("s", $id);
        $stmt3 -> execute();
        $result2 = $stmt3->get_result();

        if ($stmt && $stmt2 && $stmt3) {
            // reload page after update
            
            $data1 = $result->fetch_assoc();
            $data2 = $result2 -> fetch_assoc();
            sendMailAccept($data1['Lastname'],$data1['Firstname'],$data1['Email'], $data2['TenUngDung']);

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