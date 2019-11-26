<?php
	require_once "../sources/lang.php";
	//bình luận
	$id = $_GET['product_id'];
	$type = $_GET['type'];
	$d->reset();
	$sql = "select id,ten$lang,mota$lang as mota,parent_id,ngaytao,hienthi FROM #_comment where type='".$type."' and product_id='".$id."' order by ngaytao";
	$d->query($sql);
	$binhluan = $d->result_array();
	
	function show_comment($arr_dacap, $parent_id = 0, $kytu = '')
	{
		echo '<div class="box_commnet">';
		foreach ($arr_dacap as $key => $value)
		{
			// Nếu là chuyên mục con thì hiển thị
			if($value['parent_id'] == $parent_id)
			{
				if($kytu.$value['hienthi']==1)$an_hienthi = 'diamondToggleOff'; else $an_hienthi = '';
				echo '<div class="item_comment">
					<p class="td_comment"><span>'.substr($kytu.$value['ten'],0,1).'</span>'.$kytu.$value['ten'].'<b class="an_hienthi">Thao tác <a data-val2="table_comment" rel="'.$kytu.$value['hienthi'].'" data-val3="hienthi" data-val0="'.$kytu.$value['id'].'" class="diamondToggle '.$an_hienthi.'" title="Duyệt bình luận"></a><a href="index.php?com=comment&act=delete&product_id='.$_GET['product_id'].'&type='.$_GET['type'].'&id='.$kytu.$value['id'].'" title="Xóa bình luận này"><img src="./images/icons/dark/close.png" alt=""></a></b>
					</p>
					<div class="tl_comment">'.$kytu.$value['mota'].'</div>
					<div class="ngaytao_comment"><span class="traloi" data-id="'.$kytu.$value['id'].'">'._traloi.'</span><span>'.humanTiming($kytu.$value['ngaytao']).'</span><span class="bl_con"><span class="rutgon"></span><span class="so_bl_con"></span></span></div>
				</div>';
				// Xóa chuyên mục đã lặp
				unset($arr_dacap[$key]); 
				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				show_comment($arr_dacap, $value['id'], '');
			}
		}
		echo '<div class="clear"></div></div>';
	}
?>
<link href="css/comment.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/my_script.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		//Click vào nút xem bình luận con
		$('.item_comment').each(function(index, element) {
            var bl_con = $(this).next('.box_commnet').find('>.item_comment').length;
			if(bl_con>0)
			{
				$(this).find('.bl_con').find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).find('.bl_con').find('.so_bl_con').html('('+bl_con+')');
			}
        });
		
		//Click vào nút xem bình luận con
        $('.item_comment .bl_con').click(function(){
			if($(this).hasClass('active_bl_con'))
			{
				$(this).removeClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_xemthem?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment:first').next('.box_commnet').find('>.item_comment').hide(300);

			}
			else
			{
				$(this).addClass('active_bl_con');
				$(this).find('.rutgon').html('<?=_thugon?><i class="fa fa-caret-right" aria-hidden="true"></i>');
				$(this).parents('.item_comment:first').next('.box_commnet').find('>.item_comment').show(300);
			}
		});
		
		//Click vào trả lời
        $('.item_comment .traloi').click(function(){
			$('.comment_old .comment').remove();
			var comment = $('.comment').html();
			var root = $(this).parents('.item_comment');
			root.append('<div class="comment comment_add">'+comment+'</div>');
			return false;
		});
		//Click vào nút gửi
		$(document).on('click','#gui_commnet',function() {
			var root = $(this).parents('.item_comment');
			
			if(isEmpty(root.find('#noidung_comment').val(), "<?=_nhapnoidung?>"))
			{
				root.find('#noidung_comment').focus();
				return false;
			}
			if(root.find('#noidung_comment').val().length<30 || root.find('#noidung_comment').val().length>1000)
			{
				alert("<?=_tu30den1000?>");
				root.find('#noidung_comment').focus();
				return false;
			}
			if(!root.find('.thongtin_commnet').hasClass('daclick'))
			{
				root.find('.thongtin_commnet').slideDown(300);
				root.find('.thongtin_commnet').addClass('daclick');
			}
			else
			{
				alert("<?=_vuilongnhanguihoanthanh?>");
			}
			
			return false;
		});
		//Click vào nút Close comment
		$(document).on('click','.close_comment',function() {
			var root = $(this).parents('.item_comment');
			root.find('.thongtin_commnet').slideUp(300);
			root.find('.thongtin_commnet').removeClass('daclick');
		});
		//Click vào nút gửi và hoàn tất
		$(document).on('click','#hoantat_commnet',function() {
			var root = $(this).parents('.item_comment');
			
			if(isEmpty(root.find('#ten_commnet').val(), "<?=_nhaphoten?>"))
			{
				root.find('#ten_commnet').focus();
				return false;
			}
			if(isEmpty(root.find('#email_commnet').val(), "<?=_emailkhonghople?>"))
			{
				root.find('#email_commnet').focus();
				return false;
			}
			if(isEmail(root.find('#email_commnet').val(), "<?=_emailkhonghople?>"))
			{
				root.find('#email_commnet').focus();
				return false;
			}
			
			var product_id = "<?=$id?>";
			var parent_id = parseInt(root.find('.traloi').data('id'));
			var ten = root.find('#ten_commnet').val();
			var email = root.find('#email_commnet').val();
			var mota = root.find('#noidung_comment').val();
			var type = "<?=$type?>";
			add_comment(ten,email,mota,parent_id,type,product_id);
			return false;
		});
    });
	
	//Hàm thêm comment vào database
	function add_comment(ten,email,mota,parent_id,type,product_id){
			$.ajax({
				type:'post',
				url:'ajax/comment.php',
				data:{ten:ten,email:email,mota:mota,parent_id:parent_id,type:type,product_id:product_id},
				dataType:'json',
				error: function(){
					alert('<?=_hethongloi?>');
				},
				success:function(kq){
					alert(kq.thongbao);
					$('.comment_add').remove();
					location.reload();
				}
			});	
		}
</script>
<div style="background:#fff; padding:5px 10px; margin-top:30px;">
<div class="comment item_comment">
        	<input type="hidden" id="parent_id" value="0" />
            <textarea name="noidung_comment" id="noidung_comment" rows="5" placeholder="<?=_nhaptiengvietcodau?>"></textarea>
            <div class="line_comment"><input type="button" value="<?=_gui?>" id="gui_commnet" /></div>
            <div class="thongtin_commnet">
            	<span class="close_comment">X Close</span>
            	<p class="ghichu_commnet"><?=_delaithongtin?></p>
                <input type="text" placeholder="<?=_nhaphoten?>" id="ten_commnet" />
                <input type="text" placeholder="<?=_nhapemail?>" id="email_commnet" />
                <input type="button" value="<?=_guivahoantat?>" id="hoantat_commnet" />
            </div>
        <div class="clear"></div>
</div>

<div class="comment_old">
	<?php show_comment($binhluan,0,''); ?>
</div>
</div>