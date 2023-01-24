@section('title', 'Administrator :: '.TITLE_FOR_PAGES.'Restaurants List')
@extends('layouts/adminlayout')
@section('content')
 <link href="{{ URL::asset('public/css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
 <!--<link href="{{ URL::asset('public/css/fullcalendar/fullcalendar.print.min.css') }}" rel="stylesheet">-->
<script src="{{ URL::asset('public/js/fullcalendar/moment.min.js') }}"></script>
<script src="{{ URL::asset('public/js/front/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/js/fullcalendar/fullcalendar.js') }}"></script>
 <!--<link href="{{ URL::asset('public/css/bootstrap.min.css') }}" rel="stylesheet">-->

<script>

  $(document).ready(function() {

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
                url: '<?php echo HTTP_PATH . "admin/reservations/Admin_reservation" ?>',
                data: function () {
                    return {
                        status: $("#restaurant_status").val()
                    };
                },
                type: "POST"
            }
            });

  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
      float: left;
    width: 100%;
  }
 

</style>
<?php
if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
    $search = $_REQUEST['search'];
} else {
    $search = "";
}
if (isset($_REQUEST['from_date']) && !empty($_REQUEST['from_date'])) {
    $_REQUEST['from_date'];

    $from_date = date('d-m-y', strtotime($_REQUEST['from_date']));
} else {
    $from_date = "";
}
if (isset($_REQUEST['to_date']) && !empty($_REQUEST['to_date'])) {
    $to_date = date('d-m-y', strtotime($_REQUEST['to_date']));
} else {
    $to_date = "";
}
$Arry = array(
    '' => 'Please select type',
    'Attended' => 'Attended Reservation',
    'Upcoming' => 'Upcoming Reservation',
    'No show' => 'No show Reservation',
    'Canceled' => 'Canceled Reservation'
);
//print_r($search_keyword);die;
?>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ul id="breadcrumb" class="breadcrumb">
                    <li>
                        {{ html_entity_decode(HTML::link(HTTP_PATH.'admin/admindashboard', '<i class="fa fa-dashboard"></i> Dashboard' , array('id' => ''), true)) }}
                    </li>
                    <li>
                        <i class="fa fa-ticket"></i> Reservations
                    </li>
                    <li class="active">Reservations List</li>
                </ul>
                <section class="panel">
                    <header class="panel-heading">
                        Search Reservations
                    </header>
                    <div class="panel-body">
                        {{ View::make('elements.actionMessage')->render() }}
                        {{ Form::open(array('url' => 'admin/reservations/admin_index', 'method' => 'post', 'id' => 'adminAdd', 'files' => true,'class'=>'form-inline')) }}
                        <div class="form-group align_box">
                            <label class="sr-only" for="search">Your Keyword</label>
                            <!--{{ Form::text('search', $search, array('class' => 'required search_fields form-control','placeholder'=>"Your Keyword")) }}-->
                            {{Form::select('restaurant_status',$Arry,$search_keyword,array('class'=>'form-control chosen-select','id'=>'restaurant_status'))}}
                        </div>
                        <span class="hint" style="margin:5px 0">Search Reservations by typing their status</span>
                        {{ Form::submit('Search', array('class' => "btn btn-success")) }}
                        {{ Form::close() }}
                    </div>
                </section>
            </div>
        </div>
        <div id="middle-content">
            @include('Reservation/ajax_index')
        </div>
    </section>
</section>
@stop