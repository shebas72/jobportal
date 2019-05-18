<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $deletebid = $_GET['deletebid'];

    if($deletebid!='')
    {
        $sqldelbus = "DELETE FROM business WHERE id=\"$bid\";";    
        $resdelbus = mysql_query($sqldelbus);
        $sqldelbusjb = "DELETE FROM jobs WHERE bid=\"$bid\";";    
        $resdelbusjb = mysql_query($sqldelbusjb);
    }

    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');

        $sqlusercheck = "SELECT * FROM company WHERE email=\"$email\" AND password=\"$password\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $cid = $row['id'];            
                $iname = $row['name'];            
                $iimage = $row['image'];            
                $idescription = $row['description'];            
                $iindustry = $row['industry'];            
                $ilocation = $row['location'];            
                $icname = $row['cname'];            
                $icnumber = $row['cnumber'];            
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
            <title page-title="">Account Overview - myjobs.sa</title>
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
                                <div id="navbar-collapse" class="collapse navbar-collapse nav-primary" aria-expanded="false" style="max-height: 860px;">
                                    <?php include('company-topmenu.php'); ?>                                     
                                    <div class="clearfix"></div>
                                    <ul class="nav navbar-nav nav-secondary visible-xs">
                                        <li class="active" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                            <a translate="" ui-sref="company" href="#">
                                                <span>Account Overview</span>
                                            </a>
                                        </li>
                                        <?php
                                            $sqlbb = "SELECT * FROM business WHERE cid=\"$cid\";";    
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
                                                <a translate="" ui-sref="company" href="#">
                                                    <span>Account Overview</span>
                                                </a>
                                            </li>
                                            <?php
                                                $sqlbb = "SELECT * FROM business WHERE cid=\"$cid\";";    
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
                                    <li class="active" ng-if="!theCurrentBusiness" ui-sref-active="active">
                                        <a translate="" ui-sref="company" href="#">
                                            <span>Account Overview</span>
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
                    <div class="company-page dashboard-v3">
                        <div class="dashboard-top">
                            <div class="container">
                                <div class="dashboard-top-container">
                                    <div class="dashboard-top-content">
                                        <div class="col-xs-12 col-md-7 row-2">
                                            <div class="gap-20 visible-xs"></div>
                                            <div class="col-xs-12 col-sm-6 col-md-12">
                                                <h2 class="heading bold uppercase" translate="">
                                                    <span>What would you like to do today?</span>
                                                </h2>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-12 what-would-you-like">
                                                <a class="btn btn-md btn-red" translate="" ui-sref="business-add" href="company-business-add.php">
                                                    <span>Add new business</span>
                                                </a>
                                                <div class="btn-group red-dropdown-toggle-wrapper dropdown ">
                                                    <button id="post-a-job-btn" class="red-dropdown-toggle-btn btn btn-red btn-md dropdown-toggle" uib-dropdown-toggle="" type="button" aria-haspopup="true" aria-expanded="false">
                                                        Post a job
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu red-dropdown-toggle-dropdown" aria-labelledby="post-a-job-btn">
                                                        <?php
                                                            $sqlusercheck = "SELECT * FROM business WHERE cid=\"$cid\";";    
                                                            $resusercheck = mysql_query($sqlusercheck);                                                                                                                        
                                                            while($row = mysql_fetch_array($resusercheck)) 
                                                            {
                                                                $bid = $row['id'];
                                                                $bname = $row['name'];
                                                            ?>
                                                            <li ng-repeat="business in vm.businesses">
                                                                <a class="a-clickable" ui-sref="business-job-add({businessId: business.id})" href="company-postajob.php?bid=<?php echo $bid; ?>"><?php echo $bname; ?></a>
                                                            </li>
                                                            <?php
                                                            }                                                            
                                                        ?>                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="gap-20 visible-xs"></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-5 hidden-xs">
                                            <div>
                                                <div class="account-overview-list container-xs-height" ng-click="vm.scrollToBusiness()">
                                                    <div class="row-xs-height">
                                                        <div class="list-heading col-xs-height">Account Overview:</div>
                                                        <div class="col-xs-height"></div>
                                                    </div>
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height" translate="">
                                                            <span>Businesses</span>
                                                        </div>
                                                        <?php
                                                            $sqlx = "SELECT * FROM business WHERE cid=\"$cid\";";
                                                            $resx = mysql_query($sqlx);
                                                            $countx = mysql_num_rows($resx);
                                                            if($countx=='') { $countx==0; }
                                                        ?>
                                                        <div class="col-xs-height red"><?php echo $countx; ?></div>
                                                    </div>
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height" translate="">
                                                            <span>Job ads</span>
                                                        </div>
                                                        <?php
                                                            $sqlx = "SELECT * FROM jobs WHERE cid=\"$cid\";";
                                                            $resx = mysql_query($sqlx);
                                                            $countx = mysql_num_rows($resx);
                                                            if($countx=='') { $countx==0; }
                                                        ?>
                                                        <div class="col-xs-height red"><?php echo $countx; ?></div>
                                                    </div>
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height" translate="">
                                                            <span>Shortlisted Candidates</span>
                                                        </div>
                                                        <?php                                                            
                                                            $sqlx = "SELECT * FROM applicants WHERE status=\"Shortlisted\" AND cid=\"$cid\";";
                                                            $resx = mysql_query($sqlx);
                                                            $countx = mysql_num_rows($resx);                                                                
                                                            if($countx==''){$countx==0;}                                                            
                                                        ?>
                                                        <div class="col-xs-height red"><?php echo $countx; ?></div>
                                                    </div>
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height" translate="">
                                                            <span>Applied Candidates</span>
                                                        </div>
                                                        <?php                                                            
                                                            $sqlx = "SELECT * FROM applicants WHERE status=\"Applied\" AND cid=\"$cid\";";
                                                            $resx = mysql_query($sqlx);
                                                            $countx = mysql_num_rows($resx);                                                                
                                                            if($countx==''){$countx==0;}                                                            
                                                        ?>
                                                        <div class="col-xs-height red"><?php echo $countx; ?></div>
                                                    </div>
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height" translate="">
                                                            <span>Matched Candidates</span>
                                                        </div>
                                                        <?php
                                                            $sqlx = "SELECT * FROM business WHERE cid=\"$cid\";";
                                                            $resx = mysql_query($sqlx);
                                                            $countx = mysql_num_rows($resx);
                                                            if($countx=='') { $countx==0; }
                                                        ?>
                                                        <div class="col-xs-height red"><?php echo 0; ?></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="scoot-block dashboard-content">
                            <div id="business-list" class="latest-jobs ">
                                <div class="container">
                                    <div class="block">
                                        <div class="inner">
                                            <h2 class="title">
                                                <img src="http://image.flaticon.com/icons/svg/66/66585.svg" alt="" height="30"> Your Business
                                            </h2>
                                            <div class="businesses-list">

                                                <?php
                                                    $sqlusercheck = "SELECT * FROM business WHERE cid=\"$cid\";";    
                                                    $resusercheck = mysql_query($sqlusercheck);                                                                                                                    
                                                    while($row = mysql_fetch_array($resusercheck)) 
                                                    {
                                                        $bid = $row['id'];
                                                        $bname = $row['name'];
                                                        $bimage = $row['image'];
                                                        $blocation = $row['location'];
                                                    ?>

                                                    <div class="col-xs-12 col-sm-6 business-item" ng-repeat="business in vm.businesses">
                                                        <div class="col-xs-12 col-sm-4 col-lg-3 text-right text-center-xs">
                                                            <a ui-sref="business-jobs.live({businessId: business.id})" href="company-livejobs.php?bid=<?php echo $bid; ?>">
                                                                <span class="thumbnail thumb no-bottom-margin circle-new">
                                                                    <div class="job-item-img" style="background-image: url('profile/<?php echo $bimage; ?>');"></div>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-8 col-lg-9">
                                                            <h1 class="business-name">
                                                                <a ui-sref="business-jobs.live({businessId: business.id})" href="company-livejobs.php?bid=<?php echo $bid; ?>"><?php echo $bname; ?></a>
                                                            </h1>
                                                            <p class="business-location" ng-if="business.address">
                                                                <img src="http://image.flaticon.com/icons/svg/112/112524.svg" alt="" height="20">                                                        
                                                                <?php echo $blocation; ?>
                                                            </p>
                                                            <div>
                                                                <a class="btn btn-md btn-grey" translate="" ui-sref="business-jobs.live({businessId: business.id})" href="company-livejobs.php?bid=<?php echo $bid; ?>">
                                                                    <span>View Jobs</span>
                                                                </a>
                                                                <a class="btn btn-md btn-grey" translate="" ui-sref="business-edit({businessId: business.id})" href="company-business-edit.php?bid=<?php echo $bid; ?>">
                                                                    <span>Edit Business</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <?php

                                                    }
                                                ?>                                                            

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="">
                                    <div class="interviews user-interviews block block-left col-xs-12 col-sm-6" style="display:none;">
                                        <div class="inner">
                                            <h2 class="title">
                                                <img src="http://image.flaticon.com/icons/svg/159/159777.svg" alt="" height="20">
                                                Interviews
                                            </h2>
                                            <div ng-if="!vm.interviews[0]">
                                                <h5 class="subtitle" translate="">
                                                    <span>Your interview schedule will be appearing here</span>
                                                </h5>

                                                <table align="center">
                                                    <?php
                                                        $sqlm = "SELECT * FROM messages WHERE cid=$cid AND status=2 ORDER BY date_sent DESC LIMIT 3;";
                                                        $resm = mysql_query($sqlm);
                                                        if(mysql_num_rows($resm) != 0) 
                                                        {                                                                                                                    
                                                            while($rowm = mysql_fetch_array($resm))
                                                            {
                                                                $uid = $rowm['uid'];
                                                                $mid = $rowm['id'];
                                                                $jid = $rowm['jid'];
                                                                $mdate = $rowm['date_sent'];                                

                                                                $sqlj = "SELECT * FROM jobs WHERE id=$jid;";
                                                                $resj = mysql_query($sqlj);                                                                                                                    
                                                                while($rowj = mysql_fetch_array($resj)) 
                                                                {
                                                                    $bid = $rowj['bid'];
                                                                    $jobtitle = $rowj['jobtitle'];

                                                                    $sqlb = "SELECT * FROM business WHERE id=$bid;";
                                                                    $resb = mysql_query($sqlb);
                                                                    while($rowb = mysql_fetch_array($resb))
                                                                    {
                                                                        $name = $rowb['name'];
                                                                        $image = $rowb['image'];
                                                                    }
                                                                }

                                                                $sqlu = "SELECT * FROM candidate WHERE id=$uid;";
                                                                $resu = mysql_query($sqlu);                                                                                                                    
                                                                while($rowu = mysql_fetch_array($resu)) 
                                                                {
                                                                    $fname = $rowu['fname'];            
                                                                    $lname = $rowu['lname'];
                                                                    $mobile = $rowu['mobile'];
                                                                    $uphoto = $rowu['photo'];
                                                                }                                                        
                                                            ?>

                                                            <tr style="border-bottom: 1px dotted #cccccc; padding: 10px; !important">
                                                                <td align="right">                                            
                                                                    <br />
                                                                    <img src="profile/<?php echo $uphoto; ?>" width="80" />&nbsp;
                                                                    <br /><br />
                                                                </td>
                                                                <td align="left">
                                                                    <a href="company-view-messages.php?mid=<?php echo $mid; ?>"><?php echo $jobtitle; ?>
                                                                        <br />
                                                                        <b><?php echo $name; ?></b></a>
                                                                    <br />
                                                                    <?php echo time_elapsed_string($mdate, true); ?>
                                                                </td>                                                            
                                                            </tr>

                                                            <?php 
                                                            }
                                                        }
                                                        else
                                                        {                                                                                                    
                                                        ?>
                                                        <div class="scoot-no-content _v2">
                                                            <h2 translate="">
                                                                <span>No interviews appearing?</span>
                                                            </h2>
                                                            <p translate="">
                                                                <span>Invite some candidates to interviews</span>
                                                            </p>
                                                        </div>
                                                        <?php
                                                        }
                                                    ?>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="messages block block-right col-xs-12 col-sm-12">
                                        <div class="inner">
                                            <h2 class="title">
                                                <img src="http://image.flaticon.com/icons/svg/118/118712.svg" alt="" height="20">
                                                Messages
                                            </h2>
                                            <div class="clearfix"></div>
                                            <div ng-if="!vm.company.messages[0]">
                                                <h5 class="subtitle text-center" translate="">
                                                    <span>Your recent messages will be appearing here</span>
                                                </h5>

                                                <table align="center">
                                                    <?php
                                                        $sqlm = "SELECT * FROM messages WHERE cid=$cid ORDER BY date_sent DESC LIMIT 3;";
                                                        $resm = mysql_query($sqlm);
                                                        if(mysql_num_rows($resm) != 0) 
                                                        {                                                                                                                    
                                                            while($rowm = mysql_fetch_array($resm))
                                                            {
                                                                $uid = $rowm['uid'];
                                                                $mid = $rowm['id'];
                                                                $jid = $rowm['jid'];
                                                                $mdate = $rowm['date_sent'];                                

                                                                $sqlj = "SELECT * FROM jobs WHERE id=$jid;";
                                                                $resj = mysql_query($sqlj);                                                                                                                    
                                                                while($rowj = mysql_fetch_array($resj)) 
                                                                {
                                                                    $bid = $rowj['bid'];
                                                                    $jobtitle = $rowj['jobtitle'];

                                                                    $sqlb = "SELECT * FROM business WHERE id=$bid;";
                                                                    $resb = mysql_query($sqlb);
                                                                    while($rowb = mysql_fetch_array($resb))
                                                                    {
                                                                        $name = $rowb['name'];
                                                                        $image = $rowb['image'];
                                                                    }
                                                                }

                                                                $sqlu = "SELECT * FROM candidate WHERE id=$uid;";
                                                                $resu = mysql_query($sqlu);                                                                                                                    
                                                                while($rowu = mysql_fetch_array($resu)) 
                                                                {
                                                                    $fname = $rowu['fname'];            
                                                                    $lname = $rowu['lname'];
                                                                    $mobile = $rowu['mobile'];
                                                                    $uphoto = $rowu['photo'];
                                                                }                                                        
                                                            ?>

                                                            <tr style="border-bottom: 1px dotted #cccccc; padding: 10px; !important">
                                                                <td align="right">                                            
                                                                    <br />
                                                                    <img src="profile/<?php echo $uphoto; ?>" width="80" />&nbsp;
                                                                    <br /><br />
                                                                </td>
                                                                <td align="left">
                                                                    <a href="company-view-messages.php?mid=<?php echo $mid; ?>"><?php echo $jobtitle; ?>
                                                                        <br />
                                                                        <b><?php echo $name; ?></b></a>
                                                                    <br />
                                                                    <?php echo time_elapsed_string($mdate, true); ?>
                                                                </td>                                                            
                                                            </tr>

                                                            <?php 
                                                            }
                                                        }
                                                        else
                                                        {                                                                                                    
                                                        ?>
                                                        <div class="scoot-no-content _v2">
                                                            <div class="text-center">
                                                                <h2 translate="">
                                                                    <span>No messages</span>
                                                                </h2>
                                                                <p translate="">
                                                                    <span>Recent messages will appear here</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                    ?>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script>
                $(document).ready(function()
                {
                    $('#post-a-job-btn').click(function(event) {                        
                      $(".red-dropdown-toggle-wrapper").toggleClass("open");
                    });
                    $('#post-a-job-btn').blur(function(event) {                        
                      $(".red-dropdown-toggle-wrapper").removeClass("open");
                    });                    
                });
            </script>
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