@section('title', 'Administrator :: '.TITLE_FOR_PAGES.' Manage Opening hours')
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
                    <li class="active"> Manage Opening hours</li>
                </ul>
                <section class="panel">
                    <header class="panel-heading">
                        Manage Opening hours
                    </header>

                    <div class="panel-body">
                        {{ View::make('elements.actionMessage')->render() }}
                        <span class="require_sign">Please note that all fields that have an asterisk (*) are required. </span>
                        {{ Form::model($opening_hours, array('url' => '/admin/restaurants/Admin_openinghours/'.$opening_hours->user_slug, 'method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}
                        <div class="fill_data_left">
                            <div class="status">
                                <div class="firest_row">
                                    <div class="labelname">Restaurant Status </div>
                                    <div class="week">

                                        <p class="field switch">
                                            <label class="cb-enable {{$opening_hours->open_close?'selected':''}}"><span>On</span></label>
                                            <label class="cb-disable  {{$opening_hours->open_close?'':'selected'}}"><span>Off</span></label>
                                            {{ Form::checkbox('open_close', 1, ($opening_hours->open_close?TRUE:FALSE), ['id' => 'checkbox', 'class'=>'checkbox']) }}
                                        </p>

                                    </div>
                                    <div class="hint-onoff">
                                        If you turn your status off this will override your opening hours and no customers will be able to order!
                                    </div>
                                </div>
                                <div class="firest_row">
                                    <div class="labelname">Open Days <span class="require"> *</span></div>
                                    <div class="week">
                                        <?php
                                        $array = array('mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday');
                                        ?>
                                        {{ Form::select('open_days[]', $array,  explode(',', $opening_hours->open_days), array('multiple' => true, 'class'=>'chzn-select')); }}
                                    </div></div>
                                <div class="firest_row">
                                    <div class="labelname">
                                        Opening Hours <span class="require"> *</span>
                                    </div>
                                    <div class="week" id="detail_field_page"> 
                                        <div class="menu_table menu_tablese menu_tablesefgt">

                                            <?php
                                            $openday = explode(',', $opening_hours->open_days);
                                            $vrrcy = explode(',', $opening_hours->start_time);
                                            $endty = explode(',', $opening_hours->end_time);

                                            $startime = array_combine($openday, $vrrcy);
                                            $endtime = array_combine($openday, $endty);


                                            foreach ($array as $vardhbb => $value) {
                                                $bloack = "block";
                                                if (!in_array($vardhbb, $openday)) {
                                                    $bloack = "none";
                                                }
                                                ?>
                                                <ul id="<?php echo $vardhbb; ?>_div" style="display: <?php echo $bloack; ?>">
                                                    <li>
                                                        <label> <?php echo $value; ?> </label>
                                                    </li>
                                                    <li>
                                                        {{ Form::hidden('open_days_label[]', $vardhbb, array('class' => 'start_time required form-control','placeholder'=>"Start Time")) }}
                                                        {{ Form::text('start_time['.$vardhbb.']', (isset($startime[$vardhbb]) && $startime[$vardhbb])?$startime[$vardhbb]:"", array('class' => 'start_time required form-control','placeholder'=>"Start Time")) }}
                                                    </li>
                                                    <li>
                                                        {{ Form::text('end_time['.$vardhbb.']', (isset($endtime[$vardhbb])&& $endtime[$vardhbb])?$endtime[$vardhbb]:"", array('class' => 'end_time required form-control','placeholder'=>"End Time")) }}
                                                    </li>
                                                </ul>
                                            <?php } ?>

                                        </div>
                                    </div> 
                                </div>

                            </div>
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