@extends('layouts.default')
@section('content')

<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#myform").validate({
        submitHandler: function (form) {
            this.checkForm();

            if (this.valid()) { // checks form for validity
                //                    $('#formloader').show();
                this.submit();
            } else {
                return false;
            }
        }
    });

    $.validator.addMethod('number1',
            function (value) {
                return Number(value) >= 0 && (value) < 100;
            },
            'Enter number between 1 to 100 only.');

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
        $('.checkbox', parent).attr('value', '1');
        $('.hiden_weeek').show();
    });

    $(".cb-disable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox', parent).attr('checked', false);
        $('.checkbox', parent).attr('value', '0');
        $('.hiden_weeek').hide();
    });

    $(".cb-enable2").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-disable2', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox2', parent).attr('checked', true);
        $('.checkbox2', parent).attr('value', '1');
    });

    $(".cb-disable2").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable2', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox2', parent).attr('checked', false);
        $('.checkbox2', parent).attr('value', '0');
    });

    $("#discount_type").change(function () {
        var discount_type = $("#discount_type").val();
        if (discount_type == 'none') {
            $("#discount").removeClass('required');
            $("#discount").removeClass('error');
            $("#discount").attr('readonly', 'readonly');
            $("#discount").val('');

        } else if (discount_type == 'currency') {
            $("#discount").addClass('required');
            $("#discount").addClass('positiveNumber');
            $("#discount").removeClass('number1');
            $("#discount").removeAttr('readonly');

        } else {
            $("#discount").addClass('required');
             $("#discount").removeClass('positiveNumber');
            $("#discount").addClass('number1');
            $("#discount").removeAttr('readonly');
        }
    });

});

</script>
<script>

    function setSathours(val)
    {
        var length = val.indexOf(":");
        var new_str = val.substring(0, length);
        //    alert(new_str);
        if (new_str <= 9) {
            val = new_str + ':00';
        } else {

            val = new_str + ':00';
        }
//         console.log(new_str);
        var val12 = (parseInt(new_str) + 1) + ':00';
        $("#service_end").val(val12);
        $("#service_end option").prop("disabled", false);
        $("#service_end option[value='" + val + "']").each(function () {

            $(this).parent().each(function () {

                $(this.options).each(function () {
                    var val1 = $(this).val();
                    var length1 = val1.indexOf(":");
                    var new_str1 = val1.substring(0, length1);
                    if (parseInt(new_str1) <= parseInt(new_str)) {
                        $(this).prop("disabled", true);
                    }
                })
            });
        });
    }

</script>
<script>
    $(document).on('keypress', '.positiveNumber', function (event) {
        // alert('hii');
        var $this = $(this);
        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                        (event.which != 0 && event.which != 8))) {
            event.preventDefault();
        }

        var text = $(this).val();
        if ((event.which == 46) && (text.indexOf('.') == -1)) {
            setTimeout(function () {
                if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                }
            }, 1);
        }

        if ((text.indexOf('.') != -1) &&
                (text.substring(text.indexOf('.')).length > 2) &&
                (event.which != 0 && event.which != 8) &&
                ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
        }
    });

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

    .cb-enable2, .cb-disable2, .cb-enable2 span, .cb-disable2 span { background: url(<?php echo HTTP_PATH . "public/css/front/" ?>switch.gif) repeat-x; display: block; float: left; }
    .cb-enable2 span, .cb-disable2 span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
    .cb-enable2 span { background-position: left -90px; padding: 0 10px; }
    .cb-disable2 span { background-position: right -180px;padding: 0 10px; }
    .cb-disable2.selected { background-position: 0 -30px; }
    .cb-disable2.selected span { background-position: right -210px; color: #fff; }
    .cb-enable2.selected { background-position: 0 -60px; }
    .cb-enable2.selected span { background-position: left -150px; color: #fff; }
    .switch label { cursor: pointer; }
    .switch input { display: none; }

</style>
<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                <div class="informetion_top">
                    <div class="tatils"> <span class="personal">Add Menu </span></div>
                    <div class="pery">
                        <div id="formloader" class="formloader" style="display: none;">
                            {{ HTML::image('public/img/loader_large_blue.gif','', array()) }}
                        </div>
                        {{ View::make('elements.frontEndActionMessage')->render() }}
                        {{ Form::open(array('url' => '/user/addmenu', 'method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}

                        <span class="require redd" style="float: left;width: 100%;">* Please note that all fields that have an asterisk (*) are required. </span>

                        <div class="form_group">
                            {{ HTML::decode(Form::label('name', "Menu<span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{  Form::text('name', Input::old("name"),  array('class' => 'required form-control','id'=>"name"))}}
                            </div>
                        </div>

                        <div class="firest_row">
                            <div class="labelname">Service</div>
                            <div class="week">
                                <p class="field switch">
                                    <label class="cb-enable "><span>On</span></label>
                                    <label class="cb-disable selected"><span>Off</span></label>
                                    {{ Form::checkbox('service', 0, FALSE, ['id' => 'checkbox', 'class'=>'checkbox']) }}
                                </p>
                            </div>
                            <div class="labelname hiden_weeek" style="display:none"> <span class="red-mark"></span></div>
                            <div class="week hiden_weeek"  style="display:none">


                                <div class="selectt" id="services_box">
                                    <div class=" half ">
                                        <div class="dropp_half ">
                                            <?php global $month_Array; ?>
                                            {{ Form::select('service_month', $month_Array, Input::old('service_month'), array('class' => 'form-control', 'id'=>'service_month')) }}
                                        </div>

                                        <div class="dropp_half ">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $categories_array[$i . ":00"] = date("h:iA", strtotime($i . ":00"));
                                            }
                                            ?>
                                            {{ Form::select('service_start', $categories_array, Input::old('service_start'), array('class' => 'form-control', 'id'=>'service_start','onchange' => "setSathours(this.value)" )) }}
                                        </div>

                                        <div class="dropp_half ">
                                            <?php
                                            for ($i = 0; $i < 24; $i++) {
                                                $categories_array[$i . ":00"] = date("h:iA", strtotime($i . ":00"));
                                            }
                                            ?>
                                            {{ Form::select('service_end', $categories_array, Input::old('service_end'), array('class' => 'form-control', 'id'=>'service_end')) }}
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="firest_row">
                            <div class="labelname">Visibility</div>
                            <div class="week">
                                <p class="field switch">
                                    <label class="cb-enable2"><span>On</span></label>
                                    <label class="cb-disable2 selected"><span>Off</span></label>
                                    {{ Form::checkbox('visibility', 0, FALSE, ['id' => 'checkbox2', 'class'=>'checkbox2']) }}
                                </p>
                            </div>
                        </div>

                        <div class="form_group">
                            <label class="">Service Visibility<span class='require'>*</span></label>     
                            <div class="in_upt">
                                <div class="radio">
                                    <!--<input type="radio" name="radio-group" id="first-choice" value="First Choice" />-->
                                    {{ Form::checkbox('service_visibility[]', 'Reservations', FALSE, ['id' => 'first-choice', 'class'=>'first-choice required']) }}
                                    <label for="first-choice">Reservations</label>
                                </div>

                                <div class="radio">
                                    <!--<input type="radio" name="radio-group" id="second-choice" value="Second Choice" />-->
                                    {{ Form::checkbox('service_visibility[]', 'Delivery & Pickup', FALSE, ['id' => 'second-choice', 'class'=>'first-choice required']) }}
                                    <label for="second-choice">Delivery & Pickup</label>
                                </div>


                            </div>  
                        </div>



                        <div class="form_group">
                            {{ HTML::decode(Form::label('Offer', "Offer (%)<span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                <div class="dropp_half ">
                                    <?php
                                    $type_array = array(
                                        '' => 'Offer Type',
                                        'none' => 'None',
                                        'currency' => 'Currency',
                                        'discounts' => 'Discounts',
                                    );
                                    ?>
                                    {{ Form::select('discount_type', $type_array, Input::old('discount_type'), array('class' => 'form-control required ', 'id'=>'discount_type')) }}
                                </div>  
                                <div class="in_upt half_input">
                                {{  Form::text('discount', Input::old("discount"),  array('class' => 'required form-control number1','id'=>"discount"))}}

                            </div>
                            </div>  
                            
                        </div>


                        <div class="form_group input_bxxs">
                            <label>&nbsp;</label>
                            <div class="in_upt in_upt_res">
                                {{ Form::submit('Submit', array('class' => "btn btn-primary",'id'=>'bubbb')) }}
                                {{ Form::reset('Reset', array('class' => "btn btn-default")) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

