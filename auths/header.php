<div class="topbar">
    <div class="topbar-md d-lg-none">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="toggle-nav">
                    <div class="toggle-icon">
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                    </div>
                </a><!-- .toggle-nav -->

                <div class="site-logo">
                    <a href="https://ico.elsa.finance/" class="site-brand">
                        <img src="../logo-dark.png" style="width:100%;height:60px" alt="logo"  srcset="../logo-dark.png 2x">
                    </a>
                </div><!-- .site-logo -->

                <div class="dropdown topbar-action-item topbar-action-user">
                    <a href="#" data-toggle="dropdown"> <img class="icon" src="images/user-thumb-sm.png" alt="thumb">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="user-dropdown">
                            <div class="user-dropdown-head">
                                <h6 class="user-dropdown-name"><?= $name ?></h6>
                                <span class="user-dropdown-email"><?= $email ?></span>
                            </div>
                            <ul class="user-dropdown-links">
                                <li><a href="profile"><i class="ti ti-id-badge"></i>My Profile</a></li>
                                <!-- <li><a href="orders"><i class="ti ti-eye"></i>Transactions</a></li> -->
                            </ul>
                            <ul class="user-dropdown-links">
                                <li><a href="logout"><i class="ti ti-power-off"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- .toggle-action -->
            </div><!-- .container -->
        </div><!-- .container -->
    </div><!-- .topbar-md -->
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="topbar-lg d-none d-lg-block">
                <div class="site-logo">
                    <a href="https://elsa.finance" class="site-brand">
                        <img src="../logo-dark.png" style="width:100%;height:60px"  alt="logo" srcset="../logo-dark.png 2x">
                    </a>
                </div><!-- .site-logo -->
            </div><!-- .topbar-lg -->

            <div class="topbar-action d-none d-lg-block">
                <ul class="topbar-action-list">
                    <li class="topbar-action-item topbar-action-link">
                        <a href="https://elsa.finance"><em class="ti ti-home"></em> Go to main site</a>
                    </li><!-- .topbar-action-item -->

                    <li class="dropdown topbar-action-item topbar-action-user">
                        <a href="#" data-toggle="dropdown"> <img class="icon" src="images/user-thumb-sm.png"
                                alt="thumb"> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-dropdown">
                                <div class="user-dropdown-head">
                                    <h6 class="user-dropdown-name"><?= $name ?></h6>
                                <span class="user-dropdown-email"><?= $email ?></span>
                                </div>
                                
                                <ul class="user-dropdown-links">
                                <li><a href="profile"><i class="ti ti-id-badge"></i>My Profile</a></li>
                                <!-- <li><a href="orders"><i class="ti ti-eye"></i>Transactions</a></li> -->
                                </ul>
                                <ul class="user-dropdown-links">
                                    <li><a href="logout"><i class="ti ti-power-off"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .topbar-action-item -->
                </ul><!-- .topbar-action-list -->
            </div><!-- .topbar-action -->
        </div><!-- .d-flex -->
    </div><!-- .container -->
</div>