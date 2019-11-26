
<?php if (count($backgroud_type)<=0) { ?>
	<h1 class="tieude_giua"><span><?=$title_cat?></span></h1>
<?php } ?>

<div class="box_max_sp">
	<?php if ($com=='tin-tuc'&&$_GET['id_danhmuc']=='') {
		$d->reset();
		$sql="select * from #_news_danhmuc where  type='tintuc' and hienthi=1 order by stt asc,id desc";
		$d->query($sql);
		$tintuc=$d->result_array(); ?>
	<?php }else{
		$d->reset();
		$sql="select * from #_news where  type='tintuc' and id_danhmuc=(select id from #_news_danhmuc where tenkhongdau='".$_GET['id_danhmuc'] ."' ) and hienthi=1 order by stt asc,id desc";
		$d->query($sql);

		$tintuc=$d->result_array();
	} ?>
	<?php foreach ($tintuc as $key => $value) { ?>
	<div class="box_tintuccc">
				<div class="right_t" style="<?php if ($key%2!=0) {
					echo "float: left;";
				} ?>">
					<a href="<?=$tintuc[$key]['tenkhongdau'] ?>"><?=$tintuc[$key]['ten'.$lang] ?></a>
					<p><?=catchuoi($tintuc[$key]['mota'.$lang],270);?></p>
				</div>
				<div class="left_t">
					<img src="<?=_upload_tintuc_l.$tintuc[$key]['photo'] ?>" alt="">
				</div>
				
		</div>
	<?php } ?>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .box_container-->