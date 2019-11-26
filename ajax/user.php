<?php 

include ("ajax_config.php");
$act = magic_quote(trim(strip_tags($_POST['act'])));

switch($act){
	case "dangky":
		insert_user();
		break;
	case "dangnhap":
		check_user();
		break;
	case "login_fb":
		check_user_fb();
		break;
	case "login_gg":
		check_user_gg();
		break;
	case "quenmatkhau":
		forgot_password();
		break;
	case "thaydoithongtin":
		change_info();
		break;
	default:
		break;
}
	
function insert_user(){
	global $d;
	$capcha = magic_quote(strtoupper(trim(strip_tags($_POST['capcha']))));
		
	if($capcha != $_SESSION['key'])
	{
		$return['thongbao'] = _mabaovesai;
		$return['nhaplai'] = '0';
	}
	else
	{
		$data['username'] = magic_quote(trim(strip_tags($_POST['tendangnhap'])));
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $data['username']);
		$d->select();
		if($d->num_rows()>0) 
		{
			$return['thongbao'] = _tendangnhapdatontai;
			$return['nhaplai'] = 'tontai';
			
		}
		else
		{
			$data['password'] = md5($_POST['matkhau']);
			$data['ten'] = magic_quote(trim(strip_tags($_POST['ten_lienhe'])));
			$data['diachi'] = magic_quote(trim(strip_tags($_POST['diachi_lienhe'])));
			$data['dienthoai'] = magic_quote(trim(strip_tags($_POST['dienthoai_lienhe'])));
			$data['email'] = magic_quote(trim(strip_tags($_POST['email_lienhe'])));
			$data['gioitinh'] = magic_quote(trim(strip_tags($_POST['gioitinh_lienhe'])));
			$data['ngaysinh'] = strtotime($_POST['ngaysinh_lienhe']);
			$data['role'] = 1;
			$data['com'] = "user";
			
			$d->setTable('user');
			if($d->insert($data)){
				$return['thongbao'] = _dangkythanhcong;
				$return['nhaplai'] = 'nhaplai';
			}
			else
			{
				$return['thongbao'] = _hethongloi;
				$return['nhaplai'] = '0';
			}
		}
	}
	echo json_encode($return);
}

function check_user(){
	global $d;
	$capcha = magic_quote(strtoupper(trim(strip_tags($_POST['capcha']))));
		
	if($capcha != $_SESSION['key'])
	{
		$return['thongbao'] = _mabaovesai;
		$return['nhaplai'] = '0';
	}
	else
	{
		$username =$_POST['tendangnhap'];
		$password = $_POST['matkhau'];
		
		$sql = "select id,username,password,email,active from #_user where username='".$username."'";
		$d->query($sql);	
		if($d->num_rows() == 1)
		{
			$row = $d->fetch_array();
			if($row['active'] != 0)
			{	
				if($row['password'] == md5($password))
				{
					$_SESSION[$login_name] = true;
					$_SESSION['login']['id'] = $row['id'];
					$_SESSION['login']['username'] = $row['username'];
					$return['thongbao'] = _dangnhapthanhcong;
					$return['nhaplai'] = 'nhaplai';
					$return['chuyentrang'] = 'chuyentrang';
				}
				else 
				{ 
					$return['thongbao'] = _matkhaukhongdung;
					$return['nhaplai'] = 'nhaplai';
				 }
			}
			else {
					$return['thongbao'] = _taikhoanchuakichhoat;
					$return['nhaplai'] = 'nhaplai';
				}
		}
		else {
			$return['thongbao'] = _tendangnhapkhongtontai;
			$return['nhaplai'] = 'nhaplai';
		}
	}
	echo json_encode($return);
}

function check_user_fb(){
	
	global $d;
	$id_facebook = $_POST['id_facebook'];
	$ten = $_POST['ten'];
	$email = $_POST['email'];
	
	$d->reset();
	$sql = "select id from #_user where id_facebook='".$id_facebook."'";
	$d->query($sql);
	$check_fb = $d->fetch_array();
	
	//Chưa có trong bảng thành viên
	if(empty($check_fb))
	{
		$data['id_facebook'] = $_POST['id_facebook'];
		$data['ten'] = $_POST['ten'];
		$data['username'] = $_POST['ten'];
		$data['email'] = $_POST['email'];
		$data['active'] = 1;
		$data['hienthi'] = 1;
		$data['com'] = 'user';
			
		$d->setTable('user');
		if($d->insert($data)){
			$_SESSION[$login_name] = true;
			$_SESSION['login']['id'] = $check_fb['id'];
			$return['thongbao'] = _dangnhapthanhcong;
			$return['nhaplai'] = 'nhaplai';
		}
	}
	//Đã đang nhập bàng facebook rùi	
	else
	{
		$_SESSION[$login_name] = true;
		$_SESSION['login']['id'] = $check_fb['id'];
		
		$return['thongbao'] = _dangnhapthanhcong;
		$return['nhaplai'] = 'nhaplai';
	}	
	echo json_encode($return);

}
function check_user_gg(){
	
	global $d;
	$id_google = $_POST['id_google'];
	$ten = $_POST['ten'];
	$email = $_POST['email'];
	
	$d->reset();
	$sql = "select id from #_user where id_google='".$id_google."'";
	$d->query($sql);
	$check_fb = $d->fetch_array();
	
	//Chưa có trong bảng thành viên
	if(empty($check_fb))
	{
		$data['id_google'] = $_POST['id_google'];
		$data['ten'] = $_POST['ten'];
		$data['username'] = $_POST['ten'];
		$data['email'] = $_POST['email'];
		$data['active'] = 1;
		$data['hienthi'] = 1;
		$data['com'] = 'user';
			
		$d->setTable('user');
		if($d->insert($data)){
			$_SESSION[$login_name] = true;
			$_SESSION['login']['id'] = $check_fb['id'];
			$return['thongbao'] = _dangnhapthanhcong;
			$return['nhaplai'] = 'nhaplai';
		}
	}
	//Đã đang nhập bàng facebook rùi	
	else
	{
		$_SESSION[$login_name] = true;
		$_SESSION['login']['id'] = $check_fb['id'];
		
		$return['thongbao'] = _dangnhapthanhcong;
		$return['nhaplai'] = 'nhaplai';
	}	
	echo json_encode($return);
}

function forgot_password(){
	global $d;
	$capcha = magic_quote(strtoupper(trim(strip_tags($_POST['capcha']))));
		
	if($capcha != $_SESSION['key'])
	{
		$return['thongbao'] = _mabaovesai;
		$return['nhaplai'] = '0';
	}
	else
	{
		$email_lienhe =$_POST['email_lienhe'];
		$dienthoai_lienhe = $_POST['dienthoai_lienhe'];
		
		$sql = "select * from #_user where email='".$email_lienhe."' and dienthoai='".$dienthoai_lienhe."'";
		$d->query($sql);
		$user_info = $d->fetch_array();		
		if($d->num_rows() == 1)
		{
			$password_new = ChuoiNgauNhien(10);
			$chuoingaunhien = md5($password_new);
			
			include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;  
	
			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host,$company['ten']);
	
			//Thiết lập thông tin người nhận và email người nhận
			$mail->AddAddress($user_info['email'], $user_info['ten']);
			
			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($company['email'],$company['ten']);
	
			//Thiết lập file đính kèm nếu có
			if(!empty($_FILES['file']))
			{
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
			}
			
			//Thiết lập tiêu đề email
			$mail->Subject    = $company['ten']." xin cung cấp lại thông tin tài khoản của bạn trên website ".$_SERVER["SERVER_NAME"];
			$mail->IsHTML(true);
			
			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";	
				$body = '<table>';
				$body .= '
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">'.$company['ten'].' xin cung cấp lại thông tin tài khoản của bạn trên website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>'._tendangnhap.' :</th><td>'.$user_info['username'].'</td>
					</tr>
					<tr>
						<th>'._matkhau.' :</th><td>'.$password_new.'</td>
					</tr>
					<tr>
						<th>'._hoten.' :</th><td>'.$user_info['ten'].'</td>
					</tr>
					<tr>
						<th>'.diachi.' :</th><td>'.$user_info['diachi'].'</td>
					</tr>
					<tr>
						<th>'._dienthoai.' :</th><td>'.$user_info['dienthoai'].'</td>
					</tr>
					<tr>
						<th>Email :</th><td>'.$user_info['email'].'</td>
					</tr>';
				$body .= '</table>';
				
				$mail->Body = $body;
				if($mail->Send())
				{
					$sql_password = "UPDATE #_user SET password='".$chuoingaunhien."' WHERE id ='".$user_info['id']."'";
					if($d->query($sql_password))
					{
						$return['thongbao'] = _vuilongkiemtralaiemail;
						$return['nhaplai'] = 'nhaplai';
						$return['chuyentrang'] = 'chuyentrang';
					}
					else
					{
						$return['thongbao'] = _hethongloi;
						$return['nhaplai'] = 'nhaplai';
					}
				}
				else
				{
					$return['thongbao'] = _hethongloi;
					$return['nhaplai'] = 'nhaplai';
				}				
		}
		else {
			$return['thongbao'] = _thongtinkhongchinhxac;
			$return['nhaplai'] = 'nhaplai';
		}
	}
	echo json_encode($return);
}

function change_info(){
	global $d;
	$capcha = magic_quote(strtoupper(trim(strip_tags($_POST['capcha']))));
		
	if($capcha != $_SESSION['key'])
	{
		$return['thongbao'] = _mabaovesai;
		$return['nhaplai'] = '0';
	}
	else
	{		
		if($_POST['matkhaucu']!='')
		{
			$password_new = md5($_POST['matkhaucu']);
			$data['password'] = md5($_POST['matkhau']);
			$sql = "select id,password from #_user where id='".$_SESSION['login']['id']."' and password='".$password_new."'";
			$d->query($sql);	
			if($d->num_rows() != 1)
			{
				$return['thongbao'] = _matkhaukhongdung;
				$return['nhaplai'] = '0';
				echo json_encode($return);
				return;
			}
		}

		$data['ten'] = magic_quote(trim(strip_tags($_POST['ten_lienhe'])));
		$data['diachi'] = magic_quote(trim(strip_tags($_POST['diachi_lienhe'])));
		$data['dienthoai'] = magic_quote(trim(strip_tags($_POST['dienthoai_lienhe'])));
		$data['email'] = magic_quote(trim(strip_tags($_POST['email_lienhe'])));
		$data['gioitinh'] = magic_quote(trim(strip_tags($_POST['gioitinh_lienhe'])));
		$data['ngaysinh'] = strtotime($_POST['ngaysinh_lienhe']);
		
		$d->setTable('user');
		$d->setWhere('id', $_SESSION['login']['id']);
		if($d->update($data))
		{
			if($_POST['matkhaucu']!='')
			{
				unset($_SESSION[$login_name]);
				unset($_SESSION['login']);
				$return['chuyentrang'] = 'chuyentrang';
			}
			$return['thongbao'] = _capnhatthanhcong;
			$return['nhaplai'] = 'nhaplai';
			
		}
		else
		{
			$return['thongbao'] = _hethongloi;
			$return['nhaplai'] = '0';
		}
		
	}
	echo json_encode($return);
}
?>
