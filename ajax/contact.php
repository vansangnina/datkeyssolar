<?php 

	include ("ajax_config.php");
	
	$ten = trim(strip_tags($_POST['ten_lienhe']));
	$diachi = trim(strip_tags($_POST['diachi_lienhe']));
	$dienthoai = trim(strip_tags($_POST['dienthoai_lienhe']));
	$email = trim(strip_tags($_POST['email_lienhe']));
	$tieude = trim(strip_tags($_POST['tieude_lienhe']));
	$noidung = trim(strip_tags($_POST['noidung_lienhe']));
	$capcha = strtoupper(trim(strip_tags($_POST['capcha'])));
	
	if(!empty($_POST)){
		if($capcha != $_SESSION['key'])
		{
			$return['thongbao'] = _mabaovesai;
			$return['nhaplai'] = '0';
		}
		else
		{
			include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;  
	
			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host,$ten);
	
			//Thiết lập thông tin người nhận và email người nhận
			$mail->AddAddress($company['email'], $company['ten']);
			
			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($email,$ten);
	
			//Thiết lập file đính kèm nếu có
			if(!empty($_FILES['file']))
			{
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
			}
			
			//Thiết lập tiêu đề email
			$mail->Subject    = $tieude." - ".$ten;
			$mail->IsHTML(true);
			
			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";	
				$body = '<table>';
				$body .= '
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">Thư liên hệ từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ tên :</th><td>'.$ten.'</td>
					</tr>
					<tr>
						<th>Địa chỉ :</th><td>'.$diachi.'</td>
					</tr>
					<tr>
						<th>Điện thoại :</th><td>'.$dienthoai.'</td>
					</tr>
					<tr>
						<th>Email :</th><td>'.$email.'</td>
					</tr>
					
					<tr>
						<th>Tiêu đề :</th><td>'.$tieude.'</td>
					</tr>
					<tr>
						<th>Nội dung :</th><td>'.$noidung.'</td>
					</tr>';
				$body .= '</table>';

				$mail->Body = $body;
				if($mail->Send())
				{
					$return['thongbao'] = _guilienhethanhcong;
					$return['nhaplai'] = 'nhaplai';
				}
				else
				{
					$return['thongbao'] = _guilienhethatbai;
					$return['nhaplai'] = '2';
				}
		}
	}
	echo json_encode($return);
?>
