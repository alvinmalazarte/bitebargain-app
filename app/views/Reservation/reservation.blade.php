@extends('layouts.default')
@section('content')
<link href="{{ URL::asset('public/css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
<!--<link href="{{ URL::asset('public/css/fullcalendar/fullcalendar.print.min.css') }}" rel="stylesheet">-->
<script src="{{ URL::asset('public/js/fullcalendar/moment.min.js') }}"></script>
<script src="{{ URL::asset('public/js/front/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/js/fullcalendar/fullcalendar.js') }}"></script>
<!--<link href="{{ URL::asset('public/css/bootstrap.min.css') }}" rel="stylesheet">-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" ></script>
{{ HTML::script('public/js/front/jquery.bpopup.min.js'); }}
<script>

$(document).ready(function () {


    $('#calendar').fullCalendar({
        defaultDate: new Date(),
//      editable: true,
//      eventLimit: true, // allow "more" link when too many events
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: false,
//            navLinkDayClick: false,
//            navLinkWeekClick: false,
//            dayClick: false,
        events: {
            url: '<?php echo HTTP_PATH . "reservations/ajaxreservation" ?>',
//           data: function () {
//               return {
//                   status: $("#restaurant_status").val()
//               };
//           },
            type: "POST"
        },
        eventClick: function (data, event, view) {
//            console.log(data);
            var start = data.start;
            var start_date = moment(start).format();
//           $('#stage').load("<?php echo HTTP_PATH ?>reservation/reservationstatus/"+start);

            $.ajax({
                type: 'POST',
                url: "<?php echo HTTP_PATH ?>reservation/reservationstatus/" + start_date,
                cache: false,
                beforeSend: function () {
                    $(".all_bg").show();
                },
                complete: function () {
                    $(".all_bg").hide();
                },
                success: function (result)
                {
                   $('.reservation_pop_up').bPopup();
                   $("#reservation_status").html(result);
                }
            });
        },
    });
});</script>

<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                {{ View::make('elements.actionMessage')->render() }}  
                <div class="informetion_top">

                    <div class="pery">                   
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------Reservation Popup--------->
<div class="popup fixed-width reservation_pop_up" style="display:none">
    <div class="ligd">   
        <div class="wrapper_login">

            <div class="order_pop">
                <span class="button b-close">
                    <span>X</span>        
                </span> 
                <div id="reservation_status">
                    

                </div>


            </div>
        </div>
    </div>
</div>

@stop