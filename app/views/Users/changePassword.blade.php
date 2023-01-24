@extends('layouts.default')
@section('content')
<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.validator.addMethod("pass", function (value, element) {
        return  this.optional(element) || (/.{8,}/.test(value) && /([0-9].*[a-z])|([a-z].*[0-9])/.test(value));
    }, "Password minimum length must be 8 characters and contain at least 1 number.");

    $("#myform").validate({
        submitHandler: function (form) {
            this.checkForm();

            if (this.valid()) { // checks form for validity
                $('#formloader').show();
                this.submit();
            } else {
                return false;
            }
        }
    });
});
</script>
<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                <div class="informetion_top">
                    <div class="tatils"><span class="personal">Change Password</span></div> 
                    <div class="pery">
                        <div id="formloader" class="formloader" style="display: none;">
                            {{ HTML::image('public/img/loader_large_blue.gif','', array()) }} 
                        </div>
                        {{ View::make('elements.frontEndActionMessage')->render() }}
                        {{ Form::open(array('url' => '/user/changePassword', 'method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}
                        <span class="require redd" style="float: left;width: 100%;">* Please note that all fields that have an asterisk (*) are required. </span>

                        <div class="form_group">
                            {{ HTML::decode(Form::label('old_password', "Old Password <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{  Form::password('old_password',array('type'=>'password','class' => 'required form-control','id'=>"old_password"))}}
                            </div>
                        </div>
                        <div class="form_group">
                            {{ HTML::decode(Form::label('new_password', "New Password <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{  Form::password('new_password',  array('type'=>'password','class' => 'required pass form-control','minlength' => 8, 'maxlength' => '40','id'=>"passwords"))}}
                                <p class="help-block"> Password minimum length must be 8 characters and contain at least 1 number.</p>
                            </div>
                        </div>
                        <div class="form_group">
                            {{ HTML::decode(Form::label('confirm_password', "Confirm Password <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}
                            <div class="in_upt">
                                {{ Form::password('confirm_password',  array('type'=>'password','class' => 'required form-control','maxlength' => '40', 'equalTo' => '#passwords')) }}
                            </div>
                        </div>

                        <div class="form_group">
                            <label>&nbsp;</label>
                            <div class="in_upt in_upt_res spacew">

                                {{ html_entity_decode(HTML::link(HTTP_PATH.'user/myaccount', "Cancel", array('class' => 'btn btn-default'), true)) }}
                                {{ Form::submit('Save', array('class' => "btn btn-primary")) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop


