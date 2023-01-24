
@section('content')
<script src="{{ URL::asset('public/js/jquery.validate.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() { 
        $('#forgot').click(function(){ 

            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           
            var pwd =  $('#password_em').val();
            var conpwd = $('#confirmpwd').val();
           if (pwd.length < 8) {

             $('#password_em').val('');
                $('#err_forpwd').fadeIn();         
                $('#err_forpwd').html('Please enter Min 8 digit or alphabeth');
                $('#err_forpwd').fadeOut(4000);
                $('#err_forpwd').focus();
                return false;

               }
              
               /*if (!pwd.match(/[A-Z]/) ) {
                  $('#password_em').val('');
                     $('#err_forpwd').fadeIn();         
                    $('#err_forpwd').html('Please enter combination of Min 8 digit in which 1 should be number,one should be Capital alphabeth,one should be small alphabeth & one should be symbol');
                    $('#err_forpwd').fadeOut(4000);
                    $('#err_forpwd').focus();
                    return false;
                } 
                 if ( !pwd.match(/\d/) ) {
                  $('#password_em').val('');
                     $('#err_forpwd').fadeIn();         
                    $('#err_forpwd').html('Please enter combination of Min 8 digit in which 1 should be number,one should be Capital alphabeth,one should be small alphabeth & one should be symbol');
                    $('#err_forpwd').fadeOut(4000);
                    $('#err_forpwd').focus();
                    return false;
                } */
		if($.trim(conpwd)=="")
		 { 
		    $('#confirmpwd').val('');
		    $('#err_forcopwd').fadeIn();         
		    $('#err_forcopwd').html('Please enter confirm password.');
		    $('#err_forcopwd').fadeOut(4000);
		    $('#err_forcopwd').focus();
		    return false;
		 }
                 if (pwd !== conpwd)
                {
                   //$('#password_em').val('');
                     $('#err_forcopwd').fadeIn();         
                    $('#err_forcopwd').html('Current password is not matching to confirm password please enter confirm password same as Current password');
                    $('#err_forcopwd').fadeOut(4000);
                    $('#err_forcopwd').focus();
                    return false;
                } 
                 



        });
        $.validator.addMethod("pass", function(value, element) {
            return  this.optional(element) || (/.{8,}/.test(value) && /([0-9].*[a-z])|([a-z].*[0-9])/.test(value));
        }, "Password minimum length must be 8 characters and combination of 1 special character, 1 lowercase character, 1 uppercase character and 1 number.");
        $("#myform").validate({
            submitHandler: function(form) {
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
<section>
    <div class="container">
        <div class="signup_wrapper">
            <div class="col-8 mx-auto my-5">
                <div class="signup_bx">
                    <div id="formloader" class="formloader" style="display: none;">
                        {{ HTML::image('public/img/loader_large_blue.gif','', array()) }}
                    </div>
                    <div class="signup_tops"></div>
                    <div class="login_bg_bottom">
                        <h4 class="mb-4"><b>Reset Password on {{ SITE_TITLE }}</b></h4>
                    </div>
                     @if(Session::has('error_message'))
                        <div class="alert alert-danger" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {{Session::get('error_message')}}
                        </div>
                    @endif
      
                    {{ View::make('elements.frontEndActionMessage')->render() }}
                    {{ Form::open(array('method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}
                    <div class="logiv">
<!--                        <span class="require" style="float: left;width: 100%;">* Please note that all fields that have an asterisk (*) are required. </span>-->
                        <div class="form-group">
<!--                            {{ HTML::decode(Form::label('password', "New Password <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}-->
                            {{  Form::password('password',  array('type'=>'password','class' => 'required pass form-control','placeholder' => 'New Password','minlength' => 8, 'maxlength' => '40','id'=>"password_em"))}}
                            <div class="error" id="err_forpwd" style="color:red;" ></div>
                            <p class="help-block my-2"> Please enter Min 8 digit or alphabeth.</p>
                        </div>
                        <div class="form-group">
<!--                            {{ HTML::decode(Form::label('cpassword', "Confirm Password <span class='require'>*</span>",array('class'=>"control-label col-lg-2"))) }}-->
                            {{ Form::password('cpassword',  array('type'=>'password','class' => 'required form-control','placeholder' => 'Confirm Password','maxlength' => '40', 'equalTo' => '#password_em','id'=>"confirmpwd")) }}
                        </div>
                          <div class="error" id="err_forcopwd" style="color:red;" ></div>
                        <div class="form-group">
                           <!-- {{ Form::submit('Submit', array('class' => "btn btn-danger forgot")) }}-->
                            <input type="submit" class="btn btn-danger" id="forgot" value="submit">
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>


            </div>
        </div>
<!--        <div class="emploar"><img src="{{ URL::asset('public/img/front/') }}/emploays.png" alt="" /></div>-->
    </div>
</section>
@stop
