<?php 
    require('../config.php');
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
    <title>Thẻ cào</title>
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
</head>

<body>



    <div class="container">
        <div class="row my-5">
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thêm thẻ
                    cào</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item ">
                        <a class="nav-link active " data-toggle="tab" href="#home">10.000</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">20.000</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">50.000</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu3">100.000</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content my-3">
                    <div class="tab-pane container show  active" id="home">
                    <?php showSerials(10000, $start_from, $record_per_page) ?>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" id='pag-container'>
                                    <?php 
                                        $page_query = "SELECT * FROM thecao where giatien=10000";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                                    <li class='page-item pagination-li mr-2'><a class='page-link'
                                            href='index.php?page=index_serials&&page_no=<?=$i?>'><?=$i?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu1">
                    <?php showSerials(20000, $start_from, $record_per_page) ?>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" id='pag-container'>
                                    <?php 
                                        $page_query = "SELECT * FROM thecao where giatien=20000";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                                    <li class='page-item pagination-li mr-2'><a class='page-link'
                                            href='index.php?page=index_serials&&page_no=<?=$i?>#menu1'><?=$i?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu2">
                        <?php showSerials(50000, $start_from, $record_per_page) ?>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" id='pag-container'>
                                    <?php 
                                        $page_query = "SELECT * FROM thecao where giatien=50000";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                                    <li class='page-item pagination-li mr-2'><a class='page-link'
                                            href='index.php?page=index_serials&&page_no=<?=$i?>#menu2'><?=$i?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>


                    </div>
                    <div class="tab-pane container fade" id="menu3">
                    <?php showSerials(100000, $start_from, $record_per_page) ?>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center" id='pag-container'>
                                    <?php 
                                        $page_query = "SELECT * FROM thecao where giatien=100000";
                                        $page_res = $conn->query($page_query);
                                        $total_records = $page_res->num_rows;
                                        $total_pages = ceil($total_records/$record_per_page);
                                        for($i=1; $i<= $total_pages; $i++){
                                            ?>
                                    <li class='page-item pagination-li mr-2'><a class='page-link'
                                            href='index.php?page=index_serials&&page_no=<?=$i?>#menu3'><?=$i?></a></li>
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

    <form action="Serial/generateSerials.php" method="post" style="display: inline;">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo thẻ cào</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>

                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <label for="sl">Số lượng: </label>
                                </td>
                                <td>
                                    <input type="text" id="sl" name="sl"><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price">Giá trị: </label>
                                </td>
                                <td>
                                    <select id="price" name="price">
                                        <option value="10000">10.000</option>
                                        <option value="20000">20.000</option>
                                        <option value="50000">50.000</option>
                                        <option value="100000">100.000</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="hidden" name="id" value="" id="generateForm">
                        <button name='generate' type="submit" class="btn btn-success" id="create">Tạo</button>
                    </div>
                </div>

            </div>
        </div>

    </form>
</body>



</html>