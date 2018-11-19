<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>{{$settings->site_name}} - {{$settings->site_title}}</title>
	<meta name="description" content="">  
	<meta name="author" content="">

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 	<!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="{{asset('css/base.css')}}">
   <link rel="stylesheet" href="{{asset('css/main.css')}}">
   <link rel="stylesheet" href="{{asset('css/vendor.css')}}">

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">

</head>

<body>

	<!-- header 
   ================================================== -->
   <header class="main-header">
   	<div class="row">
   		<div class="logo">
	         <a href="{{config('app.url')}}">{{config('app.name')}}</a>
	      </div>   		
   	</div>   

   	<a class="menu-toggle" href="#"><span>Menu</span></a>	
   </header> <!-- /header -->

   <!-- navigation 
   ================================================== -->
   <nav id="menu-nav-wrap">

   	<h5>Site Pages</h5>   	
		<ul class="nav-list">

			<li><a href="{{config('app.url')}}" title="">Home</a></li>
			<li><a href="{{ url('/blog') }}" title="">Blog</a></li>
			<li><a href="{{ url('/about-us') }}" title="">About</a></li>
			<li><a href="{{ url('/contact-us') }}" title="">Contact</a></li>
			<li><a href="{{ route('login') }}" title="">Login</a></li>
			<li><a href="{{ route('register') }}" title="">Register</a></li>

		</ul>

		<h5>Some Text</h5>  
		<p>Lorem ipsum Non non Duis adipisicing pariatur eu enim Ut in aliqua dolor esse sed est in sit exercitation eiusmod aliquip consequat.</p>

	</nav>

	<!-- main content
   ================================================== -->
   <main id="main-404-content" class="main-content-particle-js">

   	<div class="content-wrap">

		   <div class="shadow-overlay"></div>

		   <div class="main-content">
		   	<div class="row">
		   		<div class="col-twelve">
			  		
			  			<h1 class="kern-this">404 Error.</h1>
			  			<p>
						Oooooops! Looks like nothing was found at this location.
						Maybe try on of the links below, click on the top menu
						or try a search?
			  			</p>

			  			<div class="search">
				      	<form>
								<input type="text" id="s" name="s" class="search-field" placeholder="Type and hit enter …">
							</form>
				      </div>	   			

			   	</div> <!-- /twelve --> 		   			
		   	</div> <!-- /row -->    		 		
		   </div> <!-- /main-content --> 

		   <footer>
		   	<div class="row">

		   		<div class="col-seven tab-full social-links pull-right">
			   		<ul>
				   		<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					      <li><a href="#"><i class="fa fa-behance"></i></a></li>
					      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
					      <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
					      <li><a href="#"><i class="fa fa-instagram"></i></a></li>   			
				   	</ul>
			   	</div>
		   			
		  			<div class="col-five tab-full bottom-links">
			   		<ul class="links">

                            <li><a href="{{config('app.url')}}" title="">Home</a></li>
                            <li><a href="{{ url('/blog') }}" title="">Blog</a></li>
                            <li><a href="{{ url('/about-us') }}" title="">About</a></li>
                            <li><a href="{{ url('/contact-us') }}" title="">Contact</a></li>
                            <li><a href="{{ route('login') }}" title="">Login</a></li>
                            <li><a href="{{ route('register') }}" title="">Register</a></li>

				   	</ul>

				   	<div class="credits">
				   		<p>Design by <a href="http://www.styleshout.com/" title="styleshout">styleshout</a></p>
				   	</div>
			   	</div>   		   		

		   	</div> <!-- /row -->    		  		
		   </footer>

		</div> <!-- /content-wrap -->
   
   </main> <!-- /main-404-content -->

   <!-- Java Script
   ================================================== --> 
   <script src="{{asset('js/main.min.js')}}"></script>
   <script src="{{asset('js/main2.js')}}"></script>
   <script src="{{asset('js/main.js')}}"></script>

</body>

</html>