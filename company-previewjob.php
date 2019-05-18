<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $jid=$_GET['jid'];
    
    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');                        
        
        $sqljobcheck = "SELECT * FROM jobs WHERE id=\"$jid\";";    
        $resjobcheck = mysql_query($sqljobcheck);                                                                
        if(mysql_num_rows($resjobcheck) == 1) 
        {
            while($row = mysql_fetch_array($resjobcheck)) 
            {
                $jbid = $row['bid'];
                $jcid = $row['cid'];
                $jisactive = $row['isactive'];
                $jjobtitle = $row['jobtitle'];
                $jjobabout = $row['jobabout'];
                $jbenefits = $row['benefits'];
                $jetype = $row['etype'];
                $jjobcategory = $row['jobcategory'];
                $jjrole = $row['jrole'];
                $jskillcert = $row['skillcert'];
                $jjlocation = $row['jlocation'];
                $jsalaryfrom = $row['salaryfrom'];
                $jsalaryto = $row['salaryto'];
                $jsalaryperiod = $row['salaryperiod'];
                $jjobsalaryhide = $row['jobsalaryhide'];
                $jjobeducation = $row['jobeducation'];
                $jacceptsforeigners = $row['acceptsforeigners'];
                $jlanguage = $row['language'];
                $jdate_updated = $row['date_updated'];                                        
            }
        }
        
        $sqlusercheck = "SELECT * FROM business WHERE id=\"$jbid\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $bname = $row['name'];            
                $bimage = $row['image'];            
                $bdescription = $row['description'];            
                $bindustry = $row['industry'];            
                $blocation = $row['location'];                            
            }
        }
        
        function time_elapsed_string($datetime, $full = false) {
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
        <title page-title="">Preview Job - myjobs.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles.min.css?v=23402" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body class="" style="">
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
                            <div id="navbar-collapse" class="navbar-collapse nav-primary collapse" aria-expanded="false" style="max-height: 860px; height: 0px;">
                                <?php include('company-topmenu.php'); ?>                                 
                                <div class="clearfix"></div>
                                <ul class="nav navbar-nav nav-secondary visible-xs">
                                    <li class="" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                        <a translate="" ui-sref="company" href="company-dashboard.php">
                                            <span>Account Overview</span>
                                        </a>
                                    </li>
                                    <li class="" ng-repeat="business in businesses" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                        <a ui-sref="business-jobs.live({businessId: business.id})" href="/client/business/5772929a7c92c77c04d45466/jobs/live"><?php echo $bname; ?></a>
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
                                        <li class="" ui-sref-active="active">
                                            <a translate="" ui-sref="company" href="company-dashboard.php">
                                                <span>Account Overview</span>
                                            </a>
                                        </li>
                                        <li class="" ng-repeat="business in businesses" ui-sref-active="active">
                                            <a ui-sref="business-jobs.live({businessId: business.id})" href="#"><?php echo $bname; ?></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="" ng-if="theCurrentBusiness" ui-sref-active="active">
                                    <a ui-sref="business-jobs.live({businessId: theCurrentBusiness.id})" href="#"><?php echo $bname; ?></a>
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
                <div class="job-page dashboard-v3">
                    <scoot-loading class="ng-hide" ng-show="loading">
                        <div id="loader" class="spinner-wrapper">
                            <div class="spinner">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                    </scoot-loading>
                    <div class="dashboard-top">
                        <div class="container">
                            <div class="dashboard-top-container no-bg">
                                <div class="col-xs-12 text-center">
                                    <span class="thumbnail thumb no-bottom-margin circle-new">
                                        <div class="job-item-img" style="background-image: url('profile/<?php echo $bimage; ?>');"></div>
                                    </span>
                                    <h3 class="heading"><?php echo $jjobtitle; ?></h3>
                                    <h5 class="subsubheading">
                                        <a ui-sref="business-jobs-public({businessId: vm.business.id})" href="#"><?php echo $bname; ?></a>
                                    </h5>
                                    <div class="gap-10"></div>
                                    <div class="job-top-actions">
                                        <a class="btn btn-md btn-red" href="company-job-applied.php?jid=<?php echo $jid; ?>&action=updatelive">
                                            <span>Post This Job</span>
                                        </a>
                                        <a class="btn btn-md btn-light-grey-2" href="company-editjob.php?bid=<?php echo $jbid; ?>&jid=<?php echo $jid; ?>">
                                            <span>Edit This Job</span>
                                        </a>
                                    </div>
                                    <div class="gap-10"> </div>
                                    <?php 
                                        if($jacceptsforeigners == 'Yes') 
                                        {
                                    ?>
                                    <p class="foreigners-block_v3" translate="" ng-if="vm.job.acceptsForeigners">
                                        <span>This job </span>
                                        <b>accepts foreigners</b>
                                    </p>
                                    <?php
                                        }
                                        if($jacceptsforeigners == 'No')
                                        {
                                    ?>
                                    <p class="foreigners-block_v3" translate="" ng-if="vm.job.acceptsForeigners">
                                        <span>This job </span>
                                        <b>accepts saudi nationals only</b>
                                    </p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scoot-block dashboard-content">
                        <div class="container">
                            <div class="block job-details-summary">
                                <div class="inner inner-pt-pb">
                                    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-5">
                                        <div class="container-xs-height table-details">
                                            <div class="row-xs-height">
                                                <div class="col col-xs-height">
                                                    <img src="http://image.flaticon.com/icons/svg/69/69466.svg">
                                                </div>
                                                <div class="col col-xs-height col-text">
                                                    <span><?php echo $jetype; ?></span>                                                    
                                                </div>
                                            </div>
                                            <div class="row-xs-height">
                                                <div class="col col-xs-height col-icon">
                                                    <img src="http://image.flaticon.com/icons/svg/149/149856.svg">
                                                </div>
                                                <div class="col col-xs-height col-text">
                                                    <span am-time-ago="vm.job.published"><?php echo time_elapsed_string($jdate_updated, true); ?></span>
                                                </div>
                                            </div>
                                            <div class="row-xs-height">
                                                <div class="col col-xs-height col-icon">
                                                    <img src="http://image.flaticon.com/icons/svg/61/61584.svg">
                                                </div>
                                                <div class="col col-xs-height col-text">
                                                    <span> <?php echo $jsalaryfrom; ?> - <?php echo $jsalaryto; ?> / <?php echo $jsalaryperiod; ?></span>
                                                </div>
                                            </div>
                                            <div class="row-xs-height">
                                                <div class="col col-xs-height col-icon">
                                                    <i class="i i-location"></i>
                                                </div>
                                                <div class="col col-xs-height col-text">
                                                    <span> <?php echo $jjlocation; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5 col-md-6 col-lg-7">
                                        
                                        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                                        <?php 
                                         $jjlocationxxx = str_replace(" ", "+",$jjlocation);
                                        ?>
                                        <iframe style="width:100%;height:200;" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $jjlocationxxx; ?>&output=embed"></iframe>                                        
                                        
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="dashboard-job-content">
                            <div class="container row-2">
                                <div class="container-sm-height">
                                    <div class="row-sm-height">
                                        <div class="block col col-sm-height">
                                            <h2 class="title"> Job Description </h2>
                                            <div class="description">
                                                <div class="job-description" ng-bind-html="::vm.job.description">
                                                    <?php echo $jjobabout; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block col col-sm-height hidden-xs" ng-if="vm.business.about">
                                            <h2 class="title"> About business </h2>
                                            <div class="description">
                                                <div ng-bind-html="::vm.business.about"><?php echo $bdescription; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-sm-height">
                                    <div class="row-sm-height">
                                        <div class="block col col-sm-height">
                                            <h3 class="title" translate="">
                                                <span>Minimum level of education required</span>
                                            </h3>
                                            <ul class="label-list_v3" ng-if="vm.job.typeOfEducation.name">
                                                <li>
                                                    <span class="item"><?php echo $jjobeducation; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="block col col-sm-height">
                                            <div class="job-details-main-block">
                                                <h3 class="title" translate="">
                                                    <span>Language(s)</span>
                                                </h3>
                                                <ul class="label-list_v3">
                                                <?php
                                                    $arrl=explode(",",$jlanguage);
                                                    echo '<li><span class="item">' . implode( '<li><span class="item">', $arrl) . '</span></li>';
                                                ?>                                                
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-sm-height">
                                    <div class="row-sm-height">
                                        <div class="block col col-sm-height">
                                            <h3 class="title" translate="">
                                                <span>Certificates / Skills</span>
                                            </h3>
                                            <ul class="label-list_v3">
                                                <?php
                                                    $arrb=explode(",",$jskillcert);
                                                    echo '<li><span class="item">' . implode( '<li><span class="item">', $arrb) . '</span></li>';
                                                ?>                                                
                                            </ul>
                                        </div>
                                        <div class="block col col-sm-height">
                                            <h3 class="title" translate="">
                                                <span>Job Benefits</span>
                                            </h3>
                                            <ul style="list-style: none;">
                                                <?php
                                                    $arr=explode(",",$jbenefits);
                                                    echo '<li><img src="http://image.flaticon.com/icons/svg/4/4629.svg" height="20"> ' . implode( '</li><li><img src="http://image.flaticon.com/icons/svg/4/4629.svg" height="20"> ', $arr) . '</li>';
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

<?php
    }
    else
    {
    ?>
    <META http-equiv="refresh" content="0;URL=index.php">
    <?php
    }
?>