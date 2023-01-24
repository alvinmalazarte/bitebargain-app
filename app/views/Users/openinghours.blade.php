@extends('layouts.default')
@section('content')

<div id="right_content">
    <div class="right_content">

        <div class="content_nav">
            <div class="navbar_tab" >
                <ul>
                    <li><a href="<?php echo HTTP_PATH . 'user/myaccount'; ?>">profile</a></li>
                    <li><a href="<?php echo HTTP_PATH . 'user/bankaccount'; ?>">bank account</a></li>
                    <li><a class="active" href="<?php echo HTTP_PATH . 'user/openinghours'; ?>">operating hours</a></li>
<!--                    <li><a class="iconn hidden-xs" href="#"><i class="fa fa-pencil"></i></a></li>-->
                    <li class="right_icon hidden-xs"></li>
                </ul>   
            </div> 
        </div>    

        <div class="status_bar">
            <div class="starustitl">status</div>    
            <div class="<?php
            if ($opening_hours->open_close == '1') {
                echo 'btn_online';
            } else {
                echo 'btn_offline';
            }
            ?>">
                <a href="javascript:void(0)" id="update_status" data-val="<?php
                if ($opening_hours->open_close == '1') {
                    echo '0';
                } else {
                    echo '1';
                }
                ?>"  title="<?php
                   if ($opening_hours->open_close == '1') {
                       echo 'Click to change status offline';
                   } else {
                       echo 'Click to change status online';
                   }
                   ?>">
                       <?php
                       if ($opening_hours->open_close == '1') {
                           echo 'online';
                       } else {
                           echo 'offline';
                       }
                       ?>
                </a>
            </div>
        </div>

        <?php
        if(!empty($day_hours)){
        foreach ($day_hours as $day_hour) {
            if ($day_hour->day == 'mon') {
                $mon = $day_hour;
            } elseif(!isset($mon))
            {
                $monarr = array('day'=>'mon', 'user_id'=>$opening_hours->user_id, 'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $mon = new ArrayObject($monarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            }
                
            if ($day_hour->day == 'tue') {
                $tue = $day_hour;
            } elseif(!isset($tue)) {
                $tuearr = array('day'=>'tue', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $tue = new ArrayObject($tuearr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            }
                
            if ($day_hour->day == 'wed') {
                $wed = $day_hour;
            } elseif(!isset($wed)) {
                $wedarr = array('day'=>'wed', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $wed = new ArrayObject($wedarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            }
                
            if ($day_hour->day == 'thu') {
                $thu = $day_hour;
            } elseif(!isset($thu)) {
                $thuarr = array('day'=>'thu', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $thu = new ArrayObject($thuarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            }
                
            if ($day_hour->day == 'fri') {
                $fri = $day_hour;
            } elseif(!isset($fri)) {
                $friarr = array('day'=>'fri', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $fri = new ArrayObject($friarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            }
                
            if ($day_hour->day == 'sat') {
                $sat = $day_hour;
            } elseif(!isset($sat)) {
                $satarr = array('day'=>'sat', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $sat = new ArrayObject($satarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            }   
            
            if ($day_hour->day == 'sun') {
                $sun = $day_hour;
            } elseif(!isset($sun)) {
                $sunarr = array('day'=>'sun', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
                $sun = new ArrayObject($sunarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            } 
        }
        }
        else
        {
            $monarr = array('day'=>'mon', 'user_id'=>$opening_hours->user_id, 'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $mon = new ArrayObject($monarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            $tuearr = array('day'=>'tue', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $tue = new ArrayObject($tuearr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            $wedarr = array('day'=>'wed', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $wed = new ArrayObject($wedarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            $thuarr = array('day'=>'thu', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $thu = new ArrayObject($thuarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            $friarr = array('day'=>'fri', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $fri = new ArrayObject($friarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            $satarr = array('day'=>'sat', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $sat = new ArrayObject($satarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
            $sunarr = array('day'=>'sun', 'user_id'=>$opening_hours->user_id,'start_time'=>'00:00', 'end_time'=>'00:00', 'status'=>'0','open_id'=>$opening_hours->id);
            $sun = new ArrayObject($sunarr, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
        }
        ?>

        <div class="detail_box">
            <div class="week_box <?php
            if ($mon->status == 0) {
                echo 'offline';
            } else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Monday</span>    
                    <div class="time" id="tm_mon"><?php echo date("g:i a", strtotime($mon->start_time)); ?>- <?php echo date("g:i a", strtotime($mon->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$mon->user_id}}" data-day="{{'mon'}}" data-open_id="{{$mon->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $mon->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $mon->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                    <a href="javascript:void(0);" id="update_day" data-user_id="{{$mon->user_id}}" data-day="{{'mon'}}" data-open_id="{{$mon->open_id}}" class="update_day" data-val="{{$mon->status ? '0':'1'}}">
                        <?php
                        if ($mon->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
            <div class="week_box pull-right <?php
            if ($tue->status == 0) {
                echo 'offline';
            } else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Tuesday</span>    
                    <div class="time" id="tm_tue"><?php echo date("g:i a", strtotime($tue->start_time)); ?>- <?php echo date("g:i a", strtotime($tue->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$tue->user_id}}" data-day="{{'tue'}}" data-open_id="{{$tue->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $tue->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $tue->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                    <a href="javascript:void(0);" data-user_id="{{$tue->user_id}}" data-day="{{'tue'}}" data-open_id="{{$tue->open_id}}" class="update_day" data-val="{{$tue->status ? '0':'1'}}">
                        <?php
                        if ($tue->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
            <div class="week_box <?php
            if ($wed->status == 0) {
                echo 'offline';
            } else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Wednesday</span>    
                    <div class="time" id="tm_wed"><?php echo date("g:i a", strtotime($wed->start_time)); ?>- <?php echo date("g:i a", strtotime($wed->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$wed->user_id}}" data-day="{{'wed'}}" data-open_id="{{$wed->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $wed->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $wed->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                    <a href="javascript:void(0);" data-user_id="{{$wed->user_id}}" data-day="{{'wed'}}" data-open_id="{{$wed->open_id}}" class="update_day" data-val="{{$wed->status ? '0':'1'}}">
                        <?php
                        if ($wed->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
            <div class="week_box pull-right <?php
            if ($thu->status == 0) {
                echo 'offline';
            } else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Thursday</span>    
                    <div class="time" id="tm_thu"><?php echo date("g:i a", strtotime($thu->start_time)); ?>- <?php echo date("g:i a", strtotime($thu->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$thu->user_id}}" data-day="{{'thu'}}" data-open_id="{{$thu->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $thu->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $thu->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                    <a href="javascript:void(0);" data-user_id="{{$thu->user_id}}" data-day="{{'thu'}}" data-open_id="{{$thu->open_id}}" class="update_day" data-val="{{$thu->status ? '0':'1'}}">
                        <?php
                        if ($thu->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
            <div class="week_box <?php
            if ($fri->status == 0) {
                echo 'offline';
            } else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Friday</span>    
                    <div class="time" id="tm_fri"><?php echo date("g:i a", strtotime($fri->start_time)); ?>- <?php echo date("g:i a", strtotime($fri->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$fri->user_id}}" data-day="{{'fri'}}" data-open_id="{{$fri->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $fri->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $fri->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                    <a href="javascript:void(0);" data-user_id="{{$fri->user_id}}" data-day="{{'fri'}}" data-open_id="{{$fri->open_id}}" class="update_day" data-val="{{$fri->status ? '0':'1'}}">
                        <?php
                        if ($fri->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
            <div class="week_box pull-right <?php
            if ($sat->status == 0) {
                echo 'offline';
            } else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Saturday</span>    
                    <div class="time" id="tm_sat"><?php echo date("g:i a", strtotime($sat->start_time)); ?>- <?php echo date("g:i a", strtotime($sat->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$sat->user_id}}" data-day="{{'sat'}}" data-open_id="{{$sat->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $sat->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $sat->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                      <a href="javascript:void(0);" data-user_id="{{$sat->user_id}}" data-day="{{'sat'}}" data-open_id="{{$sat->open_id}}" class="update_day" data-val="{{$sat->status ? '0':'1'}}">
                        <?php
                        if ($sat->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
            <div class="week_box <?php
            if ($sun->status == 0) {
                echo 'offline';
            }  else {
                echo 'online';
            }
            ?>">
                <div class="week_top_row">
                    <span>Sunday</span>    
                    <div class="time" id="tm_sun"><?php echo date("g:i a", strtotime($sun->start_time)); ?>- <?php echo date("g:i a", strtotime($sun->end_time)); ?></div>
                </div> 
                <div class="demo-output">
                    <input class="range-slider" data-user_id="{{$sun->user_id}}" data-day="{{'sun'}}" data-open_id="{{$sun->open_id}}" type="hidden" value="<?php
                    $stm = explode(":", $sun->start_time);
                    echo $stm[0];
                    ?>,<?php
                           $etm = explode(":", $sun->end_time);
                           echo $etm[0];
                           ?>"/>
                </div>

                <div class="wek_btn">
                   <a href="javascript:void(0);" data-user_id="{{$sun->user_id}}" data-day="{{'sun'}}" data-open_id="{{$sun->open_id}}" class="update_day" data-val="{{$sun->status ? '0':'1'}}">
                        <?php
                        if ($sun->status == 1) {
                            echo 'online';
                        } else {
                            echo 'offline';
                        }
                        ?>
                    </a>
                </div>

            </div>
        </div>   
    </div>   


</div>
{{ HTML::style('public/css/front2/jquery.range.css'); }}
{{ HTML::script('public/js/front2/jquery.range.js'); }}

<script>
    
    if ($(window).width() < 514) {
        $('#sidebarCollapse').removeClass('calendarnav');
    } else {
        $('#sidebarCollapse').addClass('calendarnav');
    }
    $('.range-slider').jRange({
        from: 0,
        to: 24,
        step: 1,
        scale: [12, 2, 4, 6, 8, 10, 12, 2, 4, 6, 8, 10, 12],
        format: '%s',
        width: 300,
        showLabels: true,
        isRange: true,
        ondragend: function (value,data) {
            $('#loading-image').show(); 
            
            var user_id = $(data).data('user_id');
            var day = $(data).data('day');
            var open_id = $(data).data('open_id');
            
            var dat = {
                alltime: value,
                user_id:user_id,
                day: day,
                open_id: open_id,
            }
            
            $.ajax({
                url: '<?php echo HTTP_PATH . 'user/updateOpeninghours'; ?>',
                dataType: 'json',
                type: 'POST',
                data: dat,
                success: function (data, textStatus, XMLHttpRequest)
                {
                    if (data.valid)
                    {
                        $('#loading-image').hide(); 
                        $('#'+data.tmcl).text(data.tmup);

                    } else
                    {
                        // Message
                        $('#loading-image').hide(); 
                         alert('Please check you have update staus offline to online.');
//
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    $('#loading-image').hide(); 
                    // Message
                    alert('An unexpected error occured, please try again');

                }
            });
        },
        onbarclicked: function (value,data) {
            $('#loading-image').show(); 
            var user_id = $(data).data('user_id');
            var day = $(data).data('day');
            var open_id = $(data).data('open_id');
            
            var data = {
                alltime: value,
                user_id:user_id,
                day: day,
                open_id: open_id,
            }
            
            $.ajax({
                url: '<?php echo HTTP_PATH . 'user/updateOpeninghours'; ?>',
                dataType: 'json',
                type: 'POST',
                data: data,
                success: function (data, textStatus, XMLHttpRequest)
                {
                    if (data.valid)
                    {
                        $('#loading-image').hide(); 
                        $('#'+data.tmcl).text(data.tmup);
                    } else
                    {
                        // Message
                        $('#loading-image').hide(); 
                         alert('Please check you have update staus offline to online.');
//
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    $('#loading-image').hide(); 
                    // Message
                    alert('An unexpected error occured, please try again');

                }
            });
        }
    });
    
    $('#update_status').click(function () {
        var status = $(this).attr('data-val');
        var cnf = '';
        var txt = '';
        if (status == 0) {
            //cnf = confirm('Are you sure to change status offline ?');
            txt = 'offline';
        } else
        {
            //cnf = confirm('Are you sure to change status online ?');
            txt = 'online';
        }

//        if (cnf) {
            var data = {
                status_up: status,
                user_id: '<?php echo $opening_hours->user_id ?>',
                id: '<?php echo $opening_hours->id ?>'
            }
            $.ajax({
                url: '<?php echo HTTP_PATH . 'user/openingstatus'; ?>',
                dataType: 'json',
                type: 'POST',
                data: data,
                success: function (data, textStatus, XMLHttpRequest)
                {
                    if (data.valid)
                    {
                        if (status == 0) {
                            $('#update_status').parent().removeClass('btn_online');
                            $('#update_status').parent().addClass('btn_offline');
                        } else
                        {
                            $('#update_status').parent().removeClass('btn_offline');
                            $('#update_status').parent().addClass('btn_online');
                        }
                        $('#update_status').attr('data-val', data.res_data);
                        $('#update_status').text(txt);
                    } else
                    {
                        // Message
                        alert('An unexpected error occured, please try again');

                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    // Message
                    alert('An unexpected error occured, please try again');

                }
            });
//        } else
//        {
//
//        }
    });

    $('.update_day').click(function () {
        // console.log(this);
        var status = $(this).attr('data-val');
        var day = $(this).data('day');
        var open_id = $(this).data('open_id');
        var user_id = $(this).data('user_id');
        var cnf = '';
        var txt = '';

        var current = this;

        if (status == 0) {
            //cnf = confirm('Are you sure to change status offline ?');
            txt = 'offline';
        } else
        {
            //cnf = confirm('Are you sure to change status online ?');
            txt = 'online';
        }

        //if (cnf) {

            var data = {
                status: status,
                day: day,
                user_id: user_id,
                open_id: open_id
            }

            $.ajax({
                url: '<?php echo HTTP_PATH . 'user/openingdays'; ?>',
                dataType: 'json',
                type: 'POST',
                data: data,
                success: function (data, textStatus, XMLHttpRequest)
                {
                    if (data.valid)
                    {
                        // console.log($(current).parent().parent());
//                          alert(this);
                        if (status == 0) {
                            var text = 'offline';
                            var dval = '1';
                            $(current).parent().parent().addClass('offline');
                            $(current).parent().parent().removeClass('online');

                        } else
                        {
                            var text = 'online';
                            var dval = '0';
                            $(current).parent().parent().addClass('online');
                            $(current).parent().parent().removeClass('offline');
                        }

                        $(current).text(text);
                        $(current).attr("data-val", dval);

                    } else
                    {
                        // Message
                        alert('An unexpected error occured, please try again');

                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    // Message
                    alert('An unexpected error occured, please try again');

                }
            });
//        } else
//        {
//
//        }
    });

</script>
@stop


