<?php
    session_start();
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
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

                $sqlck = "SELECT * FROM candidate WHERE email='$email' and password='$password'";
                $resck=mysql_query($sqlck);
                $count=mysql_num_rows($resck);
                if($count==1)
                {
                    while($row = mysql_fetch_array($resck)) 
                    {
                        $uid = $row['id'];                            
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
                                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDE2Mi45NzggMTYyLjk3OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTYyLjk3OCAxNjIuOTc4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTE2Mi45NzgsMTAxLjEwMWwtMTkuNjExLTM5LjIyNGwtMTkuNjExLDM5LjIyNGgxMy4yMDljLTguMzE1LDI1Ljk1OC0zMi42MzMsNDQuODI2LTYxLjMyNCw0NC44MjYgICAgYy0zNS41MjksMC02NC40MzgtMjguOTA4LTY0LjQzOC02NC40MzhjMC0zNS41MjksMjguOTA5LTY0LjQzOCw2NC40MzgtNjQuNDM4YzI3LjM3NiwwLDUwLjc2NCwxNy4xOSw2MC4wNzcsNDEuMzI1bDYuNDQtMTIuODgyICAgIGMtMTIuODEzLTIzLjU5NS0zNy44Mi0zOS42NDktNjYuNTEyLTM5LjY0OUMzMy45MzYsNS44NDQsMCwzOS43NzgsMCw4MS40ODljMCw0MS43MDgsMzMuOTM2LDc1LjY0NSw3NS42NDUsNzUuNjQ1ICAgIGMzNC45MjQsMCw2NC4zMzEtMjMuODA5LDcyLjk5Ny01Ni4wMzJIMTYyLjk3OHoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cGF0aCBkPSJNMzUuNDg2LDk2LjU4Mmg3LjA4NGwyLjE1LTcuNzQ5aDguNjQ1bDIuMzMyLDcuNzQ5aDcuMzQ1bC05LjM2Mi0zMC4xOTJoLTguOTZMMzUuNDg2LDk2LjU4MnogTTQ3LjQ5NCw3Ny4zMiAgICBjMC40OTMtMS43NDksMC45NDEtNC4wMzQsMS4zOS01LjgyM2gwLjA4OGMwLjQ0OSwxLjc4OSwwLjk4OCw0LjAzNiwxLjUyNyw1LjgyM2wxLjg4Miw2LjQxM2gtNi42NzVMNDcuNDk0LDc3LjMyeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik04MS43MzcsNzEuNzIyYzMuMzExLDAsNS4zNzEsMC41ODMsNy4wMjksMS4yOTRsMS40MzYtNS40NjZjLTEuNDc5LTAuNzE1LTQuNDgyLTEuNDgtOC4zNzctMS40OCAgICBjLTkuOTAxLDAtMTcuMiw1LjczMS0xNy4yNTMsMTUuNzY5Yy0wLjA0Miw0LjQzNCwxLjQ4LDguMzcyLDQuMjYsMTAuOTc4YzIuNzc4LDIuNjg4LDYuNzYzLDQuMDc2LDEyLjI3Nyw0LjA3NiAgICBjMy45OCwwLDcuOTc1LTAuOTg1LDEwLjA3NS0xLjcwMVY3OS4yODlINzkuOTQzdjUuMzMxaDQuNjY1djYuMzEzYy0wLjU0MiwwLjI3NC0xLjc5OCwwLjQ0OS0zLjM2NSwwLjQ0OSAgICBjLTUuNjA0LDAtOS40OTctMy42NzctOS40OTctOS45MDRDNzEuNzQ2LDc0Ljk0NCw3Ni4wNDIsNzEuNzIyLDgxLjczNyw3MS43MjJ6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPHBvbHlnb24gcG9pbnRzPSIxMTUuMTc1LDcxLjk5MyAxMTUuMTc1LDY2LjM5NSA5Ni41MzksNjYuMzk1IDk2LjUzOSw5Ni41ODIgMTE1LjgwNCw5Ni41ODIgMTE1LjgwNCw5MC45ODkgMTAzLjM5NCw5MC45ODkgICAgIDEwMy4zOTQsODMuODIxIDExNC41MDcsODMuODIxIDExNC41MDcsNzguMjYxIDEwMy4zOTQsNzguMjYxIDEwMy4zOTQsNzEuOTkzICAgIiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /> 
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
                                                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDkyMy41NzggOTIzLjU3OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgOTIzLjU3OCA5MjMuNTc4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTgwMy4wMTIsMzk1LjY5N2MtMi43NzEtNDYuMDg3LTEyLjgzNC0xMzEuNjkyLTMxLjY3Mi0xNzMuODY1Yy0yMC4xNzMtNDUuMTU4LTQ4LjY5MS04NC44MTItODQuNTI1LTExOC43ODcgICAgYy00My42NjctNDEuNDAzLTkzLjkyMi03MC42Ny0xNTAuNjgyLTg3LjU4NmMtMTQ4Ljg5NC00NC4zNzMtMzEyLjE5Miw4Ljk1Ny00MDYuNTUsMTMyLjAxMSAgICBjLTM5LjMsNTEuMjUyLTYzLjU5NywxMDkuMDUzLTcyLjg2NCwxNzMuMTA2Yy04Ljg2NCw2MS4yNjUtMy4zMTIsMTIxLjE4NSwxNy4zMTksMTc5LjQ3OSAgICBjMjMuNDQzLDY2LjI0MSw2Mi43NDIsMTIxLjUzMywxMTYuOTczLDE2Ni4yNTVsLTAuNTA3LDIxMi4xNmMtMC4wNiwyNC44OTYsMjAuMTA1LDQ1LjEwOCw0NSw0NS4xMDhoMzA0Ljg4NCAgICBjMjQuODUzLDAsNDUtMjAuMTQ3LDQ1LTQ1di02OC44NjRjMi4wOC0wLjAxOCwxMzUuNjIsMCwxMzUuNjIsMGMxOC40MTYsMCwzNC43MjUtMTEuODgyLDQwLjM2OS0yOS40MTEgICAgYzUuNjY4LTE3LjU5OCwxMi42ODEtNDMuNTQ5LDE3LjU2LTYyLjIwMmMzLjkzMy0xNS4wMzEsNS44MTctMzAuNTIzLDUuNTk1LTQ2LjA2MmwtMC44NzItNjAuNTEzICAgIGMtMC4wMDgtMy4zNTgsMC43MDctNS4yNjUsNC4yMjYtNi41NTZjMTAuMTU2LTMuNzI5LDQyLjg3OS0xNS4zMzEsNjYuNjM1LTIzLjczMWMxMy44MzctNC44OTUsMjAuMzM4LTIwLjcyOSwxMy45MjktMzMuOTM0ICAgIEM4MzYuNDY1LDQ4MS40MjEsODAzLjAxMiwzOTUuNjk3LDgwMy4wMTIsMzk1LjY5N3ogTTQ1Mi44MzMsNTE0LjQzOHYzNy4wMzVjMCwxMS45NzMtOS43MDQsMjEuNjc2LTIxLjY3NiwyMS42NzZoLTE4LjY4MyAgICBjLTExLjk3MSwwLTIxLjY3NS05LjcwMy0yMS42NzUtMjEuNjc2di0zMy43MTFjLTI1LjgxNS0zLjE3LTU2LjgxNC0xMi42MzYtODIuMzk5LTI5LjYwNiAgICBjLTkuMzM0LTYuMTkyLTEyLjAyMi0xOS4wMTYtNS45OTktMjguNDU3bDE5LjI4NS0zMC4yMzFjNi4wODgtOS41NDMsMTguNzM2LTEyLjUwOSwyOC4zNTItNi41MzUgICAgYzIyLjE3MSwxMy43NzMsNDAuODgyLDE5LjUwNiw1OS41OTQsMTkuNTA2YzI3LjY5MiwwLDM4Ljc3MS05LjQxNSwzOC43NzEtMzEuMDE2YzAtNDQuMzA5LTE0Mi44OTYtNTAuNDAyLTE0Mi44OTYtMTQ3LjMyOCAgICBjMC01NS45MzksMzEuNTY5LTk0LjcxLDg1LjI5NS0xMDYuMzQxdi0zNi44NGMwLTExLjQ2Niw5LjI5NS0yMC43NjIsMjAuNzYxLTIwLjc2MmgyMC41MWMxMS40NjYsMCwyMC43NjEsOS4yOTUsMjAuNzYxLDIwLjc2MiAgICB2MzUuNzMyYzI3LjE3LDQuMzEyLDQ5LjMwMiwxNi4wMTIsNjguMjI4LDMxLjk2MmM4Ljg5Myw3LjQ5NSwxMC4wMTcsMjAuNzc3LDIuMzk2LDI5LjU2M2wtMjAuOTA1LDI0LjEwNCAgICBjLTYuOTg1LDguMDU0LTE4Ljk2OCw5LjY2OC0yNy42OTEsMy41NDNjLTE0LjIwNC05Ljk3LTI3LjcwNC0xNC45NTQtNDMuMDczLTE0Ljk1NGMtMjMuODE1LDAtMzUuNDQ2LDYuNjQ2LTM1LjQ0NiwyOC44MDEgICAgYzAsNDIuMDkzLDE0Mi44OTYsNDQuMzA5LDE0Mi44OTYsMTQ1LjExMkM1MzkuMjM1LDQ1OC40OTksNTEwLjk4OSw1MDAuNTkyLDQ1Mi44MzMsNTE0LjQzOHoiIGZpbGw9IiNGRkZGRkYiLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /> 
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
                                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3NyA0NzciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ3NyA0Nzc7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjM4LjQsMEMxMzMsMCw0Ny4yLDg1LjgsNDcuMiwxOTEuMmMwLDEyLDEuMSwyNC4xLDMuNCwzNS45YzAuMSwwLjcsMC41LDIuOCwxLjMsNi40YzIuOSwxMi45LDcuMiwyNS42LDEyLjgsMzcuNyAgICBjMjAuNiw0OC41LDY1LjksMTIzLDE2NS4zLDIwMi44YzIuNSwyLDUuNSwzLDguNSwzczYtMSw4LjUtM2M5OS4zLTc5LjgsMTQ0LjctMTU0LjMsMTY1LjMtMjAyLjhjNS42LTEyLjEsOS45LTI0LjcsMTIuOC0zNy43ICAgIGMwLjgtMy42LDEuMi01LjcsMS4zLTYuNGMyLjItMTEuOCwzLjQtMjMuOSwzLjQtMzUuOUM0MjkuNiw4NS44LDM0My44LDAsMjM4LjQsMHogTTM5OS42LDIyMi40YzAsMC4yLTAuMSwwLjQtMC4xLDAuNiAgICBjLTAuMSwwLjUtMC40LDItMC45LDQuM2MwLDAuMSwwLDAuMSwwLDAuMmMtMi41LDExLjItNi4yLDIyLjEtMTEuMSwzMi42Yy0wLjEsMC4xLTAuMSwwLjMtMC4yLDAuNCAgICBjLTE4LjcsNDQuMy01OS43LDExMS45LTE0OC45LDE4NS42Yy04OS4yLTczLjctMTMwLjItMTQxLjMtMTQ4LjktMTg1LjZjLTAuMS0wLjEtMC4xLTAuMy0wLjItMC40Yy00LjgtMTAuNC04LjUtMjEuNC0xMS4xLTMyLjYgICAgYzAtMC4xLDAtMC4xLDAtMC4yYy0wLjYtMi4zLTAuOC0zLjgtMC45LTQuM2MwLTAuMi0wLjEtMC40LTAuMS0wLjdjLTItMTAuMy0zLTIwLjctMy0zMS4yYzAtOTAuNSw3My43LTE2NC4yLDE2NC4yLTE2NC4yICAgIHMxNjQuMiw3My43LDE2NC4yLDE2NC4yQzQwMi42LDIwMS43LDQwMS42LDIxMi4yLDM5OS42LDIyMi40eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik0yMzguNCw3MS45Yy02Ni45LDAtMTIxLjQsNTQuNS0xMjEuNCwxMjEuNHM1NC41LDEyMS40LDEyMS40LDEyMS40czEyMS40LTU0LjUsMTIxLjQtMTIxLjRTMzA1LjMsNzEuOSwyMzguNCw3MS45eiAgICAgTTIzOC40LDI4Ny43Yy01Mi4xLDAtOTQuNC00Mi40LTk0LjQtOTQuNHM0Mi40LTk0LjQsOTQuNC05NC40czk0LjQsNDIuNCw5NC40LDk0LjRTMjkwLjUsMjg3LjcsMjM4LjQsMjg3Ljd6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /> 
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