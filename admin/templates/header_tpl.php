<?php

$d->reset();
     $sql = "SELECT COUNT(*) as num FROM #_donhang where tinhtrang=1";
     $d->query($sql);
     $row_giohang = $d->fetch_array();
      $tong_count = $row_giohang['num'];
 ?>



<div class="wrapper">
		<div class="menu_mobi"><i class="fa fa-bars" aria-hidden="true"></i></div>
        <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login_admin']['username']?>!</span></div>
        <div class="userNav">
            <ul>
            
            	
            
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
                
                <?php /*?> <li class="ddnew2"><a title="" class="hien_menu"><img src="images/icons/topnav/profile.png" alt="" /><span>Thành viên</span><span class="numberTop"></span></a>
                    <ul class="menu_header">                   	
                        <?php phanquyen_menu('Đăng ký','about','capnhat','dangky'); ?>
                        <?php phanquyen_menu('Đăng nhập','about','capnhat','dangnhap'); ?>
                        <?php phanquyen_menu('Quên mật khẩu','about','capnhat','quenmatkhau'); ?>
                        <?php phanquyen_menu('Thay đổi thông tin','about','capnhat','thaydoithongtin'); ?>
                        <?php phanquyen_menu('Quản lý thành viên','user','man',''); ?>
                    </ul>
                </li><?php */?>
                <!-- echo notify alert-->
                 <!-- <li class="ddnew"><a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Thông báo</span><span class="numberTop"><?=$tong_count?></span></a>
                   <ul class="userMessage">
                     <li><a href="index.php?com=order&act=man" title="" class="sInbox"><span>Đơn hàng</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_giohang['num']?></span></a></li>
                   </ul>
                                </li> -->
                <!--end -->
                

                <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
                
                <li class="none"><a href="http://<?=$config_url?>/sitemap.php" title="" target="_blank"><img src="./images/icon_sitemap.png" alt="" /><span>Cập nhật Sitemap</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
<?php echo $_SESSION['login']['role']; ?>

