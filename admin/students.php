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
            <h3 class="m-0 text-dark">Manage Students</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
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
          <div class="col-lg-12">
            <?php
                $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
                if($action == "Manage"){
                    ?>

                        <div class="col-lg-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">All Students List</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                                    <thead class="thead-dark">
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SL#</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Profile Image</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Mentor Name: activate to sort column ascending">Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending">Phone</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Current Course</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Skills: activate to sort column ascending" width="15%">Paid Amount</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Portfolio: activate to sort column ascending">Payment Date</th>
                                                            <th width="10%">Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $count = 0;

                                                            $table = "students";
                                                            $data = array(
                                                                'order_by' => 'std_id DESC'
                                                            );
                                                            
                                                            $allusers = $db->select($table,$data);

                                                            foreach($allusers as $std){
                                                                $count++;

                                                                $table = "users";
                                                                $dataUser = array(
                                                                    'where' => array(
                                                                        'id' => $std->user_FK
                                                                    ),
                                                                    'return_type' => 'single'
                                                                );
                                                                $userInfo =  $db->select($table,$dataUser);

                                                                $table_crs = "courses";
                                                                $data_crs = array(
                                                                    'where' => array(
                                                                        'crs_id' => $std->current_crs
                                                                    ),
                                                                    'return_type' => 'single'
                                                                );
                                                                $crs_info =  $db->select($table_crs,$data_crs);
                                                                ?>
                                                                    <tr role="row" class="odd">
                                                                        <td tabindex="0" class="sorting_1"><?=$count?></td>
                                                                        <td class="text-center">
                                                                            <?php
                                                                                if(!empty($userInfo->image)){
                                                                                    ?>
                                                                                        <img src="img/users/<?=$userInfo->image?>" alt="" class="table-img">
                                                                                    <?php
                                                                                }
                                                                                else{
                                                                                    ?>
                                                                                        <img src="img/users/temp.png" alt="" class="table-img">
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td><?=$userInfo->name?></td>
                                                                        <td><?=$userInfo->email?></td>
                                                                        <td><?=$userInfo->phone?></td>
                                                                        <td>
                                                                            <?php
                                                                                if(isset($crs_info->crs_customID)){
                                                                                    ?>
                                                                                        <span class="badge badge-info"><?=$crs_info->crs_customID?></span>
                                                                                    <?php
                                                                                }
                                                                                else{
                                                                                    echo "-";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                if(!empty($std->paid_amount)){
                                                                                    echo $std->paid_amount . " BDT";
                                                                                }
                                                                                else{
                                                                                    echo "-";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                if(!empty($std->payment_date) || isset($std->payment_date)){
                                                                                    echo date("d M, Y", strtotime($std->payment_date));
                                                                                }
                                                                                else {
                                                                                    echo "Not Paid";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td class="project-actions">
                                                                            <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" href="#view<?=$userInfo->id?>">
                                                                                <i class="fas fa-eye">
                                                                                </i>
                                                                            </a>
                                                                            <a class="btn btn-outline-primary btn-sm" href="students.php?action=Edit&edit_id=<?=$userInfo->id?>">
                                                                                <i class="fas fa-pencil-alt">
                                                                                </i>
                                                                            </a>
                                                                            <button class="btn btn-outline-danger btn-sm" onclick="deleteData('students', <?=$userInfo->id?>)">
                                                                                <i class="fas fa-trash">
                                                                                </i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <div class="row">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    <?php
                }
                else if($action == "Add"){
                    ?>
                        <div class="col-md-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Student</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="controllers/StudentController.php" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Full Name</label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail()" placeholder="Enter Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Confrim Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1" name="repassword" placeholder="Confirm Password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Phone</label>
                                                    <input type="text" class="form-control" id="exampleInputPassword1" name="phone" placeholder="Phone">
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Address</label>
                                                    <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="">Assign Course</label>
                                                    <select name="current_crs" id="select2crs" class="form-control">
                                                        <option value=""></option>
                                                        <?php
                                                            $table_crs = 'courses';
                                                            $data_crs  = array(
                                                                'order_by' => 'crs_id DESC'
                                                            );

                                                            $crs_list = $db->select($table_crs, $data_crs);
                                                            foreach($crs_list as $crs){
                                                                ?>
                                                                    <option value="<?=$crs->crs_id?>">( <?=$crs->crs_customID?> )<?=$crs->crs_title?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Paid Amount</label>
                                                    <input type="text" class="form-control" name="paid_amount" id="" placeholder="Enter Amount">
                                                </div>     

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Status</label>
                                                    <select name="status" id="select2status" class="form-control">
                                                        <option value="">Please Select Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputFile">File input</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="profile_image" name="profile_image">
                                                            <label class="custom-file-label" for="exampleInputFile" id="choose_file">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <!-- PREVIEW SELECT FILE INFO START -->
                                                    <div class="file-info mt-3" id="preview_block" style="display: none;">
                                                        
                                                    </div>
                                                    <!-- PREVIEW SELECT FILE INFO END -->
                                                </div>

                                            </div>
                                            <div class="col-md-3 m-auto">
                                                <input type="hidden" name="action" value="add">
                                                <button type="submit" class="btn w-100 btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </form>
                            </div>
                        </div>
                    <?php
                }
                else if($action == "Edit"){
                    if( isset( $_GET['edit_id'])){
                        $edit_id = $_GET['edit_id'];

                        $data = array(
                            'where' => array(
                                'id' => $edit_id
                            ),
                            'return_type' => 'single'
                        );

                        $edit_user = $db->select('users',$data);

                        $data_std = array(
                            'where' => array(
                                'user_FK' => $edit_id
                            ),
                            'return_type' => 'single'
                        );

                        $edit_std = $db->select('students',$data_std);

                        ?>
                            <div class="col-md-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">Add New Student</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="controllers/StudentController.php" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Full Name</label>
                                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Name" value="<?=$edit_user->name?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail()" placeholder="Enter Email" value="<?=$edit_user->email?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Confrim Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1" name="repassword" placeholder="Confirm Password">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Phone</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="phone" placeholder="Phone" value="<?=$edit_user->phone?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Address</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address" value="<?=$edit_user->address?>">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="">Assign Course</label>
                                                        <select name="current_crs" id="select2crs" class="form-control">
                                                            <option value="0"></option>
                                                            <?php
                                                                $table_crs = 'courses';
                                                                $data_crs  = array(
                                                                    'order_by' => 'crs_id DESC'
                                                                );

                                                                $crs_list = $db->select($table_crs, $data_crs);
                                                                foreach($crs_list as $crs){
                                                                    ?>
                                                                        <option value="<?=$crs->crs_id?>" <?php if($crs->crs_id == $edit_std->current_crs){echo "selected";}?> >( <?=$crs->crs_customID?> )<?=$crs->crs_title?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Paid Amount</label>
                                                        <input type="text" class="form-control" name="paid_amount" id="" placeholder="Enter Amount" value="<?=$edit_std->paid_amount?>">
                                                    </div>     

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Status</label>
                                                        <select name="status" id="select2status" class="form-control">
                                                            <option value="">Please Select Status</option>
                                                            <option value="1" <?php if(1 == $edit_user->status){echo "selected";}?>>Active</option>
                                                            <option value="0" <?php if(0 == $edit_user->status){echo "selected";}?>>Inactive</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="profile_image" name="profile_image">
                                                                <label class="custom-file-label" for="exampleInputFile" id="choose_file">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <!-- PREVIEW SELECT FILE INFO START -->
                                                        <div class="file-info mt-3" id="preview_block" style="display: none;">
                                                            
                                                        </div>
                                                        <!-- PREVIEW SELECT FILE INFO END -->
                                                    </div>

                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <input type="hidden" name="action" value="edit">
                                                    <button type="submit" class="btn w-100 btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                        <?php
                    }
                    
                }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


    <!-- Footer -->
    <?php include "inc/footer.php"; ?>

    <!-- Control Sidebar -->
    <?php include "inc/controlbar.php"; ?>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>