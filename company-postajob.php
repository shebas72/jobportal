<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    
    $bid = $_GET['bid'];
    $bbid = $_POST{'bbid'};
    
    $jobtitle = $_POST['jobtitle'];
    $jobabout = $_POST['jobabout'];
    $benefits = $_POST['benefits'];
    $benefitsall = implode(',', (array)$benefits);
    $etype = $_POST['etype'];    
    $etypeall = implode(',', (array)$etype);
    $jobcategory = $_POST['jobcategory'];
    $jrole = $_POST['jrole'];
    $skillcert = $_POST['skillcert'];
    $skillcertall = implode(',', (array)$skillcert);    
    $jlocation = $_POST['jlocation'];
    $salaryfrom = $_POST['salaryfrom'];
    $salaryto = $_POST['salaryto'];
    $salaryperiod = $_POST['salaryperiod'];
    $jobsalaryhide = $_POST['jobsalaryhide'];
    $jobeducation = $_POST['jobeducation'];
    $acceptsforeigners = $_POST['acceptsforeigners'];
    $language = $_POST['language'];
    $languageall = implode(',', (array)$language);
    
    $success=0;
    $errname=0;
    
    if(isset($jobtitle) && trim($jobtitle) == '')
    {
        $errname=1;
    }
    
    if(isset($jobtitle))
    {
        if(($errname==0))
        {
            $success=1;
        }
    }
    
    if(($_SESSION['email'])&&($_SESSION['password']))
    {

        include('inc.php');
                
        $sqlusercheck = "SELECT * FROM business WHERE id=\"$bid\";";    
        $resusercheck = mysql_query($sqlusercheck);                                                                
        if(mysql_num_rows($resusercheck) == 1) 
        {
            while($row = mysql_fetch_array($resusercheck)) 
            {
                $bcid = $row['cid'];            
                $bname = $row['name'];            
                $bimage = $row['image'];            
                $bdescription = $row['description'];            
                $bindustry = $row['industry'];            
                $blocation = $row['location'];            
                $bcname = $row['cname'];            
                $bcnumber = $row['cnumber'];            
            }
        }
    
?>
<!DOCTYPE html>
<html class="no-js" lang="en" ng-strict-di="" ng-app="scootApp">
    <head>        
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title page-title="">Add Job - myjob.sa</title>
        <link rel="shortcut icon" href="images/favicon.png" type="image/png" />
        <meta content="" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="#e5202d" name="theme-color">
        <meta content="!" name="fragment">
        <link href="styles.min.css?v=23402" rel="stylesheet"></link>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    </head>
    <body class="" style="">
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
                                <?php include('company-topmenu.php'); ?>                                 <div class="clearfix"></div>
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
                    <div class="nav-secondary-wrapper hidden-xs">
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
                <div class="job-edit-page user-edit-page user-register-page post-a-job">
                    <div class="page-header-title text-center">
                        <h1 class="heading" translate="">
                            <span>Post a job</span>
                        </h1>
                        
                        <?php
                            if($success==1)
                            {
                                $sql="INSERT INTO jobs(bid, cid, isactive, jobtitle, jobabout, benefits, etype, jobcategory, jrole, skillcert, jlocation, salaryfrom, salaryto, salaryperiod, jobsalaryhide, jobeducation, acceptsforeigners, language) 
                                        VALUES (\"$bbid\", \"$bcid\", \"0\", \"$jobtitle\", \"$jobabout\", \"$benefitsall\", \"$etypeall\", \"$jobcategory\", \"$jrole\", \"$skillcertall\", \"$jlocation\", \"$salaryfrom\", \"$salaryto\", \"$salaryperiod\", \"$jobsalaryhide\", \"$jobeducation\", \"$acceptsforeigners\", \"$languageall\");";
                                $res=mysql_query($sql);
                                $last_id=mysql_insert_id();
                                echo '<META http-equiv="refresh" content="0;URL=company-previewjob.php?jid='.$last_id.'">';
                            }
                        ?>
                        
                    </div>
                    <div class="container">
                        <form class="ng-invalid ng-invalid-required ng-valid-maxlength ng-valid-pattern ng-dirty ng-valid-minlength ng-valid-parse" novalidate="" name="addJobForm" method="post">
                            <div class="clearfix"></div>
                            <div class="form-job-details">
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group">
                                            <label class="control-label" translate="" for="job-title">
                                                <span>JOB TITLE</span>
                                            </label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input id="jobtitle" name="jobtitle" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" type="text" ng-required="true" ng-maxlength="70" ng-minlength="3" ng-model="job.title" placeholder="Start Typing Job Title" required="required">
                                                    <?php                                                                
                                                    if($errname==1)
                                                    {
                                                    ?>
                                                        <ul class="errors-tooltip">
                                                            <li class="" translate="">
                                                                <span>Job Title is required.</span>
                                                            </li>
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
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="form-group" ng-class="{'has-error': ((addJobForm.$submitted || addJobForm.jobTitle.$touched) && addJobForm.jobDescription.$invalid)}">
                                            <label class="control-label" translate="" for="job-description">
                                                <span>JOB DESCRIPTION</span>
                                            </label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <textarea id="jobabout" name="jobabout" class="form-control" style="height: 200px;"></textarea>
                                                    <p class="note" translate="">
                                                        <span>Describe the job role as accurately as you can to attract quality talent.</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 ">
                                        <div class="form-section half">
                                            <div class="form-group col-xs-12 col-md-8 col-md-push-2 text-left">
                                                <label class="control-label text-left" translate="">
                                                    <span>BENEFITS</span>
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Company trips">
                                                    Company trips
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Gym/fitness memberships">
                                                    Gym/fitness memberships
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Medical insurance">
                                                    Medical insurance
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Parking allowance">
                                                    Parking allowance
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Pension scheme">
                                                    Pension scheme
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Team building activities">
                                                    Team building activities
                                                </label>
                                                <label class="col-xs-12 row-2">
                                                    <input  type="checkbox" name="benefits[]" value="Training">
                                                    Training
                                                </label>                                                                                                                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 ">
                                        <div class="form-section half">
                                            <div class="form-group col-xs-12 col-md-8 col-md-push-2 text-left">
                                                <label class="control-label text-left" translate="" for="job-type-of-employment">
                                                    <span>TYPE OF EMPLOYMENT</span>
                                                </label>
                                                <label id="job-type-of-employment" class="col-xs-12 row-2" >
                                                    <input  type="checkbox" name="etype[]" value="Full Time">
                                                    Full Time
                                                </label>
                                                <label id="job-type-of-employment" class="col-xs-12 row-2" >
                                                    <input  type="checkbox" name="etype[]" value="Part Time">
                                                    Part Time
                                                </label>
                                                <label id="job-type-of-employment" class="col-xs-12 row-2" >
                                                    <input  type="checkbox" name="etype[]" value="Internship">
                                                    Internship
                                                </label>
                                                <label id="job-type-of-employment" class="col-xs-12 row-2" >
                                                    <input  type="checkbox" name="etype[]" value="Volunteer">
                                                    Volunteer
                                                </label>
                                                <label id="job-type-of-employment" class="col-xs-12 row-2" >
                                                    <input  type="checkbox" name="etype[]" value="Freelance / Temporary">
                                                    Freelance / Temporary
                                                </label>
                                                <label id="job-type-of-employment" class="col-xs-12 row-2" >
                                                    <input  type="checkbox" name="etype[]" value="Fresh Graduate">
                                                    Fresh Graduate
                                                </label>                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-section">
                                    <div class="col-xs-12 col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                                        <div class="job-requirements">
                                            <div class="form-group">
                                                <label class="control-label" translate="" for="job-category">
                                                    <span>JOB CATEGORY</span>
                                                </label>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <select id="jobcategory" name="jobcategory" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty">
                                                            <option value="Admin, HR & Management">Admin, HR & Management</option>
                                                            <option value="Beauty & Healthcare">Beauty & Healthcare</option>
                                                            <option value="Computer & IT">Computer & IT</option>
                                                            <option value="Construction & Property">Construction & Property</option>
                                                            <option value="Customer Service, Sales & Retail">Customer Service, Sales & Retail</option>
                                                            <option value="Design, Media & Entertainment">Design, Media & Entertainment</option>
                                                            <option value="Education & Training">Education & Training</option>
                                                            <option value="Engineering">Engineering</option>
                                                            <option value="Financial & Legal Services">Financial & Legal Services</option>
                                                            <option value="Hospitality, Food & Tourism">Hospitality, Food & Tourism</option>
                                                            <option value="Manufacturing">Manufacturing</option>
                                                            <option value="Marketing">Marketing</option>
                                                            <option value="Others">Others</option>
                                                            <option value="Transportation & Logistics">Transportation & Logistics</option>
                                                        </select>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" translate="">
                                                        <span>JOB ROLE</span>
                                                    </label>
                                                    <div class="col-sm-12 force-width-100">
                                                        <input type="text" id="jrole" name="jrole" class="input-block-level form-control ng-empty ng-valid" type="text" placeholder="Enter the key role">                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group" >
                                                    <label class="col-sm-7 control-label" translate="">
                                                        <span>SKILLS & CERTIFICATES</span>
                                                    </label>
                                                    <div class="gap-10"></div>
                                                    <div class="col-sm-12">
                                                        <select id="skillcert[]" name="skillcert[]" class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty"  data-placeholder="Select One" multiple="multiple" style="min-height: 200px;">
                                                            <option value="12D ">12D </option>
                                                            <option value="3D Software ">3D Software </option>
                                                            <option value="3D Studio Max ">3D Studio Max </option>
                                                            <option value="Account Management ">Account Management </option>
                                                            <option value="Accounting ">Accounting </option>
                                                            <option value="Accounts Payable and Receivable ">Accounts Payable and Receivable </option>
                                                            <option value="Acting ">Acting </option>
                                                            <option value="Administrative Assistant ">Administrative Assistant </option>
                                                            <option value="Adobe After Effect ">Adobe After Effect </option>
                                                            <option value="Adobe Dreamweaver ">Adobe Dreamweaver </option>
                                                            <option value="Adobe Illustrator ">Adobe Illustrator </option>
                                                            <option value="Adobe ImageReady ">Adobe ImageReady </option>
                                                            <option value="Adobe InDesign ">Adobe InDesign </option>
                                                            <option value="Adobe Lightroom ">Adobe Lightroom </option>
                                                            <option value="Adobe PhotoShop ">Adobe PhotoShop </option>
                                                            <option value="Adobe Premiere ">Adobe Premiere </option>
                                                            <option value="Advertising ">Advertising </option>
                                                            <option value="Advertising Design ">Advertising Design </option>
                                                            <option value="Air Conditioning Repair ">Air Conditioning Repair </option>
                                                            <option value="Alarm System Management ">Alarm System Management </option>
                                                            <option value="Animal Behaviour Correction ">Animal Behaviour Correction </option>
                                                            <option value="Animal Care ">Animal Care </option>
                                                            <option value="Animal Surgery Assistance ">Animal Surgery Assistance </option>
                                                            <option value="ArchiCAD ">ArchiCAD </option>
                                                            <option value="Architectural Drafting ">Architectural Drafting </option>
                                                            <option value="Asphalting ">Asphalting </option>
                                                            <option value="Audio Conversion ">Audio Conversion </option>
                                                            <option value="Auditing ">Auditing </option>
                                                            <option value="AutoCAD ">AutoCAD </option>
                                                            <option value="Autodesk Inventor ">Autodesk Inventor </option>
                                                            <option value="Automotive Technician ">Automotive Technician </option>
                                                            <option value="Babysitting ">Babysitting </option>
                                                            <option value="Baking ">Baking </option>
                                                            <option value="Bank Loan Knowledge ">Bank Loan Knowledge </option>
                                                            <option value="Bank Reconciliations ">Bank Reconciliations </option>
                                                            <option value="Banking ">Banking </option>
                                                            <option value="Bar and Beverage Service ">Bar and Beverage Service </option>
                                                            <option value="Barista ">Barista </option>
                                                            <option value="Beauty Therapy ">Beauty Therapy </option>
                                                            <option value="Beer Pouring ">Beer Pouring </option>
                                                            <option value="Biotechnology ">Biotechnology </option>
                                                            <option value="Blast Mining ">Blast Mining </option>
                                                            <option value="Blogging ">Blogging </option>
                                                            <option value="Blow Drying ">Blow Drying </option>
                                                            <option value="Boilermaking ">Boilermaking </option>
                                                            <option value="Bomb Threat Management ">Bomb Threat Management </option>
                                                            <option value="Booking System ">Booking System </option>
                                                            <option value="Bookkeeping ">Bookkeeping </option>
                                                            <option value="Brand Management ">Brand Management </option>
                                                            <option value="Bread and Pastry Shaping ">Bread and Pastry Shaping </option>
                                                            <option value="Bricklaying ">Bricklaying </option>
                                                            <option value="Broker ">Broker </option>
                                                            <option value="Budgeting ">Budgeting </option>
                                                            <option value="Building & Safety Regulations ">Building & Safety Regulations </option>
                                                            <option value="Building Inspection ">Building Inspection </option>
                                                            <option value="Building Management & Maintenance ">Building Management & Maintenance </option>
                                                            <option value="Business Analysis ">Business Analysis </option>
                                                            <option value="Business Development ">Business Development </option>
                                                            <option value="Butchery ">Butchery </option>
                                                            <option value="C&S Design ">C&S Design </option>
                                                            <option value="CAD Design Software ">CAD Design Software </option>
                                                            <option value="Cake Decorating ">Cake Decorating </option>
                                                            <option value="Captain ">Captain </option>
                                                            <option value="Carpentry ">Carpentry </option>
                                                            <option value="Cash Flow Management ">Cash Flow Management </option>
                                                            <option value="Cash Register Operation ">Cash Register Operation </option>
                                                            <option value="Cement Finishing ">Cement Finishing </option>
                                                            <option value="Chef ">Chef </option>
                                                            <option value="Chef De Partie ">Chef De Partie </option>
                                                            <option value="Chemistry ">Chemistry </option>
                                                            <option value="Child Psychology ">Child Psychology </option>
                                                            <option value="Childcare ">Childcare </option>
                                                            <option value="Children Development ">Children Development </option>
                                                            <option value="Childrens Fashion ">Childrens Fashion </option>
                                                            <option value="Chiropractics ">Chiropractics </option>
                                                            <option value="Civil Construction ">Civil Construction </option>
                                                            <option value="Civil Law ">Civil Law </option>
                                                            <option value="Cleaning ">Cleaning </option>
                                                            <option value="Clinical Psychology ">Clinical Psychology </option>
                                                            <option value="Coaching ">Coaching </option>
                                                            <option value="Cocktail Making ">Cocktail Making </option>
                                                            <option value="Coffee Making ">Coffee Making </option>
                                                            <option value="Commis Chef ">Commis Chef </option>
                                                            <option value="Communication Skills ">Communication Skills </option>
                                                            <option value="Community Care Worker ">Community Care Worker </option>
                                                            <option value="Computer Literacy ">Computer Literacy </option>
                                                            <option value="Concept Design ">Concept Design </option>
                                                            <option value="Concreting ">Concreting </option>
                                                            <option value="Construction ">Construction </option>
                                                            <option value="Construction Cost Estimating ">Construction Cost Estimating </option>
                                                            <option value="Construction Law ">Construction Law </option>
                                                            <option value="Construction Management ">Construction Management </option>
                                                            <option value="Construction Site Management ">Construction Site Management </option>
                                                            <option value="Consulting Families ">Consulting Families </option>
                                                            <option value="Content Creation ">Content Creation </option>
                                                            <option value="Content Research ">Content Research </option>
                                                            <option value="Cook ">Cook </option>
                                                            <option value="Copywriting ">Copywriting </option>
                                                            <option value="Corporate Law ">Corporate Law </option>
                                                            <option value="Corrective Action Reports (CAR) ">Corrective Action Reports (CAR) </option>
                                                            <option value="Cosmetology ">Cosmetology </option>
                                                            <option value="Cost Analysis ">Cost Analysis </option>
                                                            <option value="Cost Modelling & Analysis ">Cost Modelling & Analysis </option>
                                                            <option value="Cost Planning ">Cost Planning </option>
                                                            <option value="Counselling ">Counselling </option>
                                                            <option value="Crane Operating ">Crane Operating </option>
                                                            <option value="Criminal Law ">Criminal Law </option>
                                                            <option value="Critical Care ">Critical Care </option>
                                                            <option value="Crowd Control Management ">Crowd Control Management </option>
                                                            <option value="CSS ">CSS </option>
                                                            <option value="Custom & Regulatory Compliance ">Custom & Regulatory Compliance </option>
                                                            <option value="Custom & Regulatory Compliance ">Custom & Regulatory Compliance </option>
                                                            <option value="Custom & Regulatory Compliance ">Custom & Regulatory Compliance </option>
                                                            <option value="Customer Relationship Management (CRM) ">Customer Relationship Management (CRM) </option>
                                                            <option value="Customer Service ">Customer Service </option>
                                                            <option value="Dancing ">Dancing </option>
                                                            <option value="Data Analysis ">Data Analysis </option>
                                                            <option value="Data Entry ">Data Entry </option>
                                                            <option value="Database Management ">Database Management </option>
                                                            <option value="Debt Collector ">Debt Collector </option>
                                                            <option value="Decouple Molding ">Decouple Molding </option>
                                                            <option value="Demolition ">Demolition </option>
                                                            <option value="Dental Nursing ">Dental Nursing </option>
                                                            <option value="Dentistry ">Dentistry </option>
                                                            <option value="Designing ">Designing </option>
                                                            <option value="Desktop Publishing ">Desktop Publishing </option>
                                                            <option value="Development & Management ">Development & Management </option>
                                                            <option value="Diary Management ">Diary Management </option>
                                                            <option value="Diesel Mechanic ">Diesel Mechanic </option>
                                                            <option value="Dietary Assessment ">Dietary Assessment </option>
                                                            <option value="Dietary Planning ">Dietary Planning </option>
                                                            <option value="Digital Marketing ">Digital Marketing </option>
                                                            <option value="Direct Marketing ">Direct Marketing </option>
                                                            <option value="Disability Service Officer ">Disability Service Officer </option>
                                                            <option value="Disabled Care ">Disabled Care </option>
                                                            <option value="Dispatching ">Dispatching </option>
                                                            <option value="Distributor Agrement (DA) Processing ">Distributor Agrement (DA) Processing </option>
                                                            <option value="Document Evaluation ">Document Evaluation </option>
                                                            <option value="Documentation ">Documentation </option>
                                                            <option value="Drafting ">Drafting </option>
                                                            <option value="Drama ">Drama </option>
                                                            <option value="Drawing ">Drawing </option>
                                                            <option value="Dreamweaver ">Dreamweaver </option>
                                                            <option value="dreamweaver ">dreamweaver </option>
                                                            <option value="Driving Experience ">Driving Experience </option>
                                                            <option value="Editing ">Editing </option>
                                                            <option value="EFTPOS ">EFTPOS </option>
                                                            <option value="Elderly Care ">Elderly Care </option>
                                                            <option value="Electrical Engineering ">Electrical Engineering </option>
                                                            <option value="Electrician ">Electrician </option>
                                                            <option value="Emergency Response ">Emergency Response </option>
                                                            <option value="Engineering ">Engineering </option>
                                                            <option value="Engineering Drafter ">Engineering Drafter </option>
                                                            <option value="Environmental, Safety & Health (ESH) Management ">Environmental, Safety & Health (ESH) Management </option>
                                                            <option value="Equipment & Tools Operation ">Equipment & Tools Operation </option>
                                                            <option value="Event Coordinator ">Event Coordinator </option>
                                                            <option value="Event Management ">Event Management </option>
                                                            <option value="Excavation ">Excavation </option>
                                                            <option value="Exploratory Geoscience ">Exploratory Geoscience </option>
                                                            <option value="Eyelash & Eyebrow Grooming ">Eyelash & Eyebrow Grooming </option>
                                                            <option value="Eyelash and Eyebrow Tinting ">Eyelash and Eyebrow Tinting </option>
                                                            <option value="Face to Face Sales ">Face to Face Sales </option>
                                                            <option value="Factory Worker ">Factory Worker </option>
                                                            <option value="Failure Mode Effects Analysis (FMEA) ">Failure Mode Effects Analysis (FMEA) </option>
                                                            <option value="Fashion Design ">Fashion Design </option>
                                                            <option value="Fast Food Procedures ">Fast Food Procedures </option>
                                                            <option value="FIFO ">FIFO </option>
                                                            <option value="File Management ">File Management </option>
                                                            <option value="Finance ">Finance </option>
                                                            <option value="Financial Planning ">Financial Planning </option>
                                                            <option value="Financial Reporting ">Financial Reporting </option>
                                                            <option value="First Aid ">First Aid </option>
                                                            <option value="Fitness Assessment ">Fitness Assessment </option>
                                                            <option value="Fitness Consultation ">Fitness Consultation </option>
                                                            <option value="Fitness Instructor ">Fitness Instructor </option>
                                                            <option value="Fitter and Turner ">Fitter and Turner </option>
                                                            <option value="Flight Attendant ">Flight Attendant </option>
                                                            <option value="Floristry ">Floristry </option>
                                                            <option value="Flower Arrangement ">Flower Arrangement </option>
                                                            <option value="Food and Beverage Serving ">Food and Beverage Serving </option>
                                                            <option value="Food Delivery ">Food Delivery </option>
                                                            <option value="Food Handling and Preparation ">Food Handling and Preparation </option>
                                                            <option value="Food Safety ">Food Safety </option>
                                                            <option value="Food Science ">Food Science </option>
                                                            <option value="Forklift Driving ">Forklift Driving </option>
                                                            <option value="Freehand Drawing ">Freehand Drawing </option>
                                                            <option value="Freight & Cargo Handling ">Freight & Cargo Handling </option>
                                                            <option value="Freight Management ">Freight Management </option>
                                                            <option value="Front of House Duties ">Front of House Duties </option>
                                                            <option value="Fundraising ">Fundraising </option>
                                                            <option value="Gardening ">Gardening </option>
                                                            <option value="Gardening Maintenance ">Gardening Maintenance </option>
                                                            <option value="General Enquiries ">General Enquiries </option>
                                                            <option value="General Grooming ">General Grooming </option>
                                                            <option value="General IT Development ">General IT Development </option>
                                                            <option value="General Maintenance ">General Maintenance </option>
                                                            <option value="General Management ">General Management </option>
                                                            <option value="General Office Duties ">General Office Duties </option>
                                                            <option value="General Practice Nurse ">General Practice Nurse </option>
                                                            <option value="Glazier ">Glazier </option>
                                                            <option value="Grammar ">Grammar </option>
                                                            <option value="Graphic Design ">Graphic Design </option>
                                                            <option value="Grass Clipping ">Grass Clipping </option>
                                                            <option value="Guest Relations ">Guest Relations </option>
                                                            <option value="Gyprocking Plasterboard ">Gyprocking Plasterboard </option>
                                                            <option value="Hair Colouring ">Hair Colouring </option>
                                                            <option value="Hair Consulting ">Hair Consulting </option>
                                                            <option value="Hair Cutting ">Hair Cutting </option>
                                                            <option value="Hair Shampooing ">Hair Shampooing </option>
                                                            <option value="Hair Styling ">Hair Styling </option>
                                                            <option value="Head Chef ">Head Chef </option>
                                                            <option value="Health Care ">Health Care </option>
                                                            <option value="Heavy Lifting ">Heavy Lifting </option>
                                                            <option value="Help Desk ">Help Desk </option>
                                                            <option value="High School Tutoring ">High School Tutoring </option>
                                                            <option value="Home Care Assistance ">Home Care Assistance </option>
                                                            <option value="Homeschooling ">Homeschooling </option>
                                                            <option value="Horticulture ">Horticulture </option>
                                                            <option value="HTML ">HTML </option>
                                                            <option value="Human Resources ">Human Resources </option>
                                                            <option value="Hygiene Awareness ">Hygiene Awareness </option>
                                                            <option value="Illustration ">Illustration </option>
                                                            <option value="Inbound Call Centre ">Inbound Call Centre </option>
                                                            <option value="Industrial Design ">Industrial Design </option>
                                                            <option value="Information Technology (IT) Skills ">Information Technology (IT) Skills </option>
                                                            <option value="Insecticide Spraying ">Insecticide Spraying </option>
                                                            <option value="Instructing ">Instructing </option>
                                                            <option value="Instructor ">Instructor </option>
                                                            <option value="Insurance ">Insurance </option>
                                                            <option value="Insurance Broker ">Insurance Broker </option>
                                                            <option value="Insurance Claim Management ">Insurance Claim Management </option>
                                                            <option value="Inventory Management ">Inventory Management </option>
                                                            <option value="Inventory Report ">Inventory Report </option>
                                                            <option value="Inventory Report ">Inventory Report </option>
                                                            <option value="IT Support ">IT Support </option>
                                                            <option value="JavaScript ">JavaScript </option>
                                                            <option value="Joiner and Cabinet Making ">Joiner and Cabinet Making </option>
                                                            <option value="jQuery ">jQuery </option>
                                                            <option value="Key Performance Indicators (KPI) ">Key Performance Indicators (KPI) </option>
                                                            <option value="Kitchenhand ">Kitchenhand </option>
                                                            <option value="Knowledge of Books ">Knowledge of Books </option>
                                                            <option value="Knowledge of Routes ">Knowledge of Routes </option>
                                                            <option value="Laboratory Assistant ">Laboratory Assistant </option>
                                                            <option value="Labour ">Labour </option>
                                                            <option value="Land Surveying ">Land Surveying </option>
                                                            <option value="Landscape Architecture ">Landscape Architecture </option>
                                                            <option value="Landscaping ">Landscaping </option>
                                                            <option value="Language Development ">Language Development </option>
                                                            <option value="Law ">Law </option>
                                                            <option value="Lawn Mowing and Greenkeeping ">Lawn Mowing and Greenkeeping </option>
                                                            <option value="Lead Generation ">Lead Generation </option>
                                                            <option value="Leadership ">Leadership </option>
                                                            <option value="Learning Management System ">Learning Management System </option>
                                                            <option value="Leasing ">Leasing </option>
                                                            <option value="Legal Knowledge ">Legal Knowledge </option>
                                                            <option value="Legal Procedure ">Legal Procedure </option>
                                                            <option value="Lesson Plan ">Lesson Plan </option>
                                                            <option value="License Manufacturing Warehouse (LMW) ">License Manufacturing Warehouse (LMW) </option>
                                                            <option value="LIFO ">LIFO </option>
                                                            <option value="Literature ">Literature </option>
                                                            <option value="Litigation ">Litigation </option>
                                                            <option value="Locksmith ">Locksmith </option>
                                                            <option value="Logistics ">Logistics </option>
                                                            <option value="M&E Drawings ">M&E Drawings </option>
                                                            <option value="Machine Capacity ">Machine Capacity </option>
                                                            <option value="Machine Operating ">Machine Operating </option>
                                                            <option value="Macromedia Fireworks ">Macromedia Fireworks </option>
                                                            <option value="Macromedia Flash ">Macromedia Flash </option>
                                                            <option value="Maintenance ">Maintenance </option>
                                                            <option value="Maintenance Fitter ">Maintenance Fitter </option>
                                                            <option value="Makeup Artistry ">Makeup Artistry </option>
                                                            <option value="Manpower Capacity ">Manpower Capacity </option>
                                                            <option value="Market Research ">Market Research </option>
                                                            <option value="Marketing ">Marketing </option>
                                                            <option value="Marketing ">Marketing </option>
                                                            <option value="Massage Therapy ">Massage Therapy </option>
                                                            <option value="Material & Production Planning ">Material & Production Planning </option>
                                                            <option value="Material Planning ">Material Planning </option>
                                                            <option value="Materials Inspection ">Materials Inspection </option>
                                                            <option value="Materials Preparation ">Materials Preparation </option>
                                                            <option value="Materials Testing ">Materials Testing </option>
                                                            <option value="Maternal Health Nursing ">Maternal Health Nursing </option>
                                                            <option value="Mechanic ">Mechanic </option>
                                                            <option value="Mechanical Engineering ">Mechanical Engineering </option>
                                                            <option value="Mechatronics Engineering ">Mechatronics Engineering </option>
                                                            <option value="Media Outlet Skills ">Media Outlet Skills </option>
                                                            <option value="Medical Research ">Medical Research </option>
                                                            <option value="Medication Dispensing ">Medication Dispensing </option>
                                                            <option value="Medicine Preparation ">Medicine Preparation </option>
                                                            <option value="Mens Fashion ">Mens Fashion </option>
                                                            <option value="Mentoring ">Mentoring </option>
                                                            <option value="Mentoring / Consultation ">Mentoring / Consultation </option>
                                                            <option value="Menu Planning ">Menu Planning </option>
                                                            <option value="Merchandising and visual merchandising ">Merchandising and visual merchandising </option>
                                                            <option value="Metalworking ">Metalworking </option>
                                                            <option value="Microsoft Office ">Microsoft Office </option>
                                                            <option value="Microsoft Project ">Microsoft Project </option>
                                                            <option value="Microsoft Publisher ">Microsoft Publisher </option>
                                                            <option value="Midwifery ">Midwifery </option>
                                                            <option value="Mining ">Mining </option>
                                                            <option value="Minutes of Meeting ">Minutes of Meeting </option>
                                                            <option value="Mortgage Broking ">Mortgage Broking </option>
                                                            <option value="Mould Making ">Mould Making </option>
                                                            <option value="Music ">Music </option>
                                                            <option value="MX Road ">MX Road </option>
                                                            <option value="MYOB ">MYOB </option>
                                                            <option value="MySQL ">MySQL </option>
                                                            <option value="Natural Therapy ">Natural Therapy </option>
                                                            <option value="Negotiation Skills ">Negotiation Skills </option>
                                                            <option value="NetBeans ">NetBeans </option>
                                                            <option value="Network Administration ">Network Administration </option>
                                                            <option value="Network Engineering ">Network Engineering </option>
                                                            <option value="Non-conforming Reports (NCR) ">Non-conforming Reports (NCR) </option>
                                                            <option value="Nursing ">Nursing </option>
                                                            <option value="Nursing Assistant ">Nursing Assistant </option>
                                                            <option value="Occupational Health and Safety Management System (OHSMS) ">Occupational Health and Safety Management System (OHSMS) </option>
                                                            <option value="Office Administration ">Office Administration </option>
                                                            <option value="Office Management ">Office Management </option>
                                                            <option value="Offshore Experience ">Offshore Experience </option>
                                                            <option value="On-The-Job Training ">On-The-Job Training </option>
                                                            <option value="Ophthalmology ">Ophthalmology </option>
                                                            <option value="Optometry ">Optometry </option>
                                                            <option value="Order Processing ">Order Processing </option>
                                                            <option value="Order Processing ">Order Processing </option>
                                                            <option value="Outbound Call Centre ">Outbound Call Centre </option>
                                                            <option value="Outside of School Hours Care ">Outside of School Hours Care </option>
                                                            <option value="Paediatrics ">Paediatrics </option>
                                                            <option value="Painting ">Painting </option>
                                                            <option value="Panel Beating ">Panel Beating </option>
                                                            <option value="Paralegal ">Paralegal </option>
                                                            <option value="Paramedics ">Paramedics </option>
                                                            <option value="Parasite Treatment ">Parasite Treatment </option>
                                                            <option value="Pastry Chef ">Pastry Chef </option>
                                                            <option value="Pathology ">Pathology </option>
                                                            <option value="Payroll ">Payroll </option>
                                                            <option value="Personal Assistant ">Personal Assistant </option>
                                                            <option value="Pest Control ">Pest Control </option>
                                                            <option value="Pharmaceutical Services ">Pharmaceutical Services </option>
                                                            <option value="Pharmacy ">Pharmacy </option>
                                                            <option value="Pharmacy Assistance ">Pharmacy Assistance </option>
                                                            <option value="Phone System ">Phone System </option>
                                                            <option value="Photography ">Photography </option>
                                                            <option value="PHP ">PHP </option>
                                                            <option value="Physical Coordination & Manual Skills ">Physical Coordination & Manual Skills </option>
                                                            <option value="Physical Therapy ">Physical Therapy </option>
                                                            <option value="Physiotherapy ">Physiotherapy </option>
                                                            <option value="Pilot ">Pilot </option>
                                                            <option value="Planning ">Planning </option>
                                                            <option value="Plastic Injection Molding ">Plastic Injection Molding </option>
                                                            <option value="PLC Programming ">PLC Programming </option>
                                                            <option value="Plumbing Systems & Fixtures ">Plumbing Systems & Fixtures </option>
                                                            <option value="Point of Sale ">Point of Sale </option>
                                                            <option value="POS ">POS </option>
                                                            <option value="Post-training Evaluation ">Post-training Evaluation </option>
                                                            <option value="Primary School English Tutoring ">Primary School English Tutoring </option>
                                                            <option value="Primary School Tutoring ">Primary School Tutoring </option>
                                                            <option value="Primavera ">Primavera </option>
                                                            <option value="Process Engineering ">Process Engineering </option>
                                                            <option value="Procurement Management ">Procurement Management </option>
                                                            <option value="Procurement Preparation ">Procurement Preparation </option>
                                                            <option value="Production ">Production </option>
                                                            <option value="Production Analysis ">Production Analysis </option>
                                                            <option value="Production Planning ">Production Planning </option>
                                                            <option value="Production Reports ">Production Reports </option>
                                                            <option value="Profit and Loss Statement ">Profit and Loss Statement </option>
                                                            <option value="Programming ">Programming </option>
                                                            <option value="Project Engineering ">Project Engineering </option>
                                                            <option value="Project Management ">Project Management </option>
                                                            <option value="Promotional ">Promotional </option>
                                                            <option value="Proofreading ">Proofreading </option>
                                                            <option value="Property Consultation ">Property Consultation </option>
                                                            <option value="Property Investment Strategies ">Property Investment Strategies </option>
                                                            <option value="Property Management ">Property Management </option>
                                                            <option value="Property Valuation ">Property Valuation </option>
                                                            <option value="Public Relations ">Public Relations </option>
                                                            <option value="Publishing ">Publishing </option>
                                                            <option value="Python ">Python </option>
                                                            <option value="QA Inspection ">QA Inspection </option>
                                                            <option value="Radiography ">Radiography </option>
                                                            <option value="Receptionist ">Receptionist </option>
                                                            <option value="Rehabilitation ">Rehabilitation </option>
                                                            <option value="Remove Rubbish and Rubble From Site ">Remove Rubbish and Rubble From Site </option>
                                                            <option value="Remuneration ">Remuneration </option>
                                                            <option value="Reporting ">Reporting </option>
                                                            <option value="Research ">Research </option>
                                                            <option value="Retail Management ">Retail Management </option>
                                                            <option value="Revenue Forecasting ">Revenue Forecasting </option>
                                                            <option value="Rf Scanning ">Rf Scanning </option>
                                                            <option value="Risk Management ">Risk Management </option>
                                                            <option value="Roofing ">Roofing </option>
                                                            <option value="Room Service ">Room Service </option>
                                                            <option value="Rostering ">Rostering </option>
                                                            <option value="Safety Inspection & Audit ">Safety Inspection & Audit </option>
                                                            <option value="Sales ">Sales </option>
                                                            <option value="Sales & Purchase Documents ">Sales & Purchase Documents </option>
                                                            <option value="Sales Assistant ">Sales Assistant </option>
                                                            <option value="Sales Management ">Sales Management </option>
                                                            <option value="Sales Reporting ">Sales Reporting </option>
                                                            <option value="Sandwich Making ">Sandwich Making </option>
                                                            <option value="Scaffolding ">Scaffolding </option>
                                                            <option value="Search Engine Marketing (SEM) ">Search Engine Marketing (SEM) </option>
                                                            <option value="Search Engine Optimalization (SEO) ">Search Engine Optimalization (SEO) </option>
                                                            <option value="Search Engine Optimisation (SEO) ">Search Engine Optimisation (SEO) </option>
                                                            <option value="Security Guards ">Security Guards </option>
                                                            <option value="Security Patrolling ">Security Patrolling </option>
                                                            <option value="Sewing ">Sewing </option>
                                                            <option value="Shipment Management ">Shipment Management </option>
                                                            <option value="Shipment Management ">Shipment Management </option>
                                                            <option value="Shop Assistant ">Shop Assistant </option>
                                                            <option value="Singing ">Singing </option>
                                                            <option value="Skin Therapies ">Skin Therapies </option>
                                                            <option value="Social Media Management ">Social Media Management </option>
                                                            <option value="Social Work ">Social Work </option>
                                                            <option value="Software Engineering ">Software Engineering </option>
                                                            <option value="Software Testing ">Software Testing </option>
                                                            <option value="Sono ">Sono </option>
                                                            <option value="Sourcing & Purchasing ">Sourcing & Purchasing </option>
                                                            <option value="Sous Chef ">Sous Chef </option>
                                                            <option value="Staff Management & Supervising ">Staff Management & Supervising </option>
                                                            <option value="Statistical Process Control (SPC) ">Statistical Process Control (SPC) </option>
                                                            <option value="Statistical Quality Control (SQC) ">Statistical Quality Control (SQC) </option>
                                                            <option value="Steel Fixing ">Steel Fixing </option>
                                                            <option value="Stock & Inventory Management ">Stock & Inventory Management </option>
                                                            <option value="Strong Soft Skills ">Strong Soft Skills </option>
                                                            <option value="Superannuation ">Superannuation </option>
                                                            <option value="Supplier Relationship Management (SRM) ">Supplier Relationship Management (SRM) </option>
                                                            <option value="Supply Chain Management ">Supply Chain Management </option>
                                                            <option value="Surgery ">Surgery </option>
                                                            <option value="Swimming Abilities ">Swimming Abilities </option>
                                                            <option value="System Analysis ">System Analysis </option>
                                                            <option value="Systems Engineering ">Systems Engineering </option>
                                                            <option value="Tailor ">Tailor </option>
                                                            <option value="Tattoo Artist ">Tattoo Artist </option>
                                                            <option value="Tattoo Drawing ">Tattoo Drawing </option>
                                                            <option value="Tax ">Tax </option>
                                                            <option value="Technical Report Writing ">Technical Report Writing </option>
                                                            <option value="Technical Support ">Technical Support </option>
                                                            <option value="Technical Training & Solution ">Technical Training & Solution </option>
                                                            <option value="Technical Writing ">Technical Writing </option>
                                                            <option value="Technician ">Technician </option>
                                                            <option value="Telemarketing ">Telemarketing </option>
                                                            <option value="Theatre ">Theatre </option>
                                                            <option value="Tiling ">Tiling </option>
                                                            <option value="Time Management ">Time Management </option>
                                                            <option value="Tour Guide ">Tour Guide </option>
                                                            <option value="Town Planning ">Town Planning </option>
                                                            <option value="Translating ">Translating </option>
                                                            <option value="Translating & Interpreting ">Translating & Interpreting </option>
                                                            <option value="Transport management ">Transport management </option>
                                                            <option value="Transport/Delivery Documents ">Transport/Delivery Documents </option>
                                                            <option value="Travel Agent ">Travel Agent </option>
                                                            <option value="Travel Experience ">Travel Experience </option>
                                                            <option value="Truck Driver ">Truck Driver </option>
                                                            <option value="Tuition ">Tuition </option>
                                                            <option value="UBS ">UBS </option>
                                                            <option value="Ultrasound Sonography ">Ultrasound Sonography </option>
                                                            <option value="Umpiring ">Umpiring </option>
                                                            <option value="User Experience Design ">User Experience Design </option>
                                                            <option value="Valet parking ">Valet parking </option>
                                                            <option value="Vehicle Knowledge ">Vehicle Knowledge </option>
                                                            <option value="Veterinary ">Veterinary </option>
                                                            <option value="Veterinary Assistance ">Veterinary Assistance </option>
                                                            <option value="Video Editing ">Video Editing </option>
                                                            <option value="Video Production ">Video Production </option>
                                                            <option value="Videography ">Videography </option>
                                                            <option value="Visual Inspection ">Visual Inspection </option>
                                                            <option value="Vlogging ">Vlogging </option>
                                                            <option value="Volunteering ">Volunteering </option>
                                                            <option value="Waiting Tables ">Waiting Tables </option>
                                                            <option value="Warehouse Housekeeping ">Warehouse Housekeeping </option>
                                                            <option value="Warehouse Logistics ">Warehouse Logistics </option>
                                                            <option value="Warehouse Operations ">Warehouse Operations </option>
                                                            <option value="Warehousing ">Warehousing </option>
                                                            <option value="Waxing ">Waxing </option>
                                                            <option value="Web Design ">Web Design </option>
                                                            <option value="Website Development ">Website Development </option>
                                                            <option value="Welding ">Welding </option>
                                                            <option value="Wine and Spirit Knowledge (Sommelier) ">Wine and Spirit Knowledge (Sommelier) </option>
                                                            <option value="Wiring ">Wiring </option>
                                                            <option value="Womens Fashion ">Womens Fashion </option>
                                                            <option value="Working with Children ">Working with Children </option>
                                                            <option value="Writing ">Writing </option>
                                                            <option value="Yoga">Yoga</option>
                                                        </select>                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group" style="margin-bottom: 0;">
                                                    <label class="control-label" translate="">
                                                        <span>JOB LOCATION</span>
                                                    </label>
                                                    <div class="col-xs-12">
                                                        <input id="jlocation" name="jlocation" class="input-block-level form-control ng-empty ng-valid" type="text" placeholder="Start typing your location">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-xs-12"> </div>
                                                </div>
                                                <ul class="form-group history history-location">
                                                    <div class="col-xs-12"> </div>
                                                    <div class="clearfix"></div>
                                                </ul>
                                                <div class="form-group">
                                                    <label class="control-label" translate="">
                                                        <span>SALARY</span>
                                                    </label>
                                                    <div class="col-sm-4 col-md-4 row-2 salary-from">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" translate="">
                                                                    <span>SAR</span>
                                                                </span>
                                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="text" ng-required="true" ng-pattern="/^[0-9]+$/" placeholder="From" ng-model="job.salaryFrom" name="salaryfrom" id="salaryfrom" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 row-2 salary-to">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" translate="">
                                                                    <span>SAR</span>
                                                                </span>
                                                                <input class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" type="text" ng-required="true" ng-pattern="/^[0-9]+$/" placeholder="To" ng-model="job.salaryTo" name="salaryto" id="salaryto" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 row-2">
                                                        <div class="col-sm-12">
                                                            <select class="form-control custom-select ng-pristine ng-untouched ng-valid ng-not-empty" name="salaryperiod" id="salaryperiod" ng-model="job.salaryPeriod">
                                                                <option translate="" value="Per Hour">
                                                                    <span>Per Hour</span>
                                                                </option>
                                                                <option translate="" value="Per Month">
                                                                    <span>Per Month</span>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="gap-10"></div>
                                                    <div class="col-xs-12">
                                                        <div class="col-sm-12">
                                                            <label>
                                                                <input class="reg-chck ng-untouched ng-valid ng-dirty ng-valid-parse ng-empty" type="checkbox" name="jobsalaryhide" id="jobsalaryhide" value="1">                                                                
                                                                Hide salary
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-12"> </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="gap-10"></div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label" translate="" for="job-education">
                                                            <span>MINIMUM EDUCATION LEVEL</span>
                                                        </label>
                                                        <select id="jobeducation" name="jobeducation" class="form-control custom-select ng-touched ng-not-empty ng-dirty ng-valid-parse ng-valid ng-valid-required">
                                                            <option label="In High School" value="In High School">In High School</option>
                                                            <option label="Completed High School" value="Completed High School">Completed High School</option>
                                                            <option label="Completing Degree/Diploma" value="Completing Degree/Diploma">Completing Degree/Diploma</option>
                                                            <option label="Completed Degree/Diploma" value="Completed Degree/Diploma">Completed Degree/Diploma</option>
                                                            <option label="Completing Postgraduate Studies" value="Completing Postgraduate Studies">Completing Postgraduate Studies</option>
                                                            <option label="Completed Postgraduate Studies" value="Completed Postgraduate Studies">Completed Postgraduate Studies</option>
                                                        </select>
                                                        <div class="gap-10"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label" translate="" for="accepts-foreigners">
                                                            <span>DO YOU ACCEPT FOREIGNERS?</span>
                                                        </label>
                                                        <select id="acceptsforeigners" class="form-control custom-select ng-pristine ng-valid ng-not-empty ng-valid-required ng-touched" ng-required="true" tabindex="2" name="acceptsforeigners" required="required">
                                                            <option translate="" value="Yes" selected="">
                                                                <span>Yes</span>
                                                            </option>
                                                            <option translate="" value="No">
                                                                <span>No</span>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group languages-form-group">
                                                <label class="control-label" translate="" for="job-location">
                                                    <span>REQUIRED LANGUAGE</span>
                                                </label>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <select id="language[]" name="language[]" class="form-control ng-pristine ng-untouched ng-valid localytics-chosen ng-empty" data-placeholder="Select Main Language" multiple="multiple" style="min-height: 200px;">
                                                            <option value="Afar">Afar</option>
                                                            <option value="Akan">Akan</option>
                                                            <option value="Albanian">Albanian</option>
                                                            <option value="Amharic">Amharic</option>
                                                            <option value="Arabic">Arabic</option>
                                                            <option value="Aragonese">Aragonese</option>
                                                            <option value="Armenian">Armenian</option>
                                                            <option value="Assamese">Assamese</option>
                                                            <option value="Avaric">Avaric</option>
                                                            <option value="Avestan">Avestan</option>
                                                            <option value="Aymara">Aymara</option>
                                                            <option value="Azerbaijani">Azerbaijani</option>
                                                            <option value="Bahasa Malaysia">Bahasa Malaysia</option>
                                                            <option value="Bambara">Bambara</option>
                                                            <option value="Bashkir">Bashkir</option>
                                                            <option value="Basque">Basque</option>
                                                            <option value="Belarusian">Belarusian</option>
                                                            <option value="Bengali">Bengali</option>
                                                            <option value="Bihari">Bihari</option>
                                                            <option value="Bislama">Bislama</option>
                                                            <option value="Bosnian">Bosnian</option>
                                                            <option value="Breton">Breton</option>
                                                            <option value="Bulgarian">Bulgarian</option>
                                                            <option value="Burmese">Burmese</option>
                                                            <option value="Cantonese">Cantonese</option>
                                                            <option value="Catalan; Valencian">Catalan; Valencian</option>
                                                            <option value="Chamorro">Chamorro</option>
                                                            <option value="Chechen">Chechen</option>
                                                            <option value="Chichewa; Chewa; Nyanja">Chichewa; Chewa; Nyanja</option>
                                                            <option value="Chuvash">Chuvash</option>
                                                            <option value="Cornish">Cornish</option>
                                                            <option value="Corsican">Corsican</option>
                                                            <option value="Cree">Cree</option>
                                                            <option value="Croatian">Croatian</option>
                                                            <option value="Czech">Czech</option>
                                                            <option value="Danish">Danish</option>
                                                            <option value="Divehi; Dhivehi; Maldivian;">Divehi; Dhivehi; Maldivian;</option>
                                                            <option value="Dutch">Dutch</option>
                                                            <option value="English">English</option>
                                                            <option value="Esperanto">Esperanto</option>
                                                            <option value="Estonian">Estonian</option>
                                                            <option value="Ewe">Ewe</option>
                                                            <option value="Faroese">Faroese</option>
                                                            <option value="Fijian">Fijian</option>
                                                            <option value="Finnish">Finnish</option>
                                                            <option value="French">French</option>
                                                            <option value="Fula; Fulah; Pulaar; Pular">Fula; Fulah; Pulaar; Pular</option>
                                                            <option value="Galician">Galician</option>
                                                            <option value="Georgian">Georgian</option>
                                                            <option value="German">German</option>
                                                            <option value="Greek, Modern">Greek, Modern</option>
                                                            <option value="Guaraní">Guaraní</option>
                                                            <option value="Gujarati">Gujarati</option>
                                                            <option value="Haitian; Haitian Creole">Haitian; Haitian Creole</option>
                                                            <option value="Hausa">Hausa</option>
                                                            <option value="Hebrew (modern)">Hebrew (modern)</option>
                                                            <option value="Herero">Herero</option>
                                                            <option value="Hindi">Hindi</option>
                                                            <option value="Hiri Motu">Hiri Motu</option>
                                                            <option value="Hokkien">Hokkien</option>
                                                            <option value="Hungarian">Hungarian</option>
                                                            <option value="Icelandic">Icelandic</option>
                                                            <option value="Ido">Ido</option>
                                                            <option value="Igbo">Igbo</option>
                                                            <option value="Indonesian">Indonesian</option>
                                                            <option value="Interlingua">Interlingua</option>
                                                            <option value="Interlingue">Interlingue</option>
                                                            <option value="Inuktitut">Inuktitut</option>
                                                            <option value="Inupiaq">Inupiaq</option>
                                                            <option value="Irish">Irish</option>
                                                            <option value="Italian">Italian</option>
                                                            <option value="Japanese">Japanese</option>
                                                            <option value="Javanese">Javanese</option>
                                                            <option value="Kalaallisut, Greenlandic">Kalaallisut, Greenlandic</option>
                                                            <option value="Kannada">Kannada</option>
                                                            <option value="Kanuri">Kanuri</option>
                                                            <option value="Kashmiri">Kashmiri</option>
                                                            <option value="Kazakh">Kazakh</option>
                                                            <option value="Khmer">Khmer</option>
                                                            <option value="Kikuyu, Gikuyu">Kikuyu, Gikuyu</option>
                                                            <option value="Kinyarwanda">Kinyarwanda</option>
                                                            <option value="Kirghiz, Kyrgyz">Kirghiz, Kyrgyz</option>
                                                            <option value="Kirundi">Kirundi</option>
                                                            <option value="Komi">Komi</option>
                                                            <option value="Kongo">Kongo</option>
                                                            <option value="Korean">Korean</option>
                                                            <option value="Kurdish">Kurdish</option>
                                                            <option value="Kwanyama, Kuanyama">Kwanyama, Kuanyama</option>
                                                            <option value="Lao">Lao</option>
                                                            <option value="Latin">Latin</option>
                                                            <option value="Latvian">Latvian</option>
                                                            <option value="Limburgish, Limburgan, Limburger">Limburgish, Limburgan, Limburger</option>
                                                            <option value="Lingala">Lingala</option>
                                                            <option value="Lithuanian">Lithuanian</option>
                                                            <option value="Luba-Katanga">Luba-Katanga</option>
                                                            <option value="Luganda">Luganda</option>
                                                            <option value="Luxembourgish, Letzeburgesch">Luxembourgish, Letzeburgesch</option>
                                                            <option value="Macedonian">Macedonian</option>
                                                            <option value="Malagasy">Malagasy</option>
                                                            <option value="Malayalam">Malayalam</option>
                                                            <option value="Maltese">Maltese</option>
                                                            <option value="Mandarin">Mandarin</option>
                                                            <option value="Manx">Manx</option>
                                                            <option value="Marathi (Marāṭhī)">Marathi (Marāṭhī)</option>
                                                            <option value="Marshallese">Marshallese</option>
                                                            <option value="Mongolian">Mongolian</option>
                                                            <option value="Māori">Māori</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Navajo, Navaho">Navajo, Navaho</option>
                                                            <option value="Ndonga">Ndonga</option>
                                                            <option value="Nepali">Nepali</option>
                                                            <option value="North Ndebele">North Ndebele</option>
                                                            <option value="Northern Sami">Northern Sami</option>
                                                            <option value="Norwegian">Norwegian</option>
                                                            <option value="Norwegian Bokmål">Norwegian Bokmål</option>
                                                            <option value="Norwegian Nynorsk">Norwegian Nynorsk</option>
                                                            <option value="Nuosu">Nuosu</option>
                                                            <option value="Occitan">Occitan</option>
                                                            <option value="Ojibwe, Ojibwa">Ojibwe, Ojibwa</option>
                                                            <option value="Oriya">Oriya</option>
                                                            <option value="Oromo">Oromo</option>
                                                            <option value="Ossetian, Ossetic">Ossetian, Ossetic</option>
                                                            <option value="Panjabi, Punjabi">Panjabi, Punjabi</option>
                                                            <option value="Pashto, Pushto">Pashto, Pushto</option>
                                                            <option value="Persian">Persian</option>
                                                            <option value="Polish">Polish</option>
                                                            <option value="Portuguese">Portuguese</option>
                                                            <option value="Pāli">Pāli</option>
                                                            <option value="Quechua">Quechua</option>
                                                            <option value="Romanian, Moldavian, Moldovan">Romanian, Moldavian, Moldovan</option>
                                                            <option value="Romansh">Romansh</option>
                                                            <option value="Russian">Russian</option>
                                                            <option value="Samoan">Samoan</option>
                                                            <option value="Sango">Sango</option>
                                                            <option value="Sanskrit (Saṁskṛta)">Sanskrit (Saṁskṛta)</option>
                                                            <option value="Sardinian">Sardinian</option>
                                                            <option value="Scottish Gaelic; Gaelic">Scottish Gaelic; Gaelic</option>
                                                            <option value="Serbian">Serbian</option>
                                                            <option value="Shona">Shona</option>
                                                            <option value="Sindhi">Sindhi</option>
                                                            <option value="Sinhala, Sinhalese">Sinhala, Sinhalese</option>
                                                            <option value="Slovak">Slovak</option>
                                                            <option value="Slovene">Slovene</option>
                                                            <option value="Somali">Somali</option>
                                                            <option value="South Ndebele">South Ndebele</option>
                                                            <option value="Southern Sotho">Southern Sotho</option>
                                                            <option value="Spanish; Castilian">Spanish; Castilian</option>
                                                            <option value="Sundanese">Sundanese</option>
                                                            <option value="Swahili">Swahili</option>
                                                            <option value="Swati">Swati</option>
                                                            <option value="Swedish">Swedish</option>
                                                            <option value="Tagalog">Tagalog</option>
                                                            <option value="Tahitian">Tahitian</option>
                                                            <option value="Tajik">Tajik</option>
                                                            <option value="Tamil">Tamil</option>
                                                            <option value="Tatar">Tatar</option>
                                                            <option value="Telugu">Telugu</option>
                                                            <option value="Thai">Thai</option>
                                                            <option value="Tibetan Standard, Tibetan, Central">Tibetan Standard, Tibetan, Central</option>
                                                            <option value="Tigrinya">Tigrinya</option>
                                                            <option value="Tonga (Tonga Islands)">Tonga (Tonga Islands)</option>
                                                            <option value="Tsonga">Tsonga</option>
                                                            <option value="Tswana">Tswana</option>
                                                            <option value="Turkish">Turkish</option>
                                                            <option value="Turkmen">Turkmen</option>
                                                            <option value="Twi">Twi</option>
                                                            <option value="Uighur, Uyghur">Uighur, Uyghur</option>
                                                            <option value="Ukrainian">Ukrainian</option>
                                                            <option value="Urdu">Urdu</option>
                                                            <option value="Uzbek">Uzbek</option>
                                                            <option value="Venda">Venda</option>
                                                            <option value="Vietnamese">Vietnamese</option>
                                                            <option value="Volapük">Volapük</option>
                                                            <option value="Walloon">Walloon</option>
                                                            <option value="Welsh">Welsh</option>
                                                            <option value="Western Frisian">Western Frisian</option>
                                                            <option value="Wolof">Wolof</option>
                                                            <option value="Xhosa">Xhosa</option>
                                                            <option value="Yiddish">Yiddish</option>
                                                            <option value="Yoruba">Yoruba</option>
                                                            <option value="Zhuang, Chuang">Zhuang, Chuang</option>
                                                        </select>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            
                            <input type="hidden" name="bbid" value="<?php echo $bid; ?>">
                            
                            <div class="job-edit-cta text-center">
                                <button class="btn btn-step" translate="" ng-disabled="addJobForm.$sent" ng-click="draftAndPreview()" type="submit">
                                    <span>PREVIEW JOB</span>
                                </button>
                            </div>
                        </form>
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