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
            <title page-title="">Dashboard - myjob.sa</title>
            <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
            <meta content="" name="description">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta content="#e5202d" name="theme-color">
            <meta content="!" name="fragment">
            <link href="styles.min.css?v=40520" rel="stylesheet">

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
                    <div class="user-page dashboard-v3">
                        <div class="dashboard-top">
                            <div class="container">
                                <div class="dashboard-top-container">
                                    <div class="dashboard-top-content">
                                        <div class="col-xs-12 col-sm-8 col-md-7 row-2 user-details">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="user-image" style="background-image: url('profile/<?php echo $photo; ?>');">

                                                    <?php
                                                        if(trim($photo) == '')
                                                        {
                                                        ?>
                                                        <initials candidate-surname="<?php echo $lname; ?>" candidate-name="<?php echo $fname; ?>" font="115" size="250" rounded="rounded" ng-if="!vm.candidate.profileImg">
                                                            <div class="scoot-initials rounded" style="width: 250px; height: 250px; line-height: 250px; font-size: 115px;">
                                                                <span><?php echo substr($fname, 0, 1); ?><?php echo substr($lname, 0, 1); ?></span>
                                                            </div>
                                                        </initials>
                                                        <?php } ?>

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <h1 class="user-name"><?php echo $fname.'&nbsp;'.$lname; ?></h1>
                                                <div class="container-xs-height user-contacts">
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height">

                                                        </div>
                                                        <div class="col-xs-height col-xs-12">
                                                            <p><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ4My4zIDQ4My4zIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0ODMuMyA0ODMuMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxNnB4IiBoZWlnaHQ9IjE2cHgiPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00MjQuMyw1Ny43NUg1OS4xYy0zMi42LDAtNTkuMSwyNi41LTU5LjEsNTkuMXYyNDkuNmMwLDMyLjYsMjYuNSw1OS4xLDU5LjEsNTkuMWgzNjUuMWMzMi42LDAsNTkuMS0yNi41LDU5LjEtNTkuMSAgICB2LTI0OS41QzQ4My40LDg0LjM1LDQ1Ni45LDU3Ljc1LDQyNC4zLDU3Ljc1eiBNNDU2LjQsMzY2LjQ1YzAsMTcuNy0xNC40LDMyLjEtMzIuMSwzMi4xSDU5LjFjLTE3LjcsMC0zMi4xLTE0LjQtMzIuMS0zMi4xdi0yNDkuNSAgICBjMC0xNy43LDE0LjQtMzIuMSwzMi4xLTMyLjFoMzY1LjFjMTcuNywwLDMyLjEsMTQuNCwzMi4xLDMyLjF2MjQ5LjVINDU2LjR6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPHBhdGggZD0iTTMwNC44LDIzOC41NWwxMTguMi0xMDZjNS41LTUsNi0xMy41LDEtMTkuMWMtNS01LjUtMTMuNS02LTE5LjEtMWwtMTYzLDE0Ni4zbC0zMS44LTI4LjRjLTAuMS0wLjEtMC4yLTAuMi0wLjItMC4zICAgIGMtMC43LTAuNy0xLjQtMS4zLTIuMi0xLjlMNzguMywxMTIuMzVjLTUuNi01LTE0LjEtNC41LTE5LjEsMS4xYy01LDUuNi00LjUsMTQuMSwxLjEsMTkuMWwxMTkuNiwxMDYuOUw2MC44LDM1MC45NSAgICBjLTUuNCw1LjEtNS43LDEzLjYtMC42LDE5LjFjMi43LDIuOCw2LjMsNC4zLDkuOSw0LjNjMy4zLDAsNi42LTEuMiw5LjItMy42bDEyMC45LTExMy4xbDMyLjgsMjkuM2MyLjYsMi4zLDUuOCwzLjQsOSwzLjQgICAgYzMuMiwwLDYuNS0xLjIsOS0zLjVsMzMuNy0zMC4ybDEyMC4yLDExNC4yYzIuNiwyLjUsNiwzLjcsOS4zLDMuN2MzLjYsMCw3LjEtMS40LDkuOC00LjJjNS4xLTUuNCw0LjktMTQtMC41LTE5LjFMMzA0LjgsMjM4LjU1eiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /> <?php echo $email; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row-xs-height">
                                                        <div class="col-xs-height">

                                                        </div>
                                                        <div class="col-xs-height col-xs-12">
                                                            <p><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5LjczMSAyOS43MzEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI5LjczMSAyOS43MzE7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMjMuODk1LDI5LjczMWMtMS4yMzcsMC0yLjczMS0wLjMxLTQuMzc0LTAuOTNjLTMuNjAyLTEuMzU4LTcuNTIxLTQuMDQyLTExLjAzNS03LjU1NiAgIGMtMy41MTUtMy41MTUtNi4xOTktNy40MzUtNy41NTgtMTEuMDM3Qy0wLjMwNyw2LjkzMy0wLjMxLDQuMjQ1LDAuOTIxLDMuMDE1YzAuMTc3LTAuMTc3LDAuMzU3LTAuMzY3LDAuNTQzLTAuNTYzICAgYzEuMTIzLTEuMTgxLDIuMzkyLTIuNTEsNC4wNzQtMi40NUM2LjY5NywwLjA1LDcuODIsMC43Nyw4Ljk3LDIuMjAxYzMuMzk4LDQuMjI2LDEuODY2LDUuNzMyLDAuMDkzLDcuNDc4bC0wLjMxMywwLjMxICAgYy0wLjI5LDAuMjktMC44MzgsMS42MzMsNC4yNiw2LjczMWMxLjY2NCwxLjY2NCwzLjA4MywyLjg4Miw0LjIxNywzLjYxOWMwLjcxNCwwLjQ2NCwxLjk5MSwxLjE2NiwyLjUxNSwwLjY0MmwwLjMxNS0wLjMxOCAgIGMxLjc0NC0xLjc2OSwzLjI1LTMuMjk2LDcuNDczLDAuMDk5YzEuNDMxLDEuMTUsMi4xNSwyLjI3MiwyLjE5OCwzLjQzM2MwLjA2OSwxLjY4MS0xLjI3LDIuOTUzLTIuNDUyLDQuMDc1ICAgYy0wLjE5NSwwLjE4Ni0wLjM4NSwwLjM2Ni0wLjU2MiwwLjU0MkMyNi4xMDMsMjkuNDI0LDI1LjEyNiwyOS43MzEsMjMuODk1LDI5LjczMXogTTUuNDE4LDFDNC4yMjMsMSwzLjE0NCwyLjEzNiwyLjE4OSwzLjE0MSAgIEMxLjk5NywzLjM0MywxLjgxMSwzLjUzOSwxLjYyOCwzLjcyMkMwLjcxMSw0LjYzOCwwLjgwNCw3LjA0NSwxLjg2NCw5Ljg1NmMxLjMxLDMuNDcyLDMuOTEzLDcuMjY2LDcuMzMsMTAuNjgzICAgYzMuNDE2LDMuNDE1LDcuMjA4LDYuMDE4LDEwLjY4MSw3LjMyN2MyLjgxMSwxLjA2Miw1LjIxOCwxLjE1Miw2LjEzMywwLjIzN2MwLjE4My0wLjE4MywwLjM3OS0wLjM2OSwwLjU4MS0wLjU2ICAgYzEuMDI3LTAuOTc2LDIuMTkyLTIuMDgyLDIuMTQxLTMuMzA5Yy0wLjAzNS0wLjg0My0wLjY0OS0xLjc1LTEuODI1LTIuNjk1Yy0zLjUxOS0yLjgzLTQuNTAzLTEuODMxLTYuMTM1LTAuMTc2bC0wLjMyLDAuMzIzICAgYy0wLjc4LDAuNzgxLTIuMDQ3LDAuNjA4LTMuNzY3LTAuNTFjLTEuMTkzLTAuNzc2LTIuNjY3LTIuMDM4LTQuMzc5LTMuNzUxYy00LjIzMS00LjIzLTUuNTg0LTYuODE5LTQuMjYtOC4xNDZsMC4zMTktMC4zMTUgICBjMS42NTktMS42MzIsMi42Ni0yLjYxNy0wLjE3MS02LjEzOEM3LjI0NSwxLjY1MSw2LjMzOSwxLjAzNyw1LjQ5NiwxLjAwMUM1LjQ3LDEsNS40NDQsMSw1LjQxOCwxeiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /> <?php echo $mobile; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gap-10"></div>
                                                <a class="btn btn-md btn-red" translate="" ui-sref="user-profile({userId: vm.candidate.id, slug: (vm.candidate.name | slugify)})" href="candidate-publicprofile.php">
                                                    <span>View Public Profile</span>
                                                </a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 col-md-5 user-status-pc row-2">
                                            <div class="user-status-wrapper additional-text" ng-class="{'additional-text': vm.candidate.huntStatus != 'Looking'}">
                                                Visibility to Employers:
                                                <span class="scoot-switch_v2">
                                                    <label class="switch">
                                                        <input id="looking-job" class="scoot-toggle ng-untouched ng-valid ng-dirty ng-valid-parse ng-not-empty" type="checkbox" change-hunt-status="vm.candidate" ng-model="vm.candidate.huntStatus">
                                                        <div class="slider round"></div>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="user-strenght-wrapper">
                                                <div class="user-profile-things">
                                                    <p translate="">
                                                        <?php
                                                            $strength = 82;
                                                            if($photo != '')
                                                            {
                                                                $strength = $strength+6;
                                                            }else { echo 'Upload a photo +6%.<br />'; };
                                                            if($resume != '')
                                                            {
                                                                $strength = $strength+6;
                                                            }else { echo 'Upload a resume +6%.<br />'; };
                                                            if($experience != '')
                                                            {
                                                                $strength = $strength+6;
                                                            }else { echo 'Add some work experience +6%.<br />'; };
                                                                                                                        
                                                        ?>
                                                        <span>Profile Strength: </span>
                                                        <span class="profile-strength-pc"><?php echo $strength; ?>%</span>
                                                    </p>
                                                    <profile-completion candidate="vm.candidate">
                                                        <div class="container-xs-height">
                                                            <div class="row-xs-height">
                                                                <div class="col-xs-height col-xs-12 row-2 col-middle">
                                                                    <div class="profile-strength-wrapper">
                                                                        <div class="profile-strength-line"> </div>
                                                                        <div class="full" style="width: <?php echo $strength; ?>%;"></div>
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </profile-completion>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="scoot-block dashboard-content">
                            <div class="container row-2 user-jobs">
                                <div class="col-xs-12 col-md-4">
                                    <div class="block">
                                        <div class="inner">
                                            <h3 class="title">
                                                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDQyMi44NDIgNDIyLjg0MiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNDIyLjg0MiA0MjIuODQyIiB3aWR0aD0iMzJweCIgaGVpZ2h0PSIzMnB4Ij4KICA8cGF0aCBkPSJtNDEyLjU3MSw0MjIuODQyaC0xMDcuMjM3Yy0zLjY4OCwwLTcuMDc3LTIuMDMtOC44MTctNS4yODMtMS43NC0zLjI1Mi0xLjU0OS03LjE5OCAwLjQ5OC0xMC4yNjYgNS4zMTEtNy45NjIgOC4xMTgtMTcuMjQ3IDguMTE4LTI2Ljg1IDAtMjYuNzIzLTIxLjc0LTQ4LjQ2My00OC40NjMtNDguNDYzcy00OC40NjMsMjEuNzQxLTQ4LjQ2Myw0OC40NjNjMCw5LjYwMyAyLjgwOCwxOC44ODcgOC4xMTgsMjYuODUgMi4wNDcsMy4wNjggMi4yMzgsNy4wMTQgMC40OTgsMTAuMjY2LTEuNzQsMy4yNTItNS4xMjksNS4yODMtOC44MTcsNS4yODNoLTEwNy4yMzljLTUuNTIyLDAtMTAtNC40NzctMTAtMTB2LTkxLjA3MmMtNy4wNDYsMi4zOTctMTQuNDc1LDMuNjMzLTIyLjAzMiwzLjYzMy0zNy43NTEsMC02OC40NjQtMzAuNzEyLTY4LjQ2NC02OC40NjMgMC0zNy43NTEgMzAuNzEzLTY4LjQ2MyA2OC40NjQtNjguNDYzIDcuNTU4LDAgMTQuOTg2LDEuMjM2IDIyLjAzMiwzLjYzM3YtOTEuMDcyYzAtNS41MjMgNC40NzgtMTAgMTAtMTBoOTEuMjUxYy0yLjUxNS03LjItMy44MTItMTQuODEzLTMuODEyLTIyLjU3NiAwLjAwMS0zNy43NSAzMC43MTMtNjguNDYyIDY4LjQ2NC02OC40NjJzNjguNDYzLDMwLjcxMiA2OC40NjMsNjguNDYzYzAsNy43NjMtMS4yOTcsMTUuMzc1LTMuODEyLDIyLjU3Nmg5MS4yNWM1LjUyMiwwIDEwLDQuNDc3IDEwLDEwdjEwNy4zNjZjMCwzLjY5Ni0yLjAzOCw3LjA5LTUuMzAxLDguODI3LTMuMjYyLDEuNzM2LTcuMjE1LDEuNTMzLTEwLjI4Mi0wLjUzMS03Ljk5NS01LjM4LTE3LjMzNy04LjIyNC0yNy4wMTYtOC4yMjQtMjYuNzIzLDAtNDguNDYzLDIxLjc0MS00OC40NjMsNDguNDYzczIxLjc0LDQ4LjQ2MyA0OC40NjMsNDguNDYzYzkuNjgsMCAxOS4wMjEtMi44NDQgMjcuMDE2LTguMjI0IDMuMDY0LTIuMDY0IDcuMDItMi4yNjkgMTAuMjgyLTAuNTMxIDMuMjYzLDEuNzM3IDUuMzAxLDUuMTMxIDUuMzAxLDguODI3djEwNy4zNjdjMCw1LjUyMy00LjQ3NywxMC0xMCwxMHptLTkxLjE5Mi0yMGg4MS4xOTJ2LTgxLjI1OGMtNy4yMDYsMi41Mi0xNC44MjcsMy44MTktMjIuNTk5LDMuODE5LTM3Ljc1MSwwLTY4LjQ2My0zMC43MTItNjguNDYzLTY4LjQ2MyAwLTM3Ljc1MSAzMC43MTItNjguNDYzIDY4LjQ2My02OC40NjMgNy43NzEsMCAxNS4zOTIsMS4yOTkgMjIuNTk5LDMuODE5di04MS4yNThoLTk3LjM1MWMtMy42OTQsMC03LjA4OS0yLjAzNy04LjgyNi01LjI5OC0xLjczNi0zLjI2MS0xLjUzNC03LjIxNCAwLjUyNy0xMC4yODEgNS4zNzEtNy45OTEgOC4yMTEtMTcuMzI2IDguMjExLTI2Ljk5NyAwLjAwMS0yNi43MjItMjEuNzQtNDguNDYyLTQ4LjQ2Mi00OC40NjJzLTQ4LjQ2MywyMS43NC00OC40NjMsNDguNDYzYzAsOS42NyAyLjg0LDE5LjAwNiA4LjIxMSwyNi45OTcgMi4wNjIsMy4wNjYgMi4yNjUsNy4wMiAwLjUyNywxMC4yODFzLTUuMTMxLDUuMjk4LTguODI2LDUuMjk4aC05Ny4zNTJ2OTcuMDAzYzAsMy42NzUtMi4wMTYsNy4wNTQtNS4yNSw4LjgtMy4yMzYsMS43NDctNy4xNjYsMS41NzctMTAuMjM4LTAuNDQtNy44OTYtNS4xODQtMTcuMDc1LTcuOTI0LTI2LjU0NC03LjkyNC0yNi43MjMsMC00OC40NjQsMjEuNzQxLTQ4LjQ2NCw0OC40NjNzMjEuNzQxLDQ4LjQ2MyA0OC40NjQsNDguNDYzYzkuNDY5LDAgMTguNjQ3LTIuNzQgMjYuNTQ0LTcuOTI0IDMuMDcyLTIuMDE3IDcuMDAyLTIuMTg3IDEwLjIzOC0wLjQ0IDMuMjM0LDEuNzQ2IDUuMjUsNS4xMjUgNS4yNSw4Ljh2OTcuMDA0aDgxLjE5M2MtMi40NzctNy4xNTEtMy43NTQtMTQuNzAzLTMuNzU0LTIyLjM5OCAwLTM3Ljc1MSAzMC43MTItNjguNDYzIDY4LjQ2My02OC40NjNzNjguNDYzLDMwLjcxMiA2OC40NjMsNjguNDYzYzAuMDAxLDcuNjk0LTEuMjc3LDE1LjI0NS0zLjc1MywyMi4zOTZ6IiBmaWxsPSIjRDgwMDI3Ii8+Cjwvc3ZnPgo=" /> 
                                                Matched jobs
                                            </h3>
                                            <div class="list-group">
                                                <div class="scoot-no-content _v2" ng-if="!vm.candidate.matches[0]">
                                                    <h2 translate="">
                                                        <span>No job matches appearing?</span>
                                                    </h2>
                                                    <p translate="">
                                                        <span>Update your profile to start getting them</span>
                                                    </p>
                                                    <a class="scoot-clickable" translate="" ui-sref="user-edit-profile.step-one" href="candidate-edit-1.php">
                                                        <span>Update my profile</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="block">
                                        <div class="inner">

                                            <h3 class="title">
                                                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3MS43MDEgNDcxLjcwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDcxLjcwMSA0NzEuNzAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCI+CjxnPgoJPHBhdGggZD0iTTQzMy42MDEsNjcuMDAxYy0yNC43LTI0LjctNTcuNC0zOC4yLTkyLjMtMzguMnMtNjcuNywxMy42LTkyLjQsMzguM2wtMTIuOSwxMi45bC0xMy4xLTEzLjEgICBjLTI0LjctMjQuNy01Ny42LTM4LjQtOTIuNS0zOC40Yy0zNC44LDAtNjcuNiwxMy42LTkyLjIsMzguMmMtMjQuNywyNC43LTM4LjMsNTcuNS0zOC4yLDkyLjRjMCwzNC45LDEzLjcsNjcuNiwzOC40LDkyLjMgICBsMTg3LjgsMTg3LjhjMi42LDIuNiw2LjEsNCw5LjUsNGMzLjQsMCw2LjktMS4zLDkuNS0zLjlsMTg4LjItMTg3LjVjMjQuNy0yNC43LDM4LjMtNTcuNSwzOC4zLTkyLjQgICBDNDcxLjgwMSwxMjQuNTAxLDQ1OC4zMDEsOTEuNzAxLDQzMy42MDEsNjcuMDAxeiBNNDE0LjQwMSwyMzIuNzAxbC0xNzguNywxNzhsLTE3OC4zLTE3OC4zYy0xOS42LTE5LjYtMzAuNC00NS42LTMwLjQtNzMuMyAgIHMxMC43LTUzLjcsMzAuMy03My4yYzE5LjUtMTkuNSw0NS41LTMwLjMsNzMuMS0zMC4zYzI3LjcsMCw1My44LDEwLjgsNzMuNCwzMC40bDIyLjYsMjIuNmM1LjMsNS4zLDEzLjgsNS4zLDE5LjEsMGwyMi40LTIyLjQgICBjMTkuNi0xOS42LDQ1LjctMzAuNCw3My4zLTMwLjRjMjcuNiwwLDUzLjYsMTAuOCw3My4yLDMwLjNjMTkuNiwxOS42LDMwLjMsNDUuNiwzMC4zLDczLjMgICBDNDQ0LjgwMSwxODcuMTAxLDQzNC4wMDEsMjEzLjEwMSw0MTQuNDAxLDIzMi43MDF6IiBmaWxsPSIjRDgwMDI3Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /> 
                                                Saved jobs
                                            </h3>
                                            
                                            <table align="center">
                                            <?php
                                                $sqlusercheck = "SELECT * FROM saved WHERE uid=\"$uid\" ORDER BY date_updated DESC LIMIT 3;";    
                                                $resusercheck = mysql_query($sqlusercheck);                                                                        
                                                $count=mysql_num_rows($resusercheck);
                                                if($count!=0)
                                                {
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

                                                    <tr style="border-bottom: 1px dotted #cccccc; padding: 10px; !important">
                                                        <td align="right">                                            
                                                            <br />
                                                            <img src="profile/<?php echo $bimage; ?>" width="80" />&nbsp;
                                                            <br /><br />
                                                        </td>
                                                        <td align="left">
                                                            <a href="http://myjob.sa/main/candidate-savedjobs.php"><?php echo $jobtitle; ?>
                                                                <br />
                                                                <b><?php echo $bname; ?></b></a>
                                                            <br />
                                                            <?php echo time_elapsed_string($date_updated, true); ?>
                                                        </td>                                                            
                                                    </tr>

                                                    <?php 
                                                    }
                                                }
                                                else
                                                {                                                                                                    
                                                ?>

                                                <div class="list-group">
                                                    <div class="scoot-no-content _v2" ng-if="!vm.candidate.shorList[0]">
                                                        <h2 translate="">
                                                            <span>Like a job? Save it for later</span>
                                                        </h2>
                                                        <p translate="">
                                                            <span>Saved jobs will appear here</span>
                                                        </p>
                                                        <a class="scoot-clickable" translate="" ui-sref="search" href="search.php">
                                                            <span>Search for a job</span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <?php } ?>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="block">
                                        <div class="inner">
                                            <h3 class="title">
                                                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ5Ljk0IDQ5Ljk0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0OS45NCA0OS45NDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIzMnB4IiBoZWlnaHQ9IjMycHgiPgo8cGF0aCBkPSJNNDguODU2LDIyLjczMWMwLjk4My0wLjk1OCwxLjMzLTIuMzY0LDAuOTA2LTMuNjcxYy0wLjQyNS0xLjMwNy0xLjUzMi0yLjI0LTIuODkyLTIuNDM4bC0xMi4wOTItMS43NTcgIGMtMC41MTUtMC4wNzUtMC45Ni0wLjM5OC0xLjE5LTAuODY1TDI4LjE4MiwzLjA0M2MtMC42MDctMS4yMzEtMS44MzktMS45OTYtMy4yMTItMS45OTZjLTEuMzcyLDAtMi42MDQsMC43NjUtMy4yMTEsMS45OTYgIEwxNi4zNTIsMTRjLTAuMjMsMC40NjctMC42NzYsMC43OS0xLjE5MSwwLjg2NUwzLjA2OSwxNi42MjNDMS43MSwxNi44MiwwLjYwMywxNy43NTMsMC4xNzgsMTkuMDYgIGMtMC40MjQsMS4zMDctMC4wNzcsMi43MTMsMC45MDYsMy42NzFsOC43NDksOC41MjhjMC4zNzMsMC4zNjQsMC41NDQsMC44ODgsMC40NTYsMS40TDguMjI0LDQ0LjcwMiAgYy0wLjIzMiwxLjM1MywwLjMxMywyLjY5NCwxLjQyNCwzLjUwMmMxLjExLDAuODA5LDIuNTU1LDAuOTE0LDMuNzcyLDAuMjczbDEwLjgxNC01LjY4NmMwLjQ2MS0wLjI0MiwxLjAxMS0wLjI0MiwxLjQ3MiwwICBsMTAuODE1LDUuNjg2YzAuNTI4LDAuMjc4LDEuMSwwLjQxNSwxLjY2OSwwLjQxNWMwLjczOSwwLDEuNDc1LTAuMjMxLDIuMTAzLTAuNjg4YzEuMTExLTAuODA4LDEuNjU2LTIuMTQ5LDEuNDI0LTMuNTAyICBMMzkuNjUxLDMyLjY2Yy0wLjA4OC0wLjUxMywwLjA4My0xLjAzNiwwLjQ1Ni0xLjRMNDguODU2LDIyLjczMXogTTM3LjY4MSwzMi45OThsMi4wNjUsMTIuMDQyYzAuMTA0LDAuNjA2LTAuMTMxLDEuMTg1LTAuNjI5LDEuNTQ3ICBjLTAuNDk5LDAuMzYxLTEuMTIsMC40MDUtMS42NjUsMC4xMjFsLTEwLjgxNS01LjY4N2MtMC41MjEtMC4yNzMtMS4wOTUtMC40MTEtMS42NjctMC40MTFzLTEuMTQ1LDAuMTM4LTEuNjY3LDAuNDEybC0xMC44MTMsNS42ODYgIGMtMC41NDcsMC4yODQtMS4xNjgsMC4yNC0xLjY2Ni0wLjEyMWMtMC40OTgtMC4zNjItMC43MzItMC45NC0wLjYyOS0xLjU0N2wyLjA2NS0xMi4wNDJjMC4xOTktMS4xNjItMC4xODYtMi4zNDgtMS4wMy0zLjE3ICBMMi40OCwyMS4yOTljLTAuNDQxLTAuNDMtMC41OTEtMS4wMzYtMC40LTEuNjIxYzAuMTktMC41ODYsMC42NjctMC45ODgsMS4yNzYtMS4wNzdsMTIuMDkxLTEuNzU3ICBjMS4xNjctMC4xNjksMi4xNzYtMC45MDEsMi42OTctMS45NTlsNS40MDctMTAuOTU3YzAuMjcyLTAuNTUyLDAuODAzLTAuODgxLDEuNDE4LTAuODgxYzAuNjE2LDAsMS4xNDYsMC4zMjksMS40MTksMC44ODEgIGw1LjQwNywxMC45NTdjMC41MjEsMS4wNTgsMS41MjksMS43OSwyLjY5NiwxLjk1OWwxMi4wOTIsMS43NTdjMC42MDksMC4wODksMS4wODYsMC40OTEsMS4yNzYsMS4wNzcgIGMwLjE5LDAuNTg1LDAuMDQxLDEuMTkxLTAuNCwxLjYyMWwtOC43NDksOC41MjhDMzcuODY2LDMwLjY1LDM3LjQ4MSwzMS44MzUsMzcuNjgxLDMyLjk5OHoiIGZpbGw9IiNEODAwMjciLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /> 
                                                Applied jobs
                                            </h3>
                                            <table align="center">
                                            <?php
                                                $sqlusercheck = "SELECT * FROM applied WHERE uid=\"$uid\" ORDER BY date_updated DESC LIMIT 3;";    
                                                $resusercheck = mysql_query($sqlusercheck);                                                                        
                                                $count=mysql_num_rows($resusercheck);
                                                if($count!=0)
                                                {
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

                                                    <tr style="border-bottom: 1px dotted #cccccc; padding: 10px; !important">
                                                        <td align="right">                                            
                                                            <br />
                                                            <img src="profile/<?php echo $bimage; ?>" width="80" />&nbsp;
                                                            <br /><br />
                                                        </td>
                                                        <td align="left">
                                                            <a href="http://myjob.sa/main/candidate-appliedjobs.php"><?php echo $jobtitle; ?>
                                                                <br />
                                                                <b><?php echo $bname; ?></b></a>
                                                            <br />
                                                            <?php echo time_elapsed_string($date_updated, true); ?>
                                                        </td>                                                            
                                                    </tr>

                                                    <?php 
                                                    }
                                                }
                                                else
                                                {                                                                                                    
                                                ?>

                                                <div class="list-group">
                                                <div class="scoot-no-content _v2" ng-if="!vm.candidate.applications[0]">
                                                    <h2 translate="">
                                                        <span>Get employed!</span>
                                                    </h2>
                                                    <p translate="">
                                                        <span>Applied jobs will appear here</span>
                                                    </p>
                                                    <a class="scoot-clickable" translate="" ui-sref="search" href="search.php">
                                                        <span>Search for a job</span>
                                                    </a>
                                                </div>
                                            </div>

                                                <?php } ?>
                                                </table>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="container">
                                <div class="interviews user-interviews block block-left col-xs-12 col-sm-6">
                                    <div class="inner">
                                        <h2 class="title">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ4OS41NTMgNDg5LjU1MyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDg5LjU1MyA0ODkuNTUzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCI+CjxwYXRoIGQ9Ik00NzYuMjc2LDI5MS4xNWgtMi42MzJWMTQ3LjM5NGMtMC4wMDQtMTQuNDM2LTExLjc1LTI2LjE4MS0yNi4xODYtMjYuMTgybC03My43MzMsMCAgYzMwLjk0My0yLjc2Niw1NS4yODQtMjguODI2LDU1LjI4NC02MC40NzhDNDI5LjAxLDI3LjI0NSw0MDEuNzY1LDAsMzY4LjI3NiwwYy0zMy40ODksMC02MC43MzQsMjcuMjQ1LTYwLjczNCw2MC43MzQgIGMwLDMxLjY1MSwyNC4zNCw1Ny43MTEsNTUuMjg0LDYwLjQ3OGwtNzMuNzM1LTAuMDAxYy0xNC40MzcsMC0yNi4xODQsMTEuNzQ2LTI2LjE4NSwyNi4xODRsMCwxNDMuNzU1aC0zNi45NzcgIGM0Ljc2OS00Ljc0NSw3LjcyNi0xMS4zMDksNy43MjYtMTguNTUyVjE0Ny4zOTRjLTAuMDA0LTE0LjQzNi0xMS43NTEtMjYuMTgxLTI2LjE4Ni0yNi4xODJsLTczLjczMywwICBjMzAuOTQzLTIuNzY2LDU1LjI4NC0yOC44MjYsNTUuMjg0LTYwLjQ3OEMxODkuMDIyLDI3LjI0NSwxNjEuNzc3LDAsMTI4LjI4OSwwQzk0Ljc5OSwwLDY3LjU1NCwyNy4yNDUsNjcuNTU0LDYwLjczNCAgYzAsMzEuNjUxLDI0LjM0LDU3LjcxMSw1NS4yODQsNjAuNDc4bC03My43MzUtMC4wMDFjLTE0LjQzNywwLTI2LjE4NCwxMS43NDYtMjYuMTg0LDI2LjE4NGwwLDEyNS4yMDEgIGMwLDcuMjQzLDIuOTU4LDEzLjgwOSw3LjcyOCwxOC41NTRIMTMuMjc2Yy03LjE4LDAtMTMsNS44Mi0xMywxM2MwLDcuMTgsNS44MiwxMywxMywxM2gzNi44OHYxMzcuNjgxICBjMCwxOS4xNDYsMTUuNTc2LDM0LjcyMiwzNC43MjIsMzQuNzIyaDcuNjA0YzE3LjkyLDAsMzIuMTU3LTEzLjYwOCwzNC42Mi0zMy4wOTJjMC4zMjUtMi41NzEsMC43MjItNS42MjQsMS4xNzUtOS4wNDMgIGMwLjQ2NSwzLjQ3LDAuODcyLDYuNTQzLDEuMjAyLDkuMDg1YzIuNTIzLDE5LjQ2LDE2Ljc1NywzMy4wNSwzNC42MTQsMzMuMDVoNy42MDRjMTkuMTQ2LDAsMzQuNzI0LTE1LjU3NiwzNC43MjQtMzQuNzIyVjMxNy4xNSAgaDI2OS44NTdjNy4xOCwwLDEzLTUuODIsMTMtMTNDNDg5LjI3NiwyOTYuOTcsNDgzLjQ1NiwyOTEuMTUsNDc2LjI3NiwyOTEuMTV6IE0zMzMuNTQyLDYwLjczNCAgYzAtMTkuMTUyLDE1LjU4Mi0zNC43MzQsMzQuNzM0LTM0LjczNGMxOS4xNTIsMCwzNC43MzMsMTUuNTgyLDM0LjczMywzNC43MzRjMCwxOS4xNTMtMTUuNTgxLDM0LjczNC0zNC43MzMsMzQuNzM0ICBDMzQ5LjEyNCw5NS40NjgsMzMzLjU0Miw3OS44ODcsMzMzLjU0Miw2MC43MzR6IE05My41NTQsNjAuNzM0QzkzLjU1NCw0MS41ODIsMTA5LjEzNiwyNiwxMjguMjg5LDI2ICBjMTkuMTUyLDAsMzQuNzMzLDE1LjU4MiwzNC43MzMsMzQuNzM0YzAsMTkuMTUzLTE1LjU4MSwzNC43MzQtMzQuNzMzLDM0LjczNEMxMDkuMTM2LDk1LjQ2OCw5My41NTQsNzkuODg3LDkzLjU1NCw2MC43MzR6ICAgTTI4OC45MDcsMTQ3LjM5NmMwLTAuMTAyLDAuMDgzLTAuMTg1LDAuMTg1LTAuMTg1bDU1LjI0MywwLjAwMWwxMC4xNjQsMTIuNzM1bC0xMi43ODMsNzYuMDA3ICBjLTAuNjQ2LDMuODQzLDAuNDY1LDcuNzczLDMuMDI5LDEwLjcwOGwxMy43NCwxNS43M2MyLjQ2OCwyLjgyNiw2LjAzOCw0LjQ0OCw5Ljc5LDQuNDQ4YzMuNzUyLDAsNy4zMjItMS42MjIsOS43OTEtNC40NDcgIGwxMy43NC0xNS43MjljMi41NjQtMi45MzUsMy42NzYtNi44NjYsMy4wMjktMTAuNzA5bC0xMi43ODMtNzYuMDA3bDEwLjE2NS0xMi43MzVsNTUuMjQsMC4wMDFjMC4xMDMsMCwwLjE4NywwLjA4NSwwLjE4NywwLjE4NiAgVjI5MS4xNUgyODguOTA3TDI4OC45MDcsMTQ3LjM5NnogTTE4MC40MTksMjg1Ljc4MnYxNjkuMDQ5YzAsNC44MS0zLjkxNCw4LjcyMi04LjcyNCw4LjcyMmgtNy42MDQgIGMtNS45MDYsMC04LjMyOS02LjUzNC04LjgzLTEwLjM5NWMtMy4yNi0yNS4xMzMtMTMuOTkzLTEwMS42MjItMTQuMTAxLTEwMi4zOTJjLTAuOTAxLTYuNDE2LTYuMzg3LTExLjE4OS0xMi44NjYtMTEuMTkzICBjLTAuMDAzLDAtMC4wMDUsMC0wLjAwOCwwYy02LjQ3NSwwLTExLjk2Myw0Ljc2Ni0xMi44NzIsMTEuMTc3Yy0wLjEwNywwLjc2LTEwLjgwNCw3Ni4zMDYtMTQuMTA5LDEwMi40NSAgYy0wLjQ4NiwzLjg0NS0yLjg5MiwxMC4zNTMtOC44MjUsMTAuMzUzaC03LjYwNGMtNC44MSwwLTguNzIyLTMuOTEzLTguNzIyLTguNzIyVjI4NS43ODJjMC03LjE4LTUuODItMTMtMTMtMTNoLTE0LjA1ICBjLTAuMTAzLDAtMC4xODctMC4wODMtMC4xODctMC4xODZsMC0xMjUuMmMwLTAuMTAyLDAuMDgzLTAuMTg1LDAuMTg1LTAuMTg1bDE1OC4zNjcsMC4wMDFjMC4xMDMsMCwwLjE4NywwLjA4NSwwLjE4NywwLjE4NnYxMjUuMjAxICBjMCwwLjEwMS0wLjA4MywwLjE4NC0wLjE4NiwwLjE4NGgtMTQuMDUyQzE4Ni4yNCwyNzIuNzgyLDE4MC40MTksMjc4LjYwMiwxODAuNDE5LDI4NS43ODJ6IiBmaWxsPSIjRDgwMDI3Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /> 
                                            Interviews
                                        </h2>
                                        <div ng-if="!vm.candidate.interviews[0]">
                                            <h5 class="subtitle" translate="">
                                                <span>Your interview schedule will be appearing here</span>
                                            </h5>

                                            <table align="center">
                                                <?php
                                                    $sqlm = "SELECT * FROM messages WHERE uid=$uid AND status=2 ORDER BY date_sent DESC LIMIT 3;";
                                                    $resm = mysql_query($sqlm);
                                                    if(mysql_num_rows($resm) != 0) 
                                                    {                                                                                                                    
                                                        while($rowm = mysql_fetch_array($resm)) 
                                                        {
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
                                                        ?>

                                                        <tr style="border-bottom: 1px dotted #cccccc; padding: 10px; !important">
                                                            <td align="right">                                            
                                                                <br />
                                                                <img src="profile/<?php echo $image; ?>" width="80" />&nbsp;
                                                                <br /><br />
                                                            </td>
                                                            <td align="left">
                                                                <a href="candidate-view-messages.php?mid=<?php echo $mid; ?>"><?php echo $jobtitle; ?>
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
                                                            <span>Apply to jobs to start getting them</span>
                                                        </p>
                                                        <a class="scoot-clickable" translate="" ui-sref="search" href="search.php">
                                                            <span>Search for a job</span>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="videoPlayer" class="user-intro-video block block-right col-xs-12 col-sm-6">
                                    <div class="inner">
                                        <h2 class="title" ng-if="(vm.candidate.videoIntro == '' || vm.candidate.videoIntro === undefined)">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE5Ni41MzYgMTk2LjUzNiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTk2LjUzNiAxOTYuNTM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTE2NC4wMzcsNzAuMzg1Yy0xLjQ3MS0xLjM4NS0zLjMtMi4xMzctNS4yMDctMi4xMzdoLTExLjQ2N2MtMC42OTEsMC0xLjM2LDAuMDg5LTIuMDE1LDAuMjgzICAgIFY1Ni41NjRjMC02LjE5NS01LjA0My0xMS4yMzgtMTEuMjQxLTExLjIzOEgxMS4yMzhDNS4wNDMsNDUuMzI2LDAsNTAuMzY5LDAsNTYuNTY0djgzLjQwOWMwLDYuMTk1LDUuMDQzLDExLjIzOCwxMS4yMzgsMTEuMjM4ICAgIGgxMjIuODY5YzYuMTk1LDAsMTEuMjQxLTUuMDM5LDExLjI0MS0xMS4yMzh2LTExLjk3NWMwLjY1OCwwLjE5LDEuMzMxLDAuMjgzLDIuMDE1LDAuMjgzaDExLjQ2N2MxLjU0MiwwLDMuMDI4LTAuNDksNC4zMjctMS40MTQgICAgbDMzLjM4LDkuMjQxVjYxLjM5NUwxNjQuMDM3LDcwLjM4NXogTTE2Ni45MDcsMTIxLjMzN1Y3Ni4xNjJsMjMuMjk4LTYuNDQ2djU4LjA2N0wxNjYuOTA3LDEyMS4zMzd6IE0xNDUuNjE2LDc3LjIzNSAgICBjMC0xLjM4OSwwLjgyNy0yLjY1OSwxLjc0My0yLjY1OWgxMS40NjdjMC44MiwwLDEuNzQzLDEuMTM4LDEuNzQzLDIuNjU5djQyLjA2MmMwLDEuNTE0LTAuOTIzLDIuNjQ4LTEuNzQzLDIuNjQ4aC0xMS40NjcgICAgYy0wLjkxNiwwLTEuNzQzLTEuMjY3LTEuNzQzLTIuNjQ4Vjc3LjIzNXogTTYuMzM1LDU2LjU2YzAtMi43MDYsMi4yMDUtNC45MDcsNC45MDctNC45MDdIMTM0LjExYzIuNzA5LDAsNC45MDcsMi4yMDEsNC45MDcsNC45MDcgICAgdjgzLjQwOWMwLDIuNzAyLTIuMTk3LDQuOTAzLTQuOTA3LDQuOTAzSDExLjIzOGMtMi42OTgsMC00LjkwNy0yLjIwMS00LjkwNy00LjkwM1Y1Ni41Nkg2LjMzNXoiIGZpbGw9IiNEODAwMjciLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /> 
                                            Record your introduction video
                                        </h2>
                                        <div ng-if="(vm.candidate.videoIntro == '' || vm.candidate.videoIntro === undefined)">
                                            <h5 class="subtitle" translate="">
                                                <span>People with video introductions receive up to twice more job invites</span>
                                            </h5>
                                        </div>
                                        <div class="candidate-video">
                                            <video-recorder user="vm.candidate.id" videointro="vm.candidate.videoIntro">
                                                <div class="">
                                                    <div class="embed-responsive embed-responsive-4by3 ng-hide" ng-hide="(videointro == '' || videointro === undefined)">
                                                        <video id="video" controls="" autobuffer=""></video>
                                                    </div>
                                                </div>
                                                <div class="row" ng-hide="!(videointro == '' || videointro === undefined)">
                                                    <div class="col-xs-12 col-md-10 col-md-push-1 scoot-no-content _v2">
                                                        <div class="text-center">
                                                            <div class="">
                                                                <h2 translate="">
                                                                    <span>Upload or record a video</span>
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-xs-12 ng-hide" ng-hide="(videointro == '' || videointro === undefined)">
                                                    <div class="video-btn-wrap">
                                                        <button class="btn btn-md btn-red" disabled="" ng-click="recordVideo()">Record New</button>
                                                        <button class="btn btn-md btn-grey float-right" disabled="" ng-click="deleteVideo()">Delete Existing Video</button>
                                                        <button class="btn btn-md btn-red ng-hide" ng-click="uploadVideo()" ng-hide="true">Upload Video</button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-10 col-md-push-1" ng-hide="!(videointro == '' || videointro === undefined)">
                                                    <div class="row record-upload-buttons">
                                                        <button class="btn btn-md btn-red" disabled="" ng-click="recordVideo()">Record New</button>
                                                        <button class="btn btn-md btn-red" disabled="" ng-click="uploadVideo()">Upload Video</button>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="gap-20"></div>
                                            </video-recorder>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="coming-soon">
                                            <div class="vertical-center">
                                                <h2 class="coming-soon-text">Coming Soon</h2>
                                            </div>
                                        </div>
                                    </div>
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