<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
                
                
        $record_per_page = 12;
        $page = '';
        if(isset($_GET['page_no'])){
            $page = $_GET['page_no'];
        }else{
            $page = 1;
        }
        $start_from = ($page-1)*$record_per_page;
            require_once("config.php");
            $conn=getDB();            
            $sql = "SELECT * FROM khoungdung WHERE GiaTien > 0 && TrangThai = 1 ORDER BY Luottai Desc LIMIT $start_from, $record_per_page";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)  {
                while($row = $result->fetch_assoc()) {        
                    
        ?>
            <div class="col-md-3 col-sm-6 col-xs-12 app_index">
                <a href="index.php?page=detail_app&&id=<?=$row['IDUngDung']?>">
                    <div class="card">
                        <img class="card-img-top d-flex " src="<?=$row['Icon']?>" alt="Card image">
                        <div class="card-body mb-5 ">
                            <h4 class="card-title text-dark text"><?=$row['TenUngDung']?></h4>
                            <?php   
                                if($row['GiaTien'] > 0){
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Giá: <?=number_format($row['GiaTien'])?> VNĐ</h6>
                            <?php
                                }else{
                                    ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3">Free </h6>
                            <?php
                                }
                            ?>
                            <h6 class="card-subtitle mb-2 text-muted my-3"><?=$row['TheLoai']?></h6>
                        </div>

                        <div class="card-footer">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }                 
            }else{
                echo "<img style='width:100%' src='.\img\\noData.png'>";
            }
                
        ?>

        </div>
        <div class="row">
            <div class="col">
                <div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id='pag-container'>
                            <?php
                                $page_query = "SELECT * FROM khoungdung WHERE GiaTien > 0 AND TrangThai = 1";
                                $page_res = $conn->query($page_query);
                                $total_records = $page_res->num_rows;
                                $total_pages = ceil($total_records/$record_per_page);
                                for($i=1; $i<= $total_pages; $i++){
                                            ?>
                            <li class='page-item pagination-li mr-2'><a class='page-link'
                                    href='index.php?page=most_cost_app&&page_no=<?=$i?>'><?=$i?></a></li>
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