<script type="text/javascript">
    function loadData(page,id_tab,id_danhmuc){
        $.ajax({
            type: "POST",
            url: "paging_ajax/ajax_paging.php",
            data: {page:page,id_danhmuc:id_danhmuc},
            success: function(msg)
            {
                    $("#loadbody").fadeOut("fast");
                    $(id_tab).html(msg);
                      $(id_tab+" .pagination li.active").click(function(){
                        var pager = $(this).attr("p");
                        var id_danhmucr = $(this).parents().parents().parents().attr("data-rel");
                        
                        loadData(pager,".load_page_"+id_danhmucr,id_danhmucr);
                    });  
            }
        });
    }
</script>

<?php for ($i=0; $i < count($product_danhmuc); $i++) { ?>
<div class="tieude_giua"><div><?=$product_danhmuc[$i]['ten']?></div></div>
<div class="wap_item">
    <div class="load_page_<?=$product_danhmuc[$i]['id']?>" data-rel="<?=$product_danhmuc[$i]['id']?>">
        <script type="text/javascript">        	
            $(document).ready(function() {
                loadData(1,".load_page_<?=$product_danhmuc[$i]['id']?>","<?=$product_danhmuc[$i]['id']?>"); 
            });
        </script>
    </div>
</div>
<?php } ?>

