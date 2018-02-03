<!-- detail page sidebar -->
<!-- detail page sidebar -->
<aside id="home-sidebar">
    <!-- widgets -->
    <div class="widgets widget-offer">
        <ul>
            <li class="offer-block">
                <ul>
                    <!--<li class="makeOffer"><a href="#">Make offer</a></li>--> 
                    @if(!(Auth::guard('web')->user()))
                    
                   <li class="postSimilaradd"><a href="javascript:void(0)" class="signinPostAdd">Post Similar Ad</a></li> 
                   @else
                    <li class="postSimilaradd"><a href="{{ url('/user/post-classified') }}">Post Similar Ad</a></li> 
                    @endif
                </ul>
            </li>
            <li>
                @if($result->price >0)
                <div class="AudtxtInput">
                    <form action="/messages/create" id="makeAnOfferForm" method="post" >
                        @if(Auth::guard('web')->user() && Auth::guard('web')->user()->id == $result->classified_users['id'])
                        <input type="text" name="offer_price" placeholder="{{$result->price}}" class="form-control offer_price" disabled>							
                        <button type="submit" name="button" class="makeOffer" disabled>Make offer<!--<i class="fa fa-arrow-right"></i>--></button>
                        @else
                        <input type="text" name="offer_price" placeholder="{{$result->price}}" class="form-control offer_price">
                        <span class="Audtxt"><strong>Aud $</strong></span>
                        <input type="hidden" class="receiver_id" name="receiver_id" value="<?php echo $result->classified_users['id']; ?>" > 
                        <input type="hidden" class="classified_id" name="classified_id" value="<?php echo $result->id; ?>" >
                                                <button type="submit" name="button" class="makeOffer">Make offer<!--<i class="fa fa-arrow-right"></i>--></button>
                        @endif
                    </form>
                    <div class="text-center loadingMakeOfferDiv"><i class="fa fa-refresh fa-spin hide"></i></div>
                </div>
                @endif
                @if($result->offer_count != 0)
                <span><span>{{ $result->offer_count}} offers </span> have already been made</span>
                @endif
            </li>

            @if(Auth::guard('web')->user())
            @if(Auth::guard('web')->user()->id != $result->classified_users['id'])
            <li>
                <div class="sendmsgwrap">
                    <textarea name="msg" id="msg" title="Description" rows="8" maxlength="100" placeholder="Type here..." required class="form-control msgTextBox"></textarea>
                    <button type="submit" class="sendMsgBtn">Send message to seller Name</button>
                </div>
            </li>
            @endif
            @else
            <li>
                <div class="sendmsgwrap">
                    <textarea name="msg" id="msg" title="Description" rows="8" maxlength="100" placeholder="Type here..." required class="form-control msgTextBox"></textarea>
                    <button type="submit" class="sendMsgBtn">Send message to seller Name</button>
                </div>
            </li>
            @endif

            <li >
                <div class="shownumwrap">
                    <span class="phone-icon"><img src="{{ URL:: asset('/plugins/front/img/icons/phone.png') }}" alt=""></span>
                    <span class="hide-num mob_number">*******<?php echo substr($result->contact_mobile, 6, 4); ?></span>
                    <!-- <span clasa="hide-num">******8065</span> -->
                    @if((Auth::guard('web') !== null) && (Auth::guard('web')->user())) 
                    <a <?php echo $result->classified_users['mobile_no']; ?>  href="javascript:void(0)" class="show-number" data-value="<?php echo $result->contact_mobile; ?>">Show number</a> 
                    @endif
                    <!-- <span><a href="#">show number</a></span> -->
                </div>
            </li>
        </ul>
    </div>


    <div class="widgets widget-useradd">
        <div class="useradd">
            <ul>
                <li class="usericon"><a href=""><img src="{{ URL:: asset('/plugins/front/img/icons/user.png') }}" alt=""></a></li>
                @if($result->classified_users['role_id'] == 0)
                <a href="{{ url('/classifiedsellerinform/'.$result->classified_users['id']) }}">
                    <li>
                        <span class="username" title="{!! $result->classified_users->name !!}">{!! str_limit($result->classified_users->name, $limit = 14, $end = '...') !!}</span>
                        <span class="numofadd">{!! $totalUserExistingAdds !!} ad found</span>
                    </li>
                </a>
                @else
                <li>
                    <span class="username" title="{!! $result->classified_users->name !!}">{!! str_limit($result->contact_name, $limit = 14, $end = '...') !!}</span>
                    <span class="numofadd">{!! $totalUserExistingAdds !!} ad found</span>
                </li>
                @endif

            </ul>
        </div>	

        <div class="useraddrow row">
            <?php //dd($result);?>
            @if($totalUserExistingAdds > 0)
            @foreach($userExistingAdds as $key => $value)
            <!-- getAllCommunInformCategorIDArray -->
            @if(!in_array($value['parent_categoryid'], $getAllCommunInformCategorIDArray) && !in_array($value['category_id'], $getAllCommunInformCategorIDArray))
            <div class="col-md-6 grid-item">
                <div class="listing-inner">
                    <div class="p-img">
                        <a href='{{ url("/classifieds/$value[id]") }}' title="{{ str_limit($value['title'],20) }}">
                            <?php
                            if (!empty($value['classified_image'])) {
                                $src = $value['id'] . '/' . $value['classified_image'][0]['name'];
                                //dd($src);
                            } else {
                                $src = '';
                            }
                            ?>
                            <img src='{{ url("/upload_images/classified/$src") }}' alt="product-img" class="test">
                        </a>
                    </div>
                    <div class="p-description">
                        <div class="category-price clearfix">
                            @if($value['price'] > 0)

                            ${{ $value['price'] }}

                            @endif
                            @if(in_array($value['id'], $wishlistItems))
                            <a href="javascript:void(0)" class="wishlist-icon active" data-id="{{ $value['id'] }}">
                                <span class="cart" data-id="{{ $value['id'] }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </span>
                            </a>
                            @else
                            <a href="javascript:void(0)" class="wishlist-icon" data-id="{{ $value['id'] }}">
                                <span class="cart">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </span>
                            </a>
                            @endif
                        </div>
                        <div class="category-name">{{ str_limit($value['title'],20) }}</div>

                        @if(!empty($value['location']))
                        @if(!empty($result->city))
                        <?php $expSimLoc = explode(',', trim($value['location'])); ?>
                        <div class="category-loaction">{{ $result->city->City }}</div>
                        @endif
                        @endif

                    </div>
                    <span class="top-badge">
                        {!! Helper::time_since_for_classified(time() - strtotime($value['created_at'])) !!}
                    </span>
                </div>
            </div>
            @endif
            @endforeach
            @endif
        </div>
        @if($result->classified_users['role_id'] == 0)
        <div id="load-more">
            <a href="{{ url('/classifiedsellerinform/'.$result->classified_users['id']) }}">See More</a>
        </div>
        @endif
    </div>
    

    @if(!empty($result->location))
    <div class="widgets widgets-map">
        <div class="mapadder">
            <ul>
                <li>
                    <img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt="">
                </li>
                <li>
                    {{ $result->location }}
                    <!-- <span>15 km away</span> -->
                </li>
            </ul>
            <?php /* <img src="{{ URL:: asset('/plugins/front/img/map.png') }}" alt=""> */ ?>
            <div id="detail-map" class="detail_sidebar"></div>
        </div>
    </div>
    @endif

    <div class="widgets fashion-sale">
        <!-- fashion-sale widget iframe appears here in replacement of this banner -->
        @if(sizeof($right_positions_ads) > 0)
            @foreach($right_positions_ads as $right_ad_key => $right_single_ad)
                <a href="{!! Helper::show_url($right_single_ad->image_url) !!}" target="_blank">
                    <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$right_single_ad->image) !!}" alt="banner-img">
                </a>
            @endforeach
        @elseif(!empty($default_right_position_ad))
            <a href="{!! Helper::show_url($default_right_position_ad->image_url) !!}" target="_blank">
            <img class="owl-lazy" data-src="{!! asset('/upload_images/advertisements/image/'.$default_right_position_ad->image) !!}" alt="banner-img">
        </a>
        @endif
    </div>
</aside>
