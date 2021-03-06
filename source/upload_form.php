<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <title>UPLOAD</title>
</head>
<?php
  

    require('config.php');
    $conn = getDB();
    $error = array();
    $icon = '';
    $file = '';
    $tenUngDung = '';
    $detail = '';
    $type = '';
    $kind = '';
    $price = '';
    $lichday = '';
    if (isset($_POST['public']) && isset($_FILES['imgUpload']) && isset($_FILES['fileUpload']) && isset($_POST['tenUngDung']) && isset($_POST['lichday'])
    && isset($_POST['type']) && isset($_POST['kind']) && isset($_POST['price']) && isset($_POST['detail']))
    {   
        $icon = $_FILES['imgUpload'];
        $file = $_FILES['fileUpload'];
        $tenUngDung = $_POST['tenUngDung'];
        $detail=$_POST['detail'];
        $type=$_POST['type'];
        $kind=$_POST['kind'];
        $price=$_POST['price'];
        $lichday = $_POST['lichday'];

        if ($icon['name'] == '') {
            $error[] = 'Please insert your icon app';
        }
        if ($file['name'] == '') {
            $error[] = 'Please enter your file';
        }
        if (empty($tenUngDung)) {
            $error[] = 'Please enter your app\'s name';
        }
        if (empty($lichday)) {
            $error[] = 'Please enter your teaching schedule time';
        }
        if (empty($detail)) {
            $error[] = 'Please enter detail';
        }
        if (empty($type)) {
            $error[] = 'Please enter choose type app';
        }if (empty($kind)){
            $error[] = 'Please enter choose kind app';
        }if ($price < 0){
            $error[] = 'Please enter price';
        }
        else {
            $userId = $_SESSION['user_id'];
            $tenUngDung = stripslashes($_POST['tenUngDung']);
            $detail=stripslashes($_POST['detail']);
            $type=stripslashes($_POST['type']);
            $kind=stripslashes($_POST['kind']);
            $price=stripslashes($_POST['price']);
    
            //escapes special characters in a string
            $result = uploadApp($userId, $icon, $file, $tenUngDung, $detail, $type, $kind, $price, $lichday);
            if ($result['code']==0){
                $success = $result['error'];
             //success
            }else if($result['code']!=0){
                $error[] = $result['error'];
            }else{
                $error = 'An error occured. Try again';
            }
        }
    }else if(isset($_POST['draft'])){
       
        $userId = $_SESSION['user_id'];
        $icon = $_FILES['imgUpload'];
        $file = $_FILES['fileUpload'];
        $tenUngDung = $_POST['tenUngDung'];
        $detail=$_POST['detail'];
        $type=$_POST['type'];
        $kind=$_POST['kind'];
        $priceStr=$_POST['price'];
        $lichdaytmp = $_POST['lichday'];
        $priceArr = explode(',', $priceStr);
        for($i=0;$i < count($priceArr); $i++){
            $price .= $priceArr[$i];
        }

        $price = (int)$price;

        draftApp($userId, $icon, $file, $tenUngDung, $detail, $type, $kind, $price, $lichday);
    }
?>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class='mt-5 text-center text-primary'>UPLOAD ???NG D???NG</h1>
                <div class='alert alert-info border rounded my-3 mx-auto'>
                    <ul>
                        <li>
                            <h5>Ch??? upload file c?? ??u??i jpg, png, jpeg cho h??nh ???nh</h5>
                        </li>
                        <li>
                            <h5>Ch??? upload file ???ng d???ng d?????i 500 MB v?? file zip</h5>
                        </li>
                        <li>
                            <h5>N???u ???ng d???ng mi???n ph?? th?? h??y nh???p s??? ti???n l?? 0, c??n n???u tr??? ph?? th?? h??y nh???p gi?? ti???n mong mu???n</h5>
                        </li>
                    </ul>
                </div>
               
                <form method="post" enctype="multipart/form-data" action="" class="border rounded mb-5 mx-auto px-3 pt-3 bg-light back" novalidate>
                    <table class="table table-borderless">
                        <tr class="item">
                            <td class="align-middle">
                                <label for="icon">
                                    <h4>Icon</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input type="file" name="imgUpload" id="imgUpload">
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="tenFile">
                                    <h4>File</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                <input type="file" name="fileUpload" id="fileUpload">
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="tenUngDung">
                                    <h4>T??n ???ng d???ng</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="tenUngDung" id="tenUngDung" type="text" class="form-control"
                                        placeholder="T??n ???ng D???ng">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="lichday">
                                    <h4>L???ch d???y</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input name="lichday" id="lichday" type="text" class="form-control"
                                        placeholder="L???ch d???y">
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="detail">
                                    <h4>Chi ti???t</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <textarea name="detail" id="detail" type="text" class="form-control" rows="10"
                                        placeholder="Chi ti???t"> </textarea>
                                </div>
                            </td>
                        </tr>
                        <tr class="item">
                            <td class="align-middle">
                                <label for="type">
                                    <h4>Lo???i ???ng d???ng</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <select name="type" class="form-control" id="typeApp"
                                        onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
                                        <option value="">-- Ch???n lo???i ???ng d???ng --</option>
                                        <option value="laptrinh">L???p Tr??nh</option>
                                        <option value="tienganh">Ti???ng Anh</option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="kind">
                                    <h4>Th??? lo???i</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <script type="text/javascript" language="JavaScript">
                                        document.write(
                                            '<select name="kind" class="form-control" id="kindApp"><option value=""></option></select>'
                                        )
                                    </script>
                                    <noscript>

                                        <select id="kindApp" name="kind">
                                            <option value="open">OPEN</option>
                                            <option value="delivered">DELIVERED</option>
                                        </select>
                                    </noscript>
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle">
                                <label for="price">
                                    <h4>Gi?? ti???n</h4>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="form-group">
                                    <input onkeyup="formatCurrency($(this))" type="text" class="price form-control" 
                                    name="price" id="price" placeholder="Gi?? ti???n" 
                                    pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"/>
                                </div>
                            </td>
                        </tr>

                        <tr class="item">
                            <td class="align-middle" colspan="2">
                                <div class="form-group">
                                <?php
                                    if (!empty($error)) {
                                        ?><div class='alert alert-danger'>
                                            <ul>    
                                            <?php 
                                        for($i=0;$i<count($error);$i++){
                                            echo "<li>$error[$i]</li>";  
                                        }?>
                                            </ul>
                                            </div><?php
                                    }else if(!empty($success)){
                                        echo "<div class='alert alert-success'>$success</div>";
                                        
                                    }
                                ?>
                                </div>
                               
                            </td>
                        </tr>
                        <tr class="item">
                            <td class=" mx-5 text-center align-middle" colspan="2">
                                 <input class="btn btn-success px-5" type="submit" value="Upload" name="public">
                                 <input class="btn btn-info px-5" type="submit" value="L??u b???n nh??p" name="draft">
                                </div>
                               
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
</div>

</body>

</html>