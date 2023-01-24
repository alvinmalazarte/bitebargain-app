<ul class="menulist">
<?php
$notids = explode(',',$not_id);

foreach($items as $item){
    
    if(!in_array($item->id,$notids)){
?>
    <li data-cusine_id="<?php echo $item->cuisines_id; ?>" data-id="<?php echo $item->id; ?>" data-price="<?php echo $item->price; ?>" data-name="<?php echo $item->item_name; ?>"><?php echo $item->item_name.' ($'.$item->price.')' ?></li>
<?php
    }
}
?>    
</ul>