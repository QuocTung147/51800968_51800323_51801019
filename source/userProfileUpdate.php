<?php
// Report all PHP errors
error_reporting(E_ALL);
require_once('config.php');
//print_r($_SESSION);

if(isset($_POST['updateProfile'])){
        // print_r($_FILES);
        // echo '<br>';
        // print_r($_FILES['updateUserpicture']);
        
        $userNewFirstname = $_POST['updateFirstname'];
        $userNewLastname = $_POST['updateLastname'];
        //print_r($userNewFirstname);
        $userNewemail =    $_POST['updateEmail'];
        $userNewphone = $_POST['updatePhone'];
        $userNewaddress = $_POST['updateAddress'];
        $userNewbirthday = $_POST['updateBirthday'];
        // $target = 'img/' . $userNewimg;


        $imageName = $_FILES['updateUserpicture']['name'];
        $fileType  = $_FILES['updateUserpicture']['type'];
        $fileSize  = $_FILES['updateUserpicture']['size'];
        $fileTmpName = $_FILES['updateUserpicture']['tmp_name'];
        $fileError = $_FILES['updateUserpicture']['error'];

        $fileImageData = explode('/',$fileType);
        $fileExtension = $fileImageData[count($fileImageData)-1];
        if($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg'){
            if($fileSize < 5000000){
                $fileNewName = "img/".$imageName;
                $uploaded = move_uploaded_file($fileTmpName,$fileNewName);
                if($uploaded){
                    $loggedUser = $_SESSION['user'];
                    $sql = "UPDATE account SET Firstname = ?, Lastname = ?,
                        Email = ?, SDT = ?, DiaChi = ?, Birthday = ?, Avatar = ? WHERE Username = '$loggedUser'";

                    $conn = getDB();
                    $stm = $conn->prepare($sql);
                    $stm->bind_param('sssssss', $userNewFirstname,$userNewLastname,$userNewemail,$userNewphone,$userNewaddress,$userNewbirthday,$imageName);
                    $stm->execute();
                    if ($stm->error) {
                        echo "FAILURE!!! " . $stm->error;
                    }else{
                        echo '<script>alert("Image Uploaded")</script>'; 
                        echo '<script type="text/javascript"> 
                                alert("Upload Successfully"); 
                                window.location.href = "userProfile.php";
                            </script>;';
                        
                        $stm->close();
                    }
                }else{
                    echo '<script type="text/javascript"> 
                            alert("Failed to upload"); 
                            window.location.href = "userProfile.php";
                        </script>;';
                }
            }else{
                echo '<script type="text/javascript"> 
                        alert("Img size must be smaller than 5MB"); 
                        window.location.href = "userProfile.php";
                    </script>;';;
            }             
        }else
            echo '<script type="text/javascript">
                alert("Image type must be img, png or jpeg")
                window.location.href = "userProfile.php";
                </script>';
          

}

?>