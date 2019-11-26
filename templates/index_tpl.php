<input type="hidden" value="1" class="soluong" />


<h1 class="vcard fn" style="position:absolute; top:-1000px;"><?php if($title!='')echo $title;else echo $company['title'];?></h1>
<h2 style="position:absolute; top:-1000px;"><?php if($title!='')echo $title;else echo $company['title'];?></h2>
<h3 style="position:absolute; top:-1000px;"><?php if($title!='')echo $title;else echo $company['title'];?></h3>

<div id="giaiphap_index" class="clearfix">
	<button class="custom-owl-prev" data-owl="owl_giaiphap"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
	<button class="custom-owl-next" data-owl="owl_giaiphap"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		<div class="owl_giaiphap owl-carousel owl-theme">
			<?php foreach ($giaiphap1 as $key => $value1) { ?>
				<div class="box_giaiphap">
					<div class="img">
						<a href="<?=$value1['tenkhongdau'] ?>"><img src="thumb/400x250/1/<?=_upload_tintuc_l.$value1['photo'] ?>" alt=""></a>
						<div class="info">
							<a href="<?=$value1['tenkhongdau'] ?>"><?=$value1['ten'] ?></a>
							<p><?=catchuoi($value1['mota'],120);?></p>
						</div>
						<div class="xemthem_gp">
							<a href="<?=$value1['tenkhongdau'] ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
						</div>
					</div>

				</div>
			<?php } ?>
		</div>
</div>
<?php if($template=='index') { include _template."layout/gioithieu_index.php"; } ?>
<div id="nangluong_index" class="clearfix">
		<button class="custom-owl-prev-1" data-owl="owl_nangluong"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
		<button class="custom-owl-next-2" data-owl="owl_nangluong"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		 <div class="owl_nangluong owl-carousel owl-theme">
			<?php foreach ($nangluongmattroi as $key => $value) { ?>
				<div class="box_nangluong">
					<div class="img">
						<a href="<?=$value['tenkhongdau'] ?>">
							<img src="thumb/385x220/1/<?=_upload_tintuc_l.$value['photo'] ?>" alt="">
						</a>
					</div>
					<div class="info">
						<a class="ten" href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a>
						<p><?=catchuoi($value['mota'],120);?></p>
						<a class="mota" href="<?=$value['tenkhongdau'] ?>"><?=_timhieuthem?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
					</div>
				</div>

			<?php } ?>
		</div>
</div>
