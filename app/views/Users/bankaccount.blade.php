@extends('layouts.default')
@section('content')
<!-- Page Content Holder -->

<div id="right_content">
    <div class="right_content">
        <div class="content_nav">
            <div class="navbar_tab" >
                <ul>
                    <li><a class="" href="<?php echo HTTP_PATH . 'user/myaccount'; ?>">profile</a></li>
                    <li><a class="active" href="<?php echo HTTP_PATH . 'user/bankaccount'; ?>">bank account</a></li>
                    <li><a href="<?php echo HTTP_PATH . 'user/openinghours'; ?>">operating hours</a></li>
                    <?php if(isset($bankAccount->slug)){ ?>
                        <li><a class="iconn hidden-xs" href="<?php echo HTTP_PATH . 'user/editAccount/'.$bankAccount->slug; ?>"><i class="fa fa-pencil"></i></a></li>
                    <?php } else { ?>
                        <li><a class="iconn hidden-xs" href="<?php echo HTTP_PATH . 'user/editAccount/new'; ?>"><i class="fa fa-pencil"></i></a></li>
                    <?php } ?>
                    
                    <li class="right_icon hidden-xs"><a class="iconn" href="#"><i class="fa fa-bell"></i></a></li>
                </ul>   
            </div> 
        </div>    

        <div class="detail_box">
            <div class="roww edit_profile ">
                <div class="block">
                    <div class="title_name">Routing Number</div>
                    <div class="single"><div class="digitt"><?php
                            if (isset($bankAccount->routing) && !empty($bankAccount->routing)) {
                                echo $bankAccount->routing;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
                <div class="block">
                    <div class="title_name">Account Number</div>
                    <div class="single"> <div class="digitt"><?php
                            if (isset($bankAccount->account) && !empty($bankAccount->account)) {
                                echo $bankAccount->account;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
                <div class="block">
                    <div class="title_name">Business Tax ID (EIN)</div>
                    <div class="single"><div class="digitt"><?php
                            if (isset($bankAccount->business_tax) && !empty($bankAccount->business_tax)) {
                                echo $bankAccount->business_tax;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
            </div> 
            <div class="roww edit_profile">
                <div class="block">
                    <div class="title_name">First Name</div>
                    <div class="single"><div class="digitt"><?php
                            if (isset($bankAccount->first_name) && !empty($bankAccount->first_name)) {
                                echo $bankAccount->first_name;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
                <div class="block">
                    <div class="title_name">Last Name</div>
                    <div class="single"> <div class="digitt"><?php
                            if (isset($bankAccount->last_name) && !empty($bankAccount->last_name)) {
                                echo $bankAccount->last_name;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
                <div class="block">
                    <div class="title_name">Date Of Birth</div>
                    <div class="single"><div class="digitt"><?php
                            if (isset($bankAccount->dob) && !empty($bankAccount->dob)) {
                                echo date('Y-m-d', strtotime($bankAccount->dob));
                            } else {
                                echo "N/A";
                            }
                            ?><a class="pull-right"><i class="fa fa-calendar"></i></a></div></div>
                </div>
                <div class="block">
                    <div class="title_name">Last 4 Digits Of SSN</div>
                    <div class="single"><div class="digitt"><?php
                            if (isset($bankAccount->ssn) && !empty($bankAccount->ssn)) {
                                echo $bankAccount->ssn;
                            } else {
                                echo "N/A";
                            }
                            ?></div></div>
                </div>
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


