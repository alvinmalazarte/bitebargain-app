@extends('layouts.default')
@section('content')
<!-- Page Content Holder -->
{{ Form::model($userData, array('url' => '/user/editProfile', 'method' => 'post', 'id' => 'myform', 'files' => true,'class'=>"cmxform form-horizontal tasi-form form")) }}
<div id="right_content">
    <div class="right_content">
        <div class="content_nav">
            <div class="navbar_tab" >
                <ul>
                    <li><a class="active" href="<?php echo HTTP_PATH.'user/myaccount'; ?>">profile</a></li>
                    <li><a href="<?php echo HTTP_PATH.'user/bankaccount'; ?>">bank account</a></li>
                    <li><a href="<?php echo HTTP_PATH . 'user/openinghours'; ?>">operating hours</a></li>
                    <li><a class="iconn hidden-xs" href="<?php echo HTTP_PATH . 'user/editProfile'; ?>"><i class="fa fa-pencil"></i></a></li>
                    <li class="right_icon hidden-xs"><a class="iconn" href="#"><i class="fa fa-bell"></i></a></li>
                </ul>   
            </div> 
        </div>    
        {{ View::make('elements.actionMessage')->render() }}
        <div class="detail_box">
            <div class="roww">
                <div class="mobile_icon"><a class="iconn" href="<?php echo HTTP_PATH . 'user/editProfile'; ?>"><i class="fa fa-pencil"></i></a>
                    <a class="iconn" href="#"><i class="fa fa-bell"></i></a>
                </div>
                <div class="block">
                    <div class="title_name">restaurant name</div>
                    <div class="digitt"><?php
                        if ($userData->first_name) {
                            echo ucfirst($userData->first_name);
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">email</div>
                    <div class="digitt"><?php
                        if ($userData->email_address) {
                            echo $userData->email_address;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">phone#1</div>
                    <div class="digitt"><?php
                        if ($userData->phone1) {
                            echo $userData->phone1;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">phone#2</div>
                    <div class="digitt"><?php
                        if ($userData->phone2) {
                            echo $userData->phone2;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">phone#3</div>
                    <div class="digitt"><?php
                        if ($userData->phone3) {
                            echo $userData->phone3;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">phone#4</div>
                    <div class="digitt"><?php
                        if ($userData->phone4) {
                            echo $userData->phone4;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">cell#1</div>
                    <div class="digitt"><?php
                        if ($userData->cell_phone1) {
                            echo $userData->cell_phone1;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">cell#2</div>
                    <div class="digitt"> <?php
                        if ($userData->cell_phone2) {
                            echo $userData->cell_phone2;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
<div class="block">
                    <div class="title_name">cell#3</div>
                    <div class="digitt"> <?php
                        if ($userData->cell_phone3) {
                            echo $userData->cell_phone3;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">cell#4</div>
                    <div class="digitt"> <?php
                        if ($userData->cell_phone4) {
                            echo $userData->cell_phone4;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">fax#1</div>
                    <div class="digitt"> <?php
                        if ($userData->fax_number) {
                            echo $userData->fax_number;
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </div>
                </div>
            </div> 
            <div class="roww">
                <div class="block">
                    <div class="title_name">address</div>
                    <div class="single"><div class="digitt"><?php
                            if ($userData->address) {
                                echo $userData->address;
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">city</div>
                    <div class="single"> <div class="digitt">
                            <?php
                            if ($userData->city) {
                                echo $userData->city;
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="title_name">state</div>
                    <div class="single"><div class="digitt"><?php
                            if ($userData->state) {
                                echo $userData->state;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
                <div class="block">
                    <div class="title_name">zipcode</div>
                    <div class="single"> <div class="digitt"><?php
                            if ($userData->zipcode) {
                                echo $userData->zipcode;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
            </div> 
            <div class="roww">
                <div class="block">
                    <div class="title_name">service offered</div>
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
                    <?php
                    if ($userData->restaurant_cat) {
                        $restaurant_cat = explode(',', $userData->restaurant_cat);
                        if ($restaurant_cat) {
                            foreach ($restaurant_cat as $restaurant_cats) {
                                echo "<div class='single'><div class='digitt'>" . $restaurant_cats . "</div></div>";
                            }
                        }
                    } else {
                        echo "<div class='digitt'>N/A</div>";
                    }
                    ?>
                </div>
                <div class="block full_view">
                    <div class="title_name">cuisines</div>
                    <?php
                    if ($userData->cuisines) {
                        $cuisines = explode(',', $userData->cuisines);
                        if ($cuisines) {
                            foreach ($cuisines as $cuisiness) {
                                echo "<div class='single'><div class='digitt'>" . $cuisiness . "</div></div>";
                            }
                        }
                    } else {
                        echo "<div class='digitt'>N/A</div>";
                    }
                    ?>
                </div>
                <div class="block">
                    <div class="title_name">payment options</div>
                    <?php
                    if ($userData->payment_options) {
                        $payment_options = explode(',', $userData->payment_options);
                        if ($payment_options) {
                            foreach ($payment_options as $payment_optionss) {
                                echo "<div class='single'><div class='digitt'>" . $payment_optionss . "</div></div>";
                            }
                        }
                    } else {
                        echo "N/A";
                    }
                    ?>
                </div>
            </div>
            <div class="roww">
                <div class="block">
                    <div class="title_name">sales tax</div>
                    <div class="single"><div class="digitt"><?php
                            if ($userData->sales_tax) {
                                echo $userData->sales_tax.'%';
                            } else {
                                echo "N/A";
                            }
                            PER
                            ?> </div></div> </div>
                <div class="block">
                    <div class="title_name">average price</div>
                    <div class="single"> <div class="digitt"> <?php
                            if ($userData->average_price) {
                                echo CURR . number_format($userData->average_price, 2);
                            } else {
                                echo "N/A";
                            }
                            ?></div></div></div>
                <div class="block">
                    <div class="title_name">parking</div>
                    <div class="single">   <div class="digitt"><?php
                    if ($userData->parking && !empty($userData->parking)) {
                        echo $userData->parking ? 'yes' : 'no' ;
                    }
                    else
                    {
                        echo "N/A";
                    }
                            
                            ?></div></div></div>
                <div class="block">
                    <div class="title_name">delivery option</div>
                    <div class="single"><div class="digitt">   <?php
                            if ($userData->delivery_type) {
                                echo $userData->delivery_type;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div></div>
                <div class="block">
                    <div class="title_name">delivery cost</div>
                    <div class="single"><div class="digitt"> <?php
                            if ($userData->delivery_cost) {
                                echo CURR . number_format($userData->delivery_cost, 2);
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
                <div class="block">
                    <div class="title_name">est.delivery time</div>
                    <div class="single"><div class="digitt"> <?php
                            if ($userData->estimated_time) {
                                echo $userData->estimated_time;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div></div>
                <div class="block">
                    <div class="title_name">min.order</div>
                    <div class="single"><div class="digitt"><?php
                            if ($userData->minimum_order) {
                                echo CURR . number_format($userData->minimum_order, 2);
                            } else {
                                echo "N/A";
                            }
                            ?></div></div></div>

                <div class="block full_block">
                    <div class="title_name">Description</div>
                    <div class="single"><div class="digitt"><?php
                            if ($userData->description) {
                                echo nl2br(strip_tags($userData->description));
                            } else {
                                echo "N/A";
                            }
                            ?></div></div></div>

            </div>

        </div>   
    </div>   
</div>
<script>
if ($(window).width() < 514) {
        $('#sidebarCollapse').removeClass('calendarnav');
    } else {
        $('#sidebarCollapse').addClass('calendarnav');
    }
</script>
@stop


