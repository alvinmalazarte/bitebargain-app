@section('content')
<script>
    function showSlot(obj) {
        var id = obj.id;
        id = id.split("_");
        $('#defaul_height').addClass("height_scroll");
        $('.more#more_' + id[1]+'_'+id[2]).css('display','none');
         $('.less#more_' + id[1]+'_'+id[2]).css('display','block');
         console.log('.less #more_' + id[1]+'_'+id[2]);
        $.ajax({
            type: 'POST',
            url: 'getmoreslot',
            data: {id: id},
            success: function (data) {
                $('#timeslot_' + id[1]).html(data);
                $('#timepickslot_' + id[1]).html(data);
                $('#timedelslot_' + id[1]).html(data);
            }
        });
    }
    
    function hideSlot(obj){
        $('#defaul_height').removeClass("height_scroll");
        var id = obj.id;
        id = id.split("_");
        $('.more#more_' + id[1]+'_'+id[2]).css('display','block');
        $('.less#more_' + id[1]+'_'+id[2]).css('display','none');
        $('ul#timeslot_'+id[1]+' > ul:not(:first)').remove();
    }


</script>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <section class="filter mb-5 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group search_bar my-5">
                            <i class="fa fa-search"></i>
                            <input class="form-control text-left border-0" type="text" placeholder="Search for cuisines, food, restaurants..." id="search"> 

                        </div></div>
                </div>
                <div class="row">

                    <div class="col-12 col-sm-12 col-lg-5 form-group">
                        <div class="b-select-wrap col-lg-4 px-0">
                            <i class="fa fa-clock-o"></i>
                            <select name="standard" id="delivery-select" class="">
                                <option>ASAP</option>
                                <option>1 Hour</option>
                                <option>2 Hour</option>
                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-7 ml-auto">
                        <ul class="fillter">

                            <li class="d-inline-block"><a  href="javascript:void(0)" id="sortprice"><i class="fa fa-long-arrow-down"></i>Price</a></li>
                            <li class="d-inline-block"><a href="javascript:void(0)" id="best">Reviews</a></li>
                            <li class="d-inline-block"><a href="javascript:void(0)" id="sortdistance">Distance</a></li>
                            <li class="d-inline-block"><a href="javascript:void(0)" id="sortdiscount">Discount</a></li>
                            <li class="d-inline-block"><a href="{{ url('/listing') }}"><input class="bg_none" type="button" value="clear"></a></li>

                            <li class="d-inline-block"> <a class="active" href="{{ url('/slotdetails') }}" >Slot</a></li>
                            <li class="d-inline-block"><a  href="{{ url('/discountdetails') }}" >Discount</a></li>
                            <li class="fillter_icon d-inline-block"><a href="javascript:void(0)" class="filter_pop"> {{ HTML::image("public/listingimg/fillter.png") }}</a>

                                <div class="filtter_option">
                                    <!--<form class="form-horizontal" role="form">-->
                                    <!--{{Form::open(['url' => '/getfilterdata', 'method' => 'post'])}}-->
                                    <div class="form_title">Filters</div>
                                    <div class="form-group">
                                        <label for="filter">Price</label>
                                        <select class="form-control" name="price" id="price">
                                            <option value="0" selected="">High to Low</option>
                                            <option value="1">Low to High</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="slider-box">
                                            <label for="priceRange">Distance(KM)</label>
                                            <input type="text" id="distance" name="distance" value="0,30" class="priceRange" readonly>
                                            <div  class="slider price-range"></div></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="slider-box">
                                            <label for="discount">Discount($)</label>
                                            <input type="text" id="discount" class="discount" name="discount" value="0,25" readonly>
                                            <div class="slider discount-range"></div></div>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ url('/listing') }}"><button type="button" id="btn" class="btn btn-primary border-0">Clear</button></a>
                                        <button type="submit" onClick="filter()" class="btn btn-primary border-0">Apply</button></div>
                                    <!--{{ Form::close() }}-->
                                </div>
                            </li>
                        </ul>
                        <div class="map">
                            <span>Map</span>
                            <label class="switch">
                                <input type="checkbox" id="map_show1">
                                <span class="slider round"></span>

                            </label>

                        </div>
                    </div>
                </div>
            </div>   
        </section>

        <section class="product_listing mt-5" >
            <div class="container">
                <div class="row" id="final">
                    <?php 
                    $user_id = Session::get('userdata')->id;
                    foreach ($offers_detail as $res) {
                        ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="card br-0 custom_card border-0 mb-5">
                                <div class="card_img position-relative">
                                    <div class="tag position-absolute">
                                        {{$res['offerdis']}} % off on all menu
                                    </div>

                                    <a href="{{ url('/restaurantdetail') }}/{{$res['userslug']}}"><?php if ($res['profile_image']) { ?>
                                            {{ HTML::image(DISPLAY_FULL_PROFILE_IMAGE_PATH.$res['profile_image'],'',array('width' => '350px','height' => '250px')) }}
    <?php } else { ?>
                                            {{ HTML::image("public/listingimg/food_a.png") }}
    <?php } ?>
                                    </a>
                                </div>
                                <div class="card-body px-0">
                                    <h4 class="card-title">{{$res['first_name']}} <button type="button" class="btn rounded-btn"><i class="fa fa-inr"></i>{{$res['average_price']}}</button><span class="float-right"><span class="float-right">{{ App::make("ListingController")->getMiles($user_id,$res['id']) }} KM</span> </h4> 
                                    <ul class="list-unstyled big_size">
                                            <li class="d-inline-block"><a href="">{{$res['cuisines']}}</a></li>

                                        </ul>
                                    <ul class="list-unstyled">
                                        <li class="d-inline-block"><a href="javascript:void(0)">Free Delivery Above <i class="fa fa-inr"></i>{{$res['delivery_cost']}}</a></li>
                                        <li class="d-inline-block"><a href="javascript:void(0)">Min. Order <i class="fa fa-inr"></i>{{$res['minimum_order']}}</a></li>
                                    </ul>
                                    <div class="" id="defaul_height">
                                    <ul class="list-unstyled radio-toolbar " id="timeslot_{{$res['user_id']}}">

                                        <?php
                                                $offslot_result = DB::table('offers')
                                                        ->where('offers.user_id', $res['user_id'])
                                                        ->where('opening_hours.open_close', '1')
                                                        ->join('offers_slot', 'offers_slot.offer_id', '=', 'offers.id')
                                                        ->join('opening_hours', 'opening_hours.user_id', '=', 'offers.user_id')
                                                        ->orderBY('offers_slot.created', 'DESC')
                                                        ->limit(1)
                                                        ->select('offers.created as datecreated', 'offers.id as offersid', 'offers.discount as offerdis', 'offers.*', 'offers_slot.discount as offerslotdis', 'offers_slot.offer_name as offerslotoffer_name', 'offers_slot.start_date as offerslotstart_date', 'offers_slot.end_date as offerslotend_date', 'offers_slot.start_time as offerslotstart_time', 'offers_slot.end_time as offerslotend_time', 'offers_slot.*')
                                                        ->get();
                                                if ($offslot_result) {
                                $slot_data = ' <ul class="list-unstyled radio-toolbar " id="timeslot_'.$offslot_result[0]->user_id.'">
                                                <li class="d-inline-block">
                                                    <input type="radio" id="discount" name="radioFruit" value="apple" checked>
                                                    <label for="discount"><span>' . $offslot_result[0]->start_time . '</span>
                                                        <b>' . $offslot_result[0]->discount . '% off</b>
                                                    </label>
                                                </li>
                                                <li class="d-inline-block">
                                                    <input type="radio" id="radioBanana" name="radioFruit" value="banana">
                                                    <label for="radioBanana"><span>' . $offslot_result[0]->end_time . '</span>
                                                        <b>' . $offslot_result[0]->discount . '% off</b></label></li>
                                                         <li class="d-inline-block"><button type="button" class="bg_none rounded-btn">BookSlot</button>
                                                </li>
                                                
                                            </ul>
                                            <button class="bg_none more" style="display:block" onclick="showSlot(this)" id="more_'.$offslot_result[0]->user_id.'_'.$offslot_result[0]->offersid.'" >View More</button>
                                                <button class="bg_none less" style="display:none"  onclick="hideSlot(this)" id="more_'.$offslot_result[0]->user_id.'_'.$offslot_result[0]->offersid.'" >View Less</button>';
                            }?>
                                                
                                                {{$slot_data}}

                                    </ul>
                                    </div>
                                    

                                </div>
                            </div>  


                        </div>
<?php } ?>

                </div>

            </div>
        </section>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <section class="filter mt-5 ">
            <div class="container">
                <div class="row border-bottom pb-2">

                    <div class="col-12 col-sm-12 col-lg-5 form-group">
                        <div class="b-select-wrap time_menu">
                            <i class="fa fa-clock-o"></i>
                            <input  type="text" name="time" class="timepicker form-control b-select text-center custom-timepicker"    >
                        </div>
                        <div class="b-select-wrap date_menu">
                            <input  type="text" id="datepicker" class="form-control b-select text-center datepicker"  >
                            <i class="fa fa-calendar" id="datepicker"></i>

    <!-- <select name="standard" id="reservation-calendar" class="form-control b-select text-center">
   <option>Jan 20, 2018</option>
   <option>Jan 15, 2018</option>
   <option>Jan 2, 2018</option>
 </select>-->
                        </div>
                        <div class="b-select-wrap seat_menu">
                            <i><!--<img src="img/table.png">-->{{ HTML::image("public/listingimg/table.png") }}</i>

                            <select name="standard" id="reservation-seat" class="form-control b-select text-center">
                                <option>1 seats</option>
                                <option>2 seats</option>
                                <option>3 seats</option>
                                <option>4 seats</option>
                                <option>5 seats</option>
                                <option>6 seats</option>
                                <option>7 seats</option>
                                <option>8 seats</option>
                                <option>9 seats</option>
                                <option>10 seats</option>
                                <option>11 seats</option>
                                <option>12 seats</option>
                                <option>13 seats</option>
                                <option>14 seats</option>
                                <option>15 seats</option>
                                <option>16 seats</option>
                                <option>17 seats</option>
                                <option>18 seats</option>
                                <option>19 seats</option>
                                <option>20 seats</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-7 ml-auto">
                        <ul class="fillter">
                            <li class="d-inline-block"><a id="resprice" href="javascript:void(0)"><i class="fa fa-long-arrow-down"></i>Price</a></li>
                            <li class="d-inline-block"><a href="javascript:void(0)" id="resbest">Best</a></li>
                            <li class="d-inline-block"><a href="javascript:void(0)" id="resdistance">Distance</a></li>
                            <li class="d-inline-block"><a href="javascript:void(0)" id="resdiscount">Discount</a></li>
                            <li class="d-inline-block"><a href="{{ url('/listing') }}"><input class="bg_none" type="button" value="clear"></a></li>
                            <li class="d-inline-block"><a href="{{ url('/slotdetails') }}" >Slot</a></li>
                            <li class="d-inline-block"><a class="active" href="{{ url('/discountdetails') }}" >Discount</a></li>
                            <li class="fillter_icon d-inline-block"><a href="javascript:void(0)" class="filter_pop">{{ HTML::image("public/listingimg/fillter.png") }}</a>
                                <div class="filtter_option">
                                    <!--<form class="form-horizontal" role="form">-->
                                        <div class="form_title">Filters</div>
                                        <div class="form-group">
                                            <label for="filter">Price</label>
                                            <select class="form-control" id="resfilterprice">
                                                <option value="0" selected="">High to Low</option>
                                                <option value="1">Low to High</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="slider-box">
                                                <label for="priceRange">Distance(KM)</label>
                                                <input type="text" class="priceRange" id="resfilterdiscount" readonly>
                                                <div  class="slider price-range"></div></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="slider-box">
                                                <label for="discount">Discount($)</label>
                                                <input type="text" class="discount" id="resfilterdistance" readonly>
                                                <div  class="slider discount-range"></div></div>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ url('/listing') }}"><button type="button" id="btn" class="btn btn-primary border-0">Clear</button></a>  <button type="submit" onClick="resfilter()" class="btn btn-primary border-0">Apply</button></div>

                                    <!--</form>-->
                                </div>
                            </li>
                        </ul>
                        <div class="map">
                            <span>Map</span>
                            <label class="switch">
                                <input type="checkbox" id="map_show2">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group search_bar my-4">
                            <i class="fa fa-search"></i>
                            <input class="form-control text-left border-0" type="text" placeholder="Search for cuisines, food, restaurants..." id="reservation"> 

                        </div></div>
                </div>

            </div>   
        </section>
        <section class="product_listing mt-5">
            <div class="container">
                <div class="row" id="finalres">

<?php
foreach ($offers_detail as $res) {
    ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="card br-0 custom_card border-0 mb-5">
                                <div class="card_img position-relative">
                                    <div class="tag position-absolute">
                                        {{$res['offerdis']}} % off on all menu
                                    </div>
                                    <a href="{{ url('/restaurantdetail') }}/{{$res['userslug']}}"><?php if ($res['profile_image']) { ?>
                                            {{ HTML::image(DISPLAY_FULL_PROFILE_IMAGE_PATH.$res['profile_image'],'',array('width' => '350px','height' => '250px')) }}
    <?php } else { ?>
                                            {{ HTML::image("public/listingimg/food_a.png") }}
    <?php } ?>
                                    </a>

                                </div>
                                <div class="card-body px-0">
                                    <h4 class="card-title"> <button type="button" class="btn rounded-btn">{{$res['first_name']}}<button type="button" class="btn rounded-btn">{{$res['average_price']}}</button><span class="float-right"><span class="float-right">{{ App::make("ListingController")->getMiles($user_id,$res['id']) }} KM</span></h4> 

                                                
                                                <ul class="list-unstyled">
                                                    <li class="d-inline-block"><a href="javascript:void(0)">Free Delivery Above <i class="fa fa-inr"></i>{{$res['delivery_cost']}}</a></li>
                                                    <li class="d-inline-block"><a href="javascript:void(0)">Min. Order <i class="fa fa-inr"></i>{{$res['minimum_order']}}</a></li>
                                                </ul>
                                                   
                                                </div>
                                                </div>  


                                                </div>
<?php } ?>


                                            </div>
                                            </div>
                                            </section>
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> 
                                                <section class="filter mb-5 border-bottom">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group search_bar my-5">
                                                                    <i class="fa fa-search"></i>
                                                                    <input class="form-control text-left border-0" type="text" placeholder="Search for cuisines, food, restaurants..." id="pickup"> 

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-12 col-sm-12 col-lg-5 form-group">
                                                                <div class="b-select-wrap col-lg-4 px-0">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    <select name="standard" id="pickup-time" class="form-control b-select text-center">
                                                                        <option>ASAP</option>
                                                                        <option>1 hour</option>
                                                                        <option>2 hour</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-7 ml-auto">
                                                                <ul class="fillter">
                                                                    <li class="d-inline-block"><a class="active" href="javascript:void(0)" id="pickprice"><i class="fa fa-long-arrow-down"></i>Price</a></li>
                                                                    <li class="d-inline-block"><a href="javascript:void(0)" id="pickbest">Best</a></li>
                                                                    <li class="d-inline-block"><a href="javascript:void(0)" id="pickdistance">Distance</a></li>
                                                                    <li class="d-inline-block"><a href="javascript:void(0)" id="pickdiscount">Discount</a></li>
                                                                    <li class="d-inline-block"><a href="{{ url('/listing') }}"><input class="bg_none" type="button" value="clear"></a></li>
                                                                    <li class="d-inline-block"><a href="{{ url('/slotdetails') }}" >Slot</a></li>
                                                                    <li class="d-inline-block"> <a href="{{ url('/discountdetails') }}" >Discount</a></li>
                                                                    <li class="fillter_icon d-inline-block"><a href="javascript:void(0)" class="filter_pop">{{ HTML::image("public/listingimg/fillter.png") }}</a>
                                                                        <div class="filtter_option">
                                                                            <!--<form class="form-horizontal" role="form">-->
                                                                                <div class="form_title">Filters</div>
                                                                                <div class="form-group">
                                                                                    <label for="filter">Price</label>
                                                                                    <select class="form-control" id="pickfilterprice">
                                                                                        <option value="0" selected="">High to Low</option>
                                                                                        <option value="1">Low to High</option>

                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="slider-box">
                                                                                        <label for="priceRange">Distance(KM)</label>
                                                                                        <input type="text" class="priceRange" id="pickfilterdistance" readonly>
                                                                                        <div  class="slider price-range"></div></div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="slider-box">
                                                                                        <label for="discount">Discount($)</label>
                                                                                        <input type="text" class="discount" id="pickfilterdiscount" readonly>
                                                                                        <div  class="slider discount-range"></div></div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <a href="{{ url('/listing') }}"><button type="button" id="btn" class="btn btn-primary border-0">Clear</button></a>
                                                                                    <button type="submit" onClick="pickfilter()" class="btn btn-primary border-0">Apply</button></div>
                                                                            <!--</form>-->
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <div class="map">
                                                                    <span class="active">Map</span>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="map_show3">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                </section>
                                                <section class="product_listing mt-5">
                                                    <div class="container">
                                                        <div class="row" id="finalpick">
<?php 
foreach ($offers_detail as $res) {
    ?>
                                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                                    <div class="card br-0 custom_card border-0 mb-5">
                                                                        <div class="card_img position-relative">
                                                                            <div class="tag position-absolute">
                                                                                {{$res['offerdis']}} % off on all menu
                                                                            </div>
                                                                            <a href="{{ url('/restaurantdetail') }}/{{$res['userslug']}}"><?php if ($res['profile_image']) { ?>
                                                                                    {{ HTML::image(DISPLAY_FULL_PROFILE_IMAGE_PATH.$res['profile_image'],'',array('width' => '350px','height' => '250px')) }}
    <?php } else { ?>
                                                                                    {{ HTML::image("public/listingimg/food_a.png") }}
    <?php } ?>
                                                                            </a>

                                                                        </div>
                                                                        <div class="card-body px-0">
                                                                            <h4 class="card-title">{{$res['first_name']}}<button type="button" class="btn rounded-btn">{{$res['average_price']}}</button><span class="float-right"><span class="float-right">{{ App::make("ListingController")->getMiles($user_id,$res['id']) }} KM</span></h4> 
                          

                                                                            <ul class="list-unstyled">
                                                                                <li class="d-inline-block"><a href="javascript:void(0)">Free Delivery Above <i class="fa fa-inr"></i>{{$res['delivery_cost']}}</a></li>
                                                                                <li class="d-inline-block"><a href="javascript:void(0)">Min. Order <i class="fa fa-inr"></i>{{$res['minimum_order']}}</a></li>
                                                                            </ul>
                                                                            
                                                                            <ul class="list-unstyled radio-toolbar " id="timedelslot_{{$res['user_id']}}">
                                                                                <?php
                                                                                    $offslot_result = DB::table('offers')
                                                                                            ->where('offers.user_id', $res['user_id'])
                                                                                            ->where('opening_hours.open_close', '1')
                                                                                            ->join('offers_slot', 'offers_slot.offer_id', '=', 'offers.id')
                                                                                            ->join('opening_hours', 'opening_hours.user_id', '=', 'offers.user_id')
                                                                                            ->orderBY('offers_slot.created', 'DESC')
                                                                                            ->limit(1)
                                                                                            ->select('offers.created as datecreated', 'offers.id as offersid', 'offers.discount as offerdis', 'offers.*', 'offers_slot.discount as offerslotdis', 'offers_slot.offer_name as offerslotoffer_name', 'offers_slot.start_date as offerslotstart_date', 'offers_slot.end_date as offerslotend_date', 'offers_slot.start_time as offerslotstart_time', 'offers_slot.end_time as offerslotend_time', 'offers_slot.*')
                                                                                            ->get();
                                                                                    if ($offslot_result) {
                                                                    $slot_data = ' <ul class="list-unstyled radio-toolbar " id="timeslot_'.$offslot_result[0]->user_id.'">
                                                                                    <li class="d-inline-block">
                                                                                        <input type="radio" id="discount" name="radioFruit" value="apple" checked>
                                                                                        <label for="discount"><span>' . $offslot_result[0]->start_time . '</span>
                                                                                            <b>' . $offslot_result[0]->discount . '% off</b>
                                                                                        </label>
                                                                                    </li>
                                                                                    <li class="d-inline-block">
                                                                                        <input type="radio" id="radioBanana" name="radioFruit" value="banana">
                                                                                        <label for="radioBanana"><span>' . $offslot_result[0]->end_time . '</span>
                                                                                            <b>' . $offslot_result[0]->discount . '% off</b></label></li>
                                                                                             <li class="d-inline-block"><button type="button" class="bg_none rounded-btn">BookSlot</button>
                                                                                    </li>

                                                                                </ul>
                                                                                <button class="bg_none more" style="display:block" onclick="showSlot(this)" id="more_'.$offslot_result[0]->user_id.'_'.$offslot_result[0]->offersid.'" >View More</button>
                                                                                    <button class="bg_none less" style="display:none"  onclick="hideSlot(this)" id="more_'.$offslot_result[0]->user_id.'_'.$offslot_result[0]->offersid.'" >View Less</button>';
                                                                }?>

                                                                           {{$slot_data}}
                                                                           </ul>

                                                                        </div>
                                                                    </div>  


                                                                </div>
<?php } ?>


                                                        </div>
                                                    </div>
                                                </section></div>
                                            </div>

                                            <div id="myModal1" class="modal fade registration_pop" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="pop_inner">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">My Profile
                                                                </h4>
                                                                <button type="button" class="close mt-0 pt-0" data-dismiss="modal">&times;</button>

                                                            </div>
                                                            {{ Form::open(['url' => 'profile', 'method' => 'post']) }}
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
                                                                    <textarea id="address" class="form-control" readonly>{{$profile->address or ''}}</textarea>
                                                                </div>
                                                                <div class="form-group show-map">
                                                                    <a href="{{URL::to('updateLocation')}}" class="center">Update location</a>
                                                                </div>

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

