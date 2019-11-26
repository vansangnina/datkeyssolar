<?php if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";
switch($act){
	case "man":
	get_languages();
	$template = "language/list";
	break;
	case "man_add":
	$template = "language/list_add";
	break;
	case "man_edit":
	get_language();
	$template = "language/list_add";
	break;
	case "save":
	save_language();
	break;
	case "man_delete":
	delete_language();
	break;
	default:
	$template = "index";
	break;
}
function get_languages(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

if($_REQUEST['keyword']!='')
{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.="and tenbien like '%$keyword%' or ten like '%$keyword%' or tenen like '%$keyword%' or tencn like '%$keyword%' or tenja like '%$keyword%' or tenko like '%$keyword%'";
	$urlcu .= "&keyword=".$_GET['keyword'];
}
$where .=" order by id desc";


$url = "index.php?com=dichnghia&act=man".$urlcu;
$sql="SELECT count(id) AS numrows FROM #_lang where id<>0 $where";
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
$sql = "select id, tenbien, ten, tenen, tencn, tenja, tenko from #_lang where id<>0 $where limit $bg,$pageSize";
$d->query($sql);

$items = $d->result_array();	
$url_link="index.php?com=dichnghia&act=man".$urlcu;	
}
function get_language(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id) transfer("Không nhận được dữ liệu", "index.php?com=dichnghia&act=man");
	$sql = "select * from #_lang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=dichnghia&act=man");
	$item = $d->fetch_array();
}
function save_language(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=dichnghia&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten'] = $_POST['ten'];
		$data['tenen'] = $_POST['tenen'];
		$data['tencn'] = $_POST['tencn'];
		$data['tenja'] = $_POST['tenja'];
		$data['tenko'] = $_POST['tenko'];
		$d->reset();
		$d->setTable('lang');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect("index.php?com=dichnghia&act=man&curPage=".$_REQUEST["curPage"]);
		} else {
			transfer("Cập nhật bị lỗi", "index.php?com=dichnghia&act=man&curPage=".$_REQUEST["curPage"]);
		}
	} else {
		$data['tenbien'] = $_POST['tenbien'];
		$data['ten'] = $_POST['ten'];
		$data['tenen'] = $_POST['tenen'];
		$data['tencn'] = $_POST['tencn'];
		$data['tenja'] = $_POST['tenja'];
		$data['tenko'] = $_POST['tenko'];
		$d->reset();
		$d->setTable('lang');
		if($d->insert($data)){
			redirect("index.php?com=dichnghia&act=man_add");
		} else {
			transfer("Dữ liệu bị lỗi, không thể thêm mới", "index.php?com=dichnghia&act=man");
		}
	}
}
function delete_language(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_lang where id='".$id."'";
		$d->query($sql);
		if($_REQUEST['curPage']!='') $curPage = "&curPage=". $_REQUEST['curPage'];
		else $curPage = "";
		if($d->query($sql))
			redirect("index.php?com=dichnghia&act=man".$curPage);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=dichnghia&act=man".$curPage);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=dichnghia&act=man");
	}
}
?>