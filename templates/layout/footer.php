<?php	

$d->reset();
$sql_contact = "select noidung$lang as noidung from #_about where type='footer' limit 0,1";
$d->query($sql_contact);
$company_contact = $d->fetch_array();


$d->reset();
$sql_contact = "select noidung$lang as noidung from #_about where type='tags_footer' limit 0,1";
$d->query($sql_contact);
$tags_footer = $d->fetch_array();

$d->reset();
$sql2="select ten$lang as ten,tenkhongdau,id from #_news where type='chinhsach' and hienthi=1 order by stt asc,id desc";
$d->query($sql2);
$chinhsach_ft=$d->result_array();


$d->reset();
$sql2="select photo,link from #_lkweb where type='lkweb' and hienthi=1 order by stt asc,id desc limit 4";
$d->query($sql2);
$mxh_footer=$d->result_array();


$d->reset();
$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 and type='video' order by stt,id desc";
$d->query($sql_video);
$video = $d->result_array();



?>
<div id="main_footer" class="clearfix">
    <div class="box_container clearfix">
        <div class="left">
            <div class="title_ft">
                <span><?=_lienhechungtoi ?></span>
            </div>
            <div class="noidung_fffff">
                <?=$company_contact['noidung'] ?>
            </div>
            <div class="mxh_footer">
                <p>
                    Mạng xã hội: 
                </p>
                <ul>
                    <?php foreach ($mxh_footer as $key => $value) { ?>
                        <li><a href="<?=$value['link'] ?>">
                            <img src="<?=_upload_khac_l.$value['photo'] ?>" alt="">
                        </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="mid">
            <iframe title="<?=$video[0]['ten']?>" width="100%" height="250px" src="http://www.youtube.com/embed/<?=getYoutubeIdFromUrl($video[0]['link'])?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="right">
            <div class="fb_fff">
                <div class="fb-page" data-href="<?=$company['fanpage']?>" data-tabs="timeline" data-width="400px" data-height="200px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$company['fanpage']?>" class="fb-xfbml-parse-ignore"><a href="<?=$company['fanpage']?>"><?=$company['fanpage']?></a></blockquote></div>
            </div>
            <?php include _template."layout/dangkynhantin.php"; ?>
        </div>
    </div>
</div>

 <div id="back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </div>

<div id="copy_right">
	<div class="box_container">
    	<div class="txt">
           Copyright © 2019 by NANG LUONG MAT TROI.  All rights reserved. Desiged by NiNa Co, Ltd.
        </div>
        <div class="thongke_ft">
            <ul>
                <li>Online: <?php $count=count_online();echo $tong_xem=$count['dangxem'];?></li>
                <li><?=_homnay ?>: <?=$homnay;?></li>
                <li><?=_tuannay ?>: <?=$trongtuan;?></li>
                <li><?=_tongtruycap?>: <?php $count=count_online();echo $tong_xem=$count['daxem'];?></li>
            </ul>
            </div>

    <div class="clear"></div>
   
    </div>
</div>


<?php /*?>


<?php */?> 