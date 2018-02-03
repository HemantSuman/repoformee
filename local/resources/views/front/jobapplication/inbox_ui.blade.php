<div class="Messageblock emailblock">

    @if(!empty($result))
        @foreach($result as $resultKey => $resultData)
            <div class="row msgrow">
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <div class="row">
                        <div class="col-md-5 col-sm-4">
                            <ul class="firstBox">
                                <li class="chek">
                                    <a>
                                        <input type="checkbox" name="" value="" class="m-checkbox singleCheckbox" msg_id="{{ $resultData->msg_id }}">
                                        <label></label>
                                    </a>
                                </li>
                                <li class="hert">
                                    <a>
                                        <span><i class="fa fa-star-o" aria-hidden="true"></i></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-7 col-sm-8">
                            <div class="msgImg">
                                @if(!empty($resultData->image_name))
                                    <img src='{{ URL::asset("upload_images/classified/$resultData->classified_id/$resultData->image_name") }}' alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="msgData">
                                    <h3><a href='{{ url("/classifieds/$resultData->classified_id") }}' target="_blank">{{ $resultData->title }}</a></h3>

                                    <ul>
                                        <li class="icon">
                                            <a href="#">
                                                @if(!empty($resultData->image))
                                                    <img src='{{ URL::asset("upload_images/users/$resultData->second_user_id/$resultData->image") }}' alt="">
                                                @else
                                                    <img src="{{ URL::asset('plugins/front/img/icons/user.png') }}" alt="">
                                                @endif
                                            </a>
                                        </li>
                                        <li class="desc">
                                            <a href="#" >
                                                <span> {{ $resultData->name }}</span>
                                                <p>{!! str_limit($resultData->massage, $limit = 20, $end = '...') !!}</p>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="msgRight">
                                <span>Conversions : 1</span>
                               <?php 
                              // dd( strtotime($resultData->msg_time));
                             //  dd(time());
                               ?>
                                
                                <span class="time">{!! Helper::time_since(time() - strtotime($resultData->msg_time)) !!} ago</span>
                                <span class="date"><a href="javascript:void(0)" class="viewFullChat" second_user_id="{{ $resultData->second_user_id }}" classLiIdForChat="{{ $resultData->classified_id }}">Reply <i class="fa fa-reply" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row msgrow">
            <div class="col-md-12 col-sm-12 col-xs-12">
                No Message Found
            </div>
        </div>
    @endif
</div>

<!-- <nav aria-label="Page navigation">
    <ul class="pagination">
        <li>
            <a href="javascript:void(0)" aria-label="Previous">
                <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
            </a>
        </li>
        <li><a href="javascript:void(0)">1</a></li>
        <li><a href="javascript:void(0)">2</a></li>
        <li><a href="javascript:void(0)">3</a></li>
        <li><a href="javascript:void(0)">4</a></li>
        <li><a href="javascript:void(0)">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
            </a>
        </li>
    </ul>
</nav> -->