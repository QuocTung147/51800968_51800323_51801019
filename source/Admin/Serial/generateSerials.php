<?php

require('../../config.php');
$conn = getDB();

function GenerateSerial() {
    $chars = array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $sn = '';
    $max = count($chars)-1;
    for($i=0;$i<12;$i++){
        $sn .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
    }
        return $sn;
    }

$soLuong = (int)$_POST['sl'];
$price = (int)$_POST['price'];

for($i = 0; $i < $soLuong; $i+=1){
    $serial = GenerateSerial();
    $dat = date("Y-m-d");
    $expdate   = date('Y/m/d', strtotime('+6 months'));
    $sql = "INSERT INTO thecao (SoSeri,GiaTien,NgayTao,NgayHetHan) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt->bind_param("siss", $serial,$price, $dat,$expdate);	
    $stmt->execute();
}
$url=$_SERVER['HTTP_REFERER'];
header("location:$url");

?>