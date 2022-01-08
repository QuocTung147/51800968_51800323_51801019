<?php 
    require_once("config.php");
    $id= '';
    $conn = getDB();
    $IDUngDung = '';
    $IDDev = '';
    $name = '';
    $icon = '';
    $fileName = '';
    $detail = '';
    $kind = '';
    $price = 0;
    $firstname='';
    $lastname='';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM khoungdung WHERE IDUngDung = ?";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("s",$id);
        $stmt -> execute();
        $result = $stmt -> get_result();
        if($stmt == TRUE && $result -> num_rows > 0){
            while($data = $result -> fetch_array()){
                $IDUngDung .= $data['IDUngDung'];
                $IDDev = $data['ID'];
                $name = $data['TenUngDung'];
                $icon = $data['Icon'];
                $fileName = $data['TenFile'];
                $detail = $data['Detail'];
                $kind = $data['TheLoai'];
                $price = $data['GiaTien'];
                $luottai = $data['Luottai'];
                $sql1 = "SELECT Firstname, Lastname FROM account where ID='$IDDev'";
                $res1 = $conn->query($sql1);
                if($res1 == TRUE && $res1->num_rows >0){
                    while ($info = $res1 -> fetch_array()){
                        $firstname .= $info['Firstname'];
                        $lastname .= $info['Lastname'];
                    }
                }
            }
        }else{
            echo "Lỗi 1 ";
        }
    }else{
        echo "Lỗi 2";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style.css" />
    <script src='./main.js'></script>
    <title>Chi tiết</title>
</head>

<body>

    <div class="container ">
        <div class="row">
            <div class="col">
                <div id="container_detail" class=" mt-3 border rounded mb-5 mx-auto px-3 pt-3 bg-light">
                    <div id="header_detail" class="row">
                        <div class="col-4">
                            <div id="icon">
                                <img class="img-fluid rounded" src="<?=$icon?>" alt="">
                            </div>
                        </div>
                        <div class="col-8">
                            <div id="info">
                                <div class="name">
                                    <p><?=$name?></p>
                                </div>
                                <div class="dev_kind">
                                    <small>
                                        <h6 class="text-primary"><?=$firstname.' '.$lastname?></h6>
                                    </small>
                                    <small>
                                        <h6 class="text-primary"><?=$kind?></h6>
                                    </small>
                                </div>
                                <div class="brief">
                                    <img src="./img/tag.jpg" alt="">
                                    <p>Chứa quảng cáo - Lượt tải: <?=$luottai?></p>
                                </div>
                                <div id="download">
                                    <?php  
                                    if(!isset($_SESSION['user'])){
                                        echo "<div class=\"alert alert-info alert-dismissible fade show\">
                                        <strong><a href=\"login.php\">Đăng nhập</a></strong> để tải ứng dụng.
                                      </div>";
                                    } else{
                                        if($price != 0 ){
                                            $query_check = "SELECT * FROM lichsutai WHERE ID ='".$_SESSION['user_id']."' AND IDUngDung = ?";
                                            $stmt = $conn -> prepare($query_check);
                                            $stmt -> bind_param('s', $_GET['id']);
                                            $stmt -> execute();
                                            $res = $stmt-> get_result();
                                            if($res == TRUE && $res -> num_rows > 0){
                                        ?>
                                            <a href="freeDownload.php?file=<?=$fileName?>&&id_app=<?=$IDUngDung?>" class="btn btn-success" id="download_btn">Cài đặt</a>
                                        <?php
                                            } else{
                                                
                                        ?>
                                    <a href="pay_purchase.php?id_app=<?=$IDUngDung?>" class="btn btn-success" id="download_btn" ><?=number_format($price)?> VNĐ</a>
                        
                                    <?php
                                      }
                                        }else{
                                            ?>
                                                <a href="freeDownload.php?file=<?=$fileName?>&&id_app=<?=$IDUngDung?>" class="btn btn-success" id="download_btn">Cài đặt</a>
                                                
                                            <?php
                                        }
                                    } 
                                    
                                    
                                ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div id="content_detail" class="row">
                        <div class="col">
                            <a data-target="#detail" class="btn btn-info" data-toggle="collapse">Nội dung</a>
                            <div id="detail" class="collapse">
                                <p><?=nl2br($detail)?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                    if(isset($_POST["comment"])){
                        if(!empty($_POST["comment"])){

                            $entropy = uniqid('',true);
                            $chunk = explode('.', $entropy);
                            $idCom =  'cm'.$chunk[1];
                            $comment = $_POST["comment"];
                            $idUser = $_SESSION['user_id'];
                            $userName = $_SESSION['name'];
                            if(isset($_SESSION['user_id']) && isset($_SESSION['name'])){
                                $insertComments = "INSERT INTO comment (id,IDUngDung, comment, sender, sender_id) VALUES ('$idCom',?, '$comment','$userName', '$idUser' )";
                            }else{
                                $insertComments = "INSERT INTO comment (id,IDUngDung, comment) VALUES ('$idCom','$IDUngDung', '$comment')";
                            }
                            
                            $conn = getDB();
                            $stmt = $conn -> query($insertComments);
                            if($stmt == TRUE){
                                $message = '<label class="text-success">Comment posted Successfully.</label>';
                                $status = array(
                                    'error'  => 0,
                                    'message' => $message
                                );	
                            }	
                        } else {
                            $message = '<label class="text-danger">Error: Comment not posted.</label>';
                            $status = array(
                                'error'  => 1,
                                'message' => $message
                            );	
                        }
                    }
                    
                    ?>
                    <div id="comment_rating_detail" class="row">
                        <div class="col">
                            <div id="showComments">
                                <?php
                            $conn = getDB();
                            $commentQuery = "SELECT * FROM comment WHERE IDUngDung = ? ORDER BY id DESC";
                            $stmt = $conn -> prepare($commentQuery);
                            $stmt -> bind_param('s', $IDUngDung);
                            $stmt -> execute();
                            $commentsResult = $stmt -> get_result();
                            $commentHTML = '';
                            while($comment = $commentsResult -> fetch_assoc()){
                                ?>
                                <div class="mt-3 card card-primary hover">
                                    <card class="card-header">
                                        <b><?=$comment["sender"]?></b> on <small><i><?=$comment["date"]?></i></small>
                                    </card>
                                    <div class="card-body">
                                        <div class="card-text"><?=$comment["comment"]?></div>
                                    </div>
                                </div>
                                <?php
                            }
                            
                            ?>
                            </div>
                            <?php 
                                if(isset($_SESSION['user_id']) && isset($_SESSION['name'])){
                                   ?>
                            <form method="POST" id="commentForm">

                                <div class="form-group">
                                    <textarea name="comment" id="comment" class="form-control"
                                        placeholder="Enter Comment" rows="3" required></textarea>
                                </div>
                                <span id="message"></span>
                                <div class="form-group">
                                    <input type="hidden" name="commentId" id="commentId" />
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary"
                                        value="Đăng" />
                                </div>
                            </form>
                            <?php
                                }else{

                                    ?>
                            <p class='text-info'> <a href="login.php">Đăng nhập</a> để đánh giá</p>
                            <?php
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>