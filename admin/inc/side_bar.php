<aside class="main-sidebar sidebar-dark-navy sidebar-navy elevation-4">
    <?php
      if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $data = array(
          'where' => array(
            'id' => $user_id
          ),
          'return_type' => 'single'
        );
        $user = $db->select('users',$data);
      }
    ?>
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <?php
        $image = isset($user->image) ? $user->image : "temp.png";
      ?>
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blogy - Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/users/<?=$image?>" class="img-circle img-circle-main elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php?view_id=<?=$user->id?>" class="d-block"><?=$user->name?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="dashboard.php" class="nav-link" onselect="takeaction()">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">System Features</li>

          <!-- Manage Users Nav Start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                All Departments
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="departments.php" class="nav-link" onclick="onSelectMenu()">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Departments</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage Users Nav End -->


          <!-- Manage Mentor Nav Start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Manage Mentors
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="mentors.php?action=Add" class="nav-link" onclick="onSelectMenu()">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Mentor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="mentors.php?action=Manage" class="nav-link" onclick="onSelectMenu()">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Mentors</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage Mentor Nav End -->


          <!-- Manage Students Nav Start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                All Students
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="students.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="students.php?action=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Student</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage Users Nav End -->


          <!-- Manage Courses Nav Start -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Manage Courses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="courses.php?action=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="courses.php?action=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Course</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- Settings Nav Option -->
          <li class="nav-item">
            <a href="settings.php" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>  
              <p>
                Settings
              </p>
            </a>
          </li>
          <!-- Manage Users Nav End -->
          
          


          <!-- Logout Nav Option -->
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i> 
              <p>
                Logout
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>