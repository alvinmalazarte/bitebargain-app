@extends('layouts.default')
@section('content')
<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                {{ View::make('elements.actionMessage')->render() }}
                <div class="informetion_top">
                    <div class="tatils"><span class="personal">Menu Item Information</span>
                        <div class="link-button edit_pro">
                            <?php echo html_entity_decode(HTML::link('user/managemenuitem', '<i class="fa fa-arrow-left"></i> Back', array('class' => 'icon-3', 'title' => 'Back to menu list'))); ?>
                        </div>
                    </div>
                    <div class="informetion_bx">
                        <div class="informetion_bx_left">
                            <label>Menu Name</label>
                            <div class="im_txt">
                                <?php
//                                echo '<pre>';print_r($menuitem);die;
                                if ($menuitem->menu_name) {
                                    echo ucfirst($menuitem->menu_name);
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="informetion_bx_left">
                            <label>Spicy</label>
                            <div class="im_txt">
                                <?php
                                if ($menuitem->spicy) {
                                    echo 'Yes ';
                                } else {
                                    echo "No";
                                }
                                ?>
                            </div>
                        </div>

                        <!--                        <div class="informetion_bx_left">
                                                    <label>Discounted</label>
                                                    <div class="im_txt">
                        <?php
                        if ($menuitem->discounted) {
                            echo 'Yes ';
                        } else {
                            echo "No";
                        }
                        ?>
                                                    </div>
                                                </div>-->

                        <div class="informetion_bx_left">
                            <label>Visible</label>
                            <div class="im_txt">
                                <?php
                                if ($menuitem->visible) {
                                    echo 'Yes ';
                                } else {
                                    echo "No";
                                }
                                ?>
                            </div>
                        </div>


                        <div class="informetion_bx_left">
                            <label>Popular</label>
                            <div class="im_txt">
                                <?php
                                if ($menuitem->popular) {
                                    echo 'Yes ';
                                } else {
                                    echo "No";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="informetion_bx_left">
                            <label>Service Visibility</label>
                            <div class="im_txt">
                                <?php
                                if ($menuitem->service_visibility) {
                                    echo $menuitem->service_visibility;
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
                                if ($menuitem->discount) {
                                    echo $menuitem->discount;
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="menu_type">
                            <div class="menu_sub">Menu</div>
                            <div class="informetion_bx_left">
                                <label>Menu Item Name</label>
                                <div class="im_txt">
                                    <?php
                                    if ($menuitem->item_name) {
                                        echo ucfirst($menuitem->item_name);
                                    } else {
                                        echo "N/A";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="informetion_bx_left">
                                <label>Menu Item Description</label>
                                <div class="im_txt">
                                    <?php
                                    if ($menuitem->description) {
                                        echo nl2br($menuitem->description);
                                    } else {
                                        echo "N/A";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $menuitemsize = DB::table('item_size')
                                ->where('item_size.item_id', $menuitem->id)
                                ->get();
//                        echo '<prE>' ; print_r($menuitemsize);die;
                        if ($menuitemsize) {
                            foreach ($menuitemsize as $menuitemsizes) {
                                ?>
                                <div class="menu_type">
                                    <div class="menu_sub">Item Detail</div>
                                    <div class="informetion_bx_left">
                                        <label>Item Size Title </label>
                                        <div class="im_txt">
                                            <?php
                                            if ($menuitemsizes->size) {
                                                echo $menuitemsizes->size;
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="informetion_bx_left">
                                        <label>Item Size Price </label>
                                        <div class="im_txt">
                                            <?php
                                            if ($menuitemsizes->size_price) {
                                                echo number_format($menuitemsizes->size_price, 2);
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="informetion_bx_left">
                                        <label>Item Size Description</label>
                                        <div class="im_txt">
                                            <?php
                                            if ($menuitemsizes->size_description) {
                                                echo nl2br($menuitemsizes->size_description);
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                        <div class="informetion_bx_left">
                            <label>Menu Item Price </label>
                            <div class="im_txt">
                                <?php
                                if ($menuitem->price) {
                                    echo number_format($menuitem->price, 2);
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                        $item_modifier = DB::table('item_modifier')
                                ->where('item_modifier.item_id', $menuitem->id)
                                ->get();

                        if ($item_modifier) {
                            foreach ($item_modifier as $item_modifiers) {
                                ?>
                                <div class="menu_type">
                                    <div class="menu_sub">Modifier</div>
                                    <div class="informetion_bx_left">
                                        <label>Modifier  Name </label>
                                        <div class="im_txt">
                                            <?php
                                            if ($item_modifiers->name) {
                                                echo $item_modifiers->name;
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="informetion_bx_left">
                                        <label>Modifier Quantity</label>
                                        <div class="im_txt">
                                            <?php
                                            if ($item_modifiers->qty) {
                                                echo $item_modifiers->qty;
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>

<?php if (file_exists(UPLOAD_FULL_ITEM_IMAGE_PATH . '/' . $menuitem->image) && $menuitem->image != "") { ?>
                            <div class="informetion_bx_left">
                                <label>Menu Item Image</label>
                                <div class="im_txt">
                                    <div class="img_uploas">
                                        {{ HTML::image(DISPLAY_FULL_ITEM_IMAGE_PATH.$menuitem->image, '', array('width' => '100px')) }}
                                    </div>
                                </div>
                            </div>
<?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
@stop


