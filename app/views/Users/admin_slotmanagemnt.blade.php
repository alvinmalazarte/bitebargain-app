@section('title', 'Administrator :: '.TITLE_FOR_PAGES.' Manage Slots')
@extends('layouts/adminlayout')
@section('content')
<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>
{{ HTML::style('public/js/front/timepicker/jquery.timepicker.css'); }}
{{ HTML::style('public/js/chosen/chosen.css'); }}
{{ HTML::script('public/js/front/timepicker/jquery.timepicker.js'); }}
<script type="text/javascript">
$(document).ready(function () {

    $('#myform').validate();
    $('.start_time').timepicker({'timeFormat': 'h:i a', 'step': 30, 'minTime': '01:00am', 'maxTime': '12:59am'});
    $('.end_time').timepicker({'timeFormat': 'h:i a', 'step': 30, 'minTime': '01:00am', 'maxTime': '12:59am'});

    function minFromMidnight(tm) {
        var ampm = tm.substr(-2);
        ;
        var clk;
        if (tm.length <= 6) {
            clk = tm.substr(0, 4);
        } else {
            clk = tm.substr(0, 5);
        }
        var m = parseInt(clk.match(/\d+$/)[0], 10);
        var h = parseInt(clk.match(/^\d+/)[0], 10);
        h += (ampm.match(/pm/i)) ? 12 : 0;
        return h * 60 + m;
    }


    $.validator.addMethod('positiveNumber',
            function (value) {
                return Number(value) > 0;
            }, 'Enter a positive number.');
});

$(document).ready(function () {
    $(".cb-enable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-disable', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox', parent).attr('checked', true);
    });
    $(".cb-disable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox', parent).attr('checked', false);
    });
});

function chkselect(val) {
    if (val == '') {
        $('#selectop :selected').attr('selected', '');

    }
}
</script>

<style>
    .cb-enable, .cb-disable, .cb-enable span, .cb-disable span { background: url(<?php echo HTTP_PATH . "public/css/front/" ?>switch.gif) repeat-x; display: block; float: left; }
    .cb-enable span, .cb-disable span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
    .cb-enable span { background-position: left -90px; padding: 0 10px; }
    .cb-disable span { background-position: right -180px;padding: 0 10px; }
    .cb-disable.selected { background-position: 0 -30px; }
    .cb-disable.selected span { background-position: right -210px; color: #fff; }
    .cb-enable.selected { background-position: 0 -60px; }
    .cb-enable.selected span { background-position: left -150px; color: #fff; }
    .switch label { cursor: pointer; }
    .switch input { display: none; }

</style>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ul id="breadcrumb" class="breadcrumb">
                    <li>
                        {{ html_entity_decode(HTML::link(HTTP_PATH.'admin/admindashboard', "<i class='fa fa-dashboard'></i> Dashboard", array('id' => ''), true)) }}
                    </li>
                    <li>
                        <i class="fa fa-cutlery"></i> 
                        {{ html_entity_decode(HTML::link(HTTP_PATH.'admin/restaurants/admin_index', "Restaurants", array('id' => ''), true)) }}
                    </li>
                    <li class="active"> Manage Slots</li>
                </ul>
                <section class="panel">
                    <header class="panel-heading">
                        Manage Slots
                    </header>

                    <div class="panel-body">
                        {{ View::make('elements.actionMessage')->render() }}
                        <span class="require_sign">Please note that all fields that have an asterisk (*) are required. </span>
                        {{ Form::model($opening_hours, array('url' => '/admin/restaurants/Admin_slotmanagemnt/'.$opening_hours->user_slug, 'method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}
                        <div class="fill_data_left">
                            <!--<div class="status">-->
                                <div class="durationstatus">
                                    <div class="duratin_slot">
                                        <div class="duratin_slotname">Open Days <span class="red-mark"> *</span></div>

                                        <?php
                                        $openday = explode(',', $opening_hours->open_days);
                                        $vrrcy = explode(',', $opening_hours->start_time);
                                        $endty = explode(',', $opening_hours->end_time);

                                        $i = 0;
                                        $j = 0;
                                        foreach ($openday as $value) {
                                            ?>
                                            <div class="day_name"> {{$value}}</div>
                                            <div class="day_div">

                                                <div class="personal_bx">
                                                    <div class="personal_table">
                                                        <div class="personal_tr">
                                                            <div class="personal_th">Start Time</div>
                                                            <div class="personal_th">End Time</div>
                                                            <div class="personal_th">status</div>

                                                        </div>

                                                        <?php
                                                        $duration = '30';  // split by 30 mins
                                                        $array_of_time = array();
                                                        $array_of_endtime = array();
                                                        $start_time = strtotime($vrrcy[$i]); //change to strtotime
                                                        $end_time = strtotime($endty[$i]); //change to strtotime
                                                        $end_time1 = $start_time;
                                                        $add_mins = $duration * 60;

                                                        while ($start_time < $end_time) { // loop between time
                                                            $array_of_time[] = date("h:i a", $start_time);
                                                            $start_time += $add_mins; // to check endtie=me
                                                            $end_time1 += $add_mins; // to check endtie=me
                                                            $array_of_endtime[] = date("h:i a", $start_time);
                                                        }
                                                        foreach ($array_of_time as $key => $array_of_times) {
                                                             $single = DB::table('slots')
                                                                ->where('user_id', $opening_hours->user_id)
                                                                ->where('start_time', strtotime($array_of_times))
                                                                ->where('day', $value)
                                                                ->first();
                                                              $status=1;
                                                        if($single){
                                                            $status= $single->status;
                                                        } 
//                                                        print_r($single);
                                                            ?>
                                                            <div class="personal_tr">
                                                                <div class="personal_th">  {{$array_of_times}}</div>
                                                                <div class="personal_th">  {{$array_of_endtime[$key]}}</div>

                                                                <div class="personal_th"> <p class=" switch">
                                                                        <label class="cb-enable {{$status?'selected':''}}"><span>On</span></label>
                                                                        <label class="cb-disable {{$status?'':'selected'}}"><span>Off</span></label>
                                                                        {{ Form::checkbox('open_close_'.$j, 1,($status?TRUE:FALSE), ['id' => 'checkbox', 'class'=>'checkbox']) }}
                                                                        {{ Form::hidden('start_time[]',$array_of_times, array('id' =>'time')) }}
                                                                        {{ Form::hidden('end_time[]',$array_of_endtime[$key], array('id' =>'time')) }}
                                                                        {{ Form::hidden('day[]',$value, array('id' =>'time')) }}
                                                                        {{ Form::hidden('days','', array('id' =>'days')) }}
                                                                    </p></div>

                                                            </div>


                                                            <?php $j++;
                                                        } ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>



                                    </div>
                                </div>

                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                {{ Form::submit('Update', array('class' => "btn btn-danger")) }}
                                {{ html_entity_decode(HTML::link(HTTP_PATH.'admin/restaurants/admin_index', "Cancel", array('class' => 'btn btn-default'), true)) }}
                            </div>
                        </div>

                        {{ Form::close() }}

                    </div>


                </section>
            </div>

        </div>
    </section>
</section>
{{ HTML::script('public/js/chosen/chosen.jquery.js'); }}
<script type="text/javascript">
    Array.prototype.diff = function (a) {
        return this.filter(function (i) {
            return a.indexOf(i) === -1;
        });
    };

    $('body').on('change', '.chzn-select', function (e) {

        var opendays = $(this).val();
        // alert(opendays);

        var alwaysdays = new Array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');

        for (var i = 0; i <= 6; i++) {
            if (opendays.indexOf(alwaysdays[i]) == -1) {
                $('#' + alwaysdays[i] + '_div').hide();
            } else {
                $('#' + alwaysdays[i] + '_div').show();
            }
        }

    });

    $(".chzn-select").chosen();
    $(".chzn-select-deselect").chosen({allow_single_deselect: true});
    $("#selectop").chosen({allow_single_deselect: true});
</script>
@stop