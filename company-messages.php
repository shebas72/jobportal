<?php
    session_start();

    $mid=$_GET['mid'];
    $action=$_GET['action'];

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

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
            <title page-title="">Messages - myjob.sa</title>
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
                    <div>
                        <div class="user-jobs-page">
                            <div class="notify-modal" ng-if="vm.totalItems.count == 0">
                                <div class="wrapper">

                                    <div class="header">
                                        <span class="icon">
                                            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDE0IDE0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxNCAxNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik03LDlMNS4yNjgsNy40ODRsLTQuOTUyLDQuMjQ1QzAuNDk2LDExLjg5NiwwLjczOSwxMiwxLjAwNywxMmgxMS45ODYgICAgYzAuMjY3LDAsMC41MDktMC4xMDQsMC42ODgtMC4yNzFMOC43MzIsNy40ODRMNyw5eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik0xMy42ODQsMi4yNzFDMTMuNTA0LDIuMTAzLDEzLjI2MiwyLDEyLjk5MywySDEuMDA3QzAuNzQsMiwwLjQ5OCwyLjEwNCwwLjMxOCwyLjI3M0w3LDggICAgTDEzLjY4NCwyLjI3MXoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cG9seWdvbiBwb2ludHM9IjAsMi44NzggMCwxMS4xODYgNC44MzMsNy4wNzkgICAiIGZpbGw9IiNGRkZGRkYiLz4KCQk8cG9seWdvbiBwb2ludHM9IjkuMTY3LDcuMDc5IDE0LDExLjE4NiAxNCwyLjg3NSAgICIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
                                        </span>
                                    </div>

                                    <div class="content">

                                        <table width="100%">

                                            <?php                                                                                                

                                                $sqlm = "SELECT * FROM messages WHERE cid=$cid ORDER BY date_sent DESC;";
                                                $resm = mysql_query($sqlm);
                                                if(mysql_num_rows($resm) != 0) 
                                                {                                                                                                                    

                                                    while($rowm = mysql_fetch_array($resm)) 
                                                    {
                                                        $mid = $rowm['id'];
                                                        $jid = $rowm['jid'];
                                                        $status = $rowm['status'];                                
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
                                                            <a href="company-view-messages.php?mid=<?php echo $mid; ?>"><?php echo $jobtitle; ?>
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
                                                    have any messages yet.
                                                </span>
                                                <span class="msg">Send messages to applicants to get your conversation started.</span>
                                                <a class="btn btn-md btn-red" href="company-dashboard.php" ui-sref="business-jobs.live({businessId: companyId})">
                                                    <span>Post A Job</span>
                                                </a>                                    

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
            </div>         </div>
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