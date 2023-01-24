@extends('layouts.default')
@section('content')
<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>
{{ HTML::style('public/js/chosen/chosen.css'); }}
<script type="text/javascript">
$(document).ready(function () {
    $.validator.addMethod('positiveNumber',
            function (value) {
                return Number(value) > 0;
            }, 'Enter a positive number.');

    $.validator.addMethod('number1',
            function (value) {
                return Number(value) >= 0 && (value) < 100;
            },
            'Enter number between 1 to 100 only.');

    $.validator.addMethod("pass", function (value, element) {
        return  this.optional(element) || (/.{8,}/.test(value) && /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,20})/.test(value));
    }, "Password minimum length must be 8 characters and combination of 1 special character, 1 lowercase character, 1 uppercase character and 1 number.");


    $("#myform").validate({
        submitHandler: function (form) {
            this.checkForm();

            if (this.valid()) {
                var error = 0;
                $(".required").each(function (index, element) {
                    if (element.value == '' || element.value < 0) {

                        error = 1;

                    }
                });

                if (error) {

                    alert('Please enter all the required fields.');
                    return false;
                    w.preventdefault();
                } else {
                    this.submit();
                }

            } else {
                return false;
            }
        }
    });
    $(document).on("click", ".counter_number", function () {
        var type = $(this).attr("alt");
        var value = $('#preparation_time').val();
        value = value ? parseInt(value) : 0;
        if (type == 'minus') {
            $('#preparation_time').val((value - 1 < 0) ? 0 : (value - 1));
        } else {
            if (value >= 100)
                $('#preparation_time').val(value);
            else
                $('#preparation_time').val(value + 1);
        }
    })
});

$(document).ready(function () {
    $(".cb-enable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-disable', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox', parent).attr('checked', true);
        $('.checkbox', parent).attr('value', '1');
    });

    $(".cb-disable").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox', parent).attr('checked', false);
        $('.checkbox', parent).attr('value', '0');
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

    $(".cb-enable3").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-disable3', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox3', parent).attr('checked', true);
        $('.checkbox3', parent).attr('value', '1');
    });

    $(".cb-disable3").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable3', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox3', parent).attr('checked', false);
        $('.checkbox3', parent).attr('value', '0');
    });

    $(".cb-enable4").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable4', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox4', parent).attr('checked', true);
        $('.checkbox4', parent).attr('value', '1');
    });

    $(".cb-disable4").click(function () {
        var parent = $(this).parents('.switch');
        $('.cb-enable4', parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox4', parent).attr('checked', false);
        $('.checkbox4', parent).attr('value', '0');
    });
    
  $("#discount_type").change(function () {
        var discount_type = $("#discount_type").val();
        if (discount_type == 'none') {
            $("#discount").removeClass('required');
            $("#discount").removeClass('error');
             $("#discount").attr('readonly','readonly');
              $("#discount").val('');

        }  else if (discount_type == 'currency') {
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

    .cb-enable3, .cb-disable3, .cb-enable3 span, .cb-disable3 span { background: url(<?php echo HTTP_PATH . "public/css/front/" ?>switch.gif) repeat-x; display: block; float: left; }
    .cb-enable3 span, .cb-disable3 span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
    .cb-enable3 span { background-position: left -90px; padding: 0 10px; }
    .cb-disable3 span { background-position: right -180px;padding: 0 10px; }
    .cb-disable3.selected { background-position: 0 -30px; }
    .cb-disable3.selected span { background-position: right -210px; color: #fff; }
    .cb-enable3.selected { background-position: 0 -60px; }
    .cb-enable3.selected span { background-position: left -150px; color: #fff; }
    .switch label { cursor: pointer; }
    .switch input { display: none; }

    .cb-enable4, .cb-disable4, .cb-enable4 span, .cb-disable4 span { background: url(<?php echo HTTP_PATH . "public/css/front/" ?>switch.gif) repeat-x; display: block; float: left; }
    .cb-enable4 span, .cb-disable4 span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
    .cb-enable4 span { background-position: left -90px; padding: 0 10px; }
    .cb-disable4 span { background-position: right -180px;padding: 0 10px; }
    .cb-disable4.selected { background-position: 0 -30px; }
    .cb-disable4.selected span { background-position: right -210px; color: #fff; }
    .cb-enable4.selected { background-position: 0 -60px; }
    .cb-enable4.selected span { background-position: left -150px; color: #fff; }
    .switch label { cursor: pointer; }
    .switch input { display: none; }


</style>
<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                <div class="informetion_top">
                    <div class="tatils"> <span class="personal">Add Menu Item</span></div>
                    <div id="formloader" class="formloader" style="display: none;">
                        {{ HTML::image('public/img/loader_large_blue.gif','', array()) }}
                    </div>
                    {{ View::make('elements.frontEndActionMessage')->render() }}
                    <ul class="dea_tabs">
                        <script>
                            function opendiv(id) {
                                $('.rj').hide();
                                $('#' + id).show();
                                $('.ddlj').removeClass('active');
                                $('#' + id + '_li').addClass('active');
                            }
                        </script>
                        <li id="tab1_li" class="ddlj active" onclick="opendiv('tab1')">General</li>
                        <li id="tab2_li"  class="ddlj " onclick="opendiv('tab2')">Modifier</li>
                        <li id="tab3_li"  class="ddlj " onclick="opendiv('tab3')">Sizes</li>
                        <li id="tab4_li"  class="ddlj " onclick="opendiv('tab4')">Labels</li>
                    </ul>
                    {{ Form::open(array('url' => '/user/addmenuitem/'.$cuisines->slug, 'method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}
                    <span class="require redd" style="float: left;width: 100%;">* Please note that all fields that have an asterisk (*) are required. </span>
                    <div  class="rj active" id="tab1">  

                        <div class="form_group">
                            {{ HTML::decode(Form::label('item_name', "Item Name<span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{  Form::text('item_name', Input::old("item_name"),  array('class' => 'required form-control','id'=>"item_name"))}}
                            </div>
                        </div>
                        <div class="form_group">
                            {{ HTML::decode(Form::label('price', "Price(".CURR.")<span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{  Form::text('price', Input::old("price"),  array('class' => 'required positiveNumber number form-control','id'=>"price"))}}
                            </div>

                        </div>
                        <div class="form_group">
                            {{ HTML::decode(Form::label('description', "Menu Item Description<span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{  Form::textarea('description', Input::old("description"),  array('class' => 'form-control required','id'=>"description" ,"maxlength"=>"250"))}}
                            </div>
                        </div>
                        <div class="firest_row">
                            <div class="labelname">Visibility</div>
                            <div class="week">
                                <p class="field switch">
                                    <label class="cb-enable2"><span>On</span></label>
                                    <label class="cb-disable2 selected"><span>Off</span></label>
                                    {{ Form::checkbox('visible', 0, FALSE, ['id' => 'checkbox2', 'class'=>'checkbox2']) }}
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

                        <div class="form_group">
                            {{  HTML::decode(Form::label('image', "Image <span class='require'>*</span>",array('class'=>"control-label col-lg-2 "))) }}
                            <div class="right_div">
                                <div class="input_field_img">{{ Form::file('image',['onchange' => 'return imageValidation();','class'=>'required']); }}</div>
                                <p class="help-block">Supported File Types: gif, jpg, jpeg, png. Max size 2MB.</p>
                            </div>
                        </div>
                    </div>
                    <div class="rj" style="display:none" id="tab2">

                        <div class="form_group selectt">
                            {{ HTML::decode(Form::label('selection', "Selection ",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                <div class="dropp">
                                    <?php
                                    $cuisine_array = array(
                                        '' => 'Please Select',
                                        'single' => 'Single',
                                        'multiple' => 'Multiple'
                                    );
                                    ?>
                                    {{ Form::select('selection', $cuisine_array, Input::old("selection"), array('class' => 'form-control', 'id'=>'selection')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form_group selectt">
                            {{ HTML::decode(Form::label('type', "Type ",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                <div class="dropp">
                                    <?php
                                    $cuisine_array = array(
                                        '' => 'Please Select',
                                        'optional' => 'Optional',
                                        'required' => 'Required'
                                    );
                                    ?>
                                    {{ Form::select('type', $cuisine_array, Input::old("type"), array('class' => 'form-control ', 'id'=>'type')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form_group">    
                            <label>Modifier </label>
                            <div class="right_div">
                                <div id="items" class="add_ons"></div>
                                <button type="button" class="add_field_button btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="rj" style="display:none" id="tab3">
                        <div class="form_group">    
                            <label>Item Size </label>
                            <div class="right_div">
                                <div id="itemsvarient" class="add_ons"></div>
                                <button type="button" class="add_field_button2 btn btn-primary">Add</button></div>
                        </div>
                    </div>
                    <div class="rj" style="display:none" id="tab4">
                        <div class="firest_row">
                            <div class="labelname">Spicy</div>
                            <div class="week">

                                <p class="field switch">
                                    <label class="cb-enable "><span>Yes</span></label>
                                    <label class="cb-disable selected"><span>No</span></label>
                                    {{ Form::checkbox('spicy', 0, FALSE, ['id' => 'checkbox', 'class'=>'checkbox']) }}
                                </p>
                                <div class="hint-onoff">
                                    If you choose yes than food is marked as a spicy and chili icon will be visible in the menu listing!
                                </div>
                            </div>
                        </div>
                        <div class="firest_row">
                            <div class="labelname">Popular Item</div>
                            <div class="week">

                                <p class="field switch">
                                    <label class="cb-enable4 "><span>Yes</span></label>
                                    <label class="cb-disable4 selected"><span>No</span></label>
                                    {{ Form::checkbox('popular', 0, FALSE, ['id' => 'checkbox4', 'class'=>'checkbox4']) }}
                                </p>
                                <div class="hint-onoff">
                                    If you choose yes than food is marked as a popular item and will visible in separate section called best deals.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pery">
                        <div class="form_group input_bxxs">
                            <label>&nbsp;</label>
                            <div class="in_upt in_upt_res">
                                {{ Form::hidden('cuisine',$cuisines->id,array('class'=>''))}}
                                {{ Form::submit('Save', array('class' => "btn btn-primary",'id'=>'bubbb')) }}
                                {{ html_entity_decode(HTML::link(HTTP_PATH.'user/managemenu', "Cancel", array('class' => 'btn btn-default'), true)) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').delegate('change', '.checkbox', function (e) {
        var id = $(this).attr('id');
        var Cid = id.split('_');
        if ($(this).is(":checked") == true) {
            $('#' + Cid[1] + '_price_span').show();
        } else {
            $('#' + Cid[1] + '_price_span').hide();
        }
    });

    $(document).ready(function () {
        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $("#items"); //Fields wrapper
        var wrapper2 = $("#itemsvarient"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var add_button2 = $(".add_field_button2"); //Add button ID

        var x = 1; //initlal text box count
        var y = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (y < max_fields) { //max input box allowed
                y++; //text box increment

                $(wrapper).append('<div class="ekdiv"><div class="add_item"> {{ HTML::decode(Form::label("name", "Name<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required form-control newclassvs" name="name[]" type="text"></div></div><div class="add_item rightt"> {{ HTML::decode(Form::label("qty", "Quantity<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required positiveNumber number form-control newclassvs" name="qty[]" type="text" data-rule-required="true"></div></div>' + '<div class="center_btn"><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></div></div>'); //add input box
                // $(wrapper).append('<div class="form-group"><label for="title">Author Email:</label>' +'<input class="form-control col-md-11" id="author_email" type="email" placeholder=""name="author"/>' +'<a href="#" class="remove_field"><i class="fa fa-times"></a></div>'); //add input box
            }
        });
        $(add_button2).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment

                $(wrapper2).append('<div class="ekdiv"><div class="add_item"> {{ HTML::decode(Form::label("size", "Size Title<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required form-control newclassvs" name="size[]" type="text"></div></div><div class="add_item rightt"> {{ HTML::decode(Form::label("size_price", "Price(USD)<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required positiveNumber number form-control newclassvs" name="size_price[]" type="text" data-rule-required="true"></div></div><div class="add_item full_divv"> {{ HTML::decode(Form::label("size_description", "Item Size Description<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><textarea  class="required form-control newclassvs" name="size_description[]"></textarea></div></div>' + '<div class="center_btn"><a href="#" class="remove_field2 remove_field"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></div></div>'); //add input box
                // $(wrapper).append('<div class="form-group"><label for="title">Author Email:</label>' +'<input class="form-control col-md-11" id="author_email" type="email" placeholder=""name="author"/>' +'<a href="#" class="remove_field"><i class="fa fa-times"></a></div>'); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove field
            e.preventDefault();
            $(this).parent().parent('div').remove();
            x--;
        })
        $(wrapper2).on("click", ".remove_field2", function (e) { //user click on remove field
            e.preventDefault();
            $(this).parent().parent('div').remove();
            x--;
        })

        $("#selection").change(function () {
            var selection = $("#selection").val();
            var type = $("#type").val();
            if (selection == 'single') {
                $("#items").html('<div class="ekdiv"><div class="add_item"> {{ HTML::decode(Form::label("name", "Name<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required form-control newclassvs" name="name[]" type="text"></div></div><div class="add_item rightt"> {{ HTML::decode(Form::label("qty", "Quantity<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required positiveNumber number form-control newclassvs" name="qty[]" type="text" data-rule-required="true"></div></div>' + '</div>'); //add input box
                $(".add_field_button").hide();
                $("#type option[value='required']").prop("disabled", false);
            } else {
                $(".add_field_button").show();
                $("#items").html('');
                $("#type option[value='required']").prop("disabled", true);
                $("#type").val("optional");
            }
        });

        $("#cuisine").change(function () {
            var cuisine = $(this).val();
            if (cuisine) {
                $.ajax({
                    type: 'GET',
                    url: "<?php echo HTTP_PATH ?>user/getCuisineDiscount/" + cuisine,
                    dataType: "html",
                    beforeSend: function () {
//                        $('#maindiv' + id).hide();
                    },
                    success: function (result) {
                        if (result == 1) {
//                             $("#discount").val('');
                            $("#discount_section").html('');
//                            $("#discount").removeClass('positiveNumber');
//                            $("#discount").attr('readonly',true);
                        } else {
//                            $("#discount").addClass('positiveNumber');
//                            $("#discount").removeAttr('readonly');
                            $("#discount_section").html('<div class="form_group">{{ HTML::decode(Form::label("discount", "Discount(%)<span class=\'require\'>*</span>",array("class"=>"control-label col-lg-2"))) }}<div class="in_upt"><input  class="required form-control number1" name="discount" type="text"></div></div>');
                        }
                    }
                });
            }
        });

    });

    $(document).on('click', '#bubbb', function (w) {

        var error = 0;
        $(".newclassvs").each(function (index, element) {
            if (element.value == '' || element.value <= 0) {

                error = 1;

            }
        });

        if (error) {

            alert('Please enter all the required fields.');
            return false;
            w.preventdefault();
        }
    });
</script>

<script>
    function in_array(needle, haystack) {
        for (var i = 0, j = haystack.length; i < j; i++) {
            if (needle == haystack[i])
                return true;
        }
        return false;
    }

    function getExt(filename) {
        var dot_pos = filename.lastIndexOf(".");
        if (dot_pos == -1)
            return "";
        return filename.substr(dot_pos + 1).toLowerCase();
    }



    function imageValidation() {

        var filename = document.getElementById("image").value;

        var filetype = ['jpeg', 'png', 'jpg', 'gif'];
        if (filename != '') {
            var ext = getExt(filename);
            ext = ext.toLowerCase();
            var checktype = in_array(ext, filetype);
            if (!checktype) {
                alert(ext + " file not allowed for Image.");
                document.getElementById("image").value = "";
                return false;
            } else {
                var fi = document.getElementById('image');
                var filesize = fi.files[0].size;
                if (filesize > 2097152) {
                    alert('Maximum 2MB file size allowed for Image.');
                    document.getElementById("image").value = "";
                    return false;
                }
            }
        }
        return true;
    }

</script>



@stop

