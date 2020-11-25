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
                <form action="controllers/DepartmentController.php" method="POST">
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
                    <select class="form-control w-100" id="select2adddept" name="sub_Dept" required>
                      
                      <option value="0">No Parent Department </option>
                      
                      <?php
                        $table = 'departments';
                        $data  = array(
                          'where' => array(
                            'sub_dept' => 0
                          )
                        );
                        $dept_list = $db->select($table,$data);
                        foreach($dept_list as $dpt){
                          $dept_id = $dpt->dept_id;
                          $dept_title = $dpt->dept_title;
                          ?>
                              <option value="<?=$dept_id?>"><?=$dept_title?></option>
                          <?php
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
                    <input type="hidden" name="action" value="add">
                    <input type="submit" name="addDept" class="btn btn-block btn-primary btn-flat" value="Add New Category">
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- Add New Category End -->

          </div>


          <!-- Right Side -->
          <div class="col-lg-7">

            <!-- Edit Form Start -->
            <?php
              if (isset( $_GET['edit'] )){ 
                $editID = $_GET['edit'];
                $data = array(
                  'where' => array(
                    'dept_id' => $editID
                  ),
                  'return_type' => 'single'
                );

                $editCat = $db->select('departments',$data);

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
                      <form action="controllers/DepartmentController.php" method="POST">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" autocomplete="off" required="required" id="name" value="<?php echo $editCat->dept_title; ?>">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="desc"><?php echo $editCat->dept_desc; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Parent Category</label>
                          <select class="form-control" name="sub_category">
                            <option value="0">Please Select the Parent Category Status</option>
                            <?php
                              $table = 'departments';
                              $data  = array(
                                'where' => array(
                                  'sub_dept' => 0
                                )
                              );
                              $dept_list = $db->select($table,$data);
                              foreach($dept_list as $dpt){
                                $dept_id = $dpt->dept_id;
                                $dept_title = $dpt->dept_title;
                                ?>
                                    <option value="<?=$dept_id?>" <?php if($dept_id == $editCat->sub_dept){ echo "selected";}?>><?=$dept_title?></option>
                                <?php
                              } 
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="1">Please Select the Category Status</option>
                            <option value="1" <?php if ( $editCat->dept_status == 1 ){ echo 'selected'; } ?> >Active</option>
                            <option value="0" <?php if ( $editCat->dept_status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="updateID" value="<?php echo $editCat->dept_id; ?>">
                          <input type="hidden" name="action" value="edit">
                          <input type="submit" name="updateCategory" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                        </div>
                      </form>
                    </div>
              <!-- /.card-body -->
            </div>
              <?php  }  
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
                          $table = 'departments';
                          $data  = array(
                            'return_type' => 'count'
                          );
                          $total_rows = $db->select($table,$data);

                          $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                          $rows_per_page = 10;

                          $cal_page = ($current_page - 1) * $rows_per_page;
                          $data_lm = array(
                            'limit' => array(
                              '1' => $cal_page,
                              '2' => $rows_per_page
                            )
                          );
                          $allCat = $db->select($table,$data_lm);
                              
                      ?>
                      <?php
                        $i = 0;
                        foreach($allCat as $cat){
                                $dept_id      = $cat->dept_id;
                                $dept_title   = $cat->dept_title;
                                $dept_desc    = $cat->dept_desc;
                                $dept_status  = $cat->dept_status;
                                $sub_dept     = $cat->sub_dept;
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
                                          $searchData = array(
                                            'where' => array(
                                              'dept_id' => $sub_dept
                                            ),
                                            'return_type' => 'single'
                                          );
                                          $resparent    = $db->select('departments',$searchData);
                                          echo $resparent->dept_title;
                                      }
                                      else{
                                          echo "None";
                                      }
                                  ?>
                                </td>
                                
                                <td class="project-actions">
                                    <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#view<?php echo $dept_id; ?>" href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-outline-primary btn-sm" href="departments.php?edit=<?php echo $dept_id; ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteData('departments',<?php echo $dept_id; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                      <?php  
                        }
                      ?>

                        
                        
                    </tbody>
                </table>

                <?php include "modals/dept_modal.php";?>

                <?php if( ceil($total_rows / $rows_per_page) > 0) : ?>
                <nav aria-label="Page navigation example vertical-align-bottom ">
                    <ul class="pagination justify-content-center mt-3">

                        <!-- PREVIOUS BUTTON -->
                        <?php if($current_page > 1) : ?>
                            <li class="page-item ">
                                <a class="page-link" href="departments.php?page=<?=($current_page-1)?>" tabindex="-1" aria-disabled="true">&laquo;</a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="" tabindex="-1" aria-disabled="true">&laquo;</a>
                            </li>
                        <?php endif;?>

                        <?php if($current_page - 2 > 0) : ?>
                            <li class="page-item"><a class="page-link" href="departments.php?page=<?=($current_page - 2 )?>"><?=($current_page - 2 )?></a></li>
                        <?php endif;?>

                        <?php if($current_page - 1 > 0) : ?>
                            <li class="page-item"><a class="page-link" href="departments.php?page=<?=($current_page - 1 )?>"><?=($current_page - 1 )?></a></li>
                        <?php endif;?>

                        <li class="page-item active"><a class="page-link" href="departments.php?page=<?=$current_page?>"><?=$current_page?></a></li>

                        <?php if($current_page + 1 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                            <li class="page-item"><a class="page-link" href="departments.php?page=<?=($current_page + 1 )?>"><?=($current_page + 1 )?></a></li>
                        <?php endif;?>

                        <?php if($current_page + 2 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                            <li class="page-item"><a class="page-link" href="departments.php?page=<?=($current_page + 2 )?>"><?=($current_page + 2 )?></a></li>
                        <?php endif;?>
                        
                        <!-- NEXT BUTTON -->
                        <?php if($current_page < ceil($total_rows / $rows_per_page)) : ?>
                            <li class="page-item ">
                                <a class="page-link" href="departments.php?page=<?=($current_page + 1 )?>" tabindex="-1" aria-disabled="true">&raquo;</a>
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
