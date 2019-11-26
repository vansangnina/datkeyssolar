<?php
	session_start();
	@define('_source', '../sources/');
	@define('_lib', '../lib/');
	error_reporting(0);
	include_once _lib . "config.php";
	include_once _lib . "constant.php";
	include_once _lib . "functions.php";
	include_once _lib . "library.php";
	include_once _lib . "class.database.php";
	$d = new database($config['database']);
	$d = new database($config['database']);
	
	$id_danhmuc=$_POST['id_danhmuc'];
	$id_list=$_POST['id_list'];

	if(!is_array($id_danhmuc)){
		$id_danhmuc = json_decode($id_danhmuc);
	}

	if(!is_array($id_list)){
		$id_list = json_decode($id_list);
	}

	$where .= " hienthi=1 ";
	if(count($id_danhmuc)>0){
		if(in_array('all',$id_danhmuc)){
			
		} else {
			$where .= "  and ( id_danhmuc=".$id_danhmuc[0];
			for($i=1;$i<count($id_danhmuc);$i++){
				$where .= " or id_danhmuc=".$id_danhmuc[$i];
			}
			$where .= " ) ";
		}
	}

	$d->reset();
    $sql = "select id,ten from #_product_list where $where order by id desc";
    $d->query($sql);
    $row_list = $d->result_array();

?>

<?php for($i=0;$i<count($row_list);$i++){ ?>   
<option value="<?=$row_list[$i]['id']?>" <?php  if($id_list!=''){if(in_array($row_list[$i]['id'],$row_list)){?> selected="selected"<?php } } ?>> - <?=$row_list[$i]['ten']?></option>
<?php } ?>   