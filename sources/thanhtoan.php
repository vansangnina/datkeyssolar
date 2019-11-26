<?php  if(!defined('_source')) die("Error");	
	
	if(count($_SESSION['cart'])>0)
	{
	#Lấy tỉnh thành phố
	$d->reset();
	$sql = "select id,ten from #_place_city where hienthi=1 order by stt,id desc";
	$d->query($sql);
	$place_city = $d->result_array();
	
	#Lấy hình thức thanh toán
	$d->reset();
	$sql = "select id,ten from #_httt";
	$d->query($sql);
	$hinhthuc_tt = $d->result_array();	
	
	#Lấy thông tin user nếu đã đăng nhập
	$d->reset();
	$sql_info_user = "select * from #_user where id='".$_SESSION['login']['id']."'";
	$d->query($sql_info_user);
	$info_user = $d->fetch_array();

	#Nếu click thanh toán thành công
	if(!empty($_POST)){	
		
		#Lấy thông tin đơn hàng
		$hoten = $_POST['hoten'];
		$dienthoai = $_POST['dienthoai'];
		$diachi = $_POST['diachi'];
		$email = $_POST['email'];
		$noidung = $_POST['noidung'];
		$httt = $_POST['httt'];
		$thanhpho = $_POST['thanhpho'];
		$quan = $_POST['quan'];
		$ip = getRealIPAddress();
		$id_user = $_SESSION['login']['id'];
		
		//validate dữ liệu
		$hoten = trim(strip_tags($hoten));
		$dienthoai = trim(strip_tags($dienthoai));	
		$diachi = trim(strip_tags($diachi));	
		$email = trim(strip_tags($email));	
		$noidung = trim(strip_tags($noidung));

		$hoten = mysql_real_escape_string($hoten);
		$dienthoai = mysql_real_escape_string($dienthoai);
		$diachi = mysql_real_escape_string($diachi);
		$email = mysql_real_escape_string($email);
		$noidung = mysql_real_escape_string($noidung);	
		$tonggia = get_order_total();
		
		$httt = intval($httt);
		$thanhpho = intval($thanhpho);
		$quan = intval($quan);					

		$ngaydangky = time();
		$ngaycapnhat = time();
	
		
		$coloi = false;		
		if ($hoten == NULL) { 
			$coloi=true; $error = _nhaphoten;
		} 
		if ($dienthoai == NULL) { 
			$coloi=true; $error = _nhapsodienthoai;
		}
		if ($diachi == NULL) { 
			$coloi=true; $error = _nhapdiachi;
		}
		if ($thanhpho == NULL) { 
			$coloi=true; $error = _chonthanhpho;
		}
		if ($quan == NULL) { 
			$coloi=true; $error = _chonquanhuyen;
		}
		#Nếu không điền đầy đủ thông tin cần thiết
		if($coloi==true)
		{
			transfer(_vuilongdiendayduthongtin, "thanh-toan.html");
		}
		
		#Nếu điền đầy đủ thông tin cần thiết
		if ($coloi==false) 
		{	
			#Mẫu mã đơn hàng VD:05032016NN101
			$donhangmau = date('dmY').'NN';
			
			#Kiểm tra mã đơn hàng lớn nhất trong ngày
			$d->reset();
			$sql = "select id,madonhang from #_donhang where madonhang like '$donhangmau%' order by id desc limit 0,1";
			$d->query($sql);
			$max_order = $d->fetch_array();
			
			#Nếu không tồn tại đơn hàng nào trong ngày hôm nay
			if(empty($max_order['id']))
			{
				$songaunhien = 101;
			}
			else
			{
				(int)$songaunhien =  substr($max_order['madonhang'],10)+1;
			}
			#Mã đơn hàng của đơn hàng hiện tại là
			$madonhang = date('dmY').'NN'.$songaunhien;
			//dump($tonggia);
			$sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,thanhpho,quan,noidung,ngaytao,tinhtrang,ngaycapnhat,ip,id_user) 
			  VALUES ('$madonhang','$hoten','$dienthoai','$diachi','$email','$httt','$tonggia','$thanhpho','$quan','$noidung','$ngaydangky','1','$ngaycapnhat','$ip','$id_user')";	
		
		#Nếu insert bảng đơn hàng thành công thì tiếp tự insert vào bảng chi tiết đơn hàng
		if(mysql_query($sql))
		{
			if(is_array($_SESSION['cart']))
			{
				$max = count($_SESSION['cart']);
				$coloi = false;
				for($i=0;$i<$max;$i++){
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$size = $_SESSION['cart'][$i]['size'];
					$mausac = $_SESSION['cart'][$i]['mausac'];
					$pmasp = get_code($pid);					
					$pname = get_product_name($pid);
					$pphoto = get_product_photo($pid);
					$pgia = get_price($pid);
					$ptonggia = get_price($pid)*$q;
					
					#Nếu số lượng bàng ko thì bỏ qua
					if($q == 0) continue;
					$sql = "INSERT INTO table_chitietdonhang (madonhang,masp,ten,size,mausac,gia,soluong,tonggia,ngaytao,photo) VALUES ('$madonhang','$pmasp','$pname','$size','$mausac','$pgia','$q','$ptonggia','$ngaydangky','$pphoto')";

					if(mysql_query($sql) == true)
					{
						$coloi = true;
					}	
					else
					{
						transfer("Đơn hàng của bạn chưa được gửi<br>Vui lòng điền đầy đủ thông tin lại<br>Cảm ơn", "thanh-toan.html");
					}
				}
				
				#Nếu insert bảng chitietdonhang thành công thì bắt đầu gửi mail
				if($coloi == true)
				{		
					include_once "phpMailer/class.phpmailer.php";	
					$mail = new PHPMailer();
					$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
					$mail->Host       = $ip_host;   // tên SMTP server
					$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
					$mail->Username   = $mail_host; // SMTP account username
					$mail->Password   = $pass_mail;  
			
					//Thiết lập thông tin người gửi và email người gửi
					$mail->SetFrom($mail_host,$_POST['ten_lienhe']);
					
					$mail->AddAddress($company['email'], 'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
					$mail->AddAddress($email, 'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
					//Thiết lập email nhận email hồi đáp
					
					//nếu người nhận nhấn nút Reply
					$mail->AddReplyTo($email,'Đơn hàng từ website'.$_SERVER["SERVER_NAME"]);
					/*=====================================
					 * THIET LAP NOI DUNG EMAIL
					*=====================================*/
					//Thiết lập tiêu đề
					$mail->Subject    = "Đơn hàng từ website".$_SERVER["SERVER_NAME"];
					$mail->IsHTML(true);
					//Thiết lập định dạng font chữ
					$mail->CharSet = "utf-8";		
						$body = '<table>';
						$body .= '
							<tr>
								<th colspan="2">&nbsp;</th>
							</tr>
							<tr>
								<th colspan="2">Đơn hàng từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
							</tr>
							<tr>
								<th colspan="2">&nbsp;</th>
							</tr>
							<tr>
								<th>Mã đơn hàng :</th><td>'.$mahoadon.'</td>
							</tr>
							<tr>
								<th>Họ tên :</th><td>'.$hoten.'</td>
							</tr>
							<tr>
								<th>Địa chỉ :</th><td>'.$diachi.'</td>
							</tr>
							<tr>
								<th>Email :</th><td>'.$email.'</td>
							</tr>
							<tr>
								<th>Điện thoại :</th><td>'.$dienthoai.'</td>
							</tr>
							<tr>
								<th>Số tiền :</th><td>'.number_format($ptonggia,0, ',', '.').' VNĐ'.'</td>
							</tr>
							<tr>
								<th>Nội dung :</th><td>'.$noidung.'</td>
							</tr>
							';
						$body .= '</table>';
						
						
						#------------Chi tiết đơn hàng---------------------
						$body.='<table border="0" cellpadding="5px" cellspacing="1px" style="color:#000000; background:#ECEAEA; width:100%;">';
						if(is_array($_SESSION['cart']))
						{
							$body.= '<tr bgcolor="#535353" height="30px" style="font-weight:bold;color:#FFF"><td style="text-align:center;">Tên</td><td style="text-align:center;" class="gh_an">Hình ảnh</td> <td align="center">Size</td>  <td align="center">Màu sắc</td> <td align="center">Giá</td><td align="center">Số lượng</td><td align="center" class="gh_an">Tổng giá</td></tr>';
							$max=count($_SESSION['cart']);
							for($i=0;$i<$max;$i++){
								$pid=$_SESSION['cart'][$i]['productid'];
								$size=$_SESSION['cart'][$i]['size'];
								$mausac=$_SESSION['cart'][$i]['mausac'];
								$q=$_SESSION['cart'][$i]['qty'];
								$pmasp=get_code($pid);					
								$pname=get_product_name($pid);
								$pphoto=get_product_photo($pid);
												
								if($q==0) continue;
								
								$body.= '<tr bgcolor="#FFFFFF" style="color:#000000;">';
								$body.='<td width="20%">'.$pname.'</td>';
								$body.='<td width="15%" style="text-align:center;" class="gh_an"><img src="http://'.$config_url.'/upload/sanpham/'.$pphoto.'" style="max-height:35px;" /></td>';
								$body.= '<td width="5%" align="center">'.$size.'</td>';
								$body.= '<td width="10%" align="center"><span style="height:30px; width:30px; background:'.$mausac.'; display:block;"></span></td>';
								$body.='<td width="17%" align="center">'.number_format(get_price($pid),0, ',', '.').'&nbsp;<sup>đ</sup></td>';				
								$body.='<td width="8%" align="center">'.$q.'</td>';                 
								$body.='<td width="10%" align="center" class="gh_an">'.number_format(get_price($pid)*$q,0, ',', '.') .'&nbsp;<sup>đ</sup></td>
								</tr>';
							}
							$body.='<tr bgcolor="#535353" height="30px" style="font-weight:bold;color:#FFF"><td colspan="7">Tổng giá: '.number_format(get_order_total(),0, ',', '.').'&nbsp;<sup>đ</sup></td></tr>';
						}
						else{
							$body.='<tr bgColor="#FFFFFF"><td>Không có sản phẩm nào trong giỏ hàng!</td>';
						}
				   $body.='</table>';
				   #------------Chi tiết đơn hàng---------------------
		
						$mail->Body = $body;
						$_SESSION['cart']=0;
						unset($_SESSION['cart']);
						if($mail->Send())
						{
							
							transfer("Bạn đã đặt hàng thành công.<br> Chúng tôi sẽ liên hệ với bạn sớm nhất.<br>Mã đơn hàng là: ".$mahoadon, "index.html");
						}
						else
							transfer("Bạn đã đặt hàng thành công.<br> Chúng tôi sẽ liên hệ với bạn sớm nhất.<br>Mã đơn hàng là: ".$mahoadon, "index.html");
						}
            }
			else{
				transfer("Đơn hàng của bạn chưa có sản phẩm<br>Vui lòng chọn sản phẩm để đặt hàng<br>Cảm ơn", "index.html");
			}
		}
		else
			transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "index.html");	
		}
	}
	}
	else
	{
		transfer("Bạn chưa mua sản phẩm nào.Vui lòng chọn mua sản phẩm.<br/>Cảm Ơn!!!.", "index.html");
	}
?>

