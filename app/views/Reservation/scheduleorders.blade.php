@extends('layouts.default')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" ></script>
{{ HTML::script('public/js/front/jquery.bpopup.min.js'); }}

<?php
// get current user details
$user_id = Session::get('user_id');

$all_query = DB::table('reservations')->where('reservations.caterer_id', $user_id)->whereRaw('reservation_date > DATE_ADD( NOW(), INTERVAL 2 HOUR)')->get();

$confirm_query = DB::table('reservations')->where('reservations.caterer_id', $user_id)->whereRaw('reservation_date > DATE_ADD( NOW(), INTERVAL 2 HOUR)')->where('reservation_status', 'Pending')->get();

$cancel_query = DB::table('reservations')->where('reservations.caterer_id', $user_id)->whereRaw('reservation_date > DATE_ADD( NOW(), INTERVAL 2 HOUR)')->where('reservation_status', 'Cancel')->get();
?>

<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                {{ View::make('elements.actionMessage')->render() }}  
                <div class="informetion_top">
                    <div class="tatils"> <span class="personal">Scheduled Reservations</span></div>

                    <div class="tabel_option">
                        <ul class="tabel_option_li">
                            <li class="{{Request::is('reservation/scheduleorders/all') ? 'active' :''}}"><a href="{{HTTP_PATH.'reservation/scheduleorders/all'}}">ALL ({{$all_query ? count($all_query) :'0'}})</a></li>
                            <li class="{{Request::is('reservation/scheduleorders/schedule') ? 'active' :''}}"><a href="{{HTTP_PATH.'reservation/scheduleorders/schedule'}}">SCHEDUALED ({{$confirm_query ? count($confirm_query) :'0'}})</a></li>
                            <li class="{{Request::is('reservation/scheduleorders/cancel') ? 'active' :''}}"><a href="{{HTTP_PATH.'reservation/scheduleorders/cancel'}}">CANCELLED ({{$cancel_query ? count($cancel_query):'0'}})</a></li>
                        </ul>  
                    </div>

                    <div class="pery">
                        <div class="table_scroll">
                            <div class="informetion_bxes  green-table">
                                <?php
                                if (!$records->isEmpty()) {
                                    ?>
                                    <div class="table_dcf">
                                        <div class="tr_tables">
                                            <div class="td_tables"><i class="fa fa-calendar" aria-hidden="true"></i>Reservation</div>
                                            <div class="td_tables"><i class="fa fa-user" aria-hidden="true"></i>Name</div>
                                            <div class="td_tables"> <i class="fa fa-tags" aria-hidden="true"></i>Offer</div>
                                            <div class="td_tables"> <i class="fa fa-users" aria-hidden="true"></i>Size</div>
                                            <div class="td_tables"><i class="fa fa-clock-o" aria-hidden="true"></i> Date/Time</div>
                                            <div class="td_tables"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Action</div>
                                        </div>
                                        <?php
                                        $i = 1;
 $cuisine_array = array(
                                        '' => 'Please Select',
                                        'all_menu' => 'On all menu',
                                        'all_menu_above' => 'On all menu on orders above ' . CURR,
                                        'all_item' => 'On selected items',
                                        'all_item_above' => 'On selected items on orders above ' . CURR
                                    );
                                        foreach ($records as $data) {
                                          
                                            if ($i % 2 == 0) {
                                                $class = 'colr1';
                                            } else {
                                                $class = '';
                                            }
                                            ?>
                                            <div class="tr_tables2">
                                                <div data-title="Reservation Id" class="td_tables2">
                                                    {{ $data->reservation_number}}
                                                </div>
                                                <div data-title="Name" class="td_tables2">
                                                    {{ $data->res_first_name.' '.$data->res_last_name ? ucfirst($data->res_first_name) .' '.ucfirst($data->res_last_name):''; }}
                                                </div>
                                                <div data-title="Offer" class="td_tables2">
                                                    <?php
                                                    $offers = DB::table('offers')->where('offers.id', $data->offer_id)->first();
                                                    $text1 = '0';
                                                    if ($offers && $data->offer_id) {
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
                                                        $text1 = $prefix . $offers->discount . $postfix . ' Off ' . $text;
                                                    }
                                                    echo $text1;
                                                    ?>
                                                    <!--{{ $data->discount; }}-->
                                                </div>
                                                <div data-title="Size" class="td_tables2">
                                                    {{ $data->size; }}
                                                </div>
                                                <div data-title="Date/Time" class="td_tables2">
                                                    {{  date("d/m/Y", strtotime($data->created)) .' at '. date("h:i A", strtotime($data->created)) }}
                                                </div>
                                                <div data-title="Action" class="td_tables2">
                                                    <div class="actions">
                                                        <a href="javascript:void(0)" class="orderview_bpop_<?php echo $data->id; ?>" title = "View Order Details"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>	
                                            </div>
                                            <div class="popup fixed-width orderview-window_<?php echo $data->id; ?>" style="display:none">
                                                <div class="ligd">  
                                                    <div class="wrapper_login">
                                                        <div id="formloader_<?php echo $data->id; ?>" class="formloader" style="display: none;">
                                                            {{ HTML::image('public/img/loader_large_blue.gif','', array()) }}
                                                        </div>
                                                        <div class="order_pop i_trab">
                                                            <span class="button b-close">
                                                                <span>X</span>        
                                                            </span> 
                                                            <div class="cover_top">
                                                                <div class="order_pop_inner">
                                                                    <div class="left_side"><b><i class="fa fa-user" aria-hidden="true"></i> {{ $data->res_first_name.' '.$data->res_last_name ? $data->res_first_name.' '.$data->res_last_name:"N/A"; }}</b>
                                                                        <div class="call">{{ $data->user_phone ? $data->user_phone:"N/A"; }} </div>
                                                                        <address>{{ $data->user_email_address ? $data->user_email_address:"N/A"; }}  <i class="fa fa-plus" aria-hidden="true"></i></address>
                                                                    </div>
                                                                    <div class="right_side">
                                                                        <div class="deliverd"><i class="fa fa-calendar" aria-hidden="true"></i> Reservation</div> 
                                                                    </div>   
                                                                </div>   
                                                            </div>
                                                            <div class="subtotlall"><div class="left_totla"><i class="fa fa-clock-o" aria-hidden="true"></i>Date</div> 
                                                                <div class="right_totla">{{  date("M d,Y", strtotime($data->created)) . date("h:i A", strtotime($data->created)) }}</div>
                                                            </div>

                                                            <div class="subtotlall"><div class="left_totla"><i class="fa fa-users" aria-hidden="true"></i>Party Size</div> 
                                                                <div class="right_totla">{{ $data->size ? $data->size:'' }}</div>
                                                            </div>



                                                            <div class="subtotlall"><div class="left_totla"><i class="fa fa-tags" aria-hidden="true"></i>Offer</div> 
                                                                <?php
//                                                                $parking_array = array(
//                                                                    '' => 'Please Select offer',
//                                                                    '1' => '30% off on all menu',
//                                                                    '0' => '40% off on all menu'
//                                                                );
                                                                $parking_array = array(
                                                                    '' => 'Please Select offer'
                                                                );
                                                                $offers = DB::table('offers')->where('offers.user_id', $user_id)->get();
//                                                                echo '<pre>';
//                                                                print_r($offers);
                                                                foreach ($offers as $value) {
                                                                    $text = '';
                                                                    $prefix = '';
                                                                    $postfix = '';
                                                                    $text .= $cuisine_array[$value->offer_name];
                                                                    if ($value->type == 'percentage') {

                                                                        $postfix = '%';
                                                                    } else {
                                                                        $prefix = CURR;
                                                                    }
                                                                    if ($value->offer_name == 'all_menu_above' || $value->offer_name == 'all_item_above') {
                                                                        $text .= CURR . $value->above_price;
                                                                    }
                                                                    $parking_array[$value->id] = $prefix . $value->discount . $postfix . ' Off ' . $text;
                                                                }
                                                                ?>

                                                                <div class=" right_totla dropp_half ">{{ Form::select('offer_id', $parking_array,$data->offer_id, array('class' => 'form-control offer_id'.$data->id, 'id'=>'city')) }}</div>
                                                            </div>
                                                            <div class="subtotlall"><div class="left_totla"> Status</div> 
                                                                <?php
                                                                $status_array = array(
                                                                    'Confirm' => 'Confirm',
                                                                    'Attented' => 'Attented',
                                                                    'Cancel' => 'Cancel',
                                                                    'No Show' => 'No Show'
                                                                );
                                                                ?>

                                                                <div class="right_totla dropp_half ">{{ Form::select('status', $status_array, $data->reservation_status, array('class' => 'form-control status'.$data->id, 'id'=>'status'.$data->id)) }}</div>
                                                            </div>
                                                            <div class="ovverlapp">
                                                                <div class="attention"><span class="atent"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> special order instructions</span>
                                                                    <div class="atgg_linne">please want to set close to the window cornor table.</div>
                                                                </div>
                                                                <div class="btnn"><a href="javascript:void(0)" onclick="updatetime('{{$data->id}}')">Save</a></div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).on("click", ".b-close", function () {
                                                $('.orderview-window_<?php echo $data->id; ?>').bPopup().close();
                                                });
                                                $(document).on("click", ".orderview_bpop_<?php echo $data->id; ?>", function () {
                                                $('.orderview-window_<?php echo $data->id; ?>').bPopup({
                                                easing: 'easeOutBack', //uses jQuery easing plugin
                                                        speed: 700,
                                                        modalClose: false,
                                                        transition: 'slideBack',
                                                        transitionClose: "slideIn",
                                                        modalColor: false,
                                                });
                                                });
                                            </script>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    <?php } else {
                                        ?>
                                        <div class="no-record">
                                            No records available
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function increaseValue(id) {
    var value = $('.number' + id).val();
//        var value = parseInt(document.getElementById('number'+id).value, 10);

    value = isNaN(value) ? 0 : value;
    value++;
    $('.number' + id).val(value);
    }

    function decreaseValue(id) {
    var value = $('.number' + id).val();
//        var value = parseInt(document.getElementById('number'+id).value, 10);
//        alert(value);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    $('.number' + id).val(value);
    }

</script>
<script>
    function cancel(slug) {

    var data = {slug: slug}
    $.ajax({
    url: "<?php echo HTTP_PATH . "order/cancelorder" ?>",
            type: 'POST',
            data: data,
            success: function (data, textStatus, XMLHttpRequest)
            {
            window.location.reload();
            }
    });
    }
    function updatetime(id) {

    var data = {id: id, status: $('.status' + id).val(), offer_id: $('.offer_id' + id).val()}
    $.ajax({
    beforeSend:function() {
    $('#formloader_' + id).show();
    },
            url: "<?php echo HTTP_PATH . "reservation/updatestatus" ?>",
            type: 'POST',
            data: data,
            success: function (data, textStatus, XMLHttpRequest)
            {
            window.location.reload();
            }
    });
    }
</script>
@stop


