<?php 
    require_once('config.php');

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>My App</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <?php
                  $conn = getDB();

                  $record_per_page = 5;
                  $page = '';
                  if(isset($_GET['page_no'])){
                      $page = $_GET['page_no'];
                  }else{
                      $page = 1;
                  }
              
                  $start_from = ($page-1)*$record_per_page;
              
                showAppByDevID($_SESSION['user_id'],$start_from, $record_per_page)
                
                ?>

                <div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id='pag-container'>
                            <?php
                                $id = $_SESSION['user_id']; 
                                $page_query = "SELECT * FROM khoungdung where ID = '$id'";
                                $page_res = $conn->query($page_query);
                                $total_records = $page_res->num_rows;
                                $total_pages = ceil($total_records/$record_per_page);
                                for($i=1; $i<= $total_pages; $i++){
                                            ?>
                            <li class='page-item pagination-li mr-2'><a class='page-link'
                                    href='index.php?page=my_app&&page_no=<?=$i?>'><?=$i?></a></li>
                            <?php
                                        }
                                    ?>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>

    </div>
</body>

</html>