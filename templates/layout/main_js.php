



<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/my_script.js"></script>
<!-- <script src="js/plugins-scroll.js" type="text/javascript" ></script> -->
<link href="fontawesome/css/font-awesome.css" type="text/css" rel="stylesheet" />

<!--Menu mobile-->
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
	$(function() {
		$m = $('nav#menu').html();
		$('nav#menu_mobi').append($m);
		$('nav#menu_mobi .search').addClass('search_mobi').removeClass('search');
		$('.hien_menu').click(function(){
			$('nav#menu_mobi').css({height: "auto"});
		});
		$('.user .fa-user-plus').toggle(function(){
			$('.user ul').slideDown(300);
		},function(){
			$('.user ul').slideUp(300);
		});
		
		$('nav#menu_mobi').mmenu({
				extensions	: [ 'effect-slide-menu', 'pageshadow' ],
				searchfield	: true,
				counters	: true,
				navbar 		: {
					title		: 'Menu'
				},
				navbars		: [
					{
						position	: 'top',
						content		: [ 'searchfield' ]
					}, {
						position	: 'top',
						content		: [
							'prev',
							'title',
							'close'
						]
					}, {
						position	: 'bottom',
						content		: [
							'<a>Online : <?php $count=count_online();echo $tong_xem=$count['dangxem'];?></a>',
							'<a><?=_tong?> : <?php $count=count_online();echo $tong_xem=$count['daxem'];?></a>'
						]
					}
				]
			});
	});
</script>
<!--Menu mobile-->


<script type="text/javascript" src="js/slick.min.js"></script>

<!--Hover menu-->
<script language="javascript" type="text/javascript">
	$(document).ready(function() { 
		//Hover vào menu xổ xuống
		$(".menu ul li").hover(function(){
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300); 
			},function(){ 
			$(this).find('ul:first').css({visibility: "hidden"});
			}); 
		$(".menu ul li").hover(function(){
				$(this).find('>a').addClass('active2'); 
			},function(){ 
				$(this).find('>a').removeClass('active2'); 
		}); 
		//Hover vào danh mục xổ xuống
		//Click vào danh mục xổ xuống
		$("#danhmuc > ul > li > a").click(function(){
			if($(this).parents('li').children('ul').find('li').length>0)
			{
				$("#danhmuc ul li ul").hide(300);
				
				if($(this).hasClass('active'))
				{
					$("#danhmuc ul li a").removeClass('active');
					$(this).parents('li').find('ul:first').hide(300); 
					$(this).removeClass('active');
				}
				else
				{
					$("#danhmuc ul li a").removeClass('active');
					$(this).parents('li').find('ul:first').show(300); 
					$(this).addClass('active');
				}
				return false;
			}
		});
	});  
</script>
<!--Hover menu-->
<!--Thêm alt cho hình ảnh-->
<script type="text/javascript">
	$(document).ready(function(e) {
        $('img').each(function(index, element) {
			if(!$(this).attr('alt') || $(this).attr('alt')=='')
			{
				$(this).attr('alt','<?=$company['ten']?>');
			}
        });
    });
</script>
<!--Thêm alt cho hình ảnh-->

<!--Tim kiem-->
<script type="text/javascript"> 
    function doEnter(evt){
		var key;
		if(evt.keyCode == 13 || evt.which == 13){
			onSearch(evt);
		}
	}
	function onSearch(evt) {			
	
			var keyword = document.getElementById("keyword").value;
			if(keyword=='' || keyword=='<?=_nhaptukhoatimkiem?>...')
			{
				alert('<?=_chuanhaptukhoa?>');
			}
			else{
				location.href = "tim-kiem.html&keyword="+keyword;
				loadPage(document.location);			
			}
		}		
</script>   
<!--Tim kiem-->


<?php if($template=='index') { ?>

<script type="text/javascript">
    $(document).ready(function(){
      $('#slick_tintuc_i').slick({
        	infinite: true,//Lặp lại
			vertical:true,//Chay dọc
			accessibility:true,
			slidesToShow: 3,
		  	slidesToScroll: 1, //Số item cuộn khi chạy
		  	autoplay:true,  //Tự động chạy
			autoplaySpeed:4000,  //Tốc độ chạy
			speed:1000,//Tốc độ chuyển slider
			arrows:false, //Hiển thị mũi tên
			centerMode:false,  //item nằm giữa
			dots:false,  //Hiển thị dấu chấm
			draggable:true,  //Kích hoạt tính năng kéo chuột
			mobileFirst:true,
			pauseOnHover:true,
			//variableWidth: true//Không fix kích thước
			
      });
    });
</script>

<script src="js/lazyload.min.js"></script>
<script>
	var lazyLoadInstance = new LazyLoad({
	    elements_selector: ".lazy"
	});
</script>

<script type="text/javascript">
	$(document).ready(function(e) {
	    $(window).scroll(function(){
	        if(!$('.load_video').hasClass('load_video2'))
	        {
	            $('.load_video').addClass('load_video2');
	            $('.load_video').load( "ajax/video.php");
	        }
	     });
	});
</script>
<!--back to top-->
      

<?php } ?>
 <script>
    $(document).ready(function(){
        $(window).scroll(function(){
            if ($(this).scrollTop()>140) {
                $('.wap_menu').addClass('navbar');
            }else{
                $('.wap_menu').removeClass('navbar');
            }
        });
    });
</script>
<script>
	$(document).ready(function(){
        $(window).scroll(function(){
            if ($(this).scrollTop()>0) {
                $('#back-to-top').fadeIn(100);
            }else{
                $('#back-to-top').fadeOut(100);
            }
        });
        $("#back-to-top").click(function () {
               $("html, body").animate({scrollTop: 0}, 1000);
        });
	});
</script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#slick_slide_index').slick({
        	infinite: true,//Lặp lại
			accessibility:true,
			slidesToShow: 1,
		  	slidesToScroll: 1, //Số item cuộn khi chạy
		  	autoplay:true,  //Tự động chạy
			autoplaySpeed:4000,  //Tốc độ chạy
			speed:1000,//Tốc độ chuyển slider
			arrows:true, //Hiển thị mũi tên
			centerMode:false,  //item nằm giữa
			dots:true,  //Hiển thị dấu chấm
			draggable:true,  //Kích hoạt tính năng kéo chuột
			mobileFirst:true,
			pauseOnHover:true,
			//variableWidth: true//Không fix kích thước
			
      });
    });
</script>
<script src="js/owl.carousel.min.js"></script>
<script>
	$(document).ready(function(){
		$('.owl_doitac').owlCarousel({
		   loop:true,
		   nav:false,
		   dots:false,
		   autoplay:true,
		   responsive:{
		        0:{
		            items:2,
		             margin:5,
		        },
		        670:{
		            items:3,
		            margin:5,
		        },
		        800:{
		            items:6,
		             margin:10,
		        },
		        1000:{
		            items:8,
		             margin:5,
		        }
		    }
		});
		$('.custom-owl-prev-1').click(function(){
			var owl = $(this).attr('data-owl');
			$('.'+owl).trigger('prev.owl.carousel');
			})
			$('.custom-owl-next-2').click(function(){
			var owl = $(this).attr('data-owl');
			$('.'+owl).trigger('next.owl.carousel');
			})
		$('.owl_nangluong').owlCarousel({
		   loop:true,
		   margin:0,
		   nav:false,
		   dots:false,
		   autoplay:false,
		   items:4,
		   responsive:{
		        0:{
		            items:1,
		            margin:0,
		        },
		        460:{
		            items:1,
		            margin:0,
		        },
		        670:{
		            items:2,
		            margin:0,
		        },
		        800:{
		           items:3,
		             margin:0,
		        },
		        1000:{
		           items:4,
		             margin:0,
		        }
		    }
		});
		$('.custom-owl-prev').click(function(){
			var owl = $(this).attr('data-owl');
			$('.'+owl).trigger('prev.owl.carousel');
			})
			$('.custom-owl-next').click(function(){
			var owl = $(this).attr('data-owl');
			$('.'+owl).trigger('next.owl.carousel');
			})
		$('.owl_giaiphap').owlCarousel({
		   loop:true,
		   nav:false,
		   dots:false,
		   autoplay:false,
		   responsive:{
		        0:{
		            items:1,
		             margin:0,
		        }
		        ,
		        460:{
		            items:1,
		            margin:0,
		        },
		        670:{
		            items:2,
		            margin:0,
		        },
		        800:{
		           items:3,
		             margin:0,
		        },
		        1000:{
		           items:4,
		             margin:0,
		        }
		    }	   
		});
	});
</script>


