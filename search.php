<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $jobtitle = $_POST['jobtitle'];
    $jobabout = $_POST['jobabout'];
    $jobkeywords = $_POST['jobkeywords'];
    $location = $_POST['location'];
    $etype = $_POST['etype'];    
    $etypeall = implode(',', (array)$etype);
    $jobcategory = $_POST['jobcategory'];
    $jrole = $_POST['jrole'];
    $salaryperiod = $_POST['salaryperiod'];
    $salaryfrom = $_POST['salaryfrom'];
    $sortby = $_POST['sortby'];
    $acceptsforeigners = $_POST['acceptsforeigners'];

    include('inc.php');

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
        <title page-title="">Job Search - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles.min.css?v=55128" rel="stylesheet">        
       
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
                <div class="page-sidebar-left-red page-list-jobs search-page-bg">
                    <div class="container-md-height">
                        <div class="row-md-height">
                                                        
                            
                            <div class="col-xs-12 col-md-3 col-lg-3 col-custom-left sticky-filters left row-2 ">
                                <div class="search-sticker">
                                    <div class="job-search-sidebar">
                                    
                                    <div class="mobile-collapse-button visible-xs">
                                        <button type="button" class="view-job-filters" id="hideshow2">View Job Filters &#9660;</button>
                                    </div>
                                        
                                        <scoot-job-search-sidebar professions="professions" categories="categories" options="options" clear="clear()" search="search(options, true)">
                                        
                                            <form class="job-search-sidebar ng-valid ng-valid-min ng-dirty ng-valid-parse ng-valid-number" name="searchform" id="searchform" method="post">                                                                                                                                                
                                                
                                                <div class="mobile-collapse hidden-xs" id="mobilecollapse">
                                                    <div class="form-group col-xs-12">
                                                        <label class="control-label" translate="" for="job-search-sidebar-keywords">
                                                            <span>Add Keywords</span>
                                                        </label>
                                                        <div class="row col-xs-12">
                                                            <label>
                                                                <input class="ng-pristine ng-untouched ng-valid ng-not-empty" type="checkbox" name="jobtitle" ng-model="options.searchByTitle" checked="checked" disabled="disabled" value="1">
                                                                Job Title
                                                            </label>
                                                        </div>
                                                        <div class="row col-xs-12">
                                                            <label>
                                                                <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="jobabout" ng-model="options.searchByKeywords" value="1">
                                                                Job Description
                                                            </label>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <input id="job-search-sidebar-keywords" class="form-control ng-pristine ng-valid ng-empty ng-touched" type="text" placeholder="Type in your keyword" ng-keyup="$event.keyCode == 13 ? search(options) : null" name="jobkeywords" ng-model="options.keyWords">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group col-xs-12">
                                                        <label class="control-label" translate="" for="job-search-sidebar-location">
                                                            <span>Location</span>
                                                        </label>
                                                        <input id="google_places_ac" class="input-block-level form-control ng-empty ng-valid ng-touched" type="text" placeholder="Start typing your location" name="location" restriction-country="MY" address="options.location.address" location="options.location.location" ng-model="options.location.address" autocomplete="off">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group col-xs-12 job-type">
                                                        <label class="control-label" translate="">
                                                            <span>Job Type</span>
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-xs-12 type-item" ng-repeat="item in options.typesOfEmployment track by item.id">
                                                                <label>
                                                                    <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="etype[]" ng-model="item.value" value="Full Time">
                                                                    Full Time
                                                                </label>
                                                            </div>
                                                            <div class="col-xs-12 type-item" ng-repeat="item in options.typesOfEmployment track by item.id">
                                                                <label>
                                                                    <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="etype[]" ng-model="item.value" value="Part Time">
                                                                    Part Time
                                                                </label>
                                                            </div>
                                                            <div class="col-xs-12 type-item" ng-repeat="item in options.typesOfEmployment track by item.id">
                                                                <label>
                                                                    <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="etype[]" ng-model="item.value" value="Internship">
                                                                    Internship
                                                                </label>
                                                            </div>
                                                            <div class="col-xs-12 type-item" ng-repeat="item in options.typesOfEmployment track by item.id">
                                                                <label>
                                                                    <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="etype[]" ng-model="item.value" value="Volunteer">
                                                                    Volunteer
                                                                </label>
                                                            </div>
                                                            <div class="col-xs-12 type-item" ng-repeat="item in options.typesOfEmployment track by item.id">
                                                                <label>
                                                                    <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="etype[]" ng-model="item.value" value="Freelance / Temporary">
                                                                    Freelance / Temporary
                                                                </label>
                                                            </div>
                                                            <div class="col-xs-12 type-item" ng-repeat="item in options.typesOfEmployment track by item.id">
                                                                <label>
                                                                    <input class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" name="etype[]" ng-model="item.value" value="Fresh Graduate">
                                                                    Fresh Graduate
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="job-search-filter ">
                                                        <button class="apply-filters" type="button" id="hideshow">
                                                            Advanced Filter &#9660;                                                            
                                                        </button>
                                                        <div class="job-filter-content" id="job-filter-content" style="display: none;">
                                                            <div class="form-group col-xs-12">
                                                                <label class="control-label" translate="">
                                                                    <span>Job Category</span>
                                                                </label>
                                                                <select id="job-search-sidebar-industry" class="form-control ng-untouched ng-valid localytics-chosen ng-dirty ng-valid-parse ng-empty" name="jobcategory" data-placeholder="Select Some Options">
                                                                    <option label="" value=""></option>
                                                                    <option label="Accounting & Finance" value="Accounting & Finance">Accounting & Finance</option>
                                                                    <option label="Admin, HR & Management" value="Admin, HR & Management">Admin, HR & Management</option>
                                                                    <option label="Beauty & Healthcare" value="Beauty & Healthcare">Beauty & Healthcare</option>
                                                                    <option label="Computer & IT" value="Computer & IT">Computer & IT</option>
                                                                    <option label="Construction & Property" value="Construction & Property">Construction & Property</option>
                                                                    <option label="Customer Service, Sales & Retail" value="Customer Service, Sales & Retail">Customer Service, Sales & Retail</option>
                                                                    <option label="Design, Media & Entertainment" value="Design, Media & Entertainment">Design, Media & Entertainment</option>
                                                                    <option label="Education & Training" value="Education & Training">Education & Training</option>
                                                                    <option label="Engineering" value="Engineering">Engineering</option>
                                                                    <option label="Food & Beverage" value="Food & Beverage">Food & Beverage</option>
                                                                    <option label="Hospitality & Tourism" value="Hospitality & Tourism">Hospitality & Tourism</option>
                                                                    <option label="Legal Services" value="Legal Services">Legal Services</option>
                                                                    <option label="Manufacturing" value="Manufacturing">Manufacturing</option>
                                                                    <option label="Marketing" value="Marketing">Marketing</option>
                                                                    <option label="Others" value="Others">Others</option>
                                                                    <option label="Transportation & Logistics" value="Transportation & Logistics">Transportation & Logistics</option>
                                                                </select>                                                                
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-12">
                                                                <label class="control-label" translate="">
                                                                    <span>Job Role</span>
                                                                </label>
                                                                <select id="job-search-sidebar-profession" class="form-control ng-untouched ng-valid localytics-chosen ng-dirty ng-valid-parse ng-empty" name="jrole" data-placeholder="Select Some Options">
                                                                    <option label="" value=""></option>
                                                                    <option label="Account Manager" value="Account Manager">Account Manager</option>
                                                                    <option label="Accountant" value="Accountant">Accountant</option>
                                                                    <option label="Accounting & Finance Manager" value="Accounting & Finance Manager">Accounting & Finance Manager</option>
                                                                    <option label="Accounting Executive" value="Accounting Executive">Accounting Executive</option>
                                                                    <option label="Accounts & Admin Assistant" value="Accounts & Admin Assistant">Accounts & Admin Assistant</option>
                                                                    <option label="Actuarist" value="Actuarist">Actuarist</option>
                                                                    <option label="Admin" value="Admin">Admin</option>
                                                                    <option label="Advertising Art Director" value="Advertising Art Director">Advertising Art Director</option>
                                                                    <option label="Architect" value="Architect">Architect</option>
                                                                    <option label="Area Manager" value="Area Manager">Area Manager</option>
                                                                    <option label="Assistant Store Manager" value="Assistant Store Manager">Assistant Store Manager</option>
                                                                    <option label="Auditor" value="Auditor">Auditor</option>
                                                                    <option label="Babysitter" value="Babysitter">Babysitter</option>
                                                                    <option label="Baker / Pastry Chef" value="Baker / Pastry Chef">Baker / Pastry Chef</option>
                                                                    <option label="Banker" value="Banker">Banker</option>
                                                                    <option label="Bar Manager" value="Bar Manager">Bar Manager</option>
                                                                    <option label="Barista" value="Barista">Barista</option>
                                                                    <option label="Bartender" value="Bartender">Bartender</option>
                                                                    <option label="Beautician" value="Beautician">Beautician</option>
                                                                    <option label="Bookkeeper" value="Bookkeeper">Bookkeeper</option>
                                                                    <option label="Brand Manager" value="Brand Manager">Brand Manager</option>
                                                                    <option label="Broker" value="Broker">Broker</option>
                                                                    <option label="Building Manager" value="Building Manager">Building Manager</option>
                                                                    <option label="Business Development Manager" value="Business Development Manager">Business Development Manager</option>
                                                                    <option label="Buyer" value="Buyer">Buyer</option>
                                                                    <option label="Cafe Allrounder" value="Cafe Allrounder">Cafe Allrounder</option>
                                                                    <option label="Cafe Manager" value="Cafe Manager">Cafe Manager</option>
                                                                    <option label="Call Center Manager" value="Call Center Manager">Call Center Manager</option>
                                                                    <option label="Call Center Sales" value="Call Center Sales">Call Center Sales</option>
                                                                    <option label="Carpenter" value="Carpenter">Carpenter</option>
                                                                    <option label="Chef" value="Chef">Chef</option>
                                                                    <option label="Chemical Engineer" value="Chemical Engineer">Chemical Engineer</option>
                                                                    <option label="Chemist" value="Chemist">Chemist</option>
                                                                    <option label="Chiropractor" value="Chiropractor">Chiropractor</option>
                                                                    <option label="Civil Engineer" value="Civil Engineer">Civil Engineer</option>
                                                                    <option label="Commis" value="Commis">Commis</option>
                                                                    <option label="Communications Manager" value="Communications Manager">Communications Manager</option>
                                                                    <option label="Construction Site Supervisor" value="Construction Site Supervisor">Construction Site Supervisor</option>
                                                                    <option label="Copywriter" value="Copywriter">Copywriter</option>
                                                                    <option label="Customer Service Officer" value="Customer Service Officer">Customer Service Officer</option>
                                                                    <option label="Customer Service Team Leader" value="Customer Service Team Leader">Customer Service Team Leader</option>
                                                                    <option label="Data Analyst" value="Data Analyst">Data Analyst</option>
                                                                    <option label="Data Entry" value="Data Entry">Data Entry</option>
                                                                    <option label="Database Administrator" value="Database Administrator">Database Administrator</option>
                                                                    <option label="Dentist" value="Dentist">Dentist</option>
                                                                    <option label="Department Manager" value="Department Manager">Department Manager</option>
                                                                    <option label="Digital Marketing" value="Digital Marketing">Digital Marketing</option>
                                                                    <option label="Direct Marketing" value="Direct Marketing">Direct Marketing</option>
                                                                    <option label="Doctor" value="Doctor">Doctor</option>
                                                                    <option label="Driver/Dispatch/Runner" value="Driver/Dispatch/Runner">Driver/Dispatch/Runner</option>
                                                                    <option label="Driving Instructor" value="Driving Instructor">Driving Instructor</option>
                                                                    <option label="Editor" value="Editor">Editor</option>
                                                                    <option label="Electrical/Electronic Engineer" value="Electrical/Electronic Engineer">Electrical/Electronic Engineer</option>
                                                                    <option label="Electrician" value="Electrician">Electrician</option>
                                                                    <option label="Engineer" value="Engineer">Engineer</option>
                                                                    <option label="Event Manager" value="Event Manager">Event Manager</option>
                                                                    <option label="Fashion Designer" value="Fashion Designer">Fashion Designer</option>
                                                                    <option label="Finance Executive" value="Finance Executive">Finance Executive</option>
                                                                    <option label="Financial Planner" value="Financial Planner">Financial Planner</option>
                                                                    <option label="Flight Attendant" value="Flight Attendant">Flight Attendant</option>
                                                                    <option label="Florist" value="Florist">Florist</option>
                                                                    <option label="Fundraising Coordinator" value="Fundraising Coordinator">Fundraising Coordinator</option>
                                                                    <option label="Gardener" value="Gardener">Gardener</option>
                                                                    <option label="General Labourer" value="General Labourer">General Labourer</option>
                                                                    <option label="Graphic Designer" value="Graphic Designer">Graphic Designer</option>
                                                                    <option label="Guest Services Executive" value="Guest Services Executive">Guest Services Executive</option>
                                                                    <option label="Hairdresser" value="Hairdresser">Hairdresser</option>
                                                                    <option label="Health & Safety Officer" value="Health & Safety Officer">Health & Safety Officer</option>
                                                                    <option label="Help Desk & IT Support Worker" value="Help Desk & IT Support Worker">Help Desk & IT Support Worker</option>
                                                                    <option label="Horticulturist" value="Horticulturist">Horticulturist</option>
                                                                    <option label="Hospitality Manager" value="Hospitality Manager">Hospitality Manager</option>
                                                                    <option label="Housekeeping / Room Service" value="Housekeeping / Room Service">Housekeeping / Room Service</option>
                                                                    <option label="Human Resource Executive" value="Human Resource Executive">Human Resource Executive</option>
                                                                    <option label="Human Resource Manager" value="Human Resource Manager">Human Resource Manager</option>
                                                                    <option label="Industrial Designer" value="Industrial Designer">Industrial Designer</option>
                                                                    <option label="Insurance Assessor" value="Insurance Assessor">Insurance Assessor</option>
                                                                    <option label="Insurance Specialist" value="Insurance Specialist">Insurance Specialist</option>
                                                                    <option label="Insurance Underwriter" value="Insurance Underwriter">Insurance Underwriter</option>
                                                                    <option label="Interior Designer" value="Interior Designer">Interior Designer</option>
                                                                    <option label="IT Consultant" value="IT Consultant">IT Consultant</option>
                                                                    <option label="Journalist" value="Journalist">Journalist</option>
                                                                    <option label="Kindergarten/Preschool Teacher" value="Kindergarten/Preschool Teacher">Kindergarten/Preschool Teacher</option>
                                                                    <option label="Laboratory Assistant" value="Laboratory Assistant">Laboratory Assistant</option>
                                                                    <option label="Land Surveyor" value="Land Surveyor">Land Surveyor</option>
                                                                    <option label="Landscaper" value="Landscaper">Landscaper</option>
                                                                    <option label="Law Clerk / Paralegal" value="Law Clerk / Paralegal">Law Clerk / Paralegal</option>
                                                                    <option label="Lawyer" value="Lawyer">Lawyer</option>
                                                                    <option label="Lecturer" value="Lecturer">Lecturer</option>
                                                                    <option label="Legal Practice Manager" value="Legal Practice Manager">Legal Practice Manager</option>
                                                                    <option label="Legal Secretary" value="Legal Secretary">Legal Secretary</option>
                                                                    <option label="Library Assistant" value="Library Assistant">Library Assistant</option>
                                                                    <option label="Line Cook" value="Line Cook">Line Cook</option>
                                                                    <option label="Logistics Executive" value="Logistics Executive">Logistics Executive</option>
                                                                    <option label="Logistics/Warehouse Assistant" value="Logistics/Warehouse Assistant">Logistics/Warehouse Assistant</option>
                                                                    <option label="Logistics/Warehouse Manager" value="Logistics/Warehouse Manager">Logistics/Warehouse Manager</option>
                                                                    <option label="Machine Operator" value="Machine Operator">Machine Operator</option>
                                                                    <option label="Makeup Artist" value="Makeup Artist">Makeup Artist</option>
                                                                    <option label="Manager" value="Manager">Manager</option>
                                                                    <option label="Market Researcher & Analyst" value="Market Researcher & Analyst">Market Researcher & Analyst</option>
                                                                    <option label="Marketing Assistant" value="Marketing Assistant">Marketing Assistant</option>
                                                                    <option label="Marketing Coordinator" value="Marketing Coordinator">Marketing Coordinator</option>
                                                                    <option label="Massage Therapist" value="Massage Therapist">Massage Therapist</option>
                                                                    <option label="Mechanic" value="Mechanic">Mechanic</option>
                                                                    <option label="Mechanical Engineer" value="Mechanical Engineer">Mechanical Engineer</option>
                                                                    <option label="Mechatronics Engineer" value="Mechatronics Engineer">Mechatronics Engineer</option>
                                                                    <option label="Media Strategist" value="Media Strategist">Media Strategist</option>
                                                                    <option label="Merchandiser" value="Merchandiser">Merchandiser</option>
                                                                    <option label="Multimedia Designer" value="Multimedia Designer">Multimedia Designer</option>
                                                                    <option label="Mystery Shopper" value="Mystery Shopper">Mystery Shopper</option>
                                                                    <option label="Network & System Administrator" value="Network & System Administrator">Network & System Administrator</option>
                                                                    <option label="Nurse" value="Nurse">Nurse</option>
                                                                    <option label="Nutritionist" value="Nutritionist">Nutritionist</option>
                                                                    <option label="Operations Executive" value="Operations Executive">Operations Executive</option>
                                                                    <option label="Optometrist" value="Optometrist">Optometrist</option>
                                                                    <option label="Paramedic" value="Paramedic">Paramedic</option>
                                                                    <option label="Payroll Executive" value="Payroll Executive">Payroll Executive</option>
                                                                    <option label="Performing Artist" value="Performing Artist">Performing Artist</option>
                                                                    <option label="Personal Assistant/Secretary" value="Personal Assistant/Secretary">Personal Assistant/Secretary</option>
                                                                    <option label="Pest Control Officer" value="Pest Control Officer">Pest Control Officer</option>
                                                                    <option label="Pet Groomer" value="Pet Groomer">Pet Groomer</option>
                                                                    <option label="Pet Obedience Trainer" value="Pet Obedience Trainer">Pet Obedience Trainer</option>
                                                                    <option label="Pharmacist" value="Pharmacist">Pharmacist</option>
                                                                    <option label="Photographer" value="Photographer">Photographer</option>
                                                                    <option label="Physiotherapist" value="Physiotherapist">Physiotherapist</option>
                                                                    <option label="Pilot" value="Pilot">Pilot</option>
                                                                    <option label="Plumber" value="Plumber">Plumber</option>
                                                                    <option label="PR Manager" value="PR Manager">PR Manager</option>
                                                                    <option label="Procurement & Purchasing Executive" value="Procurement & Purchasing Executive">Procurement & Purchasing Executive</option>
                                                                    <option label="Product Manager" value="Product Manager">Product Manager</option>
                                                                    <option label="Production Planner" value="Production Planner">Production Planner</option>
                                                                    <option label="Project Engineer" value="Project Engineer">Project Engineer</option>
                                                                    <option label="Project Manager" value="Project Manager">Project Manager</option>
                                                                    <option label="Promoter" value="Promoter">Promoter</option>
                                                                    <option label="Property Agent" value="Property Agent">Property Agent</option>
                                                                    <option label="Psychologist" value="Psychologist">Psychologist</option>
                                                                    <option label="Quality Assurance / Control" value="Quality Assurance / Control">Quality Assurance / Control</option>
                                                                    <option label="Quantity Surveyor" value="Quantity Surveyor">Quantity Surveyor</option>
                                                                    <option label="Receptionist" value="Receptionist">Receptionist</option>
                                                                    <option label="Recruiter" value="Recruiter">Recruiter</option>
                                                                    <option label="Research Assistant" value="Research Assistant">Research Assistant</option>
                                                                    <option label="Restaurant / Cafe Manager" value="Restaurant / Cafe Manager">Restaurant / Cafe Manager</option>
                                                                    <option label="Retail Sales Assistant" value="Retail Sales Assistant">Retail Sales Assistant</option>
                                                                    <option label="Rider" value="Rider">Rider</option>
                                                                    <option label="Sales Assistant" value="Sales Assistant">Sales Assistant</option>
                                                                    <option label="Sales Executive" value="Sales Executive">Sales Executive</option>
                                                                    <option label="Sales Manager" value="Sales Manager">Sales Manager</option>
                                                                    <option label="Software Developer & Programmer" value="Software Developer & Programmer">Software Developer & Programmer</option>
                                                                    <option label="Software Engineer" value="Software Engineer">Software Engineer</option>
                                                                    <option label="Solicitor" value="Solicitor">Solicitor</option>
                                                                    <option label="Sports Coach / Instructor" value="Sports Coach / Instructor">Sports Coach / Instructor</option>
                                                                    <option label="Store & Inventory Planner" value="Store & Inventory Planner">Store & Inventory Planner</option>
                                                                    <option label="Store Manager" value="Store Manager">Store Manager</option>
                                                                    <option label="Supervisor" value="Supervisor">Supervisor</option>
                                                                    <option label="System Analyst" value="System Analyst">System Analyst</option>
                                                                    <option label="Systems Engineer" value="Systems Engineer">Systems Engineer</option>
                                                                    <option label="Tattoo Artist" value="Tattoo Artist">Tattoo Artist</option>
                                                                    <option label="Teacher" value="Teacher">Teacher</option>
                                                                    <option label="Technical Writer" value="Technical Writer">Technical Writer</option>
                                                                    <option label="Technician" value="Technician">Technician</option>
                                                                    <option label="Tooling Engineer" value="Tooling Engineer">Tooling Engineer</option>
                                                                    <option label="Tour Guide" value="Tour Guide">Tour Guide</option>
                                                                    <option label="Training & Compliance Officer" value="Training & Compliance Officer">Training & Compliance Officer</option>
                                                                    <option label="Translator" value="Translator">Translator</option>
                                                                    <option label="Travel Agent" value="Travel Agent">Travel Agent</option>
                                                                    <option label="Veterinarian" value="Veterinarian">Veterinarian</option>
                                                                    <option label="Videographer" value="Videographer">Videographer</option>
                                                                    <option label="Volunteer" value="Volunteer">Volunteer</option>
                                                                    <option label="Waiter / Waitress" value="Waiter / Waitress">Waiter / Waitress</option>
                                                                    <option label="Web Designer" value="Web Designer">Web Designer</option>
                                                                    <option label="Web Developer" value="Web Developer">Web Developer</option>
                                                                    <option label="Writer" value="Writer">Writer</option>
                                                                </select>                                                                
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-12">
                                                                <label class="control-label" translate="">
                                                                    <span>Salary</span>
                                                                </label>
                                                                <select id="job-search-sidebar-salaryPeriod" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" name="salaryperiod" ng-model="options.salaryPeriod">
                                                                    <option translate="" value="All" selected="">
                                                                        <span>All</span>
                                                                    </option>
                                                                    <option translate="" value="Per Hour">
                                                                        <span>Hourly</span>
                                                                    </option>
                                                                    <option translate="" value="Per Month">
                                                                        <span>Monthly</span>
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-12" ng-show="(options.salaryPeriod && options.salaryPeriod != 'all')">
                                                                <input class="form-control ng-valid ng-not-empty ng-valid-min ng-dirty ng-valid-number ng-touched" type="number" placeholder="Enter min salary" ng-model="options.salaryFrom" min="0" name="salaryfrom">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-12">
                                                                <label class="control-label" translate="" for="job-search-sidebar-keywords">
                                                                    <span>Sort By</span>
                                                                </label>
                                                                <select id="job-search-sidebar-distance" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Order by" name="sortby" ng-model="options.orderBy">
                                                                    <option label="Date posted" value="1" selected="selected">Date posted</option>
                                                                    <option label="Title" value="2">Title</option>
                                                                    <option label="Location" value="3">Location</option>
                                                                </select>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-12">
                                                                <label class="control-label" translate="">
                                                                    <span>Foreigners</span>
                                                                </label>
                                                                <div class="row col-xs-12">
                                                                    <label>
                                                                        <input class="ng-untouched ng-valid ng-dirty ng-valid-parse ng-empty" type="checkbox" name="acceptsforeigners" ng-model="options.acceptsForeigners" value="1">
                                                                        Job Accepts Foreigners
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="hiddact" name="hiddact" value="1">
                                                    <div class="buttons">
                                                        <div class="col-xs-12">
                                                            <button class="btn btn-red btn-lg btn-block search" translate="" value="Search Now" ng-click="search(options, true)" type="submit">
                                                                <span>Search Now</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <button class="btn btn-lg btn-block clear" translate="" value="Clear" ng-click="clear()" type="button" onclick="window.location.href='search.php';">
                                                                <span>Clear All X</span>
                                                            </button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="mobile-collapse-button bottom">
                                                    <button class="view-job-filters" ng-click="showFilters()" type="button">
                                                        Hide Job Filters
                                                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </scoot-job-search-sidebar>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-12 col-md-9 col-lg-9 col-custom-right right row-2 search-result-container">
                                <div class="search-top">
                                    <div class="col-xs-12">
                                        <div class="inner"> </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <ul class="jobs-list" infinite-scroll="myPagingFunction()">

                                    <?php                                                                                
                                        $sqljj = "SELECT * FROM jobs WHERE isactive=\"1\" ";
                                        
                                        if(isset($jobkeywords) && trim($jobkeywords) != '')
                                        {
                                            if(isset($jobabout) && trim($jobabout) == '1')
                                            {                                        
                                                $sqljj .= "AND jobtitle LIKE \"%$jobkeywords%\" AND jobabout LIKE \"%$jobkeywords%\" ";
                                            }
                                            else
                                            {
                                                $sqljj .= "AND jobtitle LIKE \"%$jobkeywords%\" ";
                                            }
                                        }
                                        
                                        if(isset($location) && trim($location) != '')
                                        {
                                            $sqljj .= "AND jlocation LIKE \"%$location%\" ";
                                        }
                                        
                                        if(isset($etypeall) && trim($etypeall) != '')
                                        {
                                            $sqljj .= "AND etype LIKE \"%$etypeall%\" ";
                                        }
                                        
                                        if(isset($jobcategory) && trim($jobcategory) != '')
                                        {
                                            $sqljj .= "AND jobcategory = \"$jobcategory\" ";
                                        }
                                        
                                        if(isset($jrole) && trim($jrole) != '')
                                        {
                                            $sqljj .= "AND jrole LIKE \"%$jrole%\" ";
                                        }
                                        
                                        if(isset($salaryfrom) && trim($salaryfrom) != '')
                                        {
                                            if($salaryperiod=='All')
                                            {
                                                $sqljj .= "AND salaryfrom >= \"$salaryfrom\" ";
                                            }
                                            if($salaryperiod=='Per Month')
                                            {
                                                $sqljj .= "AND salaryfrom >= \"$salaryfrom\" AND salaryperiod = \"Per Month\" ";
                                            }
                                            if($salaryperiod=='Per Hour')
                                            {
                                                $sqljj .= "AND salaryfrom >= \"$salaryfrom\" AND salaryperiod = \"Per Hour\" ";
                                            }                                            
                                        }
                                        
                                        if(isset($acceptsforeigners) && trim($acceptsforeigners) == '1')
                                        {
                                            $sqljj .= "AND acceptsforeigners = \"Yes\" ";
                                        }
                                        
                                        if($sortby=='')
                                        {
                                            $sqljj .= " ORDER BY date_updated DESC;";
                                        }
                                        if($sortby=='1')
                                        {
                                            $sqljj .= " ORDER BY date_updated DESC;";
                                        }
                                        
                                        if($sortby=='2')
                                        {
                                            $sqljj .= " ORDER BY jobtitle ASC;";
                                        }
                                        
                                        if($sortby=='3')
                                        {
                                            $sqljj .= " ORDER BY jlocation ASC;";
                                        }
                                                                                                                                                                                                            
                                        //echo $sqljj;
                                        $resjj = mysql_query($sqljj);                                                                                                                        
                                        if(mysql_num_rows($resjj)=='0')
                                        {
                                            echo "<p align=\"center\"><b>We're sorry, we couldn't find any jobs that match your search.</b></p>";
                                        }
                                        while($rowj = mysql_fetch_array($resjj)) 
                                        {
                                            $jid = $rowj['id'];
                                            $bid = $rowj['bid'];
                                            $jobtitle = $rowj['jobtitle'];
                                            $jlocation = $rowj['jlocation'];
                                            $salaryfrom = $rowj['salaryfrom'];
                                            $salaryto = $rowj['salaryto'];
                                            $salaryperiod = $rowj['salaryperiod'];
                                            $date_updated = $rowj['date_updated'];

                                            $sqlbb = "SELECT * FROM business WHERE id=\"$bid\";";    
                                            $resbb = mysql_query($sqlbb);                                                                                                                        
                                            while($rowc = mysql_fetch_array($resbb)) 
                                            {
                                                $bid = $rowc['id'];
                                                $bname = $rowc['name'];
                                                $bimage = $rowc['image'];
                                            }
                                        ?>

                                        <li class="jobs-list-item _old animated fadeIn" ng-repeat="item in jobs">
                                            <jobs-list-item location="options.location.location" user="vm.candidateInfo.candidate" job="item" item="vm.candidateInfo.applications[item.id]" ng-if="item.business">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-xs-12 col-sm-3 col-md-2 job-img hidden-xs">
                                                            <a ui-sref="job({jobId: job.id, slug: (job.title | slugify)})" href="candidate-viewjob.php?jid=<?php echo $jid; ?>">
                                                                <span class="thumbnail no-bottom-margin">
                                                                    <div class="job-item-img" style="background-image: url('profile/<?php echo $bimage; ?>');"></div>
                                                                </span>
                                                            </a>
                                                            <br>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 right-mobile"> </div>
                                                        <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
                                                            <h3 class="position">
                                                                <a class="job-title" target="_blank" ui-sref="job({jobId: job.id, slug: (job.title | slugify)})" href="candidate-viewjob.php?jid=<?php echo $jid; ?>"><?php echo $jobtitle; ?></a>
                                                            </h3>
                                                            <div class="job-details">
                                                                <div class="company">
                                                                    <a class="company-name" ui-sref="business-jobs-public({businessId: job.business.id})" href="candidate-viewjob.php?jid=<?php echo $jid; ?>"><?php echo $bname; ?></a>
                                                                </div>
                                                                <div class="time">
                                                                    <img src="http://image.flaticon.com/icons/svg/149/149313.svg" height="12" style="margin-top: -5px;">
                                                                    <?php echo time_elapsed_string($date_updated, true); ?>
                                                                </div>
                                                                <div class="salary">
                                                                    <span ng-if="!job.salaryHidden">
                                                                        <img src="http://image.flaticon.com/icons/svg/61/61584.svg" height="12" style="margin-top: -5px;">
                                                                        <?php echo $salaryfrom; ?> - <?php echo $salaryto; ?> / <?php echo $salaryperiod; ?>
                                                                    </span>
                                                                </div>
                                                                <div class="address">
                                                                    <span>
                                                                        <img src="http://image.flaticon.com/icons/svg/61/61469.svg" width="12" style="margin-top: -5px;"> 
                                                                        <?php echo $jlocation; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                            $sqlck = "SELECT * FROM candidate WHERE email='$email' and password='$password'";
                                                            $resck=mysql_query($sqlck);
                                                            $count=mysql_num_rows($resck);
                                                            if($count==1)
                                                            {
                                                            ?>

                                                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 job-actions" ng-if="!(user | isUndefined)">
                                                                <span ng-if="!job.isLoading && !(user | isUndefined)">

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


                                                                            $sqla = "SELECT * FROM saved WHERE jid='$jid' and uid='$uid';";
                                                                            $resa=mysql_query($sqla);
                                                                            $count=mysql_num_rows($resa);
                                                                            if($count==0)
                                                                            {
                                                                            ?>
                                                                            <div class="col-save">
                                                                                <a class="save-this-job" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=save">
                                                                                    <img src="http://image.flaticon.com/icons/svg/149/149763.svg" alt="" height="10">
                                                                                    <span>Save this Job</span>
                                                                                </a>
                                                                            </div>                                                                    
                                                                            <?php 
                                                                            }
                                                                            if($count==1)
                                                                            {
                                                                            ?>
                                                                            <div class="col-save">
                                                                                <a class="remove-from-saved" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=unsave">
                                                                                    <img src="http://image.flaticon.com/icons/svg/149/149763.svg" alt="" height="10">
                                                                                    <span>Remove from saved jobs</span>
                                                                                </a>
                                                                            </div>                                                                    
                                                                            <?php 
                                                                            }                                                                

                                                                            $sqla = "SELECT * FROM applied WHERE jid='$jid' and uid='$uid';";
                                                                            $resa=mysql_query($sqla);
                                                                            $count=mysql_num_rows($resa);
                                                                            if($count==0)
                                                                            {
                                                                            ?>
                                                                            <div class="col-apply">
                                                                                <a class="apply-now job-action-btn" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=apply">
                                                                                    <span>Apply Now</span>
                                                                                </a>
                                                                            </div>                                                                    
                                                                            <?php 
                                                                            }
                                                                            if($count==1)
                                                                            {
                                                                            ?>
                                                                            <div class="col-apply">
                                                                                <a class="withdrdaw-application job-action-btn" href="candidate-viewjob.php?jid=<?php echo $jid; ?>&uid=<?php echo $uid; ?>&action=unapply">
                                                                                    <span>Withdraw application</span>
                                                                                </a>
                                                                            </div>
                                                                            <?php 
                                                                            }
                                                                    } ?>

                                                                    <div class="clearfix"></div>
                                                                </span>
                                                            </div> 

                                                            <?php
                                                            }
                                                        ?>

                                                    </div>
                                                </div>
                                            </jobs-list-item>
                                        </li>

                                        <?php

                                        }
                                    ?>

                                </ul>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
        <script type='text/javascript' src='wordpress/wp-content/themes/scootwp/assets/js/bootstrap.min7035.js?ver=4.3.4'></script>
        
        <script type="text/javascript">
            var button = document.getElementById('hideshow'); // Assumes element with id='button'
            var button2 = document.getElementById('hideshow2'); // Assumes element with id='button'

            button.onclick = function() {
                var div = document.getElementById('job-filter-content');
                
                if (div.style.display !== 'none') 
                {
                    div.style.display = 'none';
                }
                else 
                {
                    div.style.display = 'block';
                }
            };
            
            button2.onclick = function() 
            {        
                if($('#mobilecollapse').hasClass('hidden-xs')) 
                {                    
                    $('#mobilecollapse').removeClass('hidden-xs');
                    $('#mobilecollapse').addClass('visible-xs');
                }
                else 
                {                    
                    $('#mobilecollapse').addClass('hidden-xs');
                    $('#mobilecollapse').removeClass('visible-xs');
                }
            };
            
        </script>

    </body>
</html>