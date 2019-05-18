<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $jid=$_GET['jid'];
    $action=$_GET['action'];


    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');                        

        if($action=='updatelive')
        {                
            $sql="UPDATE jobs SET isactive=\"1\" WHERE id=$jid;";
            $res=mysql_query($sql);
        }
        if($action=='updateclose')
        {                
            $sql="UPDATE jobs SET isactive=\"2\" WHERE id=$jid;";
            $res=mysql_query($sql);
        }        

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

    ?>

    <!DOCTYPE html>
    <html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
        <head>
            <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
            <title page-title="">Manage Job - myjob.sa</title>
            <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
            <meta content="" name="description">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta content="#e5202d" name="theme-color">
            <meta content="!" name="fragment">
            <link href="styles/styles.min.css?v=9022" rel="stylesheet">

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
                                    <?php include('company-topmenu.php'); ?>                                 <div class="clearfix"></div>
                                    <ul class="nav navbar-nav nav-secondary visible-xs">
                                        <li class="" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                            <a translate="" ui-sref="company" href="company-dashboard.php">
                                                <span>Account Overview</span>
                                            </a>
                                        </li>
                                        <?php
                                            $sqlbb = "SELECT * FROM business WHERE cid=\"$jcid\";";    
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
                                                $sqlbb = "SELECT * FROM business WHERE cid=\"$jcid\";";    
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
                    <div class="job-applications dashboard-v3">
                        <div class="dashboard-top">
                            <div class="container">
                                <div class="dashboard-top-container no-bg">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <h1 class="heading"><?php echo $jjobtitle; ?></h1>
                                                <p class="text-solid-black" translate="">
                                                    <strong><?php echo $jjlocation; ?></strong>
                                                </p>
                                                <p class="application-status" translate="">
                                                    <span>Job status: </span>
                                                    <?php
                                                        if($jisactive=='1')
                                                        {
                                                            echo '<span class="status live" ng-class="::vm.job.status">live</span>';
                                                        }
                                                        if($jisactive=='2')
                                                        {
                                                            echo '<span class="status closed" ng-class="::vm.job.status">Closed</span>';
                                                        }
                                                        if($jisactive=='0')
                                                        {
                                                            echo '<span class="status" style="color:orange;" ng-class="::vm.job.status">This is not yet live</span>';
                                                        }
                                                        if($jisactive=='4')
                                                        {
                                                            echo '<span class="status live" ng-class="::vm.job.status">Pending</span>';
                                                        }
                                                    ?>

                                                </p>
                                                <div class="text-center">
                                                    <a class="btn btn-lg btn-red" translate="" href="company-editjob.php?bid=<?php echo $jbid; ?>&jid=<?php echo $jid; ?>">
                                                        <span>Review & Edit Job Information</span>
                                                    </a>
                                                    <?php
                                                        if($jisactive=='1')
                                                        {
                                                        ?>
                                                        <a class="btn btn-lg btn-transparent-white" translate="" confirm="Are you sure you want to close this job?" ng-click="vm.close()" href="company-job-applied.php?jid=<?php echo $jid; ?>&action=updateclose">
                                                            <span>Close This Job</span>
                                                        </a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a class="btn btn-lg btn-transparent-white" translate="" confirm="Are you sure you want to close this job?" ng-click="vm.close()" href="company-job-applied.php?jid=<?php echo $jid; ?>&action=updatelive">
                                                            <span>Publish This Job</span>
                                                        </a>
                                                        <?php
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="applications-filter">
                            <div class="container">
                                <div class="container-sm-height">
                                    <div class="row-sm-height">
                                        <div class="col-xs-12 col-sm-height btn btn-transparent col-sm-2 active" href="company-job-applied.php?jid=<?php echo $jid; ?>" onclick="location.href='company-job-applied.php?jid=<?php echo $jid; ?>'">
                                            Applied
                                            <?php
                                                $counter = mysql_query("SELECT COUNT(*) AS counter FROM applicants WHERE jid='$jid'");
                                                $num = mysql_fetch_array($counter);
                                                $count = $num["counter"];
                                            ?>
                                            <span class="badge"><?php echo $count; ?></span>
                                        </div>
                                        <div class="col-xs-12 col-sm-2 col-sm-height btn btn-transparent" href="company-job-foreigners.php?jid=<?php echo $jid; ?>" onclick="location.href='company-job-foreigners.php?jid=<?php echo $jid; ?>'">
                                            Foreigners
                                            <?php
                                                $ff=0;
                                                $sqlf = mysql_query("SELECT * FROM applicants WHERE jid='$jid'");
                                                while($rowf = mysql_fetch_array($sqlf))
                                                {
                                                    $uid = $rowf['uid'];
                                                    $sqlck = "SELECT * FROM candidate WHERE id=\"$uid\";";
                                                    $resck=mysql_query($sqlck);                                                
                                                    while($row = mysql_fetch_array($resck)) 
                                                    {
                                                        $nationality = $row['nationality'];
                                                        if($nationality!='Saudi')
                                                        {
                                                            $ff++;
                                                        }
                                                    }
                                                }
                                            ?>
                                            <span class="badge"><?php echo $ff; ?></span>
                                        </div>
                                        <div class="col-xs-12 col-sm-height btn btn-transparent col-sm-2" href="company-job-shortlisted.php?jid=<?php echo $jid; ?>" onclick="location.href='company-job-shortlisted.php?jid=<?php echo $jid; ?>'">
                                            Shortlisted
                                            <?php
                                                $counterss = mysql_query("SELECT COUNT(*) AS counter FROM applicants WHERE jid='$jid' AND status='Shortlisted'");
                                                $numss = mysql_fetch_array($counterss);
                                                $countss = $numss["counter"];
                                            ?>
                                            <span class="badge"><?php echo $countss; ?></span>
                                        </div>
                                        <div class="col-xs-12 col-sm-height btn btn-transparent col-sm-2" href="company-job-invited.php?jid=<?php echo $jid; ?>" onclick="location.href='company-job-invited.php?jid=<?php echo $jid; ?>'">
                                            Invited
                                            <?php
                                                $counterii = mysql_query("SELECT COUNT(*) AS counter FROM applicants WHERE jid='$jid' AND status='Invited'");
                                                $numii = mysql_fetch_array($counterii);
                                                $countii = $numii["counter"];
                                            ?>
                                            <span class="badge"><?php echo $countii; ?></span>
                                        </div>
                                        <div class="col-xs-12 col-sm-height btn btn-transparent col-sm-2" href="company-job-rejected.php?jid=<?php echo $jid; ?>" onclick="location.href='company-job-rejected.php?jid=<?php echo $jid; ?>'">
                                            Rejected
                                            <?php
                                                $counterrr = mysql_query("SELECT COUNT(*) AS counter FROM applicants WHERE jid='$jid' AND status='Rejected'");
                                                $numrr = mysql_fetch_array($counterrr);
                                                $countrr = $numrr["counter"];
                                            ?>
                                            <span class="badge"><?php echo $countrr; ?></span>
                                        </div>
                                        <div class="col-xs-12 col-sm-height btn btn-transparent col-sm-2" href="company-job-matched.php?jid=<?php echo $jid; ?>" onclick="location.href='company-job-matched.php?jid=<?php echo $jid; ?>'">
                                            Matched
                                            <?php
                                                $sqlmm = "SELECT COUNT(*) AS counter FROM candidate WHERE jobrole LIKE \"%$jjrole%\";";                                            
                                                $countermm = mysql_query($sqlmm);
                                                $nummm = mysql_fetch_array($countermm);
                                                $countmm = $nummm["counter"];
                                            ?>
                                            <span class="badge"><?php echo $countmm; ?></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="applications-result" class="applications scoot-block dashboard-content">
                            <div class="container row-2">
                                <div class="clearfix"></div>
                                <div class="col-xs-12">
                                    <div ui-view="">
                                        <div>
                                            <div class="pull-right found-count">
                                                <div ng-switch="vj.tab">                                            
                                                    <div ng-switch-when="matched"> <?php echo("$count"); ?> Matches </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <ul class="people-list-big">

                                            <?php
                                                $sqla = "SELECT * FROM applicants WHERE jid='$jid';";
                                                $resa = mysql_query($sqla);
                                                while($rowa = mysql_fetch_array($resa)) 
                                                {
                                                    $uid = $rowa['uid'];
                                                    $appliedon = $rowa['date_updated'];

                                                    $sqlu = mysql_query("SELECT * FROM candidate WHERE id='$uid'");
                                                    while($rowu = mysql_fetch_array($sqlu))
                                                    {
                                                        $fname = $rowu['fname'];
                                                        $lname = $rowu['lname'];
                                                        $jobrole = $rowu['jobrole'];
                                                        $photo = $rowu['photo'];
                                                        $nationality = $rowu['nationality'];
                                                        $dob = $rowu['dob'];
                                                        $location = $rowu['location'];
                                                    }

                                                ?>

                                                <li class="people-list-big-item" >
                                                    <applicant-item currenttab="tab" count="vm.countApps" application="application">
                                                        <div class="col-xs-12 col-sm-4 col-lg-3 thumb text-center">
                                                            <a href="company-viewmatched.php?uid=<?php echo $uid; ?>">
                                                                <div class="photo small" style="background-image: url('profile/<?php echo $photo; ?>');">
                                                                    <?php
                                                                        if(trim($photo) == '')
                                                                        {
                                                                        ?>
                                                                        <initials candidate-surname="man" candidate-name="harman" font="48" size="100" ng-if="!application.candidate.profileImg">
                                                                            <div class="scoot-initials " style="width: 100px; height: 100px; line-height: 100px; font-size: 48px;">
                                                                                <span><?php echo substr($fname, 0, 1); ?><?php echo substr($lname, 0, 1); ?></span>
                                                                            </div>
                                                                        </initials>
                                                                        <?php } ?>
                                                                </div>
                                                                <h1 class="user-name"><?php echo $fname.'&nbsp;'.$lname; ?></h1>
                                                            </a>
                                                            <h2 class="user-profession">
                                                                <span ng-repeat="item in application.candidate.professions"><?php echo $jobrole; ?></span>
                                                            </h2>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-8 col-lg-9 text-center-xs person-meta">
                                                            <p class="user-other" ng-if="!(application.candidate.nationality | isUndefined)">
                                                                <em translate="">
                                                                    <span>Nationality:</span>
                                                                </em>
                                                                <?php echo $nationality; ?>
                                                            </p>
                                                            <p class="user-other" ng-if="(application.candidate.dateOfBirth | toAge)">
                                                                <em translate="">
                                                                    <span>Age:</span>
                                                                </em>
                                                                <?php
                                                                    $newstring = substr($dob, -4);
                                                                    $newstring2 = date("Y");
                                                                    $newstring3 = $newstring2-$newstring;
                                                                    echo $newstring3.' Years';
                                                                ?>
                                                            </p>
                                                            <p class="user-other" ng-if="application.candidate.address">
                                                                <em translate="">
                                                                    <span>Location:</span>
                                                                </em>
                                                                <?php echo $location; ?>
                                                            </p>
                                                            <p class="user-other">
                                                                <em translate="">
                                                                    <span>Date of application:</span>
                                                                </em>
                                                                <?php
                                                                    $sqla = mysql_query("SELECT * FROM applied WHERE jid='$jid'");
                                                                    while($rowa = mysql_fetch_array($sqla)) 
                                                                    { 
                                                                        echo $rowa['date_updated'];
                                                                    }
                                                                ?>
                                                            </p>
                                                            <span am-time-ago="::item.published"></span>
                                                            <div class="clearfix"></div>
                                                            <div class="candidate-actions">
                                                                <a class="btn btn-md btn-red" href="company-viewmatched.php?uid=<?php echo $uid; ?>" target="blank_">
                                                                    <span>View Profile</span>
                                                                </a>
                                                                <?php
                                                                    $sql1 = "SELECT * FROM applicants WHERE uid=\"$uid\" AND jid=\"$jid\" AND status=\"Shortlisted\";";
                                                                    $res1 = mysql_query($sql1);
                                                                    if(mysql_num_rows($res1) == 0)
                                                                    {
                                                                ?>
                                                                <a class="btn btn-md btn-red" href="company-job-shortlisted.php?uid=<?php echo $uid; ?>&jid=<?php echo $jid; ?>&action=add">
                                                                    <span> Add to Shortlist</span>
                                                                </a>
                                                                <?php
                                                                    }
                                                                    else
                                                                    {
                                                                ?>
                                                                <a class="btn btn-md btn-light-grey" href="company-job-shortlisted.php?uid=<?php echo $uid; ?>&jid=<?php echo $jid; ?>&action=remove">
                                                                    <span> Remove from Shortlist</span>
                                                                </a>
                                                                <?php
                                                                    }
                                                                    $sql2 = "SELECT * FROM applicants WHERE uid=\"$uid\" AND jid=\"$jid\" AND status=\"Invited\";";
                                                                    $res2 = mysql_query($sql2);
                                                                    if(mysql_num_rows($res2) == 0)
                                                                    {
                                                                ?>                                                                
                                                                <a class="btn btn-md btn-red" href="company-job-invited.php?uid=<?php echo $uid; ?>&jid=<?php echo $jid; ?>&action=invite">
                                                                    <span>Invite to interview</span>
                                                                </a>
                                                                <?php
                                                                    }
                                                                    else
                                                                    {
                                                                ?>
                                                                <a class="btn btn-md btn-light-grey" href="company-job-invited.php?uid=<?php echo $uid; ?>&jid=<?php echo $jid; ?>">
                                                                    <span>Invited</span>
                                                                </a>
                                                                <?php
                                                                    }
                                                                    $sql3 = "SELECT * FROM applicants WHERE uid=\"$uid\" AND jid=\"$jid\" AND status=\"Rejected\";";
                                                                    $res3 = mysql_query($sql3);
                                                                    if(mysql_num_rows($res3) == 0)
                                                                    {
                                                                ?>
                                                                <a class="btn btn-md btn-red" href="company-job-rejected.php?uid=<?php echo $uid; ?>&jid=<?php echo $jid; ?>&action=reject">
                                                                    <span> Reject</span>
                                                                </a>
                                                                <?php
                                                                    }
                                                                    else{
                                                                ?>
                                                                <a class="btn btn-md btn-light-grey" href="company-job-rejected.php?uid=<?php echo $uid; ?>&jid=<?php echo $jid; ?>&action=unreject">
                                                                    <span>Shortlist Again</span>
                                                                </a>
                                                                <?php
                                                                    }
                                                                ?>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </applicant-item>
                                                </li>


                                                <?php
                                                }
                                            ?>

                                        </ul>
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
