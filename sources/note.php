######CSS3 hinh luc giac
-webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);

######  Video repon
.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
    margin-bottom: 1em;
}

.video-container iframe, .video-container object, .video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

####Fanpage repon
.fb_iframe_widget,
.fb_iframe_widget span,
.fb_iframe_widget span iframe[style] {
  min-width: 100% !important;
}
.fb-comments, .fb-comments iframe[style], .fb-like-box, .fb-like-box iframe[style] {width: 100% !important;}
.fb-comments span, .fb-comments iframe span[style], .fb-like-box span, .fb-like-box iframe span[style] {width: 100% !important;}

####Comment facebook
<meta property="fb:app_id" content="158182544523521" />

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=158182544523521";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

#####Shard face,twitter tự viết
<script type="text/javascript">
Share = {
facebook: function(purl, ptitle, pimg, text) {
	url = 'http://www.facebook.com/sharer.php?s=100';
	url += '&p[title]=' + encodeURIComponent(ptitle);
	url += '&p[summary]=' + encodeURIComponent(text);
	url += '&p[url]=' + encodeURIComponent(purl);
	url += '&p[images][0]=' + encodeURIComponent(pimg);
	hare.popup(url);
},
								
twitter: function(purl, ptitle) {
	url = 'http://twitter.com/share?';
	url += 'text=' + encodeURIComponent(ptitle);
	url += '&url=' + encodeURIComponent(purl);
	url += '&counturl=' + encodeURIComponent(purl);
	Share.popup(url);
},
popup: function(url) {
	window.open(url,'','toolbar=0,status=0,width=626, height=436');
}
};
</script>
<a onclick="Share.facebook('<?=$url_link?>','<?=$row_detail['ten']?>','<?=_upload_sanpham_l.$row_detail['thumb']?>','<?=$row_detail['mota']?>')"> {sharing is sexy}</a>
<a onclick="Share.twitter('<?=$url_link?>','<?=$row_detail['ten']?>')"> {sharing is sexy}</a>


//Like shaer nhiều sản phẩm cùng 1 trang http://demo69.ninavietnam.com.vn/banhmi/
<div class="fb-like" data-href="http://<?=$config_url?>/menu-banh/<?=$k['tenkhongdau']?>-<?=$k['id']?>.html" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
//Like shaer nhiều sản phẩm cùng 1 trang


//Slick kết hợp wow
 $('.slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){	
		 	$(".phuong").hide();	
	  });
	  $('.slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
		  $(".phuong").removeClass("animated");
		  $(".phuong").show();
		  wow = new WOW(
			{
			  boxClass:     'phuong',      // default
			  animateClass: 'animated', // default
			  offset:       0,          // default
			  mobile:       true,       // default
			  live:         true        // default
			}
			)
			wow.init();
	  }); 
      
//.htacess lưu cache
## EXPIRES CACHING ##
<IfModule mod_expires.c>
ExpiresActive On
ExpiresByType image/jpg "access 1 year"
ExpiresByType image/jpeg "access 1 year"
ExpiresByType image/gif "access 1 year"
ExpiresByType image/png "access 1 year"
ExpiresByType text/css "access 1 month"
ExpiresByType text/html "access 1 month"
ExpiresByType application/pdf "access 1 month"
ExpiresByType text/x-javascript "access 1 month"
ExpiresByType application/x-shockwave-flash "access 1 month"
ExpiresByType image/x-icon "access 1 year"
ExpiresDefault "access 1 month"
</IfModule>
## EXPIRES CACHING ##
<ifModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/* text/html text/xml text/css text/plain text/x-component text/x-js text/richtext text/xsd text/xsl
    AddOutputFilterByType DEFLATE image/svg+xml application/xhtml+xml application/xml image/x-icon
    AddOutputFilterByType DEFLATE application/rdf+xml application/rss+xml application/atom+xml
    AddOutputFilterByType DEFLATE text/javascript application/javascript application/x-javascript application/json
    AddOutputFilterByType DEFLATE application/x-font-ttf application/x-font-otf
    AddOutputFilterByType DEFLATE font/truetype font/opentype
    Header append Vary User-Agent env=!dont-vary
    AddOutputFilter DEFLATE js css htm html xml text
</ifModule>

# 1 year
<FilesMatch ".(ico|pdf|flv)$">
Header set Cache-Control "max-age=29030400, public"
</FilesMatch>
# 1 WEEK
<FilesMatch ".(jpg|jpeg|png|gif|swf)$">
Header set Cache-Control "max-age=604800, public"
</FilesMatch>
# 2 DAYS
<FilesMatch ".(xml|txt|css|js)$">
Header set Cache-Control "max-age=604800, proxy-revalidate"
</FilesMatch>
# 2 DAYS
<FilesMatch ".(html|htm|php)$">
Header set Cache-Control "max-age=604800, private, proxy-revalidate"
</FilesMatch>
//.htacess lưu cache