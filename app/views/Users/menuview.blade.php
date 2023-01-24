@extends('layouts.default')
@section('content')
<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                {{ View::make('elements.actionMessage')->render() }}
                <div class="informetion_top">
                    <div class="tatils"><span class="personal">Menu Information</span>
                      <div class="link-button edit_pro">
                            <?php echo html_entity_decode(HTML::link('user/managemenu', '<i class="fa fa-arrow-left"></i> Back', array('class' => 'icon-3', 'title' => 'Back to menu list'))); ?>
                        </div>
                    </div>
                    <div class="informetion_bx">
                        <div class="informetion_bx_left">
                            <label>Menu Name</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->name) {
                                    echo $cuisines->name;
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
                        @if($cuisines->service)
                        <div class="informetion_bx_left">
                            <label>Service Month</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->service_month) {
                                    echo $cuisines->service_month;
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="informetion_bx_left">
                            <label>Service Start</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->service_start) {
                                    echo date('H i:s A', strtotime($cuisines->service_start));
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="informetion_bx_left">
                            <label>Service End</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->service_end) {
                                    echo date('H i:s A', strtotime($cuisines->service_end));
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
                        @endif

                        <div class="informetion_bx_left">
                            <label>Visibility</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->visibility) {
                                    echo 'ON';
                                } else {
                                    echo "OFF";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="informetion_bx_left">
                            <label>Service Visibility</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->service_visibility) {
                                    echo $cuisines->service_visibility;
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="informetion_bx_left">
                            <label>Offer (%)</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->discount) {
                                    echo $cuisines->discount;
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
<!--                        <div class="informetion_bx_left">
                            <label>Menu Description</label>
                            <div class="im_txt">
                                <?php
//                                if ($cuisines->menu_description) {
//                                    echo nl2br($cuisines->menu_description);
//                                } else {
//                                    echo "N/A";
//                                }
                                ?>
                            </div>
                        </div>-->
                         <div class="informetion_bx_left">
                            <label>Created</label>
                            <div class="im_txt">
                                <?php
                                if ($cuisines->created) {
                                    echo date('Y-m-d',strtotime($cuisines->created));
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop


