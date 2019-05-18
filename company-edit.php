<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Edit Company - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles/styles.min.css?v=9022" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body class="" style="">
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
                                <li class="" ng-if="!theCurrentBusiness" ui-sref-active="active">
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
                <div class="user-edit-page user-register-page container post-a-job">
                    <div class="container">
                        <div class="company-register">
                            <div class="step-wrapper"></div>
                            <div class="page-header-title text-center">
                                <h1 class="heading" translate="">
                                    <span>Edit Company</span>
                                </h1>
                            </div>
                            <form class="ng-pristine ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-valid ng-valid-required" novalidate="" name="registration" ng-submit="submit()">
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group" ng-class="{'has-error': ((registration['company-name'].$touched || registration.$submitted) && registration['company-name'].$invalid)}">
                                            <label class="control-label" for="company-name">COMPANY NAME</label>
                                            <input id="company-name" class="form-control ng-pristine ng-untouched ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-not-empty ng-valid ng-valid-required" type="text" ng-pattern="/^[a-zA-Z0-9-.,+'@&() ]+$/" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 0, 'blur': 0 } }" ng-required="true" required-on-touch="true" ng-maxlength="50" ng-minlength="2" ng-model="company.companyName" name="company-name" required="required">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group" ng-class="{'has-error': ((registration['contact-name'].$touched || registration.$submitted) && registration['contact-name'].$invalid)}">
                                            <label class="control-label" translate="" for="contact-name">
                                                <span>CONTACT NAME</span>
                                            </label>
                                            <input id="contact-name" class="form-control ng-pristine ng-untouched ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-not-empty ng-valid ng-valid-required" type="text" ng-maxlength="32" ng-minlength="2" ng-pattern="/^[a-zA-Z0-9-.,@&() ]+$/" ng-required="true" name="contact-name" ng-model="company.contactName" required="required">
                                        </div>
                                        <div class="form-group" ng-class="{'has-error': ((registration.phone.$touched || isSubmitted[1]) && registration.phone.$invalid)}">
                                            <label class="control-label" translate="" for="contact-phone">
                                                <span>CONTACT NUMBER</span>
                                            </label>
                                            <input id="contact-phone" class="form-control ng-pristine ng-untouched ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-not-empty ng-valid ng-valid-required" type="text" placeholder="0123456789" ng-required="true" ng-pattern="/^[0-9\+]+$/" ng-maxlength="17" ng-minlength="10" name="phone" ng-model="company.contactPhone" required="required">
                                            <p class="note text-center" translate="">
                                                <span>These contact details will NOT be shared with job seekers, and will only be used for us to get in touch with you if required.</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="text-center">
                                    <input class="btn btn-step" type="submit" value="CONFIRM CHANGES">
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            <span style="display:none;">true</span>
                        </div>
                    </div>
                </div>
                <div id="cropModal" class="modal fade" aria-labelledby="cropModalLabel" role="dialog" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" aria-label="Close" data-dismiss="modal" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 id="myModalLabel" class="modal-title" translate="">
                                    <span>Resize your picture</span>
                                </h4>
                            </div>
                            <div class="modal-body crop-modal square-uploader">
                                <div>
                                    <div class="cropArea">
                                        <img-crop result-image-quality="1.0" result-image-format="image/png" result-image-size="300" area-type="square" change-on-fly="true" result-image="uploader.queue[0].croppedImage" image="uploader.queue[0].image">
                                            <canvas width="0" height="0" style="margin-top: 0px;"></canvas>
                                        </img-crop>
                                    </div>
                                </div>
                                <div>
                                    <img class="thumbnail">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-red" translate="" ng-click="onBeforeUploadItem(uploader.queue[0])" type="button" ng-if="!uploading">
                                    <span>Upload picture</span>
                                </button>
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