<?php 
#gioi_thieu
$sql = "select ten$lang as ten,mota$lang as mota,title,keywords,description,photo,tenkhongdau from #_news where type='vechungtoi' and hienthi=1 order by stt asc limit 0,1";
$d->query($sql);
$about_index = $d->fetch_array();

$d->reset();
$sql_banner = "select photo from #_background where type='bg_gt' and hienthi=1 limit 0,1";
$d->query($sql_banner);
$row_gt = $d->fetch_array();
?>


<div id="gioithieu_index" style="background: url(<?=_upload_hinhanh_l.$row_gt['photo'] ?>) no-repeat;background-size: cover;">
    <div class="box_container clearfix">
        <div class="col_right_gt">
            <div class="title_gt">
                <p><?=_congtychungtoi?></p>
            </div>
            <div class="noidung_gtttt">
                <?=catchuoi(strip_tags($about_index['mota']),500) ?>
            </div>
            <div class="xemthem_gt">
                <a href="<?=$about_index['tenkhongdau'] ?>"><?=_xemthem?></a>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>