<?php 
	include ("ajax_config.php");
	
	$d->reset();
	$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 and type='video' order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();
	
?>


<script type="text/javascript">
	$(document).ready(function(e) {
        $('.select_video .img_vd').click(function(){
			var src = 'http://www.youtube.com/embed/'+$(this).attr('data-id');
			$('.left_video iframe').attr('src',src);
		});
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#slick_video').slick({
		  	lazyLoad: 'ondemand',
        	infinite: true,//Hiển thì 2 mũi tên
			accessibility:true,
			//vertical:true,//Chay dọc
		  	slidesToShow: 3,    //Số item hiển thị
		  	slidesToScroll: 1, //Số item cuộn khi chạy
		  	autoplay:true,  //Tự động chạy
			autoplaySpeed:3000,  //Tốc độ chạy
			speed:1000,
			arrows:false, //Hiển thị mũi tên
			centerMode:false,  //item nằm giữa
			dots:false,  //Hiển thị dấu chấm
			draggable:true,  //Kích hoạt tính năng kéo chuột
			mobileFirst:true
      });
	});
</script>


<div class="video_popup left_video">
<iframe title="<?=$video[0]['ten']?>" width="100%" height="250px" src="http://www.youtube.com/embed/<?=getYoutubeIdFromUrl($video[0]['link'])?>" frameborder="0" allowfullscreen></iframe>
</div>
    
<div class="select_video" id="slick_video">
<?php for($i=0;$i<count($video);$i++){?>
<img class="img_vd" data-id="<?=getYoutubeIdFromUrl($video[$i]['link'])?>" src="http://img.youtube.com/vi/<?=getYoutubeIdFromUrl($video[$i]['link'])?>/0.jpg" alt="<?=$product[$i]['ten']?>" title="<?=$product[$i]['ten']?>" />
<?php } ?>
</div>


<style type="text/css">
.left_video {width:100%;display:block;}
.select_video {width:100%;display:block;}
.select_video img {width:100%;cursor:pointer;}


</style>
    
