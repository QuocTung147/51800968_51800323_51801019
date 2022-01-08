<?php
// Report all PHP errors
error_reporting(E_ALL);
require_once('../../config.php');
//print_r($_POST);
//print_r($_POST['updateProfileid']);
$id = $_POST['updateProfileid'];
if(isset($id)){
    $userNewFirstname = $_POST['updateFirstname'];
    $userNewLastname = $_POST['updateLastname'];
    $userNewemail = $_POST['updateEmail'];
    $userNewphone = $_POST['updatePhone'];
    $userNewaddress = $_POST['updateAddress'];
    $userNewbirthday = $_POST['updateBirthday'];
    $sql = "UPDATE account SET Firstname = ?, Lastname = ?,
            Email = ?, SDT = ?, DiaChi = ?, Birthday = ?, Avatar = ? WHERE ID = '$id'";
    $conn = getDB();
    $stm = $conn->prepare($sql);
    $stm->bind_param('sssssss', $userNewFirstname,$userNewLastname,$userNewemail,$userNewphone,$userNewaddress,$userNewbirthday,$imageName);
    $stm->execute();
    if ($stm->error) {
        echo "FAILURE!!! " . $stm->error;
    }else{
        echo '<script type="text/javascript"> 
            alert("Upload Successfully"); 
            window.location.href = "../index.php?page=index_student";
            </script>;';
                        
        $stm->close();
    }

}

?>