<?php
	include ("ajax_config.php");
$order=$_GET['order'];
$dm=$_GET['dm'];
$vitridau=$_GET['vitri'];
$dm=$_GET['dm'];
//echo 'Vào='.$vitridau;
//dem tong dong 
if ($order==0||$order=='') {
	$sql1="select * from table_product where type='sanpham'  and noibat=1 and hienthi=1 and id_danhmuc=".$dm." order by stt,id desc";
	$sql="select * from #_product where noibat=1 and type='sanpham'  and hienthi=1 and id_danhmuc=".$dm." order by stt,id desc";
}
if ($order==1) {
	$sql1="select * from table_product where type='sanpham' and spmoi=1  and noibat=1 and hienthi=1 and id_danhmuc=".$dm." order by stt,id desc";
	$sql="select * from #_product where noibat=1 and type='sanpham' and spmoi=1  and hienthi=1 and id_danhmuc=".$dm." order by stt,id desc";
}
if ($order==2) {
	$sql1="select * from table_product where type='sanpham' and spbanchay=1  and noibat=1 and  and id_danhmuc=".$dm." hienthi=1 order by stt,id desc";
	$sql="select * from #_product where noibat=1 and type='sanpham' and spbanchay=1  and id_danhmuc=".$dm." and hienthi=1 order by stt,id desc";
}
if ($order==3) {
	$sql1="select * from table_product where type='sanpham' and  noibat=1 and hienthi=1 and id_danhmuc=".$dm." order by stt,id,luotxem desc ";
	$sql="select * from #_product where noibat=1 and type='sanpham' and hienthi=1 and id_danhmuc=".$dm." order by stt,id desc";
}

$d->query($sql);
//echo 'abc';exit();
$tongdong=$d->num_rows();
//echo 'tongdong='.$tongdong;
//Số dòng hiện
$sodonghien=$company['soluong_sp'];

$tongsotrang=ceil($tongdong/$sodonghien);//Định số trang


//query

$sql.=' limit '.$vitridau.','.$sodonghien.'';
$d->query($sql);
//dump($sql);
$product = $d->result_array();	
/*===============================Xuat file=======================================*/
?>
<div class="wap_item">
<?php for($j=0;$j<count($product);$j++){ ?>
					<div class="box_sanpham">
						<div class="img" id="hover_sang1">
							<a href="san-pham/<?=$product[$j]['tenkhongdau'] ?>.html"><img src="thumb/270x245/1/<?=_upload_sanpham_l.$product[$j]['photo'] ?>" alt=""></a>
						</div>
						<div class="info">
							<a href="san-pham/<?=$product[$j]['tenkhongdau'] ?>.html"><?=$product[$j]['ten'] ?></a>
							<div class="price_view">
								<p>Giá: <span><?php if ($product[$j]['gia']>0) {
									echo number_format($product[$j]['gia'])." đ";
								}else{
									echo "Liên Hệ";
								} ?></span></p>
								<p>View: <?=$product[$j]['luotxem'] ?></p>
							</div>
						</div>
					</div>
<?php }?>
<?php count($product); ?>
</div>
<?php 
echo '<div class="clear"></div>';	
echo '<div class="pagination"><ul class="pages">';
	
if($tongsotrang>1){

	$tranghientai=($vitridau/$sodonghien)+1;
	$vitritam=$vitridau-$sodonghien;
	if($tranghientai>1){
	echo '<li><a class="bam" vitri="0">&laquo;</a></li>';
	
	echo '<li><a class="bam" vitri="'.$vitritam.'">&#8249;</a></li>';
	}
$begin=$tranghientai-2;
$end=$tranghientai+2;
if($begin<1){$begin=1;}
if($end > $tongsotrang){$end=$tongsotrang;}

//echo $end;
for($i=$begin;$i<=$end;$i++){
	$vitritam=($i-1)*$sodonghien;
	if($tranghientai==$i){
	echo '<li><a class="bam" vitri="noactive" id="active_z">'.$i.'</a></li>';
	}else{
	echo '<li><a class="bam" vitri="'.$vitritam.'">'.$i.'</a></li>';
		
	}
	
}
if($tranghientai<$tongsotrang){
	$vitritam=$vitridau+$sodonghien;
	$vitricuoi=($tongsotrang-1)*$sodonghien;
	echo '<li><a class="bam" vitri="'.$vitritam.'">&#8250;</a></li>';
	echo '<li><a class="bam" vitri="'.$vitricuoi.'">&raquo;</a></li>';
	}

}

echo '</ul></div>';
?>