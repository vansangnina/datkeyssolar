<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
		get_mails();
		$template = "newsletter/items";
		break;	
	case "add":
		$template = "newsletter/item_add";
		break;	
	case "edit":
		get_mail();
		$template = "newsletter/item_add";
		break;			
	case "send":
		send();
		break;	
	case "save":
		save_mail();
		break;		
	case "delete":
		delete();
		break;			
	default:
		$template = "index";
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_mails(){
	global $d, $items;
	$type=$_GET['type'];
	$sql = "select * from #_newsletter where type='".$type."'";
	if($_REQUEST['key']!='')
	{
		$sql.=" and email like '%".$_REQUEST['key']."%'";
	}
	$sql.=" order by stt,id desc";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$items = $d->result_array();
}

function get_mail(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");	
	$sql = "select * from #_newsletter where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=newsletter&act=man");
	$item = $d->fetch_array();
}

function save_mail(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		$data['email'] = $_POST['email'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('newsletter');
		$d->setWhere('id', $id);
		if($d->update($data))
				redirect("index.php?com=newsletter&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=newsletter&act=man");
	}else{
				
		$data['email'] = $_POST['email'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('newsletter');
		if($d->insert($data))
			redirect("index.php?com=newsletter&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=newsletter&act=man");
	}
}

function delete(){
	global $d;
	$type=$_GET['type'];
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_newsletter where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect("index.php?com=newsletter&act=man&type=".$type);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=newsletter&act=man&type=".$type);
	}else transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man&type=".$type);	
}

function send(){
	global $d,$ip_host,$mail_host,$pass_mail;

	$file_name= changeTitle($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");
	
	if($file = upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh,$file_name)){
		$data['file'] = $file;
	}	
	
	$d->setTable('company');
	$d->select();
	$company_mail = $d->fetch_array();
	
	if(isset($_POST['listid'])){
		include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail; 
			
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($company_mail['email'], $company_mail['ten']);

		$listid = explode(",",$_POST['listid']); 
		
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select email from #_newsletter where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
			while($row = $d->fetch_array()){
					$mail->AddAddress($row['email'], $row['email']);
					$mail->AddBCC($company_mail['email'], $company_mail['email']);
					//$mail->AddBCC($row['email'], $row['email']);
					$tenmail = explode('@',$row['email']);
					//Thiết lập tiêu đề
					$mail->Subject    =  $_POST['ten'];

					$mail->IsHTML(true);
					//Thiết lập định dạng font chữ
					$mail->CharSet = "utf-8";	
					$body = $_POST['noidung'];
					
					$body = '<table style="text-align:left;font-weight: normal;">';
					$body .= '
							<tr>
								<td>Xin chào '.$tenmail[0].',</td>
							</tr>
							<tr>
								<td>'.$_POST['noidung'].'</td>
							</tr>';
					$body .= '</table>';
					
					$mail->Body = $body;
					if($data['file']){
						$mail->AddAttachment(_upload_hinhanh.$data['file']);
					}
					if($mail->Send()==false)
					{
						transfer("Hệ thống lỗi,vui lòng thử lại sau.", "index.php?com=newsletter&act=man");
					}					
					$mail->ClearAddresses();
					$mail->ClearCCs();
					$mail->ClearBCCs();
					if($i+1==count($listid))
						transfer("Thông tin đã được gửi đi.", "index.php?com=newsletter&act=man");
				}
			}
		}
		transfer("Hệ thống bị lỗi, xin thử lại sau.", "index.php?com=newsletter&act=man");
	}	
}
?>