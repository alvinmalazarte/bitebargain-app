<?php
//Edit menu

?>
<div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="" method="post" id="menu_edit" autocomplete="off">
                        <div class="pop_form">
                            <div class="center_txt">Edit Menu</div>

                            <div class="pop_field">
                                <label>Menu Title</label> 
                                <div class="input_filed">
                                    <input type="text" class="required" name="item_name" value="<?php echo $menudata->name; ?>"  id="menu_title" placeholder="Menu Title">
                                </div>
                            </div>
                            
                            <input type="hidden" class="required" value="1" name="service" id="editservice" />
                            <div class="pop_field">
                                <label>Visibility</label> 
                                <ul class="vis_mn" style="display: initial;">
                                    <li class="input_filed thirhalf <?php if($menudata->visibility==1){ echo 'active'; } ?>">
                                        <a href="javascript:void(0)" class="">On</a>
                                    </li>
                                    <li class="input_filed thirhalf <?php if($menudata->visibility==0){ echo 'active'; } ?>">
                                        <a href="javascript:void(0)" class="">Off</a>
                                    </li>
                                </ul>
                                <input type="hidden" class="required" value="<?php echo $menudata->visibility; ?>" name="visibility" id="editvisibility" />
                            </div>

                            <div class="pop_field three_box">
                                <label>Service Visibility</label> 
                                <?php $visibility = explode(',',$menudata->service_visibility); ?>
                                <span class="mar_l">
                                <div class="input_filed thirhalf <?php if(in_array('Delivery',$visibility)){ echo 'active'; } ?>"><a href="javascript:void(0);" class="services_on">Delivery</a></div>
                                <div class="input_filed thirhalf margin_left <?php if(in_array('Reservation',$visibility)){ echo 'active'; } ?>"><a href="javascript:void(0);" class="services_on">Reservation</a></div>
                                <div class="input_filed thirhalf margin_left <?php if(in_array('Pickup',$visibility)){ echo 'active'; } ?>"><a href="javascript:void(0);" class="services_on">Pickup</a></div>
                                </span>
                                <input type="hidden" class="services_visible required" value="<?php echo $menudata->service_visibility; ?>" name="service_visibility" id="editservices_visibile" />
                            </div>
                            
<!--                            <div class="pop_field">
                                <label>Offer Type</label> 
                                <div class="input_filed selcetdrop drop_down1">
                                    <span>
                                        <select name="discount_type" class="required" >
                                            <option value="discounts" <?php //if($menudata->discount_type=='discounts'){ echo 'selected'; } ?>>%</option>
                                        </select>
                                    </span>
                                </div>
                            </div>-->
                            <input type="hidden" name="discount_type" value="discounts" />
                            
                            <div class="pop_field">
                                <label>Offer</label> 
                                <div class="two_wrap" style="width:72%">
                                <div class="input_filed">
                                    <input type="text" class="number required" value="<?php echo $menudata->discount; ?>" name="discount" id="offer" placeholder="Offer">
                                    <span class="sett" style="float: right;">%</span>
                                </div>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $menudata->id; ?>" name="id" />

                            <div class="pop_btn full_btmn">
                                <input type="submit" class="same_btn" id="editmn_btn" value="Update" />  
                                <a class="same_btn default_btn" id="editmncll" href="#" data-dismiss="modal">Cancel</a>    
                                <a class="simple_btn_menu default_btn delete_menu" data-slug="<?php echo $menudata->slug; ?>" data-id="<?php echo $menudata->id; ?>" href="javascript:void(0);"><i class="fa fa-trash" style="width:33px"></i></a>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

            </div>

<script>
    $("#menu_edit").validate({
     submitHandler: function(form) {
        event.preventDefault(); //prevent default action 
        var form_data = $('#menu_edit').serialize();
        var post_url = '<?php echo HTTP_PATH . 'user/subeditmenu'; ?>';
        if (this.valid()) {
         $.ajax({
            url: post_url,
            type: 'POST',
            data: form_data
        }).done(function (response) { // c
            if (response == 'Success') {
                document.getElementById("menu_edit").reset();
                $("#editmncll").trigger("click");
                location.reload();
            }
            else
            {
                alert('Please check the form properly filled!');
            }
        });
        }
    }
 });
 
 $("#menu_edit").on('click','.delete_menu',function(){
 
    swal({
            title: "Delete",
            text: "Are you sure to delete this Menu Category?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
        var upid = $(this).data('id');
        var upslug = $(this).data('slug');
        var data = {
                menu_id: upid,
                menu_slug: upslug
            }
        $.ajax({
                url: "<?php echo HTTP_PATH; ?>user/deletemenu", 
                dataType: 'html',
                type: 'POST',
                data: data,
                success: function(result){
                    var res = result.trim();
                    if(res=='success'){
                        location.reload();
                    }
                    
                }
            });
            } else {
              return false;
            }
            });
    });
    </script>