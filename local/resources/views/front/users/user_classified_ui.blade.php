<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {display:none;}

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<div class="Messageblock manageads">
    @if($data->total() > 0)
    @foreach($data as $uacKey => $uacVal) 

    <div class="row msgrow">
        <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <ul class="firstBox">
                        <li class="chek">
                            <a>
                                <input type="checkbox" name="" value="" class="m-checkbox">
                                <label></label>
                            </a>
                        </li>
                        <li class="hert">
                            @if(in_array($uacVal['id'], $wishlistItems))
                            <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $uacVal['id'] }}">
                                <div class="heart" data-id="{{ $uacVal['id'] }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </div>
                                1000
                            </a>
                            @else
                            <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $uacVal['id'] }}">
                                <div class="heart">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </div>
                                1000
                            </a>
                            @endif


                            <!-- <a>
                                <span><i class="fa fa-heart-o"></i></span>
                            </a> -->
                        </li>
                    </ul>
                </div> 

                <div class="col-md-7 col-sm-7">
                    <div class="msgImg">
                        <?php /* <img src="{!! asset('/upload_images/classified/'.$uacVal['id'].'/'.$uacVal->classified_image[0]['name']) !!}" alt=""> */ ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-6">
                    <div class="msgData">
                        <?Php $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $uacVal['title']); ?>
                        <!-- <h3><a href="{{ url('/classifieds/'.$uacVal['id']) }}">{{ $uacVal['title'] }}</a></h3> -->
                        <h3><a href="{{ url('/classifieds/'.$encodetitle.'/'.$uacVal['id']) }}">{{ str_limit($uacVal['title'], $limit = 18, $end = '...') }}</a></h3>
                        <p>{{ strip_tags(str_limit($uacVal['description'], 20)) }}</p>

                        <a class="clascat" href="#">
                            <!-- {{ $uacVal->categoriesname['name']}} -->
                            <?php $ctSubctName = $uacVal->categoriesname['name']; ?>

                            @if($uacVal->subcategoriesname['name'])
                            <!-- {{ ' / '.$uacVal->subcategoriesname['name'] }} -->
                            <?php $ctSubctName .= " / " . $uacVal->subcategoriesname['name'] ?>
                            @endif

                            {{ str_limit($ctSubctName, $limit = 18, $end = '...') }}
                        </a>

                        <ul >
                            <li>
                                <a href="#">
                                    <span>
                                        <!-- <i class="fa fa-eye"></i> -->
                                        <img src="{{ URL::asset('plugins/front/img/icons/eye.png') }}" alt="">
                                    </span>
                                    {{$uacVal['count']}}
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span><img src="{{ URL::asset('plugins/front/img/locate-icon.png') }}" alt=""> 
                                        <?php
                                        $cityname = \DB::table('cities')->where('CityId', '=', $uacVal['city_id'])->first();
                                        if (!empty($cityname)) {
                                            $val = $cityname->City;
                                        } else {
                                            $val = "Victoria Park";
                                        }
                                        ?>
                                        {{ str_limit($val, $limit = 11, $end = '...') }}
                                    </span>

                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-6">
                    <div class="msgRight">
                        <ul class="icons">
                            @if($uacVal['status']==1 ||$uacVal['status']==0 )

                            <li>
                                <span class="material-switch exprd-rmv-icns">

                                    <input type="checkbox" data-toggle="toggle" class="editclassifiedstatus "  classifiedid="{{$uacVal['id']}} "  value="{{$uacVal['status']}}" <?php
                                    if ($uacVal['status']) {
                                        echo 'checked';
                                    } else {
                                        
                                    }
                                    ?>/>
                                    <label class="label-default"></label>
                                </span>
                            </li>
                            @endif
                            <!--                            <li>
                                                            <input checked data-toggle="toggle" data-style="ios" type="checkbox" class="msgToggle">
                                                        </li>-->
                            <?php if (Auth::guard('web')->user()->seller_type == 'business') { ?>
                                <li><a href="{{ url("/user/edit_business_post/$uacVal[id]") }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                            <?php } else { ?>
                                <li><a href="{{ url("/user/edit_business_post/$uacVal[id]") }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <li><a href="javascript:void(0)"class="delete deleteRecord" classId ="{{$uacVal['id']}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                        </ul>

                        <span class="price">${{ $uacVal['price'] }}</span>
                        <span class="date">{{ date('d-m-Y',strtotime($uacVal['created_at'])) }}

                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="row msgrow">
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <ul class="firstBox">
                            <li class="chek">
                                <a>
                                    <input type="checkbox" name="" value="" class="m-checkbox">
                                    <label></label>
                                </a>
                            </li>
                            <li class="hert">
                                <a>
                                    <span><i class="fa fa-heart-o"></i></span>
                                    <span>10800</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7 col-sm-7">
                        <div class="msgImg">
                            <img src="assets/img/icons/dash-img.jpg" alt="">
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-6">
                        <div class="msgData">
                            <h3>Classified name</h3>
                            <p>Classified Desc</p>
                            <a class="clascat" href="#">Classified Category</a>
                            <ul >
                                <li>
                                    <a href="#">
                                        <span><img src="assets/img/icons/eye.png" alt=""></span>
                                        1000
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span><img src="assets/img/locate-icon.png" alt=""></span>
                                        MelBourne
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-6">
                        <div class="msgRight">
                            <ul class="icons">
                                <li><input checked data-toggle="toggle" data-style="ios" type="checkbox" id="msgToggle"></li>
                                <li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                            </ul>
                            <span class="price">$99.99</span>
                            <span class="date">20 January 2017</span>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>-->
    @endforeach

    @else
    <div class="col-sm-12 text-center">
        <p>No ADD Found.</p>
    </div>
    @endif
    <nav aria-label="Page navigation">
        {{ $data->render() }}
    </nav>
</div>
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('.msgToggle').bootstrapToggle({
            width: 25,
            height: 50,
        });
    })
