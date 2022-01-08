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
    <title>Khóa học đang có</title>
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
                            <th>Tên khóa học</th>
                            <th>Điểm kiểm tra</th>
                            <th>Điểm kiểm tra 2</th>
                            <th>Điểm giữa kỳ</th>
                            <th>Điểm cuối kỳ</th>
                            <th>Ghi chú</th>
                            <th>Điểm tổng kết</th>
                        </tr>
                    </thead>

                    <?php
        $userID = $_SESSION['user_id'];
        $sql = "SELECT * FROM diem where ID= '$userID' GROUP BY IDUngDung DESC Limit $start_from, $record_per_page";
		$res = $conn-> query($sql);
        if($res == TRUE){
            $stt = 1;
            while ($data = $res->fetch_array()) {
                $IDUngDung = $data['IDUngDung'];
                $diem1 = $data['diem1'];
                $diem2 = $data['diem2'];
                $diem3 = $data['giuaky'];
                $diem4 = $data['cuoiky'];
                $note = $data['ghichu'];
                $sql_select = "SELECT TenUngDung FROM khoungdung where IDUngDung='$IDUngDung' ";
                $ress = $conn-> query($sql_select);
                $data2 = $ress->fetch_array();
                $TenUngDung = $data2['TenUngDung'];

                $dtk= (int)$diem1*0.1 + (int)$diem2*0.2 + (int)$diem3*0.2 + (int)$diem4*0.5;
                ?>
                    <tr class="item">
                        <td class=" align-middle"><a href="index.php?page=detail_app&&id=<?=$IDUngDung?>"><?=$TenUngDung?></a></td>
                        <td class=" align-middle"><?=$diem1?></td>
                        <td class=" align-middle"><?=$diem2?></td>
                        <td class=" align-middle"><?=$diem3?></td>
                        <td class=" align-middle"><?=$diem4?></td>
                        <td class=" align-middle"><?=$note?></td>
                        <td class=" align-middle"><?=$dtk?></td>
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
                                        $page_query = "SELECT * FROM lichsutai where ID= '$userID' GROUP BY IDUngDung";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                    <li class='page-item pagination-li mr-2'><a class='page-link'
                            href='index.php?page=app_history&&page_no=<?=$i?>'><?=$i?></a></li>
                    <?php
                                        }
                                    ?>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>