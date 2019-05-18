<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $companyname = $_POST{'businessname'};
    $businessabout = $_POST{'businessabout'};
    $jobcategory = $_POST{'jobcategory'};
    $location = $_POST{'location'};
    
    
    $success=0;
    $errname1=0;
    $errname2=0;
    $errloc=0;    
    
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
    
    
    if(isset($companyname) && isset($jobcategory) && isset($location))
    {
        if(($errname1==0) && ($errname2==0) && ($errloc==0))
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
                $cid = $row['id'];            
                $iname = $row['name'];            
            }
        }
    ?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Add Business - myjob.sa</title>
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
                <div class="business-add-page user-edit-page user-register-page post-a-job">
                    <div class="container">
                        <div class="company-register">
                            <div class="page-header-title text-center">
                                <h1 class="heading" translate="">
                                    <span>Add Business</span>                                    
                                </h1>
                            </div>
                            <form class="ng-pristine ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" ng-submit="vm.create()" novalidate="" name="addBusinessForm" method="post" enctype='multipart/form-data'>
                                <div class="form-section upload-logo">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="gap-20"></div>
                                        <div class="col-xs-12 col-sm-5">
                                            <div class="user-edit-image text-center">
                                                <div class="user-edit-image business-edit-image" ng-class="{'user-image': vm.business.profileImg && vm.business.profileImg != 'images/logo-placeholder.jpg'}" style="background-image: url('images/logo-placeholder.jpg');" ng-if="!vm.showLoader"> </div>
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

                                                            move_uploaded_file($_FILES['photo']['tmp_name'], 'profile/'.$new_file_name);
                                                            
                                                            if($success==1)
                                                            {
                                                                $sqlusercheck = "SELECT * FROM business WHERE name=\"$companyname\";";    
                                                                $resusercheck = mysql_query($sqlusercheck);                                                                
                                                                if(mysql_num_rows($resusercheck) == 0)
                                                                {
                                                                    $sqlupd="INSERT INTO business(cid,image,name,description,industry,location) VALUES(\"$cid\", \"$new_file_name\", \"$companyname\", \"$businessabout\", \"$jobcategory\", \"$location\");";
                                                                    $resupd=mysql_query($sqlupd);                                                                                                                                                                                                
                                                                    echo 'SUCCESS...<META http-equiv="refresh" content="0;URL=company-dashboard.php">';
                                                                }
                                                                else
                                                                {
                                                                    echo 'Business Name Already Exist!';
                                                                }
                                                            }
                                                            
                                                        ?>                                                        
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
                                        <div class="form-group" ng-class="{'has-error': ((addBusinessForm.name.$touched || addBusinessForm.$submitted) && addBusinessForm.name.$invalid)}">
                                            <label class="control-label" translate="" for="business-name">
                                                <span>BUSINESS NAME</span>
                                            </label>
                                            <input id="businessname" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern ng-valid-minlength ng-valid-maxlength" type="text" placeholder="Name" ng-pattern="/^[a-zA-Z0-9- ]+$/" ng-required="true" required-on-touch="true" ng-maxlength="32" ng-minlength="2" ng-model="vm.business.name" name="businessname" required="required">
                                            <?php                                                                
                                                if($errname1==1)
                                                {
                                                ?>
                                                    <ul class="errors-tooltip">
                                                        <li class="" translate="">
                                                            <span>Business name is required.</span>
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
                                                <span>BUSINESS DESCRIPTION</span>
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
                                <div class="job-edit-cta">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 pull-right">
                                            <button class="btn-step btn pull-left" translate="" type="submit">
                                                <span>ADD BUSINESS</span>
                                            </button>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 pull-left">
                                            <button class="btn-step prev btn pull-right" translate="" type="button" onclick="window.location.href = 'company-dashboard.php'">
                                                <span>GO BACK</span>
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
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