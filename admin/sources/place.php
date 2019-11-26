<?php	if(!defined('_source')) die("Error");

switch($act){
	case "man_city":
		get_citys();
		$template = "place/citys";
		break;
	case "add_city":		
		$template = "place/city_add";
		break;
	case "edit_city":		
		get_city();
		$template = "place/city_add";
		break;
	case "save_city":
		save_city();
		break;
	case "delete_city":
		delete_city();
		break;

	case "man_dist":
		get_dists();
		$template = "place/dists";
		break;
	case "add_dist":		
		$template = "place/dist_add";
		break;
	case "edit_dist":		
		get_dist();
		$template = "place/dist_add";
		break;
	case "save_dist":
		save_dist();
		break;
	case "delete_dist":
		delete_dist();
		break;	


	case "man_ward":
		get_wards();
		$template = "place/wards";
		break;
	case "add_ward":		
		$template = "place/ward_add";
		break;
	case "edit_ward":		
		get_ward();
		$template = "place/ward_add";
		break;
	case "save_ward":
		save_ward();
		break;
	case "delete_ward":
		delete_ward();
		break;	

	case "man_street":
		get_streets();
		$template = "place/streets";
		break;
	case "add_street":		
		$template = "place/street_add";
		break;
	case "edit_street":		
		get_street();
		$template = "place/street_add";
		break;
	case "save_street":
		save_street();
		break;
	case "delete_street":
		delete_street();
		break;	
	
	default:
		$template = "index";
}

#====================================
function get_citys(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_city SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_city");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_city SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_city");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_place_city where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=place&act=man_city");			
		}
		
		
	}
		
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_place_city where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_city SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_city SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	

	if($_REQUEST['key']!='')
	{
		$where.=" where ten like '%".$_REQUEST['key']."%'";
	}
	
	$sql= "SELECT count(id) AS numrows FROM #_place_city $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_city $where order by id limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=place&act=man_city';		
	
}

function get_city(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_city");	
	$sql = "select * from #_place_city where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_city");
	$item = $d->fetch_array();	
	
}

function save_city(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_city");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['ten'] = $_POST['name'];			
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_city');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_city&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_city");
	}else{
				
		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);		
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_city');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_city");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_city");
	}
}

function delete_city(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_city where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_city".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_city");
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_city");
}
#====================================
function get_dists(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_dist SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_dist");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_dist SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_dist");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_place_dist where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=place&act=man_dist");			
		}
		
		
	}
		
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_place_dist where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_dist SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_dist SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	if((int)$_REQUEST['id_cat']!='')
	{
		$categoryData = get_id_child('place_cat',$_REQUEST['id_cat']);
		$cat_array=implode(",",$categoryData);
		$where.=" where id_cat IN ($cat_array) ";
	}
	
	if($_REQUEST['id_city']!='')
	{
		$where.=" where id_city = '".$_REQUEST['id_city']."'";
	}	
	if($_REQUEST['key']!='')
	{
		$where.=" where ten like '%".$_REQUEST['key']."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_dist $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_dist $where order by id  limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=place&act=man_dist';		
	
}

function get_dist(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_dist");	
	$sql = "select * from #_place_dist where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_dist");
	$item = $d->fetch_array();	
	
}

function save_dist(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_dist");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['ten'] = $_POST['name'];			
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];
		$data['gia'] = $_POST['gia'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_dist');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_dist&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_dist");
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);		
		$data['stt'] = $_POST['num'];
		$data['gia'] = $_POST['gia'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_dist');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_dist");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_dist");
	}
}

function delete_dist(){
	global $d;
	if($_REQUEST['id_city']!='')
	{ $id_catt="&id_city=".$_REQUEST['id_city'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_dist where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_dist".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_dist");
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_dist");
}
#====================================
function get_wards(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_ward SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_ward");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_ward SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_ward");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_place_ward where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=place&act=man_ward");			
		}
		
		
	}
		
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_place_ward where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_ward SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_ward SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
		
	if($_REQUEST['id_city']!='')
	{
		$where.=" where id_city = '".$_REQUEST['id_city']."'";
	}
	if($_REQUEST['id_dist']!='')
	{
		$where.=" and id_dist = '".$_REQUEST['id_dist']."'";
	}	
	if($_REQUEST['key']!='')
	{
		$where.=" where ten like '%".$_REQUEST['key']."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_ward $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_ward $where order by id limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=place&act=man_ward';		
	
}

function get_ward(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward");	
	$sql = "select * from #_place_ward where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_ward");
	$item = $d->fetch_array();	
	
}

function save_ward(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['id_dist'] = (int)$_POST['id_dist'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_ward');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_ward&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_ward");
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];
		$data['id_dist'] = (int)$_POST['id_dist'];		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_ward');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_ward");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_ward");
	}
}

function delete_ward(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_ward where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_ward".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_ward");
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward");
}
#====================================
function get_streets(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_street SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_street");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_place_street SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=place&act=man_street");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){							
				$sql = "delete from table_place_street where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=place&act=man_street");			
		}
		
		
	}
		
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_place_street where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_street SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_place_street SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
		
	if($_REQUEST['id_city']!='')
	{
		$where.=" where id_city = '".$_REQUEST['id_city']."'";
	}
	if($_REQUEST['id_dist']!='')
	{
		$where.=" and id_dist = '".$_REQUEST['id_dist']."'";
	}	
	if($_REQUEST['key']!='')
	{
		$where.=" where ten like '%".$_REQUEST['key']."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_street $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_street $where order by id limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=place&act=man_street';		
	
}

function get_street(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street");	
	$sql = "select * from #_place_street where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_street");
	$item = $d->fetch_array();	
	
}

function save_street(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['id_dist'] = (int)$_POST['id_dist'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_street');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_street&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_street");
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];
		$data['id_dist'] = (int)$_POST['id_dist'];		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_street');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_street");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_street");
	}
}

function delete_street(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_street where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_street".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_street");
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street");
}
?>