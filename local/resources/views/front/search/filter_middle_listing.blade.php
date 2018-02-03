<div class="row">
    <div class="col-md-5">
        <ul class="view-type">
            <?php
            if(!empty($template_arr) && $template_arr->template_slug != 'realestate'){
            $active_grid = '';
            $active_list = '';
            if (isset($request_data_arr['view_type']) && $request_data_arr['view_type'] == 'list-view') {
                $active_list = 'active';
            } else if (isset($request_data_arr['view_type']) && $request_data_arr['view_type'] == 'grid-view') {
                $active_grid = 'active';
            } else {
                $active_list = 'active';
            }
            ?>
            <li class="grid_view {{$active_grid}}">
                <a href="javascript:void(0)"></a>
            </li>
            <li class="list_view {{$active_list}}">
                <a href="javascript:void(0)"></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col-md-7">
        <div class="filters">
            <span class="sortby">Sort by:</span>
            <div class="sorting-options">
                <?php
                $sort_classified_listing = [
                    'most_recent' => 'Most Recent',
                    'title_asc' => 'Name A to Z',
                    'title_desc' => 'Name Z to A',
                    'price_htl' => 'Price High to Low',
                    'price_lth' => 'Price Low to High',
                ];
                ?>
                {!! Form::select('sort-classified-listing', $sort_classified_listing, (isset($request_data_arr['order_by']))?$request_data_arr['order_by']:'', ['class' => 'sort-classified-listing']) !!}

            </div>
            <span class="decending-img"><img src="{{ URL::asset('plugins/front/img/descending.png') }}" alt=""></span>
        </div>
    </div>
</div>