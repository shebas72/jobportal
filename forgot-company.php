<?php
    include('inc.php');    
    $email = $_GET{'email'};
?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Recover Password - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles/styles.min.css?v=55128" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body class="">
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
                </div>
            </nav>
        </header>
        <div id="toast-container" class="toast-top-right" ng-class="[config.position, config.animation]" toaster-options="{'time-out': 3000}"></div>
        <div id="toast-container" class="toast-center" ng-class="[config.position, config.animation]" toaster-options="{'time-out': 0, 'position-class': 'toast-center', 'toaster-id': 2}"></div>
        <div class="body-wrap relative">
            <scoot-loading>
                <div id="loader" class="spinner-wrapper" style="display: none;">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </scoot-loading>
            <div ui-view="">
                <div class="login-page">
                    <div class="scoot-login">
                        <div class="text-center">
                            <h1 class="heading" translate="">
                                <span>Reset Password</span>
                            </h1>
                            <p translate="">
                                <span>Type your email below</span>
                            </p>
                        </div>
                        <form class="ng-pristine ng-valid-email ng-invalid ng-invalid-required" ng-submit="compForgot.submit()">
                            <div class="col-xs-12">

                                <?php
                                    if(isset($email))
                                    {
                                        $sqlck = "SELECT * FROM company WHERE email='$email';";
                                        $resck=mysql_query($sqlck);                                        
                                        $count=mysql_num_rows($resck);
                                        if($count==1)
                                        {
                                            while($row = mysql_fetch_array($resck)) 
                                            {
                                                $password = $row['password'];
                                            }
                                            
                                            $to = $email;
                                            $from = $mailfrom;
                                            $subject = 'Recovered Password';

                                            $headers = "From: " . $from . "\r\n";
                                            $headers .= "Reply-To: ". $to . "\r\n";
                                            $headers .= "MIME-Version: 1.0\r\n";
                                            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                            
                                            $message = '<html><body style="font-size:14px;">';
                                            $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
                                            $message .= '<p>Congratulations !<br /><br />Your password has been successfully recovered. Please use the login details below to start using your <a href="http://myjob.sa/main/">Candidate Account</a>.</p>';
                                            $message .= '<table cellspacing="10" cellpadding="10">';
                                            $message .= '<tr><td><b>Email:</b></td><td>'.$email.'</td></tr>';
                                            $message .= '<tr><td><b>Password:</b></td><td>'.$password.'</td></tr>';
                                            $message .= '</table>';
                                            $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
                                            $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
                                            $message .= '</body></html>';
                                            
                                            mail($to, $subject, $message, $headers);
                                            
                                        ?>
                                            <img src="wordpress/loading.gif" width="20" />
                                            An email has been sent to you with your password.
                                        <?php

                                        }                                        
                                    }
                                ?>

                                <div class="form-group">
                                    <label class="control-label" translate="" for="email">
                                        <span>E-mail</span>
                                    </label>
                                    <input id="email" class="form-control ng-pristine ng-untouched ng-empty ng-valid-email ng-invalid ng-invalid-required" type="email" required="" name="email" ng-model="compForgot.email">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-red btn-cta btn-md" translate="" type="submit">
                                        <span>Reset</span>
                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>