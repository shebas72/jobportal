<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

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
        <title page-title="">Saved jobs - myjob.sa</title>
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
                                        <li ui-sref-active="active" ng-if="isCandidate()">
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
                                        <li ui-sref-active="active" ng-if="isCandidate()" class="active">
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
                                    <li ui-sref-active="active">
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
                                    <li ui-sref-active="active" class="active">
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
                <div class="user-jobs-page">
                    <div class="user-jobs scoot-block" ng-if="!vm.totalItems.count == 0">
                        <div class="container row-2">
                            <div class="col-xs-12 user-jobs-block">
                                <h3 class="heading">
                                    My saved jobs:
                                    <?php
                                        $sqluser = "SELECT * FROM saved WHERE uid=\"$uid\";";    
                                        $resuser = mysql_query($sqluser);
                                        $num_rows = mysql_num_rows($resuser);
                                    ?>
                                    <ng-pluralize><?php echo $num_rows; ?> job(s)</ng-pluralize>
                                </h3>
                                <div class="pull-right">
                                    <div class="paging-wrap" ng-class="{'deactivate': vm.pageIsLoading == true}">
                                        <div class="paging-cover"></div>
                                        <dir-pagination-controls template-url="mvc/views/directives/dirPagination.tpl.html" on-page-change="vm.pageChanged(newPageNumber)"></dir-pagination-controls>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <ul class="jobs-list">
                                    
                                    <?php
                                        $sqlusercheck = "SELECT * FROM saved WHERE uid=\"$uid\";";    
                                        $resusercheck = mysql_query($sqlusercheck);                                                                        
                                        while($row = mysql_fetch_array($resusercheck)) 
                                        {
                                            $jid = $row['jid'];
                                            
                                            $sqljj = "SELECT * FROM jobs WHERE id=\"$jid\";";
                                            $resjj = mysql_query($sqljj);                                                                                                                        
                                            while($rowj = mysql_fetch_array($resjj))
                                            {
                                                $bid = $rowj['bid'];
                                                $jobtitle = $rowj['jobtitle'];
                                                $jlocation = $rowj['jlocation'];
                                                $salaryfrom = $rowj['salaryfrom'];
                                                $salaryto = $rowj['salaryto'];
                                                $salaryperiod = $rowj['salaryperiod'];
                                                $date_updated = $rowj['date_updated'];
                                            }
                                            
                                            $sqlbb = "SELECT * FROM business WHERE id=\"$bid\";";    
                                            $resbb = mysql_query($sqlbb);                                                                                                                        
                                            while($rowc = mysql_fetch_array($resbb)) 
                                            {
                                                $bid = $rowc['id'];
                                                $bname = $rowc['name'];
                                                $bimage = $rowc['image'];
                                            }
                                    ?>
                                    
                                    <li class="jobs-list-item _old" current-page="vm.pagination.current" total-items="vm.totalItems.count" ng-repeat="item in vm.items.jobs | itemsPerPage: vm.itemsPerPage">
                                        <jobs-list-item user="vm.candidateInfo.candidate" item="vm.candidateInfo.applications[item.id]" job="item" ng-if="item.business && vm.candidateInfo.saved.indexOf(item.id) != -1">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="col-xs-12 col-sm-3 col-md-2 job-img hidden-xs">
                                                        <a ui-sref="job({jobId: job.id, slug: (job.title | slugify)})" href="candidate-viewjob.php?jid=<?php echo $jid; ?>">
                                                            <span class="thumbnail no-bottom-margin">
                                                                <?php if($bimage=='') {?>
                                                                <div class="job-item-img" style="background-image: url('images/logo-placeholder.jpg');"></div>
                                                                <?php } else {?>
                                                                <div class="job-item-img" style="background-image: url('profile/<?php echo $bimage; ?>');"></div>
                                                                <?php } ?>
                                                            </span>
                                                        </a>
                                                        <br>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 right-mobile"> </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
                                                        <h3 class="position">
                                                            <a class="job-title" target="_blank" ui-sref="job({jobId: job.id, slug: (job.title | slugify)})" href="candidate-viewjob.php?jid=<?php echo $jid; ?>"><?php echo $jobtitle; ?></a>                                                            
                                                        </h3>
                                                        <div class="job-details">
                                                            <div class="company">
                                                                <a class="company-name" ui-sref="business-jobs-public({businessId: job.business.id})" href="candidate-viewjob.php?jid=<?php echo $jid; ?>"><?php echo $bname; ?></a>
                                                            </div>
                                                            <div class="time">
                                                                <img src="http://image.flaticon.com/icons/svg/149/149313.svg" height="12" style="margin-top: -5px;">
                                                                <?php echo time_elapsed_string($date_updated, true); ?>
                                                            </div>
                                                            <div class="salary">
                                                                <img src="http://image.flaticon.com/icons/svg/61/61584.svg" height="12" style="margin-top: -5px;">
                                                                <?php echo $salaryfrom; ?> - <?php echo $salaryto; ?> / <?php echo $salaryperiod; ?>
                                                            </div>
                                                            <div class="address">
                                                                <span>
                                                                    <img src="http://image.flaticon.com/icons/svg/61/61469.svg" width="12" style="margin-top: -5px;"> 
                                                                    <?php echo $jlocation; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 job-actions" ng-if="!(user | isUndefined)">
                                                        <span ng-if="!job.isLoading && !(user | isUndefined)">
                                                            
                                                            <?php
                                                            $sqlck = "SELECT * FROM candidate WHERE email='$email' and password='$password'";
                                                            $resck=mysql_query($sqlck);
                                                            $count=mysql_num_rows($resck);
                                                            if($count==1)
                                                            {                    
                                                                while($row = mysql_fetch_array($resck)) 
                                                                {
                                                                    $uid = $row['id'];
                                                                }
                                                                
                                                                
                                                                $sqla = "SELECT * FROM saved WHERE jid='$jid' and uid='$uid';";
                                                                $resa=mysql_query($sqla);
                                                                $count=mysql_num_rows($resa);
                                                                if($count==0)
                                                                {
                                                                ?>
                                                                    <div class="col-save">
                                                                        <a class="save-this-job" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=save">
                                                                            <img src="http://image.flaticon.com/icons/svg/149/149763.svg" alt="" height="10">
                                                                            <span>Save this Job</span>
                                                                        </a>
                                                                    </div>                                                                    
                                                                <?php 
                                                                }
                                                                if($count==1)
                                                                {
                                                                ?>
                                                                    <div class="col-save">
                                                                        <a class="remove-from-saved" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=unsave">
                                                                            <img src="http://image.flaticon.com/icons/svg/149/149763.svg" alt="" height="10">
                                                                            <span>Remove from saved jobs</span>
                                                                        </a>
                                                                    </div>                                                                    
                                                                <?php 
                                                                }                                                                
                                                                
                                                                $sqla = "SELECT * FROM applied WHERE jid='$jid' and uid='$uid';";
                                                                $resa=mysql_query($sqla);
                                                                $count=mysql_num_rows($resa);
                                                                if($count==0)
                                                                {
                                                                ?>
                                                                    <div class="col-apply">
                                                                        <a class="apply-now job-action-btn" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=apply">
                                                                            <span>Apply Now</span>
                                                                        </a>
                                                                    </div>                                                                    
                                                                <?php 
                                                                }
                                                                if($count==1)
                                                                {
                                                                ?>
                                                                    <div class="col-apply">
                                                                        <a class="withdrdaw-application job-action-btn" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=unapply">
                                                                            <span>Withdraw application</span>
                                                                        </a>
                                                                    </div>
                                                                <?php 
                                                                }
                                                            } ?>
                                                            
                                                            <div class="clearfix"></div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </jobs-list-item>
                                    </li>
                                    
                                    <?php
                                        }
                                    ?>                                    
                                    
                                </ul>
                                <div class="clearfix"></div>                                
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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