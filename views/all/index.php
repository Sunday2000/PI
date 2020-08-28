<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Biz Express</title>
	<!-- core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet">
    <link href="/css/owl.carousel.css" rel="stylesheet">
    <link href="/css/owl.transitions.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
  
</head><!--/head-->

<body id="home" class="homepage">

    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top top-nav-collapse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="scroll active"><a href="#home">Home </a></li>
                        <li class="scroll"><a href="#services">Service </a></li>
                        <li class="scroll"><a href="#blog">  Blog </a></li>
                        <li class="scroll"><a href="#testimonial"> Testimonial </a></li>
                        <li class="scroll"><a href="#get-in-touch">Contact</a></li>      
                        <li class=""><a href="<?= $router->url('register') ?>">Inscription </a></li>
                        <li class=""><a href="<?= $router->url('login') ?>">Connexion</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

    <section id="main-slider">
        <div class="owl-carousel">
            <div class="item" style="background-image: url(images/bg1.jpg);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="carousel-content">
                                    <h2>Clean and Flexible Business Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>

tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                                    <a class="btn btn-primary btn-lg" href="#">Find Out More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
             <div class="item" style="background-image: url(images/bg2.jpg);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="carousel-content">
                                    <h2>Clean and Flexible Business Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>

tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                                    <a class="btn btn-primary btn-lg" href="#">Find Out More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.owl-carousel-->
    </section><!--/#main-slider-->

    

	<section id="services" >
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Our Services</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="images/icon1.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Responsive Design</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
ing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="images/icon2.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">UX Design</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
ing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="200ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="images/icon3.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">UI Design</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
ing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->
                
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
                        <div class="media service-box">
                            <div class="pull-left">
                               <img src="images/icon4.png" alt="img">
                            </div>
                            <div class="media-body">
                               <h4 class="media-heading">SEO Services</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
ing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms">
                        <div class="media service-box">
                            <div class="pull-left">
                               <img src="images/icon5.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">iOS Development</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
ing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="500ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="images/icon6.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Andriod Development</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur 
ing elit, sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div><!--/.col-md-4-->
                </div>
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#services-->
    
    <section id="animated-number">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Fun Facts</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row text-center">
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="0ms">
                        <div class="animated-number" data-digit="136800" data-duration="1000"></div>
                        <strong>Lorem Ipsum</strong>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
                        <div class="animated-number" data-digit="1231+" data-duration="1000"></div>
                        <strong>Lorem Ipsum</strong>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="200ms">
                        <div class="animated-number" data-digit="6000" data-duration="1000"></div>
                        <strong>Lorem Ipsum</strong>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-duration="400ms" data-wow-delay="300ms">
                        <div class="animated-number" data-digit="2000" data-duration="1000"></div>
                        <strong>Lorem Ipsum</strong>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#animated-number-->
    
    <section id="blog">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Latest Blogs</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>
			 
             <div class="row">
             <div id="owl-example" class="owl-carousel"> 
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img src="images/blog1.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img src="images/blog2.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img  src="images/blog3.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img src="images/blog1.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img src="images/blog2.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img  src="images/blog3.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img src="images/blog1.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img src="images/blog2.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                <div class="text-center item">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <header class="entry-header">
                                <div class="entry-thumbnail">
                                    <img  src="images/blog3.jpg" alt="">
                                   
                                </div>
                                <div class="entry-date">25 November 2014</div>
                                <h2 class="entry-title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            </header>

                            <div class="entry-content">
                                <P>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</P>
                                <a class="btn btn-primary" href="#">BUY NOW</a>
                            </div>

                            
                        </article>
                    </div>
                </div>
                
                
                
                
            </div>
            </div>			

        </div>
    </section> 
    
    
    
    
    
    <!--/#blog-->
    
    <section id="testimonial">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">testimonials</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row">
                <div class="col-sm-6">
                <div class="panel-one">
                <div class="user-img"><img alt="" src="images/testimonail_1.jpg"></div>
                <div class="testi-info">
                <h4>Jonathon Andrew</h4>
                <h5>Lorem ipsum dolor sit amet</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
                </div>
                
                
                </div>
                <div class="col-sm-6">
                <div class="panel-one">
                <div class="user-img"><img alt="" src="images/testimonail_2.jpg"></div>
                <div class="testi-info">
                <h4>Jonathon Andrew</h4>
                <h5>Lorem ipsum dolor sit amet</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
                </div>
                
                
                </div>
                <div class="col-sm-6">
                <div class="panel-one">
                <div class="user-img"><img alt="" src="images/testimonail_3.jpg"></div>
                <div class="testi-info">
                <h4>Jonathon Andrew</h4>
                <h5>Lorem ipsum dolor sit amet</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
                </div>
                
                
                </div>
                <div class="col-sm-6">
                <div class="panel-one">
                <div class="user-img"><img alt="" src="images/testimonail_4.jpg"></div>
                <div class="testi-info">
                <h4>Jonathon Andrew</h4>
                <h5>Lorem ipsum dolor sit amet</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doeiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
                </div>
                
                
                </div>
                
                
                
                
                
                

            </div>

        </div>
    </section> <!--/#testimonial-->
	
    

    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">CONTACT US</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>
            
            <div class="row">
            <div class="col-sm-6">
            <div class="address">
            <h4>Address</h4>
            <p>Lorem ipsum dolor sit amet, ETX consectetur adipiscing elit,<br>
 sed do ETX eiusmod tempor incididunt ut labore et</p>
            </div>
            
            <div class="address">
            <h4>Phone </h4>
            <p>123-456-7890</p>
            </div>
            
            <div class="address">
            <h4>Email</h4>
            <p><a href="#">info@companyname.com </a></p>
            </div>
            
            <div class="address">
            <h4>Follow Us</h4>
            <p><a href="#"><i class="fa fa-facebook"></i></a>  &nbsp; <a href="#"><i class="fa fa-twitter"></i></a> &nbsp; <a href="#"><i class="fa fa-google-plus"></i></a></p>
            </div>
            </div>
            
            <div class="col-sm-6">
            
            <form action="#" method="post" name="contact-form" id="main-contact-form">
                                <div class="form-group">
                                    <input type="text" required placeholder="Name" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" required placeholder="Email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="text" required placeholder="Subject" class="form-control" name="subject">
                                </div>
                                <div class="form-group">
                                    <textarea required placeholder="Message" rows="8" class="form-control" name="message"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">SUBMIT</button>
                            </form>
            </div>
            
            
            </div>
            
            
        </div>
    </section><!--/#get-in-touch-->




    <footer id="footer">
        <div class="container text-center">
          All rights reserved © 2016 | <a href="http://www.pfind.com/goodies/bizexpress/">BizExpress Template</a> from <a href="http://www.pfind.com/goodies/">pFind.com</a>
        </div>
    </footer><!--/#footer-->

    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/mousescroll.js"></script>
    <script src="/js/smoothscroll.js"></script>
    <script src="/js/jquery.prettyPhoto.js"></script>
    <script src="/js/jquery.isotope.min.js"></script>
    <script src="/js/jquery.inview.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/main.js"></script>
	<script src="/js/scrolling-nav.js"></script>
<script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel();
    });

    $("body").data("page", "frontpage");

$("#owl-example").owlCarousel({ 
        items:3,   
/*        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,9],
        itemsTablet: [768,5],
        itemsTabletSmall: false,
        itemsMobile : [479,4]*/
})

    </script>
</body>
</html>