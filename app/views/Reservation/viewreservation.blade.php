<div class="modal-dialog">
    <?php
    ?>
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body"> 
            <div class="reservatyion_pop">
                <div class="fieldd top_headd">
                    <label></label>    
                    <div class="top_head">Recieved Time : <?php echo date('d/m/Y h:i A', strtotime($order->created)); ?></div>
                </div>
                <div class="fieldd">
                    <label>Personal Info</label>
                    <div class="file_wrap">
                        <div class="non_edit"><?php echo $order->first_name; ?> <?php echo substr($order->last_name, 0, 1); ?>.</div>    
                        <div class="non_edit right_side"><?php echo $order->contact; ?></div> 
                        <div class="non_edit edit_full "><?php
                            if (!empty($order->user_address)) {
                                echo $order->user_address;
                            } else {
                                echo '&nbsp;';
                            }
                            ?></div>    
                        <div class="non_edit edit_full "><?php echo $order->email_address; ?></div>    
                    </div>
                </div>  
                <div class="fieldd">
                    <label>Offer</label>
                    <div class="file_wrap">
                        <?php
                        $cuisine_array = array(
                            '' => 'Please Select',
                            'all_menu' => 'On all menu',
                            'all_menu_above' => 'On all menu on orders above ',
                            'all_item' => 'On selected items',
                            'all_item_above' => 'On selected items on orders above '
                        );
                        $offers = DB::table('offers')->where('offers.id', $order->offer_id)->first();
                        $text1 = '0';
                        if ($offers && $order->offer_id) {
                            $text = '';
                            $prefix = '';
                            $postfix = '';
                            $text .= $cuisine_array[$offers->offer_name];
                            if ($offers->type == 'percentage') {

                                $postfix = '%';
                            } else {
                                $prefix = CURR;
                            }
                            if ($offers->offer_name == 'all_menu_above' || $offers->offer_name == 'all_item_above') {
                                $text .= CURR . $offers->above_price;
                            }
                            $text1 = $offers->discount;
                        }
                        ?>
                        <div class="non_edit bg_field"><?php echo $text1; ?></div>    
                        <div class="non_edit right_side bg_field">%</div> 

                    </div>
                </div>  
                <div class="fieldd">
                    <label>Promise By</label>
                    <div class="file_wrap">
                        <?php
                        $gettime = date('h:i', strtotime($order->reservation_date . " +30 minutes"));
                        $grAM = date('A', strtotime($order->reservation_date . " +30 minutes"));
                        ?>
                        <div class="non_edit bg_field"><?php echo $gettime; ?></div>    
                        <div class="non_edit right_side bg_field"><?php echo $grAM; ?></div> 

                    </div>
                </div> 
                <div class="fieldd">
                    <label>Party size</label>
                    <div class="file_wrap">
                        <div class="non_edit edit_full " style="margin-top: 0px;"><?php echo $order->size; ?></div>    </div>
                </div>
                <div class="fieldd">
                    <label>Extra Note</label>
                    <div class="file_wrap">
                        <div class="non_edit edit_full " style="margin-top: 0px;"><?php echo $order->note; ?></div>    </div>
                </div>
         
                <div class="fieldd">
                    <label>Reservation Status</label>
                    <div class="file_wrap">
                        <div class="non_edit bg_field btn_pop reservation-new-bx" id="new_<?php echo $order->id; ?>">
                            <?php if ($order->reservation_status == 'Pending') { ?>
                                <a class="changestatus" data-resstatus="Confirm" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Confirm</a>
                                <a class="changestatus" data-resstatus="Cancel" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>
                            <?php } else if ($order->reservation_status == 'Confirm') { ?>
                                <a class="changestatus" data-resstatus="Complete" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Complete</a>
                                <a class="changestatus" data-resstatus="No Show" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">No Show</a>
                                <a class="changestatus" data-resstatus="Cancel" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>
                                <?php
                            } else if ($order->reservation_status == 'Complete') {
                                ?>
                                <a class="changestatus" data-resstatus="No Show" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">No Show</a>
                                <a class="changestatus" data-resstatus="Cancel" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>

                            <?php } else if ($order->reservation_status == 'Cancel') {
                                ?>
                                <a class="changestatus" data-resstatus="Confirm" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Confirm</a>
                                <a class="changestatus" data-resstatus="Complete" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Complete</a>
                                <a class="changestatus" data-resstatus="No Show" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">No Show</a>
                            <?php } else if ($order->reservation_status == 'No Show') { ?>
                                <a class="changestatus" data-resstatus="Complete" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Complete</a>
                                <a class="changestatus" data-resstatus="Cancel" data-currentdate ="<?php echo date('Y-m-d',strtotime($order->reservation_date)); ?>" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>
                            <?php } ?>
                        </div>
                    </div>
                </div> 

                <div class="bottm_btn">
                    <label></label>    
                    <div class="btnm_btnn">
                        <a class="edit_res" href="#" data-order="<?php echo $order->id; ?>" data-id = "<?php echo $order->id; ?>"><img src="{{ URL::asset('public/img/front') }}/pencil_white.png"></a>
                        <a class="same_btn defaut_btn" href="#" data-dismiss="modal">cancel</a>
                        <a class="print" target="_blank" href="<?php echo HTTP_PATH . 'reservation/printreservation/' . $order->reservation_number; ?>"><img src="{{ URL::asset('public/img/front') }}/blueprint.png"></a>
                        <div class="simple_txt"> #<?php echo $order->reservation_number; ?></div>
                    </div>

                </div> 
            </div> 

        </div>

    </div>
</div>