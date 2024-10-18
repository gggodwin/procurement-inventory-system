
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
                    <li class="section-title">Forms</li>  
                    <li class="<?php echo ($current_page == 'purchase') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_prs.php">
                            <i class="mdi mdi-clipboard-check-outline"></i>
                            <span class="nav-text">Purchase Requisition</span>
                        </a>
                    </li>
                    <li class="section-title">Admin</li>  
                    <li class="<?php echo ($current_page == 'purchase_approval') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_prs_approval.php">
                            <i class="mdi mdi-clipboard-account"></i>
                            <span class="nav-text">PRS Approval</span>
                        </a>
                    </li>  
                    <li class="section-title">Apps</li>
                    <li class="<?php echo ($current_page == 'inventory') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_inventory.php">
                            <i class="mdi mdi-table-plus"></i>
                            <span class="nav-text">Inventory</span>
                        </a>
                    </li>
                    <li class="<?php echo ($current_page == 'department') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_department.php">
                            <i class="mdi mdi-bank"></i>
                            <span class="nav-text">Department</span>
                        </a>
                    </li> 
                    <li class="<?php echo ($current_page == 'supplier') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_supplier.php">
                            <i class="mdi mdi-cart-outline"></i>
                            <span class="nav-text">Supplier</span>
                        </a>
                    </li> 
                    <!--
                    <li class="<?php echo ($current_page == 'profile') ? 'active' : ''; ?>">
                        <a class="sidenav-item-link" href="/admin/sys_admin/main_user.php">
                            <i class="mdi mdi-account"></i>
                            <span class="nav-text">User Profile</span>
                        </a>
                    </li> -->   
                </ul>
            </div>

            <div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <ul class="d-flex">
                  
                  <li>
                    <a data-toggle="tooltip" title="Logout" id="logoutLink"><i class="mdi mdi-logout"></i></a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </aside>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

  $(document).ready(function() {
    $('#logoutLink').on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        $.ajax({
            url: '../../misc/logout.php', // Path to the logout script
            type: 'POST', // Method type
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    // Redirect to the login page on successful logout
                    window.location.href = '../../'; // Change to your login page
                } else {
                    // Handle any error responses here
                    alert('Logout failed, please try again.');
                }
            },
            error: function() {
                alert('Error occurred while logging out. Please try again.');
            }
        });
    });
  });
        </script>