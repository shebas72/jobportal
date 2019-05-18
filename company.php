<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $hiddmen=0;
    
    if(($_SESSION['email'])&&($_SESSION['password']))
    {
        $hiddmen=1;
    }
?>
<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <title>myjob.sa | Hire Somebody</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Chrome for Android theme color -->
        <meta name="theme-color" content="#e5202d">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel='stylesheet' id='bootstrap-css'  href='wordpress/wp-content/themes/scootwp/assets/css/bootstrap.min7035.css?ver=4.3.4' type='text/css' media='all' />
        <link rel='stylesheet' id='royalslider-css'  href='wordpress/wp-content/themes/scootwp/assets/js/royalslider/skins/universal/rs-universal7035.css?ver=4.3.4' type='text/css' media='all' />
        <link rel='stylesheet' id='royalslider-skin-css'  href='wordpress/wp-content/themes/scootwp/assets/js/royalslider/royalslider7035.css?ver=4.3.4' type='text/css' media='all' />
        <link rel='stylesheet' id='font-awesome-css'  href='wordpress/wp-content/themes/scootwp/assets/css/font-awesome.min7035.css?ver=4.3.4' type='text/css' media='all' />
        <link rel='stylesheet' id='style-main-css'  href='wordpress/wp-content/themes/scootwp/assets/css/style7035.css?ver=4.3.4' type='text/css' media='all' />
        <script type='text/javascript' src='wordpress/wp-includes/js/jquery/jqueryc1d8.js?ver=1.11.3'></script>
        <script type='text/javascript' src='wordpress/wp-includes/js/jquery/jquery-migrate.min1576.js?ver=1.2.1'></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/royalslider/jquery.royalslider.min7035.js?ver=4.3.4'></script>        
    </head>
    <body class=" home page page-id-248 page-template page-template-templates page-template-landing page-template-templateslanding-php body-logged-out">
        <!-- Google Tag Manager -->        
        <header id="header">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="wordpress/wp-content/themes/scootwp/assets/images/logo.png"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse" aria-expanded="false" >
                        <ul class="nav navbar-nav navbar-right" id="menu-top" class="">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom"><a title="Job Search" href="search.php" data-hover="Job Search"><span>Job Search</a></span></li>
                            <?php if($hiddmen==1){ ?>
                            <li class="scoot-account btn-border menu-item menu-item-type-custom menu-item-object-custom"><a title="My Account" href="myaccount.php" data-hover="My Account"><span>My Account</a></span></li>
                            <?php } if($hiddmen==0){ ?>
                            <li class="scoot-login menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown"><a title="Login" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" data-hover="Login"><span>Login <span class="caret"></span></a></span>
                                <ul role="menu" class=" dropdown-menu">
                                    <li id="menu-item-224" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-224"><a title="As Candidate" href="login-candidate.php" data-hover="As Candidate"><span>As Candidate</a></span></li>
                                    <li id="menu-item-225" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-225"><a title="As Company" href="login-company.php" data-hover="As Company"><span>As Company</a></span></li>
                                </ul>
                            </li>
                            <li class="scoot-login btn-border register-btn menu-item menu-item-type-custom menu-item-object-custom"><a title="Create an Account" href="register-company.php" data-hover="Create an Account"><span>Create an Account</a></span></li>
                            <?php } ?>
                        </ul>        
                    </div>
                </div>
            </nav>
        </header>
        <div class="clearfix"></div>
        <div class="body-wrap">      <div class="landing-page">
                <div class="top-image-landing" style="background-image: url('wordpress/wp-content/uploads/2015/12/man40-2.jpg')"></div>
                <div class="landing-tabs">
                    <div class="landing-header landing-header-hire">
                        <div class="clearfix visible-sm visible-xs"><br><br></div>
                        <ul class="nav nav-tabs" id="nav-landing-tabs" role="tablist">
                            <li>
                                <a href="index.php" class="hiretab" >Jobseeker</a>
                            </li>
                            <li class="active">
                                <a href="#find" aria-controls="find" role="tab" data-toggle="tab">Employer</a>
                            </li>
                        </ul>

                        <div class="landing-tab-top top-text-block">
                            <div class="container text-center">
                                <h1 class="title">Find Your Perfect Talent</h1>
                                <h5 class="subtitle hidden-xs">Get matched to candidates that fit your profile<br></h5>
                                <a href="register-company.php" class="btn btn-red btn-xl btn-cta btn-cta">Find Talent Now</a>
                            </div>
                            <div class="clearfix visible-sm visible-xs"><br><br></div>
                        </div>
                    </div>
                    <div class="landing-tab-hire scoot-block landing-tab-employers-hiring">
                        <div class="text-center">
                            <h2 class="title">Leading employers already using us</h2>
                            <h4 class="subtitle hidden-xs"><p>Over 2,500 companies trust us with their hiring</p>
                            </h4>
                        </div>
                        <div class="royalSlider rsDefault">
                              <a href="wordpress/wp-content/uploads/2015/12/w-ae.png" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/w-ol.png" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/w-sa.png" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/w-sc.png" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/w-gm.png" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/w-z.png" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/w-sam.png" class="rsImg"></a>

                        </div>
                    </div>
                    <div class="landing-how-we-connect scoot-block text-center landing-tab-hire">
                        <div class="container">
                            <h2 class="title">How we match you to the right candidate</h2>
                            <h4 class="subtitle hidden-xs"><p>Post a job and let it get matched to candidates looking for similar opportunities </p>
                            </h4>
                            <ul class="landing-how-we-connect-list">
                                <li>
                                    <div class="img-wrapper"> <img src="wordpress/wp-content/uploads/2015/12/Resized4.png"></div>
                                    <h4 class="title">1. Post a job</h4>
                                    <div class="content hidden-xs">
                                        <p>Create your employer account and start posting job advertisements within a matter of minutes</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-wrapper"> <img src="wordpress/wp-content/uploads/2015/12/Get-Matched-icon-e1451292934424.png"></div>
                                    <h4 class="title">2. Instantly see the candidates</h4>
                                    <div class="content hidden-xs">
                                        <p>Don't wait for applicants to start applying. We match you to candidates with relevant experience and you can invite them to apply. </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-wrapper"> <img src="wordpress/wp-content/uploads/2015/12/Resized6.png"></div>
                                    <h4 class="title">3. Contact them immediately</h4>
                                    <div class="content hidden-xs">
                                        <p>You can choose to message candidates through our messaging system or invite the ones you like to interviews directly via our interview slot system. </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="landing-tab-find scoot-block landing-featured-in">
                        <div class="text-center">
                            <h2 class="title">As Featured In</h2>
                            <h4 class="subtitle hidden-xs"></h4>
                        </div>

                        <div class="royalSlider rsDefault">
                          <a href="wordpress/wp-content/uploads/2015/12/newslogo_AlJazeera.png" alt="" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/newslogo_awsat2.png" alt="" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/newslogo_bloomberg.png" alt="" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/newslogo_CNN_new2.png" alt="" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/newslogo_FT.png" alt="" class="rsImg"></a>
                            <a href="wordpress/wp-content/uploads/2015/12/newslogo_reuters.png" alt="" class="rsImg"></a>
                        </div>
                    </div>
                    <div class="btn-with-bg" style="background-image: url('wordpress/wp-content/uploads/2015/12/e50-1.jpg')">
                        <a href="register-company.php" class="btn btn-red btn-xl btn-cta">Find Talent Now</a>
                    </div>
                </div>
            </div>


        </div><!-- end of body-wrap-->
        <?php include('footer.php'); ?>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/bootstrap.min7035.js?ver=4.3.4'></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/modernizr7035.js?ver=4.3.4'></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/jquery.validate.min7035.js?ver=4.3.4'></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/footer7035.js?ver=4.3.4'></script>        
    </body>

</html>