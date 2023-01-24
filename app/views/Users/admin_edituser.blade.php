@section('title', 'Administrator :: '.TITLE_FOR_PAGES.'Edit Restaurant')
@extends('layouts/adminlayout')
@section('content')

<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
    $.validator.addMethod("pass", function (value, element) {
        return  this.optional(element) || (/.{8,}/.test(value) && /([0-9].*[a-z])|([a-z].*[0-9])/.test(value));
    }, "Password minimum length must be 8 characters and combination of 1 special character, 1 lowercase character, 1 uppercase character and 1 number.");
    $.validator.addMethod("contact", function (value, element) {
        return  this.optional(element) || (/^[0-9-]+$/.test(value));
    }, "Contact Number is not valid.");

    $.validator.addMethod('numbers', function (value, element) {
        return this.optional(element) || /^\d+(\.\d{0,2})?$/.test(value);
    }, "Please enter a correct number, format xxxx.xx");
    
     $.validator.addMethod('positivecommision',
                function (value) {
                    return Number(value) >=0 &&  Number(value) <=100;
                }, 'Entered valid commision.');

    $("#adminAdd").validate();
    $(".chosen-select").chosen();
    $(".chosen-selects").chosen();
});
function setSathours(val)
{
    var length = val.indexOf(":");
    var new_str = val.substring(0, length);
    if (new_str <= 9) {
        val = new_str + ':00';
    } else {

        val = new_str + ':00';
    }
//         console.log(new_str);
    var val12 = (parseInt(new_str) + 1) + ':00';
    $("#delivery_hours_end").val(val12);
    $("#delivery_hours_end option").prop("disabled", false);
    $("#delivery_hours_end option[value='" + val + "']").each(function () {

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

function sePickhours(val)
{
    var length = val.indexOf(":");
    var new_str = val.substring(0, length);
    if (new_str <= 9) {
        val = new_str + ':00';
    } else {

        val = new_str + ':00';
    }
//         console.log(new_str);
    var val12 = (parseInt(new_str) + 1) + ':00';
    $("#pickup_hour_end").val(val12);
    $("#pickup_hour_end option").prop("disabled", false);
    $("#pickup_hour_end option[value='" + val + "']").each(function () {

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
<script>
    $(function () {
        $('#select_delivery_type').change(function () {
            var type = $(this).val();
            if (type == 'paid')
                $('#delivery_type').show();
            else
                $('#delivery_type').hide();
            $('#delivery_cost').val('');
        });
    });

</script>
{{ HTML::style('public/css/front/chosen.css'); }}
{{ HTML::script('public/js/front/chosen.jquery.js'); }}
<script src="{{ URL::asset('public/js/bootstrap-inputmask.min.js') }}"></script>
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
                    <li class="active">Edit Restaurant</li>
                </ul>
                <section class="panel">
                    <header class="panel-heading">
                        Edit Restaurant
                    </header>

                    <div class="panel-body">
                        {{ View::make('elements.actionMessage')->render() }}
                        <span class="require_sign">Please note that all fields that have an asterisk (*) are required. </span>
                        {{ Form::model($detail, array('url' => '/admin/restaurants/Admin_edituser/'.$detail->slug, 'method' => 'post', 'id' => 'adminAdd', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}

                        <div class="form-group">
                            {{ HTML::decode(Form::label('first_name', "Restaurant Name <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                <?php echo Form::text('first_name', Input::old('first_name'), array('class' => 'required form-control')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('username', "User Name <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('username', Input::old('username'), array('class' => 'required form-control username','readonly'=>'readonly')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('email_address', "Email Address",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10" style="margin-top: 7px">
                                {{ Form::text('email_address', Input::old('email_address'), array('class' => 'required form-control email')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('phone1', "Phone#1 <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('phone1',Input::old('phone1'), array('class' => 'form-control required','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('phone2', "Phone#2",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('phone2',Input::old('phone2'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('phone3', "Phone#3",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('phone3',Input::old('phone3'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('phone4', "Phone#4",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('phone4',Input::old('phone4'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('cell_phone1', "Cell Number#1",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('cell_phone1',Input::old('cell_phone1'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('cell_phone2', "Cell Number#2",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('cell_phone2',Input::old('cell_phone2'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('cell_phone3', "Cell Number#3",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('cell_phone3',Input::old('cell_phone3'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('cell_phone4', "Cell Number#4",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('cell_phone4',Input::old('cell_phone4'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('fax_number', "Fax Number ",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('fax_number', Input::old('fax_number'), array('class' => 'form-control'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('address', "Address <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('address',Input::old('address'), array('class' => 'required form-control','id' => 'pac-input','autocomplete' => 'off'))}}
                            </div>
                            <!--<div id="infowindow-content">
                                <img src="" width="16" height="16" id="place-icon">
                                <span id="place-name"  class="title"></span><br>
                                <span id="place-address"></span>
                            </div>-->
                            <div class="custom-map">
                                <div id="map-convas"></div>
                            </div>    
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('city', "City <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('city',Input::old('city'), array('class' => 'required form-control'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('state', "State <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('state',Input::old('state'), array('class' => 'required form-control'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('zipcode', "Zipcode <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('zipcode',Input::old('zipcode'), array('class' => 'required form-control'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('Service Offered', "Service Offered <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                <div class="check_box">
                                    {{ Form::label('Table reservations', "Table reservations ",array('class'=>"control-label col-lg-2")) }}

                                    <input name="service_offered[]" <?php echo in_array('Table reservations', explode(',', $detail->service_offered)) ? 'checked="checked"' : ''; ?> type="checkbox" value="Table reservations">
                                    <!--{{ Form::checkbox('service_offered[]','Table reservations ', null, ['class' => 'field']) }}-->
                                </div>
                                <div class="check_box">
                                    {{ Form::label('Delivery', "Delivery",array('class'=>"control-label col-lg-2")) }}
                                    <input name="service_offered[]" <?php echo in_array('Delivery', explode(',', $detail->service_offered)) ? 'checked="checked"' : ''; ?> type="checkbox" value="Delivery">
                                    <!--{{ Form::checkbox('service_offered[]','Delivery', null, ['class' => 'field']) }}-->
                                </div>
                                <div class="check_box">
                                    {{ Form::label('Pickup', "Pickup",array('class'=>"control-label col-lg-2")) }}
                                    <input name="service_offered[]" <?php echo in_array('Pickup', explode(',', $detail->service_offered)) ? 'checked="checked"' : ''; ?>  type="checkbox" value="Pickup">
                                    <!--{{ Form::checkbox('service_offered[]','Pickup', null, ['class' => 'field']) }}-->
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            {{ Html::decode(Form::label('restaurant_cat', "Category of restaurant",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                <?php
                                global $rest_Type;
                                $oldrcat_Arry = array();
                                $oldrcat = array();
                                $oldrcat = explode(',', $detail->restaurant_cat);
                                //   echo '<pre>'; print_r($oldrcat);die;
                                foreach ($oldrcat as $value) {
                                    $oldrcat_Arry[$value] = $value;
                                }
                                ?>

                                {{Form::select('restaurant_cat[]',$rest_Type,$oldrcat_Arry,array('class'=>'form-control chosen-select','id'=>'','multiple' => 'multiple'))}}
                            </div>
                        </div>
                        <?php
                        $array_cuisine = array();
                        $cuisines = DB::table('admin_cuisine')
                                ->where('status', 1)
                                ->orderby('name', 'ASC')
                                ->get();

                        foreach ($cuisines as $cuisine) {
                            $array_cuisine[$cuisine->name] = ucwords($cuisine->name);
                        }
                        
                        $oldrcat = explode(',', $detail->cuisines);
                        //   echo '<pre>'; print_r($oldrcat);die;
                        foreach ($oldrcat as $value) {
                            $oldrcat_Arry[$value] = $value;
                        }
                        ?>

                        <div class="form-group ">
                            {{ Html::decode(Form::label('cuisines', "Cuisines <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{Form::select('cuisines[]',$array_cuisine,$oldrcat_Arry,array('class'=>'required form-control chosen-selects','id'=>'','multiple' => 'multiple'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('Payment options', "Payment options",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                <div class="check_box">
                                    {{ Form::label('Cash', "Cash",array('class'=>"control-label col-lg-2")) }}
                                    <input name="payment_options[]" <?php echo in_array('Cash', explode(',', $detail->payment_options)) ? 'checked="checked"' : ''; ?> type="checkbox" value="Cash">
                                    <!--{{ Form::checkbox('payment_options[]','Cash',in_array('Cash', explode(',', $detail->payment_options)) ? 'checked="checked"' : '', ['class' => 'field']) }}-->
                                </div>
                                <div class="check_box">
                                    {{ Form::label('Credit Card', "Credit Card",array('class'=>"control-label col-lg-2")) }}
                                    <input name="payment_options[]" <?php echo in_array('Credit Card', explode(',', $detail->payment_options)) ? 'checked="checked"' : ''; ?> type="checkbox" value="Credit Card">
                                    <!--{{ Form::checkbox('payment_options[]','Credit Card',in_array('Credit Card', explode(',', $detail->payment_options)) ? 'checked="checked"' : '', ['class' => 'field']) }}-->
                                </div>
                                <div class="check_box">
                                    {{ Form::label('Paypal', "Paypal",array('class'=>"control-label col-lg-2")) }}
                                    <input name="payment_options[]" <?php echo in_array('Paypal', explode(',', $detail->payment_options)) ? 'checked="checked"' : ''; ?> type="checkbox" value="Paypal">
                                    <!--{{ Form::checkbox('payment_options[]','Paypal',in_array('Paypal', explode(',', $detail->payment_options)) ? 'checked="checked"' : '', ['class' => 'field']) }}-->
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            {{ HTML::decode(Form::label('average_price', "Average Price <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('average_price',Input::old('average_price'), array('class' => 'form-control positiveNumber numbers required')) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('parking', "Parking",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                <?php
                                $parking_array = array(
                                    '' => 'Please Select',
                                    '1' => 'Yes',
                                    '0' => 'No'
                                );
                                ?>
                                {{ Form::select('parking', $parking_array, Input::old('parking'), array('class' => 'form-control', 'id'=>'city')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ HTML::decode(Form::label('delivery_type', "Delivery Type",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                <?php
                                $payment_array = array(
                                    '' => 'Please Select',
                                    'free' => 'free',
                                    'paid' => 'paid'
                                );
                                ?>
                                {{ Form::select('delivery_type', $payment_array, Input::old('delivery_type'), array('class' => 'form-control', 'id'=>'select_delivery_type')) }}
                            </div>
                        </div>

                        <div class="form-group" id="delivery_type" style="display:<?php echo $detail->delivery_type == 'paid' ? 'block' : 'none'; ?>">
                            {{ HTML::decode(Form::label('delivery_cost', "Delivery Cost",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('delivery_cost',Input::old('delivery_cost'), array('class' => 'form-control')) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('estimated_time', "Estimated Delivery Time (min or hours) ",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('estimated_time',Input::old('estimated_time'), array('class' => 'form-control')) }} 
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('minimum_order', "Minimum Order Amount",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::text('minimum_order',Input::old('minimum_order'), array('class' => 'positiveNumber form-control','maxlength'=>'16'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ HTML::decode(Form::label('description', "Description",array('class'=>"control-label col-lg-2"))) }}
                            <div class="col-lg-10">
                                {{ Form::textarea('description',Input::old('description'), array('class' => 'form-control'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{  Form::label('profile_image', 'Profile Image',array('class'=>"control-label col-lg-2")) }}
                            <div class="col-lg-10">
                                {{ Form::file('profile_image'); }}
                                <p class="help-block">Supported File Types: gif, jpg, jpeg, png. Max size 2MB.</p>
                            </div>
                        </div>
                        <?php if (file_exists(UPLOAD_FULL_PROFILE_IMAGE_PATH . '/' . $detail->profile_image) && $detail->profile_image != "") { ?>
                            <div class="form-group">
                                {{  Form::label('old_image', 'Current Profile Image',array('class'=>"control-label col-lg-2")) }}
                                <div class="col-lg-10">
                                    {{ HTML::image(DISPLAY_FULL_PROFILE_IMAGE_PATH.$detail->profile_image, '', array('width' => '100px')) }}
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                {{ Form::hidden('old_profile_image', $detail->profile_image, array('id' => '')) }}
                                {{ Form::submit('Update', array('class' => "btn btn-danger",'onclick' => 'return imageValidation();')) }}
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

{{ HTML::style('public/js/chosen/chosen.css'); }}
<!--scripts page-->
{{ HTML::script('public/js/chosen/chosen.jquery.js'); }}
<script type="text/javascript">
    $(".chzn-select").chosen();
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

        var filename = document.getElementById("profile_image").value;

        var filetype = ['jpeg', 'png', 'jpg', 'gif'];
        if (filename != '') {
            var ext = getExt(filename);
            ext = ext.toLowerCase();
            var checktype = in_array(ext, filetype);
            if (!checktype) {
                alert(ext + " file not allowed for Profile Image.");
                document.getElementById("profile_image").value = "";
                return false;
            } else {
                var fi = document.getElementById('profile_image');
                var filesize = fi.files[0].size;
                if (filesize > 2097152) {
                    alert('Maximum 2MB file size allowed for Profile Image.');
                    document.getElementById("profile_image").value = "";
                    return false;
                }
            }
        }
        return true;
    }

</script>
<script>
    $(function(){
        initMap();
    });
    //Google map get location using current location and using search address
    function initMap() {


        var marker = '';
        var map = new google.maps.Map(document.getElementById('map-convas'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });





        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);
       
        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
                ['address_components', 'geometry', 'icon', 'name']);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });


        //get currnet location and set marker
        navigator.geolocation.getCurrentPosition(function (position, marker) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            
            infowindow.setPosition(pos);
             //geocodeLatLng(geocoder, map, infowindow);
            //infowindow.setContent('Location found.');
            //infowindow.open(map,marker);
            map.setCenter(pos);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                map: map
            });
        });

        var componentForm = {
               // sublocality_level_1: 'short_name',
                //street_number: 'long_name',
                //route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'long_name',
                //country: 'long_name',
                postal_code: 'long_name'
              };
        autocomplete.addListener('place_changed', function (event) {
            infowindow.close();
            //marker.setMap(null);
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                  var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
              }
            
//            document.getElementById('pac-input').value = place.name;
            
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
         
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
//        function setupClickListener(id, types) {
//            var radioButton = document.getElementById(id);
//            radioButton.addEventListener('click', function () {
//                autocomplete.setTypes(types);
//            });
//        }

//        setupClickListener('changetype-all', []);
//        setupClickListener('changetype-address', ['address']);
//        setupClickListener('changetype-establishment', ['establishment']);
//        setupClickListener('changetype-geocode', ['geocode']);
//
//        document.getElementById('use-strict-bounds')
//                .addEventListener('click', function () {
//                    console.log('Checkbox clicked! New state=' + this.checked);
//                    autocomplete.setOptions({strictBounds: this.checked});
//                });
    }
    function geocodeLatLng(geocoder, map, infowindow) {
//        var input = document.getElementById('latlng').value;
//        var latlngStr = input.split(',', 2);
        var latlng = {lat: infowindow.position.lat(), lng: infowindow.position.lng()};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
              document.getElementById('pac-input').value = results[0].formatted_address;
              
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
</script>

@stop
