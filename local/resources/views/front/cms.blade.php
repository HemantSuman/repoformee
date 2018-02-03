@extends('front/layout/layout')
@section('content')
<div id="middle">

    <!-- main banner section -->
    <section>
        <div class="inner-page-banner">
            <img src="{!! asset('plugins/front/img/inner-page-banner.jpg') !!}" alt="banner-img" width="100%">
        </div>
    </section>

    <!-- breadcrumb section -->
   
    <section>
        <div id="breadcrumb-banner">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>              
                    <li class="active">{{$result->title}}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section class="static-page-content">
        <div class="container">
            <h2 class="title">{{$result->title}}</h2>
            {!!$result->description!!}
        </div>
    </section>


    <!-- <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="about-section">
                    <div class="title">
                        <h1 class="title">{{$result->title}}</h1>
                    </div>
                    <div class="description">
                        <?php
                       // preg_match("/<body[^>]*>(.*?)<\/body>/is", $result->description, $matches);
                 //       dd($result->description);
//                        $getCont = $matches[1];
                       // echo htmlspecialchars($result->description);
                     // echo  file_put_contents($result->description)
                         
                        ?>
                  {!!$result->description!!}
                    </div>
                </div>
            </div>
        </div>
    </section> -->
</div>
@stop

@section('scripts')

@stop