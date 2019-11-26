<?php if (count($backgroud_type)<=0) { ?>
 <h1 class="tieude_giua"><span><?=$title_cat?></span></h1>
<?php } ?>

<div class="box_max clearfix">


		
	<?php if ($com=='san-pham'&&$_GET['id']==''&&$_GET['id_danhmuc']==''&&$_GET['id_list']==''&&$_GET['id_cat']=='') { 
		$d->reset();
		$sql="select ten,mota,photo,tenkhongdau,id,tenen,motaen from #_product_danhmuc where  type='sanpham' and hienthi=1 order by stt asc,id desc";
		$d->query($sql);
		$sp_cap1_a=$d->result_array();
		//sản phẩm danh mục cấp 1
		foreach ($sp_cap1_a as $key => $value) { ?>
		<div class="box_sanpham">
			<div class="img">
				<a href="<?=$value['tenkhongdau'] ?>">
					<img src="thumb/350x504/2/<?=_upload_sanpham_l.$value['photo'] ?>" alt="">
				</a>
			</div>
			<div class="info">
				<a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'.$lang] ?></a>
				<p><?=catchuoi($value['mota'.$lang],100); ?></p>
			</div>
			<div class="xemthemmmsp">
				<a href="<?=$value['tenkhongdau'] ?>"><?=_xemthem ?></a>
			</div>
		</div>
		<?php }

	}else{
		//đây là sản phẩm danh mục cấp 2
		if ($com=='san-pham'&&$_GET['id_danhmuc']=!''&&$_GET['id_list']==''&&$_GET['id_cat']==''&&$_GET['id']=='') {

			//var_dump($_GET);
			$d->reset();
			$sql="select ten,mota,photo,tenkhongdau,id,tenen,motaen from #_product_list where  type='sanpham' and id_danhmuc=(select id from table_product_danhmuc where tenkhongdau='".$_REQUEST['com']."' ) and hienthi=1 order by stt asc,id desc";
			//var_dump($sql);
			$d->query($sql);
			$sp_cap2_a=$d->result_array();
			foreach ($sp_cap2_a as $key => $value) { ?>
				<div class="box_sanpham">
					<div class="img">
						<a href="<?=$value['tenkhongdau'] ?>">
							<img src="thumb/350x504/2/<?=_upload_sanpham_l.$value['photo'] ?>" alt="">
						</a>
					</div>
					<div class="info">
						<a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'.$lang] ?></a>
						<p><?=catchuoi($value['mota'.$lang],100); ?></p>
					</div>
					<div class="xemthemmmsp">
						<a href="<?=$value['tenkhongdau'] ?>"><?=_xemthem ?></a>
					</div>
				</div>
			<?php }
		}else{
			// sản phẩm danh mục cấp 3
			if ($com=='san-pham'&&$_GET['id_danhmuc']==''&&$_GET['id_list']!=''&&$_GET['id']==''&&$_GET['id_cat']=='') {

				//var_dump($_GET);
				$d->reset();
				$sql="select ten,mota,photo,tenkhongdau,id,tenen,motaen from #_product_cat where  type='sanpham' and id_list IN (select id from table_product_list where tenkhongdau='".$_GET['id_list']."' ) and hienthi=1 order by stt asc,id desc";
				//var_dump($sql);
				$d->query($sql);
				$sp_cap3_a=$d->result_array();
				foreach ($sp_cap3_a as $key => $value) { ?>
					<div class="box_sanpham">
						<div class="img">
							<a href="<?=$value['tenkhongdau'] ?>">
								<img src="thumb/350x504/2/<?=_upload_sanpham_l.$value['photo'] ?>" alt="">
							</a>
						</div>
						<div class="info">
							<a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'.$lang] ?></a>
							<p><?=catchuoi($value['mota'.$lang],100); ?></p>
						</div>
						<div class="xemthemmmsp">
							<a href="<?=$value['tenkhongdau'] ?>"><?=_xemthem ?></a>
						</div>
					</div>
				<?php }
				
			}else{
				$d->reset();
				$sql="select * from #_product where  type='sanpham' and id_cat IN (select id from table_product_cat where tenkhongdau='".$_GET['id_cat']."' ) and hienthi=1 order by stt asc,id desc";
				//var_dump($sql);
				$d->query($sql);
				$sp_all_a=$d->result_array();
				foreach ($sp_all_a as $key => $value) { ?>
					<div class="box_sanpham">
							<div class="img">
								<a href="<?=$value['tenkhongdau'] ?>">
									<img src="thumb/350x504/2/<?=_upload_sanpham_l.$value['photo'] ?>" alt="">
								</a>
							</div>
							<div class="info">
								<a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'.$lang] ?></a>
								<p><?=catchuoi($value['mota'.$lang],100); ?></p>
							</div>
							<div class="xemthemmmsp">
								<a href="<?=$value['tenkhongdau'] ?>"><?=_xemthem ?></a>
							</div>
					</div>
				<?php }
			}
		}
	} ?>








	<?php /* foreach ($product as $key => $value) { ?>
		<div class="box_sanpham">
			<div class="img">
				<a href="<?=$value['tenkhongdau'] ?>">
					<img src="thumb/350x504/2/<?=_upload_sanpham_l.$value['photo'] ?>" alt="">
				</a>
			</div>
			<div class="info">
				<a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a>
				<p><?=catchuoi($value['mota'],100); ?></p>
			</div>
			<div class="xemthemmmsp">
				<a href="<?=$value['tenkhongdau'] ?>"><?=_xemthem ?></a>
			</div>
		</div>
	<?php } */ ?>
</div>