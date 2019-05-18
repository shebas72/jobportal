<?php
    session_start();

    $email=$_SESSION['email'];
    $password=$_SESSION['password'];

    $institution = $_POST['institution'];
    $course = $_POST['course'];
    $estart = $_POST['estart'];
    $eend = $_POST['eend'];
    $ecurrent = $_POST['ecurrent'];
    
    $company = $_POST['company'];
    $position = $_POST['position'];
    $wstart = $_POST['wstart'];
    $wend = $_POST['wend'];
    $wcurrent = $_POST['wcurrent'];
    
    $experience = $_POST['experience'];
    $about = $_POST['about'];    
    $edulevel = $_POST['edulevel'];
    $languages = $_POST['languages'];
    $languagesall = implode(',', (array)$languages);

    $success=0;        

    if(isset($edulevel) && trim($edulevel) == '')
    {
        $erredulevel=1;
    }
    
    if(isset($edulevel) && trim($edulevel) != '')
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
                $uid = $row['id'];            
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
                                <li class="" ui-sref="user-edit-profile.step-two" ui-sref-active="active" href="/client/user/edit-profile/step-two">
                                    <a>
                                        <strong>2</strong>
                                        <p>Basic information</p>
                                    </a>
                                </li>
                                <li ui-sref="user-edit-profile.step-three" ui-sref-active="active" href="/client/user/edit-profile/step-three" class="active">
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
                                        experience=\"$experience\",
                                        about=\"$about\",
                                        edulevel=\"$edulevel\",
                                        languages=\"$languages\"                                                    
                                        WHERE email=\"$email\" AND password=\"$password\";";
                                        $resupd=mysql_query($sqlupd);
                                        
                                        if(isset($institution) && trim($institution) != '')
                                        {
                                            $sqlins1 = "INSERT INTO ca_education(uid,institution,course,start,end,current) VALUES(\"$uid\",\"$institution\",\"$course\",\"$estart\",\"$eend\",\"$ecurrent\");";
                                            $resins1=mysql_query($sqlins1);
                                        }
                                        
                                        if(isset($company) && trim($company) != '')
                                        {
                                            $sqlins2 = "INSERT INTO ca_experience(uid,company,position,start,end,current) VALUES(\"$uid\",\"$company\",\"$position\",\"$wstart\",\"$wend\",\"$wcurrent\");";
                                            $resins2=mysql_query($sqlins2);
                                        }                                        
                                        
                                        echo '<META http-equiv="refresh" content="0;URL=candidate-dashboard.php">';
                                    }
                                ?>

                                <form class="ng-pristine ng-valid-pattern ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" novalidate="" name="registration" ng-submit="vm.save(registration.$valid)" method="post">
                                    <div class="user-edit-match animated fadeIn step-page">
                                        <div class="animated fadeIn step-page">
                                            <div class="form-section">
                                                <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 education-block">
                                                    <div class="form-group" ng-repeat="item in vm.candidate.education">
                                                        <label class="control-label" translate="">
                                                            <span>EDUCATION</span>                                                            
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div>
                                                                    <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="text" placeholder="Institution Name" ng-required="true" ng-maxlength="64" ng-minlength="2" name="institution" ng-model="item.institution" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div>
                                                                    <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="text" placeholder="Course name" ng-required="true" ng-maxlength="64" ng-minlength="2" name="course" ng-model="item.course" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="col-xs-12 col-sm-6 edu-year">
                                                                <div class="input-group">
                                                                    <select name="estart"  placeholder="Year Started" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" ng-required="true" required="required">
                                                                        <option label="Year Started" value="">Year Started</option>
                                                                        <option label="2016" value="2016">2016</option>
                                                                        <option label="2015" value="2015">2015</option>
                                                                        <option label="2014" value="2014">2014</option>
                                                                        <option label="2013" value="2013">2013</option>
                                                                        <option label="2012" value="2012">2012</option>
                                                                        <option label="2011" value="2011">2011</option>
                                                                        <option label="2010" value="2010">2010</option>
                                                                        <option label="2009" value="2009">2009</option>
                                                                        <option label="2008" value="2008">2008</option>
                                                                        <option label="2007" value="2007">2007</option>
                                                                        <option label="2006" value="2006">2006</option>
                                                                        <option label="2005" value="2005">2005</option>
                                                                        <option label="2004" value="2004">2004</option>
                                                                        <option label="2003" value="2003">2003</option>
                                                                        <option label="2002" value="2002">2002</option>
                                                                        <option label="2001" value="2001">2001</option>
                                                                        <option label="2000" value="2000">2000</option>
                                                                        <option label="1999" value="1999">1999</option>
                                                                        <option label="1998" value="1998">1998</option>
                                                                        <option label="1997" value="1997">1997</option>
                                                                        <option label="1996" value="1996">1996</option>
                                                                        <option label="1995" value="1995">1995</option>
                                                                        <option label="1994" value="1994">1994</option>
                                                                        <option label="1993" value="1993">1993</option>
                                                                        <option label="1992" value="1992">1992</option>
                                                                        <option label="1991" value="1991">1991</option>
                                                                        <option label="1990" value="1990">1990</option>
                                                                        <option label="1989" value="1989">1989</option>
                                                                        <option label="1988" value="1988">1988</option>
                                                                        <option label="1987" value="1987">1987</option>
                                                                        <option label="1986" value="1986">1986</option>
                                                                        <option label="1985" value="1985">1985</option>
                                                                        <option label="1984" value="1984">1984</option>
                                                                        <option label="1983" value="1983">1983</option>
                                                                        <option label="1982" value="1982">1982</option>
                                                                        <option label="1981" value="1981">1981</option>
                                                                        <option label="1980" value="1980">1980</option>
                                                                        <option label="1979" value="1979">1979</option>
                                                                        <option label="1978" value="1978">1978</option>
                                                                        <option label="1977" value="1977">1977</option>
                                                                        <option label="1976" value="1976">1976</option>
                                                                        <option label="1975" value="1975">1975</option>
                                                                        <option label="1974" value="1974">1974</option>
                                                                        <option label="1973" value="1973">1973</option>
                                                                        <option label="1972" value="1972">1972</option>
                                                                        <option label="1971" value="1971">1971</option>
                                                                        <option label="1970" value="1970">1970</option>
                                                                        <option label="1969" value="1969">1969</option>
                                                                        <option label="1968" value="1968">1968</option>
                                                                        <option label="1967" value="1967">1967</option>
                                                                        <option label="1966" value="1966">1966</option>
                                                                        <option label="1965" value="1965">1965</option>
                                                                        <option label="1964" value="1964">1964</option>
                                                                        <option label="1963" value="1963">1963</option>
                                                                        <option label="1962" value="1962">1962</option>
                                                                        <option label="1961" value="1961">1961</option>
                                                                        <option label="1960" value="1960">1960</option>
                                                                        <option label="1959" value="1959">1959</option>
                                                                        <option label="1958" value="1958">1958</option>
                                                                        <option label="1957" value="1957">1957</option>
                                                                        <option label="1956" value="1956">1956</option>
                                                                        <option label="1955" value="1955">1955</option>
                                                                        <option label="1954" value="1954">1954</option>
                                                                        <option label="1953" value="1953">1953</option>
                                                                        <option label="1952" value="1952">1952</option>
                                                                        <option label="1951" value="1951">1951</option>
                                                                        <option label="1950" value="1950">1950</option>
                                                                        <option label="1949" value="1949">1949</option>
                                                                        <option label="1948" value="1948">1948</option>
                                                                        <option label="1947" value="1947">1947</option>
                                                                        <option label="1946" value="1946">1946</option>
                                                                        <option label="1945" value="1945">1945</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 edu-year">
                                                                <div class="input-group" ng-class="(!vm.isNewItemDatesValid(item)) ? 'has-error' : ''" ng-if="!item.presentTime">
                                                                    <select name="eend"  placeholder="Year Graduated" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" ng-required="true" required="required">
                                                                        <option label="Year Ended" value="">Year Ended</option>
                                                                        <option label="2016" value="2016">2016</option>
                                                                        <option label="2015" value="2015">2015</option>
                                                                        <option label="2014" value="2014">2014</option>
                                                                        <option label="2013" value="2013">2013</option>
                                                                        <option label="2012" value="2012">2012</option>
                                                                        <option label="2011" value="2011">2011</option>
                                                                        <option label="2010" value="2010">2010</option>
                                                                        <option label="2009" value="2009">2009</option>
                                                                        <option label="2008" value="2008">2008</option>
                                                                        <option label="2007" value="2007">2007</option>
                                                                        <option label="2006" value="2006">2006</option>
                                                                        <option label="2005" value="2005">2005</option>
                                                                        <option label="2004" value="2004">2004</option>
                                                                        <option label="2003" value="2003">2003</option>
                                                                        <option label="2002" value="2002">2002</option>
                                                                        <option label="2001" value="2001">2001</option>
                                                                        <option label="2000" value="2000">2000</option>
                                                                        <option label="1999" value="1999">1999</option>
                                                                        <option label="1998" value="1998">1998</option>
                                                                        <option label="1997" value="1997">1997</option>
                                                                        <option label="1996" value="1996">1996</option>
                                                                        <option label="1995" value="1995">1995</option>
                                                                        <option label="1994" value="1994">1994</option>
                                                                        <option label="1993" value="1993">1993</option>
                                                                        <option label="1992" value="1992">1992</option>
                                                                        <option label="1991" value="1991">1991</option>
                                                                        <option label="1990" value="1990">1990</option>
                                                                        <option label="1989" value="1989">1989</option>
                                                                        <option label="1988" value="1988">1988</option>
                                                                        <option label="1987" value="1987">1987</option>
                                                                        <option label="1986" value="1986">1986</option>
                                                                        <option label="1985" value="1985">1985</option>
                                                                        <option label="1984" value="1984">1984</option>
                                                                        <option label="1983" value="1983">1983</option>
                                                                        <option label="1982" value="1982">1982</option>
                                                                        <option label="1981" value="1981">1981</option>
                                                                        <option label="1980" value="1980">1980</option>
                                                                        <option label="1979" value="1979">1979</option>
                                                                        <option label="1978" value="1978">1978</option>
                                                                        <option label="1977" value="1977">1977</option>
                                                                        <option label="1976" value="1976">1976</option>
                                                                        <option label="1975" value="1975">1975</option>
                                                                        <option label="1974" value="1974">1974</option>
                                                                        <option label="1973" value="1973">1973</option>
                                                                        <option label="1972" value="1972">1972</option>
                                                                        <option label="1971" value="1971">1971</option>
                                                                        <option label="1970" value="1970">1970</option>
                                                                        <option label="1969" value="1969">1969</option>
                                                                        <option label="1968" value="1968">1968</option>
                                                                        <option label="1967" value="1967">1967</option>
                                                                        <option label="1966" value="1966">1966</option>
                                                                        <option label="1965" value="1965">1965</option>
                                                                        <option label="1964" value="1964">1964</option>
                                                                        <option label="1963" value="1963">1963</option>
                                                                        <option label="1962" value="1962">1962</option>
                                                                        <option label="1961" value="1961">1961</option>
                                                                        <option label="1960" value="1960">1960</option>
                                                                        <option label="1959" value="1959">1959</option>
                                                                        <option label="1958" value="1958">1958</option>
                                                                        <option label="1957" value="1957">1957</option>
                                                                        <option label="1956" value="1956">1956</option>
                                                                        <option label="1955" value="1955">1955</option>
                                                                        <option label="1954" value="1954">1954</option>
                                                                        <option label="1953" value="1953">1953</option>
                                                                        <option label="1952" value="1952">1952</option>
                                                                        <option label="1951" value="1951">1951</option>
                                                                        <option label="1950" value="1950">1950</option>
                                                                        <option label="1949" value="1949">1949</option>
                                                                        <option label="1948" value="1948">1948</option>
                                                                        <option label="1947" value="1947">1947</option>
                                                                        <option label="1946" value="1946">1946</option>
                                                                        <option label="1945" value="1945">1945</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="col-xs-12 col-sm-6">
                                                                <label for="userPresentEducation0AvPT31kgJjJOSOwT">
                                                                    <input id="ecurrent" class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" ng-change="vm.currentStudying(item)" ng-model="item.presentTime" name="ecurrent" value="Yes">
                                                                    Currently Studying Here
                                                                </label>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="form-section">
                                            <div class="user-edit-edu">
                                                <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 education-block">
                                                    <br />
                                                    <label style="font-weight:bold;">
                                                        <input name="experience" class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" ng-model="vm.candidate.noWorkingExperience">
                                                        I Have no Working Experience
                                                    </label>
                                                    <hr>
                                                    <div class="form-group" ng-repeat="item in vm.candidate.experience track by $index" ng-if="!vm.candidate.noWorkingExperience">
                                                        <label class="control-label" translate="">
                                                            <span>EXPERIENCE</span>                                                            
                                                        </label>
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div ng-class="{'has-error': ((registration['userexpcompany0' + item.id].$touched || registration.$submitted) && registration['userexpcompany0' + item.id].$invalid)}">
                                                                        <input name="company" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="text" placeholder="Enter the name of your company">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div ng-class="{'has-error': ((registration['userexpposition0' + item.id].$touched || registration.$submitted) && registration['userexpposition0' + item.id].$invalid)}">
                                                                        <input name="position" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="text" placeholder="Position">
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-xs-12 col-sm-6 edu-year">
                                                                    <div class="input-group" ng-class="(!vm.isNewItemDatesValid(item)) ? 'has-error' : ''">
                                                                        <select name="wstart"  placeholder="Year Started" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" ng-required="true" required="required">
                                                                            <option label="Year Started" value="">Year Started</option>
                                                                            <option label="2016" value="2016">2016</option>
                                                                            <option label="2015" value="2015">2015</option>
                                                                            <option label="2014" value="2014">2014</option>
                                                                            <option label="2013" value="2013">2013</option>
                                                                            <option label="2012" value="2012">2012</option>
                                                                            <option label="2011" value="2011">2011</option>
                                                                            <option label="2010" value="2010">2010</option>
                                                                            <option label="2009" value="2009">2009</option>
                                                                            <option label="2008" value="2008">2008</option>
                                                                            <option label="2007" value="2007">2007</option>
                                                                            <option label="2006" value="2006">2006</option>
                                                                            <option label="2005" value="2005">2005</option>
                                                                            <option label="2004" value="2004">2004</option>
                                                                            <option label="2003" value="2003">2003</option>
                                                                            <option label="2002" value="2002">2002</option>
                                                                            <option label="2001" value="2001">2001</option>
                                                                            <option label="2000" value="2000">2000</option>
                                                                            <option label="1999" value="1999">1999</option>
                                                                            <option label="1998" value="1998">1998</option>
                                                                            <option label="1997" value="1997">1997</option>
                                                                            <option label="1996" value="1996">1996</option>
                                                                            <option label="1995" value="1995">1995</option>
                                                                            <option label="1994" value="1994">1994</option>
                                                                            <option label="1993" value="1993">1993</option>
                                                                            <option label="1992" value="1992">1992</option>
                                                                            <option label="1991" value="1991">1991</option>
                                                                            <option label="1990" value="1990">1990</option>
                                                                            <option label="1989" value="1989">1989</option>
                                                                            <option label="1988" value="1988">1988</option>
                                                                            <option label="1987" value="1987">1987</option>
                                                                            <option label="1986" value="1986">1986</option>
                                                                            <option label="1985" value="1985">1985</option>
                                                                            <option label="1984" value="1984">1984</option>
                                                                            <option label="1983" value="1983">1983</option>
                                                                            <option label="1982" value="1982">1982</option>
                                                                            <option label="1981" value="1981">1981</option>
                                                                            <option label="1980" value="1980">1980</option>
                                                                            <option label="1979" value="1979">1979</option>
                                                                            <option label="1978" value="1978">1978</option>
                                                                            <option label="1977" value="1977">1977</option>
                                                                            <option label="1976" value="1976">1976</option>
                                                                            <option label="1975" value="1975">1975</option>
                                                                            <option label="1974" value="1974">1974</option>
                                                                            <option label="1973" value="1973">1973</option>
                                                                            <option label="1972" value="1972">1972</option>
                                                                            <option label="1971" value="1971">1971</option>
                                                                            <option label="1970" value="1970">1970</option>
                                                                            <option label="1969" value="1969">1969</option>
                                                                            <option label="1968" value="1968">1968</option>
                                                                            <option label="1967" value="1967">1967</option>
                                                                            <option label="1966" value="1966">1966</option>
                                                                            <option label="1965" value="1965">1965</option>
                                                                            <option label="1964" value="1964">1964</option>
                                                                            <option label="1963" value="1963">1963</option>
                                                                            <option label="1962" value="1962">1962</option>
                                                                            <option label="1961" value="1961">1961</option>
                                                                            <option label="1960" value="1960">1960</option>
                                                                            <option label="1959" value="1959">1959</option>
                                                                            <option label="1958" value="1958">1958</option>
                                                                            <option label="1957" value="1957">1957</option>
                                                                            <option label="1956" value="1956">1956</option>
                                                                            <option label="1955" value="1955">1955</option>
                                                                            <option label="1954" value="1954">1954</option>
                                                                            <option label="1953" value="1953">1953</option>
                                                                            <option label="1952" value="1952">1952</option>
                                                                            <option label="1951" value="1951">1951</option>
                                                                            <option label="1950" value="1950">1950</option>
                                                                            <option label="1949" value="1949">1949</option>
                                                                            <option label="1948" value="1948">1948</option>
                                                                            <option label="1947" value="1947">1947</option>
                                                                            <option label="1946" value="1946">1946</option>
                                                                            <option label="1945" value="1945">1945</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-6 edu-year">
                                                                    <div class="input-group" ng-class="(!vm.isNewItemDatesValid(item)) ? 'has-error' : ''" ng-if="!item.presentTime">
                                                                        <select name="wend"  placeholder="Year Graduated" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required" ng-required="true" required="required">
                                                                            <option label="Year Ended" value="">Year Ended</option>
                                                                            <option label="2016" value="2016">2016</option>
                                                                            <option label="2015" value="2015">2015</option>
                                                                            <option label="2014" value="2014">2014</option>
                                                                            <option label="2013" value="2013">2013</option>
                                                                            <option label="2012" value="2012">2012</option>
                                                                            <option label="2011" value="2011">2011</option>
                                                                            <option label="2010" value="2010">2010</option>
                                                                            <option label="2009" value="2009">2009</option>
                                                                            <option label="2008" value="2008">2008</option>
                                                                            <option label="2007" value="2007">2007</option>
                                                                            <option label="2006" value="2006">2006</option>
                                                                            <option label="2005" value="2005">2005</option>
                                                                            <option label="2004" value="2004">2004</option>
                                                                            <option label="2003" value="2003">2003</option>
                                                                            <option label="2002" value="2002">2002</option>
                                                                            <option label="2001" value="2001">2001</option>
                                                                            <option label="2000" value="2000">2000</option>
                                                                            <option label="1999" value="1999">1999</option>
                                                                            <option label="1998" value="1998">1998</option>
                                                                            <option label="1997" value="1997">1997</option>
                                                                            <option label="1996" value="1996">1996</option>
                                                                            <option label="1995" value="1995">1995</option>
                                                                            <option label="1994" value="1994">1994</option>
                                                                            <option label="1993" value="1993">1993</option>
                                                                            <option label="1992" value="1992">1992</option>
                                                                            <option label="1991" value="1991">1991</option>
                                                                            <option label="1990" value="1990">1990</option>
                                                                            <option label="1989" value="1989">1989</option>
                                                                            <option label="1988" value="1988">1988</option>
                                                                            <option label="1987" value="1987">1987</option>
                                                                            <option label="1986" value="1986">1986</option>
                                                                            <option label="1985" value="1985">1985</option>
                                                                            <option label="1984" value="1984">1984</option>
                                                                            <option label="1983" value="1983">1983</option>
                                                                            <option label="1982" value="1982">1982</option>
                                                                            <option label="1981" value="1981">1981</option>
                                                                            <option label="1980" value="1980">1980</option>
                                                                            <option label="1979" value="1979">1979</option>
                                                                            <option label="1978" value="1978">1978</option>
                                                                            <option label="1977" value="1977">1977</option>
                                                                            <option label="1976" value="1976">1976</option>
                                                                            <option label="1975" value="1975">1975</option>
                                                                            <option label="1974" value="1974">1974</option>
                                                                            <option label="1973" value="1973">1973</option>
                                                                            <option label="1972" value="1972">1972</option>
                                                                            <option label="1971" value="1971">1971</option>
                                                                            <option label="1970" value="1970">1970</option>
                                                                            <option label="1969" value="1969">1969</option>
                                                                            <option label="1968" value="1968">1968</option>
                                                                            <option label="1967" value="1967">1967</option>
                                                                            <option label="1966" value="1966">1966</option>
                                                                            <option label="1965" value="1965">1965</option>
                                                                            <option label="1964" value="1964">1964</option>
                                                                            <option label="1963" value="1963">1963</option>
                                                                            <option label="1962" value="1962">1962</option>
                                                                            <option label="1961" value="1961">1961</option>
                                                                            <option label="1960" value="1960">1960</option>
                                                                            <option label="1959" value="1959">1959</option>
                                                                            <option label="1958" value="1958">1958</option>
                                                                            <option label="1957" value="1957">1957</option>
                                                                            <option label="1956" value="1956">1956</option>
                                                                            <option label="1955" value="1955">1955</option>
                                                                            <option label="1954" value="1954">1954</option>
                                                                            <option label="1953" value="1953">1953</option>
                                                                            <option label="1952" value="1952">1952</option>
                                                                            <option label="1951" value="1951">1951</option>
                                                                            <option label="1950" value="1950">1950</option>
                                                                            <option label="1949" value="1949">1949</option>
                                                                            <option label="1948" value="1948">1948</option>
                                                                            <option label="1947" value="1947">1947</option>
                                                                            <option label="1946" value="1946">1946</option>
                                                                            <option label="1945" value="1945">1945</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-xs-12 col-sm-6">
                                                                    <label for="userPresentWork0VcbPzHBPlOPaaAEQ">
                                                                        <input id="wcurrent" class="ng-pristine ng-untouched ng-valid ng-empty" type="checkbox" ng-change="vm.currentWorking(item)" ng-model="item.presentTime" name="wcurrent">
                                                                        Currently Working Here
                                                                    </label>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div> </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="form-section">
                                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                                        <div class="form-group" ng-class="{'has-error': ((registration.userabout.$dirty || registration.$submitted) && (vm.stripAllTags(vm.candidate.about).length < 50 || vm.stripAllTags(vm.candidate.about).length > 500))}">
                                                            <label class="control-label" translate="" for="ur-user-about">
                                                                <span>ABOUT ME</span>
                                                            </label>
                                                            <div class="wysiwyg-greyish">
                                                                <div id="ur-user-about" class="ng-empty ng-valid ng-valid-pattern" wrap="virtual" name="userabout" textarea-height="350px" textarea-class="form-control form-not-scroll-x">                                                                    
                                                                    <textarea style="width: 100%;" rows="6" name="about"></textarea>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-section">
                                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                                        <div class="form-group" ng-class="{'has-error': ((registration.educationLevel.$touched || registration.$submitted) && registration.educationLevel.$invalid)}">
                                                            <label class="control-label" translate="" for="ur-education-level">
                                                                <span>EDUCATION LEVEL</span>
                                                            </label>
                                                            <select id="edulevel" class="form-control custom-select ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" ng-required="true" ng-options="l.id as l.name for l in vm.educationOptions" ng-model="vm.candidate.typeOfEducationId" name="edulevel" required="required">
                                                                <option value="?" selected="selected"></option>
                                                                <option label="In High School" value="In High School">In High School</option>
                                                                <option label="Completed High School" value="Completed High School">Completed High School</option>
                                                                <option label="Completing Degree/Diploma" value="Completing Degree/Diploma">Completing Degree/Diploma</option>
                                                                <option label="Completed Degree/Diploma" value="Completed Degree/Diploma">Completed Degree/Diploma</option>
                                                                <option label="Completing Postgraduate Studies" value="Completing Postgraduate Studies">Completing Postgraduate Studies</option>
                                                                <option label="Completed Postgraduate Studies" value="Completed Postgraduate Studies">Completed Postgraduate Studies</option>
                                                            </select>
                                                            <?php                                                                
                                                                if($erredulevel==1)
                                                                {
                                                                ?>
                                                                <ul class="errors-tooltip">
                                                                    <li class="" translate="">
                                                                        <span>Education Level is required.</span>
                                                                    </li>
                                                                </ul>
                                                                <?php                                                                    
                                                                }                                                                
                                                            ?>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-section">
                                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                                        <div class="form-group" ng-class="{'has-error': ((registration.candLanguages.$touched || registration.$submitted) && registration.candLanguages.$invalid)}">
                                                            <label class="control-label" translate="" for="user-languages">
                                                                <span>LANGUAGES</span>
                                                            </label>
                                                            <div class="row">
                                                                <div class="col-xs-12 force-width-100">
                                                                    <select class="chosen-select form-control ng-pristine ng-untouched localytics-chosen ng-empty ng-invalid ng-invalid-required" ng-required="true" name="languages" ng-model="vm.candidate.languages" multiple="multiple" chosen="" required="required" data-placeholder="Select Some Options" style="height: 200px;">
                                                                        <option label="Afar " value="Afar">Afar</option>
                                                                        <option label="Akan " value="Akan">Akan</option>
                                                                        <option label="Albanian " value="Albanian">Albanian</option>
                                                                        <option label="Amharic " value="Amharic">Amharic</option>
                                                                        <option label="Arabic " value="Arabic">Arabic</option>
                                                                        <option label="Aragonese " value="Aragonese">Aragonese</option>
                                                                        <option label="Armenian " value="Armenian">Armenian</option>
                                                                        <option label="Assamese " value="Assamese">Assamese</option>
                                                                        <option label="Avaric " value="Avaric">Avaric</option>
                                                                        <option label="Avestan " value="Avestan">Avestan</option>
                                                                        <option label="Aymara " value="Aymara">Aymara</option>
                                                                        <option label="Azerbaijani " value="Azerbaijani">Azerbaijani</option>
                                                                        <option label="Bahasa Malaysia " value="Bahasa Malaysia">Bahasa Malaysia</option>
                                                                        <option label="Bambara " value="Bambara">Bambara</option>
                                                                        <option label="Bashkir " value="Bashkir">Bashkir</option>
                                                                        <option label="Basque " value="Basque">Basque</option>
                                                                        <option label="Belarusian " value="Belarusian">Belarusian</option>
                                                                        <option label="Bengali " value="Bengali">Bengali</option>
                                                                        <option label="Bihari " value="Bihari">Bihari</option>
                                                                        <option label="Bislama " value="Bislama">Bislama</option>
                                                                        <option label="Bosnian " value="Bosnian">Bosnian</option>
                                                                        <option label="Breton " value="Breton">Breton</option>
                                                                        <option label="Bulgarian " value="Bulgarian">Bulgarian</option>
                                                                        <option label="Burmese " value="Burmese">Burmese</option>
                                                                        <option label="Cantonese " value="Cantonese">Cantonese</option>
                                                                        <option label="Catalan; Valencian " value="Catalan; Valencian">Catalan; Valencian</option>
                                                                        <option label="Chamorro " value="Chamorro">Chamorro</option>
                                                                        <option label="Chechen " value="Chechen">Chechen</option>
                                                                        <option label="Chichewa; Chewa; Nyanja " value="Chichewa; Chewa; Nyanja">Chichewa; Chewa; Nyanja</option>
                                                                        <option label="Chuvash " value="Chuvash">Chuvash</option>
                                                                        <option label="Cornish " value="Cornish">Cornish</option>
                                                                        <option label="Corsican " value="Corsican">Corsican</option>
                                                                        <option label="Cree " value="Cree">Cree</option>
                                                                        <option label="Croatian " value="Croatian">Croatian</option>
                                                                        <option label="Czech " value="Czech">Czech</option>
                                                                        <option label="Danish " value="Danish">Danish</option>
                                                                        <option label="Divehi; Dhivehi; Maldivian; " value="Divehi; Dhivehi; Maldivian;">Divehi; Dhivehi; Maldivian;</option>
                                                                        <option label="Dutch " value="Dutch">Dutch</option>
                                                                        <option label="English " value="English">English</option>
                                                                        <option label="Esperanto " value="Esperanto">Esperanto</option>
                                                                        <option label="Estonian " value="Estonian">Estonian</option>
                                                                        <option label="Ewe " value="Ewe">Ewe</option>
                                                                        <option label="Faroese " value="Faroese">Faroese</option>
                                                                        <option label="Fijian " value="Fijian">Fijian</option>
                                                                        <option label="Finnish " value="Finnish">Finnish</option>
                                                                        <option label="French " value="French">French</option>
                                                                        <option label="Fula; Fulah; Pulaar; Pular " value="Fula; Fulah; Pulaar; Pular">Fula; Fulah; Pulaar; Pular</option>
                                                                        <option label="Galician " value="Galician">Galician</option>
                                                                        <option label="Georgian " value="Georgian">Georgian</option>
                                                                        <option label="German " value="German">German</option>
                                                                        <option label="Greek / Modern " value="Greek / Modern">Greek / Modern</option>
                                                                        <option label="Guaraní " value="Guaraní">Guaraní</option>
                                                                        <option label="Gujarati " value="Gujarati">Gujarati</option>
                                                                        <option label="Haitian; Haitian Creole " value="Haitian; Haitian Creole">Haitian; Haitian Creole</option>
                                                                        <option label="Hausa " value="Hausa">Hausa</option>
                                                                        <option label="Hebrew (modern) " value="Hebrew (modern)">Hebrew (modern)</option>
                                                                        <option label="Herero " value="Herero">Herero</option>
                                                                        <option label="Hindi " value="Hindi">Hindi</option>
                                                                        <option label="Hiri Motu " value="Hiri Motu">Hiri Motu</option>
                                                                        <option label="Hokkien " value="Hokkien">Hokkien</option>
                                                                        <option label="Hungarian " value="Hungarian">Hungarian</option>
                                                                        <option label="Icelandic " value="Icelandic">Icelandic</option>
                                                                        <option label="Ido " value="Ido">Ido</option>
                                                                        <option label="Igbo " value="Igbo">Igbo</option>
                                                                        <option label="Indonesian " value="Indonesian">Indonesian</option>
                                                                        <option label="Interlingua " value="Interlingua">Interlingua</option>
                                                                        <option label="Interlingue " value="Interlingue">Interlingue</option>
                                                                        <option label="Inuktitut " value="Inuktitut">Inuktitut</option>
                                                                        <option label="Inupiaq " value="Inupiaq">Inupiaq</option>
                                                                        <option label="Irish " value="Irish">Irish</option>
                                                                        <option label="Italian " value="Italian">Italian</option>
                                                                        <option label="Japanese " value="Japanese">Japanese</option>
                                                                        <option label="Javanese " value="Javanese">Javanese</option>
                                                                        <option label="Kalaallisut / Greenlandic " value="Kalaallisut / Greenlandic">Kalaallisut / Greenlandic</option>
                                                                        <option label="Kannada " value="Kannada">Kannada</option>
                                                                        <option label="Kanuri " value="Kanuri">Kanuri</option>
                                                                        <option label="Kashmiri " value="Kashmiri">Kashmiri</option>
                                                                        <option label="Kazakh " value="Kazakh">Kazakh</option>
                                                                        <option label="Khmer " value="Khmer">Khmer</option>
                                                                        <option label="Kikuyu / Gikuyu " value="Kikuyu / Gikuyu">Kikuyu / Gikuyu</option>
                                                                        <option label="Kinyarwanda " value="Kinyarwanda">Kinyarwanda</option>
                                                                        <option label="Kirghiz / Kyrgyz " value="Kirghiz / Kyrgyz">Kirghiz / Kyrgyz</option>
                                                                        <option label="Kirundi " value="Kirundi">Kirundi</option>
                                                                        <option label="Komi " value="Komi">Komi</option>
                                                                        <option label="Kongo " value="Kongo">Kongo</option>
                                                                        <option label="Korean " value="Korean">Korean</option>
                                                                        <option label="Kurdish " value="Kurdish">Kurdish</option>
                                                                        <option label="Kwanyama / Kuanyama " value="Kwanyama / Kuanyama">Kwanyama / Kuanyama</option>
                                                                        <option label="Lao " value="Lao">Lao</option>
                                                                        <option label="Latin " value="Latin">Latin</option>
                                                                        <option label="Latvian " value="Latvian">Latvian</option>
                                                                        <option label="Limburgish / Limburgan / Limburger " value="Limburgish / Limburgan / Limburger">Limburgish / Limburgan / Limburger</option>
                                                                        <option label="Lingala " value="Lingala">Lingala</option>
                                                                        <option label="Lithuanian " value="Lithuanian">Lithuanian</option>
                                                                        <option label="Luba-Katanga " value="Luba-Katanga">Luba-Katanga</option>
                                                                        <option label="Luganda " value="Luganda">Luganda</option>
                                                                        <option label="Luxembourgish / Letzeburgesch " value="Luxembourgish / Letzeburgesch">Luxembourgish / Letzeburgesch</option>
                                                                        <option label="Macedonian " value="Macedonian">Macedonian</option>
                                                                        <option label="Malagasy " value="Malagasy">Malagasy</option>
                                                                        <option label="Malayalam " value="Malayalam">Malayalam</option>
                                                                        <option label="Maltese " value="Maltese">Maltese</option>
                                                                        <option label="Mandarin " value="Mandarin">Mandarin</option>
                                                                        <option label="Manx " value="Manx">Manx</option>
                                                                        <option label="Marathi (Marāṭhī) " value="Marathi (Marāṭhī)">Marathi (Marāṭhī)</option>
                                                                        <option label="Marshallese " value="Marshallese">Marshallese</option>
                                                                        <option label="Mongolian " value="Mongolian">Mongolian</option>
                                                                        <option label="Māori " value="Māori">Māori</option>
                                                                        <option label="Nauru " value="Nauru">Nauru</option>
                                                                        <option label="Navajo / Navaho " value="Navajo / Navaho">Navajo / Navaho</option>
                                                                        <option label="Ndonga " value="Ndonga">Ndonga</option>
                                                                        <option label="Nepali " value="Nepali">Nepali</option>
                                                                        <option label="North Ndebele " value="North Ndebele">North Ndebele</option>
                                                                        <option label="Northern Sami " value="Northern Sami">Northern Sami</option>
                                                                        <option label="Norwegian " value="Norwegian">Norwegian</option>
                                                                        <option label="Norwegian Bokmål " value="Norwegian Bokmål">Norwegian Bokmål</option>
                                                                        <option label="Norwegian Nynorsk " value="Norwegian Nynorsk">Norwegian Nynorsk</option>
                                                                        <option label="Nuosu " value="Nuosu">Nuosu</option>
                                                                        <option label="Occitan " value="Occitan">Occitan</option>
                                                                        <option label="Ojibwe / Ojibwa " value="Ojibwe / Ojibwa">Ojibwe / Ojibwa</option>
                                                                        <option label="Oriya " value="Oriya">Oriya</option>
                                                                        <option label="Oromo " value="Oromo">Oromo</option>
                                                                        <option label="Ossetian / Ossetic " value="Ossetian / Ossetic">Ossetian / Ossetic</option>
                                                                        <option label="Panjabi / Punjabi " value="Panjabi / Punjabi">Panjabi / Punjabi</option>
                                                                        <option label="Pashto / Pushto " value="Pashto / Pushto">Pashto / Pushto</option>
                                                                        <option label="Persian " value="Persian">Persian</option>
                                                                        <option label="Polish " value="Polish">Polish</option>
                                                                        <option label="Portuguese " value="Portuguese">Portuguese</option>
                                                                        <option label="Pāli " value="Pāli">Pāli</option>
                                                                        <option label="Quechua " value="Quechua">Quechua</option>
                                                                        <option label="Romanian / Moldavian / Moldovan " value="Romanian / Moldavian / Moldovan">Romanian / Moldavian / Moldovan</option>
                                                                        <option label="Romansh " value="Romansh">Romansh</option>
                                                                        <option label="Russian " value="Russian">Russian</option>
                                                                        <option label="Samoan " value="Samoan">Samoan</option>
                                                                        <option label="Sango " value="Sango">Sango</option>
                                                                        <option label="Sanskrit (Saṁskṛta) " value="Sanskrit (Saṁskṛta)">Sanskrit (Saṁskṛta)</option>
                                                                        <option label="Sardinian " value="Sardinian">Sardinian</option>
                                                                        <option label="Scottish Gaelic; Gaelic " value="Scottish Gaelic; Gaelic">Scottish Gaelic; Gaelic</option>
                                                                        <option label="Serbian " value="Serbian">Serbian</option>
                                                                        <option label="Shona " value="Shona">Shona</option>
                                                                        <option label="Sindhi " value="Sindhi">Sindhi</option>
                                                                        <option label="Sinhala / Sinhalese " value="Sinhala / Sinhalese">Sinhala / Sinhalese</option>
                                                                        <option label="Slovak " value="Slovak">Slovak</option>
                                                                        <option label="Slovene " value="Slovene">Slovene</option>
                                                                        <option label="Somali " value="Somali">Somali</option>
                                                                        <option label="South Ndebele " value="South Ndebele">South Ndebele</option>
                                                                        <option label="Southern Sotho " value="Southern Sotho">Southern Sotho</option>
                                                                        <option label="Spanish; Castilian " value="Spanish; Castilian">Spanish; Castilian</option>
                                                                        <option label="Sundanese " value="Sundanese">Sundanese</option>
                                                                        <option label="Swahili " value="Swahili">Swahili</option>
                                                                        <option label="Swati " value="Swati">Swati</option>
                                                                        <option label="Swedish " value="Swedish">Swedish</option>
                                                                        <option label="Tagalog " value="Tagalog">Tagalog</option>
                                                                        <option label="Tahitian " value="Tahitian">Tahitian</option>
                                                                        <option label="Tajik " value="Tajik">Tajik</option>
                                                                        <option label="Tamil " value="Tamil">Tamil</option>
                                                                        <option label="Tatar " value="Tatar">Tatar</option>
                                                                        <option label="Telugu " value="Telugu">Telugu</option>
                                                                        <option label="Thai " value="Thai">Thai</option>
                                                                        <option label="Tibetan Standard / Tibetan / Central " value="Tibetan Standard / Tibetan / Central">Tibetan Standard / Tibetan / Central</option>
                                                                        <option label="Tigrinya " value="Tigrinya">Tigrinya</option>
                                                                        <option label="Tonga (Tonga Islands) " value="Tonga (Tonga Islands)">Tonga (Tonga Islands)</option>
                                                                        <option label="Tsonga " value="Tsonga">Tsonga</option>
                                                                        <option label="Tswana " value="Tswana">Tswana</option>
                                                                        <option label="Turkish " value="Turkish">Turkish</option>
                                                                        <option label="Turkmen " value="Turkmen">Turkmen</option>
                                                                        <option label="Twi " value="Twi">Twi</option>
                                                                        <option label="Uighur / Uyghur " value="Uighur / Uyghur">Uighur / Uyghur</option>
                                                                        <option label="Ukrainian " value="Ukrainian">Ukrainian</option>
                                                                        <option label="Urdu " value="Urdu">Urdu</option>
                                                                        <option label="Uzbek " value="Uzbek">Uzbek</option>
                                                                        <option label="Venda " value="Venda">Venda</option>
                                                                        <option label="Vietnamese " value="Vietnamese">Vietnamese</option>
                                                                        <option label="Volapük " value="Volapük">Volapük</option>
                                                                        <option label="Walloon " value="Walloon">Walloon</option>
                                                                        <option label="Welsh " value="Welsh">Welsh</option>
                                                                        <option label="Western Frisian " value="Western Frisian">Western Frisian</option>
                                                                        <option label="Wolof " value="Wolof">Wolof</option>
                                                                        <option label="Xhosa " value="Xhosa">Xhosa</option>
                                                                        <option label="Yiddish " value="Yiddish">Yiddish</option>
                                                                        <option label="Yoruba " value="Yoruba">Yoruba</option>
                                                                        <option label="Zhuang / Chuang " value="Zhuang / Chuang">Zhuang / Chuang</option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 pull-right">
                                                        <button class="btn-step btn pull-left" translate="" ng-disabled="vm.saving" type="submit">
                                                            <span>DONE</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 pull-left">
                                                        <a class="btn-step prev btn pull-right" translate="" ui-sref="user-edit-profile.step-two" href="candidate-edit-2.php">
                                                            <span>PREVIOUS STEP</span>
                                                        </a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
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