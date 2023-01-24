
<?php
if (!$menu->isEmpty()) {
//    print_r($usersdata->slug);die;
    ?>

    {{ Form::open(array('url' => 'admin/restaurants/Admin_menulist/'.$usersdata->slug, 'method' => 'post', 'id' => 'adminAdd', 'files' => true,'class'=>"form-inline form")) }}
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Menu List
                </header>
                <div class="panel-body">
                    <section id="no-more-tables">
                        <table class="table table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <!--<th></th>-->
                                    <th>{{ SortableTrait::link_to_sorting_action('first_name', 'Restaurant Name',$usersdata->slug) }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('name', 'Cuisine Name',$usersdata->slug) }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('discount', 'Offer (%)',$usersdata->slug) }}</th>
                                    <th>{{ SortableTrait::link_to_sorting_action('service_visibility', 'Service Visibility',$usersdata->slug) }}</th>                                    
                                    <th>{{ SortableTrait::link_to_sorting_action('created', 'Created',$usersdata->slug) }}</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($menu as $list) {
                                    if ($i % 2 == 0) {
                                        $class = 'colr1';
                                    } else {
                                        $class = '';
                                    }
                                    ?>
                                    <tr>
        <!--                                        <td data-title="Select">
                                            {{ Form::checkbox('id', $list->id,null, array("onclick"=>"javascript:isAllSelect(this.form);",'name'=>"chkRecordId[]")) }}
                                        </td>-->
                                        <td data-title="Restaurant Name">
                                            {{ ucwords($list->first_name); }}
                                        </td>

                                        <td data-title="Name">
                                            {{ $list->name }}
                                        </td>
                                        <td data-title="Offer">
                                            {{ $list->discount ? $list->discount : 'N/A' }} 
                                        </td>
                                        <td data-title="Service Visibility">
                                            {{ $list->service_visibility ? $list->service_visibility : 'N/A' }} 
                                        </td>


                                        <td data-title="Created">
                                            {{  date("d M, Y h:i A", strtotime($list->created)) }}</td>

                                                <!--<td data-title="Action">-->
                                        <?php
//                                            if (!$list->status)
//                                                echo html_entity_decode(HTML::link('admin/restaurants/Admin_activeuser/' . $list->slug, '<i class="fa fa-ban"></i>', array('class' => 'btn btn-danger btn-xs action-list', 'title' => "Active", 'onclick' => "return confirmAction('activate');")));
//                                            else
//                                                echo html_entity_decode(HTML::link('admin/restaurants/Admin_deactiveuser/' . $list->slug, '<i class="fa fa-check"></i>', array('class' => 'btn btn-success btn-xs action-list', 'title' => "Deactive", 'onclick' => "return confirmAction('deactive');")));
//                                            echo html_entity_decode(HTML::link('admin/restaurants/Admin_edituser/' . $list->slug, '<i class="fa fa-pencil"></i>', array('class' => 'btn btn-primary btn-xs', 'title' => 'Edit')));
//                                            echo html_entity_decode(HTML::link('admin/restaurants/Admin_deleteuser/' . $list->slug, '<i class="fa fa-trash-o"></i>', array('title' => 'Delete', 'class' => 'btn btn-danger btn-xs action-list delete-list', 'escape' => false, 'onclick' => "return confirmAction('delete');")));
                                        ?>
                                        <!--</td>-->	
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
                        {{ $menu->appends(Input::except('page'))->links() }}
                    </div>
                </div>
                <!--<div class="panel-body">-->
                <!--                    <button type="button" name="chkRecordId" onclick="checkAll(true);"  class="btn btn-success">Select All</button>
                                    <button type="button" name="chkRecordId" onclick="checkAll(false);" class="btn btn-success">Unselect All</button>-->
                <?php
                $arr = array(
                    "" => "Action for selected...",
                    'Activate' => "Activate",
                    'Deactivate' => "Deactivate",
                    'Delete' => "Delete",
                );
                ?>
                <!--{{ Form::select('action', $arr, null, array('class'=>"small form-control",'id'=>'action')) }}-->
                {{ Form::hidden('search', $search, array('id' => '')) }}

                <!--<button type="submit" class="small btn btn-success btn-cons" onclick=" return isAnySelect();" id="submit_action">Ok</button>-->
                <!--                </div>-->
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
                    Menu List
                </header>
                <div class="panel-body">
                    <section id="no-more-tables">There are no menu added on site yet.</section>
                </div>
            </section>
        </div>
    </div>  
<?php }
?>