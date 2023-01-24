@section('content')

<section class="slider_top my-5">
    <div class="container">
        <div class="row">
            <div id="auto_width" class="owl-carousel owl-theme">
                <div class="item" style="width:250px"><div class="single">
                        {{ HTML::image("public/frontimg/first_slide.png") }}
                    </div></div>
                <div class="item" style="width:250px">
                    <div class="two">
                        {{ HTML::image("public/frontimg/second_slide.png") }}
                    </div>
                    <div class="two">
                        {{ HTML::image("public/frontimg/third_slide.png") }}
                    </div>
                </div>
                <div class="item" style="width:250px"><div class="single">{{ HTML::image("public/frontimg/fourth_slide.png") }}</div></div>
                <div class="item" style="width:250px">
                    <div class="two">{{ HTML::image("public/frontimg/fifth_slide.png") }}</div>
                    <div class="two">{{ HTML::image("public/frontimg/six_slide.png") }}</div>
                </div>

                <div class="item" style="width:250px"><div class="single">{{ HTML::image("public/frontimg/seven_slide.png") }}</div></div>

            </div>
        </div>    
    </div>

</section>



<section class="deatils_page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page_title text-center">
                    <input type="hidden" name="resid" id="resid" value="<?php if(Session::has('userdata')){echo $data->userid;} ?>">
                    <input type="hidden" name="userid" id="userid" value="<?php if(Session::has('userdata')){ echo Session::get('userdata')->id; } ?>">
                    <input type="hidden" name="resid" id="resname" value="<?php if(Session::has('userdata')){echo $data->first_name; } ?>">
                    <div id="favitem">
                    </div>
                    <?php
                    $resid = $data->userid;
                    if(Session::has('userdata')){
                        $userid = Session::get('userdata')->id;
                    } else {
                        $userid = 0;
                    }    
                    $resname = $data->first_name;

                    $favdata = DB::table('favourite')
                            ->where('favourite.res_id', $resid)
                            ->where('favourite.user_id', $userid)
                            ->where('favourite.restaurent_name', $resname)
                            ->first();
                    
                    ?>
                    <h3 class="d-inline-block">{{$data->first_name }} <button type="button" class="btn rounded-btn">$ {{$data->average_price}}</button></h3> 
                    <?php
                    if (!empty($favdata)) {
                        ?>
                        <a href="javscript:void(0)" id="fav"><i style="color:red;" class="fa fa-heart-o"></i></a>
                    <?php } else { ?>
                     <!-- <a href="javscript:void(0)" class="d-inline-block"><i class="fa fa-heart-o"></i></a> -->
                        <a href="javscript:void(0)" id="fav"><i class="fa fa-heart-o"></i></a>
<?php } ?>
                    <?php $crusines = str_replace(',', ' | ', $data->cuisines); ?>
                    <div class="tag">{{ $crusines }}</div>

                </div>   
            </div>   
            <!-- <div class="col-12 mt-2 mb-2  mt-sm-2 mb-sm-2 mt-lg-4 mb-lg-3">
                 <ul class="list-unstyled text-center types">
<?php

foreach ($openinghr as $hr) {
    $day = !empty($hr->open_days);
    $days = explode(",", $day);
    
    $starttime = explode(",", $hr->start_time);
    $endtime = explode(",", $hr->end_time);

    $i = 0;
    for ($i = 0; $i < count($days); $i++) {
        ?>
                              <li class="nav-item d-inline-block">Restaurant hours 
                                 
                                 
                                 Days {{$days[$i]}} 
                            
                             </li>   
                               <li class="nav-item d-inline-block">Open  {{$starttime[$i]}} </li>
                                 <li class="nav-item d-inline-block">Close  {{$endtime[$i]}} </li>
                                 <br>
    <?php }
} ?>
                      <li class="nav-item d-inline-block">{{$data->address}}</li>   
                      <li class="nav-item d-inline-block">{{$data->city}},{{$data->state}},{{$data->zipcode}}</li>   
                     
                 </ul>    
             </div>-->
            <!-- <div class="col-12 mt-2 mb-2  mt-sm-2 mb-sm-2 mt-lg-4 mb-lg-3">
                 <ul class="list-unstyled text-center types">
            <!--<li class="nav-item d-inline-block">Review {{$reviews->comment or 'NA'}}</li>-->   
            <!-- <li class="nav-item d-inline-block">Contact Number {{$data->phone1 or 'NA'}}</li>   
             <li class="nav-item d-inline-block">Email Address {{$data->email_address or 'NA'}}</li>   
            
        </ul>    
    </div>-->
            <!-- <div class="col-12 mt-2 mb-2  mt-sm-2 mb-sm-2 mt-lg-4 mb-lg-3">
                <ul class="list-unstyled text-center types">
                     <li class="nav-item d-inline-block">Navigation to restaurant </li>   
                     <li class="nav-item d-inline-block">Payment options {{$data->payment_options}}</li>   
                     <li class="nav-item d-inline-block">Parking {{$data->parking ? 'yes' : 'no'}}</li>   
                    
                </ul>    
            </div>-->
            <div class="col-12 mt-2 mb-2  mt-sm-2 mb-sm-2 mt-lg-4 mb-lg-3">
                <!--<ul class="list-unstyled text-center types">
                     <li class="nav-item d-inline-block">Opening time slots for reservation {{$data->open_days}} </li>  
                      <li class="nav-item d-inline-block">Start Time {{$data->start_time}} </li>
                      <li class="nav-item d-inline-block">End Time {{$data->end_time}} </li>      
                     <li class="nav-item d-inline-block">Description:- {{$data->restdesc}}</li>   
                     <li class="nav-item d-inline-block">Share 
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{  urlencode(url()) }}"
                           target="_blank">
                           <i class="fa fa-facebook-official"></i>
                        </a>
                     </li>   
                     <li class="nav-item d-inline-block">
                       <a href="https://twitter.com/intent/tweet?url={{ url() }}"
                       target="_blank">
                        <i class="fa fa-twitter-square"></i>
                    </a>
                     </li>  
                   </ul> -->
                <ul class="list-unstyled text-center badge-tag my-2 my-sm-2 my-md-2 my-lg-4">
                    <li class="d-inline-block">  <span class="badge badge-light text-left">
                            <b class="d-block">${{$data->delivery_cost}}</b>
                            Delivery Fees
                        </span> </li>
                    <li class=" d-inline-block">  <span class="badge badge-light text-left">
                            <b class="d-block">${{$data->minorder}}</b>
                            Min. Order
                        </span> </li>

                </ul>   
            </div>
        </div>



    </div>   



    <div class="container">
        <div class="row">
            <div class="col-12">

                <ul class="nav nav-tabs list-unstyled tab_design text-center pick_tab" id="pickup_tab" role="tablist">
<?php
if (!empty($menu)) {
    foreach ($menu as $menures) {
        ?>
                            <li class="nav-item d-inline-block categoryId" categoryId="{{$menures->id}}" catname="{{$menures->name}}">
                                <a class="nav-link active" id="{{$menures->name}}-tab" data-toggle="tab" href="#{{$menures->name}}" role="tab" aria-controls="{{$menures->name}}" aria-selected="false">{{$menures->name}}</a>
                            </li> 
                        <?php }
                    } ?>    
                    
                </ul>    
            </div>   


            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="best-dishess" role="tabpanel" aria-labelledby="best-dishes-tab">    
                        <div class="tab_wrap">
                            <div class="dishes_wrap mb-3" id="finalmenu">

                                <div class="titl text-center py-5" id="menucatname">BEST DISHES</div>
<?php
if (!empty($item)) {
    foreach ($item as $itemres) {
        ?>
                                        <div class="hlaf_dish">
                                            <div class="hlaf_dish_inner">
                                                <a href="">{{$itemres->item_name or ''}}</a>  
                                                <p>{{$itemres->description or ''}}</p>
                                                <div class="float-left">
                                                    <span class="actual_rate">${{$itemres->price or ''}}</span>
                                                    <span> Offer</span> {{$itemres->discount or ''}}% off
                                                </div>
                                                <div class="btn_add float-right"><a href="javscript:void(0)" class="btn">+ Add</a></div>

                                            </div>   

                                        </div>
    <?php }
} ?>
                             

                            </div>
                        </div></div>
                    
                    <input type="hidden" name="title" id="title" value="<?php echo (isset($data->userslug)) ? $data->userslug : '#';?>" />    
                    <input type="hidden" name="lat" id="lat" value="<?php echo (isset($data->latitude) && ($data->latitude != 0)) ? $data->latitude : '26.861417';?>" />    
                    <input type="hidden" name="lng" id="lng" value="<?php echo (isset($data->longitude) && ($data->longitude != 0)) ? $data->longitude : '75.798363';?>" />    
                </div>
                <div id="map" style="width: 50%; height: 500px;"></div>
            </div> 
                                 

            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="side_bar">
                    <div class="cart_box_wrap">
                        <ul class="nav list-unstyled cart_tab text-center" id="cart_tab" role="tablist">
                            <li class="nav-item d-inline-block">
                                <a class="" id="Delivery-tab" data-toggle="tab" href="#Delivery-cart" role="tab" aria-controls="Delivery-cart" aria-selected="true">Delivery</a>
                            </li>   
                              
                            <li class="nav-item d-inline-block">
                                <a class="active" id="Pickup-tab" data-toggle="tab" href="#Pickup-cart" role="tab" aria-controls="Pickup-cart" aria-selected="true">Pickup</a>
                            </li> 
<li class="nav-item d-inline-block">
                                <a class="" id="reservation-tab" data-toggle="tab" href="#reservation-cart" role="tab" aria-controls="reservation-cart" aria-selected="true">Reservation</a>
                            </li>   

                        </ul> 
                        <div class="tab-content" id="cart_tab_content">
                            <div class="tab-pane fade show" id="Delivery-cart" role="tabpanel" aria-labelledby="Delivery-tab"> 
                                <div class="calendar same_field">
                                    <span class="calendar_icon ico_de"><i class="fa fa-calendar"></i> Date</span>
                                    <input class="form-control border-0 datepicker" type="text" >
                                    <i class="fa fa-caret-up arrow"></i>
                                </div>   
                                <div class="time same_field">
                                    <span class="calendar_icon ico_de"><i class="fa fa-clock-o"></i> Time</span>
                                    <input class="form-control border-0 custom-timepicker" type="text" >
                                    <i class="fa fa-caret-up arrow" id="time_drop"></i>

                                    <ul class="list-unstyled time-toolbar ">
                                       <?php
                                        foreach($offer_slots as $r){
                                            if(($r->start_time != '00:00' && $r->end_time != '00:00')){?> 
                                        <li class="nav-item d-inline-block" onclick="slot_data({{$r->id}},'delivery')">

                                                <input type="radio" id="discount_delivery_{{$r->id}}" name="radioFruit" value="discount1" >
                                                <label for="discount1"><span>{{date('h:i A', strtotime($r->end_time))}}</span>
                                                    <b>{{$r->discount}}% off</b>
                                                </label>
                                            </li>
                                            <?php }
                                            
                                            } ?>
                                    </ul>
                                </div>
                                <!--<div class="calendar same_field">
                                <span class="calendar_icon ico_de"><i class="fa fa-clock-o"></i> Schedule Order</span>
                                <input class="form-control border-0 timepicker" type="text" >
                                <i class="fa fa-caret-up arrow"></i>
                            </div> -->  
                                <div class="discount_btn">
                                    <a href="javscript:void(0)" class="btn"><span><i>{{ HTML::image("public/frontimg/tag.png") }}</i> Offer</span>   {{$data->off_dis}}% off on all menu</a>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="Pickup-cart" role="tabpanel" aria-labelledby="Pickup-tab"> 
                                <div class="calendar same_field">
                                    <span class="calendar_icon ico_de"><i class="fa fa-calendar"></i> Date</span>
                                    <input class="form-control border-0 datepicker" type="text" >
                                    <i class="fa fa-caret-up arrow"></i>
                                </div>   
                                <div class="time same_field">
                                    <span class="calendar_icon ico_de"><i class="fa fa-clock-o"></i> Time</span>
                                    <input class="form-control border-0 custom-timepicker" type="text" >
                                    <i class="fa fa-caret-up arrow" id="time_dropp"></i>

                                    <ul class="list-unstyled time-toolbar ">
                                       <?php
                                        foreach($offer_slots as $r){
                                            if(($r->start_time != '00:00' && $r->end_time != '00:00')){?> 
                                            <li class="nav-item d-inline-block" onclick="slot_data({{$r->id}},'pick')">

                                                <input type="radio" id="discount_pick_{{$r->id}}" name="radioFruit" value="discount1" >
                                                <label for="discount1"><span>{{date('h:i A', strtotime($r->end_time))}}</span>
                                                    <b>{{$r->discount}}% off</b>
                                                </label>
                                            </li>
                                            <?php }
                                            
                                            } ?>
                                    </ul>
                                </div>
                                <!--                                  <div class="calendar same_field">
                                                                  <span class="calendar_icon ico_de"><i class="fa fa-clock-o"></i> Schedule Order</span>
                                                                  <input class="form-control border-0 timepicker" type="text" >
                                                                  <i class="fa fa-caret-up arrow"></i>
                                                              </div>   -->
                                <div class="discount_btn">
                                    <a href="javscript:void(0)" class="btn"><span><i>{{ HTML::image("public/frontimg/tag.png") }}</i> Offer</span>   {{$data->off_dis}}% off on all menu</a>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="reservation-cart" role="tabpanel" aria-labelledby="reservation-tab"> 
                                <div class="calendar same_field">
                                    <span class="calendar_icon ico_de"><i class="fa fa-calendar"></i> Date</span>
                                    <input class="form-control border-0 datepicker" type="text">
                                    <i class="fa fa-caret-up arrow"></i>
                                </div>   
                                <div class="time same_field">
                                    <span class="calendar_icon ico_de"><i class="fa fa-clock-o"></i> Time</span>
                                    <input class="form-control border-0 custom-timepicker" type="text" >
                                    <i class="fa fa-caret-up arrow" id="time_droppp"></i>

                                    <ul class="list-unstyled time-toolbar ">
                                       <?php
                                        foreach($offer_slots as $r){
                                            if(($r->start_time != '00:00' && $r->end_time != '00:00')){?> 
                                            <li class="nav-item d-inline-block"  onclick="slot_data({{$r->id}},'res')">

                                                <input type="radio" id="discount_res_{{$r->id}}" name="radioFruit" value="discount1">
                                                <label for="discount1"><span>{{date('h:i A', strtotime($r->end_time))}}</span>
                                                    <b>{{$r->discount}}% off</b>
                                                </label>
                                            </li>
                                            <?php }
                                            
                                            } ?>
                                    </ul>
                                </div>
                                <!--<div class="calendar same_field">
                                <span class="calendar_icon ico_de"><i class="fa fa-clock-o"></i> Schedule Order</span>
                                <input class="form-control border-0 timepicker" type="text" >
                                <i class="fa fa-caret-up arrow"></i>
                            </div> -->  
                                <div class="discount_btn">
                                    <a href="javscript:void(0)" class="btn"><span><i>{{ HTML::image("public/frontimg/tag.png") }}</i> Offer</span>   {{$data->off_dis}}% off on all menu</a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="cart_box_wrap">
                        <div class="cart_box">
                            <div class="cart_title text-center">
                                CART
                            </div> 

                            <div class="cart_row">
                                <div class="top_details">
                                    <a href="javscript:void(0)">Treasures of the Sea Congee</a>  
                                    <ul class="list-unstyled">
                                        <li>Tomatoes <span>$0.50</span></li>    
                                        <li>Olives <span>$0.50</span></li>    
                                    </ul></div>
                                <div class="product_add">
                                    <div id="field1" class="d-inline-block">
                                        <button type="button" id="sub" class="sub ">-</button>
                                        <input type="text" id="1" value="1" min="1" max="3" />
                                        <button type="button" id="add" class="add">+</button>
                                        <i>{{ HTML::image("public/frontimg/trash.png") }}</i>
                                    </div>
                                    <span class="total float-right">$0.50</span>
                                </div>
                            </div>
                            <div class="cart_row">
                                <div class="top_details">
                                    <a href="javscript:void(0)">Treasures of the Sea Congee</a>  
                                    <ul class="list-unstyled">
                                        <li>Tomatoes <span>$0.50</span></li>    

                                    </ul></div>
                                <div class="product_add">
                                    <div id="field1" class="d-inline-block">
                                        <button type="button" id="sub" class="sub ">-</button>
                                        <input type="text" id="1" value="1" min="1" max="3" />
                                        <button type="button" id="add" class="add">+</button>
                                        <i>{{ HTML::image("public/frontimg/trash.png") }}</i>
                                    </div>
                                    <span class="total float-right">$0.50</span>
                                </div>
                            </div>
                            <div class="cart_row">
                                <div class="top_details">
                                    <a href="javscript:void(0)">Total <span class="total float-right">$40.50</span></a>  
                                    <ul class="list-unstyled">
                                        <li><i>extra charges may apply</i></li>    

                                    </ul></div></div>
                        </div></div>
                    <div class="d-block text-center tablebtn"><a href="javscript:void(0)" class="btn btn-primary border-0">Checkout</a></div>
                </div>
                <div class="cart_box_wrap">
                    <div class="cart_box">
                        <div class="cart_title text-center">
                            Review
                        </div> 

                        <div class="cart_row" id="finalreview">
                            <div class="top_details">
                            </div>
                        </div>
                        <div class="d-block text-center tablebtn"><!--<a href="javscript:void(0)" class="btn btn-primary border-0" >Reviews</a>-->
                            <a id="restreviews" class="btn btn-primary border-0">Reviews</a></div>
                    </div></div>

            </div>   


        </div>
</section>  
<div id="myModal1" class="modal fade registration_pop" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="pop_inner">
                <div class="modal-header">
                    <h4 class="modal-title">My Profile
                    </h4>
                    <button type="button" class="close mt-0 pt-0" id="cancel" data-dismiss="modal">&times;</button>

                </div>
                {{ Form::open(['url' => 'profile', 'method' => 'post'] ) }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" placeholder="Name" id="custname" placeholder="Name" name="cust_name" value="{{$profile->cust_name or ''}}" class="form-control" >  
                    </div>
                    <div class="error" id="err_custname" style="color:red;"></div>
                    <div class="form-group">
                        <input type="text" placeholder="Email" id="email" placeholder="Email" name="cust_email" value="{{$profile->cust_email or ''}}" class="form-control" readonly>  
                    </div>
                    <div class="error" id="err_email" style="color:red;"></div>
                    <div class="form-group">
                        <input type="text" placeholder="Phone" placeholder="Phone" id="phone" name="cust_phone" value="{{$profile->cust_phone or ''}}" class="form-control">  
                    </div>
                    <div class="error" id="err_phone" style="color:red;"></div>
                    <div class="form-group password">
                        <input type="password" placeholder="Password" placeholder="Password" id="pwd" name="cust_password" value="{{$profile->plain_pwd or ''}}" class="form-control">  
                    </div>
                    <div class="error" id="err_pwd" style="color:red;"></div>
                    <div class="form-group password">
                        <textarea id="address" readonly class="form-control">{{isset($profile->address) ? '' : ''}}</textarea>
                    </div>
                </div>
                <div class="form-group show-map">
                    <a href="{{URL::to('updateLocation')}}" class="center">Update location</a>
                </div>
                <div class="modal-footer text-center">
                    <input type="submit" class="btn btn-default m-auto profile"  value="Change Profile">
                </div>
                {{ Form::close() }}
            </div>
        </div>

    </div>

</div>
@stop
