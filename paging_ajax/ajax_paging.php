<?php
	include ("../ajax/ajax_config.php");	
	include_once "class_paging_ajax.php";
	
	if(isset($_POST["page"]))
    {
		$paging = new paging_ajax();
		
		$paging->class_pagination = "pagination";
		$paging->class_active = "active";
		$paging->class_inactive = "inactive";
		$paging->class_go_button = "go_button";
		$paging->class_text_total = "total";
		$paging->class_txt_goto = "txt_go_button";
		$paging->per_page = 4; 	
		$paging->page = $_POST["page"];
		$paging->text_sql = "select id,ten,tenkhongdau,photo,thumb,giacu,gia,masp,mota from table_product where hienthi=1 and id_danhmuc=".$_POST["id_danhmuc"]." and noibat=1 and type='sanpham' order by stt asc";
		$product = $paging->GetResult();
		$message = '';
		$paging->data = "".$message."";
    } 
?>

<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){	?>
    <div class="item" itemscope itemtype="http://schema.org/Product">
            <p class="sp_img"><a href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>">
            <img src="<?php if($product[$i]['thumb']!=NULL) echo _upload_sanpham_l.$product[$i]['thumb']; else echo 'images/noimage.png';?>" alt="<?=$product[$i]['ten']?>" itemprop="image" /></a></p>
            <h3 class="sp_name"><a href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>" itemprop="name"><?=$product[$i]['ten']?></a></h3>
            <p class="sp_gia">
            	<span class="giacu"><?php if($product[$i]['giacu']!=0)echo number_format($product[$i]['giacu'],0, ',', '.').' <sup>đ</sup>';?> </span> 
            	<span class="giamoi <?php if($product[$i]['giacu']==0)echo 'motgia'?>"><?php if($product[$i]['giacu']==0)echo _gia.': '?> <?=number_format($product[$i]['gia'],0, ',', '.').' <sup>đ</sup>'; ?></span>
            </p>
    </div><!---END .item-->  
<?php } ?>
<?=$paging->Load(); ?>