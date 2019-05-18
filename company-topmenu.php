<ul class="nav navbar-nav navbar-right">
    <li ng-if="isCompany() && !isCompanyRegistration()" ui-sref-active="active">
        <a translate="" ng-click="openState('company-messages')" href="company-messages.php">
            <span>Messages</span>
        </a>
    </li>                                    
    <li class="dropdown" ng-if="isCompany() && !isCompanyRegistration()" ui-sref-active="active">
        <a id="myacc" aria-expanded="true" aria-haspopup="true" role="button" data-toggle="dropdown">
            My Account
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="myacc">
            <li ui-sref-active="active">
                <a translate="" ui-sref="company-edit" href="company-edit.php">
                    <span>Edit Profile</span>
                </a>
            </li>
            <li ui-sref-active="active">
                <a translate="" ui-sref="company-settings" href="company-settings.php">
                    <span>Settings</span>
                </a>
            </li>
            <li ui-sref-active="active">
                <a translate="" ng-click="logout()" ng-controller="companyLogoutController" href="logout.php">
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
    <li class="ng-hide" ng-hide="isLogedIn()" ui-sref-active="active">
        <div ng-controller="registerModalController">
            <script id="registerModal.html" type="text/ng-template"></script>
            <a translate="" ng-click="open()">
                <span>Create an account</span>
            </a>
        </div>
    </li>
                                </ul>