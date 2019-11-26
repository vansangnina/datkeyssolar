<?php

	$d->reset();
	$sql_banner = "select photo from #_background where type='logo' limit 0,1";
	$d->query($sql_banner);
	$row_logo = $d->fetch_array();
    $d->reset();
    $sql_banner = "select photo from #_background where type='bg_ft' and hienthi=1 limit 0,1";
    $d->query($sql_banner);
    $row_ft = $d->fetch_array();
	
	
?>
<div class="top_h">
    <div class="box_container clearfix">
        <div class="left">
            <p><?=$company['diachi'.$lang] ?></p>
            <p><?=$company['email'] ?></p>
            <p><?=$company['dienthoai'] ?></p>
        </div>
        <div class="right">
            <ul>
                <li><a href="tai-lieu"><?=_tailieu ?></a></li>
                <li><a href="lien-he"><?=_lienhe?></a></li>
            </ul>
            <div id="lang"> 
               <a href="index.php?com=ngonngu&lang=en" title="English"><img src="images/en.png" alt="English" /></a>
                <a href="index.php?com=ngonngu&lang=" title="Vietnamese"><img src="images/vi.png" alt="Vietnamese" /> </a> 
           </div>
        </div>
    </div>
</div>
