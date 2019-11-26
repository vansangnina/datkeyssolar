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
	
	$id_list=$_POST['id_list'];
	$id_cat=$_POST['id_cat'];

	if(!is_array($id_list)){
		$id_list = json_decode($id_list);
	}

	if(!is_array($id_cat)){
		$id_cat = json_decode($id_cat);
	}

	$where .= " hienthi=1 ";
	if(count($id_list)>0){
		if(in_array('all',$id_list)){
			
		} else {
			$where .= "  and ( id_list=".$id_list[0];
			for($i=1;$i<count($id_list);$i++){
				$where .= " or id_list=".$id_list[$i];
			}
			$where .= " ) ";
		}
	}

	$d->reset();
    $sql = "select id,ten from #_product_cat where $where order by id desc";
    $d->query($sql);
    $row_cat = $d->result_array();

?>

<?php for($i=0;$i<count($row_cat);$i++){ ?>   
<option value="<?=$row_cat[$i]['id']?>" <?php  if($id_cat!=''){if(in_array($row_cat[$i]['id'],$id_cat)){?> selected="selected"<?php } } ?>> - <?=$row_cat[$i]['ten']?></option>
<?php } ?>   