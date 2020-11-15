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
            <h1 class="m-0 text-dark">Manage Mentors</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
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
                <?php
                    $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
                    if($action == "Manage"){
                        ?>

                            <div class="col-lg-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">All Mentors List</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="dataTables_length" id="example1_length">
                                                        <label class="float-left align-items-center d-flex">Show 
                                                            <select name="example1_length" aria-controls="example1" class="ml-2 mr-2 custom-select custom-select-sm form-control form-control-sm">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="100">100</option>
                                                            </select> entries
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div id="example1_filter" class="dataTables_filter">
                                                        <label class="float-right align-items-center d-flex">Search:<input type="search" class="ml-2 form-control form-control-sm" placeholder="" aria-controls="example1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                                        <thead class="thead-dark">
                                                            <tr role="row">
                                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SL#</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Profile Image</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Mentor Name: activate to sort column ascending">Mentor Name</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Department</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Skills: activate to sort column ascending" width="15%">Skills</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending">Phone</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" width="10%">Current Batch</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Portfolio: activate to sort column ascending">Portfolio</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" width="10%">Action</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $getMentorsSql = "SELECT * FROM mentors INNER JOIN users ON mentors.user_FK = users.id INNER JOIN departments ON mentors.mentor_dept = departments.dept_id";
                                                                $resultSet     = mysqli_query($db,$getMentorsSql);
                                                                $count = 0;
                                                                while($mentor = mysqli_fetch_assoc($resultSet)){
                                                                    $count++;
                                                                    $skills_list = explode(',', $mentor['skills'] );
                                                                    ?>
                                                                        <tr role="row" class="odd">
                                                                            <td tabindex="0" class="sorting_1"><?=$count?></td>
                                                                            <td class="text-center">
                                                                                <?php
                                                                                    if(!empty($mentor['image'])){
                                                                                        ?>
                                                                                            <img src="img/users/<?=$mentor['image']?>" alt="" class="table-img">
                                                                                        <?php
                                                                                    }
                                                                                    else{
                                                                                        ?>
                                                                                            <img src="img/users/temp.png" alt="" class="table-img">
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td><?=$mentor['name']?></td>
                                                                            <td><?=$mentor['email']?></td>
                                                                            <td><?=$mentor['dept_title']?></td>
                                                                            <td>
                                                                                <?php
                                                                                    foreach($skills_list as $skill){
                                                                                        $getSkill    = "SELECT * FROM skills WHERE sk_id = '$skill'";
                                                                                        $resSkill    = mysqli_query($db,$getSkill);
                                                                                        while($rowSk = mysqli_fetch_assoc($resSkill)){
                                                                                            ?>
                                                                                                <span class="badge badge-info"><?=trim($rowSk['sk_title'])?></span>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td><?=$mentor['address']?></td>
                                                                            <td><?=$mentor['phone']?></td>
                                                                            <td>
                                                                                <?php
                                                                                    if(!empty($mentor['crs_taking'])){
                                                                                        $crs_takingList = explode(',' , $mentor['crs_taking']);
                                                                                        foreach($crs_takingList as $crs){
                                                                                            $getId = "SELECT crs_customID FROM courses WHERE crs_id = $crs";
                                                                                            $resCrs = mysqli_query($db,$getId);
                                                                                            while($crs = mysqli_fetch_assoc($resCrs)){
                                                                                                ?>
                                                                                                    <span class="badge badge-info"><?=$crs['crs_customID']?></span>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    else{
                                                                                        echo "-";
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td><a href="<?=$mentor['portfolio_link']?>"><?=$mentor['portfolio_link']?></a></td>
                                                                            <td class="project-actions">
                                                                                <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" href="#productmodal<?=$mentor['id']?>">
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
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                                    <ul class="pagination float-right">
                                                        <li class="paginate_button page-item previous disabled" id="example1_previous">
                                                            <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                        </li>
                                                        <li class="paginate_button page-item active">
                                                            <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                        </li>
                                                        <li class="paginate_button page-item ">
                                                            <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                                        </li>
                                                        <li class="paginate_button page-item ">
                                                            <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                                        </li>
                                                        <li class="paginate_button page-item ">
                                                            <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                                        </li>
                                                        <li class="paginate_button page-item ">
                                                            <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                                        </li>
                                                        <li class="paginate_button page-item ">
                                                            <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                                                        </li>
                                                        <li class="paginate_button page-item next" id="example1_next">
                                                            <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
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
                                        <h3 class="card-title">Add New Mentor</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="mentors.php?action=Insert" method="POST" enctype="multipart/form-data">
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
                                                    

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="profile_image" name="profile_image" onchange="getfileinfo()">
                                                                <label class="custom-file-label" for="exampleInputFile" id="choose_file">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <!-- PREVIEW SELECT FILE INFO START -->
                                                        <div class="file-info mt-3" id="preview_block" style="display: none;">
                                                            <div class="main-file-info ">
                                                                <div class="row align-items-center mb-3 bg-light bg-custom">
                                                                    <div class="col-md-3">
                                                                        <img src="" id="preview_file" alt="" width="100px" height="120px" class="w-100">
                                                                    </div>
                                                                    <div class="col-md-7" onmousedown='return false;' onselectstart='return false;'>
                                                                        <p class="m-0" >
                                                                            <span class="font-weight-bold">File Name : </span>
                                                                            <span id="file_name"></span>
                                                                        </p>
                                                                        <p class="mt-1 mb-0" >
                                                                            <span class="font-weight-bold">Size : </span>
                                                                            <span id="file_size"></span>
                                                                        </p>
                                                                        <p class="m-0" >
                                                                            <span class="font-weight-bold">Type : </span>
                                                                            <span id="file_type"></span>
                                                                            <span id="validate" class="text-danger"></span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-center">
                                                                        <button type="reset" class="btn btn-outline-danger" onclick="resetPreview()"><i class="fas fa-trash-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- PREVIEW SELECT FILE INFO END -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Address</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Department</label>
                                                        <select name="department" id="select2dept" class="form-control">
                                                            <?php
                                                                $deptSql = "SELECT * FROM departments WHERE dept_status = 1";
                                                                $resDept = mysqli_query($db,$deptSql);
                                                                while($rowDept = mysqli_fetch_assoc($resDept)){
                                                                    ?>
                                                                        <option value="<?=$rowDept['dept_id']?>"><?=$rowDept['dept_title']?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Skills</label>
                                                        <select name="skills[]" id="select2skills" class="form-control" multiple>
                                                            <?php
                                                                $skillSql = "SELECT * FROM skills WHERE sk_status = 1";
                                                                $resskill = mysqli_query($db,$skillSql);
                                                                while($rowskill = mysqli_fetch_assoc($resskill)){
                                                                    ?>
                                                                        <option value="<?=$rowskill['sk_id']?>"><?=$rowskill['sk_title']?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Portfolio Link</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" name="link" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Status</label>
                                                        <select name="status" id="" class="form-control">
                                                            <option value="0">Please Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Role</label>
                                                        <select name="role" id="" class="form-control">
                                                            <option value="0">Please Select Role</option>
                                                            <option value="2">Mentor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Profile Description</label>
                                                        <textarea class="textarea" name="desc" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 m-auto">
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
                    else if($action == "Insert"){
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            $fullname   = $_POST['fullname'];
                            $email      = $_POST['email'];
                            $password   = $_POST['password'];
                            $repassword = $_POST['repassword'];
                            $department = $_POST['department'];
                            $skills     = $_POST['skills'];
                            $link       = $_POST['link'];
                            $status     = $_POST['status'];
                            $role       = $_POST['role'];
                            $phone      = $_POST['phone'];
                            $address    = $_POST['address'];
                            $desc       = $_POST['desc'];
                            
                            // Preapre the Image
							$imageName    = $_FILES['profile_image']['name'];
							$imageSize    = $_FILES['profile_image']['size'];
							$imageTmp     = $_FILES['profile_image']['tmp_name'];

							$imageAllowedExtension = array("jpg", "jpeg", "png");
							$ext_arr = explode('.', $imageName);
							$imageExtension = strtolower( end( $ext_arr ) );
							
							$formErrors = array();

							if ( strlen($fullname) < 3 ){
								$formErrors[] = 'Username is too short!!!';
							}
							if ( $password != $repassword ){
								$formErrors[] = 'Password Doesn\'t match!!!';
							}
							if ( !empty($imageName) ){
								if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
									$formErrors[] = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
								}
								if ( !empty($imageSize) && $imageSize > 2097152 ){
									$formErrors[] = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
								}
							}

							if ( empty($formErrors) ){
								// Encrypted Password
								$hassedPass = sha1($password);

								if ( !empty( $imageName ) ){
									// Change the Image Name
									$image = rand(0, 999999) . '_' .$imageName;
									// Upload the Image to its own Folder Location
									move_uploaded_file($imageTmp, "img/users/" . $image );

									$sql = "INSERT INTO users ( name, email, password, address, phone, role, status, image, join_date ) VALUES ('$fullname', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";

									$addUser = mysqli_query($db, $sql);

									if ( $addUser ){
                                        $skills_list = implode(',',$skills);
                                        $getUser   = "SELECT * FROM users WHERE email = '$email' AND password = '$hassedPass'";
                                        $resUser   = mysqli_query($db,$getUser);
                                        while($rowUser = mysqli_fetch_assoc($resUser)){
                                            $user_id = $rowUser['id'];
                                        }
                                        $addmentor = "INSERT INTO `mentors`(`skills`, `mentor_dept`, `portfolio_link`, `mentor_desc`, `user_FK`) 
                                                    VALUES ('$skills_list','$department','$link','$desc','$user_id')";
                                        $addRes   = mysqli_query($db,$addmentor);
                                        if($addRes){
                                            $_SESSION['message'] = "New Mentor Add Successfully..";
                                            $_SESSION['type']    = "success";
                                            header("location: mentors.php?action=Manage");
                                            exit();
                                        }
									}
									else{
										die("MySQLi Query Failed." . mysqli_error($db));
									}
								}
								else{
									$sql = "INSERT INTO users ( name, email, password, address, phone, role, status, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', now() )";

									$addUser = mysqli_query($db, $sql);

									if ( $addUser ){
										$_SESSION['message'] = "Registration Successfull. Please Wait For Verification..";
										$_SESSION['type']    = "success";
										header("location: my-account.php?action=SignIn");
										exit();
									}
									else{
										die("MySQLi Query Failed." . mysqli_error($db));
									}

								}
								
							}
							else{
								$_SESSION['message_arr'] = $formErrors;
								$_SESSION['type']    = "error";
								header("location: my-account.php?action=SignUp");
								exit();
							}
                        }
                    }
                    else if($action == "Edit"){

                    }
                    else if($action == "Update"){

                    }
                    else if($action == "Delete"){

                    }
                    else if($action == "View"){

                    }
                ?>
                
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
    <!-- MENTOR MODAL VIEW -->
    <?php include "modals/mentor_modal.php";?>
  <!-- Footer -->
  <?php include "inc/footer.php"; ?>

  <!-- Control Sidebar -->
  <?php include "inc/controlbar.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>