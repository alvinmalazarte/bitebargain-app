<?php if ($order->reservation_status == 'Pending') { ?>
    <a class="changestatus" data-resstatus="Confirm" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Confirm</a>
    <a class="changestatus" data-resstatus="Cancel" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>
<?php } else if ($order->reservation_status == 'Confirm') { ?>
    <a class="changestatus" data-resstatus="Complete" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Complete</a>
    <a class="changestatus" data-resstatus="No Show" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">No Show</a>
    <a class="changestatus" data-resstatus="Cancel" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>
    <?php
} else if ($order->reservation_status == 'Complete') {
    ?>
    <a class="changestatus" data-resstatus="No Show" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">No Show</a>
    <a class="changestatus" data-resstatus="Cancel" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>

<?php } else if ($order->reservation_status == 'Cancel') {
    ?>
    <a class="changestatus" data-resstatus="Confirm" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Confirm</a>
    <a class="changestatus" data-resstatus="Complete" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Complete</a>
    <a class="changestatus" data-resstatus="No Show" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">No Show</a>
<?php } else if ($order->reservation_status == 'No Show') { ?>
    <a class="changestatus" data-resstatus="Complete" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Complete</a>
    <a class="changestatus" data-resstatus="Cancel" data-id="<?php echo $order->id; ?>" href="javascript:void(0)">Cancel</a>
<?php } ?>
