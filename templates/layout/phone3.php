<?php if($deviceType=='phone') { ?>
<div class="toolbar">
            <ul>
                <li>
                    <a id="goidien" target="_blank" href="tel:<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>" title="title">
                        <img src="images/icon-t1.png" alt="images"><br>
                        <span>Gọi điện</span>
                    </a>
                </li> 
                <li>
                    <a id="nhantin" target="_blank" href="sms:<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>" title="title">
                        <img src="images/icon-t2.png" alt="images"><br>
                        <span>Nhắn tin</span>
                    </a>
                </li>
                <li>
                    <a id="chatzalo" target="_blank" href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>" title="title">
                        <img src="images/icon-t3.png" alt="images"><br>
                        <span>Chat zalo</span>
                    </a>
                </li>
                <li>
                    <a id="chatfb" target="_blank" href="<?=$company['fanpage'] ?>" title="title">
                        <img src="images/icon-t4.png" alt="images"><br>
                        <span>Chat facebook</span>
                    </a>
                </li>
            </ul>
        </div>  
<?php } ?>
<style>
	
.toolbar {
    background: #e33737;
    display: block;
    width: 100%;
    padding: 5px;
    bottom: 0;
    position: fixed;
    z-index: 500;
    height: auto;
    border-top: 1px solid #cbcbcb;
    z-index: 999;
    left: 0px;
}	
.toolbar ul{padding: 0px;}
.toolbar ul li {
    text-align: center;
    float: left;
    width: 25%;
    list-style: none;
}
.toolbar ul li a {
    display: inline-block;
    width: 100%;
    color: #fff;
}
.toolbar ul li a img {
    height: 20px !important;
    width: auto;
}
.toolbar ul li a span {
    font-family: 'OpenSans_R';
    font-weight: 400;
    color: #fff;
    font-size: 12px;
}
</style>