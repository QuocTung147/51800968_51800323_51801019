<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Trung tâm tin học</title>
</head>

<body>
<?php
        if (isset($_SESSION['thongtinnapthe'])) {
            $info = $_SESSION['thongtinnapthe'];
            if ($info == 1) {
                echo "<script> alert(\"Nạp thẻ thành công! Số dư hiện tại ".number_format($_SESSION['sodu'])." VNĐ\"); </script>";
                
            }
            elseif ($info == 0) {
                echo "<script> alert(\"Thẻ không hợp lệ vui lòng kiểm tra lại!\"); </script>";
            }
            else {
                echo "<script> alert(\"Thẻ đã được sử dụng!\"); </script>";
            }
            $_SESSION['thongtinnapthe']=null;
        }
    ?>


    <?php 
    include_once('./header.php')
    ?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 col-sm-6 col-xs-12 my-3">
                <div id="mySidenav" class="bg-mute">
                    <div class="sidenav_item my-3">
                        <a id="laptrinh"href="index.php?page=ungdung">Lập Trình</a>
                        <a id="tienganh" href="index.php?page=trochoi">Tiếng Anh</a>
                        <a id="freeapp" href="index.php?page=most_free_app">Miễn phí tải nhiều nhất</a>
                        <a id="costapp" href="index.php?page=most_cost_app">Trả phí tải nhiều nhất</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-11 col-sm-6 col-xs-12 my-3">
        <?php 
			if(isset($_GET['page'])){
				$display = $_GET['page'].'.php';
                include($display);
			}else{
				$display = './home.php';
				include($display);
			}
		?>
    
    </div>
        
    </div>
	
	</div>
    <div class="footer">
    <p>©2021 TDTU University  | Location: Vietnam Language: Vietnamese</p>
</div>

</body>

</html>