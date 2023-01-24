@extends('layouts.default')
@section('content')


{{ HTML::style('public/css/front2/slick.css') }}
{{ HTML::style('public/css/front2/slick-theme.css') }}
<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="right_content">
    <div class="right_content">

        <div class="content_nav manage_menu_nav" id="sldr" style="display:none;">
            <ul class="center slider" >

                <?php
                $first = "";
                $active = '';
                $i = 0;
                if (!empty($records)) {
                    foreach ($records as $record) {
                        if ($i == 0) {
                            $first = $record->id;
                            $active = 'active';
                        }
                        ?>
                        <li data-slide="<?php echo $record->id; ?>"><a class="" href="javascript:void(0)"><?php echo $record->name; ?></a></li>

                        <?php
                        $i++;
                        $active = '';
                    }
                }
                ?>
            </ul> 
            <input type="hidden" id="slected_slide" value="<?php echo $first; ?>" >
            <ul class="manage_menu">
                <li class="hidden-xs "><a class="iconn hidden-xs" href="#" data-toggle="modal" data-target="#addmenu"><i class="fa fa-plus"></i></a></li>
                <li class="hidden-xs border_none edit_menu"><a class="iconn" href="javascript:void(0);" data-toggle="modal" data-target="#editmenu" ><i class="fa fa-pencil"></i></a></li>
                <li class="special_icon border_none rearrange_menu"><a class="iconn " href="javascript:void(0);" data-toggle="modal" data-target="#rearrangemenu"><i class="fa fa-arrows"></i></a></li>
            </ul>
        </div>    
        <div id='rearrangemenu' class="modal fade editscreen in" role="dialog"></div>
        
        <script>
            $(".rearrange_menu").on('click',function(){
                $.ajax({
                    url: "<?php echo HTTP_PATH; ?>/user/rearrangemenu", 
                    dataType: 'html',
                    cache: false,
                    success: function(result){
                        $('#rearrangemenu').html(result);                        
                    }
                });
            });
            $(".edit_menu").on('click',function(){
                var upid = $('#slected_slide').val();
                var data = {
                        menu: upid
                    }

                $.ajax({
                        url: "<?php echo HTTP_PATH; ?>/user/editmenu", 
                        dataType: 'html',
                        type: 'POST',
                        data: data,
                        success: function(result){
                            $('#editmenu').html(result);                        
                        }
                    });
            });
        </script>
        <div class="search_bar">
            <form action="" method="post" id="searchorder">
            <div class="search_field">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search" id="searchkey" name="search"> 

            </div>  
            </form>
            <div class="search_btn">
                <a class="same " href="javascript:void(0);" id="rearrange" data-toggle="modal" data-target="#rearrangemenuitem">Rearrange</a>
                <a class="same line_btn" onclick="addmenucheck();" href="#"><i class="fa fa-plus"></i>Add Menu Item</a>
            </div>
        </div>
        <!--Rearrange Menu Item Start -->
        <div id='rearrangemenuitem' class="modal fade editscreen in" role="dialog"></div>
        <!--Rearrange Menu Item End -->
        <!--Edit Menu Start -->
        <div id="editmenu" class="modal fade editscreen in" role="dialog">
            
        </div>
        <!--Edit Menu End -->
        
        <!--Add Menu Start-->
        <div id="addmenu" class="modal fade editscreen in" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="#" method="post" id="menu_add" autocomplete="off" >
                        <div class="pop_form">
                            <div class="center_txt">Add Menu</div>

                            <div class="pop_field">
                                <label>Menu Title</label> 
                                <div class="input_filed">
                                    <input type="text" class="required" name="item_name" id="menu_title" placeholder="Menu Title">
                                </div>
                            </div>
                                                        
                            <input type="hidden" class="required" value="1" name="service" id="service" />
                            
                            <div class="pop_field">
                                <label>Visibility</label> 
                                <ul class="vis_mn" style="display: initial;">
                                    <li class="input_filed thirhalf">
                                        <a href="javascript:void(0)" class="">On</a>
                                    </li>
                                    <li class="input_filed thirhalf">
                                        <a href="javascript:void(0)" class="">Off</a>
                                    </li>
                                </ul>
                                <input type="hidden" class="required" value="" name="visibility" id="visibility" />
                            </div>

                            <div class="pop_field three_box">
                                <label>Offered on</label> 
                                <?php  $offerded = explode(',',$userData->service_offered); ?>
                                <span class="mar_l">
                                <?php if(in_array('Delivery',$offerded)){ ?>
                                <div class="input_filed thirhalf "><a href="javascript:void(0);" class="services_on">Delivery</a></div>
                                <?php } ?>
                                <?php if(in_array('Table reservations',$offerded)){ ?>
                                <div class="input_filed thirhalf margin_left"><a href="javascript:void(0);" class="services_on">Reservation</a></div>
                                <?php } ?>
                                <?php if(in_array('Pickup',$offerded)){ ?>
                                <div class="input_filed thirhalf margin_left"><a href="javascript:void(0);" class="services_on">Pickup</a></div>
                                <?php } ?>
                                </span>
                                <input type="hidden" class="services_visible required" name="service_visibility" id="services_visible" />
                            </div>
                            
<!--                            <div class="pop_field">
                                <label>Offer Type</label> 
                                <div class="input_filed selcetdrop drop_down1">
                                    <span>
                                        <select name="discount_type" class="required" >
                                            <option value="discounts">%</option>
                                        </select>
                                    </span>
                                </div>
                            </div>-->
                            <input type="hidden" name="discount_type" value="discounts" />
                            <div class="pop_field">
                                <label>Offer </label> 
                                <div class="two_wrap" style="width:72%">
                                <div class="input_filed">
                                    <input type="text" class="" name="discount" id="offer" placeholder="Offer">
                                    <span class="sett" style="float: right;">%</span>
                                </div>
                                </div>
                            </div>

                            <div class="pop_btn full_btmn">
                                <input type="submit" class="same_btn" id="addmn_btn" value="Create" />  
                                <a class="same_btn default_btn" id="addmncl" href="#" data-dismiss="modal">Cancel</a>    

                            </div>
                        </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
        <!--Add Menu End-->
        <!--Add Menu Item Start-->

        <div id="addmenuitem" class="modal fade editscreen addmenu item_modifier" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="" method="post" id="menuitem_add" autocomplete="off">
                            <input type="hidden" value="<?php echo $first; ?>" name="selected_menu" id="selected_menu" />
                            <div class="pop_form">
                                <div class="left_popdiv">
                                    <div class="pop_field">
                                        <label>Item Name</label> 
                                        <div class="input_filed">
                                            <input type="text" class="required" autocomplete="off" name="item_name" id="item_name" placeholder="Item Name">
                                        </div>
                                    </div>
                                    <div class="pop_field">
                                        <label>Price ($)</label> 
                                        <div class="input_filed">
                                            <input type="text" name="price" class="number required" id="price" placeholder="$">
                                        </div>
                                    </div>
                                    <div class="pop_field big_txt">
                                        <label>Description</label> 
                                        <div class="input_filed ">
                                            <textarea placeholder="Item Description" name="description" class="required" id="description"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="pop_field">
                                        <label>offerd on</label> 
                                        <?php 
                                            $offerded = explode(',',$userData->service_offered);
                                            if(count($offerded)==1){
                                                $remmargin = 1;
                                            }
                                            else {
                                                $remmargin = 0;
                                            }
                                        ?>
                                        <?php if(in_array('Delivery',$offerded)){ ?>
                                        <div class="input_filed thirhalf offer_on">
                                            <a href="javascript:void(0)" class="offerd_on">Delivery</a>
                                        </div>
                                        <?php } ?>
                                        <?php if(in_array('Table reservations',$offerded)){ ?>
                                        <div class="input_filed thirhalf <?php if($remmargin==1 || count($offerded)==2){ } else { echo 'margin_left'; } ?> offer_on">
                                            <a href="javascript:void(0)" class="offerd_on">reservation</a>
                                        </div>
                                        <?php } ?>
                                        <?php if(in_array('Pickup',$offerded)){ ?>
                                        <div class="input_filed thirhalf <?php if($remmargin==1){  } else { echo 'margin_left'; } ?> offer_on">
                                            <a href="javascript:void(0)" class="offerd_on">Pickup</a>
                                        </div>
                                        <?php } ?>
                                        <input type="hidden" class="service_visibile" name="service_visibility" id="service_visibility" />
                                    </div>
                                    <div class="pop_field">
                                        <label>Label</label> 
                                        <div class="input_filed lb half">
                                            <a href="javascript:void(0)" class="lebel_itm" id="spicy">Spicy </a>
                                        </div>
                                        <div class="input_filed lb half margin_left">
                                            <a href="javascript:void(0)" class="lebel_itm" id="popular">Popular</a>
                                        </div>
                                        <input type="hidden" class="spicy_pop" name="spicy_pop" id="spicy_pop" />
                                    </div>
                                    <div class="pop_field">
                                        <label>Visibility</label> 
                                        <ul style="display: initial;">
                                            <li class="input_filed half">
                                                <a href="javascript:void(0)" class="">Online</a>
                                            </li>
                                            <li class="input_filed half margin_left">
                                                <a href="javascript:void(0)" class="">Offline</a>
                                            </li>
                                        </ul>
                                        <input type="hidden" class="status" name="status" id="status" />
                                    </div>
                                    <div class="pop_field">
                                        <label>offer (%)</label> 
                                        <div class="input_filed ">
                                            <input type="text" name="discount" class="number" id="discount" placeholder="Discount Value">
                                        </div>
<!--                                        <div class="selcetdrop half new_selct select_drop  new_dropmenu">
                                            <ul class="list-unstyled" id="discnt">
                                                <?php
//                                                $discount_array = array(
//                                                    'discounts' => '%'
//                                                );
                                                ?>
                                                <li class="init">select</li>
                                                <?php
//                                                if ($discount_array) {
//                                                    foreach ($discount_array as $discountkey => $discount_arrays) {
//                                                        echo '<li data-value = "' . $discountkey . '" class = "first_child" style="display:none;" >' . $discount_arrays . '</li>';
//                                                    }
//                                                }
                                                ?>
                                            </ul>
                                        </div>-->
                                        <input type="hidden" class="discount" name="discount_type" value="discounts" id="discount_type" />
                                    </div>

                                </div>
                                <div class="right_popdiv">
                                    <div class="search_btn toggle_btn">
                                        <div class="btn-group" id="status" data-toggle="buttons">
                                            <label for="modifier_tab" class="btn btn-default btn-on btn-xs active">
                                                <input id="modifier_tab" type="radio" value="1" name="toops" checked="checked">Modifier</label>
                                            <label for="size_tab" class="btn btn-default btn-off btn-xs">
                                                <input id="size_tab" type="radio" value="0" name="toops">Size</label>
                                        </div>
                                    </div>
                                    <div id="section_modify">

                                    </div>
                                    <div id="section_size" style="display:none;">
                                        <div id="insert_size">
                                            <div class="caterow">
                                                <div class="two_col">
                                                    <label>1.</label>
                                                    <div class="same_btnn nw" > <input type="text" name="size[1][title]" class="" placeholder="Size Title"></div>
                                                    <div class="same_btnn nw"> <span class="sizedoller">$</span><input type="text" name="size[1][size_price]" class="" placeholder="Size Price"></div>
                                                    <div class="input_filed new_mntm">
                                                        <textarea name="size[1][description]" class="sizearea" id="size_desc" placeholder="Size Description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border_div"></div>
                                        <div class="add_cate top_spacce">
                                            <a href="javascript:void(0)" id="addsize"> + Add Size </a>
                                            <input type="hidden" name="num_sz" id="num_sz" value="2">
                                        </div>
                                    </div>

                                    <!--        <div class="add_cate"> 
                                                        <a href="javascript:void(0)" id="addmodify"> + Add modifier </a>
                                                    </div>
                                                    <div class="border_div"></div>-->

                                    <div class="add_cate top_spacce">
                                        <a href="javascript:void(0)" id="addpromt"> + Add prompt </a>
                                    </div>
                                    <input type="hidden" id="num_st" value="1" />

                                </div>
                                <div class="pop_btn full-width">
                                    <input type="submit" class="same_btn" id="submit_btn" value="Create" />
                                    <a class="same_btn default_btn" href="#" id="canc" data-dismiss="modal">Cancel</a>    

                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <script>
        function addmenucheck(){
            var slected_slide = $('#slected_slide').val();
            if(slected_slide==''){
                swal("There is no menu category. Please add menu category first.");
            }
            else
            {
                $('#addmenuitem').modal('show');
            }
        }
        </script>
        <!--Add Menu Item End -->
        
        <div class="menu_box" id="mnbx">

            <?php
            $j = 1;

            $items = DB::table('menu_item')->select('menu_item.*')
                            ->where('menu_item.cuisines_id', $first)->orderBy('menu_item.item_order', 'asc')->get();

            if ($items) {
                foreach ($items as $item) {
                    if ($j % 2 == 0) {
                        $class = 'pull-right default stripe_none';
                    } else {
                        $class = '';
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
                    $j++;
                }
            } else {
                ?>
                <div class="no_record">
                    <div>No Record Found on that menu.</div>
                </div>
                <?php
            }
            ?>

        </div>

    </div>
</div>

<!--Edit Menu Item Start -->
<div id="editmenuitem" class="modal fade editscreen addmenu item_modifier" role="dialog">

</div>
<script src="{{ URL::asset('public/js/front2/sweetalert.min.js') }}"></script>
<script>
    $(document).on('ready', function () {
        $('#sldr').show();
    });
    $("#mnbx").on('click','.edit_menuitem',function(){
        var parentid = $('#slected_slide').val();
        var id = $(this).data('id');
        var slug = $(this).data('slug');
        var data = {
                menu: parentid,
                id: id,
                slug: slug
            }

        $.ajax({
                url: "<?php echo HTTP_PATH; ?>/user/editmenuitem", 
                dataType: 'html',
                type: 'POST',
                data: data,
                success: function(result){
                    $('#editmenuitem').html(result);                        
                }
            });
    });
    
    
    $("#mnbx").on('click','.delete_menuitem',function(){
       swal({
            title: "Delete",
            text: "Are you sure to delete this Menu Item?",
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
                        url: "<?php echo HTTP_PATH; ?>user/deletemenuitem", 
                        dataType: 'html',
                        type: 'POST',
                        data: data,
                        success: function(result){
                            var res = result.trim();
                            if(res=='success'){
                                var selected_menu = $('#selected_menu').val();
                                var dat = {
                                    selected_menu: selected_menu,
                                    keyword: ''
                                }
                                $.ajax({
                                    url:'<?php echo HTTP_PATH . 'searchmenuitem'; ?>',
                                    type: 'POST',
                                    data: dat,
                                    dataType: 'html',
                                    success: function (result) {
                                        //console.log(result);
                                        $('#mnbx').html(result);
                                        //$('.all_bg_ldr').show();
                                    }
                                });
                            }

                        }
                    });
            } else {
              return false;
            }
          });
    });
    
</script>
<!--Edit Menu Item End -->

<script>

    $("#popular").on("click", function () {
        $("#spicy").removeClass("active");
        $(this).addClass("active");
    });

    $("#discnt").on("click", ".init", function () {
        $(".init").toggleClass("arrow")

        $(this).closest("ul").children('li:not(.init)').toggle();
    });

    var allOptions3 = $("#discnt").children('li:not(.init)');
    $("#discnt").on("click", "li:not(.init)", function () {
        allOptions3.removeClass('selected');
        $(this).addClass('selected');
        $("#discnt").children('.init').html($(this).html());
        var value = $(this).html();
        $(".discount").val(value);
        allOptions3.toggle();
    });

    $('.offerd_on').on('click', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            var service_vis = $('#service_visibility').val();
            var sel = $(this).text();
            var result = removeValue(service_vis, sel, ",");
            $('#service_visibility').val(result);
        } else
        {
            $(this).parent().addClass('active');
            var service_vis = $('#service_visibility').val();
            var sel = $(this).text();
            if (service_vis == '') {
                service_vis = sel;
            } else
            {
                service_vis = service_vis + ',' + sel;
            }
            $('#service_visibility').val(service_vis);
        }
    });
    
    $('.services_on').on('click', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            var service_vis = $('#services_visibile').val();
            var sel = $(this).text();
            var result = removeValue(service_vis, sel, ",");
            $('#services_visible').val(result);
        } else
        {
            $(this).parent().addClass('active');
            var service_vis = $('#services_visible').val();
            var sel = $(this).text();
            if (service_vis == '') {
                service_vis = sel;
            } else
            {
                service_vis = service_vis + ',' + sel;
            }
            $('#services_visible').val(service_vis);
        }
    });
    
    

    $(".lebel_itm").on('click', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            var spicy_pop = $('#spicy_pop').val();
            var spop = $(this).text();
            var result = removeValue(spicy_pop, spop, ",");
            $('#spicy_pop').val(result);
        } else
        {
            $(this).parent().addClass('active');
            var spicy_pop = $('#spicy_pop').val();
            var spop = $(this).text();
            if (spicy_pop == '') {
                spicy_pop = spop;
            } else
            {
                spicy_pop = spicy_pop + ',' + spop;
            }
            $('#spicy_pop').val(spicy_pop);
        }
    });

    $('.pop_field ul li').on('click', function () {
        $(this).parent().find('li.active').removeClass('active');
        $(this).addClass('active');

        var act_val = $(this).parent().find('li.active').text();
        if ($.trim(act_val) == 'Online') {
            $('#status').val('1');
        } else if ($.trim(act_val) == 'Offline') {
            $('#status').val('0');
        }
    });

    var removeValue = function (list, value, separator) {
        separator = separator || ",";
        var values = list.split(separator);
        for (var i = 0; i < values.length; i++) {
            if (values[i] == value) {
                values.splice(i, 1);
                return values.join(separator);
            }
        }
        return list;
    }

    $('#addpromt').on('click', function () {
        var get_fielno = $('#num_st').val();
        var html = '<div class="category_row" id="prom' + get_fielno + '"><div class="diff_row"><label>' + get_fielno + '.</label><div class="big_block"> <input type="text" name="prom[' + get_fielno + '][title]" placeholder="Prompt Name"></div><div class="req"><a href="javascript:void(0);" class="req_or_not" data-req="'+get_fielno+'">Required</a><input type="hidden" id="promreq'+get_fielno+'" name="prom[' + get_fielno + '][optional]" value="optional" /></div></div>';
        html += '<div class="modyadd' + get_fielno + '"></div><div class="add_cate"><a href="javascript:void(0)" class="addons" data-fielno="' + get_fielno + '" id="addmodify' + get_fielno + '"> + Add modifier </a><input type="hidden" id="inc' + get_fielno + '" value="' + get_fielno + '" /></div><div class="border_div"></div>'
        html += '</div>';
        $('#section_modify').append(html);
        get_fielno = parseInt(get_fielno) + 1;
        $('#num_st').val(get_fielno);
        //section_modify
    });

    $("#addmenuitem").on('click','.req_or_not',function(){
        var inputchange = $(this).data('req');
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#promreq'+inputchange).val('optional');
        }
        else
        {
            $(this).addClass('active');
            $('#promreq'+inputchange).val('required');
        }
    });
    $("#editmenuitem").on('click','.req_or_not',function(){
        var inputchange = $(this).data('req');
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#promreq'+inputchange).val('optional');
        }
        else
        {
            $(this).addClass('active');
            $('#promreq'+inputchange).val('required');
        }
    });

    $('#addmenuitem').on('click', '.addons', function () {
        var addarea = $(this).data('fielno');
        var incval = $('#inc' + addarea).val();
        var htm = '<div class="caterow" id="rem' + addarea + '"><div class="two_col">';
        htm += '<div class="same_btnn"> <input type="text" name="prom[' + addarea + '][modifier][' + incval + '][modifier_name]" placeholder="Modifier Name"></div>';
        htm += '<div class="same_btnn differne"><input type="text" name="prom[' + addarea + '][modifier][' + incval + '][modifier_price]" placeholder="price"></div>';
        htm += '</div> <a class="close_icon remmodi" data-rem=' + addarea + ' href="javascript:void(0);"><i class="fa fa-times"></i></a></div>';
        $('.modyadd' + addarea).append(htm);
        incval = parseInt(incval) + 1;
        $('#inc' + addarea).val(incval);
    });

    $('#addmenuitem').on('click', '.remmodi', function () {
        var remarea = $(this).data('rem');
        $('#rem' + remarea).remove();
    });

    $('#addmenuitem').on('change', 'input[type=radio]', function () {
        var select_tab = $(this).val();
        if (select_tab == '0') {
            $('#section_modify').hide();
            $('#addpromt').hide();
            $('#section_size').show();
        } else if (select_tab == '1')
        {
            $('#section_modify').show();
            $('#section_size').hide();
            $('#addpromt').show();
        }
    });
    
    //Edit Menu Item Code Start
    
    
    
    $('#editmenuitem').on('click','.offerd_on', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            var service_vis = $('#editservice_visibility').val();
            var sel = $(this).text();
            var result = removeValue(service_vis, sel, ",");
            $('#editservice_visibility').val(result);
        } else
        {
            $(this).parent().addClass('active');
            var service_vis = $('#editservice_visibility').val();
            var sel = $(this).text();
            if (service_vis == '') {
                service_vis = sel;
            } else
            {
                service_vis = service_vis + ',' + sel;
            }
            $('#editservice_visibility').val(service_vis);
        }
    });
    

    $("#editmenuitem").on('click','.lebel_itm', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            var spicy_pop = $('#editspicy_pop').val();
            var spop = $(this).text();
            var result = removeValue(spicy_pop, spop, ",");
            $('#editspicy_pop').val(result);
        } else
        {
            $(this).parent().addClass('active');
            var spicy_pop = $('#editspicy_pop').val();
            var spop = $(this).text();
            if (spicy_pop == '') {
                spicy_pop = spop;
            } else
            {
                spicy_pop = spicy_pop + ',' + spop;
            }
            $('#editspicy_pop').val(spicy_pop);
        }
    });

    $('#editmenuitem').on('click','.pop_field ul li', function () {
        $(this).parent().find('li.active').removeClass('active');
        $(this).addClass('active');

        var act_val = $(this).parent().find('li.active').text();
        if ($.trim(act_val) == 'Online') {
            $('#editstatus').val('1');
        } else if ($.trim(act_val) == 'Offline') {
            $('#editstatus').val('0');
        }
    });
    
    
    $('#editmenuitem').on('change', 'input[type=radio]', function () {
        var select_tab = $(this).val();
        if (select_tab == '0') {
            $('#editsection_modify').hide();
            $('#editpromt').hide();
            $('#editsection_size').show();
        } else if (select_tab == '1')
        {
            $('#editsection_modify').show();
            $('#editsection_size').hide();
            $('#editpromt').show();
        }
    });
    
    $('#editmenuitem').on('click','#editpromt', function () {
        var get_fielno = $('#editnum_st').val();
        var html = '<div class="category_row" id="prom' + get_fielno + '"><div class="diff_row"><label>' + get_fielno + '.</label><div class="big_block"> <input type="text" name="prom[' + get_fielno + '][title]" placeholder="Prompt Name"></div><div class="req"><a href="javascript:void(0);" class="req_or_not">Required</a><input type="hidden" name="prom[' + get_fielno + '][optional]" value="optional" /></div></div>';
        html += '<div class="modyadd' + get_fielno + '"></div><div class="add_cate"><a href="javascript:void(0)" class="addons" data-fielno="' + get_fielno + '" id="addmodify' + get_fielno + '"> + Add modifier </a><input type="hidden" id="inc' + get_fielno + '" value="' + get_fielno + '" /></div><div class="border_div"></div>'
        html += '</div>';
        $('#editsection_modify').append(html);
        get_fielno = parseInt(get_fielno) + 1;
        $('#editnum_st').val(get_fielno);
        //section_modify
    });
    
    $('#editmenuitem').on('click', '.addons', function () {
        var addarea = $(this).data('fielno');
        var incval = $('#inc' + addarea).val();
        var htm = '<div class="caterow" id="rem' + addarea + '"><div class="two_col">';
        htm += '<div class="same_btnn"> <input type="text" name="prom[' + addarea + '][modifier][' + incval + '][modifier_name]" placeholder="Modifier Name"></div>';
        htm += '<div class="same_btnn differne"><input type="text" name="prom[' + addarea + '][modifier][' + incval + '][modifier_price]" placeholder="price"><span class="sizedoller">$</span></div>';
        htm += '</div> <a class="close_icon remmodi" data-rem=' + addarea + ' href="javascript:void(0);"><i class="fa fa-times"></i></a></div>';
        $('.modyadd' + addarea).append(htm);
        incval = parseInt(incval) + 1;
        $('#inc' + addarea).val(incval);
    });
    
    $('#editmenuitem').on('click', '.remmodi', function () {
        var remarea = $(this).data('rem');
        $('#rem' + remarea).remove();
    });
    $('#editmenuitem').on('click','#editsize', function () {
        var get_fielno = $('#editnum_sz').val();
        var html = '<div class="caterow" id="size' + get_fielno + '"><div class="border_div"></div><div class="two_col">';
        html += '<div class="two_col"><label>' + get_fielno + '.</label><div class="same_btnn nw" > <input type="text" name="size[' + get_fielno + '][title]" placeholder="Size Title"></div>'
        html += '<div class="same_btnn nw"> <span class="sizedoller">$</span><input type="text" name="size[' + get_fielno + '][size_price]" placeholder="Size Price"></div><div class="input_filed new_mntm">'
        html +='<textarea name="size[' + get_fielno + '][description]" class="sizearea" id="size_description" placeholder="Size Description"></textarea>';
        html += '</div>'
        html += '</div></div>';
        $('#editinsert_size').append(html);
        get_fielno = parseInt(get_fielno) + 1;
        $('#editnum_sz').val(get_fielno);
        //section_modify
    });
    
    $('#editmenuitem').on('click','#editsubmit_btn',function (event) {
        var valid = $("#menuitem_edit").validate();
        if($("#menuitem_edit").valid()){
        event.preventDefault(); //prevent default action 
        var form_data = $('#menuitem_edit').serialize();
        var selected_menu = $('#editselected_menu').val();
        var post_url = '<?php echo HTTP_PATH . 'user/subeditmenuitem'; ?>';
        //alert(form_data);   
        $.ajax({
            url: post_url,
            type: 'POST',
            data: form_data
        }).done(function (response) { // c
            if (response == 'Success') {
                document.getElementById("menuitem_edit").reset();
                $("#cancl").trigger("click");
                var selected_menu = $('#selected_menu').val();
                    var data = {
                        selected_menu: selected_menu,
                        keyword: ''
                    }
                    $.ajax(
                    {
                    url: "<?php echo HTTP_PATH; ?>/searchmenuitem", 
                    dataType: 'html',
                    type: 'POST',
                    data: data,
                    success: function(result){
                        //console.log(result);
                        $('#mnbx').html(result);
                    }
                });
            }
        });
    }
    });     
    
    //Edit Menu Item Code End
    

    $('#addsize').on('click', function () {
        var get_fielno = $('#num_sz').val();
        var html = '<div class="caterow" id="size' + get_fielno + '"><div class="border_div"></div><div class="two_col">';
        html += '<div class="two_col"><label>' + get_fielno + '.</label><div class="same_btnn nw" > <input type="text" name="size[' + get_fielno + '][title]" placeholder="Size Title"></div>'
        html += '<div class="same_btnn nw"> <span class="sizedoller">$</span> <input type="text" name="size[' + get_fielno + '][size_price]" placeholder="Size Price"></div><div class="input_filed new_mntm">'
        html +='<textarea name="size[' + get_fielno + '][description]" class="sizearea" id="size_description" placeholder="Size Description"></textarea>';
        html += '</div>'
        html += '</div></div>';
        $('#insert_size').append(html);
        get_fielno = parseInt(get_fielno) + 1;
        $('#num_sz').val(get_fielno);
        //section_modify
    });
// Search Menu Item Start
$("#searchorder").submit(function (e) {
        var keyword = $('#searchkey').val();
        var selected_menu = $('#selected_menu').val();
        var data = {
            selected_menu: selected_menu,
            keyword: keyword
        }
        $.ajax(
        {
        url: "<?php echo HTTP_PATH; ?>/searchmenuitem", 
        dataType: 'html',
        type: 'POST',
        data: data,
        success: function(result){
            //console.log(result);
            $('#mnbx').html(result);
        }
    });

    e.preventDefault();
});
$('#rearrange').on('click',function(){
var selected_menu = $('#selected_menu').val();
var data = {
            selected_menu: selected_menu
        }
$.ajax({
    url: "<?php echo HTTP_PATH; ?>/user/rearrangemenuitem", 
    dataType: 'html',
    type: 'POST',
    cache: false,
    data: data,
    success: function(result){
        $('#rearrangemenuitem').html(result);                        
    }
});

});
//Search Menu Item End

//Submit Add Menu Item
$("#menuitem_add").validate();
$("#menuitem_edit").validate();
    $('#menuitem_add').submit(function (event) {
        var valid = $("#menuitem_add").validate();
        if($("#menuitem_add").valid()){
            event.preventDefault(); //prevent default action 
            var form_data = $(this).serialize();
            var selected_menu = $('#selected_menu').val();
            var post_url = '<?php echo HTTP_PATH . 'user/addmenuitem'; ?>/' + selected_menu;
            //alert(form_data);   
            $.ajax({
                url: post_url,
                type: 'POST',
                data: form_data
            }).done(function (response) { // c
                if (response == 'Success') {
                    document.getElementById("menuitem_add").reset();
                    $('.offer_on').removeClass('active');
                    $('.lb').removeClass('active');
                    $('.pop_field ul li').removeClass('active');
                    $("#canc").trigger("click");
                    var selected_menu = $('#selected_menu').val();
                        var data = {
                            selected_menu: selected_menu,
                            keyword: ''
                        }
                        $.ajax(
                        {
                        url: "<?php echo HTTP_PATH; ?>/searchmenuitem", 
                        dataType: 'html',
                        type: 'POST',
                        data: data,
                        success: function(result){
                            //console.log(result);
                            $('#mnbx').html(result);
                        }
                    });
                }
                else if(response=='Error'){
                
                    alert("Please select the tab e.g:- Offered on");
                }
                else if(response=='errorlogin'){
                    window.location.href="<?php echo HTTP_PATH; ?>";
                }
            });
        }
    });
 //Submit Menu Add  
  //Submit Menu Add 
    $("#menu_add").validate();
    $('#menu_add').submit(function (event) {
            event.preventDefault(); //prevent default action 
            
            var form_data = $(this).serialize();
            var post_url = '<?php echo HTTP_PATH . 'user/addmenu' ?>';
                $.ajax({
                    url: post_url,
                    type: 'POST',
                    data: form_data
                }).done(function (response) { // c
                    if (response == 'Success') {

                        document.getElementById("menu_add").reset();
                        $("#addmncl").trigger("click");
                        location.reload();
                    } else
                    {
                        alert('Please select tab option also!');
                    }
                });
           
        
    });
 
//Add/edit menu Js
$('.pop_field ul.ser_mn li').on('click', function () {
        $(this).parent().find('li.active').removeClass('active');
        $(this).addClass('active');

        var act_val = $(this).parent().find('li.active').text();
        if ($.trim(act_val) == 'On') {
            $('#service').val('1');
        } else if ($.trim(act_val) == 'Off') {
            $('#service').val('0');
        }
    });
$('.pop_field ul.vis_mn li').on('click', function () {
    $(this).parent().find('li.active').removeClass('active');
    $(this).addClass('active');

    var act_val = $(this).parent().find('li.active').text();
    if ($.trim(act_val) == 'On') {
        $('#visibility').val('1');
    } else if ($.trim(act_val) == 'Off') {
        $('#visibility').val('0');
    }
});

$('#editmenu').on('click','.pop_field ul.ser_mn li', function () {
        $(this).parent().find('li.active').removeClass('active');
        $(this).addClass('active');

        var act_val = $(this).parent().find('li.active').text();
        if ($.trim(act_val) == 'On') {
            $('#editservice').val('1');
        } else if ($.trim(act_val) == 'Off') {
            $('#editservice').val('0');
        }
    });
$('#editmenu').on('click','.pop_field ul.vis_mn li', function () {
    $(this).parent().find('li.active').removeClass('active');
    $(this).addClass('active');

    var act_val = $(this).parent().find('li.active').text();
    if ($.trim(act_val) == 'On') {
        $('#editvisibility').val('1');
    } else if ($.trim(act_val) == 'Off') {
        $('#editvisibility').val('0');
    }
});

$('#editmenu').on('click','.services_on', function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            var service_vis = $('#editservices_visibile').val();
            var sel = $(this).text();
            var result = removeValue(service_vis, sel, ",");
            $('#editservices_visibile').val(result);
        } else
        {
            $(this).parent().addClass('active');
            var service_vis = $('#editservices_visibile').val();
            var sel = $(this).text();
            if (service_vis == '') {
                service_vis = sel;
            } else
            {
                service_vis = service_vis + ',' + sel;
            }
            $('#editservices_visibile').val(service_vis);
        }
    });
    
    

//Add menu Js Enf

//On/Off Ajax

    $('#mnbx').on('click', '.onoff', function () {
        var confrm = '';
        var id = $(this).data('id');
        var onoroff = $(this).data('detail');
        if (onoroff == 'offline') {
            confrm = confirm("Are you sure to make item offline!");
        } else
        {
            confrm = confirm("Are you sure to make item online!");
        }
        if (confrm == '1') {
            var data = {
                id: id,
                status: onoroff
            }
            $.ajax({
                url: '<?php echo HTTP_PATH . '/user/menuitemstatus'; ?>',
                dataType: 'html',
                type: 'POST',
                data: data,
                success: function (result) {
                    $('#onoffstatus' + id).html(result);
                }
            });
        } else
        {

        }

    });

</script>


<script src="<?php echo HTTP_PATH; ?>/public/js/front2/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function () {
        $(".center").slick({
            dots: true,
            infinite: true,
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            focusOnSelect:true,
            initialSlide: 0,
            centerPadding: '0px',
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '45px',
                        slidesToShow: 6
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 5
                    }
                },
                {
                    breakpoint: 670,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 5
                    }
                },
                {
                    breakpoint: 580,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '20px',
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
            var current_slide = $(slick.$slides[currentSlide]).data('slide');
            $('#slected_slide').val(current_slide);
            $('#selected_menu').val(current_slide);
            var data = {
                current_menu: current_slide,
            }
            $.ajax({
                url: "<?php echo HTTP_PATH; ?>/user/nextmenuitem",
                dataType: 'html',
                type: 'POST',
                data: data,
                success: function (result) {
                    $('#mnbx').html(result);
                }
            });

        });

    });



//Edit Order Code




</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>




<script>

    $(document).ready(function () {
        $("#sidebarCollapse").click(function () {
            $(".navbar-btn").toggleClass("menuicon");

        });
    });

</script>

<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 5) {
            $(".navbar_tab").addClass("fixed-me");
        } else {
            $(".navbar_tab").removeClass("fixed-me");
        }

        if ($(this).scrollTop() > 5) {
            $(".responsive_btn").addClass("fixed-icon");
        } else {
            $(".responsive_btn").removeClass("fixed-icon");
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
        if ($(window).width() < 514) {
            $('#sidebarCollapse').removeClass('calendarnav');
        } else {
            $('#sidebarCollapse').addClass('calendarnav');
        }
    });
    
    jQuery(document).ajaxStart(function(){
        
        $('#submit_btn').prop('disabled',true);
    }).ajaxStop(function(){
        $('#submit_btn').prop('disabled',false);
    })
</script>
@stop


