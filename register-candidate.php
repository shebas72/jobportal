<?php
    session_start();
    include('inc.php');
    $email = $_GET{'candidateemail'};
    $password = $_GET{'candidatepassword'};
    
    $success=0;
    $erremail1=0;
    $erremail2=0;
    $erremail3=0;
    $errpass=0;
    
    
    if(isset($email) && trim($email) == '')
    {
        $erremail1=1;
    }
    
    
    if(isset($email))
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $erremail2=1;
        }
    }
    
    
    if(isset($email))
    {
        $sqlchk = "SELECT * FROM candidate WHERE email = \"$email\";";
        $reschk = mysql_query($sqlchk);        
        if(mysql_num_rows($reschk)!=0)
        {
            $erremail3=1;
        }
    }
        
    
    if(isset($password))
    {
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,16}$/', $password)) 
        {
            $errpass=1;
        }
    }
    
    if(isset($email) && isset($password))
    {
        if(($erremail1==0) && ($erremail2==0) && ($erremail3==0) && ($errpass==0))
        {
            $success=1;
        }
    }
    ?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>
        <style class="vjs-styles-defaults">

            .video-js {
                width: 300px;
                height: 150px;
            }

            .vjs-fluid {
                padding-top: 56.25%
            }

        </style>
        <style type="text/css">
            @charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}
        </style>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Candidate Registration - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles/styles.min.css?v=36391" rel="stylesheet">            

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body>
        <header id="header">
            <div navigation="">
                <nav class="navbar" ng-controller="NavigationCtrl">
                    <div class="nav-primary-wrapper">
                        <div class="container">
                            <div class="navbar-header">
                                <button class="navbar-toggle collapsed" aria-expanded="false" data-target="#navbar-collapse" data-toggle="collapse" type="button">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="/">
                                    <img ng-src="http://myjob.sa/main/wordpress/wp-content/themes/scootwp/assets/images/logo.png" src="http://myjob.sa/main/wordpress/wp-content/themes/scootwp/assets/images/logo.png">
                                </a>
                            </div>
                            <div id="navbar-collapse" class="collapse navbar-collapse nav-primary" style="max-height: 860px;">
                                <ul class="nav navbar-nav navbar-right">
                                    <li ng-hide="isLogedIn()" ui-sref-active="active">
                                        <a translate="" ng-click="openState('search')">
                                            <span>Job Search</span>
                                        </a>
                                    </li>
                                    <li class="dropdown" ng-hide="isLogedIn()" ui-sref-active="active">
                                        <a id="login" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
                                            Login
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="login">
                                            <li ui-sref-active="active">
                                                <a translate="" ui-sref="user-login" href="/client/user/login">
                                                    <span>Candidate Login</span>
                                                </a>
                                            </li>
                                            <li ui-sref-active="active">
                                                <a translate="" ui-sref="company-login" href="/client/company/login">
                                                    <span>Company Login</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li ng-hide="isLogedIn()" ui-sref-active="active">
                                        <div ng-controller="registerModalController">
                                            <a translate="" ng-click="open()">
                                                <span>Create an account</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <ul class="nav navbar-nav nav-secondary visible-xs"> </ul>
                            </div>
                        </div>
                    </div>
                    <div class="nav-secondary-wrapper hidden-xs"> </div>
                </nav>
            </div>
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
                <div class="login-page register-modal">
                    <div class="modal-body register-body">
                        <ng-include src="'mvc/views/other/signupForm.html'">
                            <div justified="true">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active">
                                        <a uib-tab-heading-transclude="" ng-click="select()" href="#">
                                            <uib-tab-heading> Jobseeker </uib-tab-heading>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a uib-tab-heading-transclude="" ng-click="select()" href="register-company.php">
                                            <uib-tab-heading> Employer </uib-tab-heading>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="scoot-logo">
                                            <img ng-src="http://myjob.sa/main/wordpress/wp-content/themes/scootwp/assets/images/small-logo.png" src="http://myjob.sa/main/wordpress/wp-content/themes/scootwp/assets/images/small-logo.png">
                                        </div>
                                        <div class="register-modal-inner candidate">
                                            <div class="col-xs-12 register">
                                                <?php                                                    
                                                    if($success==1)
                                                    {
                                                        $sqlins = "INSERT INTO candidate(email,password,date_added) VALUES(\"$email\",\"$password\",now());";
                                                        $resins = mysql_query($sqlins);
                                                        
                                                        $last_id = mysql_insert_id();
                                                        
                                                        $to = $mailto;
                                                        $from = $mailfrom;
                                                        $subject = 'New Candidate : '.$name;

                                                        $headers = "From: " . $from . "\r\n";
                                                        $headers .= "Reply-To: ". $email . "\r\n";
                                                        
                                                        $headers .= "MIME-Version: 1.0\r\n";
                                                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                                        $message = '<html><body style="font-size:12px;">';
                                                        $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" />';
                                                        $message .= '<br /><br />A new candidate has joined myjob.sa.';
                                                        $message .= '<table cellspacing="10" cellpadding="10">';
                                                        $message .= '<tr><td><b>Company:</b></td><td>'.$name.'</td></tr>';
                                                        $message .= '<tr><td><b>Email:</b></td><td>'.$email.'</td></tr>';
                                                        $message .= '</table>';
                                                        $message .= '</body></html>';

                                                        mail($to, $subject, $message, $headers);
                                                        
                                                        
                                                        $to = $email;
                                                        $from = $mailfrom;
                                                        $subject = 'Activate your account';

                                                        $headers = "From: " . $from . "\r\n";
                                                        $headers .= "Reply-To: ". $to . "\r\n";
                                                        $headers .= "MIME-Version: 1.0\r\n";
                                                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                        
                                                        $message = '<html><body style="font-size:14px;">';
                                                        $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
                                                        $message .= '<p>Thanks for signing up with MYJOB.SA !<br /><br />Inorder to activate your account kindly click the below link <a href="http://myjob.sa/main/activate.php?type=candidate&id='.$last_id.'">ACTIVATE MYJOB.SA ACCOUNT &raquo;</a>.</p>';
                                                        $message .= '<table cellspacing="10" cellpadding="10">';
                                                        $message .= '<tr><td><b>Email:</b></td><td>'.$email.'</td></tr>';
                                                        $message .= '<tr><td><b>Password:</b></td><td>'.$password.'</td></tr>';
                                                        $message .= '</table>';
                                                        $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
                                                        $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
                                                        $message .= '</body></html>';
                                                        
                                                        mail($to, $subject, $message, $headers);
                                                        
                                                    ?>
                                                        
                                                        </b>An activation email has sent to <?php echo $email; ?>. Kindly check.</b>
                                                    <?php
                                                    //$_SESSION['email']=$email;
                                                    //$_SESSION['password']=$password;
                                                    //echo '<META http-equiv="refresh" content="0;URL=candidate-edit-1.php">';
                                                    }
                                                ?>
                                                <form class="ng-valid-email ng-valid-pattern ng-dirty ng-valid-uniqueness ng-valid-parse ng-valid ng-valid-required" novalidate="" ng-submit="candidateSubmit(candidateRegister, candidate)" name="candidateRegister">
                                                    <div class="row">
                                                        <div class="clearfix"></div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group" ng-class="{'has-error': ((candidateRegister['candidate-email'].$touched || candidateRegister.$submitted) && candidateRegister['candidate-email'].$invalid), 'has-success': ((candidateRegister['candidate-email'].$touched || candidateRegister.$submitted) && candidateRegister['candidate-email'].$valid)}">
                                                                <div class="has-feedback">
                                                                    <input id="candidateemail" class="form-control ng-untouched ng-valid-email ng-not-empty ng-dirty ng-valid ng-valid-required ng-valid-uniqueness" type="email" ng-required="true" ng-change="candidateRegister['candidate-email'].$setValidity('uniqueness', true); candidate.email=candidate.email.toLowerCase();" name="candidateemail" placeholder="Email Address" ng-model="candidate.email" required="required">                                                                    
                                                                </div>
                                                                <?php                                                                
                                                                    if($erremail1==1)
                                                                    {
                                                                    ?>
                                                                    <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>Email is required.</span>
                                                                        </li>
                                                                    </ul>
                                                                    <?php
                                                                    }
                                                                    if($erremail2==1)
                                                                    {
                                                                        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                                                                        {
                                                                        ?>
                                                                        <ul class="errors-tooltip">
                                                                            <li class="" translate="">
                                                                                <span>Should be valid email address.</span>
                                                                            </li>
                                                                        </ul>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    if($erremail3==1)
                                                                    {                                                                        
                                                                        ?>
                                                                        <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>This email address already exists on myjob.sa</span>
                                                                        </li>
                                                                        </ul>
                                                                        <?php                                                                        
                                                                    }
                                                                    ?>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group" ng-class="{'has-error': ((candidateRegister['candidate-password'].$touched || candidateRegister.$submitted) && candidateRegister['candidate-password'].$invalid), 'has-success': ((candidateRegister['candidate-password'].$touched || candidateRegister.$submitted) && candidateRegister['candidate-password'].$valid)}">
                                                                <div class="has-feedback">
                                                                    <input id="candidatepassword" class="form-control ng-untouched ng-valid-pattern ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required" type="password" ng-required="true" placeholder="Password" ng-pattern="/^.{6,16}$/" ng-model="candidate.password" name="candidatepassword" required="required">                                                                    
                                                                </div>
                                                                <?php
                                                                if($errpass==1)
                                                                {
                                                                ?>
                                                                <ul class="errors-tooltip">
                                                                    <li>
                                                                        <span>
                                                                            Password not allowed. Make sure it meets the below requirement.
                                                                            <ul>                                                                                
                                                                                <li>Must be 6-16 characters</li>
                                                                                <li>Must contain at least 1 number and 1 letter</li>
                                                                                <li>May contain letter and numbers</li>                                                                                
                                                                                <li>May contain any of these characters: ! @ # $ % </li>                                                                                
                                                                            </ul>
                                                                        </span>
                                                                    </li>                                                                    
                                                                </ul>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="existing text-center">
                                                        <p>
                                                            Already have a myjob.sa account?
                                                            <a ui-sref="user-login" href="login-candidate.php">Log In</a>
                                                        </p>
                                                    </div>
                                                    <div class="ctas">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-red btn-lg btn-block" translate="" type="submit" ng-if="!loading">
                                                                    <span>Sign Up</span>
                                                                </button>
                                                            </div>                                                            
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-center privacy">
                                                        <p>
                                                            By signing up you agree to the
                                                            <a href="#">Privacy Policy</a>
                                                            ,
                                                            <a href="#">Terms Of Use</a>
                                                        </p>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" uib-tab-content-transclude="tab" ng-class="{active: tab.active}" ng-repeat="tab in tabs">
                                        
                                    </div>
                                </div>
                            </div>
                        </ng-include>
                    </div>
                </div>
                <div class="modal-backdrop register-backdrop" ng-click="goback()"></div>
            </div>
        </div>
        <?php include('footer.php'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>       
    </body>
</html>