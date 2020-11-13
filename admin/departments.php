<?php include "inc/header.php"; ?>

  <!-- Navbar -->
  <?php include "inc/top_nav.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "inc/side_bar.php"; ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Departments</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left Side -->
          <div class="col-lg-5">
            <!-- Add New Category Start -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Departments</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="name">Department Name</label>
                    <input type="text" name="name" class="form-control" autocomplete="off" required="required" id="name">
                  </div>
                  
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Parent Department</label>
                    <select class="form-control w-100" id="select2dept" name="sub_Dept" required multiple>
                      <option value="0">No Parent Department</option>
                      <?php
                        $getSubSQL = "SELECT * FROM departments WHERE sub_Dept = 0";
                        $result       = mysqli_query($db,$getSubSQL);
                        $rowCount     = mysqli_num_rows($result);
                        if($rowCount > 0){
                            while($rowSub = mysqli_fetch_assoc($result)){
                                $dept_id = $rowSub['dept_id'];
                                $dept_title = $rowSub['dept_title'];
                                ?>
                                    <option value="<?=$rowSub['dept_id']?>"><?=$rowSub['dept_title']?></option>
                                <?php
                            }
                        } 
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="1">Please Select the Department Status</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="addDept" class="btn btn-block btn-primary btn-flat" value="Add New Category">
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- Add New Category End -->

            <?php
              // Register New Category
                if ( isset($_POST['addDept']) ){
                    $name     = $_POST['name'];
                    $desc     = $_POST['desc'];
                    $status   = $_POST['status'];
                    $sub_category = $_POST['sub_Dept'];

                    $sql = "INSERT INTO departments (dept_title, dept_desc, sub_dept,dept_status) VALUES ('$name', '$desc', '$sub_category','$status')";

                    $AddSuccess = mysqli_query($db, $sql);

                    if ( $AddSuccess ){
                        $_SESSION['message'] = "Department Added Successfully";
                        $_SESSION['type']    = "success";
                        header("Location: departments.php");
                        exit();
                    }
                    else{
                        die("MySQL Connection Faild." . mysqli_error($db));
                    }
                }
            ?>
          </div>


          <!-- Right Side -->
          <div class="col-lg-7">

            <!-- Edit Form Start -->
            <?php
              if (isset( $_GET['edit'] )){ 
                $editID = $_GET['edit'];
                
                $sql = "SELECT * FROM departments WHERE cat_id = '$editID'";
                $editCat = mysqli_query($db, $sql);
                while ( $row = mysqli_fetch_assoc($editCat) ) {
                  $cat_id     = $row['cat_id'];
                  $cat_name   = $row['cat_name'];
                  $cat_desc   = $row['cat_desc'];
                  $status     = $row['status'];
                  ?>

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Update Category Information</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body" style="display: block;">
                      <form action="" method="POST">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" autocomplete="off" required="required" id="name" value="<?php echo $cat_name; ?>">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="desc"><?php echo $cat_desc; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Parent Category</label>
                          <select class="form-control" name="sub_category">
                            <option value="0">Please Select the Parent Category Status</option>
                            <?php
                              $getSubCatSQL = "SELECT * FROM category WHERE sub_category = 0";
                              $result       = mysqli_query($db,$getSubCatSQL);
                              $rowCount     = mysqli_num_rows($result);
                              if($rowCount > 0){
                                  while($rowSub = mysqli_fetch_assoc($result)){
                                  $cat_id = $rowSub['cat_id'];
                                  $cat_name = $rowSub['cat_name'];
                                ?>
                                  <option value='<?=$cat_id?>'><?=$cat_name?></option>"
                                <?php
                                  }
                              } 
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="1">Please Select the Category Status</option>
                            <option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?> >Active</option>
                            <option value="0" <?php if ( $status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="updateID" value="<?php echo $cat_id; ?>">
                          <input type="submit" name="updateCategory" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                        </div>
                      </form>
                    </div>
              <!-- /.card-body -->
            </div>
              <?php  }                
              }
            ?>

            <?php
              // Update Category Info
              if (isset($_POST['updateCategory'])){
                $name     = $_POST['name'];
                $desc     = $_POST['desc'];
                $status   = $_POST['status'];
                $updateID = $_POST['updateID'];
                $sub_cat  = $_POST['sub_category'];
                $sql = "UPDATE category SET cat_name='$name', cat_desc='$desc', status='$status',sub_category='$sub_cat' WHERE cat_id = '$updateID'";

                $updateSuccess = mysqli_query($db, $sql);

                if ( $updateSuccess ){
                  header("Location: category.php");
                }
                else{
                  die("MySQL Connection Faild." . mysqli_error($db));
                }
              }
            ?>
            <!-- Edit Form End -->



            <!-- All Category Start -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage All Departments</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                #SL.
                            </th>
                            <th style="width: 25%">
                                Department Name
                            </th>
                            <th style="width: 20%">
                                Status
                            </th>
                            <th style="width: 25%">
                                Parent Department 
                            </th>                           
                            <th style="width: 20%">
                              Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          $total_rows = $db->query("SELECT * FROM departments")->num_rows;

                          $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                          $rows_per_page = 10;

                          if($statement = $db->prepare("SELECT * FROM departments LIMIT ?,?") ){
                              $cal_page = ($current_page - 1) * $rows_per_page;
                              $statement->bind_param("ii",$cal_page,$rows_per_page);
                              $statement->execute();
                              $allCat = $statement->get_result();
                          }
                      ?>
                      <?php
                        $i = 0;
                        while ( $row = mysqli_fetch_assoc($allCat) ) {
                                $dept_id      = $row['dept_id'];
                                $dept_title   = $row['dept_title'];
                                $dept_desc    = $row['dept_desc'];
                                $dept_status  = $row['dept_status'];
                                $sub_dept     = $row['sub_dept'];
                                $i++;
                            ?>

                            <tr>
                                <th><?php echo $i; ?></th>
                                <td><?php echo $dept_title; ?></td>
                                <td>
                                <?php
                                    if ( $dept_status == 0 ){ ?>
                                    <span class="badge badge-danger">Inactive</span>
                                    <?php }
                                    else if ( $dept_status == 1 ){ ?>
                                    <span class="badge badge-success">Active</span>
                                    <?php }
                                ?>
                                </td>

                                <td>
                                <?php
                                    if($sub_dept != 0){
                                        $parentCatSql = "SELECT * FROM departments WHERE dept_id = '$sub_dept'";
                                        $resparent    = mysqli_query($db,$parentCatSql);
                                        while($rowParentx = mysqli_fetch_assoc($resparent)){
                                            $subCat_name = $rowParentx['dept_title'];
                                        }
                                        echo $subCat_name;
                                    }
                                    else{
                                        echo "None";
                                    }
                                ?>
                                </td>
                                
                                <td class="project-actions">
                                    <a class="btn btn-outline-secondary btn-sm" href="category.php?edit=<?php echo $dept_id; ?>">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                    <a class="btn btn-outline-primary btn-sm" href="category.php?edit=<?php echo $dept_id; ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $dept_id; ?>">
                                        <i class="fas fa-trash">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                      <?php  
                        }
                      ?>

                        
                        
                    </tbody>
                </table>
                        <?php if( ceil($total_rows / $rows_per_page) > 0) : ?>
                        <nav aria-label="Page navigation example vertical-align-bottom ">
                            <ul class="pagination justify-content-center mt-3">

                                <!-- PREVIOUS BUTTON -->
                                <?php if($current_page > 1) : ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="category.php?page=<?=($current_page-1)?>" tabindex="-1" aria-disabled="true">&laquo;</a>
                                    </li>
                                <?php else : ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="" tabindex="-1" aria-disabled="true">&laquo;</a>
                                    </li>
                                <?php endif;?>

                                <?php if($current_page - 2 > 0) : ?>
                                    <li class="page-item"><a class="page-link" href="category.php?page=<?=($current_page - 2 )?>"><?=($current_page - 2 )?></a></li>
                                <?php endif;?>

                                <?php if($current_page - 1 > 0) : ?>
                                    <li class="page-item"><a class="page-link" href="category.php?page=<?=($current_page - 1 )?>"><?=($current_page - 1 )?></a></li>
                                <?php endif;?>

                                <li class="page-item active"><a class="page-link" href="category.php?page=<?=$current_page?>"><?=$current_page?></a></li>

                                <?php if($current_page + 1 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                                    <li class="page-item"><a class="page-link" href="category.php?page=<?=($current_page + 1 )?>"><?=($current_page + 1 )?></a></li>
                                <?php endif;?>

                                <?php if($current_page + 2 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                                    <li class="page-item"><a class="page-link" href="category.php?page=<?=($current_page + 2 )?>"><?=($current_page + 2 )?></a></li>
                                <?php endif;?>
                                
                                <!-- NEXT BUTTON -->
                                <?php if($current_page < ceil($total_rows / $rows_per_page)) : ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="category.php?page=<?=($current_page + 1 )?>" tabindex="-1" aria-disabled="true">&raquo;</a>
                                    </li>
                                <?php else : ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="" tabindex="-1" aria-disabled="true">&raquo;</a>
                                    </li>
                                <?php endif;?>
                            </ul>
                        </nav>
                        <?php endif;?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- All Category End -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    // Delete Category Query
    if ( isset( $_GET['delete'] ) ){
      $delete_id = $_GET['delete'];

      $sql = "DELETE FROM category WHERE cat_id = '$delete_id' ";
      $delete_query = mysqli_query($db, $sql);
      if ( $delete_query ){
        header("Location: category.php");
      }
      else{
        die("MySQL Query Failed. " . mysqli_error($db));
      }
    }
  ?>



  <!-- Footer -->
  <?php include "inc/footer.php"; ?>

  <!-- Control Sidebar -->
  <?php include "inc/sidebar.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>
