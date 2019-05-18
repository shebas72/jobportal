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
        
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Interviews - myjob.sa</title>
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
                                        <li ui-sref-active="active" ng-if="isCandidate()" class="active">
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
                                    <li ui-sref-active="active" class="active">
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
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU2IDU2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1NiA1NjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiPgo8Zz4KCTxnPgoJPC9nPgoJPGc+CgkJPHBhdGggZD0iTTEyLDI0YzMuMzA5LDAsNi0yLjY5MSw2LTZzLTIuNjkxLTYtNi02cy02LDIuNjkxLTYsNlM4LjY5MSwyNCwxMiwyNHogTTEyLDE0YzIuMjA2LDAsNCwxLjc5NCw0LDRzLTEuNzk0LDQtNCw0ICAgIHMtNC0xLjc5NC00LTRTOS43OTQsMTQsMTIsMTR6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPHBhdGggZD0iTTQ0LDI0YzMuMzA5LDAsNi0yLjY5MSw2LTZzLTIuNjkxLTYtNi02cy02LDIuNjkxLTYsNlM0MC42OTEsMjQsNDQsMjR6IE00NCwxNGMyLjIwNiwwLDQsMS43OTQsNCw0cy0xLjc5NCw0LTQsNCAgICBzLTQtMS43OTQtNC00UzQxLjc5NCwxNCw0NCwxNHoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cGF0aCBkPSJNNTQsMjZ2MTNjMCwxLjY1NC0xLjM0NiwzLTMsM1YzMWMwLTIuNzU3LTIuMjQzLTUtNS01aC01Yy0wLjU1MiwwLTEsMC40NDgtMSwxdjR2MXYxaC04Yy0wLjU1MiwwLTEsMC40NDgtMSwxdjNoLTZ2LTMgICAgYzAtMC41NTItMC40NDgtMS0xLTFoLTh2LTF2LTF2LTRjMC0wLjU1Mi0wLjQ0OC0xLTEtMWgtNWMtMi43NTcsMC01LDIuMjQzLTUsNXYxMWMtMS42NTQsMC0zLTEuMzQ2LTMtM1YyNkgwdjEzICAgIGMwLDIuMDQ1LDEuMjM3LDMuODAyLDMsNC41NzZWNTZoMlY0NGgxaDFoOHYxMWMwLDAuNTUyLDAuNDQ4LDEsMSwxaDNoMWgxdi0xVjQwdi0xaDNoOGgzdjF2MTV2MWgxaDFoM2MwLjU1MiwwLDEtMC40NDgsMS0xVjQ0aDggICAgaDFoMXYxMmgyVjQzLjU3NmMxLjc2My0wLjc3NCwzLTIuNTMxLDMtNC41NzZWMjZINTR6IE0yMCwzN2gtMmgtNnYtNmgtMnY3YzAsMC41NTIsMC40NDgsMSwxLDFoN2MwLjU1MSwwLDEsMC40NDksMSwxdjE0aC0yVjQzICAgIGMwLTAuNTUyLTAuNDQ4LTEtMS0xSDdWMzFjMC0xLjY1NCwxLjM0Ni0zLDMtM2g0djN2MXYyYzAsMC41NTIsMC40NDgsMSwxLDFoOHYySDIweiBNNDAsNDJjLTAuNTUyLDAtMSwwLjQ0OC0xLDF2MTFoLTJWNDAgICAgYzAtMC41NTEsMC40NDktMSwxLTFoN2MwLjU1MiwwLDEtMC40NDgsMS0xdi03aC0ydjZoLTZoLTJoLTN2LTJoOGMwLjU1MiwwLDEtMC40NDgsMS0xdi0ydi0xdi0zaDRjMS42NTQsMCwzLDEuMzQ2LDMsM3YxMUg0MHoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cGF0aCBkPSJNMTksMTB2M2MwLDAuNDMxLDAuMjc1LDAuODEyLDAuNjg0LDAuOTQ5QzE5Ljc4OCwxMy45ODMsMTkuODk1LDE0LDIwLDE0YzAuMzA5LDAsMC42MDctMC4xNDQsMC44LTAuNGwyLjctMy42SDMxICAgIGMxLjY1NCwwLDMtMS4zNDYsMy0zVjNjMC0xLjY1NC0xLjM0Ni0zLTMtM0gxOWMtMS42NTQsMC0zLDEuMzQ2LTMsM3Y0QzE2LDguNjU0LDE3LjM0NiwxMCwxOSwxMHogTTE4LDNjMC0wLjU1MSwwLjQ0OS0xLDEtMWgxMiAgICBjMC41NTEsMCwxLDAuNDQ5LDEsMXY0YzAsMC41NTEtMC40NDksMS0xLDFoLThjLTAuMzE1LDAtMC42MTEsMC4xNDgtMC44LDAuNEwyMSwxMFY5YzAtMC41NTItMC40NDgtMS0xLTFoLTEgICAgYy0wLjU1MSwwLTEtMC40NDktMS0xVjN6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPHJlY3QgeD0iMjAiIHk9IjQiIHdpZHRoPSIxMCIgaGVpZ2h0PSIyIiBmaWxsPSIjRkZGRkZGIi8+CgkJPHJlY3QgeD0iMjciIHk9IjI1IiB3aWR0aD0iNiIgaGVpZ2h0PSIyIiBmaWxsPSIjRkZGRkZGIi8+CgkJPHBhdGggZD0iTTI2LDIxYy0xLjY1NCwwLTMsMS4zNDYtMywzdjRjMCwxLjY1NCwxLjM0NiwzLDMsM2g4YzEuNjU0LDAsMy0xLjM0NiwzLTN2LTAuNjk3bDEuODMyLTIuNzQ4ICAgIGMwLjIwNS0wLjMwNywwLjIyNC0wLjcwMSwwLjA1LTEuMDI2QzM4LjcwOCwyMy4yMDMsMzguMzY5LDIzLDM4LDIzaC0xLjE3MWMtMC40MTMtMS4xNjQtMS41MjUtMi0yLjgyOS0ySDI2eiBNMzUsMjQgICAgYzAsMC41NTIsMC40NDgsMSwxLDFoMC4xMzFsLTAuOTYzLDEuNDQ1QzM1LjA1OSwyNi42MDksMzUsMjYuODAzLDM1LDI3djFjMCwwLjU1MS0wLjQ0OSwxLTEsMWgtOGMtMC41NTEsMC0xLTAuNDQ5LTEtMXYtNCAgICBjMC0wLjU1MSwwLjQ0OS0xLDEtMWg4QzM0LjU1MSwyMywzNSwyMy40NDksMzUsMjR6IiBmaWxsPSIjRkZGRkZGIi8+CgkJPHJlY3QgeD0iMjMiIHk9IjE2IiB3aWR0aD0iMiIgaGVpZ2h0PSIyIiBmaWxsPSIjRkZGRkZGIi8+CgkJPHJlY3QgeD0iMjciIHk9IjE2IiB3aWR0aD0iMiIgaGVpZ2h0PSIyIiBmaWxsPSIjRkZGRkZGIi8+CgkJPHJlY3QgeD0iMzEiIHk9IjE2IiB3aWR0aD0iMiIgaGVpZ2h0PSIyIiBmaWxsPSIjRkZGRkZGIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                                        </span>
                                    </div>
                                    <div class="content">
                                        <table width="100%">

                                            <?php
                                                $sqlm = "SELECT * FROM messages WHERE uid=$uid AND status=2 ORDER BY date_sent DESC;";
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
                                                            <img src="profile/<?php echo $image; ?>" width="50" />&nbsp;
                                                            <br /><br />
                                                        </td>
                                                        <td align="left">
                                                            <a href="candidate-view-messages.php?mid=<?php echo $mid; ?>"><?php echo $jobtitle; ?>
                                                                <br />
                                                                <b><?php echo $name; ?></b></a>
                                                        </td>
                                                        <td>
                                                            <?php echo time_elapsed_string($mdate, true); ?>
                                                        </td>
                                                    </tr>

                                                    <?php 
                                                    }
                                                }
                                                else
                                                {
                                                ?>                                                                    

                                                <span class="title">
                                                        Looks like you don't
                                                        <br>
                                                        have any interviews scheduled.
                                                    </span>
                                                    <span class="msg">
                                                        Apply for some jobs now
                                                        <br>
                                                        and get fixed by companies for interviews.
                                                    </span>
                                                    <a class="btn btn-md btn-red" href="search.php" ui-sref="user-edit-profile.step-one">
                                                        <span>Search Jobs</span>
                                                    </a>
                                                </div>

                                                <?php                                    
                                                }                                
                                            ?>

                                        </table>                                        
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