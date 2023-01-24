@extends('layouts.default')
@section('content')


{{ HTML::style('public/css/front2/slick.css') }}
{{ HTML::style('public/css/front2/slick-theme.css') }}
<div id="right_content">
    <div class="right_content">

        <div class="content_nav">
            <div class="navbar_tab" >
                <ul>
                    <?php
                    $first = "";
                    $active = '';
                    $i=0;
                    if (!$records->isEmpty()) {
                        foreach($records as $record){
                         if($i==0){
                             $first = $record->id;
                             $active= 'active';
                         }
                    ?>
                    <li><a class="<?php echo $active; ?>" href="javascript:void(0)"><?php echo $record->name; ?></a></li>
                    <?php $i++; $active=''; } } ?>
                    <li class="hidden-xs "><a class="iconn hidden-xs" href="#"><i class="fa fa-plus"></i></a></li>
                    
                    <li class="hidden-xs "><a class="iconn hidden-xs" href="#"><i class="fa fa-plus"></i></a></li>
                    <li class="hidden-xs border_none"><a class="iconn" href="#"><i class="fa fa-pencil"></i></a></li>
                </ul>   
            </div> 
        </div>    

        <div class="search_bar">
            <div class="search_field">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search"> 

            </div>  
            <div class="search_btn">
                <a class="same " href="#">Rearrange</a>
                <a class="same line_btn" href="#" data-toggle="modal" data-target="#addmenu"><i class="fa fa-plus"></i>Add Menu Item</a>
            </div>
        </div>


        <div class="menu_box">
            
            <?php
            $j=1;
                    $items = DB::table('menu_item')->select('menu_item.*')
                       ->where('menu_item.cuisines_id', $first)->orderBy('menu_item.id', 'desc')->get();
                    if($items){
                        foreach($items as $item){
                            if ($i % 2 == 0) {
                                    $class = '';
                                } else {
                                    $class = 'pull-right default stripe_none';
                                }
            ?>
                    <div class="menu_block">
                        <div class="menu_top_title">
                            <span class="pull-left">Chicken soup</span>
                            <span class="pull-right">$ 3.80</span>
                        </div>  
                        <div class="menu_content">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ...</div>
                        <div class="tabb menu_btn">
                            <div class="offer_tabb">
                                <span>Offer:</span>
                                <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/offer_icon.png"></i>20% off</a>
                            </div> 
                            <div class="offer_tabbright">


                                <div class="offer_tabb">
                                    <span>Offered on:</span>
                                    <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/deliver_icon.png"></i>Delivery</a>
                                </div>
                                <div class="offer_tabb">
                                    <span></span>
                                    <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/pickup_icon.png"></i>Pickup</a>
                                </div>
                                <div class="offer_tabb">
                                    <span></span>
                                    <a class="tab_btn" href="#"><i><img src="{{ URL::asset('public/img/front') }}/reservation_icon.png"></i>Reservations</a>
                                </div>
                            </div>

                        </div>

                        <div class="simple_btn  "><a class="green_btn" href="#">online</a>
                            <a class="simple_btn_menu menushadow" href="#">EDIT</a></div>
                        <div>   


                        </div>


                    </div>
            
            
            <?php
                        $i++; }
                    }
                    else{
            ?>
                    <div class="no_record">
            <div>No Record Found on that menu.</div>
        </div>
            <?php
                    }
            ?>
            
        </div>

    </div>
</div>


<script src="<?php echo HTTP_PATH; ?>/public/js/front2/slick.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>


<!--         <script>
  $(function() {



$('#calendar_slider2').owlCarousel({
rtl:false,
loop:true,
nav:true,
autoplay:false,
autoplayTimeout:5000,
smartSpeed: 500,
slideSpeed : 3000,
autoplayHoverPause:true,
  goToFirstSpeed: 100,
  responsive:{
  0:{items:1},
  479:{items:1},
  650:{items:5},
  766:{items:5},
  1100:{items:5},
  1280:{items:5}
}

})

});
</script>-->


<script>

    $(document).ready(function () {
        $("#sidebarCollapse").click(function () {
            $(".navbar-btn").toggleClass("menuicon");

        });
    });

</script>

<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 5) {
            $(".navbar_tab").addClass("fixed-me");
        } else {
            $(".navbar_tab").removeClass("fixed-me");
        }

        if ($(this).scrollTop() > 5) {
            $(".responsive_btn").addClass("fixed-icon");
        } else {
            $(".responsive_btn").removeClass("fixed-icon");
        }
    });
</script>




<script src="js/jquery.range.js"></script>
<script>

                $('.range-slider').jRange({
                    from: 12,
                    to: 12,
                    step: 1,
                    scale: [12, 2, 4, 6, 8, 10, 12, 2, 4, 6, 8, 10, 12],
                    format: '%s',
                    width: 300,
                    showLabels: true,
                    isRange: true
                });
</script>
@stop


