<?php 
    if(empty($_GET['file'])){
        die('Cung cap bien file');
    }

    $name = $_GET['file'];
    $fileDir = __DIR__.'/';
    $filePath = $fileDir . $name;

    if(!file_exists($filePath)) {
        die('Tập tin không tồn tại');
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filePath).'"'); 
    header('Content-Transfer-Encoding: binary');
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    flush();
    readfile($filePath);
    header('Refresh:0, url: index.php');
    die()

?>