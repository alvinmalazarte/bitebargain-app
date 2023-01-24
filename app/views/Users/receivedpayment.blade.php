@extends('layouts.default')
@section('content')
{{ HTML::style('public/assets/bootstrap/css/bootstrap.min.css') }}
<!--{{ HTML::style('public/assets/bootstrap/css/bootstrap-datetimepicker.min.css') }}
<script src="{{ URL::asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/bootstrap/js/bootstrap-datetimepicker.js') }}"></script>-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
$(function () {
    $("#searchByDateFrom").datepicker({
        defaultDate: "+1w",
        changeMonth: true,dateFormat: 'yy-mm-dd',
        numberOfMonths: 1, minDate: 0,
        onClose: function (selectedDate) {
            $("#searchByDateTo").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#searchByDateTo").datepicker({
        defaultDate: "+1w", minDate: 0,
        changeMonth: true,dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        onClose: function (selectedDate) {
            $("#searchByDateFrom").datepicker("option", "maxDate", selectedDate);
        }
    });
});
</script>
<div class="botm_wraper">
    @include('elements/left_menu') 
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new"> 
                {{ View::make('elements.actionMessage')->render() }}  
                <div class="informetion_top">
                    <div class="tatils"> <span class="personal">Received Payments History</span> </div>    
                    <div class="search-area">
                        {{ Form::open(array('url' => '/user/receivedpayment/', 'method' => 'post', 'id' => 'adminAdd', 'files' => true,'class'=>'form-inline')) }}
                        <div class="form-group">
                            <label class="sr-only" for="search">Your Keyword</label>
                            {{ Form::text('search', $search_keyword, array('class' => 'required search_fields form-control','placeholder'=>"Your Keyword")) }}
                        </div>
                        <?php // if($type=='all'){ ?>
                        <div class="form-group ">
                            <label class="sr-only" for="search_from">Start Date</label>
                            {{ Form::text('search_from', $searchByDateFrom, array('class' => 'required search_fields form-control searchDate','placeholder'=>"From Date",'id'=>'searchByDateFrom',"data-date"=>"", "data-date-format"=>"yyyy-mm-dd", "data-link-field"=>"dtp_input2", "data-link-format"=>"yyyy-mm-dd",'onkeypress'=>"return false")) }}
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="search_end">End Date</label>
                            {{ Form::text('search_to', $searchByDateTo, array('class' => 'required search_fields form-control searchDate','placeholder'=>"To Date",'id'=>'searchByDateTo',"data-date"=>"", "data-date-format"=>"yyyy-mm-dd", "data-link-field"=>"dtp_input2", "data-link-format"=>"yyyy-mm-dd",'onkeypress'=>"return false")) }}
                        </div>
                        <?php // } ?>
                        <div class="search_btn search_btn_right">{{ Form::submit('Search', array('class' => "btn btn-success")) }}</div>
                        <span class="hint" style="margin:5px 0">Search Order by typing their Order number</span>
                        {{ Form::close() }}
                    </div>
                    <div class="pery">
                        <div class="table_scroll">
                            <div class="tble_title">Transaction Totals</div>
                            <div class="informetion_bxes">
                                <?php
                                if ($total) {
                                    ?>
                                    <div class="table_dcf">
                                        <div class="tr_tables">
                                            <div class="td_tables">Restaurant Name</div>
                                            <div class="td_tables">Total</div>
                                            <div class="td_tables">Admin Commission</div>
                                        </div>
                                        <?php
                                        $i = 1;
                                        foreach ($total as $data) {
                                            if ($i % 2 == 0) {
                                                $class = 'colr1';
                                            } else {
                                                $class = '';
                                            }
                                            ?>
                                            <div class="tr_tables2">
                                                <div data-title="Name" class="td_tables2">
                                                    {{$data->first_name.' '.$data->last_name ? ucfirst($data->first_name).' '.ucfirst($data->last_name) :'' }}
                                                </div>
                                                <div data-title="Amount" class="td_tables2 ttvb">
                                                    {{ App::make("HomeController")->numberformat($data->total,2) }}
                                                </div>
                                                <div data-title="Admin Commision" class="td_tables2 ttvb">
                                                    <?php
                                                    $adminuser = DB::table('admins')
                                                            ->where('id', '1')
                                                            ->first();
                                                    if ($adminuser->is_commission == 1) {
                                                        $comm_per = $adminuser->commission;
                                                        $tax_amount = $comm_per * $data->total / 100;
                                                    } else {
                                                        $tax_amount = 0.00;
                                                    }
                                                    ?>
                                                    {{ App::make("HomeController")->numberformat($tax_amount,2) }}
                                                </div>
                                            </div>
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
                    <div class="pery">
                        <div class="table_scroll">
                            <div class="tble_title">Transaction Details</div>
                            <div class="informetion_bxes">
                                <?php
                                if (!$payments->isEmpty()) {
                                    ?>
                                    <div class="table_dcf">
                                        <div class="tr_tables">
                                            <div class="td_tables">{{ SortableTrait::link_to_sorting_action('transaction_id', 'Transaction id') }}</div>
                                            <?php if ($paymentslug == "purchase") { ?>
                                                <div class="td_tables">{{ SortableTrait::link_to_sorting_action('order_id', 'Order Number') }}</div>
    <?php } ?>
                                            <div class="td_tables">{{ SortableTrait::link_to_sorting_action('price', 'Amount') }}</div>
                                            <div class="td_tables">Admin Commission</div>
                                            <div class="td_tables">{{ SortableTrait::link_to_sorting_action('status', 'Status') }}</div>
                                            <div class="td_tables">{{ SortableTrait::link_to_sorting_action('created', 'Created') }}</div>
                                        </div>
                                        <?php
                                        $i = 1;
                                        foreach ($payments as $data) {
                                            if ($i % 2 == 0) {
                                                $class = 'colr1';
                                            } else {
                                                $class = '';
                                            }
                                            ?>
                                            <div class="tr_tables2">
                                                <div data-title="Name" class="td_tables2">
                                                    {{ ucwords($data->transaction_id); }}
                                                </div>
                                                <div data-title="Name" class="td_tables2 ">
                                                    <?php
                                                    if ($paymentslug == "purchase") {
                                                        $single = DB::table('orders')
                                                                ->where('id', $data->order_id)
                                                                ->first();

                                                        if ($single) {
                                                            echo $single->order_number;
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div data-title="Amount" class="td_tables2 ttvb">
                                                    {{ App::make("HomeController")->numberformat($data->price,2) }}
                                                </div>
                                                <div data-title="Admin Commision" class="td_tables2 ttvb">
                                                    <?php
                                                    $adminuser = DB::table('admins')
                                                            ->where('id', '1')
                                                            ->first();
                                                    if ($adminuser->is_commission == 1) {
                                                        $comm_per = $adminuser->commission;
                                                        $tax_amount = $comm_per * $data->price / 100;
                                                    } else {
                                                        $tax_amount = 0.00;
                                                    }
                                                    ?>
                                                    {{ App::make("HomeController")->numberformat($tax_amount,2) }}
                                                </div>
                                                <div data-title="Status" class="td_tables2">
                                                    {{ $data->status}} 
                                                </div>
                                                <div data-title="Created" class="td_tables2">
                                                    {{  date("d M, Y h:i A", strtotime($data->created)) }}
                                                </div>
                                            </div>
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
                                <div class="pagination pagination_css">
                                    {{ $payments->appends(Request::only('search','from_date','to_date'))->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


