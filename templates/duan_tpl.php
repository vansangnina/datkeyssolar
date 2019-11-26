<?php if (count($backgroud_type)<=0) { ?>
	<h1 class="tieude_giua"><span><?=$title_cat?></span></h1>
<?php } ?>

<div class="box_max_sp">
	<div class="grid_duan">
		<?php foreach ($tintuc as $key => $value) { ?>
			<div class="box_nangluong">
				<div class="img">
					<a href="<?=$value['tenkhongdau'] ?>">
						<img src="thumb/385x220/1/<?=_upload_tintuc_l.$value['photo'] ?>" alt="">
					</a>
						<div class="xemthem_gp">
							<a href="<?=$value['tenkhongdau'] ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
						</div>
				</div>
				<div class="info">
					<a class="ten" href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a>
					<p><?=catchuoi($value['mota'],170);?></p>
					<a class="mota" href="<?=$value['tenkhongdau'] ?>"><?=_timhieuthem?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>
		<?php } ?>
	</div>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .box_container-->


				