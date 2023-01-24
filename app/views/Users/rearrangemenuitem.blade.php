<?php
/* 
 * Rearrange Menu Item 
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body">
            <div class="pop_form">
                <div class="center_txt">Rearrange Menu Item Of Menu (<?php echo $cuisions->name; ?>)</div>
                <div class="pop_field">
                    <?php
                    if(!empty($records)){
                        ?>
                    <ul id='sortable'>
                    <?php
                    
                        foreach($records as $recordAtr){
                    ?>
                        <li class='ui-state-default' data-id='<?php echo $recordAtr->id; ?>'><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $recordAtr->item_name; ?></li>
                    <?php
                        }
                        ?>
                    </ul>
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="">
                        No Menu Item Added Yet!
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="pop_btn full_btmn">
<!--                    <input type="submit" class="same_btn" id="addmn_btn" value="Create" />  -->
                    <a class="same_btn default_btn" id="addmncl" href="#" data-dismiss="modal">Done</a>    

                </div>
            </div>
        </div>
    </div>
</div>

<script>
        $( "#sortable" ).sortable({
            axis: "y",
            start: function (e, ui) {
                $(this).attr('data-previndex', ui.item.index());
            },
            update: function (event, ui) {
                var newIndex = ui.item.index();
                var oldIndex = $(this).attr('data-previndex');
                $(this).removeAttr('data-previndex');
                var id = ui.item.data('id');
                //alert($(this).html());
                $.ajax({
                   url: '<?php echo HTTP_PATH ?>user/menuitemorderchange',
                   dataType:'html',
                   type: 'post',
                   data: {id: id,order:newIndex},
                   success: function(result){
                       if(result=='Error'){
                           swal('There is an error please try again after some time.');           
                        }
                    }
                });
                
            }
        });
        $( "#sortable" ).disableSelection();
</script>