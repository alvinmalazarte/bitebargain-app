@extends('layouts.default')
@section('content')
{{ HTML::script('public/js/jquery.validate.js'); }}
{{ HTML::script('public/js/bootstrap-inputmask.min.js'); }}
{{ HTML::style('public/css/front/chosen.css'); }}
{{ HTML::script('public/js/front/chosen.jquery.js'); }}
{{ HTML::script('public/js/front2/jquery.bpopup.min.js'); }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" ></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#myform").validate();
    $(".chosen-select").chosen({width: '100%'});
    $.validator.addMethod("contact", function (value, element) {
        return  this.optional(element) || (/^[0-9-]+$/.test(value));
    }, "Contact Number is not valid.");
    $.validator.addMethod('numbers', function (value, element) {
        return this.optional(element) || /^\d+(\.\d{0,2})?$/.test(value);
    }, "Please enter a correct number, format xxxx.xx");
    $.validator.addMethod('positivecommision',
            function (value) {
                return Number(value) >= 0 && Number(value) <= 100;
            }, 'Entered valid commision.');
});
</script>
<script>
    $(document).on('keypress', '.positiveNumber', function (event) {
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
{{ Form::model($userData, array('url' => '/user/editProfile', 'method' => 'post', 'id' => 'myform','class'=>"cmxform form-horizontal tasi-form form")) }}
<div id="right_content">
    <div class="right_content">
        <div class="content_nav">
            <div class="navbar_tab " >
                <ul>
                    <li><a class="active" href="<?php echo HTTP_PATH . 'user/myaccount'; ?>">profile</a></li>
                    <li><a href="<?php echo HTTP_PATH . 'user/bankaccount'; ?>">bank account</a></li>
                    <li><a href="<?php echo HTTP_PATH . 'user/openinghours'; ?>">operating hours</a></li>
                    <li class="save menubtn hidden-xs"><a href="javascript:void(0)" class="saveprofile">save</a></li>
                    <li class="cancel menubtn hidden-xs"><a href="{{HTTP_PATH.'user/myaccount'}}">Cancel</a></li>
                </ul>   
            </div> 
        </div>    
        <div class="detail_box">
            {{ View::make('elements.actionMessage')->render() }}
            <div class="roww edit_profile">
                <div class=" mobilebtn">
                    <div class="save menubtn"><a href="javascript:void(0)" class="saveprofile" >save</a></div>
                    <div class="cancel menubtn"><a href="{{HTTP_PATH.'user/myaccount'}}">Cancel</a></div>
                </div>
                <div class="block">
                    <div class="title_name">restaurant name</div>
                    <div class="digitt">{{ $userData->first_name ? $userData->first_name :'' }}</div>

                </div>
                <div class="block">
                    <div class="title_name">email</div>
                    <div class="digitt"> {{ $userData->email_address ? $userData->email_address:''}}</div>

                </div>
                <div class="block">
                    <div class="title_name">phone#1</div>
                    <div class="digitt">{{ $userData->phone1 ? $userData->phone1:''}}</div>

                </div>
                <div class="block">
                    <div class="title_name">phone#2</div>
                    <div class="digitt bg_none"> {{ Form::text('phone2',Input::old('phone2'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}</div>

                </div>
                <div class="block">
                    <div class="title_name">phone#3</div>
                    <div class="digitt bg_none">  {{ Form::text('phone3',Input::old('phone3'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}</div>

                </div>
                <div class="block">
                    <div class="title_name">phone#4</div>
                    <div class="digitt bg_none"> {{ Form::text('phone4',Input::old('phone4'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}</div>

                </div>
                <div class="block">
                    <div class="title_name">cell#1</div>
                    <div class="digitt bg_none">{{ Form::text('cell_phone1',Input::old('cell_phone1'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}</div>

                </div>
                <div class="block">
                    <div class="title_name">cell#2</div>
                    <div class="digitt bg_none"> {{ Form::text('cell_phone2',Input::old('cell_phone2'), array('class' => 'form-control','data-mask' => '999-999-9999'))}}</div>

                </div>
                <div class="block">
                    <div class="title_name">fax#1</div>
                    <div class="digitt">{{ $userData->fax_number ? $userData->fax_number:'N/A'}}</div>

                </div>

            </div> 
            <div class="roww edit_profile full">
                <div class="block">
                    <div class="title_name">address</div>
                    <div class="single"><div class="digitt"> {{ $userData->address ? $userData->address:''}}</div></div>

                </div>
                <div class="block">
                    <div class="title_name">city</div>
                    <div class="single"> <div class="digitt"> {{ $userData->city ? $userData->city:''}}</div></div>

                </div>
                <div class="block">
                    <div class="title_name">state</div>
                    <div class="single"><div class="digitt">  {{ $userData->state ? $userData->state:''}}</div></div>

                </div>
                <div class="block">
                    <div class="title_name">zipcode</div>
                    <div class="single"> <div class="digitt">   {{ $userData->zipcode ? $userData->zipcode:''}}</div></div>
                </div>
            </div> 
            <div class="roww edit_profile">
                <div class="block fullfiled">
                    <div class="title_name">services offered</div>
                    <?php
                    if ($userData->service_offered) {
                        $service_array = explode(',', $userData->service_offered);
                        if ($service_array) {
                            foreach ($service_array as $service_arrays) {
                                echo "<div class='single'><div class='digitt'>" . $service_arrays . "</div></div>";
                            }
                        }
                    } else {
                        echo "<div class='digitt'>N/A</div>";
                    }
                    ?>
                </div>
                <div class="block">
                    <div class="title_name">restaurant category</div>
                    <div class="" id="restaurant_add">
                        <?php
                        if ($userData->restaurant_cat) {
                            $restaurant_cat = explode(',', $userData->restaurant_cat);
                            if ($restaurant_cat) {
                                foreach ($restaurant_cat as $restaurant_cats) {
                                    echo "<div class='single'><div class='digitt'>" . $restaurant_cats . "</div><a class='close_icon' href='javascript:void(0)' data-classid='restaurant_cat'><i class='fa fa-times'></i></a></div>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <input type="hidden" id="restaurant_cat" name="restaurant_cat" value="{{$userData->restaurant_cat}}" />
                    <div class="single"> <div class="category_btn"><a id="addcategory" href="javascript:void(0)"> + Add Category</a></div> </div>
                </div>
                <div class="block full_view">
                    <div class="title_name">cuisines</div>
                    <div class="" id="cusines_add">
                        <?php
                        if ($userData->cuisines) {
                            $cuisines = explode(',', $userData->cuisines);
                            $cusines_length = count($cuisines);
                            //echo $cusines_length;
                            if ($cuisines) {
                                foreach ($cuisines as $cuisiness) {
                                    echo "<div class='single'><div class='digitt'>" . $cuisiness . "</div><a class='close_icon' href='javascript:void(0)' data-classid='cuisinesa'><i class='fa fa-times'></i></a></div>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <input type="hidden" id="cuisinesa" name="cuisines"  value="{{$userData->cuisines}}" />
                    <div class="single"> <div class="category_btn"><a id="addcusine" href="javascript:void(0)"> + Add Cuisines</a></div> </div>
                </div>

                <div class="block">
                    <div class="title_name">payment options</div>
                    <div id="paymentadd">
                        <?php
                        if ($userData->payment_options) {
                            $payment_options = explode(',', $userData->payment_options);
                            if ($cuisines) {
                                foreach ($payment_options as $payment_optionss) {
                                    echo "<div class='single'><div class='digitt'>" . $payment_optionss . "</div><a class='close_icon' href='javascript:void(0)' data-classid='payment_options'><i class='fa fa-times'></i></a></div>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <input type="hidden" id="payment_options" name="payment_options" value="{{$userData->payment_options}}" />
                    <div class="single"> <div class="category_btn"><a id="addpayment" href="javascript:void(0)"> + Add Payment</a></div> </div>
                </div>

            </div>
            <div class="roww height_box bordiv_div">
                <div class="block">
                    <div class="title_name">sales tax</div>
                    <div class="single"><div class="digitt bg"> {{ Form::text('sales_tax',Input::old('sales_tax'), array('class' => 'required form-control positiveNumber numbers positivecommision')) }}  <span class="pull-right"><?php echo PER; ?></span></div></div> </div>
                <div class="block">
                    <div class="title_name">average price</div>
                    <div class="single"> <div class="digitt"> {{ Form::text('average_price',Input::old('average_price'), array('class' => 'required form-control positiveNumber numbers')) }}  <span class="pull-right"><?php echo CURR; ?></span></div></div></div>
                <div class="block">
                    <div class="title_name">parking</div>

                    <div class="select_drop">
                        <ul class="list-unstyled" id="parking">
                            <?php
                            $parking_array = array(
                                'Yes' => 'Yes',
                                'No' => 'No'
                            );
                            ?>
                            <li class="init">{{$userData->parking ? $userData->parking : "select"}}</li>
                            <?php
                            if ($parking_array) {
                                foreach ($parking_array as $parking_arrays) {
                                    $select = $userData->parking == $parking_arrays ? 'selected' : '';
                                    $style = $userData->parking ? 'none' : 'none';
                                    echo '<li data-value = "' . $parking_arrays . '" class = "first_child ' . $select . '" style="display:' . $style . '">' . $parking_arrays . '</li>';
                                }
                            }
                            ?>
                        </ul>
                        <input type="hidden" class="parking" name="parking" value="{{$userData->parking}}">
                    </div>
                </div>


                <div class="block">
                    <div class="title_name">delivery option</div>
                    <div class="single">    
                        <div class="select_drop">
                            <ul class="list-unstyled" id="deliver">
                                <?php
                                $payment_array = array(
                                    'Free' => 'Free',
                                    'Paid' => 'Paid'
                                );
                                ?>
                                <li class="init">{{$userData->delivery_type ? $userData->delivery_type : "select"}}</li>

                                <?php
                                if ($payment_array) {
                                    foreach ($payment_array as $payment_arrays) {
                                        $select = $userData->delivery_type == $payment_arrays ? 'selected' : '';
                                        $style = $userData->delivery_type ? 'none' : 'none';
                                        echo '<li data-value = "' . $payment_arrays . '" class = "first_child ' . $select . '" style="display:' . $style . '">' . $payment_arrays . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                            <input type="hidden" class="delivery_type" name="delivery_type" value="{{$userData->delivery_type}}">
                        </div>
                    </div>
                </div>
                <div class="block" id="delivery_type" style="display:<?php echo $userData->delivery_type == 'paid' ? 'block' : 'none'; ?>">
                    <div class="title_name">delivery cost</div>
                    <div class="single"><div class="digitt"> {{ Form::text('delivery_cost',Input::old('delivery_cost'), array('class' => 'form-control')) }} <span class="pull-right"><?php echo CURR; ?></span></div></div>
                </div>
                <div class="block">
                    <div class="title_name">est.delivery time</div>
                    <div class="single"><div class="digitt"> {{ Form::text('estimated_time',Input::old('estimated_time'), array('class' => 'form-control')) }} </div></div></div>
                <div class="block">
                    <div class="title_name">min.order</div>
                    <div class="single"><div class="digitt">  {{ Form::text('minimum_order',Input::old('minimum_order'), array('class' => 'positiveNumber form-control','maxlength'=>'16'))}}<span class="pull-right"><?php echo CURR; ?></span></div></div>
                </div>
                <div class="block full_block">
                    <div class="title_name">Description</div>
                    <div class="single"><div class="digitt">  {{ Form::textarea('description',Input::old('description'), array('class' => 'form-control'))}}</div></div></div>
            </div>
        </div>   
    </div>   
</div>
</div>

{{ Form::close() }}
<div class="popup fixed-width cusine-window">
    <div class="ligd">
        <div class="pop_top">
        <span class="button b-close">
            <span>X</span>        
        </span>
       
        <h2>Cuisines</h2></div>
        <?php
        $array_cuisine = array();
        $cuisines = DB::table('admin_cuisine')
                ->where('status', 1)
                ->orderby('name', 'ASC')
                ->get();

        foreach ($cuisines as $cuisine) {
            $array_cuisine[$cuisine->name] = ucwords($cuisine->name);
        }

        $oldrcat = explode(',', $userData->cuisines);
        //   echo '<pre>'; print_r($oldrcat);die;
        foreach ($oldrcat as $value) {
            $oldrcat_Arry[$value] = $value;
        }
        ?>
        <div class="form_group">
            <div class="in_upt">
                <div class="cus_drop"> 
                    {{Form::select('cuisines[]',$array_cuisine,$oldrcat_Arry,array('class'=>'required form-control chosen-select ', 'id'=>'cusineselect','multiple' => 'multiple'))}}
                </div>
            </div>
            <div class="po_btn"> <a href="javascript:void(0)" class="cusine_list">Submit</a></div>
        </div>
    </div>
    <div class="over-bg"></div>
</div>

<div class="popup fixed-width category-window">
    <div class="ligd">
        <div class="pop_top">
        <span class="button b-close">
            <span>X</span>        
        </span>
        
        <h2>Restaurant Category</h2></div>
        <?php
        global $rest_Type;
        $oldrcat_Arry = array();
        $oldrcat = array();
        $oldrcat = explode(',', $userData->restaurant_cat);
        foreach ($oldrcat as $value) {
            $oldrcat_Arry[$value] = $value;
        }
        ?>

        <div class="form_group">
            <div class="in_upt">
                <div class="cus_drop"> 
                    {{Form::select('restaurant_cat[]',$rest_Type,$oldrcat_Arry,array('class'=>'form-control chosen-select','id'=>'cateselect','multiple' => 'multiple'))}}
                </div>
            </div>
            <div class="po_btn"><a href="javascript:void(0)" class="category_list">Submit</a></div>
        </div>
    </div>
    <div class="over-bg"></div>
</div>

<div class="popup fixed-width payment-window">
    <div class="ligd">
        <div class="pop_top">
        <span class="button b-close">
            <span>X</span>        
        </span>
       
        <h2>Payment Options</h2></div>
        <?php
        global $payment_option;
        $oldrcat_Arry = array();
        $oldrcat = array();
        $oldrcat = explode(',', $userData->payment_options);
        foreach ($oldrcat as $value) {
            $oldrcat_Arry[$value] = $value;
        }
        ?>
        <div class="form_group">
            <div class="in_upt">
                <div class="cus_drop"> 
                    {{Form::select('payment_options[]',$payment_option,$oldrcat_Arry,array('class'=>'form-control chosen-select','id'=>'paymentselect','multiple' => 'multiple'))}}
                </div>
            </div>
            <div class="po_btn"> <a href="javascript:void(0)" class="payment_list">Submit</a></div>
        </div>
    </div>
    <div class="over-bg"></div>
</div>

<script>
    $(document).on('click', '.close_icon', function () {
        var value = $(this).parent().children('div').html();
        var a = $(this).data('classid');
        var data = $('#' + a).val();
        console.log(a);
        var array = new Array();
        array = data.toString().split(",");
        array = $.grep(array, function (n, i) {
            return (n !== value);
        });
        $('#' + a).val(array);
        $(this).parents('.single').remove();
    });
</script>

<script>
    $(document).on('click', '#addcusine', function () {
        $(".all_bg").hide();
        var popup_box = "cusine-window";
        $('.' + popup_box).bPopup({
            easing: 'easeOutBack', //uses jQuery easing plugin
            speed: 700,
            modalClose: false,
            transition: 'slideBack',
            transitionClose: "slideIn",
            modalColor: false
        });
    });

    $(document).on('click', '#addcategory', function () {
        $(".all_bg").hide();
        var popup_box = "category-window";
        $('.' + popup_box).bPopup({
            easing: 'easeOutBack', //uses jQuery easing plugin
            speed: 700,
            modalClose: false,
            transition: 'slideBack',
            transitionClose: "slideIn",
            modalColor: false
        })
    });

    $(document).on('click', '#addpayment', function () {
        $(".all_bg").hide();
        var popup_box = "payment-window";
        $('.' + popup_box).bPopup({
            easing: 'easeOutBack', //uses jQuery easing plugin
            speed: 700,
            modalClose: false,
            transition: 'slideBack',
            transitionClose: "slideIn",
            modalColor: false
        })
    });

</script>

<script>
    $(document).on('click', '.cusine_list', function () {
        $('.cusine-window').bPopup().close();
        var cusines = $('#cusineselect').val();
        var array = new Array();
        if (cusines) {
            array = cusines.toString().split(",");
        }
        $('#cuisinesa').val(array);
//        console.log(array);
        var html = '';
        $.each(array, function (key, value) {
            html += "<div class='single'><div class='digitt'>" + value + "</div><a class='close_icon' href='javascript:void(0)' data-classid='cuisinesa'><i class='fa fa-times'></i></a></div>";
        });

        $('#cusines_add').html(html);
    });

    $(document).on('click', '.category_list', function () {
        $('.category-window').bPopup().close();
        var cusines = $('#cateselect').val();
        var array = new Array();
        if (cusines) {
            array = cusines.toString().split(",");
        }
        // console.log(array);
        $('#restaurant_cat').val(array);
        var html = '';
        $.each(array, function (key, value) {
            html += "<div class='single'><div class='digitt'>" + value + "</div><a class='close_icon' href='javascript:void(0)' data-classid='restaurant_cat'><i class='fa fa-times'></i></a></div>";
        });

        $('#restaurant_add').html(html);
    });

    $(document).on('click', '.payment_list', function () {
        $('.payment-window').bPopup().close();
        var cusines = $('#paymentselect').val();
        var array = new Array();
        if (cusines) {
            array = cusines.toString().split(",");
        }
        //   console.log(array);
        $('#payment_options').val(array);
        var html = '';
        $.each(array, function (key, value) {
            html += "<div class='single'><div class='digitt'>" + value + "</div><a class='close_icon' href='javascript:void(0)' data-classid='payment_options'><i class='fa fa-times'></i></a></div>";
        });

        $('#paymentadd').html(html);
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.saveprofile', function () {
        $("#myform").submit();
    });
</script>
@stop


