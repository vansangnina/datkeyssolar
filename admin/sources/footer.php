<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "footer/item_add";
		break;
	case "save":
		save_gioithieu();
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

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_footer limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=footer&act=capnhat");
	
	if($photo = upload_image("file", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_hinhanh,$file_name,2);
			$d->setTable('footer');			
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
				//delete_file(_upload_hinhanh.$row['thumb']);
			}
		}
	$data['ten'] = $_POST['ten'];
	$data['tenkhongdau'] = changeTitle($_POST['ten']);
	$data['mota'] = $_POST['mota'];
	$data['noidung'] = $_POST['noidung'];
	$data['title'] = $_POST['title'];
	$data['keywords'] = $_POST['keywords'];
	$data['description'] = $_POST['description'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['ngaysua'] = time();
	
	$data['tenen'] = $_POST['tenen'];
	$data['motaen'] = $_POST['motaen'];
	$data['noidungen'] = $_POST['noidungen'];
		
	$d->reset();
	$d->setTable('footer');
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", "index.php?com=footer&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=footer&act=capnhat");
}

?>