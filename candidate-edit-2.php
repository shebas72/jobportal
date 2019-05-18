<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $mobile = $_POST['mobile'];
    $sarights = $_POST['sarights'];

    $success=0;        
    
    if(isset($mobile) && trim($mobile) == '')
    {
        $errmob=1;
    }

    if(isset($mobile) && trim($mobile) != '')
    {        
        $success=1;        
    }

    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');

        $sqlusercheck = "SELECT * FROM candidate WHERE email=\"$email\" AND password=\"$password\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $fname = $row['fname'];            
                $lname = $row['lname'];            
            }
        }
        
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
                                                <initials candidate-surname="thowzif" candidate-name="Abdul" font="25" size="50" rounded="rounded" ng-if="!profileImg">
                                                    <div class="scoot-initials rounded" style="width: 50px; height: 50px; line-height: 50px; font-size: 25px;">
                                                        <span><?php echo substr($fname, 0, 1); ?><?php echo substr($lname, 0, 1); ?></span>
                                                    </div>
                                                </initials>
                                            </div>
                                            You
                                            <span class="caret"></span>
                                            <span class="clearfix"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="acc">
                                            <li class="" ui-sref-active="active">
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
                                            <li ui-sref-active="active">
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
                            <li class="" ui-sref="user-edit-profile.step-one" ui-sref-active="active" href="/client/user/edit-profile/step-one">
                                <a>
                                    <strong>1</strong>
                                    <p>
                                        <span>Get Matched</span>
                                    </p>
                                </a>
                            </li>
                            <li class="active" ui-sref="user-edit-profile.step-two" ui-sref-active="active" href="/client/user/edit-profile/step-two">
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
                                    $dob = $day.'-'.$month.'-'.$year;
                                    if($success==1)
                                    {
                                        $sqlupd="UPDATE candidate SET 
                                                    dob=\"$dob\",
                                                    gender=\"$gender\",
                                                    nationality=\"$nationality\",
                                                    mobile=\"$mobile\",
                                                    sarights=\"$sarights\"
                                                    WHERE email=\"$email\" AND password=\"$password\";";
                                        echo $sqlupd;
                                        $resupd=mysql_query($sqlupd);
                                        echo '<META http-equiv="refresh" content="0;URL=candidate-edit-3.php">';
                                    }
                                ?>
                            
                            <form class="ng-pristine ng-invalid ng-invalid-birth-future ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" novalidate="" name="registration" ng-submit="vm.save(registration.$valid)" enctype="multipart/form-data" method="POST">
                                <div class="user-edit-match animated fadeIn step-page">                                    
                                    <div class="animated fadeIn step-page">
                                        <div class="form-section">
                                            <div class="col-xs-12 col-md-5 pull-left">
                                                <div class="user-edit-image text-center">
                                                    <div class="user-edit-image" ng-class="{'user-image': !vm.showLoader && vm.candidate.profileImg}" style="background-image: url('');" ng-if="!vm.showLoader">
                                                        <initials candidate-surname="thowzif" candidate-name="Abdul" font="115" size="250" rounded="rounded" ng-if="!vm.candidate.profileImg || vm.candidate.profileImg == ''">
                                                            <div class="scoot-initials rounded" style="width: 250px; height: 250px; line-height: 250px; font-size: 115px;">
                                                                <span><?php echo substr($fname, 0, 1); ?><?php echo substr($lname, 0, 1); ?></span>
                                                            </div>
                                                        </initials>
                                                    </div>
                                                    <div>
                                                        <p class="note" translate="">
                                                            <span>Accepted file types are jpg, png, jpeg, bmp and gif (300x300)</span>
                                                        </p>
                                                    </div>
                                                    <div class="btn-cv upload scoot-load-img">
                                                        
                                                        <?php
                                                            //if they DID upload a file...
                                                            if($_FILES['photo']['name'])
                                                            {
                                                                //if no errors...
                                                                if(!$_FILES['photo']['error'])
                                                                {

                                                                    //now is the time to modify the future file name and validate the file
                                                                    $new_file_name = strtolower($_FILES['photo']['name']); //rename file                                                                        

                                                                    if ((($_FILES["photo"]["type"] == "image/gif")
                                                                    || ($_FILES["photo"]["type"] == "image/jpeg")
                                                                    || ($_FILES["photo"]["type"] == "image/jpg")
                                                                    || ($_FILES["photo"]["type"] == "image/png")
                                                                    || ($_FILES["photo"]["type"] == "image/pjpeg"))
                                                                    && ($_FILES["photo"]["size"] < 3000000))                                                                         
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

                                                                        move_uploaded_file($_FILES['photo']['tmp_name'], 'profile/'.$new_file_name);

                                                                        $sqlie = "UPDATE candidate SET photo=\"$new_file_name\" WHERE email=\"$email\" AND password=\"$password\";";
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
                                                        
                                                        Upload Profile Picture
                                                        <input id="photo" type="file" name="photo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-7 pull-right personal-info row-2">
                                                <div class="col-xs-12 col-sm-11 col-md-10">
                                                    <div class="form-group" ng-class="{'has-error': ((registration['birth-day'].$touched || registration['birth-month'].$touched || registration['birth-year'].$touched || registration.$submitted) && (registration['birth-day'].$invalid || registration['birth-month'].$invalid || registration['birth-year'].$invalid || birthDayInFuture(registration['birth-day'].$modelValue.id, registration['birth-month'].$modelValue.id, registration['birth-year'].$modelValue.id)))}">
                                                        <label class="control-label text-left" translate="" for="birth-day">
                                                            <span>DATE OF BIRTH</span>
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select id="day" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" name="day" ng-required="true" ng-change="vm.updateDateOfBirth(vm.birth.Day, vm.birth.Month, vm.birth.Year)" ng-options="day as day.name for day in vm.days track by day.id" ng-model="vm.birth.Day" required="required">
                                                                    <option translate="" value="" selected="selected">
                                                                        <span>Day</span>
                                                                    </option>
                                                                    <option label="1" value="1">1</option>
                                                                    <option label="2" value="2">2</option>
                                                                    <option label="3" value="3">3</option>
                                                                    <option label="4" value="4">4</option>
                                                                    <option label="5" value="5">5</option>
                                                                    <option label="6" value="6">6</option>
                                                                    <option label="7" value="7">7</option>
                                                                    <option label="8" value="8">8</option>
                                                                    <option label="9" value="9">9</option>
                                                                    <option label="10" value="10">10</option>
                                                                    <option label="11" value="11">11</option>
                                                                    <option label="12" value="12">12</option>
                                                                    <option label="13" value="13">13</option>
                                                                    <option label="14" value="14">14</option>
                                                                    <option label="15" value="15">15</option>
                                                                    <option label="16" value="16">16</option>
                                                                    <option label="17" value="17">17</option>
                                                                    <option label="18" value="18">18</option>
                                                                    <option label="19" value="19">19</option>
                                                                    <option label="20" value="20">20</option>
                                                                    <option label="21" value="21">21</option>
                                                                    <option label="22" value="22">22</option>
                                                                    <option label="23" value="23">23</option>
                                                                    <option label="24" value="24">24</option>
                                                                    <option label="25" value="25">25</option>
                                                                    <option label="26" value="26">26</option>
                                                                    <option label="27" value="27">27</option>
                                                                    <option label="28" value="28">28</option>
                                                                    <option label="29" value="29">29</option>
                                                                    <option label="30" value="30">30</option>
                                                                    <option label="31" value="31">31</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select id="month" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" name="month" ng-required="true" ng-change="vm.updateDateOfBirth(vm.birth.Day, vm.birth.Month, vm.birth.Year)" ng-options="month as month.name for month in vm.months track by month.id" ng-model="vm.birth.Month" required="required">
                                                                    <option translate="" value="" selected="selected">
                                                                        <span>Month</span>
                                                                    </option>
                                                                    <option label="January" value="January">January</option>
                                                                    <option label="February" value="February">February</option>
                                                                    <option label="March" value="March">March</option>
                                                                    <option label="April" value="April">April</option>
                                                                    <option label="May" value="May">May</option>
                                                                    <option label="June" value="June">June</option>
                                                                    <option label="July" value="July">July</option>
                                                                    <option label="August" value="August">August</option>
                                                                    <option label="September" value="September">September</option>
                                                                    <option label="October" value="October">October</option>
                                                                    <option label="November" value="November">November</option>
                                                                    <option label="December" value="December">December</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select id="year" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" name="year" ng-required="true" ng-change="vm.updateDateOfBirth(vm.birth.Day, vm.birth.Month, vm.birth.Year)" ng-options="year as year.name for year in vm.years track by year.id" ng-model="vm.birth.Year" required="required">
                                                                    <option translate="" value="" selected="selected">
                                                                        <span>Year</span>
                                                                    </option>
                                                                    <option label="1945" value="1945">1945</option>
                                                                    <option label="1946" value="1946">1946</option>
                                                                    <option label="1947" value="1947">1947</option>
                                                                    <option label="1948" value="1948">1948</option>
                                                                    <option label="1949" value="1949">1949</option>
                                                                    <option label="1950" value="1950">1950</option>
                                                                    <option label="1951" value="1951">1951</option>
                                                                    <option label="1952" value="1952">1952</option>
                                                                    <option label="1953" value="1953">1953</option>
                                                                    <option label="1954" value="1954">1954</option>
                                                                    <option label="1955" value="1955">1955</option>
                                                                    <option label="1956" value="1956">1956</option>
                                                                    <option label="1957" value="1957">1957</option>
                                                                    <option label="1958" value="1958">1958</option>
                                                                    <option label="1959" value="1959">1959</option>
                                                                    <option label="1960" value="1960">1960</option>
                                                                    <option label="1961" value="1961">1961</option>
                                                                    <option label="1962" value="1962">1962</option>
                                                                    <option label="1963" value="1963">1963</option>
                                                                    <option label="1964" value="1964">1964</option>
                                                                    <option label="1965" value="1965">1965</option>
                                                                    <option label="1966" value="1966">1966</option>
                                                                    <option label="1967" value="1967">1967</option>
                                                                    <option label="1968" value="1968">1968</option>
                                                                    <option label="1969" value="1969">1969</option>
                                                                    <option label="1970" value="1970">1970</option>
                                                                    <option label="1971" value="1971">1971</option>
                                                                    <option label="1972" value="1972">1972</option>
                                                                    <option label="1973" value="1973">1973</option>
                                                                    <option label="1974" value="1974">1974</option>
                                                                    <option label="1975" value="1975">1975</option>
                                                                    <option label="1976" value="1976">1976</option>
                                                                    <option label="1977" value="1977">1977</option>
                                                                    <option label="1978" value="1978">1978</option>
                                                                    <option label="1979" value="1979">1979</option>
                                                                    <option label="1980" value="1980">1980</option>
                                                                    <option label="1981" value="1981">1981</option>
                                                                    <option label="1982" value="1982">1982</option>
                                                                    <option label="1983" value="1983">1983</option>
                                                                    <option label="1984" value="1984">1984</option>
                                                                    <option label="1985" value="1985">1985</option>
                                                                    <option label="1986" value="1986">1986</option>
                                                                    <option label="1987" value="1987">1987</option>
                                                                    <option label="1988" value="1988">1988</option>
                                                                    <option label="1989" value="1989">1989</option>
                                                                    <option label="1990" value="1990">1990</option>
                                                                    <option label="1991" value="1991">1991</option>
                                                                    <option label="1992" value="1992">1992</option>
                                                                    <option label="1993" value="1993">1993</option>
                                                                    <option label="1994" value="1994">1994</option>
                                                                    <option label="1995" value="1995">1995</option>
                                                                    <option label="1996" value="1996">1996</option>
                                                                    <option label="1997" value="1997">1997</option>
                                                                    <option label="1998" value="1998">1998</option>
                                                                    <option label="1999" value="1999">1999</option>
                                                                    <option label="2000" value="2000">2000</option>
                                                                    <option label="2001" value="2001">2001</option>
                                                                    <option label="2002" value="2002">2002</option>
                                                                    <option label="2003" value="2003">2003</option>
                                                                    <option label="2004" value="2004">2004</option>
                                                                    <option label="2005" value="2005">2005</option>
                                                                    <option label="2006" value="2006">2006</option>
                                                                    <option label="2007" value="2007">2007</option>
                                                                    <option label="2008" value="2008">2008</option>
                                                                    <option label="2009" value="2009">2009</option>
                                                                    <option label="2010" value="2010">2010</option>
                                                                    <option label="2011" value="2011">2011</option>
                                                                    <option label="2012" value="2012">2012</option>
                                                                    <option label="2013" value="2013">2013</option>
                                                                    <option label="2014" value="2014">2014</option>
                                                                    <option label="2015" value="2015">2015</option>
                                                                    <option label="2016" value="2016">2016</option>
                                                                </select>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group" ng-class="{'has-error': ((registration['user-gender'].$touched) && registration['user-gender'].$invalid)}">
                                                        <label class="control-label text-left" translate="" for="ur-user-gender">
                                                            <span>GENDER</span>
                                                        </label>
                                                        <label>
                                                            <input id="ur-user-gender" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" type="radio" translate="" ng-required="true" value="Male" name="gender" ng-model="vm.candidate.gender" required="required">
                                                            Male
                                                        </label>
                                                        <label>
                                                            <input class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" type="radio" translate="" ng-required="true" value="Female" name="gender" ng-model="vm.candidate.gender" required="required">
                                                            Female
                                                        </label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group" ng-class="{'has-error': registration.$submitted && registration.usernationality.$invalid}">
                                                        <label class="control-label text-left" translate="" for="ur-user-nationality">
                                                            <span>NATIONALITY</span>
                                                        </label>
                                                        <select name="nationality" id="nationality" class="form-control custom-select ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                                                            <option value="?" selected="selected"></option>
                                                            <option label="Afghan" value="Afghan">Afghan</option>
                                                            <option label="Albanian" value="Albanian">Albanian</option>
                                                            <option label="Algerian" value="Algerian">Algerian</option>
                                                            <option label="American" value="American">American</option>
                                                            <option label="Andorran" value="Andorran">Andorran</option>
                                                            <option label="Angolan" value="Angolan">Angolan</option>
                                                            <option label="Antiguans" value="Antiguans">Antiguans</option>
                                                            <option label="Argentinean" value="Argentinean">Argentinean</option>
                                                            <option label="Armenian" value="Armenian">Armenian</option>
                                                            <option label="Australian" value="Australian">Australian</option>
                                                            <option label="Austrian" value="Austrian">Austrian</option>
                                                            <option label="Azerbaijani" value="Azerbaijani">Azerbaijani</option>
                                                            <option label="Bahamian" value="Bahamian">Bahamian</option>
                                                            <option label="Bahraini" value="Bahraini">Bahraini</option>
                                                            <option label="Bangladeshi" value="Bangladeshi">Bangladeshi</option>
                                                            <option label="Barbadian" value="Barbadian">Barbadian</option>
                                                            <option label="Barbudans" value="Barbudans">Barbudans</option>
                                                            <option label="Batswana" value="Batswana">Batswana</option>
                                                            <option label="Belarusian" value="Belarusian">Belarusian</option>
                                                            <option label="Belgian" value="Belgian">Belgian</option>
                                                            <option label="Belizean" value="Belizean">Belizean</option>
                                                            <option label="Beninese" value="Beninese">Beninese</option>
                                                            <option label="Bhutanese" value="Bhutanese">Bhutanese</option>
                                                            <option label="Bolivian" value="Bolivian">Bolivian</option>
                                                            <option label="Bosnian" value="Bosnian">Bosnian</option>
                                                            <option label="Brazilian" value="Brazilian">Brazilian</option>
                                                            <option label="British" value="British">British</option>
                                                            <option label="Bruneian" value="Bruneian">Bruneian</option>
                                                            <option label="Bulgarian" value="Bulgarian">Bulgarian</option>
                                                            <option label="Burkinabe" value="Burkinabe">Burkinabe</option>
                                                            <option label="Burmese" value="Burmese">Burmese</option>
                                                            <option label="Burundian" value="Burundian">Burundian</option>
                                                            <option label="Cambodian" value="Cambodian">Cambodian</option>
                                                            <option label="Cameroonian" value="Cameroonian">Cameroonian</option>
                                                            <option label="Canadian" value="Canadian">Canadian</option>
                                                            <option label="Cape Verdean" value="Cape Verdean">Cape Verdean</option>
                                                            <option label="Central African" value="Central African">Central African</option>
                                                            <option label="Chadian" value="Chadian">Chadian</option>
                                                            <option label="Chilean" value="Chilean">Chilean</option>
                                                            <option label="Chinese" value="Chinese">Chinese</option>
                                                            <option label="Colombian" value="Colombian">Colombian</option>
                                                            <option label="Comoran" value="Comoran">Comoran</option>
                                                            <option label="Congolese" value="Congolese">Congolese</option>
                                                            <option label="Costa Rican" value="Costa Rican">Costa Rican</option>
                                                            <option label="Croatian" value="Croatian">Croatian</option>
                                                            <option label="Cuban" value="Cuban">Cuban</option>
                                                            <option label="Cypriot" value="Cypriot">Cypriot</option>
                                                            <option label="Czech" value="Czech">Czech</option>
                                                            <option label="Danish" value="Danish">Danish</option>
                                                            <option label="Djibouti" value="Djibouti">Djibouti</option>
                                                            <option label="Dominican" value="Dominican">Dominican</option>
                                                            <option label="Dutch" value="Dutch">Dutch</option>
                                                            <option label="East Timorese" value="East Timorese">East Timorese</option>
                                                            <option label="Ecuadorean" value="Ecuadorean">Ecuadorean</option>
                                                            <option label="Egyptian" value="Egyptian">Egyptian</option>
                                                            <option label="Emirian" value="Emirian">Emirian</option>
                                                            <option label="Equatorial Guinean" value="Equatorial Guinean">Equatorial Guinean</option>
                                                            <option label="Eritrean" value="Eritrean">Eritrean</option>
                                                            <option label="Estonian" value="Estonian">Estonian</option>
                                                            <option label="Ethiopian" value="Ethiopian">Ethiopian</option>
                                                            <option label="Fijian" value="Fijian">Fijian</option>
                                                            <option label="Filipino" value="Filipino">Filipino</option>
                                                            <option label="Finnish" value="Finnish">Finnish</option>
                                                            <option label="French" value="French">French</option>
                                                            <option label="Gabonese" value="Gabonese">Gabonese</option>
                                                            <option label="Gambian" value="Gambian">Gambian</option>
                                                            <option label="Georgian" value="Georgian">Georgian</option>
                                                            <option label="German" value="German">German</option>
                                                            <option label="Ghanaian" value="Ghanaian">Ghanaian</option>
                                                            <option label="Greek" value="Greek">Greek</option>
                                                            <option label="Grenadian" value="Grenadian">Grenadian</option>
                                                            <option label="Guatemalan" value="Guatemalan">Guatemalan</option>
                                                            <option label="Guinea-Bissauan" value="Guinea-Bissauan">Guinea-Bissauan</option>
                                                            <option label="Guinean" value="Guinean">Guinean</option>
                                                            <option label="Guyanese" value="Guyanese">Guyanese</option>
                                                            <option label="Haitian" value="Haitian">Haitian</option>
                                                            <option label="Herzegovinian" value="Herzegovinian">Herzegovinian</option>
                                                            <option label="Honduran" value="Honduran">Honduran</option>
                                                            <option label="Hungarian" value="Hungarian">Hungarian</option>
                                                            <option label="I-Kiribati" value="I-Kiribati">I-Kiribati</option>
                                                            <option label="Icelander" value="Icelander">Icelander</option>
                                                            <option label="Indian" value="Indian">Indian</option>
                                                            <option label="Indonesian" value="Indonesian">Indonesian</option>
                                                            <option label="Iranian" value="Iranian">Iranian</option>
                                                            <option label="Iraqi" value="Iraqi">Iraqi</option>
                                                            <option label="Irish" value="Irish">Irish</option>
                                                            <option label="Israeli" value="Israeli">Israeli</option>
                                                            <option label="Italian" value="Italian">Italian</option>
                                                            <option label="Ivorian" value="Ivorian">Ivorian</option>
                                                            <option label="Jamaican" value="Jamaican">Jamaican</option>
                                                            <option label="Japanese" value="Japanese">Japanese</option>
                                                            <option label="Jordanian" value="Jordanian">Jordanian</option>
                                                            <option label="Kazakhstani" value="Kazakhstani">Kazakhstani</option>
                                                            <option label="Kenyan" value="Kenyan">Kenyan</option>
                                                            <option label="Kittian and Nevisian" value="Kittian and Nevisian">Kittian and Nevisian</option>
                                                            <option label="Kuwaiti" value="Kuwaiti">Kuwaiti</option>
                                                            <option label="Kyrgyz" value="Kyrgyz">Kyrgyz</option>
                                                            <option label="Laotian" value="Laotian">Laotian</option>
                                                            <option label="Latvian" value="Latvian">Latvian</option>
                                                            <option label="Lebanese" value="Lebanese">Lebanese</option>
                                                            <option label="Liberian" value="Liberian">Liberian</option>
                                                            <option label="Libyan" value="Libyan">Libyan</option>
                                                            <option label="Liechtensteiner" value="Liechtensteiner">Liechtensteiner</option>
                                                            <option label="Lithuanian" value="Lithuanian">Lithuanian</option>
                                                            <option label="Luxembourger" value="Luxembourger">Luxembourger</option>
                                                            <option label="Macedonian" value="Macedonian">Macedonian</option>
                                                            <option label="Malagasy" value="Malagasy">Malagasy</option>
                                                            <option label="Malawian" value="Malawian">Malawian</option>
                                                            <option label="Malaysian" value="Malaysian">Malaysian</option>
                                                            <option label="Maldivan" value="Maldivan">Maldivan</option>
                                                            <option label="Malian" value="Malian">Malian</option>
                                                            <option label="Maltese" value="Maltese">Maltese</option>
                                                            <option label="Marshallese" value="Marshallese">Marshallese</option>
                                                            <option label="Mauritanian" value="Mauritanian">Mauritanian</option>
                                                            <option label="Mauritian" value="Mauritian">Mauritian</option>
                                                            <option label="Mexican" value="Mexican">Mexican</option>
                                                            <option label="Micronesian" value="Micronesian">Micronesian</option>
                                                            <option label="Moldovan" value="Moldovan">Moldovan</option>
                                                            <option label="Monacan" value="Monacan">Monacan</option>
                                                            <option label="Mongolian" value="Mongolian">Mongolian</option>
                                                            <option label="Moroccan" value="Moroccan">Moroccan</option>
                                                            <option label="Mosotho" value="Mosotho">Mosotho</option>
                                                            <option label="Motswana" value="Motswana">Motswana</option>
                                                            <option label="Mozambican" value="Mozambican">Mozambican</option>
                                                            <option label="Namibian" value="Namibian">Namibian</option>
                                                            <option label="Nauruan" value="Nauruan">Nauruan</option>
                                                            <option label="Nepalese" value="Nepalese">Nepalese</option>
                                                            <option label="New Zealander" value="New Zealander">New Zealander</option>
                                                            <option label="Nicaraguan" value="Nicaraguan">Nicaraguan</option>
                                                            <option label="Nigerian" value="Nigerian">Nigerian</option>
                                                            <option label="Nigerien" value="Nigerien">Nigerien</option>
                                                            <option label="North Korean" value="North Korean">North Korean</option>
                                                            <option label="Northern Irish" value="Northern Irish">Northern Irish</option>
                                                            <option label="Norwegian" value="Norwegian">Norwegian</option>
                                                            <option label="Omani" value="Omani">Omani</option>
                                                            <option label="Pakistani" value="Pakistani">Pakistani</option>
                                                            <option label="Palauan" value="Palauan">Palauan</option>
                                                            <option label="Panamanian" value="Panamanian">Panamanian</option>
                                                            <option label="Papua New Guinean" value="Papua New Guinean">Papua New Guinean</option>
                                                            <option label="Paraguayan" value="Paraguayan">Paraguayan</option>
                                                            <option label="Peruvian" value="Peruvian">Peruvian</option>
                                                            <option label="Polish" value="Polish">Polish</option>
                                                            <option label="Portuguese" value="Portuguese">Portuguese</option>
                                                            <option label="Qatari" value="Qatari">Qatari</option>
                                                            <option label="Romanian" value="Romanian">Romanian</option>
                                                            <option label="Russian" value="Russian">Russian</option>
                                                            <option label="Rwandan" value="Rwandan">Rwandan</option>
                                                            <option label="Saint Lucian" value="Saint Lucian">Saint Lucian</option>
                                                            <option label="Salvadoran" value="Salvadoran">Salvadoran</option>
                                                            <option label="Samoan" value="Samoan">Samoan</option>
                                                            <option label="San Marinese" value="San Marinese">San Marinese</option>
                                                            <option label="Sao Tomean" value="Sao Tomean">Sao Tomean</option>
                                                            <option label="Saudi" value="Saudi">Saudi</option>
                                                            <option label="Scottish" value="Scottish">Scottish</option>
                                                            <option label="Senegalese" value="Senegalese">Senegalese</option>
                                                            <option label="Serbian" value="Serbian">Serbian</option>
                                                            <option label="Seychellois" value="Seychellois">Seychellois</option>
                                                            <option label="Sierra Leonean" value="Sierra Leonean">Sierra Leonean</option>
                                                            <option label="Singaporean" value="Singaporean">Singaporean</option>
                                                            <option label="Slovakian" value="Slovakian">Slovakian</option>
                                                            <option label="Slovenian" value="Slovenian">Slovenian</option>
                                                            <option label="Solomon Islander" value="Solomon Islander">Solomon Islander</option>
                                                            <option label="Somali" value="Somali">Somali</option>
                                                            <option label="South African" value="South African">South African</option>
                                                            <option label="South Korean" value="South Korean">South Korean</option>
                                                            <option label="Spanish" value="Spanish">Spanish</option>
                                                            <option label="Sri Lankan" value="Sri Lankan">Sri Lankan</option>
                                                            <option label="Sudanese" value="Sudanese">Sudanese</option>
                                                            <option label="Surinamer" value="Surinamer">Surinamer</option>
                                                            <option label="Swazi" value="Swazi">Swazi</option>
                                                            <option label="Swedish" value="Swedish">Swedish</option>
                                                            <option label="Swiss" value="Swiss">Swiss</option>
                                                            <option label="Syrian" value="Syrian">Syrian</option>
                                                            <option label="Taiwanese" value="Taiwanese">Taiwanese</option>
                                                            <option label="Tajik" value="Tajik">Tajik</option>
                                                            <option label="Tanzanian" value="Tanzanian">Tanzanian</option>
                                                            <option label="Thai" value="Thai">Thai</option>
                                                            <option label="Togolese" value="Togolese">Togolese</option>
                                                            <option label="Tongan" value="Tongan">Tongan</option>
                                                            <option label="Trinidadian or Tobagonian" value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option>
                                                            <option label="Tunisian" value="Tunisian">Tunisian</option>
                                                            <option label="Turkish" value="Turkish">Turkish</option>
                                                            <option label="Tuvaluan" value="Tuvaluan">Tuvaluan</option>
                                                            <option label="Ugandan" value="Ugandan">Ugandan</option>
                                                            <option label="Ukrainian" value="Ukrainian">Ukrainian</option>
                                                            <option label="Uruguayan" value="Uruguayan">Uruguayan</option>
                                                            <option label="Uzbekistani" value="Uzbekistani">Uzbekistani</option>
                                                            <option label="Venezuelan" value="Venezuelan">Venezuelan</option>
                                                            <option label="Vietnamese" value="Vietnamese">Vietnamese</option>
                                                            <option label="Welsh" value="Welsh">Welsh</option>
                                                            <option label="Yemenite" value="Yemenite">Yemenite</option>
                                                            <option label="Zambian" value="Zambian">Zambian</option>
                                                            <option label="Zimbabwean" value="Zimbabwean">Zimbabwean</option>
                                                        </select>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group" ng-class="{'has-error': ((registration.phone.$touched || registration.$submitted) && registration.phone.$invalid)}">
                                                        <label class="control-label text-left" translate="" for="ur-user-mobile">
                                                            <span>MOBILE PHONE NUMBER</span>
                                                        </label>
                                                        <input id="mobile" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="tel" placeholder="0123456789" ng-required="true" ng-pattern="/^[0-9\+]+$/" ng-maxlength="17" ng-minlength="10" name="mobile" ng-model="vm.candidate.phone" required="required">
                                                        <?php                                                                
                                                                if($errmob==1)
                                                                {
                                                                ?>
                                                                    <ul class="errors-tooltip">
                                                                        <li class="" translate="">
                                                                            <span>Mobile is required.</span>
                                                                        </li>
                                                                    </ul>
                                                                <?php                                                                    
                                                                }                                                                
                                                            ?>
                                                        </div>
                                                        <p class="note" translate="">
                                                            <span>E.g. 0123456789</span>
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-section" ng-if="vm.candidate.nationality != 'Malaysian' && vm.candidate.nationality != 'Malaysia'">
                                            <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                                <div class="form-group" ng-if="vm.candidate.nationality != 'Malaysian' && vm.candidate.nationality != 'Malaysia'">
                                                    <label class="control-label" translate="" for="ur-user-malaysia">
                                                        <span>Do you have the right to work in Saudi Arabia?</span>
                                                    </label>
                                                    <select id="sarights" class="form-control custom-select ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" ng-options="(item?'Yes':'No') for item in [true, false]" ng-required="vm.candidate.nationality != 'Malaysia' || vm.candidate.nationality != 'Malaysian'" name="sarights" ng-model="vm.candidate.rightToWorkInMalaysia" required="required">
                                                        <option value="?" selected="selected"></option>
                                                        <option label="Yes" value="Yes">Yes</option>
                                                        <option label="No" value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                            <div class="col-xs-12 col-sm-6 pull-left">
                                                <a class="btn-step prev btn pull-right" translate="" ui-sref="user-edit-profile.step-one" href="candidate-edit-1.php">
                                                    <span>PREVIOUS STEP</span>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 pull-right">
                                                <button class="btn-step btn pull-left" translate="" ng-disabled="vm.saving" type="submit">
                                                    <span>NEXT STEP</span>
                                                </button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
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