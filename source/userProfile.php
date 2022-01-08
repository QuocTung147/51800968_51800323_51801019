<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <title>User Information</title>
</head>
<body>
<form action="userProfileUpdate.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <?php
                    $currentUser = $_SESSION['user'];
                    $sql = 'select * from account where Username = ?';
                    $conn = getDB();
                    $stm = $conn->prepare($sql);
                    $stm->bind_param('s',$currentUser);
                    $stm->execute();
                    $result = $stm->get_result();
                    $user = $result->fetch_array(MYSQLI_ASSOC);
                    //print_r($user['Avatar']);
                    ?>
                    <div class="profile-userpic">
                    <?php
                    if($user['Avatar'] == ""){
                        echo "<center><img src=\"img/avt.jpg\" class=\"img-responsive\" alt=\"\"></center>";
                    }else{
                        echo '<center><img src="img/'.$user['Avatar'].'" class="img-responsive" alt="" /></center>';
                    }
                    ?>
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?= $user['Username']?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?php if($user['Role'] == 0){
                                echo 'User';
                            }else
                                echo 'Dev'; 
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <center><input name="updateUserpicture" type="file"><center>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="form-group col-md-9">
                            <label for="firstname">First name</label>
                            <input value="<?= $user['Firstname']?>" name="updateFirstname" class="form-control" type="text">
                        </div>
                    <div class="form-group col-md-9">
                            <label for="lastname">Last name</label>
                            <input value="<?= $user['Lastname']?>" name="updateLastname" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-9">
                        <label for="email">Email</label>
                        <input value="<?= $user['Email']?>" name="updateEmail" class="form-control" type="email">
                    </div>
                    <div class="form-group col-md-9">
                        <label for="phone">Phone</label>
                        <input value="<?= $user['SDT']?>" name="updatePhone" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-9">
                        <label for="address">Address</label>
                        <input value="<?= $user['DiaChi']?>" name="updateAddress" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-9">
                        <label for="birthday">Birthday</label>
                        <input value="<?= $user['Birthday']?>" name="updateBirthday" class="form-control" type="date">
                    </div>
                    <div class="form-group col-md-9">
                    <button type="submit" class="btn btn-info" name="updateProfile">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>


