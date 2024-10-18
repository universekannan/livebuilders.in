@extends('layouts.app')
@section('content')
<div class="page-content ">
            <div class="wt-bnr-inr overlay-wraper" style="background-image:url(images/banner/blog-banner.jpg);">
            	<div class="overlay-main bg-black" style="opacity:0.5;"></div>
                <div class="container">
                    <div class="wt-bnr-inr-entry">
                      <center>  <h1 class="text-white">About  {{ $project->project_name }}</h1></center>
                    </div>
                </div>
            </div>               
            <div class="section-full p-t80 p-b50 bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="blog-post blog-lg date-style-3 date-skew">
                                <div class="wt-post-media wt-img-effect zoom-slow">
                                   <img src="{{ URL::to('/') }}/upload/projectsave/{{ $project->photo }}" alt="{{ $project->project_name }}">
                                </div>
                                <div class="wt-post-info p-a30 p-b15  bg-white">
                                    
                                    <div class="wt-post-text">
                                       <p>{{ $project->project_name }}</p>
                                       <p>{{ $project->project_owner }}</p>
                                       <p>{{ $project->project_address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
						</div>
				   </aside>
                </div>
            </div>            
        </div>
		
		
</div>

<footer class="site-footer footer-dark">
<div class="call-to-action-wrap call-to-action-skew" style="background-image:url(images/background/bg-4.png); background-repeat:repeat;background-color:#273447;">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-sm-8">
            <div class="call-to-action-left p-tb20 p-r50">
               <h4 class="text-uppercase m-b10">We are ready to build your dream tell us more about your project</h4>
               <p></p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="call-to-action-right p-tb30">
               <a href="contact-us.php" class="site-button skew-icon-btn m-r15 text-uppercase"  style="font-weight:600;">
               Contact us <i class="fa fa-angle-double-right"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection



