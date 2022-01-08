<?php
    require_once('./config.php');
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
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
                $conn = getDB();
                $stmt = $conn->prepare("SELECT ID FROM account WHERE Username = ?");
                $stmt->bind_param("s", $_SESSION['username']);
                $stmt->execute();
                $result = $stmt->get_result();
                $id = $result->fetch_assoc()['ID'];
                $stmt = $conn->prepare("INSERT INTO developer (ID, GioiThieu) VALUES (?, ?)");
                $stmt->bind_param("ss", $id, $gioithieu);
                $stmt->execute();
                $stmt = $conn->prepare("UPDATE account SET Role = ?, Sodu = ? WHERE ID=?");
                $stmt->bind_param("iis", $check, $sodu, $id);
                $check = 1;
                $sodu = $_SESSION['sodu']-500000;
                $stmt->execute();
                $_SESSION['user'] = 'dev';
                $stmt->close();
                $conn->close();
                echo "<script> alert(\"Nâng cấp thành công.\"); </script>";
                
            }
        }
        
        
    }
    
    
    
    

?>