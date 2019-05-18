<ul class="nav navbar-nav navbar-right">
    <li ng-if="isCandidate()" ui-sref-active="active">
        <a translate="" ng-click="openState('candidate-messages')" href="candidate-messages.php">
            <span>Messages</span>
        </a>
    </li>
    <li class="dropdown" ng-if="isCandidate()" ui-sref-active="active">
        <a id="acc" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown">
            <div class="nav-user-image circle" style="background-image: url('profile/<?php echo $photo; ?>');">
                <?php if($photo=='') { ?>
                <initials candidate-surname="thowzif" candidate-name="Abdul" font="25" size="50" rounded="rounded" ng-if="!profileImg">
                    <div class="scoot-initials rounded" style="width: 50px; height: 50px; line-height: 50px; font-size: 25px;">
                        <span><?php echo substr($fname, 0, 1); ?><?php echo substr($lname, 0, 1); ?></span>
                    </div>
                </initials>
                <?php } ?>
            </div>
            You
            <span class="caret"></span>
            <span class="clearfix"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="acc">
            <li class="" ui-sref-active="active">
                <a translate="" ui-sref="user-edit-profile.step-one" href="candidate-edit-1.php">
                    <span>Edit Profile</span>
                </a>
            </li>
            <li ui-sref-active="active">
                <a translate="" ui-sref="user-settings" href="candidate-settings.php">
                    <span>Settings</span>
                </a>
            </li>
            <li ui-sref-active="active">
                <a translate="" ng-click="logout()" ng-controller="candidateLogoutController" href="logout.php">
                    <span>Log out</span>
                </a>
            </li>
        </ul>
    </li>                                        
</ul>