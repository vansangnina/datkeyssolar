<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
		</div>
	</div>
	<form name="supplier" id="validate" class="form" action="index.php?com=dichnghia&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<div class="formRow">
				<label>Tên biến</label>
				<div class="formRight">
					<?php if($_REQUEST["act"]=="man_edit") { ?>
						<span style="color:red;font-size:16px;"><?=$item["tenbien"]?></span>
					<?php } else { ?>
						<input type="text" name="tenbien" title="Nhập tên biến" id="tenbien" class="tipS validate[required]" value=""/>
					<?php } ?>
				</div>
			</div>
			<?php foreach ($config['lang'] as $key => $value) { ?>
				<div class="formRow">
					<label><?=$value?></label>
					<div class="formRight">
						<input type="text" name="ten<?=$key?>" title="Nhập tên <?=$value?>" id="ten<?=$key?>" class="tipS validate[required]" value="<?=@$item['ten'.$key]?>"/>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="widget">
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
					<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.php?com=dichnghia&act=man" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
			</div>
		</div>
	</form>
</div>