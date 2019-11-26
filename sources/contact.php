<?php  if(!defined('_source')) die("Error");

	$d->reset();
	$sql_contact = "select noidung$lang as noidung from #_about where type='lienhe' limit 0,1";
	$d->query($sql_contact);
	$company_contact = $d->fetch_array();	

	$title_cat = _lienhe;	
	$title = $company_contact['title'];
	$keywords = $company_contact['keywords'];
	$description = $company_contact['description'];	
	
	
	if(!empty($_POST)){
			$recaptcha_response = $_POST['recaptcha_response'];
			$ch = curl_init();

			 curl_setopt_array($ch, array(
			       CURLOPT_URL => $api_url,
			       CURLOPT_RETURNTRANSFER => true,
			       CURLOPT_ENCODING => "",
			       CURLOPT_MAXREDIRS => 10,
			       CURLOPT_TIMEOUT => 30,
			       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			       CURLOPT_CUSTOMREQUEST => "POST",
			       CURLOPT_POSTFIELDS => array(
			           'secret' => $secret_key,
			           'response' => $recaptcha_response,
			       )
			    ));
			  $recaptcha = curl_exec($ch);

			  curl_close($recaptcha);

			  $recaptcha = json_decode($recaptcha);
			  //Nếu multi Recaptcha thì thêm điều kiện action đúng với action đã đặt 
			  if($recaptcha->score >= 0.5 && $recaptcha->action=='contact') { 
			      //insert- data base
				$email_nhantin=$_POST['email_lienhe'];
				$email_nhantin = trim(strip_tags($email_nhantin));
				$email_nhantin = mysql_real_escape_string($email_nhantin);
				$data4['email']=$email_nhantin;
				$data4['hoten']=$_POST['ten_lienhe'];
				$data4['diachi']=$_POST['diachi_lienhe'];
				$data4['sdt']=$_POST['dienthoai_lienhe'];
				$data4['noidung']=$_POST['noidung_lienhe'];	
				$data4['type']='lienhe';
				/*$sql = "INSERT INTO  table_newsletter (email) VALUES ('$email_nhantin')";*/

				$d->setTable('newsletter');
				if ($d->insert($data4)== true) {
				//sending email
				include_once "phpMailer/class.phpmailer.php";	
				$mail = new PHPMailer();
				$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
				$mail->Host       = $ip_host;   // tên SMTP server
				$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
				$mail->Username   = $mail_host; // SMTP account username
				$mail->Password   = $pass_mail;  
		
				//Thiết lập thông tin người gửi và email người gửi
				$mail->SetFrom($mail_host,$_POST['ten_lienhe']);
		
				//Thiết lập thông tin người nhận và email người nhận
				$mail->AddAddress($company['email'], $company['ten']);


				
				
				//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
				$mail->AddReplyTo($_POST['email_lienhe'],$_POST['ten_lienhe']);
		
				//Thiết lập file đính kèm nếu có
				if(!empty($_FILES['file']))
				{
					$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
				}
				
				//Thiết lập tiêu đề email
				$mail->Subject    = $_POST['tieude_lienhe']." - ".$_POST['ten_lienhe'];
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
							<th>Họ tên :</th><td>'.$_POST['ten_lienhe'].'</td>
						</tr>
						<tr>
							<th>Địa chỉ :</th><td>'.$_POST['diachi_lienhe'].'</td>
						</tr>
						<tr>
							<th>Điện thoại :</th><td>'.$_POST['dienthoai_lienhe'].'</td>
						</tr>
						<tr>
							<th>Email :</th><td>'.$_POST['email_lienhe'].'</td>
						</tr>
						
						<tr>
							<th>Tiêu đề :</th><td>'.$_POST['tieude_lienhe'].'</td>
						</tr>
						<tr>
							<th>Nội dung :</th><td>'.$_POST['noidung_lienhe'].'</td>
						</tr>';
					$body .= '</table>';
					
					$mail->Body = $body;
					if($mail->Send())
						transfer(_guilienhethanhcong, "index");
					else
						transfer(_guilienhethatbai, "lien-he"); 
					//end
			  }else{
			      echo "Error";
			  }
			
				
			}else{
				
				transfer(_guilienhethatbai, "lien-he"); 
			}
	}			
?>
