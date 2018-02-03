@extends('front/layout/layout')

@section('content')
<div id="middle">
    <!-- main banner section -->
    <section>
        <div id="main-banner" class="top_slider_banner">
            <div class="banner-carousel">
                @if(sizeof($top_positions_ads) > 0)
                @foreach($top_positions_ads as $top_ad_key => $top_single_ad)
                <a href="{!! Helper::show_url($top_single_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$top_single_ad->image) !!}" alt="banner-img">
                </a>
                @endforeach
                @elseif(!empty($default_top_position_ad))
                <a href="{!! Helper::show_url($default_top_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_top_position_ad->image) !!}" alt="banner-img">
                </a>
                @endif
            </div> 
        </div>
    </section>

    <?php
    $itemname = isset($data['itemname']) ? $data['itemname'] : '';
    $city = isset($data['city']) ? $data['city'] : '';
    $lat = isset($data['lat']) ? $data['lat'] : 0;
    $lng = isset($data['lng']) ? $data['lng'] : 0;
    $km = isset($data['km']) ? $data['km'] : '';
    $cat_id = isset($data['cat_id']) ? $data['cat_id'] : '';
    $state = isset($data['usr_state']) ? $data['usr_state'] : '';
    $viewType = isset($data['viewType']) ? $data['viewType'] : 'list_view';
    //$city = isset($data['usr_city']) ? $data['usr_city'] : '';
    ?>

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active"><?php
                        if (!empty($cat_id)) {
                            echo $result[0]['catname'];
                        } else {
                            if (isset($request_category_data)) {
                                echo $request_category_data['name'];
                            } else {
                                echo 'All category';
                            }
                        }
                        ?></li>
                </ol>
            </div>
        </div>
    </section>


    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="row">

                    <!-- style in main-categories.scss file -->

                    @include('/front/search/left_sidebar_listing')

                    <!--                    <div class="col-sm-9 col-md-6 middle_section_listing">-->
                    <?php
//                        dd($template_arr);
                    if (isset($template_arr) && $isParent) {
                        $middle_layout = $template_arr->default_parent_listing_slug;
                    } else if (isset($template_arr) && $isChild) {

                        $middle_layout = $template_arr->default_child_listing_slug;
                    } else {
                        $middle_layout = 'default_child_listing_all';
                    }
//                        dd($middle_layout);
                    ?>

                    <div class="middle_and_right_section_listing">
                        @include("/front/search/$middle_layout")
                    </div>

                    <!--</div>-->



                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->

</div>
@stop




@section('scripts')

<!-- save search popup -->
<div class="modal fade" tabindex="-1" role="dialog" id="SaveSearchModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content savesearchMdoalCont">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL:: asset('/plugins/front/img/icons/close-btn.png') }}" alt="close-buton">
            </button>
            <div class="modal-body">
                <div class="savesearchData">
                    @if(!(Auth::guard('web')->user()))
                    <h4>Please login for perform this action</h4>
                    <a href="javascript:void(0)" class="sgn-in-btn-svd-srch">Click here for login</a>
                    @else
                    <h3>Saved Search Name</h3>

                    {!! Form::open(array("url" => "user/save-search", "role" => "form", 'class' => 'form-horizontal svd-srch-from', 'novalidate')) !!}

                    <?php $svdSrchUsrLoc = explode(',', trim($city)); ?>
                    <input type="text" name="name" value="Car in Melbourne" class="form-control svd-srch-frm-nm-fld">
                    <!-- <div class="savedvalue">
                        Car in Melbourne
                    </div> -->
                    <h4>Email these Search result: </h4>
                    <ul class="EmailTime">
                        <li>
                            {{ Form::radio('email_frequency', 1, true) }}
                            <label for="Amount">Immediately</label>
                        </li>
                        <li>
                            {{ Form::radio('email_frequency', 2, true) }}
                            <label for="Negotiable">Daily</label>
                        </li>
                        <li>
                            {{ Form::radio('email_frequency', 3, true) }}
                            <label for="Free">Weekely</label>
                        </li>
                        <li>
                            {{ Form::radio('email_frequency', 4, true) }}
                            <label for="Never">Never</label>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <button type="submit" class="btn orangebtn">Save This Search</button>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <button type="button" name="button" class="btn graybtn cancel-save-search">Cancel</button>
                        </div>
                    </div>

                    <input type="hidden" name="keyword" value="{{ $itemname }}">
                    <input type="hidden" name="city" value="{{ $city }}">
                    <input type="hidden" name="lat" value="{{ empty($lat)? '25.2744':$lat}}">
                    <input type="hidden" name="lng" value="{{ empty($lng)?'133.7751':$lng }}">
                    <input type="hidden" name="usr_state" value="{{ $state }}">
                    <input type="hidden" name="usr_city" value="{{ isset($svdSrchUsrLoc[0]) ? $svdSrchUsrLoc[0] : $city  }}">
                    <input type="hidden" name="usr_pcode" value="">
                    <input type="hidden" name="distance" value="{{ $km }}">
                    <input type="hidden" name="category_id" value="{{ $cat_id }}">
                    <input type="hidden" name="defaultlocation" value="{{ empty($lat) && empty($lng)? 1:0 }}">

                    {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- save search popup -->
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBSgyZIXHiAv1C-DlUlhbec0FktsEBWvq0&libraries=places&language=en-AU?sensor=false"></script>-->
<script type="text/javascript" src="{{  URL::asset('/plugins/front/js/listing_cat_js.js') }}"></script>

@stop 


