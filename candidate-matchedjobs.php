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
                $uid = $row['id'];            
                $fname = $row['fname'];            
                $lname = $row['lname'];
                $mobile = $row['mobile'];
                $photo = $row['photo'];
            }
        }

    ?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>
        
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Matched jobs - myjob.sa</title>
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
                                        <li ui-sref-active="active" ng-if="isCandidate()" class="active">
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
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="search" href="search.php">
                                            <span>Job search</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active" class="active">
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
                <div>
                    <div class="user-jobs-page">
                        <div class="notify-modal" ng-if="vm.totalItems.count == 0">
                            <div class="bg">
                                <div class="wrapper">
                                    <div class="header">
                                        <span class="icon">
                                            <img width="64" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MDIuMDAzIDUwMi4wMDMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUwMi4wMDMgNTAyLjAwMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiPgo8Zz4KCTxnPgoJCTxnPgoJCQk8cGF0aCBkPSJNNDM4LjIxNSwyNTUuNTA4YzkuMDc4LTAuNTAyLDE4LjExOSwxLjM0NiwyNi4xNDIsNS4zNTVjOC4xOTcsNC4wOTUsMTcuNzE0LDMuNjgzLDI1LjQ1OC0xLjEwNSAgICAgYzcuNjMxLTQuNzE3LDEyLjE4Ny0xMi45MDUsMTIuMTg3LTIxLjlWMTIyLjc1N2MwLTUuNTIyLTQuNDc4LTEwLTEwLTEwSDM3Ni45MDFjLTIuOCwwLTQuMjY2LTEuNjk0LTQuODktMi43MDQgICAgIGMtMC41MzctMC44NjctMS42MzEtMy4xODktMC4yMjYtNi4wMDJjNS41NjItMTEuMTMsOC4xMzItMjMuNjQ2LDcuNDMzLTM2LjE5M2MtMi4wMzctMzYuNTktMzIuMzMyLTY2LjM3MS02OC45Ny02Ny44ICAgICBjLTE5Ljc5My0wLjc3OS0zOC41MDksNi4zNDItNTIuNzQxLDIwLjAzMWMtMTQuMjQsMTMuNjk0LTIyLjA4MiwzMi4xMTQtMjIuMDgyLDUxLjg2NmMwLDExLjMyMSwyLjU1OSwyMi4xNiw3LjYwOSwzMi4yMTggICAgIGMxLjM2NSwyLjcxOCwwLjI5MSw0Ljk4OS0wLjIzMyw1Ljg0Yy0wLjYzMywxLjAyNS0yLjExNSwyLjc0NC00LjkzNywyLjc0NEgxMjIuNzU3Yy01LjUyMiwwLTEwLDQuNDc4LTEwLDEwdjExNS4xICAgICBjMCwyLjgtMS42OTQsNC4yNjUtMi43MDUsNC44OWMtMC44NjYsMC41MzctMy4xODgsMS42My02LjAwMSwwLjIyNmMtMTEuMTI5LTUuNTYtMjMuNjM4LTguMTM0LTM2LjE5MS03LjQzNCAgICAgYy0zNi41OSwyLjAzNy02Ni4zNzIsMzIuMzMxLTY3LjgwMiw2OC45NjhjLTAuNzcyLDE5Ljc3Nyw2LjM0MSwzOC41MDksMjAuMDMsNTIuNzQzYzEzLjY5NSwxNC4yNCwzMi4xMTUsMjIuMDgzLDUxLjg2OCwyMi4wODMgICAgIGMxMS4zMjEsMCwyMi4xNi0yLjU1OSwzMi4yMTgtNy42MDljMi43MjItMS4zNjUsNC45OS0wLjI5LDUuODQsMC4yMzNjMS4wMjUsMC42MzMsMi43NDQsMi4xMTUsMi43NDQsNC45Mzd2MTE1LjEwOSAgICAgYzAsNS41MjIsNC40NzgsMTAsMTAsMTBoMTE1LjFjOC45OTYsMCwxNy4xODItNC41NTYsMjEuOS0xMi4xODdjNC43ODgtNy43NDQsNS4yMDEtMTcuMjYxLDEuMTA1LTI1LjQ1OSAgICAgYy00LjAwNy04LjAyMy01Ljg2LTE3LjA2My01LjM1NS0yNi4xNDNjMS40Ny0yNi40MDQsMjMuMzM4LTQ3Ljg5Niw0OS43ODEtNDguOTI3YzE0LjI3OS0wLjU1NSwyNy44MjMsNC41NzcsMzguMDk5LDE0LjQ2MiAgICAgYzEwLjI4Miw5Ljg4OCwxNS45NDUsMjMuMTg5LDE1Ljk0NSwzNy40NTFjMCw4LjE3Ny0xLjg0NCwxNS45OTgtNS40ODIsMjMuMjQ1Yy00LjA4Myw4LjEzLTMuNjc3LDE3LjU5MywxLjA4NSwyNS4zMTMgICAgIGM0LjcyOSw3LjY2NiwxMi45MzgsMTIuMjQzLDIxLjk1OCwxMi4yNDNoMTE1LjEwOGM1LjUyMiwwLDEwLTQuNDc4LDkuOTk5LTEwVjM3Ni44OTRjMC05LjAyLTQuNTc3LTE3LjIyOS0xMi4yNDMtMjEuOTU4ICAgICBjLTcuNzItNC43NjItMTcuMTgxLTUuMTY3LTI1LjMxMy0xLjA4NmMtNy4yNDgsMy42MzgtMTUuMDY5LDUuNDgzLTIzLjI0Niw1LjQ4M2MtMTQuMjYyLDAtMjcuNTYyLTUuNjYzLTM3LjQ1MS0xNS45NDYgICAgIGMtOS44ODQtMTAuMjc3LTE1LjAyLTIzLjgwOC0xNC40NjItMzguMUMzOTAuMzE5LDI3OC44NDQsNDExLjgxMSwyNTYuOTc4LDQzOC4yMTUsMjU1LjUwOHogTTM4OS4zMzMsMzU3LjI1MSAgICAgYzEzLjY5NSwxNC4yMzksMzIuMTE1LDIyLjA4Miw1MS44NjcsMjIuMDgyYzExLjMyMSwwLDIyLjE2LTIuNTU5LDMyLjIyLTcuNjA5YzIuNzE4LTEuMzY2LDQuOTg4LTAuMjkxLDUuODM4LDAuMjMzICAgICBjMS4wMjUsMC42MzMsMi43NDQsMi4xMTUsMi43NDQsNC45Mzd2MTA1LjEwN0gzNzYuODk1Yy0yLjgyMywwLTQuMzA0LTEuNzE5LTQuOTM3LTIuNzQ0Yy0wLjUyNC0wLjg1MS0xLjU5Ni0zLjEyMS0wLjIzMi01LjgzOSAgICAgYzUuMDQ4LTEwLjA1OSw3LjYwOC0yMC44OTksNy42MDgtMzIuMjE5YzAtMTkuNzUyLTcuODQyLTM4LjE3Mi0yMi4wODItNTEuODY2Yy0xMy41MzQtMTMuMDE4LTMxLjEzNC0yMC4wODgtNDkuODM1LTIwLjA4OCAgICAgYy0wLjk2NSwwLTEuOTM2LDAuMDE5LTIuOTA3LDAuMDU1Yy0zNi42MzcsMS40MjktNjYuOTMzLDMxLjIxLTY4Ljk3MSw2Ny44Yy0wLjY5OCwxMi41NDcsMS44NzMsMjUuMDYzLDcuNDM0LDM2LjE5MiAgICAgYzEuNDA1LDIuODE1LDAuMzEsNS4xMzYtMC4yMjYsNi4wMDNjLTAuNjI1LDEuMDEtMi4wOSwyLjcwNC00Ljg5LDIuNzA0SDEzMi43NTZWMzc2Ljg5MmMwLTkuMDItNC41NzctMTcuMjI5LTEyLjI0My0yMS45NTggICAgIGMtNy43MTktNC43NjEtMTcuMTgyLTUuMTY3LTI1LjMxMy0xLjA4NmMtNy4yNDgsMy42MzgtMTUuMDY4LDUuNDgzLTIzLjI0NSw1LjQ4M2MtMTQuMjYyLDAtMjcuNTYzLTUuNjYzLTM3LjQ1My0xNS45NDYgICAgIGMtOS44ODMtMTAuMjc4LTE1LjAxOS0yMy44MDgtMTQuNDYtMzguMWMxLjAzMy0yNi40NDMsMjIuNTI1LTQ4LjMwOSw0OC45MjktNDkuNzc5YzkuMDc1LTAuNTAyLDE4LjExOSwxLjM0NiwyNi4xNDEsNS4zNTUgICAgIGM4LjE5Niw0LjA5NCwxNy43MTMsMy42ODMsMjUuNDU4LTEuMTA0YzcuNjMyLTQuNzE4LDEyLjE4OC0xMi45MDUsMTIuMTg4LTIxLjkwMVYxMzIuNzU1aDEwNS4xMDcgICAgIGM5LjAyLDAsMTcuMjI5LTQuNTc3LDIxLjk1OC0xMi4yNDNjNC43NjItNy43MTgsNS4xNjgtMTcuMTgyLDEuMDg2LTI1LjMxM2MtMy42MzgtNy4yNDgtNS40ODMtMTUuMDY4LTUuNDgzLTIzLjI0NSAgICAgYzAtMTQuMjYyLDUuNjYzLTI3LjU2MiwxNS45NDUtMzcuNDUxYzEwLjI3Ny05Ljg4MywyMy44MDYtMTUuMDI1LDM4LjA5OS0xNC40NjJjMjYuNDQ0LDEuMDMxLDQ4LjMxLDIyLjUyMyw0OS43OCw0OC45MjcgICAgIGMwLjUwNiw5LjA4MS0xLjM0NSwxOC4xMi01LjM1NCwyNi4xNDRjLTQuMDk2LDguMTk3LTMuNjgzLDE3LjcxNCwxLjEwNSwyNS40NThjNC43MTcsNy42MzEsMTIuOTA1LDEyLjE4NywyMS45LDEyLjE4N2gxMDUuMTAxICAgICB2MTA1LjFjMCwyLjgtMS42OTQsNC4yNjYtMi43MDQsNC44OWMtMC44NjgsMC41MzctMy4xODksMS42My02LjAwMiwwLjIyNmMtMTEuMTI5LTUuNTYtMjMuNjM2LTguMTM0LTM2LjE5MS03LjQzNCAgICAgYy0zNi41OSwyLjAzNy02Ni4zNzIsMzIuMzMxLTY3LjgwMiw2OC45NjlDMzY4LjUzLDMyNC4yODUsMzc1LjY0NSwzNDMuMDE3LDM4OS4zMzMsMzU3LjI1MXoiIGZpbGw9IiNGRkZGRkYiLz4KCQkJPHBhdGggZD0iTTE5OS41OCwxNDkuOTI5aC0zOS42NWMtNS41MjIsMC0xMCw0LjQ3OC0xMCwxMGMwLDUuNTIyLDQuNDc4LDEwLDEwLDEwaDM5LjY1YzUuNTIyLDAsMTAtNC40NzgsMTAtMTAgICAgIEMyMDkuNTgsMTU0LjQwNywyMDUuMTAyLDE0OS45MjksMTk5LjU4LDE0OS45Mjl6IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxwYXRoIGQ9Ik0yNDcuOTA0LDE0OS45MjloLTExLjE1MWMtNS41MjIsMC0xMCw0LjQ3OC0xMCwxMGMwLDUuNTIyLDQuNDc4LDEwLDEwLDEwaDExLjE1MWM1LjUyMiwwLDEwLTQuNDc4LDEwLTEwICAgICBDMjU3LjkwNCwxNTQuNDA3LDI1My40MjYsMTQ5LjkyOSwyNDcuOTA0LDE0OS45Mjl6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPC9nPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
                                        </span>
                                    </div>
                                    <div class="content">
                                        <span class="title">
                                            Looks like you don't
                                            <br>
                                            have matched jobs
                                        </span>
                                        <span class="msg">
                                            Update your profile to start getting
                                            <br>
                                            matched to jobs you might be interested in.
                                        </span>
                                        <a class="btn btn-md btn-red" href="candidate-edit-1.php" ui-sref="user-edit-profile.step-one">
                                            <span>Update Profile</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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