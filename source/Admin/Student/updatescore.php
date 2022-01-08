<?php
	error_reporting(E_ALL);
	require_once('../../config.php');

	$conn = getDB();
	if(isset($_POST['updatescore'])){
		//print_r($_POST);
		$idsv = $_POST['idsv'];
		$idUpdate = $_POST['idUD'];
		$diem1 = $_POST['diem1'];
		$diem2 = $_POST['diem2'];
		$giuaky = $_POST['diem3'];
		$cuoiky= $_POST['diem4'];
		$note = $_POST['note'];
		$dtk= (int)$diem1*0.1 + (int)$diem2*0.2 + (int)$giuaky*0.2 + (int)$cuoiky*0.5;
		strval($dtk);
		$sql1 = "select ID, IDUngDung from diem";
		$res1 = $conn->query($sql1);
        if($res1 == TRUE && $res1->num_rows >0){
            while ($info1 = $res1 -> fetch_array()){
                //echo $info1['ID'];
                //echo $info1['IDUngDung'];
                if($info1['ID'] == $idsv && $info1['IDUngDung'] == $idUpdate){
					$sql2 = "update diem set diem1 = ?, diem2 = ?, giuaky = ?, cuoiky = ?, diemtongket = ?, ghichu = ? where IDUngDung = ? AND ID= ?";
					$stm2 = $conn->prepare($sql2);
					$stm2->bind_param('ssssssss',$diem1,$diem2,$giuaky,$cuoiky,$dtk,$note,$idUpdate, $idsv);
					$stm2->execute();
				}else{
					$sql2 = 'insert into diem(ID,IDUngDung, diem1, diem2, giuaky, cuoiky, ghichu) values (?,?,?,?,?,?,?)';
					$stm2 = $conn->prepare($sql2);
					$stm2->bind_param('sssssss',$idsv,$idUpdate,$diem1,$diem2,$giuaky,$cuoiky,$note);
					$stm2->execute();
				}
            }
        }else{
            echo $conn -> error;
        }
        if ($stm2->error) {
            echo '<script type="text/javascript"> 
                  alert("Upload Successfully"); 
                  window.location.href = "../index.php?page=index_score"; 
                  </script>;';

        }else{
            echo '<script type="text/javascript"> 
                  alert("Upload Successfully"); 
                  window.location.href = "../index.php?page=index_score"; 
                  </script>;';
                        
            $stm->close();
            }       
	}else if(isset($_POST['deletescore'])){
		$idsv = $_POST['idsv'];
		$idUpdate = $_POST['idUD'];
		$delete_sql = "delete from diem where ID = '$idsv' AND IDUngDung = '$idUpdate' ";
		$res1 = $conn->query($delete_sql);
		 echo '<script type="text/javascript"> 
                  alert("Upload Successfully"); 
                  window.location.href = "../index.php?page=index_score"; 
                  </script>;';	
	}

	else{
        echo '<script type="text/javascript"> 
        		alert("Failed to upload");
        		window.location.href = "../index.php?page=index_score"; 
                </script>;';
		
		
		
    }	
	
	

?>