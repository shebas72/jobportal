<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $jid=$_GET['jid'];
    $uid=$_GET['uid'];
    $action=$_GET['action'];

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

    if($action=='apply')
    {
        $sqla = "SELECT * FROM applied WHERE jid='$jid' and uid='$uid';";
        $resa=mysql_query($sqla);
        $count=mysql_num_rows($resa);
        if($count==0)
        {
            $sqlapy = "INSERT INTO applied(jid,uid) VALUES(\"$jid\",\"$uid\");";
            $resapy = mysql_query($sqlapy);
            $sqlapy1 = "INSERT INTO applicants(cid,jid,uid,status) VALUES(\"$jcid\",\"$jid\",\"$uid\",\"Applied\");";
            $resapy1 = mysql_query($sqlapy1);
            
            $sqlj = "SELECT * FROM jobs WHERE id=\"$jid\";";
            $resj = mysql_query($sqlj);
            while($row = mysql_fetch_array($resj)) 
            {                
                $jobtitle = $row['jobtitle'];
                $bid = $row['bid'];                
                $sqlb = "SELECT * FROM business WHERE id=\"$bid\";";
                $resb = mysql_query($sqlb);
                while($row = mysql_fetch_array($resb)) 
                {                
                    $bname = $row['name'];                
                    $cid = $row['cid'];                
                }
            }
            $to = $email;
            $from = $mailfrom;
            $subject = 'Applied for '.$jobtitle.' - '.$bname;                                    
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body style="font-size:14px;">';
            $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
            $message .= '<p>Congratulations !<br /><br />You have successfully applied for the below job,</p><br />';
            $message .= '<b>'.$jobtitle.' - '.$bname.'</b>';            
            $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
            $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
            $message .= '</body></html>';            
            mail($to, $subject, $message, $headers);
            
            $sqlj = "SELECT * FROM company WHERE id=\"$cid\";";
            $resj = mysql_query($sqlj);
            while($row = mysql_fetch_array($resj)) 
            {
                $cemail = $row['cemail'];
            }
            $to = $cemail;
            $from = $mailfrom;
            $subject = 'Application for '.$jobtitle.' - '.$bname;                                    
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body style="font-size:14px;">';
            $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
            $message .= '<p>Hello !<br /><br /> You received a new application from '.$fname.' '.$lname.' for the below job,</p><br />';
            $message .= '<b>'.$jobtitle.' - '.$bname.'</b>';            
            $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
            $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
            $message .= '</body></html>';            
            mail($to, $subject, $message, $headers);
            
        }
    }
    if($action=='unapply')
    {
        $sqla = "SELECT * FROM applied WHERE jid='$jid' and uid='$uid';";
        $resa=mysql_query($sqla);
        $count=mysql_num_rows($resa);
        if($count==1)
        {
            $sqlapy = "DELETE FROM applied WHERE jid=\"$jid\" AND uid=\"$uid\";";
            $resapy = mysql_query($sqlapy);
            $sqlapy1 = "DELETE FROM applicants WHERE jid=\"$jid\" AND uid=\"$uid\";";
            $resapy1 = mysql_query($sqlapy1);
            
            $sqlj = "SELECT * FROM jobs WHERE id=\"$jid\";";
            $resj = mysql_query($sqlj);
            while($row = mysql_fetch_array($resj)) 
            {                
                $jobtitle = $row['jobtitle'];
                $bid = $row['bid'];                
                $sqlb = "SELECT * FROM business WHERE id=\"$bid\";";
                $resb = mysql_query($sqlb);
                while($row = mysql_fetch_array($resb)) 
                {                
                    $bname = $row['name'];                
                }
            }
            $to = $email;
            $from = $mailfrom;
            $subject = 'Withdrawn from '.$jobtitle.' - '.$bname;                                    
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body style="font-size:14px;">';
            $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
            $message .= '<p>Hi !<br /><br />You application was withdrawn for the below job,</p><br />';
            $message .= '<b>'.$jobtitle.' - '.$bname.'</b>';            
            $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
            $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
            $message .= '</body></html>';            
            mail($to, $subject, $message, $headers);
            
            $sqlj = "SELECT * FROM company WHERE id=\"$cid\";";
            $resj = mysql_query($sqlj);
            while($row = mysql_fetch_array($resj)) 
            {
                $cemail = $row['cemail'];
            }
            $to = $cemail;
            $from = $mailfrom;
            $subject = 'Withdrawn from '.$jobtitle.' - '.$bname;                                    
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body style="font-size:14px;">';
            $message .= '<img src="http://myjob.sa/main/wordpress/emailbanner.jpg" /><br /><br />';
            $message .= '<p>Hello !<br /><br /> The application '.$fname.' '.$lname.' withdrawn the application for the below job,</p><br />';
            $message .= '<b>'.$jobtitle.' - '.$bname.'</b>';            
            $message .= '<br /><hr style="border:1px solid #dcdcdc;" /><br />';
            $message .= '<p>If you need any support please contact us on <a href="mailto:info@myjob.sa">info@myjob.sa</a>.</p>';
            $message .= '</body></html>';            
            mail($to, $subject, $message, $headers);
            
        }
    }
    if($action=='save')
    {
        $sqla = "SELECT * FROM saved WHERE jid='$jid' and uid='$uid';";
        $resa=mysql_query($sqla);
        $count=mysql_num_rows($resa);
        if($count==0)
        {
            $sqlsav = "INSERT INTO saved(jid,uid) VALUES(\"$jid\",\"$uid\");";
            $ressav = mysql_query($sqlsav);
        }
    }
    if($action=='unsave')
    {
        $sqla = "SELECT * FROM saved WHERE jid='$jid' and uid='$uid';";
        $resa=mysql_query($sqla);
        $count=mysql_num_rows($resa);
        if($count==1)
        {
            $sqlapy = "DELETE FROM saved WHERE jid=\"$jid\" AND uid=\"$uid\";";
            $resapy = mysql_query($sqlapy);
        }
    }

?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>        
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title=""><?php echo $jjobtitle; ?> - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles/styles.min.css?v=9022" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

    </head>
    <body class="">

        <?php
            if(($_SESSION['email'])&&($_SESSION['password']))
            {
                include('inc.php');

                $sqlck = "SELECT * FROM candidate WHERE email='$email' and password='$password'";
                $resck=mysql_query($sqlck);
                $count=mysql_num_rows($resck);
                if($count==1)
                {
                ?>
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
                                    <div id="navbar-collapse" class="collapse navbar-collapse nav-primary" style="max-height: 860px;">

                                        <?php include('topmenu.php'); ?>

                                        <div class="clearfix"></div>
                                        <ul class="nav navbar-nav nav-secondary visible-xs">
                                            <li ui-sref-active="active" ng-if="isCandidate()" class="active">
                                                <a translate="" ui-sref="user" href="candidate-dashboard.php">
                                                    <span>Dashboard</span>
                                                </a>
                                            </li>
                                            <li class="active" ui-sref-active="active" ng-if="isCandidate()">
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
                                        <li ui-sref-active="active">
                                            <a translate="" ui-sref="user" href="candidate-dashboard.php">
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="active" ui-sref-active="active">
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
                <?php
                }

                $sqlck = "SELECT * FROM company WHERE email='$email' and password='$password'";
                $resck=mysql_query($sqlck);
                $count=mysql_num_rows($resck);
                if($count==1)
                {
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

            }
            else
            {
            ?>        
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
                                    <ul class="nav navbar-nav navbar-right">
                                        <li ng-hide="isLogedIn()" ui-sref-active="active">
                                            <a translate="" ng-click="openState('search')" href="search.php">
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
                                                    <a translate="" ui-sref="user-login" href="login-candidate.php">
                                                        <span>Candidate Login</span>
                                                    </a>
                                                </li>
                                                <li ui-sref-active="active">
                                                    <a translate="" ui-sref="company-login" href="login-company.php">
                                                        <span>Company Login</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li ng-hide="isLogedIn()" ui-sref-active="active">
                                            <div ng-controller="registerModalController">

                                                <a translate="" ng-click="open()" href="register-candidate.php">
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
                        <div class="nav-secondary-wrapper hidden-xs" ng-if="!isHomePageCandidate()"> </div>
                    </nav>
                </div>
            </header>        
            <?php
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
                <div class="job-page dashboard-v3">
                    <div class="dashboard-top">
                        <div class="container">
                            <div class="dashboard-top-container no-bg">
                                <div class="col-xs-12 text-center">
                                    <span class="thumbnail thumb no-bottom-margin circle-new">
                                        <?php if($bimage!='') {?>
                                            <div class="job-item-img" style="background-image: url('profile/<?php echo $bimage; ?>');');"></div>
                                            <?php } else { ?>                                        
                                            <div class="job-item-img" style="background-image: url('https://www.skootjobs.com/client/images/companies/logo-placeholder.jpg');"></div>
                                            <?php } ?>
                                    </span>
                                    <h3 class="heading"><?php echo $jjobtitle; ?></h3>
                                    <h5 class="subsubheading">
                                        <a ui-sref="business-jobs-public({businessId: vm.job.business.id})" href="#"><?php echo $bname; ?></a>
                                    </h5>
                                    <div class="gap-10"></div>
                                    <div class="job-top-actions" ng-if="!vm.job.isLoading">

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

                                                $sqla = "SELECT * FROM applied WHERE jid='$jid' and uid='$uid';";
                                                $resa=mysql_query($sqla);
                                                $count=mysql_num_rows($resa);
                                                if($count==0)
                                                {
                                                ?>
                                                <a class="btn btn-red btn-md" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=apply">
                                                    <span>Apply Now</span>
                                                </a>
                                                <?php 
                                                }
                                                if($count==1)
                                                {
                                                ?>
                                                <a class="btn btn-green btn-md" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=unapply">
                                                    <span>Withdrawn Application</span>
                                                </a>
                                                <?php 
                                                }
                                            ?>

                                            <div style="margin-bottom: 5px; display: inline-block;"> </div>
                                            <div style="margin-bottom: 5px; display: inline-block;"> </div>

                                            <?php 
                                                $sqla = "SELECT * FROM saved WHERE jid='$jid' and uid='$uid';";
                                                $resa=mysql_query($sqla);
                                                $count=mysql_num_rows($resa);
                                                if($count==0)
                                                {
                                                ?>
                                                <a class="btn btn-transparent-white btn-md" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=save">                                                
                                                    <span> Save This Job</span>
                                                </a>
                                                <?php 
                                                }
                                                if($count==1)
                                                {
                                                ?>
                                                <a class="btn btn-transparent-white btn-md" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=unsave">                                                
                                                    <span> Remove from Saved Jobs</span>
                                                </a>
                                                <?php 
                                                }
                                            ?>                                                                                                        

                                            <?php

                                            }
                                            else
                                            {
                                            ?>

                                            <a class="btn btn-red btn-md" href="login-candidate.php">
                                                <span>Login to Apply</span>
                                            </a>

                                            <?php
                                            }
                                        ?>

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
                                <div class="clearfix"></div>
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
                                                <div class="col col-xs-height col-text">
                                                    <img src="images/jv1.jpg" height="16"><span> <?php echo $jetype; ?></span>                                                    
                                                </div>
                                            </div>
                                            <div class="row-xs-height">
                                                <div class="col col-xs-height col-text">
                                                    <img src="images/jv2.jpg" height="16"><span am-time-ago="vm.job.published"> <?php echo time_elapsed_string($jdate_updated, true); ?></span>
                                                </div>
                                            </div>
                                            <div class="row-xs-height">
                                                <div class="col col-xs-height col-text">
                                                    <img src="images/jv3.jpg" height="16"><span> <?php echo $jsalaryfrom; ?> - <?php echo $jsalaryto; ?> / <?php echo $jsalaryperiod; ?></span>
                                                </div>
                                            </div>
                                            <div class="row-xs-height">                                                
                                                <div class="col col-xs-height col-text">
                                                    <img src="images/jv4.jpg" height="16"><span> <?php echo $jjlocation; ?></span>
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
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-job-content">
                            <div class="container row-2">
                                <div class="container">
                                    <div class="row row-md-height row-lg-height">
                                        <div class="col-xs-12 col-sm-12 col-md-6 pull-left">
                                            <div class="block">
                                                <h2 class="title"> Job Description </h2>
                                                <div class="description">
                                                    <div class="job-description" ng-bind-html="::vm.job.description">
                                                        <?php echo $jjobabout; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 pull-right" ng-if="vm.job.business.about">
                                            <div class="block">
                                                <h2 class="title"> About business </h2>
                                                <div class="description">
                                                    <div ng-bind-html="::vm.job.business.about">
                                                        <div class="ng-scope">
                                                            <?php echo $bdescription; ?>
                                                        </div>
                                                        <div class="ng-scope"> </div>
                                                        <div class="ng-scope">
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row row-md-height row-lg-height">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="block">
                                                <h3 class="title" translate="">
                                                    <span>Minimum level of education required</span>
                                                </h3>
                                                <ul class="label-list_v3" ng-if="vm.job.typeOfEducation.name">
                                                    <li>
                                                        <span class="item"><?php echo $jjobeducation; ?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="job-details-main-block">
                                                <div class="block">
                                                    <h3 class="title" translate="">
                                                        <span>Languages</span>
                                                    </h3>
                                                    <ul class="label-list_v3" ng-if="!(vm.job.languages | isEmpty)">
                                                        <?php
                                                            $arrl=explode(",",$jlanguage);
                                                            echo '<li><span class="item">' . implode( '<li><span class="item">', $arrl) . '</span></li>';
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row row-md-height row-lg-height">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="block">
                                                <h3 class="title" translate="">
                                                    <span>Skills / Certificates</span>
                                                </h3>
                                                <ul class="label-list_v3" ng-if="!(vm.job.skills | isEmpty)">
                                                    <?php
                                                        $arrb=explode(",",$jskillcert);
                                                        echo '<li><span class="item">' . implode( '<li><span class="item">', $arrb) . '</span></li>';
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="block">
                                                <h3 class="title" translate="">
                                                    <span>Job Benefits</span>
                                                </h3>
                                                <ul>
                                                    <?php
                                                        $arr=explode(",",$jbenefits);
                                                        echo '<li><img src="http://image.flaticon.com/icons/svg/4/4629.svg" height="20"> ' . implode( '</li><li><img src="http://image.flaticon.com/icons/svg/4/4629.svg" height="20"> ', $arr) . '</li>';
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block visible-xs" ng-if="vm.job.business.about">
                                    <h2 class="title"> About business </h2>
                                    <div class="description">
                                        <div ng-bind-html="::vm.job.business.about">
                                            <div class="ng-scope">
                                                <?php echo $bdescription; ?>
                                            </div>
                                            <div class="ng-scope"> </div>
                                            <div class="ng-scope">
                                                <br>
                                            </div>
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

    