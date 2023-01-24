@extends('layouts.default')
@section('content')
<div class="botm_wraper">
    @include('elements/left_menu')
    <div class="right_wrap">
        <div class="right_wrap_inner">
            <div class="informetion informetion_new">
                {{ View::make('elements.actionMessage')->render() }}  
                <div class="informetion_top">
                    <div class="tatils"> <span class="personal">Menu Item</span>
                        <div class="link-button"> 
                            <?php
                            echo html_entity_decode(HTML::link('user/addmenuitem', '<i class="fa  fa-plus"></i> Add Menu Item', array('title' => 'Add Menu Item', 'class' => 'btn-view btnsame', 'escape' => false)));
                            ?>
                        </div>

                    </div>
                    <div class="search-area">
                        {{ Form::open(array('url' => '/user/managemenuitem', 'method' => 'post', 'id' => 'adminAdd', 'files' => true,'class'=>'form-inline')) }}
                        <div class="form-group align_box">
                            <label class="sr-only" for="search">Your Keyword</label>
                            {{ Form::text('search', $search, array('class' => 'required search_fields form-control','placeholder'=>"Your Keyword")) }}
                        </div>

                        <div class="search_btn">{{ Form::submit('Search', array('class' => "btn btn-success")) }}</div>
                        <span class="hint" style="margin:5px 0">Search Menu Item by typing their name</span>
                        {{ Form::close() }}
                    </div>
                    <div class="pery">
                        <div class="table_scroll">
                            <div class="informetion_bxes">
                                <?php
                                if (!$records->isEmpty()) {
                                    ?>
                                    <div class="table_dcf">
                                        <div class="tr_tables">
                                            <div class="td_tables">Menu</div>
                                            <div class="td_tables">Menu Item</div>
                                            <div class="td_tables">Price{{'('.CURR.')'}}</div>
                                            <div class="td_tables">Discount (%)</div>
                                            <div class="td_tables">Spicy</div>
                                            <div class="td_tables">Discounted</div>
                                            <div class="td_tables">Visible</div>
                                            <div class="td_tables">Popular</div>
                                            <div class="td_tables">Created</div>
                                            <div class="td_tables">Action</div>
                                        </div>
                                        <?php
                                        $i = 1;
                                        foreach ($records as $data) {
                                            if ($i % 2 == 0) {
                                                $class = 'colr1';
                                            } else {
                                                $class = '';
                                            }
                                            ?>
                                            <div class="tr_tables2">
                                                <div data-title="Menu" class="td_tables2">
                                                    {{ ucwords($data->name); }}
                                                </div>
                                                <div data-title="Menu Item" class="td_tables2">
                                                    {{ ucwords($data->item_name); }}
                                                </div>
                                                <div data-title="Price" class="td_tables2">
                                                    {{$data->price}}
                                                </div>
                                                <div data-title="Discount" class="td_tables2">
                                                    {{$data->cdiscount>0?$data->cdiscount:$data->discount}}
                                                </div>
                                                <div data-title="Spicy" class="td_tables2">
                                                    {{$data->spicy?'Yes':'No'}}
                                                </div>
                                                <div data-title="Discounted" class="td_tables2">
                                                    {{$data->discounted?'Yes':'No'}}
                                                </div>
                                                <div data-title="Visible" class="td_tables2">
                                                    {{$data->visible?'Yes':'No'}}
                                                </div>
                                                <div data-title="Popular" class="td_tables2">
                                                    {{$data->popular?'Yes':'No'}}
                                                </div>

                                                <div data-title="Created" class="td_tables2">
                                                    {{date("d M, Y h:i A", strtotime($data->created)) }}
                                                </div>
                                                <div data-title="Action" class="td_tables2">
                                                    <div class="actions">
                                                        <?php
                                                        echo html_entity_decode(HTML::link('user/editmenuitem/' . $data->slug, '<i class="fa fa-pencil"></i>', array('class' => 'btn-edit btnsame', 'title' => 'Edit')));
                                                        echo html_entity_decode(HTML::link('user/deletemenuitem/' . $data->slug, '<i class="fa fa-trash-o"></i>', array('title' => 'Delete', 'class' => 'btn-delete btnsame', 'escape' => false, 'onclick' => "return confirm('Are you sure you want to delete?');")));
                                                        echo html_entity_decode(HTML::link('user/viewmenuitem/' . $data->slug, '<i class="fa fa-eye"></i>', array('class' => 'btn-view btnsame', 'title' => 'View Menu')));
                                                        ?>
                                                    </div>
                                                </div>	
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>

                                    <?php } else {
                                        ?>
                                        <div class="no-record">
                                            No records available
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="pagination pagination_css">
                                    {{ $records->appends(Request::only('search','from_date','to_date'))->links() }}
                                </div>
                            </div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


