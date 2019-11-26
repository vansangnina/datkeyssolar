<?php

$d->reset();
$sql="select id,ten$lang as ten,link,photo from #_slider where hienthi=1 and type='doitac' order by stt,id desc";
$d->query($sql);
$doitac=$d->result_array();


?>


<div id="doitac" class="clearfix">
<div class="title_doitac"><span><?=_doitacchienluoc?></span></div>
<div class="owl_doitac owl-carousel owl-theme">	
	<?php foreach ($doitac as $key => $value) { ?>
		<div class="box_doitac">
			<div class="img">
				<a href="<?=$value['link'] ?>">
					<img src="thumb/185x140/1/<?=_upload_hinhanh_l.$value['photo'] ?>" alt="">
				</a>
			</div>
		</div>
	<?php } ?>
</div>

</div>
