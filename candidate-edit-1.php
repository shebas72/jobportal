<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $jobrole = $_POST['jobrole'];
    $jobroleall = implode(',', (array)$jobrole);
    
    $skills = $_POST['skills'];
    $skillsall = implode(',', (array)$skills);
    
    $typeofemp = $_POST['typeofemp'];
    $typeofempall = implode(',', (array)$typeofemp);
    
    $location = $_POST['location'];
    $salmin = $_POST['salmin'];
    $salmax = $_POST['salmax'];
    $salperiod = $_POST['salperiod'];

    $success=0;
    $errfname1=0;
    $errfname2=0;
    $errlname1=0;
    $errlname2=0;    
    $errloc=0;        

    if(isset($fname) && trim($fname) == '')
    {
        $errfname1=1;
    }
    if(isset($fname))
    {
        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$fname))
        {
            $errfname2=1;
        }
    }

    if(isset($lname) && trim($lname) == '')
    {
        $errlname1=1;
    }
    if(isset($lname))
    {
        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$lname))
        {
            $errlname2=1;
        }
    }
    
    if(isset($location) && trim($location) == '')
    {
        $errloc=1;
    }    


    if(isset($fname) && isset($lname) && isset($location))
    {
        if(($errfname1==0) && ($errfname2==0) && ($errlname1==0) && ($errlname2==0) && ($errloc==0))
        {
            $success=1;
        }
    }



    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');

        
    ?>
    <!DOCTYPE html>
    <html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
        <head>
            <style type="text/css">
                .pac-container{background-color:#fff;position:absolute!important;z-index:1000;border-radius:2px;border-top:1px solid #d9d9d9;font-family:Arial,sans-serif;box-shadow:0 2px 6px rgba(0,0,0,0.3);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;overflow:hidden}.pac-logo:after{content:"";padding:1px 1px 1px 0;height:16px;text-align:right;display:block;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3.png);background-position:right;background-repeat:no-repeat;background-size:120px 14px}.hdpi.pac-logo:after{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3_hdpi.png)}.pac-item{cursor:default;padding:0 4px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;line-height:30px;text-align:left;border-top:1px solid #e6e6e6;font-size:11px;color:#999}.pac-item:hover{background-color:#fafafa}.pac-item-selected,.pac-item-selected:hover{background-color:#ebf2fe}.pac-matched{font-weight:700}.pac-item-query{font-size:13px;padding-right:3px;color:#000}.pac-icon{width:15px;height:20px;margin-right:7px;margin-top:6px;display:inline-block;vertical-align:top;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);background-size:34px}.hdpi .pac-icon{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons_hdpi.png)}.pac-icon-search{background-position:-1px -1px}.pac-item-selected .pac-icon-search{background-position:-18px -1px}.pac-icon-marker{background-position:-1px -161px}.pac-item-selected .pac-icon-marker{background-position:-18px -161px}.pac-placeholder{color:gray}
            </style>
            <style class="vjs-styles-defaults">

                .video-js {
                    width: 300px;
                    height: 150px;
                }

                .vjs-fluid {
                    padding-top: 56.25%
                }

            </style>
            <style type="text/css">
                @charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}
            </style>
            <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
            <title page-title="">Register - myjob.sa</title>
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
                                <div id="navbar-collapse" class="collapse navbar-collapse nav-primary" aria-expanded="false" style="max-height: 843px;">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li ng-if="isCandidate()" ui-sref-active="active">
                                            <a translate="" ng-click="openState('candidate-messages')">
                                                <span>Messages</span>
                                            </a>
                                        </li>
                                        <li class="dropdown" ng-if="isCandidate()" ui-sref-active="active">
                                            <a id="acc" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
                                                <div class="nav-user-image circle" style="background-image: url('');">
                                                    <initials candidate-surname="" candidate-name="" font="25" size="50" rounded="rounded" ng-if="!profileImg">
                                                        <div class="scoot-initials rounded" style="width: 50px; height: 50px; line-height: 50px; font-size: 25px;">
                                                            <span></span>
                                                        </div>
                                                    </initials>
                                                </div>
                                                You
                                                <span class="caret"></span>
                                                <span class="clearfix"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="acc">
                                                <li class="active" ui-sref-active="active">
                                                    <a translate="" ui-sref="user-edit-profile.step-one" href="/client/user/edit-profile/step-one">
                                                        <span>Edit Profile</span>
                                                    </a>
                                                </li>
                                                <li ui-sref-active="active">
                                                    <a translate="" ui-sref="user-settings" href="/client/user/settings">
                                                        <span>Settings</span>
                                                    </a>
                                                </li>
                                                <li ui-sref-active="active">
                                                    <a translate="" ng-click="logout()" ng-controller="candidateLogoutController">
                                                        <span>Log out</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="ng-hide" ng-hide="isLogedIn()" ui-sref-active="active">
                                            <a translate="" ng-click="openState('search')">
                                                <span>Job Search</span>
                                            </a>
                                        </li>
                                        <li class="dropdown ng-hide" ng-hide="isLogedIn()" ui-sref-active="active">
                                            <a id="login" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
                                                Login
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="login">
                                                <li class="" ui-sref-active="active">
                                                    <a translate="" ui-sref="user-login" href="/client/user/login">
                                                        <span>Candidate Login</span>
                                                    </a>
                                                </li>
                                                <li ui-sref-active="active">
                                                    <a translate="" ui-sref="company-login" href="/client/company/login">
                                                        <span>Company Login</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="ng-hide" ng-hide="isLogedIn()" ui-sref-active="active">
                                            <div ng-controller="registerModalController">
                                                <script id="registerModal.html" type="text/ng-template"></script>
                                                <a translate="" ng-click="open()">
                                                    <span>Create an account</span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <ul class="nav navbar-nav nav-secondary visible-xs">
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user" href="/client/user">
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="search" href="/client/search">
                                                <span>Job search</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-jobs-matched" href="/client/user/jobs/matched">
                                                <span>Matched jobs</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-jobs-shortlisted" href="/client/user/jobs/shortlisted">
                                                <span>Saved jobs</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-jobs-applied" href="/client/user/jobs/applied">
                                                <span>Applied jobs</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ui-sref="user-interviews" href="/client/user/jobs/interviews">
                                                <span>Interviews</span>
                                            </a>
                                        </li>
                                        <li ui-sref-active="active" ng-if="isCandidate()">
                                            <a translate="" ng-click="logout()" ng-controller="candidateLogoutController">
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
                                        <a translate="" ui-sref="user-jobs-matched" href="candidate-matched.php">
                                            <span>Matched jobs</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-jobs-shortlisted" href="candidate-saved.php">
                                            <span>Saved jobs</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-jobs-applied" href="candidate-applied.php">
                                            <span>Applied jobs</span>
                                        </a>
                                    </li>
                                    <li ui-sref-active="active">
                                        <a translate="" ui-sref="user-interviews" href="candidate-interview.php">
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
                    <div class="user-edit-page user-register-page container">
                        <div class="container">
                            <div class="tabs-overlay" ng-if="editProfile.lockTabs"></div>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active" ui-sref="user-edit-profile.step-one" ui-sref-active="active" href="/client/user/edit-profile/step-one">
                                    <a>
                                        <strong>1</strong>
                                        <p>
                                            <span>Get Matched</span>
                                        </p>
                                    </a>
                                </li>
                                <li ui-sref="user-edit-profile.step-two" ui-sref-active="active" href="/client/user/edit-profile/step-two">
                                    <a>
                                        <strong>2</strong>
                                        <p>Basic information</p>
                                    </a>
                                </li>
                                <li ui-sref="user-edit-profile.step-three" ui-sref-active="active" href="/client/user/edit-profile/step-three">
                                    <a>
                                        <strong>3</strong>
                                        <p>
                                            <span>Education & experience</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                            <div ui-view="">
                            
                                <?php
                                    if($success==1)
                                    {
                                        $sqlupd="UPDATE candidate SET 
                                                    fname=\"$fname\",
                                                    lname=\"$lname\",
                                                    jobrole=\"$jobroleall\",
                                                    skills=\"$skillsall\",
                                                    typeofemp=\"$typeofempall\",
                                                    location=\"$location\",
                                                    salmin=\"$salmin\",
                                                    salmax=\"$salmax\",
                                                    salperiod=\"$salperiod\"
                                                    WHERE email=\"$email\" AND password=\"$password\";";
                                        //echo $sqlupd;
                                        $resupd=mysql_query($sqlupd);
                                        echo '<META http-equiv="refresh" content="0;URL=candidate-edit-2.php">';
                                    }
                                ?>
                            
                                <form class="ng-pristine ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-valid-select-limit" novalidate="" ng-submit="vm.save(registration.$valid)" name="registration" ng-submit="submit()" enctype="multipart/form-data" method="POST">
                                    <div class="user-edit-match animated fadeIn step-page">
                                        <div class="form-section">
                                            <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                                <label class="control-label" translate="">
                                                    <span>NAME</span>
                                                </label>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <div class="form-group" ng-class="{'has-error': (registration.userfname.$touched || registration.$submitted) && registration.userfname.$invalid}">
                                                            <input id="fname" class="form-control text-autocapitalize ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" ng-pattern="/^[a-zA-Z-'\s]*$/" ng-required="true" ng-maxlength="32" ng-minlength="2" name="fname" ng-model="vm.candidate.name" required="required">
                                                            <p class="note">First Name</p>
                                                            <?php                                                                
                                                                if($errfname1==1)
                                                                {
                                                                ?>
                                                                    <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>First name is required.</span>
                                                                        </li>
                                                                    </ul>
                                                                <?php                                                                    
                                                                }
                                                                if($errfname2==1)
                                                                {
                                                                    if(!preg_match("/^[a-zA-Z0-9 ]*$/",$fname))
                                                                    {
                                                                    ?>
                                                                    <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>Only letters, numbers and white space allowed.</span>
                                                                        </li>
                                                                    </ul>
                                                                    <?php
                                                                    }
                                                                }                                                                    
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <div class="form-group" ng-class="{'has-error': (registration.userlname.$touched || registration.$submitted) && registration.userlname.$invalid}">
                                                            <input id="lname" class="form-control text-autocapitalize ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" ng-pattern="/^[a-zA-Z-'\s]*$/" ng-required="true" ng-maxlength="32" ng-minlength="2" name="lname" ng-model="vm.candidate.surname" required="required">
                                                            <p class="note">Last Name</p>
                                                            <?php                                                                
                                                                if($errlname1==1)
                                                                {
                                                                ?>
                                                                    <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>Last name is required.</span>
                                                                        </li>
                                                                    </ul>
                                                                <?php                                                                    
                                                                }
                                                                if($errlname2==1)
                                                                {
                                                                    if(!preg_match("/^[a-zA-Z0-9 ]*$/",$lname))
                                                                    {
                                                                    ?>
                                                                    <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>Only letters, numbers and white space allowed.</span>
                                                                        </li>
                                                                    </ul>
                                                                    <?php
                                                                    }
                                                                }                                                                    
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <label class="control-label" translate="">
                                                    <span>YOUR CV (Optional)</span>
                                                </label>
                                                <div class="form-group text-center">
                                                    <p class="ng-hide" ng-hide="(vm.candidate.cvFile == undefined || vm.candidate.cvFile == '')" ng-if="!vm.showLoader">
                                                        Your current CV can be seen
                                                        <a href="" target="_blank">here</a>
                                                        .
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-xs-12">

                                                            <?php
                                                                //if they DID upload a file...
                                                                if($_FILES['photo']['name'])
                                                                {
                                                                    //if no errors...
                                                                    if(!$_FILES['photo']['error'])
                                                                    {

                                                                        //now is the time to modify the future file name and validate the file
                                                                        $new_file_name = strtolower($_FILES['photo']['name']); //rename file                                                                        

                                                                        if ((($_FILES["photo"]["type"] == "application/doc") 
                                                                        || ($_FILES["photo"]["type"] == "application/docx") 
                                                                        || ($_FILES["photo"]["type"] == "application/rtf") 
                                                                        || ($_FILES["photo"]["type"] == "application/txt") 
                                                                        || ($_FILES["photo"]["type"] == "application/pdf"))
                                                                        && ($_FILES["photo"]["size"] < 30000000))                                                                         
                                                                        {
                                                                            $valid_file = true;                                                                        
                                                                        }
                                                                        else 
                                                                        { 
                                                                            $valid_file = false; 
                                                                        ?>
                                                                        <ul class="errors-tooltip">
                                                                            <li>
                                                                                <span>File not accepted.</span>
                                                                            </li>
                                                                        </ul>
                                                                        <?php
                                                                        }

                                                                        //if the file has passed the test
                                                                        if($valid_file)
                                                                        {
                                                                            //move it to where we want it to be
                                                                            $custom_name = md5(uniqid(rand(), true));

                                                                            $new_file_name = $custom_name.'.' . pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION);                                                                                                                                                        

                                                                            move_uploaded_file($_FILES['photo']['tmp_name'], 'resume/'.$new_file_name);

                                                                            $sqlie = "UPDATE candidate SET resume=\"$new_file_name\" WHERE email=\"$email\" AND password=\"$password\";";
                                                                            $resie = mysql_query($sqlie);
                                                                        ?>
                                                                        <strong>Success!</strong> Your company logo is uploaded. Please wait....
                                                                        <?php                                                                            
                                                                        }
                                                                    }
                                                                    //if there is an error...
                                                                    else
                                                                    {
                                                                        //set that to be the returned message
                                                                    ?>
                                                                    <strong>Error!</strong> Your upload triggered the following error: <?php echo $_FILES['photo']['error']; ?>
                                                                    <?php
                                                                    }
                                                                }
                                                            ?>

                                                            <div class="btn-cv upload scoot-load-img">
                                                                Upload CV
                                                                <input type="file" name="photo">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-section">
                                            <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                                <div class="form-group" ng-class="{'has-error': ((registration.jobRole.$touched || registration.$submitted) && registration.jobRole.$invalid)}">
                                                    <label class="control-label" translate="" for="ur-job-role">
                                                        <span>JOB ROLE</span>
                                                    </label>
                                                    <select id="jobrole[]" class="form-control chosen-select ng-pristine ng-untouched localytics-chosen ng-empty ng-valid-select-limit ng-invalid ng-invalid-required" name="jobrole[]" style="width: 100%; height: 200px;" required="required" multiple="multiple" data-placeholder="Select Some Options">
                                                        <optgroup label="Admin, HR & Management">
                                                            <option value="Admin">Admin</option>
                                                            <option value="Data Entry">Data Entry</option>
                                                            <option value="Human Resource Executive">Human Resource Executive</option>
                                                            <option value="Manager">Manager</option>
                                                            <option value="Operations Executive">Operations Executive</option>
                                                            <option value="Personal Assistant/Secretary">Personal Assistant/Secretary</option>
                                                            <option value="Project Manager">Project Manager</option>
                                                            <option value="Receptionist">Receptionist</option>
                                                            <option value="Recruiter">Recruiter</option>
                                                            <option value="Human Resource Manager">Human Resource Manager</option>
                                                            <option value="Supervisor">Supervisor</option>
                                                            <option value="Payroll Executive">Payroll Executive</option>
                                                        </optgroup>
                                                        <optgroup label="Construction & Property">
                                                            <option value="Health & Safety Officer">Health & Safety Officer</option>
                                                            <option value="Property Agent">Property Agent</option>
                                                            <option value="Building Manager">Building Manager</option>
                                                            <option value="Civil Engineer">Civil Engineer</option>
                                                            <option value="Electrician">Electrician</option>
                                                            <option value="Carpenter">Carpenter</option>
                                                            <option value="Construction Site Supervisor">Construction Site Supervisor</option>
                                                            <option value="General Labourer">General Labourer</option>
                                                            <option value="Land Surveyor">Land Surveyor</option>
                                                            <option value="Landscaper">Landscaper</option>
                                                            <option value="Machine Operator">Machine Operator</option>
                                                            <option value="Plumber">Plumber</option>
                                                            <option value="Quantity Surveyor">Quantity Surveyor</option>
                                                            <option value="Interior Designer">Interior Designer</option>
                                                            <option value="Architect">Architect</option>
                                                        </optgroup>
                                                        <optgroup label="Others">
                                                            <option value="Research Assistant">Research Assistant</option>
                                                            <option value="Babysitter">Babysitter</option>
                                                            <option value="Chemist">Chemist</option>
                                                            <option value="Laboratory Assistant">Laboratory Assistant</option>
                                                            <option value="Volunteer">Volunteer</option>
                                                            <option value="Pest Control Officer">Pest Control Officer</option>
                                                            <option value="Pet Groomer">Pet Groomer</option>
                                                            <option value="Pet Obedience Trainer">Pet Obedience Trainer</option>
                                                            <option value="Veterinarian">Veterinarian</option>
                                                            <option value="Florist">Florist</option>
                                                            <option value="Horticulturist">Horticulturist</option>
                                                            <option value="Gardener">Gardener</option>
                                                            <option value="Library Assistant">Library Assistant</option>
                                                        </optgroup>
                                                        <optgroup label="Beauty & Healthcare">
                                                            <option value="Nurse">Nurse</option>
                                                            <option value="Beautician">Beautician</option>
                                                            <option value="Chiropractor">Chiropractor</option>
                                                            <option value="Dentist">Dentist</option>
                                                            <option value="Nutritionist">Nutritionist</option>
                                                            <option value="Doctor">Doctor</option>
                                                            <option value="Hairdresser">Hairdresser</option>
                                                            <option value="Makeup Artist">Makeup Artist</option>
                                                            <option value="Massage Therapist">Massage Therapist</option>
                                                            <option value="Optometrist">Optometrist</option>
                                                            <option value="Paramedic">Paramedic</option>
                                                            <option value="Pharmacist">Pharmacist</option>
                                                            <option value="Physiotherapist">Physiotherapist</option>
                                                            <option value="Psychologist">Psychologist</option>
                                                            <option value="Tattoo Artist">Tattoo Artist</option>
                                                        </optgroup>
                                                        <optgroup label="Education & Training">
                                                            <option value="Driving Instructor">Driving Instructor</option>
                                                            <option value="Kindergarten/Preschool Teacher">Kindergarten/Preschool Teacher</option>
                                                            <option value="Sports Coach / Instructor">Sports Coach / Instructor</option>
                                                            <option value="Lecturer">Lecturer</option>
                                                            <option value="Teacher">Teacher</option>
                                                            <option value="Training & Compliance Officer">Training & Compliance Officer</option>
                                                        </optgroup>
                                                        <optgroup label="Accounting & Finance">
                                                            <option value="Banker">Banker</option>
                                                            <option value="Broker">Broker</option>
                                                            <option value="Accountant">Accountant</option>
                                                            <option value="Accounting & Finance Manager">Accounting & Finance Manager</option>
                                                            <option value="Accounts & Admin Assistant">Accounts & Admin Assistant</option>
                                                            <option value="Actuarist">Actuarist</option>
                                                            <option value="Auditor">Auditor</option>
                                                            <option value="Bookkeeper">Bookkeeper</option>
                                                            <option value="Accounting Executive">Accounting Executive</option>
                                                            <option value="Finance Executive">Finance Executive</option>
                                                            <option value="Financial Planner">Financial Planner</option>
                                                            <option value="Fundraising Coordinator">Fundraising Coordinator</option>
                                                            <option value="Insurance Assessor">Insurance Assessor</option>
                                                            <option value="Insurance Specialist">Insurance Specialist</option>
                                                            <option value="Insurance Underwriter">Insurance Underwriter</option>
                                                        </optgroup>
                                                        <optgroup label="Legal Services">
                                                            <option value="Law Clerk / Paralegal">Law Clerk / Paralegal</option>
                                                            <option value="Lawyer">Lawyer</option>
                                                            <option value="Legal Practice Manager">Legal Practice Manager</option>
                                                            <option value="Legal Secretary">Legal Secretary</option>
                                                            <option value="Solicitor">Solicitor</option>
                                                        </optgroup>
                                                        <optgroup label="Marketing">
                                                            <option value="Advertising Art Director">Advertising Art Director</option>
                                                            <option value="Brand Manager">Brand Manager</option>
                                                            <option value="Communications Manager">Communications Manager</option>
                                                            <option value="Event Manager">Event Manager</option>
                                                            <option value="Market Researcher & Analyst">Market Researcher & Analyst</option>
                                                            <option value="Marketing Assistant">Marketing Assistant</option>
                                                            <option value="Marketing Coordinator">Marketing Coordinator</option>
                                                            <option value="Media Strategist">Media Strategist</option>
                                                            <option value="PR Manager">PR Manager</option>
                                                            <option value="Product Manager">Product Manager</option>
                                                            <option value="Digital Marketing">Digital Marketing</option>
                                                            <option value="Direct Marketing">Direct Marketing</option>
                                                        </optgroup>
                                                        <optgroup label="Transportation & Logistics">
                                                            <option value="Flight Attendant">Flight Attendant</option>
                                                            <option value="Pilot">Pilot</option>
                                                            <option value="Logistics/Warehouse Manager">Logistics/Warehouse Manager</option>
                                                            <option value="Logistics Executive">Logistics Executive</option>
                                                            <option value="Logistics/Warehouse Assistant">Logistics/Warehouse Assistant</option>
                                                            <option value="Driver/Dispatch/Runner">Driver/Dispatch/Runner</option>
                                                            <option value="Procurement & Purchasing Executive">Procurement & Purchasing Executive</option>
                                                            <option value="Rider">Rider</option>
                                                        </optgroup>
                                                        <optgroup label="Customer Service, Sales & Retail">
                                                            <option value="Sales Manager">Sales Manager</option>
                                                            <option value="Sales Executive">Sales Executive</option>
                                                            <option value="Sales Assistant">Sales Assistant</option>
                                                            <option value="Promoter">Promoter</option>
                                                            <option value="Customer Service Team Leader">Customer Service Team Leader</option>
                                                            <option value="Customer Service Officer">Customer Service Officer</option>
                                                            <option value="Call Center Manager">Call Center Manager</option>
                                                            <option value="Call Center Sales">Call Center Sales</option>
                                                            <option value="Business Development Manager">Business Development Manager</option>
                                                            <option value="Account Manager">Account Manager</option>
                                                            <option value="Area Manager">Area Manager</option>
                                                            <option value="Assistant Store Manager">Assistant Store Manager</option>
                                                            <option value="Department Manager">Department Manager</option>
                                                            <option value="Merchandiser">Merchandiser</option>
                                                            <option value="Mystery Shopper">Mystery Shopper</option>
                                                            <option value="Store & Inventory Planner">Store & Inventory Planner</option>
                                                            <option value="Store Manager">Store Manager</option>
                                                            <option value="Retail Sales Assistant">Retail Sales Assistant</option>
                                                        </optgroup>
                                                        <optgroup label="Engineering">
                                                            <option value="Chemical Engineer">Chemical Engineer</option>
                                                            <option value="Electrical/Electronic Engineer">Electrical/Electronic Engineer</option>
                                                            <option value="Engineer">Engineer</option>
                                                            <option value="Industrial Designer">Industrial Designer</option>
                                                            <option value="Mechanic">Mechanic</option>
                                                            <option value="Mechanical Engineer">Mechanical Engineer</option>
                                                            <option value="Project Engineer">Project Engineer</option>
                                                            <option value="Technician">Technician</option>
                                                        </optgroup>
                                                        <optgroup label="Food & Beverage">
                                                            <option value="Waiter / Waitress">Waiter / Waitress</option>
                                                            <option value="Restaurant / Cafe Manager">Restaurant / Cafe Manager</option>
                                                            <option value="Line Cook">Line Cook</option>
                                                            <option value="Commis">Commis</option>
                                                            <option value="Baker / Pastry Chef">Baker / Pastry Chef</option>
                                                            <option value="Bar Manager">Bar Manager</option>
                                                            <option value="Barista">Barista</option>
                                                            <option value="Bartender">Bartender</option>
                                                            <option value="Cafe Allrounder">Cafe Allrounder</option>
                                                            <option value="Cafe Manager">Cafe Manager</option>
                                                            <option value="Chef">Chef</option>
                                                        </optgroup>
                                                        <optgroup label="Hospitality & Tourism">
                                                            <option value="Travel Agent">Travel Agent</option>
                                                            <option value="Tour Guide">Tour Guide</option>
                                                            <option value="Housekeeping / Room Service">Housekeeping / Room Service</option>
                                                            <option value="Guest Services Executive">Guest Services Executive</option>
                                                            <option value="Hospitality Manager">Hospitality Manager</option>
                                                        </optgroup>
                                                        <optgroup label="Computer & IT">
                                                            <option value="Data Analyst">Data Analyst</option>
                                                            <option value="Database Administrator">Database Administrator</option>
                                                            <option value="Help Desk & IT Support Worker">Help Desk & IT Support Worker</option>
                                                            <option value="IT Consultant">IT Consultant</option>
                                                            <option value="Network & System Administrator">Network & System Administrator</option>
                                                            <option value="Software Developer & Programmer">Software Developer & Programmer</option>
                                                            <option value="Software Engineer">Software Engineer</option>
                                                            <option value="System Analyst">System Analyst</option>
                                                            <option value="Systems Engineer">Systems Engineer</option>
                                                            <option value="Technical Writer">Technical Writer</option>
                                                            <option value="Web Designer">Web Designer</option>
                                                            <option value="Web Developer">Web Developer</option>
                                                        </optgroup>
                                                        <optgroup label="Design, Media & Entertainment">
                                                            <option value="Copywriter">Copywriter</option>
                                                            <option value="Editor">Editor</option>
                                                            <option value="Fashion Designer">Fashion Designer</option>
                                                            <option value="Photographer">Photographer</option>
                                                            <option value="Graphic Designer">Graphic Designer</option>
                                                            <option value="Journalist">Journalist</option>
                                                            <option value="Performing Artist">Performing Artist</option>
                                                            <option value="Translator">Translator</option>
                                                            <option value="Writer">Writer</option>
                                                            <option value="Multimedia Designer">Multimedia Designer</option>
                                                        </optgroup>
                                                        <optgroup label="Manufacturing">
                                                            <option value="Quality Assurance / Control">Quality Assurance / Control</option>
                                                            <option value="Tooling Engineer">Tooling Engineer</option>
                                                            <option value="Production Planner">Production Planner</option>
                                                            <option value="Buyer">Buyer</option>
                                                        </optgroup>
                                                        <option value="Videographer">Videographer</option>
                                                        <option value="Mechatronics Engineer">Mechatronics Engineer</option>

                                                    </select>
                                                    
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <p class="note" translate="">
                                                                <span>Select Up to 4 Job Roles</span>
                                                            </p>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6 text-right">
                                                            <p class="note hidden-xs" translate="" ng-if="vm.candidate.professions.length < 4">
                                                                <span>Start typing to add more items</span>
                                                            </p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group" ng-class="{'has-error': ((registration.skillsAndCerts.$touched || registration.$submitted) && registration.skillsAndCerts.$invalid)}">
                                                    <label class="control-label" translate="" for="ur-skills">
                                                        <span>SKILL / CERTIFICATE</span>
                                                    </label>
                                                    <select id="skills[]" class="form-control chosen-select ng-pristine ng-untouched localytics-chosen ng-empty ng-valid-select-limit ng-invalid ng-invalid-required" style="width: 100%; height: 200px;" name="skills[]" multiple="multiple" required="required" data-placeholder="Select Some Options">
                                                        <option value="12D">12D</option>
                                                        <option value="3D Software">3D Software</option>
                                                        <option value="3D Studio Max">3D Studio Max</option>
                                                        <option value="Account Management">Account Management</option>
                                                        <option value="Accounts Payable (AP)">Accounts Payable (AP)</option>
                                                        <option value="Accounts Receivable (AR)">Accounts Receivable (AR)</option>
                                                        <option value="Acting">Acting</option>
                                                        <option value="Administrative Assistant">Administrative Assistant</option>
                                                        <option value="Adobe After Effect">Adobe After Effect</option>
                                                        <option value="Adobe Dreamweaver">Adobe Dreamweaver</option>
                                                        <option value="Adobe Illustrator">Adobe Illustrator</option>
                                                        <option value="Adobe ImageReady">Adobe ImageReady</option>
                                                        <option value="Adobe InDesign">Adobe InDesign</option>
                                                        <option value="Adobe Lightroom">Adobe Lightroom</option>
                                                        <option value="Adobe PhotoShop">Adobe PhotoShop</option>
                                                        <option value="Adobe Premiere">Adobe Premiere</option>
                                                        <option value="Advertising">Advertising</option>
                                                        <option value="Advertising Design">Advertising Design</option>
                                                        <option value="Air Conditioning Repair">Air Conditioning Repair</option>
                                                        <option value="Alarm System Management">Alarm System Management</option>
                                                        <option value="Animal Behaviour Correction">Animal Behaviour Correction</option>
                                                        <option value="Animal Care">Animal Care</option>
                                                        <option value="Animal Surgery Assistance">Animal Surgery Assistance</option>
                                                        <option value="ArchiCAD">ArchiCAD</option>
                                                        <option value="Architectural Drafting">Architectural Drafting</option>
                                                        <option value="Asphalting">Asphalting</option>
                                                        <option value="Audio Conversion">Audio Conversion</option>
                                                        <option value="Auditing">Auditing</option>
                                                        <option value="AutoCAD">AutoCAD</option>
                                                        <option value="Autodesk Inventor">Autodesk Inventor</option>
                                                        <option value="Automation System">Automation System</option>
                                                        <option value="Automotive Technician">Automotive Technician</option>
                                                        <option value="Babysitting">Babysitting</option>
                                                        <option value="Baking">Baking</option>
                                                        <option value="Bank Loan Knowledge">Bank Loan Knowledge</option>
                                                        <option value="Bank Reconciliation">Bank Reconciliation</option>
                                                        <option value="Bar & Beverage Service">Bar & Beverage Service</option>
                                                        <option value="Bartending">Bartending</option>
                                                        <option value="Basic Accounting Skills">Basic Accounting Skills</option>
                                                        <option value="Beauty Therapy">Beauty Therapy</option>
                                                        <option value="Beer Pouring">Beer Pouring</option>
                                                        <option value="Biotechnology">Biotechnology</option>
                                                        <option value="Blast Mining">Blast Mining</option>
                                                        <option value="Blogging">Blogging</option>
                                                        <option value="Blow Drying">Blow Drying</option>
                                                        <option value="Boilermaking">Boilermaking</option>
                                                        <option value="Bomb Threat Management">Bomb Threat Management</option>
                                                        <option value="Booking System">Booking System</option>
                                                        <option value="Bookkeeping">Bookkeeping</option>
                                                        <option value="Brand Management">Brand Management</option>
                                                        <option value="Bread and Pastry Shaping">Bread and Pastry Shaping</option>
                                                        <option value="Breakdown Maintenance">Breakdown Maintenance</option>
                                                        <option value="Bricklaying">Bricklaying</option>
                                                        <option value="Broker">Broker</option>
                                                        <option value="Budgeting">Budgeting</option>
                                                        <option value="Building & Safety Regulations">Building & Safety Regulations</option>
                                                        <option value="Building Inspection">Building Inspection</option>
                                                        <option value="Building Management & Maintenance">Building Management & Maintenance</option>
                                                        <option value="Business Analysis">Business Analysis</option>
                                                        <option value="Business Development">Business Development</option>
                                                        <option value="Butchery">Butchery</option>
                                                        <option value="C&S Design">C&S Design</option>
                                                        <option value="CAD Design Software">CAD Design Software</option>
                                                        <option value="Cake Decoration">Cake Decoration</option>
                                                        <option value="Captain">Captain</option>
                                                        <option value="Carpentry">Carpentry</option>
                                                        <option value="Cash Flow Management">Cash Flow Management</option>
                                                        <option value="Cash Register Operation">Cash Register Operation</option>
                                                        <option value="Cement Finishing">Cement Finishing</option>
                                                        <option value="Chef De Partie">Chef De Partie</option>
                                                        <option value="Chemistry">Chemistry</option>
                                                        <option value="Child Psychology">Child Psychology</option>
                                                        <option value="Childcare">Childcare</option>
                                                        <option value="Children Development">Children Development</option>
                                                        <option value="Childrens Fashion">Childrens Fashion</option>
                                                        <option value="Chiropractics">Chiropractics</option>
                                                        <option value="Chocolate Making">Chocolate Making</option>
                                                        <option value="Civil Construction">Civil Construction</option>
                                                        <option value="Claim Management">Claim Management</option>
                                                        <option value="Cleaning">Cleaning</option>
                                                        <option value="Clinical Psychology">Clinical Psychology</option>
                                                        <option value="Coaching">Coaching</option>
                                                        <option value="Cocktail Making">Cocktail Making</option>
                                                        <option value="Coffee & Tea Knowledge">Coffee & Tea Knowledge</option>
                                                        <option value="Commis Chef">Commis Chef</option>
                                                        <option value="Communication Skills">Communication Skills</option>
                                                        <option value="Community Care Worker">Community Care Worker</option>
                                                        <option value="Compensation & Benefit">Compensation & Benefit</option>
                                                        <option value="Compliance">Compliance</option>
                                                        <option value="Computational Fluid Dynamics (CFD)">Computational Fluid Dynamics (CFD)</option>
                                                        <option value="Computer Literacy">Computer Literacy</option>
                                                        <option value="Concept Design">Concept Design</option>
                                                        <option value="Concreting">Concreting</option>
                                                        <option value="Construction">Construction</option>
                                                        <option value="Construction Cost Estimating">Construction Cost Estimating</option>
                                                        <option value="Construction Management">Construction Management</option>
                                                        <option value="Construction Site Management">Construction Site Management</option>
                                                        <option value="Consulting Families">Consulting Families</option>
                                                        <option value="Content Creation">Content Creation</option>
                                                        <option value="Content Research">Content Research</option>
                                                        <option value="Cook">Cook</option>
                                                        <option value="Copywriting">Copywriting</option>
                                                        <option value="Corrective Action Reports (CAR)">Corrective Action Reports (CAR)</option>
                                                        <option value="Cosmetology">Cosmetology</option>
                                                        <option value="Cost Analysis">Cost Analysis</option>
                                                        <option value="Cost Modelling & Analysis">Cost Modelling & Analysis</option>
                                                        <option value="Cost Planning">Cost Planning</option>
                                                        <option value="Counselling">Counselling</option>
                                                        <option value="Crane Operating">Crane Operating</option>
                                                        <option value="Critical Care">Critical Care</option>
                                                        <option value="Crowd Control Management">Crowd Control Management</option>
                                                        <option value="CSA Design">CSA Design</option>
                                                        <option value="CSS">CSS</option>
                                                        <option value="Custom & Regulatory Compliance">Custom & Regulatory Compliance</option>
                                                        <option value="Customer Relationship Management (CRM)">Customer Relationship Management (CRM)</option>
                                                        <option value="Customer Service">Customer Service</option>
                                                        <option value="Dancing">Dancing</option>
                                                        <option value="Data Analysis">Data Analysis</option>
                                                        <option value="Data Entry">Data Entry</option>
                                                        <option value="Data Interpretation">Data Interpretation</option>
                                                        <option value="Database Management">Database Management</option>
                                                        <option value="Debt Collector">Debt Collector</option>
                                                        <option value="Decision Making">Decision Making</option>
                                                        <option value="Decouple Molding">Decouple Molding</option>
                                                        <option value="Demolition">Demolition</option>
                                                        <option value="Dental Nursing">Dental Nursing</option>
                                                        <option value="Dentistry">Dentistry</option>
                                                        <option value="Design Development">Design Development</option>
                                                        <option value="Designing">Designing</option>
                                                        <option value="Desktop Publishing">Desktop Publishing</option>
                                                        <option value="Dessert Preparation">Dessert Preparation</option>
                                                        <option value="Detail Design">Detail Design</option>
                                                        <option value="Development & Management">Development & Management</option>
                                                        <option value="Diesel Mechanic">Diesel Mechanic</option>
                                                        <option value="Dietary Assessment">Dietary Assessment</option>
                                                        <option value="Dietary Planning">Dietary Planning</option>
                                                        <option value="Digital Marketing">Digital Marketing</option>
                                                        <option value="Direct Marketing">Direct Marketing</option>
                                                        <option value="Disability Service Officer">Disability Service Officer</option>
                                                        <option value="Disabled Care">Disabled Care</option>
                                                        <option value="Dispatching">Dispatching</option>
                                                        <option value="Distributor Agrement (DA) Processing">Distributor Agrement (DA) Processing</option>
                                                        <option value="Document Evaluation">Document Evaluation</option>
                                                        <option value="Document Preparation">Document Preparation</option>
                                                        <option value="Documentation">Documentation</option>
                                                        <option value="Drafting">Drafting</option>
                                                        <option value="Drama">Drama</option>
                                                        <option value="Drawing">Drawing</option>
                                                        <option value="Dreamweaver">Dreamweaver</option>
                                                        <option value="dreamweaver">dreamweaver</option>
                                                        <option value="Driving Experience">Driving Experience</option>
                                                        <option value="Editing">Editing</option>
                                                        <option value="EFTPOS">EFTPOS</option>
                                                        <option value="Elderly Care">Elderly Care</option>
                                                        <option value="Electrical & Electronics Troubleshooting">Electrical & Electronics Troubleshooting</option>
                                                        <option value="Electrical Codes">Electrical Codes</option>
                                                        <option value="Electrical Design">Electrical Design</option>
                                                        <option value="Electrical Drawing">Electrical Drawing</option>
                                                        <option value="Electrician">Electrician</option>
                                                        <option value="Emergency Response">Emergency Response</option>
                                                        <option value="Employee Database Management">Employee Database Management</option>
                                                        <option value="Employee Relations">Employee Relations</option>
                                                        <option value="Engineering">Engineering</option>
                                                        <option value="Engineering Software">Engineering Software</option>
                                                        <option value="Environmental, Safety & Health (ESH) Management">Environmental, Safety & Health (ESH) Management</option>
                                                        <option value="Equipment & Tools Operation">Equipment & Tools Operation</option>
                                                        <option value="Equipment Maintenance">Equipment Maintenance</option>
                                                        <option value="Event Coordinator">Event Coordinator</option>
                                                        <option value="Event Management">Event Management</option>
                                                        <option value="Excavation">Excavation</option>
                                                        <option value="Exploratory Geoscience">Exploratory Geoscience</option>
                                                        <option value="Eyelash & Eyebrow Grooming">Eyelash & Eyebrow Grooming</option>
                                                        <option value="Eyelash and Eyebrow Tinting">Eyelash and Eyebrow Tinting</option>
                                                        <option value="Face to Face Sales">Face to Face Sales</option>
                                                        <option value="Factory Worker">Factory Worker</option>
                                                        <option value="Failure Mode Effects Analysis (FMEA)">Failure Mode Effects Analysis (FMEA)</option>
                                                        <option value="Fashion Design">Fashion Design</option>
                                                        <option value="Fast Food Procedures">Fast Food Procedures</option>
                                                        <option value="FIFO">FIFO</option>
                                                        <option value="File Management">File Management</option>
                                                        <option value="Filing">Filing</option>
                                                        <option value="Finalising Documents">Finalising Documents</option>
                                                        <option value="Finance">Finance</option>
                                                        <option value="Financial Analysis">Financial Analysis</option>
                                                        <option value="Financial Planning">Financial Planning</option>
                                                        <option value="Financial Reporting">Financial Reporting</option>
                                                        <option value="First Aid">First Aid</option>
                                                        <option value="Fitness Assessment">Fitness Assessment</option>
                                                        <option value="Fitness Consultation">Fitness Consultation</option>
                                                        <option value="Fitness Instructor">Fitness Instructor</option>
                                                        <option value="Fitter and Turner">Fitter and Turner</option>
                                                        <option value="Flight Attendant">Flight Attendant</option>
                                                        <option value="Floristry">Floristry</option>
                                                        <option value="Flower Arrangement">Flower Arrangement</option>
                                                        <option value="Food & Beverage Serving">Food & Beverage Serving</option>
                                                        <option value="Food Delivery">Food Delivery</option>
                                                        <option value="Food Handling & Preparation">Food Handling & Preparation</option>
                                                        <option value="Food Hygiene & Safety">Food Hygiene & Safety</option>
                                                        <option value="Food Science">Food Science</option>
                                                        <option value="Food Station Coordination">Food Station Coordination</option>
                                                        <option value="Forklift Driving">Forklift Driving</option>
                                                        <option value="Fraud">Fraud</option>
                                                        <option value="Freehand Drawing">Freehand Drawing</option>
                                                        <option value="Freight & Cargo Handling">Freight & Cargo Handling</option>
                                                        <option value="Freight Management">Freight Management</option>
                                                        <option value="Front of House Duties">Front of House Duties</option>
                                                        <option value="Fundraising">Fundraising</option>
                                                        <option value="Funds Management">Funds Management</option>
                                                        <option value="GAAP">GAAP</option>
                                                        <option value="Gardening">Gardening</option>
                                                        <option value="Gardening Maintenance">Gardening Maintenance</option>
                                                        <option value="General Grooming">General Grooming</option>
                                                        <option value="General IT Development">General IT Development</option>
                                                        <option value="General Ledger (GL)">General Ledger (GL)</option>
                                                        <option value="General Maintenance">General Maintenance</option>
                                                        <option value="General Management">General Management</option>
                                                        <option value="General Practice Nurse">General Practice Nurse</option>
                                                        <option value="Geometric Dimensioning and Tolerancing (GD&T)">Geometric Dimensioning and Tolerancing (GD&T)</option>
                                                        <option value="Glazier">Glazier</option>
                                                        <option value="Goods and Services Tax (GST)">Goods and Services Tax (GST)</option>
                                                        <option value="Grammar">Grammar</option>
                                                        <option value="Graphic Design">Graphic Design</option>
                                                        <option value="Grass Clipping">Grass Clipping</option>
                                                        <option value="Guest Relations">Guest Relations</option>
                                                        <option value="Gyprocking Plasterboard">Gyprocking Plasterboard</option>
                                                        <option value="Hair Colouring">Hair Colouring</option>
                                                        <option value="Hair Consulting">Hair Consulting</option>
                                                        <option value="Hair Cutting">Hair Cutting</option>
                                                        <option value="Hair Shampooing">Hair Shampooing</option>
                                                        <option value="Hair Styling">Hair Styling</option>
                                                        <option value="Head Chef">Head Chef</option>
                                                        <option value="Health Care">Health Care</option>
                                                        <option value="Heavy Lifting">Heavy Lifting</option>
                                                        <option value="Help Desk">Help Desk</option>
                                                        <option value="High School Tutoring">High School Tutoring</option>
                                                        <option value="Home Care Assistance">Home Care Assistance</option>
                                                        <option value="Homeschooling">Homeschooling</option>
                                                        <option value="Horticulture">Horticulture</option>
                                                        <option value="Housekeeping">Housekeeping</option>
                                                        <option value="HTML">HTML</option>
                                                        <option value="Hygiene Awareness">Hygiene Awareness</option>
                                                        <option value="Illustration">Illustration</option>
                                                        <option value="Inbound Call Centre">Inbound Call Centre</option>
                                                        <option value="Information Technology (IT) Skills">Information Technology (IT) Skills</option>
                                                        <option value="Insecticide Spraying">Insecticide Spraying</option>
                                                        <option value="Inspection">Inspection</option>
                                                        <option value="Instructing">Instructing</option>
                                                        <option value="Instructor">Instructor</option>
                                                        <option value="Insurance Broker">Insurance Broker</option>
                                                        <option value="Insurance Claim Management">Insurance Claim Management</option>
                                                        <option value="Internal Audit">Internal Audit</option>
                                                        <option value="Inventory Management">Inventory Management</option>
                                                        <option value="Inventory Report">Inventory Report</option>
                                                        <option value="Islamic Banking">Islamic Banking</option>
                                                        <option value="IT Support">IT Support</option>
                                                        <option value="Itinerary Planning">Itinerary Planning</option>
                                                        <option value="JavaScript">JavaScript</option>
                                                        <option value="Joiner and Cabinet Making">Joiner and Cabinet Making</option>
                                                        <option value="jQuery">jQuery</option>
                                                        <option value="Key Performance Indicators (KPI)">Key Performance Indicators (KPI)</option>
                                                        <option value="Kitchen Coordination">Kitchen Coordination</option>
                                                        <option value="Knowledge of Books">Knowledge of Books</option>
                                                        <option value="Knowledge of Routes">Knowledge of Routes</option>
                                                        <option value="Laboratory Assistant">Laboratory Assistant</option>
                                                        <option value="Labour">Labour</option>
                                                        <option value="Land Surveying">Land Surveying</option>
                                                        <option value="Landscape Architecture">Landscape Architecture</option>
                                                        <option value="Landscaping">Landscaping</option>
                                                        <option value="Language Development">Language Development</option>
                                                        <option value="Latte Art">Latte Art</option>
                                                        <option value="Law">Law</option>
                                                        <option value="Lawn Mowing and Greenkeeping">Lawn Mowing and Greenkeeping</option>
                                                        <option value="Lead Generation">Lead Generation</option>
                                                        <option value="Learning Management System">Learning Management System</option>
                                                        <option value="Leasing">Leasing</option>
                                                        <option value="Leave Management">Leave Management</option>
                                                        <option value="Legal Knowledge">Legal Knowledge</option>
                                                        <option value="Legal Procedure">Legal Procedure</option>
                                                        <option value="Legal Research">Legal Research</option>
                                                        <option value="Lesson Plan">Lesson Plan</option>
                                                        <option value="License Manufacturing Warehouse (LMW)">License Manufacturing Warehouse (LMW)</option>
                                                        <option value="LIFO">LIFO</option>
                                                        <option value="Literature">Literature</option>
                                                        <option value="Litigation Management">Litigation Management</option>
                                                        <option value="Loan">Loan</option>
                                                        <option value="Locksmith">Locksmith</option>
                                                        <option value="Logistics">Logistics</option>
                                                        <option value="M&E Drawings">M&E Drawings</option>
                                                        <option value="Machine & Equipment Maintenance">Machine & Equipment Maintenance</option>
                                                        <option value="Machine & Equipment Repair">Machine & Equipment Repair</option>
                                                        <option value="Machine Capacity">Machine Capacity</option>
                                                        <option value="Machine Operating">Machine Operating</option>
                                                        <option value="Macromedia Fireworks">Macromedia Fireworks</option>
                                                        <option value="Macromedia Flash">Macromedia Flash</option>
                                                        <option value="Maintenance">Maintenance</option>
                                                        <option value="Maintenance Fitter">Maintenance Fitter</option>
                                                        <option value="Makeup Artistry">Makeup Artistry</option>
                                                        <option value="Managerial Duties">Managerial Duties</option>
                                                        <option value="Manpower Capacity">Manpower Capacity</option>
                                                        <option value="Market Research">Market Research</option>
                                                        <option value="Marketing">Marketing</option>
                                                        <option value="Marketing">Marketing</option>
                                                        <option value="Massage Therapy">Massage Therapy</option>
                                                        <option value="Material & Production Planning">Material & Production Planning</option>
                                                        <option value="Material Planning">Material Planning</option>
                                                        <option value="Material Resources Management">Material Resources Management</option>
                                                        <option value="Materials Inspection">Materials Inspection</option>
                                                        <option value="Materials Preparation">Materials Preparation</option>
                                                        <option value="Materials Testing">Materials Testing</option>
                                                        <option value="Maternal Health Nursing">Maternal Health Nursing</option>
                                                        <option value="MathCAD">MathCAD</option>
                                                        <option value="MATLAB">MATLAB</option>
                                                        <option value="Mechanical Design">Mechanical Design</option>
                                                        <option value="Mechanical Drawing">Mechanical Drawing</option>
                                                        <option value="Media Outlet Skills">Media Outlet Skills</option>
                                                        <option value="Medical Research">Medical Research</option>
                                                        <option value="Medication Dispensing">Medication Dispensing</option>
                                                        <option value="Medicine Preparation">Medicine Preparation</option>
                                                        <option value="Mens Fashion">Mens Fashion</option>
                                                        <option value="Mentoring">Mentoring</option>
                                                        <option value="Mentoring / Consultation">Mentoring / Consultation</option>
                                                        <option value="Menu Preparation">Menu Preparation</option>
                                                        <option value="Merchandising and visual merchandising">Merchandising and visual merchandising</option>
                                                        <option value="Metalworking">Metalworking</option>
                                                        <option value="Microsoft Office">Microsoft Office</option>
                                                        <option value="Microsoft Project">Microsoft Project</option>
                                                        <option value="Microsoft Publisher">Microsoft Publisher</option>
                                                        <option value="Midwifery">Midwifery</option>
                                                        <option value="Mining">Mining</option>
                                                        <option value="Minutes of Meeting">Minutes of Meeting</option>
                                                        <option value="Mortgage">Mortgage</option>
                                                        <option value="Mould Making">Mould Making</option>
                                                        <option value="Music">Music</option>
                                                        <option value="MX Road">MX Road</option>
                                                        <option value="MYOB">MYOB</option>
                                                        <option value="MySQL">MySQL</option>
                                                        <option value="Natural Therapy">Natural Therapy</option>
                                                        <option value="Negotiation Skills">Negotiation Skills</option>
                                                        <option value="NetBeans">NetBeans</option>
                                                        <option value="Network Administration">Network Administration</option>
                                                        <option value="Network Engineering">Network Engineering</option>
                                                        <option value="Non-conforming Reports (NCR)">Non-conforming Reports (NCR)</option>
                                                        <option value="Nursing">Nursing</option>
                                                        <option value="Nursing Assistant">Nursing Assistant</option>
                                                        <option value="Occupational Health & Safety (OHS)">Occupational Health & Safety (OHS)</option>
                                                        <option value="Occupational Health and Safety Management System (OHSMS)">Occupational Health and Safety Management System (OHSMS)</option>
                                                        <option value="Office Administration">Office Administration</option>
                                                        <option value="Office Management">Office Management</option>
                                                        <option value="Office Management & Administration">Office Management & Administration</option>
                                                        <option value="On-The-Job Training">On-The-Job Training</option>
                                                        <option value="Operations Analysis & Monitoring">Operations Analysis & Monitoring</option>
                                                        <option value="Ophthalmology">Ophthalmology</option>
                                                        <option value="Optometry">Optometry</option>
                                                        <option value="Order Processing">Order Processing</option>
                                                        <option value="Outbound Call Centre">Outbound Call Centre</option>
                                                        <option value="Outside of School Hours Care">Outside of School Hours Care</option>
                                                        <option value="Overhaul">Overhaul</option>
                                                        <option value="Paediatrics">Paediatrics</option>
                                                        <option value="Painting">Painting</option>
                                                        <option value="Panel Beating">Panel Beating</option>
                                                        <option value="Paralegal">Paralegal</option>
                                                        <option value="Paramedics">Paramedics</option>
                                                        <option value="Parasite Treatment">Parasite Treatment</option>
                                                        <option value="Pastry Chef">Pastry Chef</option>
                                                        <option value="Pathology">Pathology</option>
                                                        <option value="Payroll">Payroll</option>
                                                        <option value="PCON">PCON</option>
                                                        <option value="Performance Appraisal">Performance Appraisal</option>
                                                        <option value="Pest Control">Pest Control</option>
                                                        <option value="Pharmaceutical Services">Pharmaceutical Services</option>
                                                        <option value="Pharmacy">Pharmacy</option>
                                                        <option value="Pharmacy Assistance">Pharmacy Assistance</option>
                                                        <option value="Phone Reservation">Phone Reservation</option>
                                                        <option value="Phone System">Phone System</option>
                                                        <option value="Photography">Photography</option>
                                                        <option value="PHP">PHP</option>
                                                        <option value="Physical Coordination & Manual Skills">Physical Coordination & Manual Skills</option>
                                                        <option value="Physical Therapy">Physical Therapy</option>
                                                        <option value="Physiotherapy">Physiotherapy</option>
                                                        <option value="Pilot">Pilot</option>
                                                        <option value="Planning">Planning</option>
                                                        <option value="Plastic Injection Molding">Plastic Injection Molding</option>
                                                        <option value="PLC Programming">PLC Programming</option>
                                                        <option value="Plumbing Systems & Fixtures">Plumbing Systems & Fixtures</option>
                                                        <option value="Point of Sale">Point of Sale</option>
                                                        <option value="Point of Sale (POS) System">Point of Sale (POS) System</option>
                                                        <option value="Post-training Evaluation">Post-training Evaluation</option>
                                                        <option value="Preventive Maintenance">Preventive Maintenance</option>
                                                        <option value="Primary School English Tutoring">Primary School English Tutoring</option>
                                                        <option value="Primary School Tutoring">Primary School Tutoring</option>
                                                        <option value="Primavera">Primavera</option>
                                                        <option value="Procurement Management">Procurement Management</option>
                                                        <option value="Procurement Preparation">Procurement Preparation</option>
                                                        <option value="Production">Production</option>
                                                        <option value="Production Analysis">Production Analysis</option>
                                                        <option value="Production Planning">Production Planning</option>
                                                        <option value="Production Reports">Production Reports</option>
                                                        <option value="Programmable Logic Controller (PLC)">Programmable Logic Controller (PLC)</option>
                                                        <option value="Programming">Programming</option>
                                                        <option value="Project Coordination & Monitoring">Project Coordination & Monitoring</option>
                                                        <option value="Project Management">Project Management</option>
                                                        <option value="Project Planning">Project Planning</option>
                                                        <option value="Promotional">Promotional</option>
                                                        <option value="Proofreading">Proofreading</option>
                                                        <option value="Property Consultation">Property Consultation</option>
                                                        <option value="Property Investment Strategies">Property Investment Strategies</option>
                                                        <option value="Property Management">Property Management</option>
                                                        <option value="Property Valuation">Property Valuation</option>
                                                        <option value="Public Relations">Public Relations</option>
                                                        <option value="Publishing">Publishing</option>
                                                        <option value="Python">Python</option>
                                                        <option value="QA Inspection">QA Inspection</option>
                                                        <option value="Quality Control Analysis">Quality Control Analysis</option>
                                                        <option value="Radiography">Radiography</option>
                                                        <option value="Receptionist">Receptionist</option>
                                                        <option value="Record Management">Record Management</option>
                                                        <option value="Recruitment">Recruitment</option>
                                                        <option value="Rehabilitation">Rehabilitation</option>
                                                        <option value="Remove Rubbish and Rubble From Site">Remove Rubbish and Rubble From Site</option>
                                                        <option value="Remuneration">Remuneration</option>
                                                        <option value="Report Preparation">Report Preparation</option>
                                                        <option value="Reporting">Reporting</option>
                                                        <option value="Research">Research</option>
                                                        <option value="Reservation Management">Reservation Management</option>
                                                        <option value="Reservation System">Reservation System</option>
                                                        <option value="Retail Management">Retail Management</option>
                                                        <option value="Revenue Forecasting">Revenue Forecasting</option>
                                                        <option value="Rf Scanning">Rf Scanning</option>
                                                        <option value="Rhinoceros">Rhinoceros</option>
                                                        <option value="Risk Management">Risk Management</option>
                                                        <option value="Roofing">Roofing</option>
                                                        <option value="Room Service">Room Service</option>
                                                        <option value="Rostering">Rostering</option>
                                                        <option value="Safety Inspection & Audit">Safety Inspection & Audit</option>
                                                        <option value="Sales">Sales</option>
                                                        <option value="Sales & Purchase Documents">Sales & Purchase Documents</option>
                                                        <option value="Sales Assistant">Sales Assistant</option>
                                                        <option value="Sales Management">Sales Management</option>
                                                        <option value="Sales Reporting">Sales Reporting</option>
                                                        <option value="Scaffolding">Scaffolding</option>
                                                        <option value="Search Engine Marketing (SEM)">Search Engine Marketing (SEM)</option>
                                                        <option value="Search Engine Optimalization (SEO)">Search Engine Optimalization (SEO)</option>
                                                        <option value="Search Engine Optimisation (SEO)">Search Engine Optimisation (SEO)</option>
                                                        <option value="Secretarial Duties">Secretarial Duties</option>
                                                        <option value="Security Guards">Security Guards</option>
                                                        <option value="Security Patrolling">Security Patrolling</option>
                                                        <option value="Sewing">Sewing</option>
                                                        <option value="Shipment Management">Shipment Management</option>
                                                        <option value="Shop Assistant">Shop Assistant</option>
                                                        <option value="Simulink">Simulink</option>
                                                        <option value="Singing">Singing</option>
                                                        <option value="Sketchup">Sketchup</option>
                                                        <option value="Skin Therapies">Skin Therapies</option>
                                                        <option value="Social Media Management">Social Media Management</option>
                                                        <option value="Social Work">Social Work</option>
                                                        <option value="Software Engineering">Software Engineering</option>
                                                        <option value="Software Testing">Software Testing</option>
                                                        <option value="Solidworks">Solidworks</option>
                                                        <option value="Sono">Sono</option>
                                                        <option value="Sourcing & Purchasing">Sourcing & Purchasing</option>
                                                        <option value="Sous Chef">Sous Chef</option>
                                                        <option value="Spare Parts Management">Spare Parts Management</option>
                                                        <option value="SQL Accounting">SQL Accounting</option>
                                                        <option value="Staff Management & Supervising">Staff Management & Supervising</option>
                                                        <option value="Stamping Process">Stamping Process</option>
                                                        <option value="Statistical Process Control (SPC)">Statistical Process Control (SPC)</option>
                                                        <option value="Statistical Quality Control (SQC)">Statistical Quality Control (SQC)</option>
                                                        <option value="Steel Fixing">Steel Fixing</option>
                                                        <option value="Stock & Inventory Management">Stock & Inventory Management</option>
                                                        <option value="Strong Soft Skills">Strong Soft Skills</option>
                                                        <option value="Superannuation">Superannuation</option>
                                                        <option value="Supervising">Supervising</option>
                                                        <option value="Supplier Relationship Management (SRM)">Supplier Relationship Management (SRM)</option>
                                                        <option value="Supply Chain Management">Supply Chain Management</option>
                                                        <option value="Surgery">Surgery</option>
                                                        <option value="Swimming Abilities">Swimming Abilities</option>
                                                        <option value="System Analysis">System Analysis</option>
                                                        <option value="System Applications Products (SAP)">System Applications Products (SAP)</option>
                                                        <option value="System Designing">System Designing</option>
                                                        <option value="Systems Engineering">Systems Engineering</option>
                                                        <option value="Systems Evaluation">Systems Evaluation</option>
                                                        <option value="Table Service">Table Service</option>
                                                        <option value="Tailor">Tailor</option>
                                                        <option value="Takaful">Takaful</option>
                                                        <option value="Tattoo Artist">Tattoo Artist</option>
                                                        <option value="Tattoo Drawing">Tattoo Drawing</option>
                                                        <option value="Tax">Tax</option>
                                                        <option value="Technical Report Writing">Technical Report Writing</option>
                                                        <option value="Technical Support">Technical Support</option>
                                                        <option value="Technical Training & Solution">Technical Training & Solution</option>
                                                        <option value="Technical Writing">Technical Writing</option>
                                                        <option value="Technician">Technician</option>
                                                        <option value="Telemarketing">Telemarketing</option>
                                                        <option value="Theatre">Theatre</option>
                                                        <option value="Tiling">Tiling</option>
                                                        <option value="Time Management">Time Management</option>
                                                        <option value="Tour Guide Services">Tour Guide Services</option>
                                                        <option value="Town Planning">Town Planning</option>
                                                        <option value="Training & Development">Training & Development</option>
                                                        <option value="Translating">Translating</option>
                                                        <option value="Translating & Interpreting">Translating & Interpreting</option>
                                                        <option value="Transport/Delivery Documents">Transport/Delivery Documents</option>
                                                        <option value="Transportation Management">Transportation Management</option>
                                                        <option value="Travel Arrangement">Travel Arrangement</option>
                                                        <option value="Travel Documentation">Travel Documentation</option>
                                                        <option value="Travel Experience">Travel Experience</option>
                                                        <option value="Travel Reservation System">Travel Reservation System</option>
                                                        <option value="Truck Driver">Truck Driver</option>
                                                        <option value="Tuition">Tuition</option>
                                                        <option value="Typing Skills">Typing Skills</option>
                                                        <option value="UBS">UBS</option>
                                                        <option value="Ultrasound Sonography">Ultrasound Sonography</option>
                                                        <option value="Umpiring">Umpiring</option>
                                                        <option value="Unit Trust">Unit Trust</option>
                                                        <option value="User Experience Design">User Experience Design</option>
                                                        <option value="Valet parking">Valet parking</option>
                                                        <option value="Vehicle Knowledge">Vehicle Knowledge</option>
                                                        <option value="Veterinary">Veterinary</option>
                                                        <option value="Veterinary Assistance">Veterinary Assistance</option>
                                                        <option value="Video Editing">Video Editing</option>
                                                        <option value="Video Production">Video Production</option>
                                                        <option value="Videography">Videography</option>
                                                        <option value="Visual Inspection">Visual Inspection</option>
                                                        <option value="Vlogging">Vlogging</option>
                                                        <option value="Volunteering">Volunteering</option>
                                                        <option value="Warehouse Housekeeping">Warehouse Housekeeping</option>
                                                        <option value="Warehouse Logistics">Warehouse Logistics</option>
                                                        <option value="Warehouse Operations">Warehouse Operations</option>
                                                        <option value="Warehousing">Warehousing</option>
                                                        <option value="Waxing">Waxing</option>
                                                        <option value="Wealth Management">Wealth Management</option>
                                                        <option value="Web Design">Web Design</option>
                                                        <option value="Website Development">Website Development</option>
                                                        <option value="Welding">Welding</option>
                                                        <option value="Wine & Liquor Knowledge">Wine & Liquor Knowledge</option>
                                                        <option value="Wiring">Wiring</option>
                                                        <option value="Womens Fashion">Womens Fashion</option>
                                                        <option value="Working with Children">Working with Children</option>
                                                        <option value="Writing">Writing</option>
                                                        <option value="Yoga">Yoga</option>
                                                    </select>
                                                    <p class="note" translate="">
                                                        <span>You can add a maximum of 30 tags to get accurate job matches.</span>
                                                    </p>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group" ng-class="{'has-error': ((registration.typeOfEmployment.$dirty || registration.$submitted) && registration.typeOfEmployment.$invalid)}">
                                                    <label class="control-label" translate="">
                                                        <span>TYPE OF EMPLOYMENT</span>
                                                    </label>
                                                    <div class="radio">
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-lg-4" ng-repeat="type in vm.typesOfEmployment track by type.id">
                                                            <input type="checkbox" name="typeofemp[]" value="Full Time">
                                                            Full Time
                                                        </label>
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-lg-4" ng-repeat="type in vm.typesOfEmployment track by type.id">
                                                            <input type="checkbox" name="typeofemp[]" value="Part Time">
                                                            Part Time
                                                        </label>
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-lg-4" ng-repeat="type in vm.typesOfEmployment track by type.id">
                                                            <input type="checkbox" name="typeofemp[]" value="Internship">
                                                            Internship
                                                        </label>
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-lg-4" ng-repeat="type in vm.typesOfEmployment track by type.id">
                                                            <input type="checkbox" name="typeofemp[]" value="Volunteer">
                                                            Volunteer
                                                        </label>
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-lg-4" ng-repeat="type in vm.typesOfEmployment track by type.id">
                                                            <input type="checkbox" name="typeofemp[]" value="Freelance / Temporary">
                                                            Freelance / Temporary
                                                        </label>
                                                        <label class="col-xs-12 col-sm-6 col-md-4 col-lg-4" ng-repeat="type in vm.typesOfEmployment track by type.id">
                                                            <input type="checkbox" name="typeofemp[]" value="Fresh Graduate">
                                                            Fresh Graduate
                                                        </label>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group" ng-class="{'has-error': ((registration.userLocation.$touched || registration.$submitted) && registration.userLocation.$invalid)}">
                                                    <label class="control-label" for="ur-user-location">LOCATION</label>
                                                    <input id="location" class="form-control input-block-level form-control ng-empty ng-valid" type="text" placeholder="Start typing your location" name="location" address="vm.candidate.address" location="vm.candidate.location" ng-keydown="vm.candidate.location = ''" ng-model="vm.candidate.address" autocomplete="off">                                                
                                                    <?php
                                                        if($errloc==1)
                                                        {
                                                    ?>
                                                        <ul class="errors-tooltip">
                                                            <li>You need to enter a valid address to proceed.</li>
                                                        </ul>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <label class="control-label" translate="">
                                                        <span>EXPECTED SALARY</span>
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-sm-4 col-md-4 row-2 salary-from">
                                                            <div class="col-sm-12">
                                                                <div class="input-group" ng-class="{'has-error': ((registration.salaryFrom.$touched || registration.$submitted) && registration.salaryFrom.$invalid)}">
                                                                    <span class="input-group-addon" translate="">
                                                                        <span>SAR</span>
                                                                    </span>
                                                                    <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="text" ng-required="true" ng-pattern="/^[0-9]+$/" placeholder="From" ng-model="vm.candidate.salaryFrom" name="salmin" id="salmin" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 text-right">
                                                                <span class="note" translate="">
                                                                    <span>Minimum Salary</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-md-4 row-2 salary-to">
                                                            <div class="col-sm-12">
                                                                <div class="input-group" ng-class="{'has-error': ((registration.salaryTo.$touched || registration.$submitted) && registration.salaryTo.$invalid)}">
                                                                    <span class="input-group-addon" translate="">
                                                                        <span>SAR</span>
                                                                    </span>
                                                                    <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="text" ng-required="true" ng-pattern="/^[0-9]+$/" placeholder="To" ng-model="vm.candidate.salaryTo" id="salmax" name="salmax" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 text-right">
                                                                <span class="note" translate="">
                                                                    <span>Maximum Salary</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-md-4 row-2" style="padding-left:0">
                                                            <div class="col-sm-12">
                                                                <div class="custom-select has-error" ng-class="{'has-error': registration.salaryPeriod.$invalid}">
                                                                    <select class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" ng-required="true" name="salperiod" id="salperiod" ng-model="vm.candidate.salaryPeriod" required="required">
                                                                        <option value="? undefined:undefined ?"></option>
                                                                        <option translate="" value="Per Hour">
                                                                            <span>Per Hour</span>
                                                                        </option>
                                                                        <option translate="" value="Per Month">
                                                                            <span>Per Month</span>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <span> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row text-center">
                                            <button class="btn-step btn" translate="" ng-disabled="vm.saving" type="submit">
                                                <span>NEXT STEP</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
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