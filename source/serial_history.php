<?php 
    include_once('./config.php');
    $conn = getDB();

    $record_per_page = 5;
    $page = '';
    if(isset($_GET['page_no'])){
        $page = $_GET['page_no'];
    }else{
        $page = 1;
    }

    $start_from = ($page-1)*$record_per_page;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lịch sử nạp thẻ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <table class="table table-hover table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Số Seri</th>
                            <th>Giá tiền</th>
                            <th>Ngày nạp</th>
                        </tr>
                    </thead>

                    <?php
        $userID = $_SESSION['user_id'];
        $sql = "SELECT * FROM hoadonnapthe where ID= '$userID' ORDER BY NgayNap DESC Limit $start_from, $record_per_page";
		$res = $conn-> query($sql);
        if($res == TRUE){
            $stt = 1;
            while ($data = $res->fetch_array()) {
                $serial = $data['SoSeri'];
                $price = $data['GiaTien'];
                $date = $data['NgayNap'];
                ?>
                    <tr class="item">
                        <td class=" align-middle"><?=$serial?></td>
                        <td class=" align-middle"><?=number_format($price)?> VNĐ</td>
                        <td class=" align-middle"><?=$date?></td>
                    </tr>
                    <?php 
                }          
            }
                                    ?>
                </table>
            </div>
        </div>

        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id='pag-container'>
                    <?php 
                                        $page_query = "SELECT * FROM hoadonnapthe where id='$userID'";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                    <li class='page-item pagination-li mr-2'><a class='page-link'
                            href='index.php?page=serial_history&&page_no=<?=$i?>'><?=$i?></a></li>
                    <?php
                                        }
                                    ?>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>