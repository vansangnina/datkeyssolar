<?php  if(!defined('_source')) die("Error");	
	
	
	if(count($_SESSION['cart'])>0)
	{

	#Lấy thông tin user nếu đã đăng nhập
	$d->reset();
	$sql_info_user = "select * from #_user where id='".$_SESSION['login']['id']."'";
	$d->query($sql_info_user);
	$info_user = $d->fetch_array();
	
	#Lấy tỉnh thành phố
	$d->reset();
	$sql = "select id,ten from #_place_city where hienthi=1 order by stt,id desc";
	$d->query($sql);
	$place_city = $d->result_array();
	
	#Lấy httt
	$d->reset();
	$sql = "select id,ten$lang as ten from #_httt where hienthi=1 order by stt,id desc";
	$d->query($sql);
	$get_httt = $d->result_array();

	#Nếu click thanh toán thành công
	if(isset($_POST['hoten'])){	
	
		#Lấy thông tin đơn hàng
		$httt = $_POST['httt'];
		$hoten = $_POST['hoten'];
		$dienthoai = $_POST['dienthoai'];
		$thanhpho = (int)$_POST['thanhpho'];
		$quan = (int)$_POST['quan'];
		$diachi = $_POST['diachi'];
		$email = $_POST['email'];
		$noidung = $_POST['noidung'];
		$ip = getRealIPAddress();
		$id_user = $_SESSION['login']['id'];
		
		//validate dữ liệu
		$httt = (int)$httt;
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

		$ngaydangky = time();
		$ngaycapnhat = time();	
		
		$coloi = false;		
		if ($hoten == NULL) { 
			$coloi=true; $error = _nhaphoten;
		} 
		if ($dienthoai == NULL) { 
			$coloi=true; $error = _nhapsodienthoai;
		}
		if ($thanhpho == NULL) { 
			$coloi=true; $error = _nhaptinhthanhpho;
		}
		if ($quan == NULL) { 
			$coloi=true; $error = _nhapquanhuyen;
		}
		if ($diachi == NULL) { 
			$coloi=true; $error = _nhapdiachi;
		}
		#Nếu không điền đầy đủ thông tin cần thiết
		if($coloi==true)
		{
			transfer(_vuilongdiendayduthongtin, "gio-hang.html");
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
			$data4['httt']=$httt;
			$data4['madonhang']=$madonhang;
			$data4['hoten']=$hoten;
			$data4['dienthoai']=$dienthoai;
			$data4['thanhpho']=$thanhpho;
			$data4['quan']=$quan;
			$data4['diachi']=$diachi;
			$data4['email']=$email;
			$data4['tonggia']=$tonggia;
			$data4['noidung']=$noidung;
			$data4['ngaytao']=$ngaydangky;
			$data4['tinhtrang']=$httt;
			$data4['ngaycapnhat']=$ngaycapnhat;
			$data4['ip']=$ip;
			$data4['id_user']=$id_user;
			$data4['ghichu']="0";


			/*$sql = "INSERT INTO  table_donhang (httt,madonhang,hoten,dienthoai,thanhpho,quan,diachi,email,tonggia,noidung,ngaytao,tinhtrang,ngaycapnhat,ip,id_user) 
			  VALUES ('$httt','$madonhang','$hoten','$dienthoai','$thanhpho','$quan','$diachi','$email','$tonggia','$noidung','$ngaydangky','1','$ngaycapnhat','$ip','$id_user')";	*/

		
		#Nếu insert bảng đơn hàng thành công thì tiếp tự insert vào bảng chi tiết đơn hàng
			 $d->reset();
			$d->setTable('donhang');
		if($d->insert($data4))
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
					$data1['madonhang']=$madonhang;
					$data1['masp']=$pmasp;
					$data1['ten']=$pname;
					$data1['size']=$size;
					$data1['mausac']=$mausac;
					$data1['gia']=$pgia;
					$data1['soluong']=$q;
					$data1['tonggia']=$ptonggia;
					$data1['ngaytao']=$ngaydangky;
					$data1['photo']=$pphoto;
					$data1['id_sanpham']=$pid;

					/*$sql = "INSERT INTO table_chitietdonhang (madonhang,masp,ten,size,mausac,gia,soluong,tonggia,ngaytao,photo,id_sanpham) VALUES ('$madonhang','$pmasp','$pname','$size','$mausac','$pgia','$q','$ptonggia','$ngaydangky','$pphoto','$pid')";*/
					$d->reset();
					$d->setTable('chitietdonhang');
					if($d->insert($data1))
					{
						$coloi = true;
					}	
					else
					{
						transfer("Đơn hàng của bạn chưa được gửi<br>Vui lòng điền đầy đủ thông tin lại<br>Cảm ơn", "gio-hang.html");
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
								<th>Mã đơn hàng :</th><td>'.$madonhang.'</td>
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
						$body.='<table border="0" cellpadding="5px" cellspacing="1px" style="color:#000000; background:#d4d4d4; width:100%;">';
						if(is_array($_SESSION['cart']))
						{
							$body.= '<tr bgcolor="#F0F0F0" height="55px"><td align="center">STT</td><td style="text-align:center;">Hình S.Phẩm</td><td style="text-align:center;" class="gh_an">Tên sản phẩm</td> <td align="center">Đơn giá</td><td align="center">Số lượng</td> <td align="center">Thành tiền</td></tr>';
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
								$body.='<td width="10%" align="center">'.($i+1).'</td>';
								$body.='<td width="15%" align="center"><img src="http://'.$config_url.'/upload/sanpham/'.$pphoto.'" style="max-height:50px; margin:5px 0;" /></td>';
								$body.='<td width="25%" style="padding:0px 10px; box-sizing:border-box;">'.$pname.'</td>';				
								$body.="<td width='15%' align='center'>".number_format(get_price($pid),0, ',', '.')."&nbsp;<sup>đ</sup></td>";                 
								
								$body.='<td width="10%" align="center">'.$q.'</td>';
								$body.="<td width='15%' align='center'>".number_format(get_price($pid)*$q,0, ',', '.') ."&nbsp;<sup>đ</sup></td>";
								$body.='</tr>';
							}
							$body.='<tr>
                	<td colspan="5" style="background:#F0F0F0; height:55px; text-align:right; padding-right:10px;">Tổng tiền</td>
                	<td style="background: #fff;text-align: center;">'.number_format(get_order_total(),0, ',', '.').'&nbsp;<sup>đ</sup></td>
                </tr>';
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
							
							transfer("Bạn đã đặt hàng thành công.<br> Chúng tôi sẽ liên hệ với bạn sớm nhất.<br>Mã đơn hàng là: ".$madonhang, "http://".$config_url);
						}
						else
							transfer("Bạn đã đặt hàng thành công.<br> Chúng tôi sẽ liên hệ với bạn sớm nhất.<br>Mã đơn hàng là: ".$madonhang, "http://".$config_url);
						}
            }
			else{
				transfer("Đơn hàng của bạn chưa có sản phẩm<br>Vui lòng chọn sản phẩm để đặt hàng<br>Cảm ơn", "http://".$config_url);
			}
		}
		else
			transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "http://".$config_url);	
		}
	}
	}
	else
	{
		transfer("Bạn chưa mua sản phẩm nào.Vui lòng chọn mua sản phẩm.<br/>Cảm Ơn!!!.", "index.html");
	}
?>

