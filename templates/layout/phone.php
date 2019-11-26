<?php if($deviceType=='phone') { ?>
<link rel="stylesheet" href="css/widget.css"/>
<div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon">
    <a style="display: block;width: 100%;height: 100%;" href="tel:+<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>"><div class="coccoc-alo-ph-circle"></div>
    <div class="coccoc-alo-ph-circle-fill"></div>
    <div class="coccoc-alo-ph-img-circle"></div></a>
</div>
<?php } ?>