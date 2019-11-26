
<div class="box_container">

    <table class="tbl_download" width="100%" border="0" cellspacing="0" >
      <tr class="tbl_title">
        <td width="10%"><?=_stt?></td>
        <td><?=_ten_file?></td>
        <td  width="20%">Download</td>
      </tr>
      
      <?php for($i = 0; $i < count($tintuc); $i++){ ?>
      <tr>
        <td><?=$i +1?></td>
        <td>
        	<h2 class="ten_file"><?=$tintuc[$i]['ten']?></h2> 
            <p><?=$tintuc[$i]['mota']?></p>
        </td>
        <td>
            <a target="_blank" href="<?= _upload_tintuc_l.$tintuc[$i]['file_upload']?>" title="Download file" >
            <img src="images/icon_download.png" alt="<?=$tintuc[$i]['ten']?>" />
            </a>
        </td>
      </tr>
      <?php } ?>
      
    </table>
    
    <div class="clear"></div>
    <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>

</div><!---END .box_container-->


<style type="text/css">
.tbl_download {width:100%;border-left:solid 1px #CCCCCC;border-top:solid 1px #CCCCCC;text-align:center;font-family:OpenSans_R;font-size:15px;}
.tbl_download tr td {padding:5px;border-right:solid 1px #CCCCCC;border-bottom:solid 1px #CCCCCC;}
.tbl_download .tbl_title {font-family:RobotoBold;font-size:16px;}
.tbl_download .ten_file {font-size:20px;font-weight:normal;color:#00C;}

</style>