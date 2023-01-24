<?php
/*****Edit Menu Item******/
//echo '<pre>';
//print_r($menudata);
//print_r($modifiers);
//print_r($sizes);
//exit;
?>
<div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="" method="post" id="menuitem_edit" autocomplete="off">
                            <input type="hidden" value="<?php echo $cuisinesdata->id; ?>" name="selected_menu" id="editselected_menu" />
                            <input type="hidden" value="<?php echo $menudata->id; ?>" name="id" />
                            <div class="pop_form">
                                <div class="left_popdiv">
                                    <div class="pop_field">
                                        <label>Item Name</label> 
                                        <div class="input_filed">
                                            <input type="text" name="item_name" class="required" autocomplete="off" value="<?php echo $menudata->item_name; ?>" id="item_name" placeholder="Item Name">
                                        </div>
                                    </div>
                                    <div class="pop_field">
                                        <label>Price ($)</label> 
                                        <div class="input_filed">
                                            <input type="text" name="price" id="price" class="number required" value="<?php echo $menudata->price; ?>" placeholder="$">
                                        </div>
                                    </div>
                                    <div class="pop_field big_txt">
                                        <label>Description</label> 
                                        <div class="input_filed ">
                                            <textarea placeholder="Item Description" name="description" class="" id="description"><?php echo $menudata->description; ?></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" class="discount" name="discount_type" value="discounts" id="discount_type" />
                                    <div class="pop_field">
                                        <label>offerd on</label> 
                                        <?php 
                                            $offerded = explode(',',$userData->service_offered);
                                            if(count($offerded)==1){
                                                $remmargin = 1;
                                            }
                                            else {
                                                $remmargin = 0;
                                            }
                                        ?>
                                        <?php $offered_on = explode(',',$menudata->service_visibility); ?>
                                        <?php if(in_array('Delivery',$offerded)){ ?>
                                        <div class="input_filed thirhalf offer_on <?php if(in_array('Delivery',$offered_on)){ echo 'active'; } ?>">
                                            <a href="javascript:void(0)" class="offerd_on">Delivery</a>
                                        </div>
                                        <?php } ?>
                                        <?php if(in_array('Table reservations',$offerded)){ ?>
                                        <div class="input_filed thirhalf <?php if($remmargin==1 || count($offerded)==2){ } else { echo 'margin_left'; } ?> offer_on <?php if(in_array('reservation',$offered_on)){ echo 'active'; } ?>">
                                            <a href="javascript:void(0)" class="offerd_on">reservation</a>
                                        </div>
                                        <?php } ?>
                                        <?php if(in_array('Pickup',$offerded)){ ?>
                                        <div class="input_filed thirhalf <?php if($remmargin==1){  } else { echo 'margin_left'; } ?> offer_on <?php if(in_array('Pickup',$offered_on)){ echo 'active'; } ?>">
                                            <a href="javascript:void(0)" class="offerd_on">Pickup</a>
                                        </div>
                                        <?php } ?>
                                        <input type="hidden" class="service_visibile" name="service_visibility" value="<?php echo $menudata->service_visibility; ?>" id="editservice_visibility" />
                                    </div>
                                    <div class="pop_field">
                                        <label>Label</label> 
                                        <div class="input_filed lb half <?php if($menudata->spicy==1){ echo 'active'; } ?>">
                                            <a href="javascript:void(0)" class="lebel_itm" id="spicy">Spicy </a>
                                        </div>
                                        <div class="input_filed lb half margin_left <?php if($menudata->popular==1){ echo 'active'; } ?>">
                                            <a href="javascript:void(0)" class="lebel_itm" id="popular">Popular</a>
                                        </div>
                                        <?php
                                            $spicypop = '';
                                            if($menudata->spicy==1 && $menudata->popular==1){
                                                $spicypop = 'Spicy,Popular';
                                            }
                                            elseif($menudata->spicy==1 && $menudata->popular==0){
                                                $spicypop = 'Spicy';
                                            }
                                            elseif($menudata->spicy==0 && $menudata->popular==1){
                                                $spicypop = 'Popular';
                                            }
                                        ?>
                                        <input type="hidden" class="spicy_pop" name="spicy_pop" value="<?php echo $spicypop; ?>" id="editspicy_pop" />
                                    </div>
                                    <div class="pop_field">
                                        <label>Visibility</label> 
                                        <ul style="display: initial;">
                                            <li class="input_filed half <?php if($menudata->status == '1'){ echo 'active'; } ?>">
                                                <a href="javascript:void(0)" class="">Online</a>
                                            </li>
                                            <li class="input_filed half margin_left <?php if($menudata->status == '0'){ echo 'active'; } ?>">
                                                <a href="javascript:void(0)" class="">Offline</a>
                                            </li>
                                        </ul>
                                        <input type="hidden" class="status" name="status" id="editstatus" value="<?php echo $menudata->status; ?>" />
                                    </div>
                                    
                                    <div class="pop_field">
                                        <label>offer (%)</label> 
                                        <div class="input_filed">
                                            <input type="text" name="discount" id="discount" class="number " value="<?php echo $menudata->discount; ?>" placeholder="Discount Value">
                                        </div>
<!--                                        <div class="selcetdrop half new_selct select_drop  new_dropmenu">
                                            <select name="discount_type" class="required">
                                                <option value="discounts" <?php //if($menudata->discount_type=='discounts'){ echo 'Selected'; } ?>>%</option>
                                            </select>
                                            
                                        </div>
                                        <input type="hidden" class="discount" name="discount_type" value="<?php //echo $menudata->discount_type; ?>" id="discount_type" />-->
                                    </div>

                                </div>
                                <div class="right_popdiv">
                                    <div class="search_btn toggle_btn">
                                        <div class="btn-group" id="status" data-toggle="buttons">
                                            <label for="modifier_tab" class="btn btn-default btn-on btn-xs active">
                                                <input id="modifier_tab" type="radio" value="1" name="toops" checked="checked">Modifier</label>
                                            <label for="size_tab" class="btn btn-default btn-off btn-xs">
                                                <input id="size_tab" type="radio" value="0" name="toops">Size</label>
                                        </div>
                                    </div>
                                    <div id="editsection_modify">
                                        <?php $modipromt = count($modifiers);
                                        $i=1;
                                        foreach($modifiers as $modifier){
                                        ?>
                                            <div class="category_row" id="prom1">
                                                <div class="diff_row">
                                                    <label><?php echo $i;?>.</label>
                                                    <div class="big_block"> 
                                                        <input type="text"  name="prom[<?php echo $i; ?>][title]" value="<?php echo $modifier->selection ?>" placeholder="Prompt Name">
                                                    </div>
                                                    <div class="req">
                                                        <a href="javascript:void(0);" class="req_or_not" data-req="<?php echo $i; ?>">Required</a>
                                                        <input type="hidden" id="promreq<?php echo $i; ?>" name="prom[<?php echo $i; ?>][optional]" value="<?php echo $modifier->type ?>">
                                                    </div>
                                                </div>
                                                <div class="modyadd1">
                                                    <div class="caterow" id="rem<?php echo $i; ?>">
                                                        <div class="two_col">
                                                            <div class="same_btnn"> 
                                                                <input type="text" name="prom[<?php echo $i; ?>][modifier][<?php echo $i; ?>][modifier_name]" value="<?php echo $modifier->name; ?>" placeholder="Modifier Name">
                                                            </div>
                                                            <div class="same_btnn differne">
                                                                <input type="text" name="prom[<?php echo $i; ?>][modifier][<?php echo $i; ?>][modifier_price]" value="<?php echo $modifier->price; ?>" placeholder="price"><span class="sizedoller">$</span>
                                                            </div>
                                                        </div> 
                                                        <a class="close_icon remmodi" data-rem="<?php echo $i; ?>" href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                                    </div>
                                                </div>
                                                <div class="add_cate">
                                                    <a href="javascript:void(0)" class="addons" data-fielno="<?php echo $i; ?>" id="addmodify<?php echo $i; ?>"> + Add modifier </a>
                                                    <input type="hidden" id="inc1" value="2">
                                                </div>
                                                <div class="border_div"></div>
                                                    
                                            </div>
                                        <?php
                                        $i++;
                                        }
                                        ?>
                                    </div>
                                    <div id="editsection_size" style="display:none;">
                                        <div id="editinsert_size">
                                            <?php $modisize = count($sizes);
                                                $j=1;
                                                foreach($sizes as $size){
                                                ?>
                                            <div class="caterow">
                                                <div class="two_col">
                                                    <label><?php echo $j; ?>.</label>
                                                    <div class="same_btnn nw" > <input type="text" name="size[<?php echo $j; ?>][title]" value="<?php echo $size->size;?>" placeholder="Size Title"></div>
                                                    <div class="same_btnn nw"> <span class="sizedoller">$</span><input type="text" name="size[<?php echo $j; ?>][size_price]" value="<?php echo $size->size_price;?>" placeholder="Size Price"></div>
                                                    <div class="input_filed new_mntm">
                                                        <textarea name="size[<?php echo $j; ?>][description]" class="sizearea" id="size_desc" placeholder="Size Description"><?php echo $size->size_description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php $j++; } ?>
                                        </div>
                                        <div class="border_div"></div>
                                        <div class="add_cate top_spacce">
                                            <a href="javascript:void(0)" id="editsize"> + Add Size </a>
                                            <input type="hidden" name="editnum_sz" id="editnum_sz" value="<?php echo $j; ?>">
                                        </div>
                                    </div>

                                    <!--                                <div class="add_cate"> 
                                                                        <a href="javascript:void(0)" id="addmodify"> + Add modifier </a>
                                                                    </div>
                                                                    <div class="border_div"></div>-->

                                    <div class="add_cate top_spacce">
                                        <a href="javascript:void(0)" id="editpromt"> + Add prompt </a>
                                    </div>
                                    <input type="hidden" id="editnum_st" value="<?php echo $i; ?>" />

                                </div>
                                <div class="pop_btn full-width">
                                    <input type="submit" class="same_btn" id="editsubmit_btn" value="Update" />
                                    <a class="same_btn default_btn" href="#" id="cancl" data-dismiss="modal">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>