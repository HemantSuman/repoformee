@if(!empty($final_current_day_timings))
<h4>Upcoming prayer</h4>
<div class="payer-mid">
    <span class="paryer-Date">{!! ($is_today_timing == 1) ? date("D d M, Y") : date('D d M, Y', strtotime('+1 day', strtotime(date("d M Y")))) !!}</span>
    @if(!empty($final_current_day_timings))
        <input type="hidden" class="isTodayTiming" value="{{ $is_today_timing }}">
        @foreach($final_current_day_timings as $pt_name => $pt_time)
            @if($is_today_timing == 0)
                <div class="current-prayer">
                    <div class="prayer-name">{!! $pt_name !!}</div>
                    <div class="timing">{!! $pt_time !!}</div>
                    <div class="leftTime">
                        <span>Time left</span>
                        <span class="pt_time_left"></span>
                    </div>
                    <input type="hidden" class="upcmgTime" value="{{ $pt_time }}">
                </div>
                <?php $getUpperKey = $pt_name; ?>
                <?php unset($final_current_day_timings[$pt_name]); ?>
                <?php break; ?>
            @else
                <!-- date("Y-m-d H:i", strtotime(end($pt_time))) -->
                @if($cur_time < date("Y-m-d H:i", strtotime($pt_time)))
                    <div class="current-prayer">
                        <div class="prayer-name">{!! $pt_name !!}</div>
                        <div class="timing">{!! $pt_time !!}</div>
                        <div class="leftTime">
                            <span>Time left</span>
                            <span class="pt_time_left"></span>
                        </div>
                        <input type="hidden" class="upcmgTime" value="{{ $pt_time }}">
                    </div>
                    <?php $getUpperKey = $pt_name; ?>
                    <?php unset($final_current_day_timings[$pt_name]); ?>
                    <?php break; ?>
                @endif
            @endif
        @endforeach
    @endif
    
    <?php
    //$getUpperKey = "red";
    $orderOfTiming = array();
    switch ($getUpperKey) {
        case "Fajr":
            $orderOfTiming = array("Dhuhr", "Asr", "Maghrib", "Isha");
            break;
        case "Dhuhr":
            $orderOfTiming = array("Asr", "Maghrib", "Isha", "Fajr");
            break;
        case "Asr":
            $orderOfTiming = array("Maghrib", "Isha", "Fajr", "Dhuhr");
            break;
        case "Maghrib":
            $orderOfTiming = array("Isha", "Fajr", "Dhuhr", "Asr");
            break;
        case "Isha":
            $orderOfTiming = array("Fajr", "Dhuhr", "Asr", "Maghrib");
            break;
        default:
            //echo "Your favorite color is neither red, blue, nor green!";
    }
    ?>
    <div class="upcoming-prayer">
        @foreach($orderOfTiming as $orderOfTiming_index => $orderOfTiming_value)
            <a href="javascript:void(0)" class="player-div"><span>{!! $orderOfTiming_value !!}</span> {!! $final_current_day_timings[$orderOfTiming_value] !!} </a>
        @endforeach
        <?php /*
        @foreach($final_current_day_timings as $pt_name => $pt_time)
            <a href="javascript:void(0)" class="player-div"><span>{!! $pt_name !!}</span> {!! $pt_time !!} </a>
        @endforeach
        */ ?>
    </div>
</div>
<div class="prayer-location">
    <ul>
        <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/icons/pray-loc.png') }}" alt=""> <span class="usr_crnt_city">{{ $user_city }}</span></a></li>
        <li>
            <a href="#"><img src="{{ URL:: asset('/plugins/front/img/icons/pray-cal.png') }}" alt="">
                 {!! ($is_today_timing == 1) ? date("d M Y") : date('d M Y', strtotime('+1 day', strtotime(date("d M Y")))) !!}
            </a>
        </li>
    </ul>
</div>
<div class="prayer-link">
    <a href="{{ url('/prayer-timings') }}">view this month praying time</a>
</div>
@else

@endif