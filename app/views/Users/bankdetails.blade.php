
<?php
//echo '<pre>'; print_r($bankdetails);die;
if (!$bankdetails) {
//    print_r($bankdetails);die;
    ?>

   
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Bank Details
                </header>
                <div class="panel-body">
                    <section id="no-more-tables">
                        <table class="table table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <!--<th></th>-->
                                    <th>{{ SortableTrait::link_to_sorting_action('routing', 'Routing Number') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('account', 'Account Number') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('business_tax', 'Business Tax ID (EIN)') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('first_name', 'First Name') }}</th>                                    
                                    <th>{{ SortableTrait::link_to_sorting_action('last_name', 'Last Name') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('dob', 'Date Of Birth') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('ssn', 'Last 4 Digits Of SSN') }}</th>
                                <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($bankdetails as $list) {
                                    if ($i % 2 == 0) {
                                        $class = 'colr1';
                                    } else {
                                        $class = '';
                                    }
                                    ?>
                                    <tr>
                                        
                                        <td data-title="Routing Number">
                                            {{$list->routing;}}
                                        </td>
                                         <td data-title="Account Number">
                                            {{$list->account;}}
                                        </td>
                                         <td data-title="Business Tax ID (EIN)">
                                            {{ $list->business_tax; }}
                                        </td>
                                         <td data-title="First Name">
                                            {{ ucwords($list->first_name); }}
                                        </td>
                                        <td data-title="Last Name">
                                            {{ ucwords($list->last_name); }}
                                        </td>
                                        <td data-title="Date Of Birth">
                                            {{ date("d M, Y h:i A", strtotime($list->dob)); }}
                                        </td>
                                          <td data-title="Last 4 Digits Of SSN">
                                            {{ $list->ssn; }}
                                        </td>
                                        <td data-title="Created">
                                            {{  date("d M, Y h:i A", strtotime($list->created)) }}
                                        </td>	
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </section>
        </div>
    </div>
    {{ Form::close() }} 
<?php } else {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Bank Details 
                </header>
                <div class="panel-body">
                    <section id="no-more-tables">There are no bank details added on site yet.</section>
                </div>
            </section>
        </div>
    </div>  
<?php }
?>