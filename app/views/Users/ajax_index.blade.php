
<?php
if (!$users->isEmpty()) {
    ?>

    {{ Form::open(array('url' => 'admin/restaurants/admin_index', 'method' => 'post', 'id' => 'adminAdd', 'files' => true,'class'=>"form-inline form")) }}
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Restaurants List
                </header>
                <div class="panel-body">
                    <section id="no-more-tables">
                        <table class="table table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <th></th>
                                    <th>{{ SortableTrait::link_to_sorting_action('first_name', 'Restaurant Name') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('email_address', 'Email Address') }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('created', 'Created') }}</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($users as $user) {
                                    if ($i % 2 == 0) {
                                        $class = 'colr1';
                                    } else {
                                        $class = '';
                                    }
                                    ?>
                                    <tr>
                                        <td data-title="Select">
                                            {{ Form::checkbox('id', $user->id,null, array("onclick"=>"javascript:isAllSelect(this.form);",'name'=>"chkRecordId[]")) }}
                                        </td>
                                        <td data-title="Name">
                                            {{ ucwords($user->first_name); }}
                                        </td>

                                        <td data-title="Email Address">
                                            {{ $user->email_address }}
                                        </td>

                                        <td data-title="Created">
                                            {{  date("d M, Y h:i A", strtotime($user->created)) }}</td>

                                        <td data-title="Action">
                                            <?php
                                            if (!$user->status)
                                                echo html_entity_decode(HTML::link('admin/restaurants/Admin_activeuser/' . $user->slug, '<i class="fa fa-ban"></i>', array('class' => 'btn btn-danger btn-xs action-list', 'title' => "Active", 'onclick' => "return confirmAction('activate');")));
                                            else
                                                echo html_entity_decode(HTML::link('admin/restaurants/Admin_deactiveuser/' . $user->slug, '<i class="fa fa-check"></i>', array('class' => 'btn btn-success btn-xs action-list', 'title' => "Deactive", 'onclick' => "return confirmAction('deactive');")));

                                            echo html_entity_decode(HTML::link('admin/restaurants/Admin_edituser/' . $user->slug, '<i class="fa fa-pencil"></i>', array('class' => 'btn btn-primary btn-xs', 'title' => 'Edit')));
                                            echo html_entity_decode(HTML::link('admin/restaurants/Admin_deleteuser/' . $user->slug, '<i class="fa fa-trash-o"></i>', array('title' => 'Delete', 'class' => 'btn btn-danger btn-xs action-list delete-list', 'escape' => false, 'onclick' => "return confirmAction('delete');")));
                                            echo html_entity_decode(HTML::link('admin/restaurants/Admin_menulist/' . $user->slug, '<i class="fa fa-cutlery"></i>', array('class' => 'btn btn-primary btn-xs', 'title' => 'Menu List')));
                                            echo html_entity_decode(HTML::link('admin/restaurants/Admin_openinghours/' . $user->slug, '<i class="fa fa-clock-o"></i>', array('class' => 'btn btn-primary btn-xs action-list', 'title' => 'Manage Opening hours')));
//                                            echo html_entity_decode(HTML::link('admin/restaurants/banking/' . $user->slug, '<i class="fa fa-university"></i>', array('class' => 'btn btn-primary btn-xs action-list', 'title' => 'Manage Slot Management')));
                                            if($user->account)
                                            echo html_entity_decode(Html::link('#user_details_' . $user->id, '<i class="fa fa-eye"></i>', array('title' => 'View User Details', 'class' => 'btn btn-primary btn-xs user-view', 'data-toggle' => "modal")));
                                            
                                            ?>
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
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body border-bottom">
                    <div class="dataTables_paginate paging_bootstrap pagination">
                        {{ $users->appends(Input::except('page'))->links() }}
                    </div>
                </div>
                <div class="panel-body">
                    <button type="button" name="chkRecordId" onclick="checkAll(true);"  class="btn btn-success">Select All</button>
                    <button type="button" name="chkRecordId" onclick="checkAll(false);" class="btn btn-success">Unselect All</button>
                    <?php
                    $arr = array(
                        "" => "Action for selected...",
                        'Activate' => "Activate",
                        'Deactivate' => "Deactivate",
                        'Delete' => "Delete",
                    );
                    ?>
                    {{ Form::select('action', $arr, null, array('class'=>"small form-control",'id'=>'action')) }}
                    {{ Form::hidden('search', $search, array('id' => '')) }}

                    <button type="submit" class="small btn btn-success btn-cons" onclick=" return isAnySelect();" id="submit_action">Ok</button>
                </div>
            </section>
        </div>
    </div>
    <?php
    foreach ($users as $user) { ?>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="user_details_<?php echo $user->id; ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bgchange">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Bank Details</h4>
                </div>
                <div class="modal-body">
                    <div class="col-lg-20">
                        <section class="panel">

                            <ul class="list-group">

                                <li class="list-group-item">
                                    <b>First Name</b>: 
                                    {{ $user->ac_first_name ? ucwords($user->ac_first_name):'N/A'; }}
                                </li>
                               <li class="list-group-item">
                                    <b>Last Name</b>: 
                                    {{ $user->ac_last_name ? ucwords($user->ac_last_name):'N/A'; }}
                                </li>
                                <li class="list-group-item">
                                    <b>D.O.B</b>: 
                                    {{ $user->dob  > 0  ? date('YYYY-mm-dd',strtotime($user->dob)):'N/A'; }}
                                </li>
                                <li class="list-group-item">
                                    <b>Routing Number</b>: 
                                    {{  $user->routing ?  ucwords($user->routing) : ''; }}
                                </li>
                                 <li class="list-group-item">
                                    <b>Account Number</b>: 
                                    {{  $user->account ?  $user->account :''; }}
                                </li>
                                 <li class="list-group-item">
                                    <b>Business Tax ID (EIN)</b>: 
                                    {{  $user->business_tax ?  $user->business_tax:''; }}
                                </li> <li class="list-group-item">
                                    <b>Last 4 Digits Of SSN</b>: 
                                    {{  $user->ssn ? $user->ssn:''; }}
                                </li>
                                
                            </ul>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    {{ Form::close() }} 

<?php } else {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Restaurants List
                </header>
                <div class="panel-body">
                    <section id="no-more-tables">There are no Restaurant added on site yet.</section>
                </div>
            </section>
        </div>
    </div>  
<?php }
?>