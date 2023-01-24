<?php if(!empty($orderschedules) && count($orderschedules)>0){ foreach($orderschedules as $orderschedule){ ?>
                <div class="detail_div">
                    <ul>
                        <li><span class="left_title">Reservation</span>
                            <span class="right_title"># <?php echo $orderschedule->reservation_number; ?></span></li>
                        <li><span class="left_title"><?php echo $orderschedule->first_name; ?> <?php echo substr($orderschedule->last_name,0,1); ?>.</span>
                            <span class="right_title"> <?php echo $orderschedule->size.' People' ?></span></li>
                        <li><span class="left_title">Promised by:</span>
                            <span class="right_title"><?php echo date('d/m/Y h:i A',strtotime($orderschedule->delivery_date." +30 minutes")); ?></span></li>

                    </ul>    
                </div>
                <?php } } ?>