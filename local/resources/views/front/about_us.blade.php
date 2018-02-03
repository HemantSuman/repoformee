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
                  <li class="active">About Us</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- categories section -->
    <section>
        <div id="main-inner-section">
            <div class="container">
                <div class="about-section">
                    <div class="title">
                        About Us
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p><br/><br/>
                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                    <br/><br/>

                    <div class="what-baout">
                        <div class="title">
                            What is Lorem Ipsum?
                        </div>
                        <ul>
                            <li>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                            </li>
                            <li>
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </li>
                            <li>
                                It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                            </li>
                            <li>
                                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('scripts')

@stop