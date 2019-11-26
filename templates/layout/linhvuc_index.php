
<?php 

$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,photo,thumb,mota$lang as mota from #_news where  type='linhvuc' and hienthi=1 order by stt asc,id desc";
$d->query($sql);
$linhvuc_i=$d->result_array();

?>

<div id="linhvuc_hoatdong">

<div class="box_container">
<div class="tieude_index2"><span><?=_linhvuchoatdong?></span> </div>

<div id="slick_linhvuc">
<?php foreach($linhvuc_i as $k => $value) { ?>
<div>
<div class="box-linhvuc">
    <h3 class="ten"><a href="linh-vuc/<?=$value['tenkhongdau']?>.html"><?=$value['ten']?></a></h3>
</div>
</div>
<?php } ?>
</div>

</div>

</div>