@extends('front/layout/layout')

@section('content')

<div id="middle" class="no-banner">
    <div class="dashboard-banner">
        <div class="userImg">
            @if(!empty($user_details['image']))
            <img src="{{ URL::asset('upload_images/users/'.$user_details['id'].'/'.$user_details['image']) }}" alt="profile-img-new">

            @elseif(($user_details['avatar']))
            <img src="{{ $user_details['avatar'] }}" alt="profile-img-new"> 
            @else
            <img src="{{ URL::asset('plugins/front/img/no_avatar.gif') }}" alt="profile-img-new">   
            @endif


        </div>
        <div class="userStates">
            <select class="" name="">
                <option value="">Online</option>
                <option value="">Offline</option>
                <option value="">Away</option>Away
            </select>
        </div>
        <!--		<div class="Changepic">
                                {!! Form::open(array("role" => "form", 'id' => 'update-profile-img-form', 'files' => true, 'method' => 'POST')) !!}
                                <input type="file" name="image" id="file2" class="filetype chng-prfl-pic-btn">
                                <label for="file2">Change Photo</label>
                                <p>Image must be in JPG or PNG format and under 5 mb.</p>
                                {!! Form::close() !!}
                        </div>-->
    </div>
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="dashboard-content">
        <div class="dashboarduserDetail">
            <div class="container">
                <div class="userName">
                    {{ Auth::guard('web')->user()->name }}
                </div>

                <ul class="aboutUser">
                    @if(empty($total_viewer->total_views))
                    <li> 0 views</li>
                    @else
                    <li>{{ $total_viewer->total_views }} views</li>
                    @endif
                    @if(!empty($user_total_classifieds))
                    <li>{{ $user_total_classifieds }} Ads foud</li> 
                    @else
                    <li> 0 Ads foud</li>
                    @endif
                    @if(!empty($user_details['city']))
                    <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>{!! $user_details['city'] !!}</li>
                    @else
                    <li> <span><img src="{{ URL:: asset('/plugins/front/img/locate-icon.png') }}" alt=""></span>N/A</li>
                    @endif
                    @if(!empty($user_details['created_at']))
                    <li><span><img src="{{ URL:: asset('/plugins/front/img/icons/calander-icon.png') }}" alt=""></span> {!! date("d-m-y",strtotime($user_details['created_at'])) !!}</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    @include('front/element/user_dashboard_menubar') 
                </div>

                <div class="col-sm-12 col-md-9">
                    <div class="dashboard-main-detail">
                        <h2 class="dashboard-title">Dashboard</h2>
                        <div class="dashboard-top-boxes">
                            <ul>
                                <li>
                                    <div class="dashboard-top-boxes-in">
                                        <h2>
                                            <?php if(isset($order)){ ?>
                                            {{count($order)}}
                                            <?php } else {  echo 0; }?>
                                            <span>All Orders</span></h2>
                                        <a href="#">VIEW MORE <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="dashboard-top-boxes-in">
                                        <h2>
                                            <?php if(isset($order_results['Shipped'])){ ?>
                                            {{count($order_results['Shipped'])}}
                                            <?php } else {  echo 0; }?>
                                            <span>Shipped</span></h2>
                                        <a href="#">VIEW MORE <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="dashboard-top-boxes-in">
                                        <h2>
                                            <?php if(isset($order_results['Complete'])){ ?>
                                            {{count($order_results['Complete'])}}
                                            <?php } else {  echo 0; }?>
                                            <span>Delivered <br> Packages</span></h2>
                                        <a href="#">VIEW MORE <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="dashboard-top-boxes-in">
                                        <h2>
                                            <?php if(isset($order_results['Cancel'])){ ?>
                                            {{count($order_results['Cancel'])}}
                                            <?php } else {  echo 0; }?>
                                            <span>Exception</span></h2>
                                        <a href="#">VIEW MORE <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="shipment-dash-graph">
                            <h2>Last 10 Days Shipment </h2>
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>

                    <div class="shipment-dash-graph">
                        <h2>This Month Orders Performance</h2>
                        <div class="shipment-graph-box">
                            <!--<canvas id="chart-0"></canvas>-->
                            <canvas id="myChart2"></canvas>
                            <!--<img src="{{ URL:: asset('/plugins/front/img/perform-graph.jpg') }}" alt="">-->
                        </div>
                    </div>

<!--                    <div class="dash-usefull-links">
                        <h2>Useful Links</h2>
                        <div class="row">
                            <div class="col-sm-4">
                                <ul>
                                    <li><a href="#">Communication Preferences</a></li>
                                    <li><a href="#">Site Preferences</a></li>
                                    <li><a href="#">Business Policies</a></li>
                                    <li><a href="#">Feedback</a></li>
                                    <li><a href="#">Subscriptions</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><a href="#">Help Centre</a></li>
                                    <li><a href="#">Links 7</a></li>
                                    <li><a href="#">Links 8</a></li>
                                    <li><a href="#">Links 9</a></li>
                                    <li><a href="#">Links 10</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul>
                                    <li><a href="#">Links 11</a></li>
                                    <li><a href="#">Links 12</a></li>
                                    <li><a href="#">Links 13</a></li>
                                    <li><a href="#">Links 14</a></li>
                                    <li><a href="#">Links 15</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->

                </div>
            </div>
        </div>
</div>



</section>
</div>
<span class="order_results" style="display: none;">{{json_encode($order_results)}}</span>
<span class="dateArray" style="display: none;">{{json_encode($dateArray)}}</span>
<span class="dateArrayMonth" style="display: none;">{{json_encode($dateArrayMonth)}}</span>

@stop

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('plugins/front/js/Chart.bundle.js')}}"></script>
<!--<script type="text/javascript" src="{{ URL::asset('plugins/front/js/Chart.min.js')}}"></script>-->
<script type="text/javascript">
window.onload = function () {

    var ctx = document.getElementById('myChart1').getContext('2d');
    var order_results = JSON.parse($('.order_results').text());
    var dateArray = JSON.parse($('.dateArray').text());

    var chart1 = [];
    $.each(order_results, function (index, value) {

        chart1[index] = [];
        var labels = []
        $.each(dateArray, function (i, v) {

            if (typeof value[v] == 'undefined') {
                labels.push(0);
            } else {
                labels.push(value[v].length);
            }
            chart1[index] = labels;
        });

    });
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: dateArray,
            datasets: [{
                    label: "Pending",
                    backgroundColor: '#fdb719',
                    borderColor: '#fdb719',
                    data: chart1['Pending'],
                },
                {
                    label: "Shipped",
                    backgroundColor: '#5e2c85',
                    borderColor: '#5e2c85',
                    data: chart1['Shipped'],
                },
                {
                    label: "Complete",
                    backgroundColor: '#01a29c',
                    borderColor: '#01a29c',
                    data: chart1['Complete'],
                },
                {
                    label: "Cancel",
                    backgroundColor: '#ee273e',
                    borderColor: '#ee273e',
                    data: chart1['Cancel'],
                },
            ]
        },

        options: {
            title: {
                display: true,
                text: "Chart.js Bar Chart - Stacked"
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                        stacked: true,
                    }],
                yAxes: [{
                        stacked: true
                    }]
            }
        }
    });



    
    var dateArrayMonth = JSON.parse($('.dateArrayMonth').text());

    var canvas = document.getElementById("myChart2");
    var ctx = canvas.getContext('2d');

// Global Options:
    Chart.defaults.global.defaultFontColor = 'black';
    Chart.defaults.global.defaultFontSize = 16;

    var data = {
        labels: dateArrayMonth,
        datasets: [{
                label: "Pending",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#fdb719",
                borderColor: "#fdb719", // The main line color
                borderCapStyle: 'square',
                borderDash: [], // try [5, 15] for instance
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "black",
                pointBackgroundColor: "white",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "yellow",
                pointHoverBorderColor: "brown",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: true
                data: chart1['Pending'],
                spanGaps: true,
            }
            , {
                label: "Shipped",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#5e2c85",
                borderColor: "#5e2c85",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "white",
                pointBackgroundColor: "black",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "brown",
                pointHoverBorderColor: "yellow",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: false
                data: chart1['Shipped'],
                spanGaps: true,
            }
            , {
                label: "Complete",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#01a29c",
                borderColor: "#01a29c",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "white",
                pointBackgroundColor: "black",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "brown",
                pointHoverBorderColor: "yellow",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: false
                data: chart1['Complete'],
                spanGaps: true,
            }
            , {
                label: "Cancel",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#ee273e",
                borderColor: "#ee273e",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "white",
                pointBackgroundColor: "black",
                pointBorderWidth: 1,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: "brown",
                pointHoverBorderColor: "yellow",
                pointHoverBorderWidth: 2,
                pointRadius: 4,
                pointHitRadius: 10,
                // notice the gap in the data and the spanGaps: false
                data: chart1['Cancel'],
                spanGaps: true,
            }

        ]
    };

// Notice the scaleLabel at the same level as Ticks
    var options = {
        scales: {
            yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Orders',
                        fontSize: 20
                    }
                }]
        }
    };

// Chart declaration:
    var myBarChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });


}

</script>
@stop
