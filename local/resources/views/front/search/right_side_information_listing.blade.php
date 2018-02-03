<?php /*<div class="information-links-sec">
    <h2 class="info-head">Information</h2>
    <ul class="information-links information_data"></ul>
</div>*/?>
<div class="information-links-sec">
    <h2 class="info-head">Information</h2>
    <ul class="information-links ">
        <a href="{{ url('/news-feeds') }}"><li class="news-feed">News Feeds</li></a>
        @if(!empty($informationAreaCategories))
        <?php $i = 1; ?>
        @foreach($informationAreaCategories as $infocategories)
        <?php
        $encodetitle = preg_replace('/[^A-Za-z0-9-]+/', '-', $infocategories['text']);
        $url = Request::root() . '/classified_list/' . $encodetitle . '/' . $infocategories['id'];
        if ($i == 4) {
            break;
        } else {
            ?>
            <li class="halal">
                <a href="{{ $url }}">
                    <img style="width:25px;float: left;margin-right: 5px;" src="{{ URL::asset("/upload_images/categories/icon/$infocategories[id]/$infocategories[icon]") }}" >
                    <span>{{ $infocategories['text'] }}</span>
                </a>
            </li>
        <?php } $i++; ?>
        @endforeach

        <ul class="morechild">
            <?php $j = 1; ?>
            @foreach($informationAreaCategories as $infocategories1)
            <?php
            $encodetitle1 = preg_replace('/[^A-Za-z0-9-]+/', '-', $infocategories1['text']);
            $url1 = Request::root() . '/classified_list/' . $encodetitle1 . '/' . $infocategories['id'];
            if ($j > 3) {
                ?>


                <li class="halal">
                    <a href="{{ $url1 }}">
                        <img style="width:25px;float: left;margin-right: 5px;" src="{{ URL::asset("/upload_images/categories/icon/$infocategories1[id]/$infocategories1[icon]") }}" >
                        {{ $infocategories1['text'] }}
                    </a>
                </li>

            <?php } $j++; ?>
            @endforeach
        </ul>
        <span class="more">More</span>

        @endif
    </ul>
</div>
