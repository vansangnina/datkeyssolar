<?php 

	include ("ajax_config.php");
	insert_comment();
	
function insert_comment(){
		global $d;
		$data['product_id'] = intval($_POST['product_id']);
		$data['parent_id'] = intval($_POST['parent_id']);
		$data['lang'] = $lang;
		$data['ten'.$lang] = magic_quote(trim(strip_tags($_POST['ten'])));
		$data['email'] = magic_quote(trim(strip_tags($_POST['email'])));
		$data['mota'] = magic_quote(trim(strip_tags($_POST['mota'])));
		$data['type'] = magic_quote(trim(strip_tags($_POST['type'])));
		$data['hienthi'] = 0;
		$data['ngaytao'] = time();
		
		$d->setTable('comment');
		if($d->insert($data)){
			$return['thongbao'] = _binhluanthanhcong;
			$return['nhaplai'] = 'nhaplai';
		}
		else
		{
			$return['thongbao'] = _hethongloi;
			$return['nhaplai'] = '0';
		}
		
	echo json_encode($return);
}

?>
