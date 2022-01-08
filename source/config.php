<?php
	session_start();
	//Import PHPMailer classes into the global namespace
			//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	function getDB() {
		$conn = new mysqli('127.0.0.1', 'root', '', 'chplay');
		if ($conn -> connect_error) {
			die("error ! Can't connect to MySQL database". $conn -> connect_error);
		}
		else {
			return $conn;
		}
	}

	function sendMailDecline($LastName, $FirstName,$email, $app, $reason){
			

			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->isSMTP();
				$mail->CharSet = "UTF-8";                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'harryvan224@gmail.com';                     //SMTP username
				$mail->Password   = 'zxnlnbmkcasrpeab';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				//Recipients
				$mail->setFrom('harryvan224@gmail.com', 'Admin GooPlay');
				$mail->addAddress($email, 'Developer');     //Add a recipient

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'TỪ CHỐI DUYỆT KHÓA HỌC';
				$mail->Body    = 
							"	Xin chào, <b>$LastName $FirstName</b><br><br>

								Rất tiếc khóa học <b>$app</b> của bạn đã bị <b>TỪ CHỐI</b><br><br>

							    LÝ DO: <b>$reason<b>.
							";
				

				$mail->send();
				return true;
			} catch (Exception $e) {
				return false;
				// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
	}

	function sendMailAccept($LastName, $FirstName,$email, $app){
			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->isSMTP();
				$mail->CharSet = "UTF-8";                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'harryvan224@gmail.com';                     //SMTP username
				$mail->Password   = 'zxnlnbmkcasrpeab';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				//Recipients
				$mail->setFrom('harryvan224@gmail.com', 'Admin GooPlay');
				$mail->addAddress($email, 'Developer');     //Add a recipient

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'KHÓA HỌC ĐÃ ĐƯỢC DUYỆT';
				$mail->Body    = "Xin chúc mừng, <b>$LastName $FirstName</b><br><br>
				 					Khóa học <b>$app</b> của bạn đã được quản trị viên <b>DUYỆT</b>.";

				$mail->send();
				return true;
			} catch (Exception $e) {
				return false;
				// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
	}

	function login($user,$pass){
			$sql = "select * from account where Username =?";
			$conn = getDB();
	
			$stm = $conn->prepare($sql);
			$stm->bind_param('s',$user);
			$stm->execute();
			if(!$stm){
				return array('code'=>-1, 'error'=>'Can not command');
			}
			$result = $stm->get_result();
			$data = $result->fetch_assoc();
			if(empty($data['Username'])){
				return array('code'=>1, 'error'=>'User does not exist');
			}
			$hashed_password = $data['Password'];
			if($pass != $hashed_password){
				return array('code'=>2, 'error'=>'Invalid password');
			}
			else if($data['Activated']==0){
				return array('code'=>3, 'error'=>'This account is not activated');
			}else 
				return array('code'=>0, 'error'=>'','data'=>$data);
	}
	
	function is_email_exists($email){
			$sql = 'select Username from account where Email = ?';
			$conn = getDB();
	
			$stm = $conn->prepare($sql);
			$stm->bind_param('s',$email);
			if(!$stm->execute()){
				die('Query error: '. $stm->error);
			}
	
			$result = $stm->get_result();
			if($result->num_rows>0){
				return true;
			}else{
				return false;
			}
	}

	function register($ID,$user, $pass, $first, $last, $phone, $address, $birthday, $email){
			if(is_email_exists($email)){
				return array('code' => 1, 'error' => 'Email exists');
			}
			
			$hash = md5($pass);
			$rand = random_int(0,1000);
			$token = md5($user .'+'.$rand);
			
			
			$sql = 'insert into account(ID,Username, Password, Firstname, Lastname, SDT, DiaChi, Birthday,
			Email, ActivateToken) values (?,?,?,?,?,?,?,?,?,?)';
	
			$conn = getDB();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssssssssss',$ID,$user,$hash,$first,$last,$phone,$address,$birthday,$email,$token);
	
			if(!$stm->execute()){
				return array('code'=>2, 'error' => 'Can not execute command');
			}
			
			sendActivationEmail($email,$token);
	
			return array('code'=>0,'error'=>'Create account successful');
	}
	function reset_password($email){
		if(!is_email_exists($email)){
			return array('code'=> 1,'error'=>'Email does not exist');
		}
		$token = md5($email.'+'.random_int(1000,2000));
		$sql = 'update reset_token set token = ? where email = ?';
		$conn = getDB();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ss',$token,$email);
		
		if(!$stm->execute()){
			return array('code'=> 2, 'error'=> 'Can not execute command');
		}
		if($stm->affected_rows == 0){
			$exp = time() + 3600 * 24;
			$sql = 'insert into reset_token values(?,?,?)';
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssi',$email,$token,$exp);

			if(!$stm->execute()){
				return array('code'=>1,'error'=>'Can not execute command');
			}
		}
		$success = sendResetEmail($email,$token);
		return array('code'=>0,'success'=>$success);
	}

	function sendResetEmail($email, $token){
		
		//Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				$mail->isSMTP();
				$mail->CharSet = "UTF-8";                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'harryvan224@gmail.com';                     //SMTP username
				$mail->Password   = 'zxnlnbmkcasrpeab';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				//Recipients
				$mail->setFrom('harryvan224@gmail.com', 'Admin GooPlay');
				$mail->addAddress($email, 'Developer');     //Add a recipient 
			// $mail->addAddress('ellen@example.com');               //Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Reset your password';
			$mail->Body    = "Click <a href='http://localhost:8080/reset_password.php?email=$email&token=$token'>here</a> to Reset your password";
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			return true;
		}catch (Exception $e) {
			return false;
		}
	}

	function password_reset($pass,$passconfirm,$email){
		if($pass == $passconfirm){
			$newhash = md5($pass);
			$sql = "UPDATE account SET Password = ? WHERE Email = ?";
			$conn = getDB();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$newhash,$email);

		if(!$stm->execute()){
			return array('code'=>2, 'error' => 'Can not execute command');
		}

		return array('code'=>0,'error'=>'Create account successful');
		}
		
	}

	function sendActivationEmail($email, $token){
			
	
			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);
	
			try {
				//Server settings
				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				$mail->isSMTP();
					$mail->CharSet = "UTF-8";                                            //Send using SMTP
					$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail->Username   = 'harryvan224@gmail.com';                     //SMTP username
					$mail->Password   = 'zxnlnbmkcasrpeab';                               //SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
					$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	
					//Recipients
					$mail->setFrom('harryvan224@gmail.com', 'Admin GooPlay');
					$mail->addAddress($email, 'Developer');     //Add a recipient 
				// $mail->addAddress('ellen@example.com');               //Name is optional
				// $mail->addReplyTo('info@example.com', 'Information');
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');
	
				//Attachments
				// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Account verification';
				$mail->Body    = "Click <a href='http://localhost:8080/activate.php?email=$email&token=$token'>here</a> to verify your account";
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
				$mail->send();
				return true;
			}catch (Exception $e) {
				return false;
			}
	}
	
	function activeAccount($email, $token){
			$sql = 'select Username from account where Email = ? 
					and ActivateToken = ? and Activated = 0';
			$conn = getDB();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$email, $token);
			if(!$stm->execute()){
				return array('code'=> 1,'error'=>'Can not execute command');	
			}
			$result = $stm->get_result();
			if($result->num_rows==0){
				return array('code'=>2,'error'=>'Email address or token not found');
			}
			$sql = "update account set Activated = 1, ActivateToken = '' where Email = ?";
			$stm = $conn->prepare($sql);
			$stm->bind_param('s',$email);
			if(!$stm->execute()){
				return array('code'=>1,'error'=>'Can not execute command');
			}
			return array('code'=>0,'message'=>'Account activated');
	}
	
	function uploadApp($userID, $icon, $file, $tenUngDung, $detail, $type, $kind, $price, $lichday){
		$price = str_replace(",","",$price);
		$conn = getDB();
		$entropy = uniqid('',true);
        $chunk = explode('.', $entropy);
        $id = 'ud'.$chunk[1];

		$iconBase = explode('.', $icon['name']);
		$fileBase  = explode('.', $file['name']);
		$imgFolder = 'Upload/IMG/'.$iconBase[0];
		$fileFolder = 'Upload/FILE/'.$fileBase[0];

		$flag_ok = true;

		$iconExt = array('jpg', 'png', 'jpeg');
		
		$iconType = strtolower(pathinfo('Upload/IMG/'.$icon['name'], PATHINFO_EXTENSION));
		$fileType = strtolower(pathinfo('Upload/FILE/'.$file['name'], PATHINFO_EXTENSION));

		if(!in_array($iconType, $iconExt)){
			return array('code' => '1', 'error' => 'Hãy chọn các định dạng file jpg, png, jpeg ');
		}
		if($fileType != 'zip'){
			return array('code' => '2', 'error' => 'Hãy chọn file zip');
		}
		if($file['size'] > 62500000){
			return array('code' => '3', 'error' => 'File upload lớn hơn '.convert_filesize(62500000));
		}
		else{
			
			if (!file_exists($imgFolder)) {
				mkdir($imgFolder, 0777, true);
			}
			if (!file_exists($fileFolder)) {
				mkdir($fileFolder, 0777, true);
			}
			
			$img = $imgFolder.'/'.$icon['name'];
			$fileS = $fileFolder.'/'.$file['name'];
			
			$sql = "INSERT INTO khoungdung (IDUngDung, ID, TenUngDung, TenFile, Icon, Detail, TheLoai, DungLuong, GiaTien,TrangThai, Type, LichDay) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, 3,?, ?)
			";
			
			$stmt = $conn -> prepare($sql);
			$stmt->bind_param('sssssssiiss',$id,$userID,$tenUngDung,$fileS,$img, $detail, $kind,$file['size'],$price,$type,$lichday);
			$stmt->execute();
			if($stmt == true){
				move_uploaded_file($icon["tmp_name"], $imgFolder.'/'.$icon['name']);
				move_uploaded_file($file["tmp_name"], $fileFolder.'/'.$file['name']);
				header("Location: index.php?page=my_app");;
				return array('code' => '0', 'error' => 'Upload thành công, chờ duyệt');
			}else{
				return array('code' => '4', 'error' => 'Lỗi');
			}
			
		}
		

	}

	function draftApp($userId, $icon, $file, $tenUngDung, $detail, $type, $kind, $price, $lichday){

		  $previous = "javascript:history.go(-1)";
		  if(isset($_SERVER['HTTP_REFERER'])) {
			  $previous = $_SERVER['HTTP_REFERER'];
		  }
		$price = str_replace(",","",$price);
		$conn = getDB();
		$entropy = uniqid('',true);
        $chunk = explode('.', $entropy);
        $id = 'ud'.$chunk[1];
        $userId = $_SESSION['user_id'];

        $iconBase = explode('.', $icon['name']);
		$fileBase  = explode('.', $file['name']);
		$imgFolder = 'Upload/IMG/'.$iconBase[0];
		$fileFolder = 'Upload/FILE/'.$fileBase[0];

        if (!file_exists($imgFolder)) {
			mkdir($imgFolder, 0777, true);
		}
		if (!file_exists($fileFolder)) {
			mkdir($fileFolder, 0777, true);
		}

        $img = $imgFolder.'/'.$icon['name'];
        $fileS = $fileFolder.'/'.$file['name'];
        

       
        $sql = "INSERT INTO khoungdung (IDUngDung, ID, TenUngDung, TenFile, Icon, Detail, TheLoai, DungLuong, GiaTien, Type, Lichday) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        
        $stmt = $conn -> prepare($sql);
        $stmt->bind_param('sssssssiiss',$id,$userId,$tenUngDung,$fileS,$img, $detail, $kind,$file['size'],$price,$type,$lichday);
        $stmt->execute();
        if($stmt == true){

            move_uploaded_file($icon["tmp_name"], $imgFolder.'/'.$icon['name']);
		    move_uploaded_file($file["tmp_name"], $fileFolder.'/'.$file['name']);

            
            header("Location: $previous");
        }else{
            echo "false";
        }
	}

	function showSerials($price,$start_from,$record_per_page){

		echo"<table class=\"table table-hover table-striped table-bordered text-center\">
		<thead>
			<tr>

				<th>Số Seri</th>
				<th>Giá tiền</th>
				<th>Ngày tạo</th>
				<th>Ngày hết hạn</th>
				<th>Tình trạng</th>
				<th>Action</th>
			</tr>
		</thead>";

		$conn = getDB();
        $productNum = 0;
        $sql = "SELECT * FROM thecao where giatien=? Limit $start_from, $record_per_page";
		$stmt = $conn -> prepare($sql);
		$stmt -> bind_param('i', $price);
		$stmt  -> execute();
        $res = $stmt -> get_result();
        if($stmt == TRUE && $res->num_rows > 0){
            $productNum = $res->num_rows;
            $stt = 1;
            while ($data = $res->fetch_array()) {
                $id = $data['IDThe'];
                $serial = $data['SoSeri'];
                $price = $data['GiaTien'];
                $check = $data['Checked'];
                $date = $data['NgayTao'];
                $exp = $data['NgayHetHan'];
                echo "  
                        <tr class=\"item\">
                            <td class=\" align-middle\">$serial</td>
                            <td class=\" align-middle\">".number_format($price)."VND</td>
                            <td class=\" align-middle\">$date</td>
                            <td class=\" align-middle\">$exp</td>
                            <td class=\" align-middle\">";
                                if ($check == 0){
                                        echo "Chưa nạp
                            <td class=\" align-middle\">
                                <button name='del' type=\"submit\" class=\"btn btn-danger\" id=\"del\"
                                    disabled>Delete</button>
                            </td>";
                                    } else{
                                        echo "Đã nạp
                                    
                            <td class=\" align-middle\">
                                <form action=\"Serial/deleteSerial.php\" method=\"post\" style=\"display: inline;\">
                                    <input value=\"$id\" type=\"hidden\" name=\"id\" id=\"deleteForm\">
                                    <button name='del' type=\"submit\" class=\"btn btn-danger\" id=\"del\">Xóa</button>
                                </form>
                            </td>";
                            
                                    }
                            
                        echo "</tr>";
                            
                                        $stt +=1;
                                        }
                                    }
						echo "</table>";
	}

	function showAppByStatus($status, $start_from, $record_per_page){
		$conn = getDB();
		echo "
		<table class=\"table table-hover table-striped table-bordered text-center\">
                            <thead>
                                <tr>
                                    <th>Tên khóa học</th>
                                    <th>Giảng viên</th>
                                    <th>Ngày đăng</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>";
                                    $sql = "SELECT * FROM khoungdung where TrangThai = ? Limit $start_from, $record_per_page";
									$stmt = $conn->prepare($sql);
									$stmt -> bind_param('i',$status);
									$stmt -> execute();
                                    $res = $stmt -> get_result();
                                    if($stmt == TRUE && $res->num_rows > 0){
                                        $productNum = $res->num_rows;
                                        $stt = 1;
                                        while ($data = $res->fetch_array()) {
                                            $id = $data['IDUngDung'];
                                            $idDev = $data['ID'];
                                            $name = $data['TenUngDung'];
                                            $fileName = $data['TenFile'];
                                            $icon = $data['Icon'];
                                            $brief = $data['Brief'];
                                            $detail = $data['Detail'];
                                            $pic = $data['Pictures'];
                                            $dungluong = $data['DungLuong'];
                                            $giatien = $data['GiaTien'];
                                            $trangthai = $data['TrangThai'];
                                            $date = $data['ThoiGianUpLoad'];
                                            $type = $data['TheLoai'];
                                            $price = $data['GiaTien'];
                                            $firstname='';
                                            $lastname='';
                                            $sql1 = "SELECT Firstname, Lastname FROM account where ID='$idDev'";
                                            $res1 = $conn->query($sql1);
                                            if($res1 == TRUE && $res1->num_rows >0){
                                                while ($info = $res1 -> fetch_array()){
                                                    $firstname .= $info['Firstname'];
                                                    $lastname .= $info['Lastname'];
                                                }
                                            }else{
                                                echo $conn -> error;
                                            }
						echo"
                            <tr class=\"item\">
                                <td class=\" align-middle\">
                                    <h4 class=\"text-info\">$name</h4>
                                </td>
                                <td class=\" align-middle\"><strong>$lastname $firstname</strong></td>
                                <td class=\" align-middle\">$date</td>
                                <td class=\" align-middle\">";
                                    if($trangthai == 0){
                                        echo "<h5 class='text-danger'>Từ chối</h5>";
                                    }else if($trangthai == 1){
                                        echo "<h5 class='text-success'>Duyệt</h5>";
                                    }else if($trangthai ==2){
                                        echo "<h5 class='text-muted'>Nháp</h5>";
                                    }else if($trangthai == 3){
                                        echo "<h5 class='text-info'>Chờ duyệt</h5>";
                                    }else if($trangthai == 4){
                                        echo "<h5 class='text-danger'>Gỡ</h5>";
                                    }
                                
                        echo"        </td>
                                <td class=\" align-middle\">
                                    <a class=\"btn btn-outline-info\" href=\"index.php?page=showInfo_apps&&id=$id\">
                                        Chi tiết </a>
                                </td>
                            </tr>";
                        
                                        }
                                    }
                                
                        echo"</table>";
	}

	function showAppByDevID($id, $start_from, $record_per_page){
		$conn = getDB();
		echo "
		<table class=\"table table-hover table-striped table-bordered text-center\">
                            <thead>
                                <tr>
                                    <th>Tên Khóa học</th>
                                    <th>Ngày đăng</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>";
                                    $sql = "SELECT * FROM khoungdung where ID = ? ORDER BY TrangThai DESC Limit $start_from, $record_per_page  " ;
									$stmt = $conn->prepare($sql);
									$stmt -> bind_param('s',$id);
									$stmt -> execute();
                                    $res = $stmt -> get_result();
                                    if($stmt == TRUE && $res->num_rows > 0){
                                        while ($data = $res->fetch_array()) {
                                            $id = $data['IDUngDung'];
                                            $idDev = $data['ID'];
                                            $name = $data['TenUngDung'];
                                            $fileName = $data['TenFile'];
                                            $icon = $data['Icon'];
                                            $brief = $data['Brief'];
                                            $detail = $data['Detail'];
                                            $pic = $data['Pictures'];
                                            $dungluong = $data['DungLuong'];
                                            $giatien = $data['GiaTien'];
                                            $trangthai = $data['TrangThai'];
                                            $date = $data['ThoiGianUpLoad'];
                                            $type = $data['TheLoai'];
                                            $price = $data['GiaTien'];
						echo"
                            <tr class=\"item\">
                                <td class=\" align-middle\">
                                    <h4 class=\"text-info\">$name</h4>
                                </td>
                                <td class=\" align-middle\">$date</td>
                                <td class=\" align-middle\">";
								if($trangthai == 0){
									echo "<h5 class='text-secondary'>Hủy</h5>";
								}
                                    else if($trangthai == 1){
                                        echo "<h5 class='text-success'>Duyệt</h5>";
                                    }else if($trangthai ==2){
                                        echo "<h5 class='text-muted'>Nháp</h5>";
                                    }else if($trangthai == 3){
                                        echo "<h5 class='text-info'>Chờ duyệt</h5>";
                                    }else if($trangthai == 4){
                                        echo "<h5 class='text-danger'>Gỡ</h5>";
                                    }else if($trangthai == 5){
                                        echo "<h5 class='text-secondary'>Hủy</h5>";
                                    }
                                
                        echo"        </td>
                                <td class=\" align-middle\">";
								if($trangthai == 0){
									echo "<a class=\"btn btn-outline-danger\" href=\"delApp.php?id=$id\">Xóa</a>";
								}else if($trangthai ==2){
									echo "<a class=\"btn btn-outline-info\" href=\"update_form.php?id=$id\">Cập nhật</a>";
								}else if($trangthai == 3){
									echo "<a class=\"btn btn-outline-secondary\" href=\"fileAction.php?id=$id&&tus=5\">Hủy</a>";
								}else if($trangthai == 1){
									echo "<a class=\"mr-3 btn btn-outline-danger\" href=\"fileAction.php?id=$id&&tus=4\">Gỡ</a>";
									echo "<a class=\"btn btn-outline-info\" href=\"update_form.php?id=$id\">Chỉnh sửa</a>";
								}else if($trangthai == 4){
									echo "<a class=\"mr-3 btn btn-outline-success\" href=\"fileAction.php?id=$id&&tus=3\">Public</a>";
									echo "<a class=\"btn btn-outline-danger\" href=\"delApp.php?id=$id\">Xóa</a>";
								}else if($trangthai == 5){
									echo "<a class=\"btn btn-outline-success\" href=\"fileAction.php?id=$id&&tus=3\">Upload</a>";
								}
                                    
                         echo"  </td>
                            </tr>";
                        
                                        }
                                    }
                                
                        echo"</table>";
	}

	function convert_filesize($bytes, $decimals = 2){
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

	function change_pass($name,$newpass,$cfnewpass){
		if($newpass == $cfnewpass){
			$newhash = md5($newpass);
			$sql = "UPDATE account SET Password = ? WHERE Username = ?";
			$conn = getDB();
			$stm = $conn->prepare($sql);
			$stm->bind_param('ss',$newhash,$name);

		if(!$stm->execute()){
			return array('code'=>2, 'error' => 'Can not execute command');
		}

		return array('code'=>0,'error'=>'Change password successfully');
		}	
	}


	function showUser($role,$start_from,$record_per_page){

		echo"<table class=\"table table-hover table-striped table-bordered text-center\">
		<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Số Điện Thoại</th>
				<th>Địa chỉ</th>
				<th>Birthday</th>
				<th>Activated</th>
				<th colspan=2>Thao tác</th>
			</tr>
		</thead>";

		$conn = getDB();
        $productNum = 0;
        $sql = "SELECT * FROM account where role=? Limit $start_from, $record_per_page";
		$stmt = $conn -> prepare($sql);
		$stmt -> bind_param('i', $role);
		$stmt  -> execute();
        $res = $stmt -> get_result();
        if($stmt == TRUE && $res->num_rows > 0){
            $productNum = $res->num_rows;
            $stt = 1;
            while ($data = $res->fetch_array()) {
                $id = $data['ID'];
                $fname = $data['Firstname'];
                $lname = $data['Lastname'];
                $sdt = $data['SDT'];
                $diachi = $data['DiaChi'];
                $birthday = $data['Birthday'];
                $activated = $data['Activated'];
          		$role = $data['Role'];
                echo "  
                        <tr class=\"item\">
                            <td class=\" align-middle\">$fname</td>
                            <td class=\" align-middle\">$lname</td>
                            <td class=\" align-middle\">$sdt</td>
                            <td class=\" align-middle\">$diachi</td>
                            <td class=\" align-middle\">$birthday</td>
                            <td class=\" align-middle\">";
                                if ($activated == 0){
                                        echo "Chưa kích hoạt tài khoản
                            <td class=\" align-middle\">
                                <form action=\"Student/deleteUsers.php\" method=\"post\" style=\"display: inline;\">
                                    <input value=\"$id\" type=\"hidden\" name=\"id\" id=\"deleteForm\">
                                    <button name='del' type=\"submit\" class=\"btn btn-danger\" id=\"del\">Xóa</button>
                                </form>
                            </td>
                            <td class=\" align-middle\">
                            	<form action=\"Student/update_student.php\" method=\"post\" style=\"display: inline;\">
                                    <input value=\"$id\" type=\"hidden\" name=\"id\" id=\"deleteForm\">
                                    <button name='edit' type=\"submit\" class=\"btn btn-info\" id=\"edit\">Chỉnh sửa</button>
                                </form>
                            </td>
                            </td>";

                                    } else{
                                        echo "Đã kích hoạt tài khoản
                                    
                            <td class=\" align-middle\">
                                <form action=\"Student/deleteUsers.php\" method=\"post\" style=\"display: inline;\">
                                    <input value=\"$id\" type=\"hidden\" name=\"id\" id=\"deleteForm\">
                                    <button name='del' type=\"submit\" class=\"btn btn-danger\" id=\"del\">Xóa</button>
                                </form>
                            </td>
                            <td class=\" align-middle\">
                            	<form action=\"Student/update_student.php\" method=\"post\" style=\"display: inline;\">
                                    <input value=\"$id\" type=\"hidden\" name=\"id\" id=\"deleteForm\">
                                    <button name='edit' type=\"submit\" class=\"btn btn-info\" id=\"edit\">Chỉnh sửa</button>
                                </form>
                            </td>
                            </td>";
                            
                                    }

                            
                        echo "</tr>";
                            
                                        $stt +=1;
                                        }
                                    }
						echo "</table>";
	}


	function addTeacher($ID,$user, $pass, $first, $last, $phone, $address, $birthday, $email){
			if(is_email_exists($email)){
				return array('code' => 1, 'error' => 'Email exists');
			}
			
			$hash = md5($pass);
			$rand = random_int(0,1000);
			$activated = 1;
			$role = 1;
			
			
			$sql = 'insert into account(ID,Username, Password, Firstname, Lastname, SDT, DiaChi, Birthday,
			Email, Activated, Role) values (?,?,?,?,?,?,?,?,?,?,?)';
	
			$conn = getDB();
			$stm = $conn->prepare($sql);
			$stm->bind_param('sssssssssii',$ID,$user,$hash,$first,$last,$phone,$address,$birthday,$email,$activated,$role);
	
			if(!$stm->execute()){
				return array('code'=>2, 'error' => 'Can not execute command');
			}
			
	
			return array('code'=>0,'error'=>'Create account successful');
	}


	function showSchedule($start_from, $record_per_page){
		$conn = getDB();
		echo "
		<table class=\"table table-hover table-striped table-bordered text-center\">
                            <thead>
                                <tr>
                                    <th>Tên Khóa học</th>
                                    <th>Giảng viên</th>
                                    <th>Ngày dạy / học</th>
                                    <th>Ngày thi</th>
                                    <th colspan=2>Thao tác</th>
                                </tr>
                            </thead>";
                                    $sql = "SELECT * FROM lich GROUP BY IDUngDung DESC Limit $start_from, $record_per_page";
									$stmt = $conn->prepare($sql);
									$stmt -> execute();
                                    $res = $stmt -> get_result();
                                    if($stmt == TRUE && $res->num_rows > 0){
                                        $productNum = $res->num_rows;
                                        $stt = 1;
                                        while ($data = $res->fetch_array()) {
                                            $id = $data['IDUngDung'];
                                            $idDev = $data['ID'];
                                            $lichhoc = $data['Lichhocvaday'];
                                            $lichthi = $data['Lichthi'];
                                            $firstname='';
                                            $lastname='';
                                            $tenUngDung = '';
                                            $sql1 = "SELECT Firstname, Lastname FROM account where ID='$idDev'";
                                            $res1 = $conn->query($sql1);
                                            if($res1 == TRUE && $res1->num_rows >0){
                                                while ($info = $res1 -> fetch_array()){
                                                    $firstname .= $info['Firstname'];
                                                    $lastname .= $info['Lastname'];
                                                }
                                            }else{
                                                echo $conn -> error;
                                            }
                                            $sql2 = "SELECT TenUngDung FROM khoungdung where IDUngDung='$id'";
                                            $res2 = $conn->query($sql2);
                                            if($res2 == TRUE && $res2->num_rows >0){
                                                while ($info2 = $res2 -> fetch_array()){
                                                    $tenUngDung .= $info2['TenUngDung'];
                                                }
                                            }else{
                                                echo $conn -> error;
                                            }
						echo"
                            <tr class=\"item\">
                                <td class=\" align-middle\">
                                    <h4 class=\"text-info\">$tenUngDung</h4>
                                </td>
                                <td class=\" align-middle\"><strong>$lastname $firstname</strong></td>
                                <td class=\" align-middle\">$lichhoc</td>

                                <td class=\" align-middle\">$lichthi";
                                
                        echo"        </td>
                                <td class=\" align-middle\">
                                <form action=\"Student/deleteSchedule.php\" method=\"post\" style=\"display: inline;\">
                                    <input value=\"$id\" type=\"hidden\" name=\"id\" id=\"deleteForm\">
                                    <button name='del' type=\"submit\" class=\"btn btn-danger\" id=\"del\">Xóa</button>
                                </form>
                            </td>
                                <td class=\" align-middle\">
                                    <a class=\"btn btn-outline-info\" href=\"index.php?page=showInfo_apps&&id=$id\">
                                        Chi tiết </a>
                                </td>
                            </tr>";
                        
                                        }
                                    }
                                
                        echo"</table>";
	}

	function showScore($start_from, $record_per_page){
		$conn = getDB();
		echo "
		<table class=\"table table-hover table-striped table-bordered text-center\">
                            <thead>
                                <tr>
                                    <th>Tên Khóa học</th>
                                    <th>Tên Sinh viên</th>
                                    <th>Điểm kiểm tra 1</th>
                                    <th>Điểm kiểm tra 2</th>
                                    <th>Điểm giữa kỳ</th>
                                    <th>Điểm cuối kỳ</th>
                                    <th>Điểm tổng kết</th>
                                    <th>Ghi chú</th>
                                    <th colspan=2>Thao tác</th>
                                </tr>
                            </thead>";
                                    $sql = "SELECT * FROM lichsutai WHERE Giatien > 0 GROUP BY IDUngDung ORDER BY ThoiGianTai DESC Limit $start_from, $record_per_page";
							        $res = $conn-> query($sql);
							        if($res == TRUE){
							            $stt = 1;
							            while ($data = $res->fetch_array()) {
							                $IDnguoimua = $data['ID'];
							                $IDUngDung = $data['IDUngDung'];
							                $price = $data['GiaTien'];
							                $date = $data['ThoiGianTai'];
							                $sql_select = "SELECT TenUngDung FROM khoungdung where IDUngDung='$IDUngDung' ";
							                $ress = $conn-> query($sql_select);
							                $data2 = $ress->fetch_array();
							                $TenUngDung = $data2['TenUngDung'];
							                $sql_select1 = "SELECT Firstname, Lastname FROM account where ID='$IDnguoimua' ";
							                $resss = $conn-> query($sql_select1);
							                $data3 = $resss->fetch_array();
							                $Tennguoitai = $data3['Firstname'] . $data3['Lastname'];
							                $arr = array($Tennguoitai);
							                $sql_select2 = "SELECT * FROM diem where ID='$IDnguoimua' AND IDUngDung= '$IDUngDung' ";
							                $ressss = $conn-> query($sql_select2);
							                $data4 = $ressss->fetch_array();
							                $diem1 = $data4['diem1'];
							                $diem2 = $data4['diem2'];
							                $giuaky = $data4['giuaky'];
							                $cuoiky = $data4['cuoiky'];
							                $diemtongket = $data4['diemtongket'];
							                $ghichu = $data4['ghichu'];
							                $str = "id={$IDUngDung}";
							                $str1 = "idsv={$IDnguoimua}";
							                
						echo"
                            <tr class=\"item\">
                                <td class=\" align-middle\">
                                    <h4 class=\"text-info\">$TenUngDung</h4>
                                </td>
                                <td class=\" align-middle\"><strong>$Tennguoitai</strong></td>
                                <td class=\" align-middle\">$diem1</td>
                                <td class=\" align-middle\">$diem2</td>
                                <td class=\" align-middle\">$giuaky</td>
                                <td class=\" align-middle\">$cuoiky</td>
                                <td class=\" align-middle\">$diemtongket</td>
                                <td class=\" align-middle\">$ghichu";
                                
                        echo"        </td>
                                
                                <td class=\" align-middle\">
                                    <a class=\"btn btn-outline-info\" href=\"Student/addScore.php?$str\">Chỉnh sửa</a>
                                </td>
                            </tr>";
                        
                                        }
                                    }
                                
                        echo"</table>";
	}
?>