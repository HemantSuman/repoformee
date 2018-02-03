@extends('front/layout/layout')
@section('content')
<!-- include header -->

<div id="middle">
    <!-- main banner section -->
    <section>
        <div id="main-banner">
            <div class="banner-carousel">
                @if(sizeof($top_positions_ads) == 0)
                @if(!empty($default_top_position_ad))
                <a href="{!! Helper::show_url($default_top_position_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_top_position_ad->image) !!}" alt="banner-img">
                </a>
                @endif
                @else
                @foreach($top_positions_ads as $top_ad_key => $top_single_ad)
                <a href="{!! Helper::show_url($top_single_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$top_single_ad->image) !!}" alt="banner-img">
                </a>
                @endforeach
                @endif
            </div>

            @include('front/element/searchbar-item')
        </div>
    </section>

    <!-- breadcrumb section -->
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>              
                    <li class="active">{{ $category_name }}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9">
                        <!-- style in main-categories.scss file -->
                        <div id="left-section">
                            <div class="row">
                                <div class="col-sm-3">
                                    <aside class="search-section">
                                        <div class="title">Refine Search</div>
                                        {!! Form::open(array("role" => "form", 'class' => 'search-form', 'id' => 'MosqueSearchForm')) !!}
                                        <ul id="">
                                            <li><label>Keyword :</label>
                                                {!! Form::text("keyword", null, array('class' => 'input-text')) !!}
                                            </li>
                                            <?php
                                            //dd($newAttrArr1);
                                            if (isset($newAttrArr1) && !empty($newAttrArr1)) {
                                                foreach ($newAttrArr1 as $key => $value) {
                                                    if ($key == 'Drop-Down') {
                                                        foreach ($value as $k => $val) {

                                                            $options = '';
                                                            $options .= "<option classified_filter_id=''attr_filter_id1='" . $val[0]['attribute_id'] . "' value=''> Select Option </option> ";
                                                            $newArr = [];

                                                            foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                                                                if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {

                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];

                                                                    $classified_filter_id = json_encode($newArr);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                }
                                                                $options .= "<option classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' value=" . $k1 . ">" . $v1 . "</option>";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                
                                                                        <select value="<?php echo $val[0]['attribute_id']; ?>" class='filterdrop'>
                                                                            <?php echo $options; ?>
                                                                        </select>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'Multi-Select') {
                                                        foreach ($value as $k => $val) {
                                                            $options = '';
                                                            $newArr = [];
                                                            foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                                                                if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                                                                    $classified_filter_id = json_encode($newArr);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                }
                                                                $options .= "<li><input classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' type='checkbox' class ='filterchkbox custom-checkbox dyCheckBox_" . $val[0]['attribute_id'] . "' value='" . $k1 . "'/> " . '<label>' . $v1 . '</label></li>' . " ";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <ul class="no-pd-ul">
                                                                    
                                                                        <?php echo $options; ?>
                                                                    													
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'Radio-button') {
                                                        foreach ($value as $k => $val) {
                                                            $options = '';
                                                            $newArr = [];
                                                            foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                                                                if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                                                                    $classified_filter_id = json_encode($newArr);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                }
                                                                $options .= "<li><input type='radio' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "'  name='radio_" . $val[0]['attribute_id'] . "' class ='filterradio custom-radio' value='" . $k1 . "'/> " . '<label>' . $v1 . '</label></li>' . " ";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <ul class="no-pd-ul">
                                                                    
                                                                        <?php echo $options; ?>
                                                                    													
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'calendar') {
                                                        foreach ($value as $k => $val) {
                                                            $options = '';
                                                            $newArr = [];
                                                            if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {

                                                                $rang_cal = array_values($val[0]['attr_AllValues']);
                                                                $total = $rang_cal[1] - $rang_cal[0];

                                                                for ($i = $rang_cal[0]; $i <= $rang_cal[1]; $i = $i + 100) {
                                                                    $cIdArr = [];
                                                                    foreach ($val as $k2 => $v2) {
                                                                        $minMax = explode(';', $v2['attr_value']);
                                                                        if ($i >= $minMax[0] && $i <= $minMax[1]) {
                                                                            $cIdArr[] = $v2['classified_id'];
                                                                        }
                                                                    }
                                                                    $newArr[$val[0]['attribute_id']] = $cIdArr;
                                                                    $classified_filter_id = json_encode($newArr);
//                                                                        if($i)
                                                                    $options .= "<option classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' value=" . $i . ">" . $i . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <ul>
                                                                    <li>
                                                                        <select value="<?php echo $val[0]['attribute_id']; ?>" class='col-sm-5 filtercalanderdrop'>
                                                                            <?php echo $options; ?>
                                                                        </select>
                                                                    </li>													
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'Numeric') {
                                                        foreach ($value as $k => $val) {
//                                                                dd($val);
                                                            $options = '';
                                                            $newArr = [];
                                                            $newArr11 = [];
                                                            foreach ($val as $k2 => $v2) {

                                                                if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_filter_id = json_encode($newArr);
                                                                    $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_json_input = json_encode($newArr11);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                    $classified_json_input = '';
                                                                }
//                                                                    dd($newArr11);
                                                            }

//                                                                dd($val[0]['attr_type_name']);
                                                            if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                $options .= "<input type='text'  classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' name='' ><input type='button' value='Go' class='go-btn numericfilter'>";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <ul>
                                                                    <li>
                                                                        <?php echo $options; ?>
                                                                    </li>													
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'Date') {
                                                        foreach ($value as $k => $val) {
                                                            $options = '';
                                                            $newArr = [];
                                                            $newArr11 = [];
                                                            foreach ($val as $k2 => $v2) {

                                                                if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_filter_id = json_encode($newArr);
                                                                    $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_json_input = json_encode($newArr11);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                    $classified_json_input = '';
                                                                }
//                                                                    dd($newArr11);
                                                            }
                                                            if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                $options .= "<input type='text' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='datepicker' name='' ><input type='button' value='Go' class='go-btn datefilter'>";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <ul>
                                                                    <li>
                                                                        <?php echo $options; ?>
                                                                    </li>													
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'Time') {
                                                        foreach ($value as $k => $val) {
                                                            $options = '';
                                                            $newArr = [];
                                                            $newArr11 = [];
                                                            foreach ($val as $k2 => $v2) {

                                                                if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_filter_id = json_encode($newArr);
                                                                    $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_json_input = json_encode($newArr11);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                    $classified_json_input = '';
                                                                }
//                                                                    dd($newArr11);
                                                            }
                                                            if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                $options .= "<input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><input type='button' value='Go' class='go-btn timefilter'>";
//                                                                    $options .= "<div class='input-group bootstrap-timepicker'><input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><div class='input-group-addon' ><i class='fa fa-clock-o'></i></div></div><input type='button' value='Go' class='go-btn timefilter'>";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <ul>
                                                                    <li>
                                                                        <?php echo $options; ?>
                                                                    </li>													
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    if ($key == 'text') {
                                                       // dd('Go');
                                                        foreach ($value as $k => $val) {
                                                            $options = '';
                                                            $newArr = [];
                                                            $newArr11 = [];
                                                            $optionattr = '';
                                                            foreach ($val as $k2 => $v2) {

                                                                if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                                                                    $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_filter_id = json_encode($newArr);
                                                                    $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                                                                    $classified_json_input = json_encode($newArr11);
                                                                } else {
                                                                    $classified_filter_id = '';
                                                                    $classified_json_input = '';
                                                                }
//                                                                    dd($newArr11);
                                                            }
                                                            if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                                                                $options .= "<input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='textattr' type='text' >";
                                                                $optionattr .= "<input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='textattr' type='hidden' name='textattr[]' value='".$classified_json_input."'>";
//                                                                    $options .= "<div class='input-group bootstrap-timepicker'><input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><div class='input-group-addon' ><i class='fa fa-clock-o'></i></div></div><input type='button' value='Go' class='go-btn timefilter'>";
                                                            }
                                                            ?>
                                                            <li>
                                                                <label>{{ $k }}</label>
                                                                <?php echo $options; ?>
                                                                <?php echo $optionattr; ?>

                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>

                                            
                                            @if($show_static_attributes->show_static_attributes == 1)
                                            <li><label>Select State :</label>
                                                {!! Form::select('state', $states, isset($inputs['state']) ? $inputs['state'] : null, array('placeholder' => 'Select State', 'class' => ' msq-state')) !!}
                                            </li>
                                            <li><label>Suburb :</label>
                                                {!! Form::select('suburb', $suburbs, isset($inputs['suburb']) ? $inputs['suburb'] : null, array('placeholder' => 'Suburb', 'class' => ' msq-suburb')) !!}
                                            </li>
                                            @endif
                                            <li>
                                                <?php
                                                if (isset($newAttrArr1) && !empty($newAttrArr1)) {
                                                    foreach ($newAttrArr1 as $key => $value) {
                                                        if ($key == 'Multi-Select') {
                                                            foreach ($value as $k => $val) {
                                                                echo "<input class='attr_" . $val[0]['attribute_id'] . "' type='hidden' name='dynamicattr[]' id='' value=''>";
                                                            }
                                                        } 
                                                         else {
                                                            foreach ($value as $k => $val) {
                                                                echo "<input class='attr_" . $val[0]['attribute_id'] . "' type='hidden' name='dynamicattr[]' id='' value=''>";
                                                            }
                                                        }

                                                    }
                                                }
                                                ?>
                                                <br/>
                                                <input type="submit" value="search" class="search-btn" style="    margin-top: 13px;">
                                            </li>
                                        </ul>
                                        {!! Form::close() !!}
                                    </aside>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div id="result-view" class="search-result">
                                            <div class="top-section">
                                                <div class="col-md-7 pull-right">
                                                    <div class="filters">
                                                        <ul class="view-type">
                                                            <li class="grid_view">
                                                                <a href="javascript:void(0)">
                                                                    <img src="{{ URL::asset('plugins/front/img/grid-view.png') }}" alt="grid-view">
                                                                </a>
                                                            </li>
                                                            <li class="list_view active">
                                                                <a href="javascript:void(0)">
                                                                    <img src="{{ URL::asset('plugins/front/img/list-view.png') }}" alt="list-view">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="select-options">
                                                            {!! Form::open(array("role" => "form", 'class' => 'search-form MosSort', 'method' => 'GET')) !!}
                                                            <?php
                                                            $sortOpt = array(
                                                                'most_recent' => 'Most Recent',
                                                                'title_asc' => 'Name A to Z',
                                                                'title_desc' => 'Name Z to A'
                                                            );
                                                            ?>
                                                            {!! Form::select('sort', $sortOpt, $sortVar["val"], array('class' => 'mos_sort_drpdwn')) !!}
                                                            <!-- input type="hidden" name="keyword" class="ms_srch_keyw">
                                                            <input type="hidden" name="state" class="ms_srch_stat">
                                                            <input type="hidden" name="suburb" class="ms_srch_suburb"> -->
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="title">
                                                        <h2>{{ $category_name }}</h2>    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="search-listing">
                                                <ul>
                                                    @if(count($data) > 0)
                                                    @foreach($data as $dataKey => $dataVal)
                                                    <li>
                                                        <a href="{{ url('/classified-detail',$dataVal->classified_id) }}">
                                                            <div class="col-sm-4">
                                                                <div class="img-sec">
                                                                    <img src="{{ URL::asset('upload_images/classified/'.$dataVal->classified_id.'/'.$dataVal->name) }}" alt="listing-img">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="description-sec">
                                                                    <div class="title">{{ $dataVal->title }}</div>
                                                                    <p>{{ strip_tags(str_limit($dataVal->description, 200)) }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                    @else
                                                    <li>No Record Found.</li>
                                                    @endif
                                                    <div class="pagination-wrapper">
                                                        <div class="pagination-wrapper-inner">
                                                            {!!$data->render()!!}
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        @include('front/element/listing_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="feature-category">
            <div class="container">         
                <div class="adv-banner">
                    <!-- advertisement iframe appears here in replacement of this banner -->
                    @if(sizeof($bottom_positions_ads) == 0)
                    @if(!empty($default_bottom_position_ad))
                    <a href="{!! Helper::show_url($default_bottom_position_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_bottom_position_ad->image) !!}" alt="adv-banner.jpg">
                    </a>
                    @endif
                    @else
                    @foreach($bottom_positions_ads as $bot_ad_key => $bot_single_ad)
                    <a href="{!! Helper::show_url($bot_single_ad->image_url) !!}" target="_blank">
                        <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$bot_single_ad->image) !!}" alt="adv-banner.jpg">
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    // get subregions of the selected state
    //$('#tree1').treed({openedClass: 'fa fa-caret-down', closedClass: 'fa fa-caret-right'});
    $(document).on('change', '.msq-state', function () {
        var st_val = $(this).val();
        if (st_val != '') {
            $.ajax({
                url: root_url + '/get-suburb',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": st_val
                },
                method: "POST",
                cache: false,
                success: function (response) {
                    if (response.status) {
                        $(".msq-suburb").html('');
                        $(".msq-suburb").append($('<option></option>').val('').html('Select Suburb'));
                        $.each(response.suburbs, function (key, value) {
                            $(".msq-suburb").append($('<option></option>').val(value.id).html(value.name));
                        });
                    }
                }
            });
        }
    })

    $(document).on('change', '.mos_sort_drpdwn', function() {
        $('.ms_srch_keyw').val($('.msq-keyword').val());
        $('.ms_srch_stat').val($('.msq-state').val());
        $('.ms_srch_suburb').val($('.msq-suburb').val());
        $('.MosSort').submit();
    });

    //$("#MosqueSearchForm").submit()
</script>
@stop