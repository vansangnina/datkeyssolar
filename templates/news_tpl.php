
<?php if (count($backgroud_type)<=0) { ?>
	<h1 class="tieude_giua"><span><?=$title_cat?></span></h1>
<?php } ?>

<div class="box_max_sp">


	<?php for ($i=0; $i <count($tintuc) ; $i++) {  ?>
		<div class="box_tintuccc">
			<div class="right_t" style="<?php if ($i%2!=0) {
				echo "float: left;";
			} ?>">
				<a href="<?=$tintuc[$i]['tenkhongdau'] ?>"><?=$tintuc[$i]['ten'] ?></a>
				<p><?=catchuoi($tintuc[$i]['mota'],270);?></p>
			</div>
			<div class="left_t">
				<img src="<?=_upload_tintuc_l.$tintuc[$i]['photo'] ?>" alt="">
			</div>
		</div>
	<?php } ?>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .box_container-->