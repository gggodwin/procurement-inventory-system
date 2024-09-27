
<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    
    <div id="toaster"></div>
    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
      
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/admin/sys_admin/main_admin.php">
              <img src="../../images/logo-white.png" alt="Mono" style="height: 40px; color: #1d1f26;" class="visually-hidden">
                <img src="../../images/logo4.png" alt="Mono">
                <!--<span class="brand-name">MONO</span>-->
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_admin.php">
                            <i class="mdi mdi-briefcase-account-outline"></i>
                            <span class="nav-text">Business Dashboard</span>
                        </a>
                    </li>
                    <li class="section-title">Apps</li>
                    <li class="<?php echo ($current_page == 'inventory') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_inventory.php">
                            <i class="mdi mdi-table-plus"></i>
                            <span class="nav-text">Inventory</span>
                        </a>
                    </li>
                    <li class="<?php echo ($current_page == 'purchase') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_admin.php">
                            <i class="mdi mdi-clipboard-check-outline"></i>
                            <span class="nav-text">Purchase Acquisition</span>
                        </a>
                    </li>
                    <li class="<?php echo ($current_page == 'profile') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_admin.php">
                            <i class="mdi mdi-account"></i>
                            <span class="nav-text">User Profile</span>
                        </a>
                    </li>       
                </ul>
            </div>

            <div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <ul class="d-flex">
                  <!--
                  <li>
                    <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a></li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="No chat messages"><i class="mdi mdi-chat-processing"></i></a>
-->
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </aside>