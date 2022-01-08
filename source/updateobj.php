<?php
	error_reporting(E_ALL);
	require_once('config.php');

	$conn = getDB();
	if(isset($_POST['updateobj'])){
		//print_r($_POST);
		$idDev = $_POST['idDev'];
		$idUpdate = $_POST['idUD'];
		$updateName = $_POST['tenUngDung'];
		$updateTime = $_POST['teachTime'];
		$updateDetail = $_POST['detail'];
		$updateType = $_POST['type'];
		$updateKind = $_POST['kind'];
		$updateprice = $price = str_replace(",","",$_POST['price']);
		$updatestTime = $_POST['testTime'];

		$sql = "update khoungdung set TenUngDung = ?, Detail = ?, TheLoai = ?, GiaTien = ?, Type = ? where IDUngDung = ?";


		$sql1 = "select IDUngDung from lich";
		$stm1 = $conn->query($sql1);
		if($stm1 == TRUE && $stm1->num_rows >0){
		while ($data1 = $stm1 -> fetch_array()){
			if($data1['IDUngDung'] == $idUpdate){
				$sql2 = "update lich set Lichhocvaday = ?, Lichthi = ? where IDUngDung = ? and ID = ?";
				$stm2 = $conn->prepare($sql2);
				$stm2->bind_param('ssss',$updateTime,$updatestTime,$idUpdate,$idDev);
				$stm2->execute();
			}else{
				$sql2 = 'insert into lich(ID,IDUngDung, Lichhocvaday, Lichthi) values (?,?,?,?)';
				$stm2 = $conn->prepare($sql2);
				$stm2->bind_param('ssss',$idDev,$idUpdate,$updateTime,$updatestTime);
				$stm2->execute();
			}
		}
		}else{
            echo $conn -> error;
        }

		$stm = $conn->prepare($sql);
		$stm->bind_param('sssiss',$updateName, $updateDetail, $updateKind, $updateprice, $updateType, $idUpdate,);
		$stm->execute();

		
		if ($stm->error || $stm2->error) {
            echo "FAILURE!!! " . $stm->error;
        }else{
            echo '<script type="text/javascript"> 
                  alert("Upload Successfully"); 
                  window.location.href = "index.php?page=my_app"; 
                  </script>;';
                        
            $stm->close();
            }       
	}else{
        echo '<script type="text/javascript"> 
        		alert("Failed to upload");
        		window.location.href = "index.php?page=my_app"; 
                </script>;';
    }
	
	

?>