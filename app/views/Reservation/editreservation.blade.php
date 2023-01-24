<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body"> 
            <form action="" method="post" id='editreserve'>
                <div class="reservatyion_pop">
                    <div class="fieldd top_headd">
                        <label></label>    
                        <div class="top_head">Recieved Time : <?php echo date('d/m/Y h:i A', strtotime($order->created)); ?></div>
                    </div>
                    <div class="fieldd">
                        <label>Personal Info</label>
                        <div class="file_wrap">
                            <div class="input_filed half half_input" style="width:45%">
                                <input type="text" name="first_name" class="required" value="<?php echo $order->first_name; ?>" id="first_name" placeholder="First name">
                            </div>
                            <div class="input_filed half half_input" style="width:45%">
                                <input type="text" name="last_name" class="required" value="<?php echo $order->last_name; ?>" id="last_name" placeholder="Last Name">
                            </div>
                        </div>
                        <label>&nbsp;</label>
                        <div class="file_wrap">
                            <div class="input_filed " style="width: 96%;">
                                <input type="text" class="required" name="contact" id="contact" value='<?php echo $order->contact; ?>' placeholder="Contact">
                            </div>
                            <div class="input_filed " style="width: 96%;">
                                <input type="text" class="required" name="address" id="address" value='<?php echo $order->address; ?>' placeholder="Address">
                            </div>
                            <div class="input_filed " style="width: 96%;">
                                <input type="text" class="required" name="email_address" id="email_address" value='<?php echo $order->email_address; ?>' placeholder="Email Address">
                            </div>
                        </div>

                    </div>  
                    <div class="fieldd left_mrg">
                        <label>Party size</label>
                        <div class="input_filed">
                            <input type="text" class="required" name="size" id="size" value='<?php echo $order->size; ?>' placeholder="Number of people">
                        </div>
                    </div>
                    <div class="fieldd left_mrg">
                        <label>Extra Note</label>
                        <div class="input_filed">
                            <input type="text" class="required" name="note" id="note" value='<?php echo $order->note ? $order->note : '&nbsp;'; ?>' placeholder="Extra Note">
                        </div>
                    </div>

<!--                    <div class="fieldd" id="remact">
                        <label>Reservation Status</label>
                        <div class="input_filed thirhalf offer_on">
                            <a href="javascript:void(0)" class="offerd_on"><?php echo $order->reservation_status; ?></a>
                        </div>-->

                        <input type="hidden" class="status" name="reservation_status" id="statusup" value="<?php echo $order->reservation_status; ?>">
                    <!--</div>--> 

                    <input type="hidden" name="order_id" value="<?php echo $order->id; ?>" />
                    <div class="bottm_btn">
                        <label></label>    
                        <div class="btnm_btnn">
                            <input type="submit" class="same_btn same_space" value="Update" />
                            <a class="same_btn defaut_btn" href="#" data-dismiss="modal">cancel</a>
                            <a class="print" href="#"><img src="{{ URL::asset('public/img/front') }}/blueprint.png"></a>
                            <div class="simple_txt"> #<?php echo $order->reservation_number; ?></div>
                        </div>

                    </div> 
                </div> 
            </form>
        </div>

    </div>

</div>
<script>
    $('.offerd_on').on('click', function () {
        $('#remact .offer_on').removeClass('active');
        $(this).parent().addClass('active');
        var service_vis = $(this).text();
        $('#statusup').val(service_vis);
    });
</script>
<script>
    $("#editreserve").validate({
        submitHandler: function (form) { //prevent default action 
            var form_data = $('#editreserve').serialize();
            var post_url = '<?php echo HTTP_PATH . 'order/subeditreserve'; ?>';
            if (this.valid()) {
                $.ajax({
                    url: post_url,
                    type: 'POST',
                    data: form_data
                }).done(function (response) { // c
                    if (response == 'success') {
                        $('.modal-backdrop').remove();
                        var data = {
                            current_dat: $('#slected_date').val(),
                        }
                        $.ajax(
                                {
                                    url: "<?php echo HTTP_PATH; ?>/nextreservation",
                                    dataType: 'html',
                                    type: 'POST',
                                    data: data,
                                    success: function (result) {
                                        $("#icancel").trigger("click");
                                        $('.modal-backdrop').remove();
                                        $("body").removeAttr("style");
                                        $("body").removeClass("modal-open");
                                        $('#menubx').html(result);
                                        $.ajax(
                                                {
                                                    url: "<?php echo HTTP_PATH; ?>/schedulereservation",
                                                    dataType: 'html',
                                                    type: 'POST',
                                                    data: data,
                                                    success: function (result) {
                                                        $('#sched').html(result);
                                                    }
                                                });
                                    }
                                });
                    }
                });
            }
        }
    });
</script>