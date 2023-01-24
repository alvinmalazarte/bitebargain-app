<?php
$i=0;
if ($items) {
    foreach ($items as $item) {
        if ($i % 2 == 0) {
            $class = '';
        } else {
            $class = 'pull-right default stripe_none';
        }
        ?>
        <div class="menu_block <?php echo $class; ?>">
            <div class="menu_top_title">
                <span class="pull-left"><?php echo $item->item_name ?></span>
                <span class="pull-right">$ <?php echo $item->price ?></span>
            </div>  
            <div class="menu_content"><?php echo $item->description ?></div>
            <div class="tabb menu_btn">
                <?php if(!empty($item->discount)){ ?>
                <div class="offer_tabb">
                    <span>Offer:</span>
                    <a class="tab_btn" href="#">
                        <i><img src="{{ URL::asset('public/img/front') }}/offer_icon.png"></i><?php
                        if (!empty($item->discount) && !empty($item->discount_type)) {
                            echo $item->discount;
                            if ($item->discount_type == 'discounts') {
                                echo '%';
                            } else {
                                echo '$';
                            }
                        }
                        ?> off
                    </a>
                </div> 
                <?php } ?>
                <div class="offer_tabbright">


                    <div class="offer_tabb">
                        <span>Offered on:</span>
                        <?php $offer_on = explode(",", $item->service_visibility); ?>
                        <?php if (in_array('Delivery', $offer_on)) { ?>
                            <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/deliver_icon.png"></i>Delivery</a>
                        <?php } ?>
                    </div>
                    <div class="offer_tabb">
                        <span></span>
                        <?php if (in_array('Pickup', $offer_on)) { ?>
                            <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/pickup_icon.png"></i>Pickup</a>
                        <?php } ?>
                    </div>
                    <div class="offer_tabb">
                        <span></span>
                        <?php if (in_array('reservation', $offer_on)) { ?>
                            <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/reservation_icon.png"></i>Reservations</a>
                        <?php } ?>
                    </div>
                </div>

            </div>

            <div class="simple_btn  ">
                <span id="onoffstatus<?php echo $item->id; ?>">
                    <?php
                    if ($item->status == 1) {
                        ?>
                        <a class="green_btn onoff" data-detail="offline" data-id="<?php echo $item->id; ?>" href="javascript:void(0)">online</a>
                    <?php } elseif ($item->status == 0) { ?>
                        <a class="simple_btn_menu onoff" data-detail="online" data-id="<?php echo $item->id; ?>" href="javascript:void(0)">offline</a>
                    <?php } ?>

                </span>
                <a class="simple_btn_menu menushadow edit_menuitem" data-id="<?php echo $item->id; ?>" data-slug="<?php echo $item->slug; ?>" href="javascript:void(0)" data-toggle="modal" data-target="#editmenuitem">EDIT</a>
                <a class="simple_btn_menu delete_menuitem" style="width:66px;" data-slug="<?php echo $item->slug; ?>" data-id="<?php echo $item->id; ?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
            </div>
            <div>   &nbsp;
            </div>


        </div>

        <?php
        $i++;
    }
} else {
    ?>
    <div class="no_record">
        <div>No Record Found on that menu.</div>
    </div>
    <?php
}
?>