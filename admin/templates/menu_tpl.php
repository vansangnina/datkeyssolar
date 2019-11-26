<div class="logo"><a href="index.php"><img src="images/logo.png" /></a></div>
<div class="sidebarSep mt0"></div>

<!-- Left navigation -->
<ul id="menu" class="nav">
<li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span>Trang chủ</span></a></li>


<li class="categories_li <?php if($_GET['com']=='product' && $_GET['type']=='sanpham') echo ' activemenu' ?>" id="menu_"><a href="" title="" class="exp"><span>SẢN PHẨM</span><strong></strong></a>
    <ul class="sub">
    	<?php phanquyen_menu('Quản lý danh mục 1','product','man_danhmuc','sanpham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 2','product','man_list','sanpham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 3','product','man_cat','sanpham'); ?>
        <?php phanquyen_menu('Quản lý sản phẩm','product','man','sanpham'); ?>
    </ul>
</li>



<li class="categories_li <?php if($_GET['com']=='dichnghia') echo ' activemenu' ?>" id="menu1"><a href="" title="" class="exp"><span>Ngôn ngữ</span><strong></strong></a>
    <ul class="sub">
        <?php phanquyen_menu('Quản lý ngôn ngữ','dichnghia','man',''); ?>
    </ul>
</li>


  
<li class="categories_li <?php if($_GET['com']=='news' or $_GET['com']=='video') echo ' activemenu' ?>" id="menu_tt"><a href="" title="" class="exp"><span>Bài viết</span><strong></strong></a>
    <ul class="sub">
         <?php phanquyen_menu('NĂNG LƯỢNG MẶT TRỜI cấp 1','news','man_danhmuc','nangluongmattroi'); ?>
        <?php phanquyen_menu('NĂNG LƯỢNG MẶT TRỜI','news','man','nangluongmattroi'); ?>
        <?php phanquyen_menu('GIẢI PHÁP CẤP 1','news','man_danhmuc','giaiphap'); ?>
        <?php phanquyen_menu('GIẢI PHÁP','news','man','giaiphap'); ?>
        <?php phanquyen_menu('DỰ ÁN CẤP 1','news','man_danhmuc','duan'); ?>
        <?php phanquyen_menu('DỰ ÁN','news','man','duan'); ?>
        <?php phanquyen_menu('TIN TỨC CẤP 1','news','man_danhmuc','tintuc'); ?>
        <?php phanquyen_menu('TIN TỨC','news','man','tintuc'); ?>
        <?php phanquyen_menu('CHĂM SÓC KHÁCH HÀNG','news','man','chamsockhachhang'); ?>
        <?php phanquyen_menu('VỀ CHÚNG TÔI','news','man','vechungtoi'); ?>
		<?php phanquyen_menu('VIDEO','video','man','video'); ?>   
        <?php phanquyen_menu('TÀI LIỆU','news','man','tailieu'); ?>
    </ul>
</li>


  
<li class="categories_li <?php if($_GET['com']=='about') echo ' activemenu' ?>" id="menu_t"><a href="" title="" class="exp"><span>Trang tĩnh</span><strong></strong></a>
    <ul class="sub">
    	
        <?php ///phanquyen_menu('Cập nhật về chúng tôi','about','capnhat','about'); ?>
        
        <?php phanquyen_menu('Cập nhật liên hệ','about','capnhat','lienhe'); ?>
        <?php phanquyen_menu('Cập nhật footer','about','capnhat','footer'); ?>
        
    </ul>
</li>
   
      
<?php?><li class="categories_li <?php if($_GET['com']=='newsletter' || $_GET['com']=='lkweb' || $_GET['com']=='yahoo') echo ' activemenu' ?>" id="menu_nt"><a href="" title="" class="exp"><span>Marketing Online</span><strong></strong></a>
      	<ul class="sub">
        	<?php phanquyen_menu('Quản lý liên kết mạng xã hội','lkweb','man','lkweb'); ?>
            <?php phanquyen_menu('Quản lý Đăng ký nhận tin','newsletter','man','nhantin'); ?>
             <?php //phanquyen_menu('Quản lý nhận tin liên hệ','newsletter','man','lienhe'); ?>            	
        </ul>
</li><?php?>  
<li class="categories_li gallery_li <?php if($_GET['com']=='anhnen' || $_GET['com']=='background' || $_GET['com']=='slider' || $_GET['com']=='letruot') echo ' activemenu' ?>" id="menu_qc"><a href="" title="" class="exp"><span>Banner - Quảng cáo</span><strong></strong></a>
     <ul class="sub">
        <?php phanquyen_menu('Cập nhật LOGO','background','capnhat','logo'); ?>
        <?php phanquyen_menu('Hình Slider chính','slider','man_photo','slider'); ?>
        <?php phanquyen_menu('Đối Tác','slider','man_photo','doitac'); ?>
		<?php phanquyen_menu('Background giới thiệu','background','capnhat','bg_gt'); ?>
        <?php phanquyen_menu('Background footer','background','capnhat','bg_ft'); ?>
        <?php phanquyen_menu('Background về chúng tôi','background','capnhat','vechungtoi'); ?>
        <?php phanquyen_menu('Background sản phẩm','background','capnhat','sanpham'); ?>
         <?php phanquyen_menu('Background dự án','background','capnhat','duan'); ?>
        <?php phanquyen_menu('Background năng lượng mặt trời','background','capnhat','nangluongmattroi'); ?>
        <?php phanquyen_menu('Background chamsockhachhang','background','capnhat','chamsockhachhang'); ?>
        <?php phanquyen_menu('Background giải pháp','background','capnhat','giaiphap'); ?>
         <?php phanquyen_menu('Background tin tức','background','capnhat','tintuc'); ?>
          <?php phanquyen_menu('Background tài liệu','background','capnhat','tailieu'); ?>
           <?php phanquyen_menu('Background liên hệ','background','capnhat','lienhe'); ?>
     </ul>
</li>
<li class="categories_li setting_li <?php if($_GET['com']=='company' || $_GET['com']=='meta' || $_GET['com']=='about' || $_GET['com']=='user') echo ' activemenu' ?>" id="menu_cp"><a href="" title="" class="exp"><span>Nội dung khác</span><strong></strong></a>
    <ul class="sub">
    	<?php phanquyen_menu('Cấu hình thông tin Website','company','capnhat',''); ?>
         <li<?php if($_GET['act']=='admin_edit') echo ' class="this"' ?>><a href="index.php?com=user&act=admin_edit">Quản lý Tài Khoản</a></li>
    </ul>
</li>
</ul>
