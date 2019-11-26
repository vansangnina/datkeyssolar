<?php 

include ("ajax_config.php");

$id_danhmuc =(int) $_GET['id_danhmuc'];

if($id_danhmuc == '' || $id_danhmuc == 0)
{
	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia,giacu FROM #_product where noibat>0 and type='sanpham' and hienthi=1 order by stt asc,id desc limit 0,12";		
	$d->query($sql);
	$product = $d->result_array();	
}
else
{
	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia,giacu FROM #_product where id_danhmuc=".$id_danhmuc." and type='sanpham' and hienthi=1 order by stt asc,id desc limit 0,12";		
	$d->query($sql);
	$product = $d->result_array();	
}


?>


<?php foreach($product as $k => $value){	?>
    <div class="item sp_index" >
    <a href="san-pham/<?=$value['tenkhongdau']?>.html" title="<?=$value['ten']?>">
    <img class="img" src="thumb/320x240/1/<?=_upload_sanpham_l.$value['photo']?>" alt="<?=$value['ten']?>" />
    </a>
    
    <h3 class="ten"><a href="san-pham/<?=$value['tenkhongdau']?>.html" title="<?=$value['ten']?>" ><?=$value['ten']?></a></h3>
    <p class="sp_gia">Giá: <span><?php if($value['gia'] != 0)echo number_format($value['gia'],0, ',', '.').' vnđ';else echo 'Liên hệ'; ?></span></p>

    
    </div><!---END .item-->
<?php } ?>

