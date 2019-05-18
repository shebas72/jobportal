<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $bid=$_GET['bid'];            
    
    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');                                        
        
        $sqlusercheck = "SELECT * FROM business WHERE id=\"$bid\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $bcid = $row['cid'];            
                $bname = $row['name'];            
                $bimage = $row['image'];            
                $bdescription = $row['description'];            
                $bindustry = $row['industry'];            
                $blocation = $row['location'];                            
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
        <title page-title="">Business Overview - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles/styles.min.css?v=9022" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body class="">
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
                                <?php include('company-topmenu.php'); ?>
                                <div class="clearfix"></div>
                                <ul class="nav navbar-nav nav-secondary visible-xs">
                                    <li class="" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                        <a translate="" ui-sref="company" href="/client/company">
                                            <span>Account Overview</span>
                                        </a>
                                    </li>
                                    <?php
                                        $sqlbb = "SELECT * FROM business WHERE cid=\"$bcid\";";    
                                        $resbb = mysql_query($sqlbb);                                                                                                        
                                        while($row = mysql_fetch_array($resbb)) 
                                        {
                                            $nhbid = $row['id'];            
                                            $nhbname = $row['name'];                                                                                                                                                                    
                                    ?>
                                    <li ng-repeat="business in businesses" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                        <a ui-sref="business-jobs.live({businessId: business.id})" href="company-livejobs.php?bid=<?php echo $nhbid; ?>"><?php echo $nhbname; ?></a>
                                    </li>                                    
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="nav-secondary-wrapper hidden-xs" ng-if="!isHomePageCandidate()">
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
                                        <?php
                                        $sqlbb = "SELECT * FROM business WHERE cid=\"$bcid\";";    
                                        $resbb = mysql_query($sqlbb);                                                                                                        
                                        while($row = mysql_fetch_array($resbb)) 
                                        {
                                            $nhbid = $row['id'];            
                                            $nhbname = $row['name'];                                                                                                                                                                    
                                    ?>
                                    <li ng-repeat="business in businesses" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                        <a ui-sref="business-jobs.live({businessId: business.id})" href="company-livejobs.php?bid=<?php echo $nhbid; ?>"><?php echo $nhbname; ?></a>
                                    </li>                                    
                                    <?php } ?>
                                    </ul>
                                </li>
                                <li class="active" ng-if="theCurrentBusiness" ui-sref-active="active">
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
                    <div class="dashboard-top">
                        <div class="container">
                            <div class="dashboard-top-container no-bg">
                                <div class="col-xs-12 text-center">
                                    <span class="thumbnail thumb no-bottom-margin circle-new">
                                        <div class="job-item-img" style="background-image: url('profile/<?php echo $bimage; ?>');"></div>
                                    </span>
                                    <h3 class="heading"><?php echo $bname; ?></h3>
                                    <div class="text-center">
                                        <a class="btn btn-md btn-red" translate="" ui-sref="business-job-add({businessId: business.id})" href="company-postajob.php?bid=<?php echo $bid; ?>">
                                            <span>Post a new job</span>
                                        </a>
                                        <a class="btn btn-md btn-transparent-white" translate="" ui-sref="business-edit({businessId: business.id})" href="company-business-edit.php?bid=<?php echo $bid; ?>">
                                            <span>Edit Business</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="business-jobs-filter">
                        <div class="container">
                            <div class="container-sm-height">
                                <div class="row-sm-height">
                                    <a class="col-xs-12 col-sm-3 col-sm-height btn btn-transparent" ui-sref="business-jobs.live" ui-sref-active="active" href="company-livejobs.php?bid=<?php echo $bid; ?>">
                                        Live Jobs
                                        <?php
                                            $counter1 = mysql_query("SELECT COUNT(*) AS id1 FROM jobs WHERE bid=\"$bid\" AND isactive=1");                                            
                                            $num1 = mysql_fetch_array($counter1);                                            
                                            $count1 = $num1["id1"];
                                            echo '<span class="badge">'.$count1.'</span>';
                                        ?>                                        
                                    </a>
                                    <a class="col-xs-12 col-sm-3 col-sm-height btn btn-transparent active" ui-sref="business-jobs.closed" ui-sref-active="active" href="company-closedjobs.php?bid=<?php echo $bid; ?>">
                                        Closed Jobs
                                        <?php
                                            $counter1 = mysql_query("SELECT COUNT(*) AS id1 FROM jobs WHERE bid=\"$bid\" AND isactive=3");                                            
                                            $num1 = mysql_fetch_array($counter1);                                            
                                            $count1 = $num1["id1"];
                                            echo '<span class="badge">'.$count1.'</span>';
                                        ?>
                                    </a>
                                    <a class="col-xs-12 col-sm-3 col-sm-height btn btn-transparent" ui-sref="business-jobs.drafts" ui-sref-active="active" href="company-drafts.php?bid=<?php echo $bid; ?>">
                                        Drafts
                                        <?php
                                            $counter1 = mysql_query("SELECT COUNT(*) AS id1 FROM jobs WHERE bid=\"$bid\" AND isactive=0");                                            
                                            $num1 = mysql_fetch_array($counter1);                                            
                                            $count1 = $num1["id1"];
                                            echo '<span class="badge">'.$count1.'</span>';
                                        ?>
                                    </a>
                                    <a class="col-xs-12 col-sm-3 col-sm-height btn btn-transparent" ui-sref="business-jobs.pending" ui-sref-active="active" href="company-pendingjobs.php?bid=<?php echo $bid; ?>">
                                        Pending Jobs
                                        <?php
                                            $counter1 = mysql_query("SELECT COUNT(*) AS id1 FROM jobs WHERE bid=\"$bid\" AND isactive=4");                                            
                                            $num1 = mysql_fetch_array($counter1);                                            
                                            $count1 = $num1["id1"];
                                            echo '<span class="badge">'.$count1.'</span>';
                                        ?>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="scoot-block dashboard-content">
                        <div class="container">
                            <div ui-view="">
                                <ul class="list-style-none">
                                    
                                    <?php
                                        $sqljobcheck = "SELECT * FROM jobs WHERE bid=\"$bid\" AND isactive=3;";    
                                        $resjobcheck = mysql_query($sqljobcheck);                                                                                                        
                                        while($row = mysql_fetch_array($resjobcheck)) 
                                        {
                                            $jid = $row['id'];
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
                                                                                
                                    ?>
                                    
                                    <li class="jobs-list-item" current-page="pagination.current" total-items="totalItems.count" ng-repeat="item in items.jobs | itemsPerPage: itemsPerPage">
                                        <jobs-list-item-business job="item">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="container-sm-height">
                                                        <div class="row-sm-height">
                                                            <div class="col-xs-12 col-sm-5 col-md-4 main-details col-sm-height" ui-sref="job-applications.live({businessId: job.business.id,jobId: job.id})" href="#">
                                                                <h3 class="position"><?php echo $jjobtitle; ?></h3>
                                                                <h4 class="business-name"><?php echo $bname; ?></h4>
                                                                <div class="meta">
                                                                    <p>
                                                                        <img src="http://image.flaticon.com/icons/svg/149/149856.svg" height="16">
                                                                        Posted
                                                                        <span am-time-ago="job.published"><?php echo time_elapsed_string($jdate_updated, true); ?></span>
                                                                    </p>
                                                                    <p>
                                                                        <img src="http://image.flaticon.com/icons/svg/62/62516.svg" height="16">
                                                                        <?php echo $jjlocation; ?>
                                                                    </p>
                                                                    <p>
                                                                        <img src="http://image.flaticon.com/icons/svg/126/126440.svg" height="16">
                                                                        <?php echo $jetype; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-7 col-md-8 col-sm-height description-actions">
                                                                <div class="description">
                                                                    <p>Description: <?php echo $jjobabout; ?></p>
                                                                </div>
                                                                <a class="btn btn-md btn-red" translate="" ui-sref="job-applications.live({businessId: job.business.id,jobId: job.id})" ng-if="job.status == 'live'" href="company-job-applied.php?bid=<?php echo $jbid; ?>&jid=<?php echo $jid; ?>">
                                                                    <span>View Applicants</span>
                                                                </a>                                                                
                                                                <a class="btn btn-md btn-light-grey" translate="" ng-if="currentCompanyId" ui-sref="business-job-edit({businessId: job.business.id, jobId: job.id})" href="company-editjob.php?bid=<?php echo $jbid; ?>&jid=<?php echo $jid; ?>">
                                                                    <span>Edit the job</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </jobs-list-item-business>
                                    </li>
                                    
                                    <?php
                                        }
                                    ?>
                                    
                                </ul>
                                <div class="scoot-pagination">
                                    <div class="paging-wrap" ng-class="{'deactivate': pageIsLoading == true}">
                                        <div class="paging-cover"></div>
                                        <dir-pagination-controls template-url="mvc/views/directives/dirPaginationScoot.tpl.html" on-page-change="pageChanged(newPageNumber)"></dir-pagination-controls>
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