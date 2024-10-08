<?php 
if ($page_number == 1) {
  $page_title = "DASHBOARD"; // Set title for dashboard
} else if ($page_number == 2) {
  $page_title = "INVENTORY"; // Set title for inventory
} else if ($page_number == 3) {
  $page_title = "PURCHASE REQUISITION"; // Set title for inventory
} else if ($page_number == 4) {
  $page_title = "USER PROFILE"; // Set title for inventory
}

?>
<div class="page-wrapper">
        
        <!-- Header -->
        <header class="main-header" id="header">
          <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <!-- Sidebar toggle button -->
            <button id="sidebar-toggler" class="sidebar-toggle">
              <span class="sr-only">Toggle navigation</span>
            </button>

            <span class="page-title">
            <?php echo $page_title; ?>
            </span>

            <div class="navbar-right ">
              <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                  <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <img src="../../images/user/user-xs-01.jpg" class="user-image rounded-circle"/>
                    <span class="d-none d-lg-inline-block">John Doe</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                      <a class="dropdown-link-item" href="user-profile.html">
                        <i class="mdi mdi-account-outline"></i>
                        <span class="nav-text">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-link-item" href="email-inbox.html">
                        <i class="mdi mdi-email-outline"></i>
                        <span class="nav-text">Message</span>
                        <span class="badge badge-pill badge-primary">24</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-link-item" href="user-activities.html">
                        <i class="mdi mdi-diamond-stone"></i>
                        <span class="nav-text">Activitise</span></a>
                    </li>
                    <li>
                      <a class="dropdown-link-item" href="user-account-settings.html">
                        <i class="mdi mdi-settings"></i>
                        <span class="nav-text">Account Setting</span>
                      </a>
                    </li>

                    <li class="dropdown-footer">
                      <a class="dropdown-link-item" href="../../"> <i class="mdi mdi-logout"></i> Log Out </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>


        </header>
