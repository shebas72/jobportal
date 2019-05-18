<?php

    include('inc.php');

    $type = $_GET['type'];
    $id = $_GET['id'];

    if($type == 'candidate')
    {
        $sqlck = "SELECT * FROM candidate WHERE id='$id' AND active='0';";
        $resck=mysql_query($sqlck);
        $count=mysql_num_rows($resck);
        if($count==1)
        {
            $sqlu = "UPDATE candidate SET active='1' WHERE id='$id';";
            $resu = mysql_query($sqlu);
            $sqlack = "SELECT * FROM candidate WHERE id='$id' AND active='1';";
            $resack = mysql_query($sqlack);
            while($row = mysql_fetch_array($resack)) 
            {                
                $email = $row['email'];
                $password = $row['password'];
            }
        }

        $to = $email;
        $from = $mailfrom;
        $subject = 'Congratulations! Account activated for '.$email;

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $to . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body style="font-size:14px;">';
        $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
        $message .= '<p>Congratulations !<br /><br />Your membership is now active. Please use the login details below to start using your <a href="http://myjob.sa/main/">Candidate Account</a>.</p>';
        $message .= '<table cellspacing="10" cellpadding="10">';
        $message .= '<tr><td><b>Email:</b></td><td>'.$email.'</td></tr>';
        $message .= '<tr><td><b>Password:</b></td><td>'.$password.'</td></tr>';
        $message .= '</table>';
        $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
        $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
        $message .= '</body></html>';
        
        mail($to, $subject, $message, $headers);    
    }

    if($type=='company')
    {
        $sqlck = "SELECT * FROM company WHERE id='$id' AND active='0';";
        $resck=mysql_query($sqlck);
        $count=mysql_num_rows($resck);
        if($count==1)
        {
            $sqlu = "UPDATE company SET active='1' WHERE id='$id';";
            $resu = mysql_query($sqlu);
            $sqlack = "SELECT * FROM company WHERE id='$id' AND active='1';";
            $resack = mysql_query($sqlack);
            while($row = mysql_fetch_array($resack)) 
            {
                $name = $row['name'];
                $email = $row['email'];
                $password = $row['password'];
            }
        }

        $to = $email;
        $from = $mailfrom;
        $subject = 'Congratulations! Account Activated - '.$name;

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $to . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body style="font-size:14px;">';
        $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
        $message .= '<p>Congratulations <b>'.$name.'</b> !<br /><br /> Your membership is now active. Please use the login details below to start using your <a href="http://myjob.sa/main/company.php">Company Account</a>.</p>';
        $message .= '<table cellspacing="10" cellpadding="10">';
        $message .= '<tr><td><b>Email:</b></td><td>'.$email.'</td></tr>';
        $message .= '<tr><td><b>Password:</b></td><td>'.$password.'</td></tr>';
        $message .= '</table>';
        $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
        $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
        $message .= '</body></html>';

        mail($to, $subject, $message, $headers);

    }

?>

<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <title>Activate your account | Myjob.sa</title>
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
    <body class=" page page-id-292 page-template page-template-templates page-template-landing-hire page-template-templateslanding-hire-php body-logged-out">
        <header id="header">
            <nav class="navbar" style="background-color: #e5202d;">
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
                                <li class="scoot-login btn-border register-btn menu-item menu-item-type-custom menu-item-object-custom"><a title="Create an Account" href="register-candidate.php" data-hover="Create an Account"><span>Create an Account</a></span></li>
                                <?php } ?>
                        </ul>        
                    </div>
                </div>
            </nav>
        </header>
        <div class="clearfix"></div>
        <div class="body-wrap">      
            <div class="landing-page">
                <div class="top-image-landing" style="background-image: url('wordpress/wp-content/uploads/2015/12/jshomepage401.jpg')"></div>
                <div class="landing-tabs">
                    <div class="landing-header landing-header-hire">
                        <div class="clearfix visible-sm visible-xs"><br><br></div>

                        <div class="scoot-login" style="width: 30%; margin: 0 auto; margin-top: 10%; background: white; padding: 20px;">
                            <div class="text-center">
                                <div class="scoot-logo">
                                    <img ng-src="images/logo-red.png" src="http://myjob.sa/main/wordpress/wp-content/themes/scootwp/assets/images/small-logo.png">
                                    <br /><br />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <form class="ng-valid-email ng-dirty ng-valid-parse ng-valid ng-valid-required" ng-submit="compLogin.submit()">
                                <div class="col-xs-12 login-content">                                                                        

                                    <div class="form-group" align="center">
                                        <img src="http://www.meriktours.com/wp-content/uploads/2015/06/Check-red.png" width="100" /><br /><br />
                                        <b>Account activated for - <?php echo $email.' - '.$name; ?></b>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>

                    </div>                    
                </div>
            </div>


        </div><!-- end of body-wrap-->
        <div style="margin-top: -50px;"><?php include('footer.php'); ?></div>

        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/bootstrap.min7035.js?ver=4.3.4'></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/modernizr7035.js?ver=4.3.4'></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/jquery.validate.min7035.js?ver=4.3.4'></script>        
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/footer7035.js?ver=4.3.4'></script>        
    </body>

</html>