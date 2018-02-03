@extends('front/layout/layout')

@section('content')

<section>
    <div id="main-inner-section">
        <div class="container">
            <div class="row">
                <!-- style in main-categories.scss file -->
                <div class="col-sm-12 col-md-3">
                    <div class="pws-sidebar-cat">
                        <h3 class="sm-refine-search">Refine Search</h3>
                        <div class="pws-sidebar">
                            <h2>Refine Search</h2>
                            <a class="filter-reset" href="#">Reset</a>
                            <h4>Search</h4>                         

                            <ul class="pws-main-cat" id="multiple" data-accordion-group>

                                <li data-accordion>                                   
                                    <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Main Category</a>
                                    <ul class="pws-sub-cat" data-content> 

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a>
                                                    
                                                </li >
                                                
                                                <li data-accordion><a href="javascript:void(0)" data-control>
                                                        <img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 3</a>
                                                    <ul class="pws-subtwo-cat" data-content>
                                                        <li>Hello</li>
                                                        </ul>
                                                    
                                                </li >
                                      

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>  

                                    </ul>
                                </li>


                                <li data-accordion>                                   
                                    <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Main Category</a>
                                    <ul class="pws-sub-cat" data-content> 

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>  

                                    </ul>
                                </li>

                                <li data-accordion>                                   
                                    <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Main Category</a>
                                    <ul class="pws-sub-cat" data-content> 

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>  

                                    </ul>
                                </li>
                            </ul>

                            <h4>Advanced Search</h4>                         

                            <ul class="pws-main-cat" id="multiple" data-accordion-group>

                                <li data-accordion>                                   
                                    <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Main Category</a>
                                    <ul class="pws-sub-cat" data-content> 

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>  

                                    </ul>
                                </li>


                                <li data-accordion>                                   
                                    <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Main Category</a>
                                    <ul class="pws-sub-cat" data-content> 

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>  

                                    </ul>
                                </li>

                                <li data-accordion>                                   
                                    <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img">Main Category</a>
                                    <ul class="pws-sub-cat" data-content> 

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>

                                        <li data-accordion>                                        
                                            <a href="javascript:void(0)" data-control><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category</a>

                                            <ul class="pws-subtwo-cat" data-content>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>

                                                <li><a href="#"><img src="{{ URL:: asset('/plugins/front/img/review-watch.png')}}" alt="img"> Sub Category 2</a></li>  

                                            </ul>
                                        </li>  

                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>                            




            </div>
        </div>
    </div>
</section>


</div>
@stop





@section('scripts')

<script type="text/javascript" src="{{ Request::root()}}/plugins/front/js/jquery.accordion.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    $('#multiple [data-accordion]').accordion({
        singleOpen: false
    });
});
</script>


@stop

