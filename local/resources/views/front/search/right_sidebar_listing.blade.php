@if(isset($similarClass) && count($similarClass) > 0)
<div class="similar-jobs-right-sec cart-similar-job">
    <div class="sidebar-products-box">
        <h2>Simliar Adverts</h2>
        @foreach($similarClass as $key => $value)
        <div class="sidebar-products-list">
            <div class="product-img-holder">
                <?php
                $seemore_link = "/classified-list/" . preg_replace('/[^A-Za-z0-9-]+/', '-', $value['subcategoriesname']['name']) . "/" . $value['subcategoriesname']['id'];
                $imagename = (isset($value['classified_image'][0]['name']) ? $value['classified_image'][0]['name'] : '');
                ?>
                <a href="{{ url("/classifieds/".preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title'])."/$value[id]") }}" class="">
                    <img src='{{ url("/upload_images/classified/$value[id]/$imagename") }}' class="img-responsive" />
                </a>
            </div>
            <a href="{{ url("/classifieds/".preg_replace('/[^A-Za-z0-9-]+/', '-', $value['title'])."/$value[id]") }}" class="product-title">{{str_limit($value['title'], 20)}}</a>
            <div class="product-description"><p>{{str_limit(strip_tags($value['description']),50)}}</p></div>
            <ul class="breadcrumb">
                <!--                              <li><a href="#">Home</a> </li>
                                              <li><a href="#">Breadcrumb</a> </li>-->
                <li><a href="javascript:void(0);">Ad ID {{$value['id']}}</a> </li>
            </ul>
            <div class="sidebar-product-save">
                <a class="wishlist-icon" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                <h4>{{str_limit($value['location'],30)}} <br>{!! Helper::time_since(time() - strtotime($value['created_at'])) !!} ago</h4>
            </div>
        </div>

        @endforeach
        <div class="btn-sec">
            <a href="{{ url("$seemore_link") }}">See More</a>
        </div>
    </div>
</div>
@endif