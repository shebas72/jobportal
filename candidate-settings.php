<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $action=$_GET['action'];

    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');

        $sqlusercheck = "SELECT * FROM candidate WHERE email=\"$email\" AND password=\"$password\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $uid = $row['id'];                            
                $fname = $row['fname'];            
                $lname = $row['lname'];
                $mobile = $row['mobile'];
                $photo = $row['photo'];
                $resume = $row['resume'];
                $experience = $row['experience'];                
            }
        }

        function time_elapsed_string($datetime, $full = false) 
        {
            $now = new DateTime;
            $ago = new DateTime($datetime);
            $diff = $now->diff($ago);

            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }

    ?>
    <!DOCTYPE html>
    <html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
        <head>        
            <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
            <title page-title="">Settings - myjob.sa</title>
            <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
            <meta content="" name="description">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta content="#e5202d" name="theme-color">
            <meta content="!" name="fragment">
            <link href="https://www.skootjobs.com/client/styles/styles.min.css?v=9022" rel="stylesheet">

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
        </head>
        <body>
            <header id="header">
                <div navigation="">
                    <nav class="navbar" ng-controller="NavigationCtrl" ng-class="{homepage:isHomePageCandidate()}">
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
                                        <img ng-src="images/logo.png" src="images/logo.png">
                                    </a>
                                </div>
                                <div id="navbar-collapse" class="collapse navbar-collapse nav-primary" aria-expanded="false" style="max-height: 860px;">
                                    <?php include('topmenu.php'); ?>
                                    <div class="clearfix"></div>
                                    <ul class="nav navbar-nav nav-secondary visible-xs">
                                        <li ui-sref-active="active" ng-if="isCandidate()" class="active">
                                            <a translate="" ui-sref="user" href="candidate-dashboard.php">
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="search" href="search.php">
                                                <span>Job search</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-jobs-matched" href="candidate-matchedjobs.php">
                                                <span>Matched jobs</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-jobs-shortlisted" href="candidate-savedjobs.php">
                                                <span>Saved jobs</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-jobs-applied" href="candidate-appliedjobs.php">
                                                <span>Applied jobs</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-interviews" href="candidate-interviews.php">
                                                <span>Interviews</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ng-click="logout()" ng-controller="candidateLogoutController" href="logout.php">
                                                <span>Log out</span>
                                            </a>
                                        </li>
                                    </ul> 
                                </div>
                            </div>
                        </div>
                        <div class="nav-secondary-wrapper hidden-xs" ng-if="!isHomePageCandidate()">
                            <div class="container" ng-if="isCandidate()">
                                <ul class="nav navbar-nav nav-secondary">
                                    <li ui-sref-active="active" class="active">
                                        <a translate="" ui-sref="user" href="candidate-dashboard.php">
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="search" href="search.php">
                                            <span>Job search</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-jobs-matched" href="candidate-matchedjobs.php">
                                            <span>Matched jobs</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-jobs-shortlisted" href="candidate-savedjobs.php">
                                            <span>Saved jobs</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-jobs-applied" href="candidate-appliedjobs.php">
                                            <span>Applied jobs</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-interviews" href="candidate-interviews.php">
                                            <span>Interviews</span>
                                        </a>
                                    </li>                                    
                                </ul>
                            </div>
                        </div>
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
                    <div class="register-page">
                    
                    <?php if($action=='delete') {?>
                    
                    <div align="center">
                        <h3 align="center">ARE YOUR SURE ? THIS CANT BE UNDONE !</h3>
                        <a class="btn btn-md btn-red" href="logout.php?action=candidatedelete&id=<?php echo $uid; ?>">YES</a> <a class="btn btn-md btn-grey" href="candidate-settings.php">NO</a>
                        <br /><br />
                    </div>
                    
                    <?php } ?>
                    
                        <div class="user-setting-page">
                            <div class="container panel row-2">
                                <div class="sub-panel">
                                    <div class="col-xs-12">
                                        <h3 translate="">
                                            <span>Settings</span>
                                        </h3>
                                        <p translate="">
                                            <span>Change settings for your account or your organizations.</span>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="sub-panel">
                                    <div class="col-md-8 col-lg-6">
                                        <form class="ng-invalid ng-invalid-required ng-valid-pattern ng-dirty ng-valid-parse ng-invalid-compare-to" novalidate="" name="settingsForm" ng-submit="submit(settingsForm.$valid)">
                                            <div class="form-group">
                                                <label class="control-label" translate="" for="old-password">
                                                    <span>Old password</span>
                                                </label>
                                                <input id="old-password" class="form-control ng-untouched ng-valid-pattern ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required" type="password" ng-required="true" name="oldpassword" ng-pattern="/^.{6,16}$/" ng-model="oldpassword" placeholder="Type your old password here" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" translate="" for="password">
                                                    <span>New Password</span>
                                                </label>
                                                <input id="password" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="password" ng-required="true" name="password" ng-pattern="/^.{6,16}$/" ng-model="candidate.password" placeholder="Type your new password here" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" translate="" for="confirm-password">
                                                    <span>Confirm New Password</span>
                                                </label>
                                                <input id="confirm-password" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-invalid-compare-to" type="password" ng-required="true" name="confirmpassword" ng-pattern="/^.{6,16}$/" compare-to="candidate.password" ng-model="confpassword" placeholder="Retype your new password here" required="required">
                                            </div>
                                            <div class="text-left">
                                                <input class="btn btn-md btn-red" type="submit" value="Change Password">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="hidden-xs hidden-sm col-md-4 col-lg-6">
                                        <div class="setting-icon">
                                            <img class="img-responsive" src="http://image.flaticon.com/icons/svg/148/148913.svg">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="sub-panel">
                                    <div class="col-xs-12">
                                        <h3 translate="">
                                            <span>Other Settings</span>
                                        </h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="sub-panel">
                                    <form class="col-xs-12 ng-pristine ng-valid">
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm-6 col-md-3">
                                                <label class="control-label" translate="" for="contact-phone">
                                                    <span>Matched jobs notifications:</span>
                                                </label>
                                                <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="candidate.receiveMatchUpdates">
                                                    <option translate="" value="never">
                                                        <span>Never</span>
                                                    </option>
                                                    <option translate="" value="daily">
                                                        <span>Daily</span>
                                                    </option>
                                                    <option translate="" value="weekly">
                                                        <span>Weekly</span>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm6 col-md-3">
                                                <div class="text-left">
                                                    <a class="btn btn-md btn-light-grey" translate="" ng-click="submitNotif()">
                                                        <span>Update Notifications</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="sub-panel">
                                    <div class="col-xs-12">
                                        <h3 translate="">
                                            <span>Delete Account</span>
                                        </h3>
                                        <p translate="">
                                            <span>Deleting your account will remove all of your information from our database. This cannot be undone.</span>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="text-left col-xs-12">
                                        <a class="btn btn-md btn-light-grey" translate="" hd-confirm-word="DELETE" hd-confirm="Please type DELETE below to confirm this action" ng-click="deleteAccount()" href="candidate-settings.php?action=delete">
                                            <span>Delete account</span>
                                        </a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
            <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/bootstrap.min7035.js?ver=4.3.4'></script>
        </body>
    </html>
    <?php
    }
    else
    {
    ?>
    <META http-equiv="refresh" content="0;URL=index.php">
    <?php
    }
?>