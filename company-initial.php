<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $companyname = $_POST{'companyname'};
    $businessabout = $_POST{'businessabout'};
    $jobcategory = $_POST{'jobcategory'};
    $location = $_POST{'location'};
    $contactname = $_POST{'contactname'};
    $contactphone = $_POST{'contactphone'};
    
    $success=0;
    $errname1=0;
    $errname2=0;
    $errloc=0;    
    $errcname=0;
    $errcphone=0;
    
    if(isset($companyname) && trim($companyname) == '')
    {
        $errname1=1;
    }
    if(isset($companyname))
    {
        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$companyname))
        {
            $errname2=1;
        }
    }
    
    if(isset($location) && trim($location) == '')
    {
        $errloc=1;
    }    
    
    if(isset($contactname) && trim($contactname) == '')
    {
        $errcname=1;
    }    
    
    if(isset($contactphone) && trim($contactphone) == '')
    {
        $errcphone=1;
    }
    
    
    if(isset($companyname) && isset($jobcategory) && isset($location) && isset($contactname) && isset($contactphone))
    {
        if(($errname1==0) && ($errname2==0) && ($errloc==0) && ($errcname==0) && ($errcphone==0))
        {
            $success=1;
        }
    }
    
    

    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');
                
        $sqlusercheck = "SELECT * FROM company WHERE email=\"$email\" AND password=\"$password\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $iname = $row['name'];            
            }
        }
    ?>
    <!DOCTYPE html>
    <html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
        <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
            <style type="text/css">
                .pac-container{background-color:#fff;position:absolute!important;z-index:1000;border-radius:2px;border-top:1px solid #d9d9d9;font-family:Arial,sans-serif;box-shadow:0 2px 6px rgba(0,0,0,0.3);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;overflow:hidden}.pac-logo:after{content:"";padding:1px 1px 1px 0;height:16px;text-align:right;display:block;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3.png);background-position:right;background-repeat:no-repeat;background-size:120px 14px}.hdpi.pac-logo:after{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3_hdpi.png)}.pac-item{cursor:default;padding:0 4px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;line-height:30px;text-align:left;border-top:1px solid #e6e6e6;font-size:11px;color:#999}.pac-item:hover{background-color:#fafafa}.pac-item-selected,.pac-item-selected:hover{background-color:#ebf2fe}.pac-matched{font-weight:700}.pac-item-query{font-size:13px;padding-right:3px;color:#000}.pac-icon{width:15px;height:20px;margin-right:7px;margin-top:6px;display:inline-block;vertical-align:top;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);background-size:34px}.hdpi .pac-icon{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons_hdpi.png)}.pac-icon-search{background-position:-1px -1px}.pac-item-selected .pac-icon-search{background-position:-18px -1px}.pac-icon-marker{background-position:-1px -161px}.pac-item-selected .pac-icon-marker{background-position:-18px -161px}.pac-placeholder{color:gray}
            </style>
            <style type="text/css">
                .pac-container{background-color:#fff;position:absolute!important;z-index:1000;border-radius:2px;border-top:1px solid #d9d9d9;font-family:Arial,sans-serif;box-shadow:0 2px 6px rgba(0,0,0,0.3);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;overflow:hidden}.pac-logo:after{content:"";padding:1px 1px 1px 0;height:16px;text-align:right;display:block;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3.png);background-position:right;background-repeat:no-repeat;background-size:120px 14px}.hdpi.pac-logo:after{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3_hdpi.png)}.pac-item{cursor:default;padding:0 4px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;line-height:30px;text-align:left;border-top:1px solid #e6e6e6;font-size:11px;color:#999}.pac-item:hover{background-color:#fafafa}.pac-item-selected,.pac-item-selected:hover{background-color:#ebf2fe}.pac-matched{font-weight:700}.pac-item-query{font-size:13px;padding-right:3px;color:#000}.pac-icon{width:15px;height:20px;margin-right:7px;margin-top:6px;display:inline-block;vertical-align:top;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);background-size:34px}.hdpi .pac-icon{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons_hdpi.png)}.pac-icon-search{background-position:-1px -1px}.pac-item-selected .pac-icon-search{background-position:-18px -1px}.pac-icon-marker{background-position:-1px -161px}.pac-item-selected .pac-icon-marker{background-position:-18px -161px}.pac-placeholder{color:gray}
            </style>
            <style type="text/css">
                .pac-container{background-color:#fff;position:absolute!important;z-index:1000;border-radius:2px;border-top:1px solid #d9d9d9;font-family:Arial,sans-serif;box-shadow:0 2px 6px rgba(0,0,0,0.3);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;overflow:hidden}.pac-logo:after{content:"";padding:1px 1px 1px 0;height:16px;text-align:right;display:block;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3.png);background-position:right;background-repeat:no-repeat;background-size:120px 14px}.hdpi.pac-logo:after{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3_hdpi.png)}.pac-item{cursor:default;padding:0 4px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;line-height:30px;text-align:left;border-top:1px solid #e6e6e6;font-size:11px;color:#999}.pac-item:hover{background-color:#fafafa}.pac-item-selected,.pac-item-selected:hover{background-color:#ebf2fe}.pac-matched{font-weight:700}.pac-item-query{font-size:13px;padding-right:3px;color:#000}.pac-icon{width:15px;height:20px;margin-right:7px;margin-top:6px;display:inline-block;vertical-align:top;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);background-size:34px}.hdpi .pac-icon{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons_hdpi.png)}.pac-icon-search{background-position:-1px -1px}.pac-item-selected .pac-icon-search{background-position:-18px -1px}.pac-icon-marker{background-position:-1px -161px}.pac-item-selected .pac-icon-marker{background-position:-18px -161px}.pac-placeholder{color:gray}
            </style>
            <style type="text/css">
                .pac-container{background-color:#fff;position:absolute!important;z-index:1000;border-radius:2px;border-top:1px solid #d9d9d9;font-family:Arial,sans-serif;box-shadow:0 2px 6px rgba(0,0,0,0.3);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;overflow:hidden}.pac-logo:after{content:"";padding:1px 1px 1px 0;height:16px;text-align:right;display:block;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3.png);background-position:right;background-repeat:no-repeat;background-size:120px 14px}.hdpi.pac-logo:after{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/powered-by-google-on-white3_hdpi.png)}.pac-item{cursor:default;padding:0 4px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;line-height:30px;text-align:left;border-top:1px solid #e6e6e6;font-size:11px;color:#999}.pac-item:hover{background-color:#fafafa}.pac-item-selected,.pac-item-selected:hover{background-color:#ebf2fe}.pac-matched{font-weight:700}.pac-item-query{font-size:13px;padding-right:3px;color:#000}.pac-icon{width:15px;height:20px;margin-right:7px;margin-top:6px;display:inline-block;vertical-align:top;background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons.png);background-size:34px}.hdpi .pac-icon{background-image:url(https://maps.gstatic.com/mapfiles/api-3/images/autocomplete-icons_hdpi.png)}.pac-icon-search{background-position:-1px -1px}.pac-item-selected .pac-icon-search{background-position:-18px -1px}.pac-icon-marker{background-position:-1px -161px}.pac-item-selected .pac-icon-marker{background-position:-18px -161px}.pac-placeholder{color:gray}
            </style>
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
            
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
            <title page-title="">Register - myjob.sa</title>
            <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
            <meta content="" name="description">
            <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta content="#e5202d" name="theme-color">
            <meta content="!" name="fragment">
            <link href="styles.min.css?v=36391" rel="stylesheet">

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
        </head>
        <body class="">
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
                                        <img ng-src="wordpress/wp-content/themes/scootwp/assets/images/logo.png" src="wordpress/wp-content/themes/scootwp/assets/images/logo.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="nav-secondary-wrapper hidden-xs">
                            <div class="container" ng-if="isCompany()">
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
                                        <span>Employer Registration</span>
                                    </h1>                                                                        
                                    
                                </div>
                                <form class="ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-dirty ng-valid-parse ng-submitted" novalidate="" name="registration" ng-submit="submit()" enctype='multipart/form-data' method='POST'>
                                <div class="form-section upload-logo">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="gap-20"></div>
                                        <div class="col-xs-12 col-sm-5">
                                            <div class="user-edit-image text-center">
                                                <div class="user-edit-image" ng-class="{'user-image': company.businesses[0].profileImg && company.businesses[0].profileImg != 'images/companies/logo-placeholder.jpg'}" style="background-image: url('images/companies/logo-placeholder.jpg');" ng-if="!showLoader">
                                                    <initials candidate-surname="2" candidate-name="M" font="115" size="170" ng-if="!company.businesses[0].profileImg || company.businesses[0].profileImg == 'images/companies/logo-placeholder.jpg'">
                                                        <div class="scoot-initials " style="width: 170px; height: 170px; line-height: 170px; font-size: 115px;">
                                                            <span><?php echo substr($iname, 0, 2); ?></span>
                                                        </div>
                                                    </initials>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-xs-12 col-sm-7 text-left">

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
                                                        && ($_FILES["photo"]["size"] < 300000))                                                                         
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

                                                            $sqlie = "UPDATE company SET image=\"$new_file_name\" WHERE email=\"$email\" AND password=\"$password\";";
                                                            $resie = mysql_query($sqlie);
                                                            
                                                            if($success==1)
                                                            {
                                                                $sqlupd="UPDATE company SET 
                                                                            name=\"$companyname\",
                                                                            description=\"$businessabout\",
                                                                            industry=\"$jobcategory\",
                                                                            location=\"$location\",
                                                                            cname=\"$contactname\",
                                                                            cnumber=\"$contactphone\" 
                                                                            WHERE email=\"$email\" AND password=\"$password\";";
                                                                $resupd=mysql_query($sqlupd);
                                                                echo '<META http-equiv="refresh" content="0;URL=company-dashboard.php">';
                                                            }
                                                            
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

                                            <label class="control-label text-left">Set Your Company Apart!</label>
                                            <div>
                                                <p class="note" translate="">
                                                    <span>Accepted file types are jpg, png, jpeg, bmp and gif (300x300)</span>
                                                </p>
                                            </div>
                                            <div class="btn-cv upload scoot-load-img">
                                                <i class="fa fa-upload"></i>
                                                Upload Logo
                                                <input name="photo" type="file" />
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group">
                                            <label class="control-label" for="company-name">COMPANY NAME</label>
                                            <input id="companyname" name="companyname" class="form-control ng-pristine ng-untouched ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-not-empty ng-valid ng-valid-required" type="text" value="<?php echo $iname; ?>">
                                            
                                            <?php                                                                
                                                if($errname1==1)
                                                {
                                                ?>
                                                    <ul class="errors-tooltip">
                                                        <li class="" translate="">
                                                            <span>Company name is required.</span>
                                                        </li>
                                                    </ul>
                                                <?php                                                                    
                                                }
                                                if($errname2==1)
                                                {
                                                    if(!preg_match("/^[a-zA-Z0-9 ]*$/",$companyname))
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
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group">
                                            <label class="control-label" translate="" for="business-about">
                                                <span>BUSINESS DESCRIPTION (Optional)</span>
                                            </label>
                                                                                                
                                            <textarea id="businessabout" name="businessabout" class="form-control" style="height: 200px;"></textarea>                                                
                                            
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group">
                                            <label class="control-label" translate="" for="job-category">
                                                <span>INDUSTRY</span>
                                            </label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <select id="jobcategory" name="jobcategory" class="chosen-select ng-untouched localytics-chosen ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required" data-placeholder="Select an option" ng-required="true" tabindex="-1" style="width: 100%;" ng-options="c.id as c.name for c in categories | orderBy: 'name'" ng-model="company.businesses[0].categoryId" chosen="" required="required">
                                                        <option label="Administration & Management" value="Administration & Management">Administration & Management</option>
                                                        <option label="Beauty & Healthcare" value="Beauty & Healthcare">Beauty & Healthcare</option>
                                                        <option label="Computer & IT" value="Computer & IT">Computer & IT</option>
                                                        <option label="Customer Service, Sales & Retail" value="Customer Service, Sales & Retail">Customer Service, Sales & Retail</option>
                                                        <option label="Design, Art & Language" value="Design, Art & Language">Design, Art & Language</option>
                                                        <option label="Education & Training" value="Education & Training">Education & Training</option>
                                                        <option label="Engineering" value="Engineering">Engineering</option>
                                                        <option label="Financial & Legal Services" value="Financial & Legal Services">Financial & Legal Services</option>
                                                        <option label="Hospitality, Food & Tourism" value="Hospitality, Food & Tourism">Hospitality, Food & Tourism</option>
                                                        <option label="Labour & Construction" value="Labour & Construction">Labour & Construction</option>
                                                        <option label="Manufacturing" value="Manufacturing">Manufacturing</option>
                                                        <option label="Marketing" value="Marketing">Marketing</option>
                                                        <option label="Others" value="Others">Others</option>
                                                        <option label="Property" value="Property">Property</option>
                                                        <option label="Transportation & Logistics" value="Transportation & Logistics">Transportation & Logistics</option>
                                                    </select>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <label class="control-label">LOCATION</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input id="location" name="location" class="form-control input-block-level form-control ng-dirty ng-valid-parse ng-empty ng-invalid ng-invalid-required ng-touched" type="text" placeholder="Enter your location"  required="required">
                                                <p class="note">Key in your location as accurately as possible to receive relevant candidate matches.</p>
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
                                        </div>
                                    </div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-section">
                                <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                    <div class="form-group">
                                        <label class="control-label" translate="" for="contact-name">
                                            <span>CONTACT NAME</span>
                                        </label>
                                        <input id="contactname" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" ng-maxlength="32" ng-minlength="2" ng-pattern="/^[a-zA-Z ]+$/" ng-required="true" name="contactname" ng-model="company.contactName" required="required">
                                        <?php
                                            if($errcname==1)
                                            {
                                        ?>
                                            <ul class="errors-tooltip">
                                                <li>Should not be empty.</li>
                                            </ul>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group" ng-class="{'has-error': ((registration.phone.$touched || isSubmitted[1]) && registration.phone.$invalid)}">
                                        <label class="control-label" translate="" for="contact-phone">
                                            <span>CONTACT NUMBER</span>
                                        </label>
                                        <input id="contactphone" class="form-control ng-pristine ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength ng-touched" type="text" placeholder="0123456789" ng-required="true" ng-pattern="/^[0-9\+]+$/" ng-maxlength="17" ng-minlength="10" name="contactphone" ng-model="company.contactPhone" required="required">
                                        <p class="note text-center" translate="">
                                            <span>These contact details will NOT be shared with job seekers, and will only be used for us to get in touch with you if required.</span>
                                        </p>
                                        <?php
                                            if($errcphone==1)
                                            {
                                        ?>
                                            <ul class="errors-tooltip">
                                                <li>Please key in your mobile number.</li>
                                            </ul>
                                        <?php
                                            }
                                        ?>                                        
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="text-center">
                                <input class="btn btn-step" type="submit" value="COMPLETE REGISTRATION">
                            </div>
                            </form>
                            <div class="clearfix"></div>
                            <span style="display:none;">false</span>
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