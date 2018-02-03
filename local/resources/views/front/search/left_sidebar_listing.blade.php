<div class="col-sm-12 col-md-3">
    <div class="pws-sidebar-cat">
        <h3 class="sm-refine-search">Refine Search</h3>
        {!! Form::open(array('url' => '/search_classifieds_filter', 'class' => 'form', 'files' => true, 'id'=>'filter_sidebar_formid', 'method'=>'GET')); !!}
        <input type="hidden" name="cat_id" class="cat_id" value="{{(isset($request_category_data->id))?$request_category_data->id:''}}">
        <input type="hidden" name="order_by" class="order_by" value="most_recent">
        <input type="hidden" name="view_type" id="view_type" value="list-view">
        <div class="pws-sidebar">
            <h2>Refine Search</h2>
            <a class="filter-reset" href="#">Reset</a>
            <h4>Search</h4>                         

            <ul class="pws-main-cat" id="multiple" data-accordion-group>

                <li data-accordion class="open">                                   
                    <a href="javascript:void(0)" class="cat_label_li" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Category</a>
                    <ul class="pws-sub-cat child_cat_ul" data-content> 
                        @foreach($allCategoriesWithClassifiedCount as $parCatKey => $parCatvalue)

                        <?php
                        $selected_p_cat_class = '';
                        $custom_style = '';
                        if (isset($request_category_data)) {
                            if ($request_category_data->pid == 0) {

                                if ($parCatvalue->id == $request_category_data->id) {
                                    $selected_p_cat_class = 'open';
                                } else {
                                    $custom_style = 'display:none';
                                }
                            } else {

                                if ($parCatvalue->id == $request_category_data->pid) {
                                    $selected_p_cat_class = 'open';
                                } else {
                                    $custom_style = 'display:none';
                                }
                            }
                        }
                        ?>

                        <li data-accordion class="{{$selected_p_cat_class}}" style="{{$custom_style}}" >
                            <a cat_id="{{$parCatvalue->id}}" class="parent_cat_li" href="javascript:void(0)" data-control>
                                <img class="cat_icon_dy_img_{{$parCatvalue->id}}" src='{{ URL:: asset("/upload_images/categories/icon/$parCatvalue->id/$parCatvalue->icon")}}' alt="img"> 
                                <span class="cat_dy_name_{{$parCatvalue->id}}">{{$parCatvalue->text}}</span> ({{$parCatvalue->parentCategory_classifieds->count()}})
                            </a>

                            <ul class="pws-subtwo-cat" data-content>

                                @foreach($parCatvalue->children as $subCatKey => $subCatdata)

                                <li class="<?php echo (isset($request_category_data) && $request_category_data['id'] == $subCatdata->id) ? 'subcat-active':''; ?>">
                                    <a cat_id="{{$subCatdata->id}}" class="child_cat_li" href="javascript:void(0)">
                                        <img class="cat_icon_dy_img_{{$subCatdata->id}}" src='{{ URL:: asset("/upload_images/categories/icon/$subCatdata->id/$subCatdata->icon")}}' alt=""> 
                                        <span class="cat_dy_name_{{$subCatdata->id}}">{{$subCatdata->text}}</span> ({{$subCatdata->subCategory_classifieds->count()}})
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </li>
                        @endforeach

                    </ul>
                </li>

                <li data-accordion class="">                                   
                    <a href="javascript:void(0)" class="" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">
                        Location
                    </a>
                    <ul class="pws-sub-cat" data-content> 

                        <li data-accordion class="" >

                            <input name="suburbs_id" id="suburbs_id" type="hidden" >
                            <input name="suburbs_text" id="suburbs_text" type="text" >

                        </li>

                    </ul>
                </li>

                <li data-accordion class="">                                   
                    <a href="javascript:void(0)" class="" data-control>
                        <img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">
                        Posted within
                    </a>
                    <ul class="pws-sub-cat" data-content> 

                        <li data-accordion class="" >
                            <select class="onchange_dropdown" name="posted_within">
                                <option value=""> Select Option </option>
                                <option value="1-10">1-10 days</option> 
                                <option value="10-20">10-20 days</option> 
                                <option value="20-30">20-30 days</option> 
                            </select>
                        </li>

                    </ul>
                </li>
            </ul>

            <?php if($isParent || $isChild){ ?>
            <h4>Advanced Search</h4>                         
            <ul class="pws-main-cat dynamic_attr_sidebar" id="multiple" data-accordion-group>
                @include('/front/search/left_sidebar_dynamic_attributes')
            </ul>
            <?php } ?>
        </div>
        {!! Form::close() !!}
    </div>
</div>     



