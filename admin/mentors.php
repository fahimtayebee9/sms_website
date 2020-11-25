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
                                                                    $getMentorsSql = "SELECT * FROM mentors 
                                                                                INNER JOIN departments ON mentors.mentor_dept = departments.dept_id";
                                                                    $count = 0;

                                                                    $table = "mentors";
                                                                    $data = array(
                                                                        'order_by' => 'mentor_id DESC'
                                                                    );
                                                                    
                                                                    $allusers = $db->select($table,$data);

                                                                    foreach($allusers as $mentor){
                                                                        $count++;
                                                                        $skills_list = explode(',', $mentor->skills );

                                                                        $table = "users";
                                                                        $dataUser = array(
                                                                            'where' => array(
                                                                                'id' => $mentor->user_FK
                                                                            ),
                                                                            'return_type' => 'single'
                                                                        );
                                                                        $userInfo =  $db->select($table,$dataUser);

                                                                        $table = "departments";
                                                                        $datadept = array(
                                                                            'where' => array(
                                                                                'dept_id' => $mentor->mentor_dept
                                                                            ),
                                                                            'return_type' => 'single'
                                                                        );
                                                                        $dept_info =  $db->select($table,$datadept);

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
                                                                                <td><?=$dept_info->dept_title?></td>
                                                                                <td>
                                                                                    <?php
                                                                                        foreach($skills_list as $skill){
                                                                                            $table = "skills";
                                                                                            $data = array(
                                                                                                'where' => array(
                                                                                                    'sk_id' => $skill
                                                                                                ),
                                                                                                'return_type' => 'single'
                                                                                            );
                                                                                            
                                                                                            $skillsInfo = $db->select($table,$data);
                                                                                            ?>
                                                                                                <span class="badge badge-info"><?=trim($skillsInfo->sk_title)?></span>
                                                                                            <?php
                                                                                        }
                                                                                    ?>
                                                                                </td>
                                                                                <td><?=$userInfo->address?></td>
                                                                                <td><?=$userInfo->phone?></td>
                                                                                <td>
                                                                                    <?php
                                                                                        if(!empty($mentor->crs_taking)){
                                                                                            $crs_takingList = explode(',' , $mentor->crs_taking);
                                                                                            foreach($crs_takingList as $crs){

                                                                                                $table = "courses";
                                                                                                $data = array(
                                                                                                    'where' => array(
                                                                                                        'crs_id' => $crs
                                                                                                    ),
                                                                                                    'return_type' => 'single'
                                                                                                );
                                                                                                $crs_Info = $db->select($table,$data);

                                                                                                ?>
                                                                                                    <span class="badge badge-info"><?=$crs_Info->crs_customID?></span>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        else{
                                                                                            echo "-";
                                                                                        }
                                                                                    ?>
                                                                                </td>
                                                                                <td><a href="https://<?=$mentor->portfolio_link?>"><?=$mentor->portfolio_link?></a></td>
                                                                                <td class="project-actions">
                                                                                    <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" href="#productmodal<?=$userInfo->id?>">
                                                                                        <i class="fas fa-eye">
                                                                                        </i>
                                                                                    </a>
                                                                                    <a class="btn btn-outline-primary btn-sm" href="mentors.php?action=Edit&edit=<?=$userInfo->id?>">
                                                                                        <i class="fas fa-pencil-alt">
                                                                                        </i>
                                                                                    </a>
                                                                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteData('mentors', <?=$userInfo->id?>)">
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
                                        <form role="form" action="controllers/MentorController.php" method="POST" enctype="multipart/form-data">
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Address</label>
                                                            <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Department</label>
                                                            <select name="department" id="select2dept" class="form-control" multiple="off">
                                                                <option value="0">Please Select Department</option>
                                                                <?php
                                                                    $table_dept = 'departments';
                                                                    $data_dept  = array(
                                                                        'where' => array(
                                                                            'dept_status' => 1
                                                                        )
                                                                    );
                                                                    $dept_list = $db->select($table_dept, $data_dept);
                                                                    foreach($dept_list as $dept){
                                                                        ?>
                                                                            <option value="<?=$dept->dept_id?>"><?=$dept->dept_title?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Skills</label>
                                                            <select name="skills[]" id="select2skills" class="form-control" multiple>
                                                                <?php
                                                                    $table_sk = 'skills';
                                                                    $data_sk  = array(
                                                                        'where' => array(
                                                                            'sk_status' => 1
                                                                        )
                                                                    );
                                                                    $skills_list = $db->select($table_sk, $data_sk);
                                                                    foreach($skills_list as $sk){
                                                                        ?>
                                                                            <option value="<?=$sk->sk_id?>"><?=$sk->sk_title?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Assign Course</label>
                                                            <select name="crs_taking[]" id="select2crs" class="form-control" multiple>
                                                                <option value="0">Please Select Course</option>
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
                                                            <label for="exampleInputPassword1">Portfolio Link</label>
                                                            <input type="text" class="form-control" id="" name="link" placeholder="Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Status</label>
                                                            <select name="status" id="" class="form-control">
                                                                <option value="1">Please Select Status</option>
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
                            if(isset($_GET['edit'])){
                                $edit_id = $_GET['edit'];

                                // GET DATA FROM USERS TABLE
                                $table_user = 'users';
                                $data_user  = array(
                                    'where' => array(
                                        'id' => $edit_id
                                    ),
                                    'return_type' => 'single'
                                );
                                $user = $db->select($table_user, $data_user);
                                
                                // GET DATA FROM MENTORS TABLE
                                $table_mentor = 'mentors';
                                $data_mentor  = array(
                                    'where' => array(
                                        'user_FK' => $user->id
                                    ),
                                    'return_type' => 'single'
                                );
                                $mentor = $db->select( $table_mentor , $data_mentor );

                                // GET DATA FROM MENTORS TABLE
                                $table_dept = 'departments';
                                $data_dept  = array(
                                    'where' => array(
                                        'dept_id' => $mentor->mentor_dept
                                    ),
                                    'return_type' => 'single'
                                );
                                $dept = $db->select( $table_dept , $data_dept );

                                // GET DATA FROM COURSES TABLE
                                $crs_arr = explode(',' , $mentor->crs_taking);

                                ?>
                                    <div class="col-md-12">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h3 class="card-title">Edit New Mentor</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <form role="form" action="controllers/MentorController.php" method="POST" enctype="multipart/form-data">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Full Name</label>
                                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Name" value="<?=$user->name?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Email address</label>
                                                                <input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail()" placeholder="Enter Email" value="<?=$user->email?>">
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
                                                                <input type="text" class="form-control" id="exampleInputPassword1" name="phone" placeholder="Phone" value="<?=$user->phone?>">
                                                            </div>
                                                            

                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Profile Picture</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="profile_image" name="profile_image" onchange="getfileinfo()">
                                                                        <label class="custom-file-label" for="exampleInputFile" id="choose_file">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                <!-- PREVIEW SELECT FILE INFO START -->
                                                                <div class="file-info mt-3" id="preview_block" style="display: <?php if(!empty($user->image)){echo "block";}else{echo "none";}?>;">
                                                                    <?php
                                                                        $table = "uploaded_file_info";
                                                                        $data  = array(
                                                                            'where' => array(
                                                                                'file_name' => $user->image
                                                                            ),
                                                                            'return_type' => 'single'
                                                                        );
                                                                        $img_info = $db->select($table,$data);
                                                                    ?>
                                                                    <div class="main-file-info ">
                                                                        <div class="row align-items-center mb-3 bg-light bg-custom">
                                                                            <div class="col-md-3">
                                                                                <img src="img/users/<?=$img_info->file_name?>" id="preview_file" alt="" width="100px" height="120px" class="w-100">
                                                                            </div>
                                                                            <div class="col-md-7" onmousedown='return false;' onselectstart='return false;'>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><span class="font-weight-bold">File Name</span></td>
                                                                                            <td class="pl-2 pr-2"> : </td>
                                                                                            <td><span id="file_name"><?=$img_info->file_name?></span></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <span class="font-weight-bold">Size</span>
                                                                                            </td>
                                                                                            <td class="pl-2 pr-2"> : </td>
                                                                                            <td>
                                                                                                <span id="file_size"><?=$img_info->file_size?></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <span class="font-weight-bold">Type</span>
                                                                                            </td>
                                                                                            <td class="pl-2 pr-2"> : </td>
                                                                                            <td>
                                                                                                <span id="file_type"><?=$img_info->file_type?></span>
                                                                                                <span id="validate" class="text-danger"></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
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
                                                                <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address" value="<?=$user->address?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Department</label>
                                                                <select name="department" id="select2dept" class="form-control">
                                                                    <option value="0">Please Select Department</option>
                                                                    <?php
                                                                        $table_dept = 'departments';
                                                                        $data_dept  = array(
                                                                            'where' => array(
                                                                                'dept_status' => 1
                                                                            )
                                                                        );
                                                                        $dept_list = $db->select($table_dept, $data_dept);
                                                                        foreach($dept_list as $dept){
                                                                            ?>
                                                                                <option value="<?=$dept->dept_id?>" <?php if($dept->dept_id == $mentor->mentor_dept){ echo "selected";}?>><?=$dept->dept_title?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Skills</label>
                                                                <select name="skills[]" id="select2skills" class="form-control" multiple>
                                                                    <?php
                                                                        $table_sk = 'skills';
                                                                        $data_sk  = array(
                                                                            'where' => array(
                                                                                'sk_status' => 1
                                                                            )
                                                                        );
                                                                        $skills_list = $db->select($table_sk, $data_sk);
                                                                        foreach($skills_list as $sk){
                                                                            ?>
                                                                                <option value="<?=$sk->sk_id?>" <?php if(in_array($sk->sk_id , explode(',' , $mentor->skills))){ echo "selected";}?>><?=$sk->sk_title?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Assign Course</label>
                                                                <select name="crs_taking[]" id="select2crs" class="form-control" multiple>
                                                                    <option value="0">Please Select Course</option>
                                                                    <?php
                                                                        $table_crs = 'courses';
                                                                        $data_crs  = array(
                                                                            'order_by' => 'crs_id DESC'
                                                                        );

                                                                        $crs_list = $db->select($table_crs, $data_crs);
                                                                        foreach($crs_list as $crs){
                                                                            ?>
                                                                                <option value="<?=$crs->crs_id?>" <?php if(in_array($crs->crs_id , explode(',' , $mentor->crs_taking))){ echo "selected";}?> >( <?=$crs->crs_customID?> )<?=$crs->crs_title?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Portfolio Link</label>
                                                                <input type="text" class="form-control" id="exampleInputPassword1" name="link" placeholder="Portfolio Link" value="<?=$mentor->portfolio_link?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Status</label>
                                                                <select name="status" id="" class="form-control">
                                                                    <option value="1">Please Select Status</option>
                                                                    <option value="1" <?php if($user->status==1){echo "selected";}?> >Active</option>
                                                                    <option value="0" <?php if($user->status==0){echo "selected";}?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Role</label>
                                                                <select name="role" id="" class="form-control">
                                                                    <option value="0" <?php if($user->status==0){echo "selected";}?>>Please Select Role</option>
                                                                    <option value="2" <?php if($user->status==2){echo "selected";}?>>Mentor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Profile Description</label>
                                                                <textarea class="textarea" name="desc" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;">
                                                                    <?=$mentor->mentor_desc?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 m-auto">
                                                            <input type="hidden" name="action" value="edit">
                                                            <input type="hidden" name="edit_id" value="<?=$edit_id?>">
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