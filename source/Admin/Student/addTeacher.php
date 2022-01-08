<?php
    require('../../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thêm Giảng Viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .bg {
            background: #eceb7b;
        }
    </style>
</head>
<body>
<?php
    $error = '';
    $first_name = '';
    $last_name = '';
    $email = '';
    $user = '';
    $pass = '';
    $pass_confirm = '';
    $phone = '';
    $address = '';
    $birthday = '';
    if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
    && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pass-confirm']))
    {   
        $entropy = uniqid('',true);
        $chunk = explode('.', $entropy);
        $id = '#u'.$chunk[1];
        $first_name = $_POST['first'];
        $last_name = $_POST['last'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $pass_confirm = $_POST['pass-confirm'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        if (empty($first_name)) {
            $error = 'Please enter your first name';
        }
        else if (empty($last_name)) {
            $error = 'Please enter your last name';
        }
        else if (empty($email)) {
            $error = 'Please enter your email';
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'This is not a valid email address';
        }
        else if (empty($user)) {
            $error = 'Please enter your username';
        }
        else if (empty($pass)) {
            $error = 'Please enter your password';
        }else if (empty($phone)){
            $error = 'Please enter your phone number';
        }else if (empty($address)){
            $error = 'Please enter your address';
        }else if(empty($birthday)){
            $error = 'Please choose your birthday';
        }else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
        }
        else if ($pass != $pass_confirm) {
            $error = 'Password does not match';
        }
        else {
            $first_name = stripslashes($_POST['first']);
            $last_name = stripslashes($_POST['last']);
            $email = stripslashes($_POST['email']);
            $user = stripslashes($_POST['user']);
            $pass = stripslashes($_POST['pass']);
            $pass_confirm = stripslashes($_POST['pass-confirm']);
            $phone = stripslashes($_POST['phone']);
            //escapes special characters in a string
            $result = addTeacher($id,$user,$pass,$first_name,$last_name,$phone,$address,$birthday,$email);
            if ($result['code']==0){
                echo '<script>alert("Thêm Giảng viên thành công")</script>';
                header('Location: ../index.php?page=index_student#menu1');
             //success
            }else if($result['code']==1){
                $error = 'This email is already exists';
            }else{
                $error = 'An error occured. Try again';
            }
        }
    }
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 border my-5 p-4 rounded mx-3">
                <h3 class="text-center text-secondary mt-2 mb-3 mb-3">Thông Tin Giảng Viên</h3>
                <form method="post" action="" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First name</label>
                            <input value="<?= $first_name?>" name="first" required class="form-control" type="text" placeholder="First name" id="firstname">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last name</label>
                            <input value="<?= $last_name?>" name="last" required class="form-control" type="text" placeholder="Last name" id="lastname">
                            <div class="invalid-tooltip">Last name is required</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?= $email?>" name="email" required class="form-control" type="email" placeholder="Email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input value="<?= $user?>" name="user" required class="form-control" type="text" placeholder="Username" id="user">
                        <div class="invalid-feedback">Please enter your username</div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input  value="<?= $pass?>" name="pass" required class="form-control" type="password" placeholder="Password" id="pass">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <label for="pass2">Confirm Password</label>
                        <input value="<?= $pass_confirm?>" name="pass-confirm" required class="form-control" type="password" placeholder="Confirm Password" id="pass2">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input value="<?= $phone?>" name="phone" required class="form-control" type="text" placeholder="Phone Number" id="phone">
                        <div class="invalid-feedback">Please enter your phone.</div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input value="<?= $address?>" name="address" required class="form-control" type="text" placeholder="Address" id="address">
                        <div class="invalid-feedback">Please enter your address.</div>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input value="<?= $birthday?>" name="birthday" required class="form-control" type="date" id="birthday">
                        <div class="invalid-feedback">Please choose your birthday.</div>
                    </div>

                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type="submit" class="btn btn-success px-5 mt-3 mr-2">addTeacher</button>
                        <button type="reset" class="btn btn-outline-success px-5 mt-3">Reset</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</body>
</html>

