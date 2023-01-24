<ul class="menulist">
<?php
foreach($items as $item){
?>
    <li class="modif" data-updated="<?php echo $itemid; ?>" data-item_id="<?php echo $item->item_id; ?>" data-id="<?php echo $item->id; ?>" data-price="<?php echo $item->price; ?>" data-name="<?php echo $item->name; ?>"><?php echo $item->name.' ($'.$item->price.')' ?></li>
<?php
}
?>    
</ul>