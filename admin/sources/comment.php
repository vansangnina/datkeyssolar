<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['parent_id'])) ? "&parent_id=".addslashes($_REQUEST['parent_id']) : "";
	$urlcu .= (isset($_REQUEST['product_id'])) ? "&product_id=".addslashes($_REQUEST['product_id']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

switch($act){

	case "man":
		get_items();
		$template = "comment/items";
		break;		
	case "add":				
		$template = "comment/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "comment/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	
	default:
		$template = "index";
}

#====================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}	
	if((int)$_REQUEST['product_id']!='')
	{
		$where.=" and product_id=".(int)$_REQUEST['product_id']."";
	}
	if((int)$_REQUEST['parent_id']!='')
	{
		$where.=" and parent_id=".(int)$_REQUEST['parent_id']."";
	}
	
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.= " order by stt asc,id desc";

	$sql="SELECT count(id) AS numrows FROM #_comment where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_comment where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=comment&act=man".$urlcu;
}

function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=commentact=man".$urlcu);
	
	$sql = "select * from #_comment where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=comment&act=man".$urlcu);
	$item = $d->fetch_array();
	
}
//Save tin tức
function save_item(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=comment&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_khac,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_khac,$file_name,1);									
			$d->setTable('comment');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_khac.$row['photo']);	
				delete_file(_upload_khac.$row['thumb']);								
			}
		}
		$data['product_id'] = (int)$_POST['product_id'];		
		$data['parent_id'] = (int)$_POST['parent_id'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten']);								
		$data['stt'] = $_POST['stt'];
		$data['type'] = $_POST['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);			
		}		
		$d->setTable('comment');
		$d->setWhere('id', $id);
		if($d->update($data))
		{
			redirect("index.php?com=comment&act=man".$urlcu);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=comment&act=man".$urlcu);
	}else{

		if($photo = upload_image("file", _format_duoihinh, _upload_khac,$file_name))
		{
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_khac,$file_name,1);	
		}
		$data['product_id'] = (int)$_POST['product_id'];		
		$data['parent_id'] = (int)$_POST['parent_id'];	
		$data['tenkhongdau'] = changeTitle($_POST['ten']);								
		$data['stt'] = $_POST['stt'];
		$data['type'] = $_POST['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);			
		}
		$d->setTable('comment');
		if($d->insert($data))
		{
			redirect("index.php?com=comment&act=man".$urlcu);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=comment&act=man".$urlcu);
	}
}
//===========================================================
function delete_item(){
	global $d,$urlcu;	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_comment where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
		{
			delete_comment($id);
			transfer("Xóa các bình luận thành công", "index.php?com=comment&act=man".$urlcu);
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=comment&act=man".$urlcu);
	}
	else
	{
		transfer("Không nhận được dữ liệu", "index.php?com=comment&act=man".$urlcu);
	}
}

function delete_comment($id)
{
	global $d;
	$d->reset();
	$sql = "select id from table_comment where parent_id='".$id."'";
	$d->query($sql);
	$arr_id = $d->result_array();
	
	foreach ($arr_id as $key => $value)
	{
		$d->reset();
		$sql = "delete from #_comment where id='".$value['id']."'";
		$d->query($sql);
		unset($arr_id[$key]);
		delete_comment($value['id']);
	}
}
?>