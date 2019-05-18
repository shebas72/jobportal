<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Settings - myjob.sa</title>
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
                                <?php include('company-topmenu.php'); ?>
                                <div class="clearfix"></div>
                                <ul class="nav navbar-nav nav-secondary visible-xs">
                                    <li class="" ui-sref-active="active" ng-if="isCompany() && !isCompanyRegistration()">
                                        <a translate="" ui-sref="company" href="company-dashboard.php">
                                            <span>Account Overview</span>
                                        </a>
                                    </li>
                                    
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
                                    </ul>
                                </li>
                                <li class="" ng-if="theCurrentBusiness" ui-sref-active="active">
                                    <a ui-sref="business-jobs.live({businessId: theCurrentBusiness.id})" href="#">Settings</a>
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
                <div class="register-page">
                    <div class="user-setting-page">
                        <div class="container panel row-2">
                            <div class="sub-panel">
                                <div class="col-xs-12">
                                    <h3 translate="">
                                        <span>Settings</span>
                                    </h3>
                                    <p translate="">
                                        <span>Change settings for your account or your organizations.</span>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="sub-panel">
                                <div class="col-md-8 col-lg-6">
                                    <form class="ng-pristine ng-invalid ng-invalid-required ng-valid-pattern ng-valid-compare-to" novalidate="" name="settingsForm" ng-submit="submit(settingsForm.$valid)">
                                        <div class="form-group">
                                            <label class="control-label" translate="" for="old-password">
                                                <span>Old password</span>
                                            </label>
                                            <input id="old-password" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="password" ng-required="true" name="oldPassword" ng-pattern="/^.{6,16}$/" ng-change="wrongOldPassword = false" ng-model="oldPassword" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" translate="" for="password">
                                                <span>New Password</span>
                                            </label>
                                            <input id="password" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="password" ng-required="true" name="password" ng-pattern="/^.{6,16}$/" ng-model="company.password" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" translate="" for="confirm-password">
                                                <span>Confirm New Password</span>
                                            </label>
                                            <input id="confirm-password" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-compare-to" type="password" ng-required="true" name="confirmpassword" ng-pattern="/^.{6,16}$/" compare-to="company.password" ng-model="confpassword" required="required">
                                        </div>
                                        <div class="text-left">
                                            <input class="btn btn-md btn-red" type="submit" value="Update credentials">
                                        </div>
                                    </form>
                                </div>
                                <div class="hidden-xs hidden-sm col-md-4 col-lg-6">
                                    <div class="setting-icon">
                                        <img class="img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASgAAAEoAQMAAADRyf5aAAAABlBMVEVHcEwjHyBTFVK+AAAAAnRSTlMADH8lgRMAAAZ8SURBVHhexZk/jvw0FMdfCFIkKHwBND4CF1iNWzpaur3GFqNJuAsFHTdgjbgAR7BEwXa4oLBQyEMez+Q7WfvF2Yx+4GI2yn7i+D2/f34hcbSOqPVUGSYQKa5ADY9Emu061fFEZDhUXjhFykzrFHtNdGp5WINaHtRAL9S71WWNpAYKpFcXpj11tvHUrS6st4lqeJWKyo/q79eo8UbpNSEDUeM7S9SJVCQiGYnO1ii1heqZ1inaTpkpUhUZSW+ivviGiNQa9XK7UPQwdZqN43Hq6XZxeJw64mJlHD5GPa1Rpj5Xa0EZ6nyZUiNNMzWYsUxptvN/1K8suKThf8JMMbPgjMweAWPSwiYqdqC8YGKhYVg7k0Td/yMIDtL4TH0lymUxXYj00lP5G758w...GaYjRRQjSpRKZ3Ue6tSPVLSrMvRMxXtgtKlaLvM/OwI5LTa8oKy9zB/h3V9IUM8xdRhmXZKuzMfHIWlfN2J2fkrAYYxErBorOnq1UHSVQrVDBiNdRUaiaaaGafdlRpUsUXZEqFuY192luJoqr1xCM8JteqUCHXqu3dlTtOAQ5LkM9IP6KU33s6GTeddIJwp3YCG3ec5uST4c5TphZOrHVqz0laPrv//9ThE3cLtqlw2LXbdbFhhZDqkIUAobOVfeyVumSCpxlOYil2Uh8Ap/v4N5canUC96ASWY047Kr52FSf5hN/5Zrp2KPskJ8ai22muD5ihHAubEZ3TgbQtqotoiu9QV5PpfJupCx1dvejoFga6w13qDhcp9adHD5m4zxQhda0x5A54eWTd9OL4Gf17xMZ8gKoMtYnqtlO6StlHqfz7UH2uOtU+TGXfwB6m8NWtSvEbPY81Cl8D5YHaRB74SlmlPmP+m8rjXzWqs2WGHb8OAAAAAElFTkSuQmCC">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="sub-panel">
                                <div class="col-xs-12">
                                    <h3 translate="">
                                        <span>Delete Account</span>
                                    </h3>
                                    <p translate="">
                                        <span>Deleting your account will remove all of your information from our database. This cannot be undone.</span>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-left col-xs-12">
                                    <a class="btn btn-md btn-light-grey" translate="" hd-confirm-word="DELETE" hd-confirm="Please type DELETE below to confirm this action" ng-click="deleteAccount()">
                                        <span>Delete account</span>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
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