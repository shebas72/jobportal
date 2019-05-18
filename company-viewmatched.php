<?php
    session_start();
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    $uid=$_GET['uid'];
?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles/styles.min.css?v=9022" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body>
        
        <?php
            if(($_SESSION['email'])&&($_SESSION['password']))
            {
                include('inc.php');                 
            ?>
            
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
                                        <img ng-src="images/logo.png" src="images/logo.png">
                                    </a>
                                </div>
                                <div id="navbar-collapse" class="collapse navbar-collapse nav-primary" aria-expanded="false" style="max-height: 860px;">
                                    <?php include('company-topmenu.php'); ?>                                     
                                    <div class="clearfix"></div>
                                    <ul class="nav navbar-nav nav-secondary visible-xs">
                                        <li class="active" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                            <a translate="" ui-sref="company" href="company-dashboard.php">
                                                <span>Account Overview</span>
                                            </a>
                                        </li>                                            
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="nav-secondary-wrapper hidden-xs">
                            <div class="container" ng-if="isCompany() && !isCompanyRegistration()">
                                <ul class="nav navbar-nav nav-secondary">
                                    <li class="dropdown">
                                        <a id="dLabel" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" data-target="#">
                                            Dashboard
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <li class="active" ui-sref-active="active">
                                                <a translate="" ui-sref="company" href="company-dashboard.php">
                                                    <span>Account Overview</span>
                                                </a>
                                            </li>                                                
                                        </ul>
                                    </li>
                                    <li class="active" ng-if="!theCurrentBusiness" ui-sref-active="active">
                                        <a translate="" ui-sref="company" href="company-dashboard.php">
                                            <span>Account Overview</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            
            <?php
            }
            
            $sqlck = "SELECT * FROM candidate WHERE id='$uid'";
            $resck=mysql_query($sqlck);                
            while($row = mysql_fetch_array($resck)) 
            {                
                $fname = $row['fname'];            
                $lname = $row['lname'];
                $mobile = $row['mobile'];
                $photo = $row['photo'];
                $jobrole = $row['jobrole'];
                $dob = $row['dob'];
                $salmin = $row['salmin'];
                $salmax = $row['salmax'];
                $salperiod = $row['salperiod'];
                $about = $row['about'];
                $location = $row['location'];
                $nationality = $row['nationality'];
                $nationality = $row['nationality'];
                $skills = $row['skills'];
                $languages = $row['languages'];
            }                                        
        ?>
        
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
                <div class="job-candidate-page dashboard-v3">
                    <div class="dashboard-top">
                        <div class="container">
                            <div class="dashboard-top-container">
                                <div class="dashboard-top-content">
                                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                                        <div class="user-image" style="background-image: url('profile/<?php echo $photo; ?>');">
                                            <?php if($photo=='') { ?>
                                            <initials candidate-surname="thowzif" candidate-name="Abdul" font="115" size="250" rounded="rounded" ng-if="!vm.candidate.profileImg">
                                                <div class="scoot-initials rounded" style="width: 250px; height: 250px; line-height: 250px; font-size: 115px;">
                                                    <span><?php echo substr($fname, 0, 1); ?><?php echo substr($lname, 0, 1); ?></span>
                                                </div>
                                            </initials>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 row-2">
                                        <div class="user-main-details">
                                            <h1 class="user-name"><?php echo $fname.' '.$lname; ?></h1>
                                            <div class="user-profession-contacts">
                                                <h2 class="user-profession">
                                                    <span><?php echo $jobrole; ?></span>
                                                    
                                                </h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <hr>
                                            <div class="user-other">
                                                <ul>
                                                    <li class="" ng-if="vm.candidate.dateOfBirth">
                                                        <b class="uppercase">
                                                            <i class="i i-age"></i>
                                                            AGE:
                                                        </b>
                                                        <?php
                                                            $newstring = substr($dob, -4);
                                                            $newstring2 = date("Y");
                                                            $newstring3 = $newstring2-$newstring;
                                                            echo $newstring3;
                                                        ?>                                                        
                                                    </li>
                                                    <li class="" ng-if="vm.candidate.salaryFrom && vm.candidate.salaryTo">
                                                        <i class="i i-rm"></i>
                                                        <b class="uppercase">EXPECTED SALARY</b>
                                                        : <?php echo $salmin; ?> - <?php echo $salmax; ?> / <?php echo $salperiod; ?>
                                                    </li>
                                                    <li ng-if="!(vm.candidate.nationality | isUndefined)">
                                                        <b class="uppercase" translate="">
                                                            <span>Nationality:</span>
                                                        </b>
                                                        <?php echo $nationality; ?>
                                                    </li>
                                                    <li class="" ng-if="vm.candidate.address">
                                                        <b class="uppercase">
                                                            <i class="i i-location"></i>
                                                        </b>
                                                        <?php echo $location; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="hidden-sm">
                                            <p class="user-about" ng-bind-html="::vm.candidate.about"> <?php echo $about; ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="visible-sm">
                                        <p class="user-about" ng-bind-html="::vm.candidate.about"> <?php echo $about; ?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scoot-block dashboard-content dashboard-profile-content">
                        <div class="container row-2">
                            <div class="container">
                                <div class="row row-md-height row-lg-height">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="block">
                                            <h3 class="title">Education</h3>
                                            <ol class="timeline-bullets" ng-if="vm.candidate.education">
                                                <?php
                                                    $sqlusercheck1 = "SELECT * FROM ca_education WHERE uid=\"$uid\";";    
                                                    $resusercheck1 = mysql_query($sqlusercheck1);                                                                                                                    
                                                    while($row = mysql_fetch_array($resusercheck1)) 
                                                    {
                                                        $start = $row['start'];
                                                        $end = $row['end'];
                                                        $institution = $row['institution'];
                                                        $course = $row['course'];
                                                ?>
                                                <li ng-repeat="item in ::vm.candidate.education | orderBy:'-end'">
                                                    <div class="date">
                                                        <p class="when" ng-if="!item.presentTime"><?php echo $start; ?> - <?php echo $end; ?></p>
                                                    </div>
                                                    <p class="where"><?php echo $course; ?>, <?php echo $institution; ?></p>
                                                </li>
                                                <?php
                                                    }
                                                ?>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="block">
                                            <h3 class="title">Experience</h3>
                                            <ol class="timeline-bullets" ng-if="!vm.candidate.noWorkingExperience && vm.candidate.experience">
                                                <?php
                                                    $sqlusercheck2 = "SELECT * FROM ca_experience WHERE uid=\"$uid\";";    
                                                    $resusercheck2 = mysql_query($sqlusercheck2);                                                                                                                    
                                                    while($row = mysql_fetch_array($resusercheck2)) 
                                                    {
                                                        $start = $row['start'];
                                                        $end = $row['end'];
                                                        $company = $row['company'];
                                                        $position = $row['position'];
                                                ?>
                                                <li ng-repeat="item in ::vm.candidate.experience | orderBy:'-end'">
                                                    <div class="date">
                                                        <p class="when" ng-if="!item.presentTime"><?php echo $start; ?> - <?php echo $end; ?></p>
                                                    </div>
                                                    <p class="where"><?php echo $position; ?>, <?php echo $company; ?></p>
                                                </li>
                                                <?php
                                                    }
                                                ?>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row row-md-height row-lg-height">
                                    <div class="col-xs-12 col-md-6 col-md-12">
                                        <div class="block">
                                            <h3 class="title" translate="">
                                                <span>Skills</span>
                                            </h3>
                                            <ul class="label-list_v2">
                                                <?php
                                                    $arrb=explode(",",$skills);
                                                    echo '<li><span class="item">' . implode( '<li><span class="item">', $arrb) . '</span></li>';
                                                ?>                                                                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row row-md-height row-lg-height">
                                    <div class="col-xs-12 block-x2">
                                        <div class="block">
                                            <h3 class="title" translate="">
                                                <span>Languages</span>
                                            </h3>
                                            <ul class="label-list_v2" ng-if="!(vm.candidate.languages | isEmpty)">
                                                <?php
                                                    $arra=explode(",",$languages);
                                                    echo '<li><span class="item">' . implode( '<li><span class="item">', $arra) . '</span></li>';
                                                ?>                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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