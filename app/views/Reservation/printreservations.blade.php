<?php

?>
@extends('layouts.printres')
@section('content')
<?php //print_r($ownerData); ?>
<div class="printcontainer" style="max-width: 1170px; margin: 40px auto;">
         <table>
             <tbody>
                 <tr>
                     <td style="width: 20%;">
                         <?php
                            if(empty($ownerData->profile_image) && $ownerData->profile_image==''){
                        ?>
                            <div class="logo big_logo"><a href="<?php echo HTTP_PATH; ?>"><img src="{{ URL::asset('public/img/front') }}/noimage.png"     width="200px"></a></div>    
                        <?php
                            }
                            else
                            {
                        ?>
                            <div class="logo big_logo"><a href="<?php echo HTTP_PATH; ?>"><img src="{{ URL::asset(DISPLAY_FULL_PROFILE_IMAGE_PATH.$ownerData->profile_image) }}" width="200px"></a></div>    
                        <?php
                            }
                        ?>   
                     </td>   
                     <td style="width: 20%;">
                         <b style="font-size: 20px;">Email</b>
                         <p style="font-size: 20px;"><?php echo $ownerData->email_address; ?></p>
                     </td>
                      <td style="width: 20%;">
                         <b style="font-size: 20px;">Phone</b>
                         <p style="font-size: 20px;"><?php echo $ownerData->phone1; ?></p>
                     </td>
                      <td style="width: 20%;">
                         <b style="font-size: 20px;">Address</b>
                         <p style="font-size: 20px;"><?php echo $ownerData->address; ?></p>
                     </td>
                 </tr>    
             </tbody>    
             
             
         </table>    
         
         <table style="margin: 30px 0px 50px;     font-size: 16px;">
             <tbody>
                 <tr>
                     <td style="font-size: 24px;"><?php echo $ownerData->first_name; ?></td>   
                 </tr>     
             </tbody>   
         </table>
         
          <table style="margin: 30px 0px 0px; width: 100%;">
             <tbody>
                 <tr>
                     <td style="font-size: 20px;     padding: 0px 0px 10px 0px;"><b>Reservation Details</b></td>   
                 </tr>   
                
             </tbody>   
         </table>
         
         
          <table style=" width: 100%; border: 1px solid #000; font-size: 16px;">
             <tbody>
                 <tr>
                     <td style="padding: 14px 0px 14px 20px;">Customer Name</td>  
                      <td style="float:right; padding: 14px 20px 14px 0px;"><?php echo $orderData->first_name.' '.$orderData->last_name; ?></td>  
                 </tr>   
                 <tr>
                     <td style="padding: 0px 0px 0px 20px;">Phone :</td>  
                      <td style="float:right;  padding: 0px 20px 0px 0px;"><?php echo $orderData->contact; ?></td>  
                 </tr> 
                  <tr>
                     <td style="padding: 14px 0px 14px 20px;">Email :</td>  
                      <td style="float:right;  padding: 14px 20px 14px 0px;"><?php echo $orderData->email_address; ?></td>  
                 </tr> 
                
             </tbody>   
         </table>
         
         
   <table style=" width: 100%;border: 1px solid #000; margin: 20px 0px 50px;     font-size: 16px;">
             <tbody>
                 <tr>
                     <td style="padding: 14px 0px 14px 20px;">Promised By</td>  
                      <td style="float:right; padding: 14px 20px 14px 0px;"><?php echo date('d/m/Y',strtotime($orderData->reservation_date)); ?> ASAP</td>  
                 </tr>   
                 <tr>
                     <td style="padding: 0px 0px 14px 20px;">Received at :</td>  
                      <td style="float:right;  padding: 0px 20px 14px 0px;"><?php echo date('d/m/Y H:i a',strtotime($orderData->created)); ?></td>  
                 </tr> 
              
                
             </tbody>   
         </table>
         
    <table style=" width: 100%;     border: 1px solid #000;     font-size: 16px;">
             <tbody>
                 <tr>
                     <td style="padding: 14px 0px 14px 20px;">Party Size :</td>  
                      <td style="float:right; padding: 14px 20px 14px 0px;"><?php echo $orderData->size; ?></td>  
                 </tr>   
                 <tr>
                     <td style="padding: 0px 0px 0px 20px;">Special Instructions :</td>  
                      <td style="float:right;  padding: 0px 20px 0px 0px;"><?php echo $orderData->note; ?></td>  
                 </tr> 
                 <?php if(!empty($offerData)){ ?>
                  <tr>
                     <td style="padding: 14px 0px 14px 20px;">Discount :</td>  
                      <td style="float:right;  padding: 14px 20px 14px 0px;"><?php echo $offerData->discount; ?>% off on pizzas</td>  
                 </tr> 
                 <?php } ?>
             </tbody>   
         </table>
         
         <table style="    width: 100%;margin: 80px 0px 0px 0px;">
             <tbody>
                 <tr><td style="float: right;font-size: 16px;color: #000;font-weight: bold;">Date Created : 02/13/2018 </td>   </tr>  
                  
             </tbody>    
         </table> 
         
     </div> 
<div class="print_btn" style="text-align: center; padding-bottom:12px;">
    <form>    
        <a title="Print This Order" class="icon-5 print btn btn-primary"  href="javascript:void(0)">Print Order</a> 

    </form>              
</div>


<script src="{{ URL::asset('public/js/front/jQuery.print.js') }}"></script>
<script type='text/javascript'>

$(function () {

    $(".print").on('click', function () {
        //Print ele4 with custom options
        $(".printcontainer").print({
            //Use Global styles
            globalStyles: false,
            //Add link with attrbute media=print
            mediaPrint: false,
            //Custom stylesheet
            stylesheet: "<?php echo HTTP_PATH . "public/css/front/print.css" ?>",
            //Print in a hidden iframe
            iframe: false,
            //Don't print this
            noPrintSelector: ".avoid-this",
        });
    });
    // Fork https://github.com/sathvikp/jQuery.print for the full list of options
});
</script>
@stop