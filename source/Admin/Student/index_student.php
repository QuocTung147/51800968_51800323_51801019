<?php 
    require('../config.php');
    $conn = getDB();

    $record_per_page = 10;
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
    <title>Quản lý</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .item img {
            height: 100px;
        }
    </style>
</head>
<script>
        $(document).ready(function () {
            if (location.hash) {
                $("a[href='" + location.hash + "']").tab("show");
            }
            $(document.body).on("click", "a[data-toggle='tab']", function (event) {
                location.hash = this.getAttribute("href");
            });
        });
        $(window).on("popstate", function () {
            var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
            $("a[href='" + anchor + "']").tab("show");
        });
</script>
<body>



    <div class="container">
        <div class="row my-5">
            <div class="col">
                <a href="Student/addTeacher.php" class="btn btn-info"><i class="fas fa-key">Thêm Giảng Viên</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item ">
                        <a class="nav-link active " data-toggle="tab" href="#home">Giảng viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Sinh viên</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content my-3">
                    <div class="tab-pane container show  active" id="home">
                    <?php showUser(0, $start_from, $record_per_page) ?>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" id='pag-container'>
                                    <?php 
                                        $page_query = "SELECT * FROM account where role=0";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                                    <li class='page-item pagination-li mr-2'><a class='page-link'
                                            href='index.php?page=index_student&&page_no=<?=$i?>'><?=$i?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu1">
                    <?php showUser(1, $start_from, $record_per_page) ?>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" id='pag-container'>
                                    <?php 
                                        $page_query = "SELECT * FROM account where role=1";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                                    <li class='page-item pagination-li mr-2'><a class='page-link'
                                            href='index.php?page=index_student&&page_no=<?=$i?>#menu1'><?=$i?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                   
                  
                </div>

            </div>
        </div>

    </div>

</body>



</html>