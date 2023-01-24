@extends('layouts.default')
@section('content')
{{ HTML::script('public/js/jquery.validate.js'); }}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#myform").validate();
});
</script>
<?php if (isset($bankAccount->slug)) { ?>
    {{ Form::model($bankAccount, array('url' => '/user/editAccount/'.$bankAccount->slug, 'method' => 'post', 'id' => 'myform','class'=>"cmxform form-horizontal tasi-form form")) }}
<?php } else { ?>
    {{ Form::model($bankAccount, array('url' => '/user/editAccount/newins', 'method' => 'post', 'id' => 'myform','class'=>"cmxform form-horizontal tasi-form form")) }}
<?php } ?>
<div id="right_content">
    <div class="right_content">
        <div class="content_nav">
            <div class="navbar_tab " >
                <ul>
                    <li><a href="<?php echo HTTP_PATH . 'user/myaccount'; ?>">profile</a></li>
                    <li><a class="active" href="<?php echo HTTP_PATH . 'user/bankaccount'; ?>">bank account</a></li>
                    <li><a href="<?php echo HTTP_PATH . 'user/openinghours'; ?>">operating hours</a></li>
                    <li class="save menubtn hidden-xs"><a href="javascript:void(0)" class="saveprofile">save</a></li>
                    <li class="cancel menubtn hidden-xs"><a href="{{HTTP_PATH.'user/bankaccount'}}">Cancel</a></li>
                </ul>   
            </div> 
        </div>    
        <div class="detail_box">
            {{ View::make('elements.actionMessage')->render() }}
            <div class="roww edit_profile ">
                <div class=" mobilebtn">
                    <div class="save menubtn"><a href="javascript:void(0)" class="saveprofile" >save</a></div>
                    <div class="cancel menubtn"><a href="{{HTTP_PATH.'user/bankaccount'}}">Cancel</a></div>
                </div>
                <div class="block">
                    <div class="title_name">Routing Number</div>
                    <div class="single"><div class="digitt">{{ Form::text('routing',Input::old('routing'), array('class' => 'form-control number required'))}}</div></div>
                </div>
                <div class="block">
                    <div class="title_name">Account Number</div>
                    <div class="single"> <div class="digitt">{{ Form::text('account',Input::old('account'), array('class' => 'form-control number required'))}}</div></div>
                </div>
                <div class="block">
                    <div class="title_name">Business Tax ID (EIN)</div>
                    <div class="single"><div class="digitt">{{ Form::text('business_tax',Input::old('business_tax'), array('class' => 'form-control required'))}}</div></div>
                </div>
            </div> 
            <div class="roww edit_profile">
                <div class="block">
                    <div class="title_name">First Name</div>
                    <div class="single"><div class="digitt">{{ Form::text('first_name',Input::old('first_name'), array('class' => 'form-control required'))}}</div></div>
                </div>
                <div class="block">
                    <div class="title_name">Last Name</div>
                    <div class="single"> <div class="digitt">{{ Form::text('last_name',Input::old('last_name'), array('class' => 'form-control required'))}}</div></div>
                </div>
                <div class="block">
                    <div class="title_name">Date Of Birth</div>
                    <div class="single"><div class="digitt">{{ Form::text('dob',Input::old('dob'), array('class' => 'form-control required','id'=>'datepicker'))}}<a class="pull-right"><i class="fa fa-calendar"></i></a></div></div>
                </div>
                <div class="block">
                    <div class="title_name">Last 4 Digits Of SSN</div>
                    <div class="single"><div class="digitt">{{ Form::text('ssn',Input::old('ssn'), array('class' => 'form-control number required','maxlength'=>'4'))}}</div></div>
                </div>
            </div> 
        </div>   
    </div>   
</div>
{{ Form::close() }}
<script>
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
	    changeYear: true,
	    dateFormat: 'dd/mm/yy',
	    maxDate: '0',
            yearRange: '1980:2010'
        });
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.saveprofile', function () {
        $("#myform").submit();
    });
</script>
@stop


