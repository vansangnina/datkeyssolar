<?php 
switch ($com) {
	case 've-chung-toi':
		$type1='vechungtoi';
		break;
	case 'san-pham':
		$type1='sanpham';
		break;
	case 'nang-luong-mat-troi':
		$type1='nangluongmattroi';
		break;
	case 'giai-phap':
		$type1='giaiphap';
		break;
	case 'du-an':
		$type1='duan';
		break;
	case 'cham-soc-khach-hang':
		$type1='chamsockhachhang';
		break;
	case 'tin-tuc':
		$type1='tintuc';
		break;
	case 'tai-lieu':
		$type1='tailieu';
		break;
	case 'lien-he':
		$type1='lienhe';
		break;
	
	default:
		$type1='';
		break;
}

$d->reset();
$sql_contact = "select photo from #_background where type='".$type1."' and hienthi=1 limit 0,1";
$d->query($sql_contact);
$backgroud_type = $d->fetch_array();
 ?>
 <?php if (count($backgroud_type)==1) { ?>
  <div id="quangcao_all">
		<h1 class="tieude_giua"><span><?php if (isset($_GET['id'])) {
			echo  $row_detail['ten'.$lang];
		}else{
			echo $title_cat;
		} ?></span></h1>
 		<img src="<?=_upload_hinhanh_l.$backgroud_type['photo'] ?>" alt="">
 </div>
 <?php } ?>
