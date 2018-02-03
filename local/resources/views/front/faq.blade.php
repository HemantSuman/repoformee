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
                  <li class="active">FAQ</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="faq-search-box">
                    <div class="title">  
                        Faq
                    </div>
<!--                    <div class="search-form pull-right">
                        <form>
                            <input type="search" class="search-field" placeholder="Search here...">
                            <button type="submit" name="" class="submit-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>-->
                </div>
                 @foreach($data as $key => $result)
                 <!-- accordian-row -->
                    <div class="custom-accordian-row parent">
                        <span class="main-collapse"><img src="{!! asset('plugins/front/img/toggle-side-arrow.png') !!}" alt=""></span>
                        <div class="title">{{$result->name}}</div>
                        <div class="description">
                             @foreach($result->faq as $key => $result1)
                            <!-- children accordian-row -->
                            <div class="custom-accordian-row">
                                <div class="title">{{$result1->question}}</div>
                                <div class="description">
                                    <p>
                                      {!!$result1->answer!!}  
                                    </p>
                                    <a href="javascript:void(0)" class="back-to-top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i>&nbsp;Back to top</a>
                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                    </div>
                    <!-- accordian-row -->
                     @endforeach   

            </div>
        </div>
    </section>
</div>

@stop


@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        /*custom collapse toggle faq page*/
        
        $(document).on("click", ".custom-accordian-row .title", function(){
            //alert("adss");
            $(this).toggleClass("m-collapse");
            $(this).next(".description").slideToggle(100);
        });
        $(".main-collapse").click(function(){
            if($(this).siblings(".description").is(":visible")){
                if($(this).hasClass("collapse-in")){
                    //alert("ok if");
                    $(this).removeClass("collapse-in");
                    $(this).siblings('.description').find('.title').removeClass("m-collapse");
                    $(this).siblings('.description').find('.description').slideDown(100);
                }
                else{
                    //alert("ok else");
                    $(this).addClass("collapse-in");
                    if( $(this).siblings('.description').find('.description').is(":visible")){
                        //alert("ok");
                        $(this).siblings('.description').find('.title').addClass("m-collapse");
                        $(this).siblings('.description').find('.description').slideUp(100);
                    }
                }
            }
            else{
               $(this).siblings(".description").slideDown(100); 
               if($(this).hasClass("collapse-in")){
                    //alert("ok if");
                    $(this).removeClass("collapse-in");
                    $(this).siblings('.description').find('.title').removeClass("m-collapse");
                    $(this).siblings('.description').find('.description').slideDown(100);
                }
                else{
                    //alert("ok else");
                    $(this).addClass("collapse-in");
                    if( $(this).siblings('.description').find('.description').is(":visible")){
                        //alert("ok");
                        $(this).siblings('.description').find('.title').addClass("m-collapse");
                        $(this).siblings('.description').find('.description').slideUp(100);
                    }
                }
            }
            
        });

        /*back-to-top feature*/
        $(".back-to-top").click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });
    });
    $(window).on("load", function(){
        $(".custom-accordian-row .title").addClass("m-collapse");
        $(".custom-accordian-row .main-collapse").addClass("collapse-in");
        $(".custom-accordian-row.parent").eq(0).children(".title").click();
    });
</script>

@stop