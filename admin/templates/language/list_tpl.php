<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=dichnghia&act=man"><span>NGÔN NGỮ</span></a></li>
			<li><a href="index.php?com=dichnghia&act=man_add"><span>Thêm</span></a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<form action="index.php" method="GET">
	<input type="hidden" name="com" value="dichnghia" />
	<input type="hidden" name="act" value="man" />
	<div class="title"><span class="titleIcon">
		<div class="timkiem" style="display: block;">
			<input name="keyword" id="keyword" type="text" placeholder="Tìm kiếm ngôn ngữ..." />
			<input type="submit" value="TÌM KIẾM" class="blueB">
			<span style="line-height: 35px;margin-left: 10px;"><?php echo isset($_REQUEST['keyword'])?"Tìm kiếm ngôn ngữ với từ khóa: [<strong> ".$_REQUEST['keyword']."</strong> ]":""; ?></span>
			
		</div>
	</div>
</form>
<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<thead>
			<tr>
				<td class="sortCol">
					<div>TÊN BIẾN<span></span></div>
				</td>
				<?php foreach($config[ "lang"] as $key=> $value){?>
					<td width="200"><?=$value?></td>
				<?php } ?>
				<td width="200">Thao tác</td>
			</tr>
		</thead>
		<tbody>
			<?php if(empty($items)) echo "<tr><td colspan='6'>Không tìm thấy kết quả</td></tr>"; else { 
				for($i=0, $count=count($items); $i<$count; $i++){ ?>
					<tr>
						<td class="title_name_data">
							<a href="index.php?com=dichnghia&act=man_edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>" style="text-decoration:none;">
								<?=$items[$i][ 'tenbien']?>
							</a>
						</td>
						<?php foreach($config["lang"] as $key=> $value){?>
							<td align="center"><?=$items[$i]['ten'.$key]?></td>
						<?php } ?>
						<td class="actBtns">
							<a href="index.php?com=dichnghia&act=man_edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="./images/icons/dark/pencil.png" alt="">
							</a>
							<a class="none" href="index.php?com=dichnghia&act=man_delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="./images/icons/dark/close.png" alt="">
							</a>
						</td>
					</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>