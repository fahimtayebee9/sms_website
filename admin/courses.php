<?php include "inc/header.php"; ?>

  <!-- Navbar -->
  <?php include "inc/top_nav.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "inc/side_bar.php"; ?>
    <?php
        $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
            'May','June','July','August','September','October','November','December','Saturday','Sunday',
            'Monday','Tuesday','Wednesday','Thursday','Friday');
        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
            'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
            বুধবার','বৃহস্পতিবার','শুক্রবার' 
        );
    ?>


    <?php
        $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
        if($action == "Manage"){
            ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Manage Courses</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">All Courses</li>
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
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">All Courses</h3>

                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th width="15%">Title</th>
                                                        <th width="10%">Mentor</th>
                                                        <th width="5%">Duration</th>
                                                        <th width="10%">Class Time (day)</th>
                                                        <th width="15%">Class Start Date</th>
                                                        <th width="10%">Course Fee</th>
                                                        <th width="10%">Class Status <br> (online/offline)</th>
                                                        <th width="20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        // $getCrList = "SELECT * FROM courses 
                                                        // INNER JOIN mentors ON courses.mentor_FK = mentors.mentor_id 
                                                        // INNER JOIN users ON users.id = mentors.user_FK";

                                                        $data = array(
                                                            'order_by' => 'crs_id DESC'
                                                        );

                                                        $crs_list = $db->select('courses',$data);

                                                        foreach($crs_list as $crs){
                                                            ?>
                                                                <tr>
                                                                    <td><?=$crs->crs_customID?></td>
                                                                    <td><?=$crs->crs_title?></td>
                                                                    <td>
                                                                        <?php
                                                                            $mentorData = array(
                                                                                'where' => array(
                                                                                    'mentor_id' => $crs->mentor_FK
                                                                                ),
                                                                                'return_type' => 'single'
                                                                            );
                                                                            $mentorInfo = $db->select('mentors',$mentorData);

                                                                            $userData = array(
                                                                                'where' => array(
                                                                                    'id' => $mentorInfo->user_FK
                                                                                ),
                                                                                'return_type' => 'single'
                                                                            );

                                                                            $user = $db->select('users',$userData);

                                                                            echo $user->name;
                                                                        ?>
                                                                    </td>
                                                                    <td><span class="tag tag-success"><?=str_replace($engDATE, $bangDATE, $crs->duration)?></span></td>
                                                                    <td>
                                                                        <?php
                                                                            $startTime = explode(' ',str_replace($engDATE, $bangDATE, date("h:i A",strtotime($crs->crs_time_start))));
                                                                            $endTime = explode(' ',str_replace($engDATE, $bangDATE, date("h:i A",strtotime($crs->crs_time_end))));
                                                                            if($startTime[1] == "PM" && $endTime[1] == "PM"){
                                                                                echo "দুপুর " . $startTime[0] . "টা - " . $endTime[0] . " টা";
                                                                            }
                                                                            else if($startTime[1] == "AM" && $endTime[1] == "PM"){
                                                                                echo "সকাল " . $startTime[0] . "টা - দুপুর" . $endTime[0] . " টা";
                                                                            }
                                                                            else if($startTime[1] == "AM" && $endTime[1] == "AM"){
                                                                                echo "সকাল " . $startTime[0] . "টা - " . $endTime[0] . " টা";
                                                                            }
                                                                        ?> 
                                                                        (
                                                                            <?php
                                                                                $day_arr = explode(',',$crs->crs_classDay);
                                                                                $cn = 0;
                                                                                $day_str = "";
                                                                                foreach($day_arr as $day){
                                                                                    $add = ( $cn > 0 ) ? ' , ' : '';  
                                                                                    if($day == 1){
                                                                                        $day_str .=  $add .substr($bangDATE[count($bangDATE)-7] , 0 , 9);
                                                                                    }  
                                                                                    else if($day == 2){
                                                                                        $day_str .= $add . substr($bangDATE[count($bangDATE)-6] , 0 , 9);
                                                                                    } 
                                                                                    else if($day == 3){
                                                                                        $day_str .= $add . substr($bangDATE[count($bangDATE)-5] , 0 , 9);
                                                                                    }
                                                                                    else if($day == 4){
                                                                                        $day_str .= $add . substr($bangDATE[count($bangDATE)-4] , 0 , 15);
                                                                                    }
                                                                                    else if($day == 5){
                                                                                        $day_str .= $add . substr($bangDATE[count($bangDATE)-3] , 0 , 23) ;
                                                                                    }
                                                                                    else if($day == 6){
                                                                                        $day_str .= $add . substr($bangDATE[count($bangDATE)-2] , 0 , 24);
                                                                                    }
                                                                                    else if($day  == 7){
                                                                                        $day_str .= $add . substr(end($bangDATE) , 0 , 15);
                                                                                    }
                                                                                    $cn++;
                                                                                }
                                                                                echo $day_str;
                                                                            ?>
                                                                        )
                                                                    </td>
                                                                    <td><?=str_replace($engDATE, $bangDATE,$crs->crs_fee) . " টাকা"?></td>
                                                                    <td><?=str_replace($engDATE, $bangDATE, date("d F, Y",strtotime($crs->cls_startDate)))?></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($crs->crs_onOff == 0){
                                                                                ?>
                                                                                    <span class="badge badge-success">Offline</span>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                    <span class="badge badge-info">Online</span>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-outline-secondary btn-sm" href="courses.php?action=View&view_id=<?=$crs->crs_id?>">
                                                                            <i class="fas fa-eye">
                                                                            </i>
                                                                        </a>
                                                                        <a class="btn btn-outline-primary btn-sm" href="courses.php?action=Edit&edit_id=<?php echo $crs->crs_id; ?>">
                                                                            <i class="fas fa-pencil-alt">
                                                                            </i>
                                                                        </a>
                                                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteData('courses','<?php echo $crs->crs_id .'_'.$crs->curriculam_id; ?>')">
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
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            <?php
        }
        else if($action == "Add"){
            ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Manage Courses</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">All Courses</li>
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
                                    <div class="card">
                                        <div class="card-header bg-navy color-palette">
                                            <h4 class="card-title font-weight-bold text-center float-none">Add New Course</h4>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive">
                                            <?php
                                                $data_last = array(
                                                    'order_by' => 'crs_id DESC',
                                                    'limit' => array(
                                                        '1' => '1'
                                                    ),
                                                    'return_type' => 'single'
                                                );
                                                $table_last = 'courses';
                                                $crs_last = $db->select($table_last, $data_last);
                                                $customId = explode('-',$crs_last->crs_customID)[1];
                                                $newID    = (int)$customId + 1;
                                                $new_customID = "SSB-" . $newID;
                                            ?>
                                            <form role="form" action="controllers/CourseController.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Course ID</label>
                                                            <input type="text" class="form-control " disabled name="" value="<?=$new_customID?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Title</label>
                                                            <input type="text" class="form-control" name="crs_title" placeholder="Enter Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Course FEE</label>
                                                            <input type="text" class="form-control" name="crs_fee" placeholder="Enter FEE">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Class Time (Start)</label>
                                                            <input type="text" class="form-control" id="time_start" name="crs_time_start" placeholder="Enter Class Start Time">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Class Time (End)</label>
                                                            <input type="text" class="form-control" id="time_end" name="crs_time_end" placeholder="Enter Class End Time">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Status</label>
                                                            <select name="crs_status" id="select2stat" class="form-control">
                                                                <option value="">Please Select Status</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Class Day</label>
                                                            <select name="crs_classDay" id="select2ClassDay" class="form-control" multiple>
                                                                <option value="">Please Select Day</option>
                                                                <option value="1">Saturday</option>
                                                                <option value="2">Sunday</option>
                                                                <option value="3">Monday</option>
                                                                <option value="4">Tuesday</option>
                                                                <option value="5">Wednesday</option>
                                                                <option value="6">Thursday</option>
                                                                <option value="7">Friday</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Course Start Date</label>
                                                            <input type="date" class="form-control" name="cls_startDate" placeholder="Password">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Duration</label>
                                                            <select name="duration" id="select2dur" class="form-control">
                                                                <option value="">Please Select Duration</option>
                                                                <option value="1">1 Month</option>
                                                                <option value="2">2 Month</option>
                                                                <option value="3">3 Month</option>
                                                                <option value="4">4 Month</option>
                                                                <option value="5">5 Month</option>
                                                                <option value="6">6 Month</option>
                                                                <option value="7">7 Month</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Assign Mentor</label>
                                                            <select name="mentor_FK" id="select2mentor" class="form-control">
                                                                <option value="">Please Select Mentor</option>
                                                                <?php
                                                                    $data_m = array(
                                                                        'order_by' => 'mentor_id DESC'
                                                                    ); 
                                                                    $mentor_list = $db->select('mentors',$data_m);
                                                                    
                                                                    foreach($mentor_list as $mentor){
                                                                        $data_user = array(
                                                                            'where' => array(
                                                                                'id' => $mentor->user_FK
                                                                            ),
                                                                            'return_type' => 'single'
                                                                        );
                                                                        $user = $db->select('users',$data_user);
                                                                        ?>
                                                                            <option value="<?=$mentor->mentor_id?>"><?=$user->name?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Student Capacity</label>
                                                            <select name="student_capacity" id="select2cap" class="form-control">
                                                                <option value="">Please Select Capacity</option>
                                                                <option value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="30">30</option>
                                                                <option value="40">40</option>
                                                                <option value="50">50</option>
                                                                <option value="60">60</option>
                                                                <option value="70">70</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Class Hour (Offline / Online)</label>
                                                            <select name="crs_onOff" id="select2hour" class="form-control">
                                                                <option value="">Please Select Status</option>
                                                                <option value="0">Offline</option>
                                                                <option value="1">Online</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Course Description</label>
                                                        <textarea class="textarea" name="crs_desc" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;"></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="" class="d-block">Add Mew Curriculum</label>
                                                            <button type="button" class="btn btn-outline-secondary" id="addnewSession"> <i class="fas fa-plus pr-2"></i>Add New Curriculum Session</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row field_area" id="field_area">
                                                            
                                                        </div>
                                                        <div class="row text_area" id="text_area">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 m-auto">
                                                        <div class="form-group">
                                                            <input type="hidden" name="action" value="add">
                                                            <input type="hidden" name="crs_customID" value="<?=$new_customID?>">
                                                            <button type="submit" id="add_course" class="btn btn-info form-control" name="addCourse">ADD COURSE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            <?php
        }
        else if($action == "Edit"){
            $edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : "";
            if( !empty( $edit_id )){
                ?>
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h1 class="m-0 text-dark">Manage Courses</h1>
                                    </div><!-- /.col -->
                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">All Courses</li>
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
                                        <div class="card">
                                            <div class="card-header bg-navy color-palette">
                                                <h4 class="card-title font-weight-bold text-center float-none">Edit Course</h4>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <?php
                                                    $data_crList = array(
                                                        'where' => array(
                                                            'crs_id' => $edit_id
                                                        ),
                                                        'return_type' => 'single'
                                                    );
                                                    $table_last = 'courses';
                                                    $cur_edit = $db->select($table_last, $data_crList);
                                                ?>
                                                <form role="form" action="controllers/CourseController.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Course ID</label>
                                                                <input type="text" class="form-control " disabled name="" value="<?=$cur_edit->crs_customID?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Title</label>
                                                                <input type="text" class="form-control" name="crs_title" placeholder="Enter Title" value="<?=$cur_edit->crs_title?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Course FEE</label>
                                                                <input type="text" class="form-control" name="crs_fee" placeholder="Enter FEE" value="<?=$cur_edit->crs_fee?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Class Time (Start)</label>
                                                                <input type="text" class="form-control" id="time_start" name="crs_time_start" placeholder="Enter Class Start Time" value="<?=date("h:i A", strtotime($cur_edit->crs_time_start))?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Class Time (End)</label>
                                                                <input type="text" class="form-control" id="time_end" name="crs_time_end" placeholder="Enter Class End Time" value="<?=date("h:i A", strtotime($cur_edit->crs_time_end))?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Status</label>
                                                                <select name="crs_status" id="select2stat" class="form-control" >
                                                                    <option value="">Please Select Status</option>
                                                                    <option value="1" <?php if($cur_edit->crs_status == 1){echo "selected";}?> >Active</option>
                                                                    <option value="0" <?php if($cur_edit->crs_status == 0){echo "selected";}?>>Inactive</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Set Curriculam</label>
                                                                <select name="curriculam_id" id="select2curId" class="form-control">
                                                                    <option value="">Please Select Status</option>
                                                                    <?php
                                                                        $data_cur = array(
                                                                            'order_by' => 'cur_id DESC',
                                                                            'return_type' => 'all'
                                                                        );
                                                                        $data_colName = array(
                                                                            'where' => array(
                                                                                'table_name' => 'curriculams'
                                                                            )
                                                                        );
                                                                        $cur_list = $db->select('curriculams',$data_cur);
                                                                        $col_list = $db->select('information_schema.columns',$data_colName);
                                                                        foreach($cur_list as $cur){
                                                                            $cur_sessions = '';
                                                                            $cr_cn = 0;
                                                                            foreach($col_list as $col){
                                                                                if(strpos($col->COLUMN_NAME, 'title') !== false){
                                                                                    $add = ( $cr_cn > 0 && !empty( $cur[$col->COLUMN_NAME] )) ? ' , ' : '';
                                                                                    $cur_sessions .=  $add . $cur[$col->COLUMN_NAME] ;
                                                                                    $cr_cn++;
                                                                                }
                                                                            }
                                                                            ?>
                                                                                <option value="<?=$cur['cur_id']?>" <?php if($cur_edit->curriculam_id == $cur['cur_id']){echo "selected";}?>  ><?=$cur_sessions?></option>
                                                                            <?php
                                                                            
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Class Day</label>
                                                                <select name="crs_classDay" id="select2ClassDay" class="form-control" multiple>
                                                                    <option value="">Please Select Day</option>
                                                                    <option value="1" <?php if($cur_edit->crs_classDay == 1){echo "selected";}?> >Saturday</option>
                                                                    <option value="2" <?php if($cur_edit->crs_classDay == 2){echo "selected";}?> >Sunday</option>
                                                                    <option value="3" <?php if($cur_edit->crs_classDay == 3){echo "selected";}?> >Monday</option>
                                                                    <option value="4" <?php if($cur_edit->crs_classDay == 4){echo "selected";}?> >Tuesday</option>
                                                                    <option value="5" <?php if($cur_edit->crs_classDay == 5){echo "selected";}?> >Wednesday</option>
                                                                    <option value="6" <?php if($cur_edit->crs_classDay == 6){echo "selected";}?> >Thursday</option>
                                                                    <option value="7" <?php if($cur_edit->crs_classDay == 7){echo "selected";}?> >Friday</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Course Start Date</label>
                                                                <input type="date" class="form-control" name="cls_startDate" placeholder="Password" value="<?=$cur_edit->cls_startDate?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Duration</label>
                                                                <select name="duration" id="select2dur" class="form-control">
                                                                    <option value="">Please Select Duration</option>
                                                                    <option value="1" <?php if($cur_edit->duration == 1){echo "selected";}?> >1 Month</option>
                                                                    <option value="2" <?php if($cur_edit->duration == 2){echo "selected";}?> >2 Month</option>
                                                                    <option value="3" <?php if($cur_edit->duration == 3){echo "selected";}?> >3 Month</option>
                                                                    <option value="4" <?php if($cur_edit->duration == 4){echo "selected";}?> >4 Month</option>
                                                                    <option value="5" <?php if($cur_edit->duration == 5){echo "selected";}?> >5 Month</option>
                                                                    <option value="6" <?php if($cur_edit->duration == 6){echo "selected";}?> >6 Month</option>
                                                                    <option value="7" <?php if($cur_edit->duration == 7){echo "selected";}?> >7 Month</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Assign Mentor</label>
                                                                <select name="mentor_FK" id="select2mentor" class="form-control">
                                                                    <option value="">Please Select Mentor</option>
                                                                    <?php
                                                                        $data_m = array(
                                                                            'order_by' => 'mentor_id DESC'
                                                                        ); 
                                                                        $mentor_list = $db->select('mentors',$data_m);
                                                                        
                                                                        foreach($mentor_list as $mentor){
                                                                            $data_user = array(
                                                                                'where' => array(
                                                                                    'id' => $mentor->user_FK
                                                                                ),
                                                                                'return_type' => 'single'
                                                                            );
                                                                            $user = $db->select('users',$data_user);
                                                                            ?>
                                                                                <option value="<?=$mentor->mentor_id?>" <?php if($cur_edit->mentor_FK == $mentor->mentor_id){echo "selected";}?> ><?=$user->name?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Student Capacity</label>
                                                                <select name="student_capacity" id="select2cap" class="form-control">
                                                                    <option value="">Please Select Capacity</option>
                                                                    <option value="10" <?php if($cur_edit->student_capacity == 10){echo "selected";}?> >10</option>
                                                                    <option value="20" <?php if($cur_edit->student_capacity == 20){echo "selected";}?> >20</option>
                                                                    <option value="30" <?php if($cur_edit->student_capacity == 30){echo "selected";}?> >30</option>
                                                                    <option value="40" <?php if($cur_edit->student_capacity == 40){echo "selected";}?> >40</option>
                                                                    <option value="50" <?php if($cur_edit->student_capacity == 50){echo "selected";}?> >50</option>
                                                                    <option value="60" <?php if($cur_edit->student_capacity == 60){echo "selected";}?> >60</option>
                                                                    <option value="70" <?php if($cur_edit->student_capacity == 70){echo "selected";}?> >70</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Class Hour (Offline / Online)</label>
                                                                <select name="crs_onOff" id="select2hour" class="form-control">
                                                                    <option value="">Please Select Status</option>
                                                                    <option value="0" <?php if($cur_edit->crs_onOff == 0){echo "selected";}?> >Offline</option>
                                                                    <option value="1" <?php if($cur_edit->crs_onOff == 1){echo "selected";}?> >Online</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="">Course Description</label>
                                                            <textarea class="textarea" name="crs_desc" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;">
                                                                <?=$cur_edit->crs_desc?>
                                                            </textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="" class="d-block">Add Mew Curriculum</label>
                                                                <button type="button" class="btn btn-outline-secondary" id="addnewSession"> <i class="fas fa-plus pr-2"></i>Add New Curriculum Session</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row field_area" id="field_area">
                                                                
                                                            </div>
                                                            <div class="row text_area" id="text_area">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 m-auto">
                                                            <div class="form-group">
                                                                <input type="hidden" name="action" value="edit">
                                                                <input type="hidden" name="crs_customID" value="<?=$cur_edit->crs_customID?>">
                                                                <input type="hidden" name="crs_id" value="<?=$cur_edit->crs_id?>">
                                                                <button type="submit" id="add_course" class="btn btn-info form-control" name="addCourse">ADD COURSE</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                <?php
            }
        }
        else if($action == "View"){
            if(isset($_GET['view_id'])){
                $view_id = $_GET['view_id'];

                $data = array(
                    'where' => array(
                        'crs_id' => $view_id
                    ),
                    'return_type' => 'single'
                );

                $crs_info = $db->select('courses',$data);

                    ?>
                        <!-- Content Wrapper. Contains page content -->
                        <div class="content-wrapper">
                            <!-- Content Header (Page header) -->
                            <div class="content-header">
                                <div class="container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h1 class="m-0 text-dark">Manage Courses</h1>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active">View Course</li>
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
                                            <div class="card">
                                                <div class="card-header bg-navy color-palette">
                                                    <h4 class="card-title font-weight-bold text-center float-none"><?=$crs_info->crs_title?> ( <span class="badge badge-info"><?=$crs_info->crs_customID?></span> ) </h4>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive p-0">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="m-0 p-3"><?=$crs_info->crs_desc?></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <table class="table table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Course FEE</td>
                                                                            <td><?=str_replace($engDATE, $bangDATE,$crs_info->crs_fee) . " টাকা"?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Class Start Time</td>
                                                                            <td>
                                                                                <?php
                                                                                    $startTime = explode(' ',str_replace($engDATE, $bangDATE, date("h:i A",strtotime($crs_info->crs_time_start))));
                                                                                    if($startTime[1] == "PM" ){
                                                                                        echo "দুপুর " . $startTime[0] . "টা ";
                                                                                    }
                                                                                    else if($startTime[1] == "AM"){
                                                                                        echo "সকাল " . $startTime[0] . "টা";
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Class Start Time</td>
                                                                            <td>
                                                                                <?php
                                                                                    $endTime = explode(' ',str_replace($engDATE, $bangDATE, date("h:i A",strtotime($crs_info->crs_time_end))));
                                                                                    if($endTime[1] == "PM"){
                                                                                        echo "দুপুর " . $endTime[0] . " টা";
                                                                                    }
                                                                                    else if($endTime[1] == "AM"){
                                                                                        echo "সকাল " . $endTime[0] . " টা";
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Class Day</td>
                                                                            <td>
                                                                                <?php
                                                                                    $day_arr = explode(',',$crs_info->crs_classDay);
                                                                                    $cn = 0;
                                                                                    $day_str = "";
                                                                                    foreach($day_arr as $day){
                                                                                        $add = ( $cn > 0 ) ? ' , ' : '';  
                                                                                        if($day == 1){
                                                                                            $day_str .=  $add .substr($bangDATE[count($bangDATE)-7] , 0 , 9);
                                                                                        }  
                                                                                        else if($day == 2){
                                                                                            $day_str .= $add . substr($bangDATE[count($bangDATE)-6] , 0 , 9);
                                                                                        } 
                                                                                        else if($day == 3){
                                                                                            $day_str .= $add . substr($bangDATE[count($bangDATE)-5] , 0 , 9);
                                                                                        }
                                                                                        else if($day == 4){
                                                                                            $day_str .= $add . substr($bangDATE[count($bangDATE)-4] , 0 , 15);
                                                                                        }
                                                                                        else if($day == 5){
                                                                                            $day_str .= $add . substr($bangDATE[count($bangDATE)-3] , 0 , 23) ;
                                                                                        }
                                                                                        else if($day == 6){
                                                                                            $day_str .= $add . substr($bangDATE[count($bangDATE)-2] , 0 , 24);
                                                                                        }
                                                                                        else if($day  == 7){
                                                                                            $day_str .= $add . substr(end($bangDATE) , 0 , 15);
                                                                                        }
                                                                                        $cn++;
                                                                                    }
                                                                                    echo $day_str;
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Duration</td>
                                                                            <td><?=$crs_info->duration?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Class Start Date</td>
                                                                            <td><?=str_replace($engDATE, $bangDATE, date("d F, Y",strtotime($crs_info->cls_startDate)))?></td> 
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <table class="table table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="font-weight-bold" width="35%">Mentor</td>
                                                                            <td>
                                                                                <?php
                                                                                    $data_m = array(
                                                                                        'where' => array(
                                                                                            'mentor_id' => $crs_info->mentor_FK
                                                                                        ),
                                                                                        'return_type' => 'single'
                                                                                    );
                                                                                    $mentor = $db->select('mentors',$data_m);

                                                                                    $data_u = array(
                                                                                        'where' => array(
                                                                                            'id' => $mentor->mentor_id
                                                                                        ),
                                                                                        'return_type' => 'single'
                                                                                    );
                                                                                    $user = $db->select('users',$data_u);

                                                                                    echo $user->name;
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Student Capacity</td>
                                                                            <td><?=$crs_info->student_capacity?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Student Count</td>
                                                                            <td><?=$crs_info->student_count?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Course Time(Online/Offline)</td>
                                                                            <td>
                                                                                <?php 
                                                                                    if($crs_info->crs_onOff == 0){
                                                                                        ?>
                                                                                            <span class="badge badge-success">Offline</span>
                                                                                        <?php
                                                                                    }
                                                                                    else{
                                                                                        ?>
                                                                                            <span class="badge badge-info">Online</span>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="font-weight-bold">Course Completion</td>
                                                                            <td class="d-flex justify-content-between align-items-center">
                                                                                <?php
                                                                                    $duration = str_replace($bangDATE, $engDATE, explode(' ', $crs_info->duration)[0]);
                                                                                    $time_elasped = strtotime(date("y-m-d")) - strtotime($crs_info->cls_startDate);
                                                                                    $month = $time_elasped / (60*60*24*30);
                                                                                    $percentage = number_format(( $month / $duration ) * 100 , 2);
                                                                                ?>
                                                                                <div class="progress progress-xs" style="width: 80%!important;">
                                                                                    <div class="progress-bar progress-bar-danger" style="width: <?=$percentage?>%"></div>
                                                                                </div>
                                                                                <span class="badge bg-warning"><?=$percentage?>%</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <h5 class="font-weight-bold text-center">Curriculam Progress</h5>
                                                                <?php
                                                                    $data_cur = array(
                                                                        'where' => array(
                                                                            'cur_id' => $crs_info->curriculam_id
                                                                        ),
                                                                        'return_type' => 'single'
                                                                    );
                                                                    $cur_info = $db->select('curriculams',$data_cur);
                                                                ?>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width: 10px">SL#</th>
                                                                            <th class="w-25">Task</th>
                                                                            <th>Progress</th>
                                                                            <th style="width: 40px">Label</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $data_col = array(
                                                                                'return_type' => 'count_col'
                                                                            );

                                                                            $count_col = $db->select('curriculams',$data_col);
                                                                            $session_count = ($count_col - 2);
                                                                            $cn = 0;
                                                                            $sl = 1;
                                                                            $session_elapsed = 0;
                                                                            while($cn < $session_count){
                                                                                $cn++;
                                                                                if($cn % 2 == 0){
                                                                                    ?>
                                                                                        <tr class="align-items-center">
                                                                                            <td class="font-weight-bold"><?=$sl?></td>
                                                                                            <td>
                                                                                                <?php
                                                                                                    $col_no = ( $cn % 2 == 0 && $cn > 1 ) ?  $cn : 0;
                                                                                                    $col_data = null;
                                                                                                    if(isset($col_no) && $col_no != 0){
                                                                                                        $col_data = array(
                                                                                                            'return_type' => 'column',
                                                                                                            'col_no' => $col_no
                                                                                                        );
                                                                                                    }
                                                                                                    $col_res = $db->select('curriculams',$col_data);
                                                                                                    echo $col_res;
                                                                                                ?>
                                                                                            </td>
                                                                                            <td style="vertical-align: middle;">
                                                                                                <?php
                                                                                                    $col_no = ( $cn % 2 == 0 && $cn > 1 ) ? 1 + $cn : 0;
                                                                                                    $col_data = null;
                                                                                                    if(isset($col_no) && $col_no != 0){
                                                                                                        $col_data = array(
                                                                                                            'return_type' => 'column',
                                                                                                            'col_no' => $col_no
                                                                                                        );
                                                                                                    }
                                                                                                    $col_res = $db->select('curriculams',$col_data);
                                                                                                    $duration_session = str_replace($bangDATE, $engDATE, explode(' ', $col_res)[0]);
                                                                                                    $time_elasped = strtotime(date("y-m-d")) - strtotime($crs_info->cls_startDate);
                                                                                                    $month = $time_elasped / (60*60*24*30);

                                                                                                    $session_elapsed = ( $cn > 1 ) ? $session_elapsed + $duration_session : 0;
                                                                                                    $prev_total_session = ( $cn > 2 ) ? $session_elapsed - $duration_session : 0;
                                                                                                    $percentage = number_format( ( $month * 100 ),2);
                                                                                                    $prev_percent = ( $percentage > 100 ) ? $percentage - 100 : 0;
                                                                                                    $prev_next    = ( $prev_percent > 100 ) ? $prev_percent - 100 : 0;
                                                                                                    $zero_percent = ( $session_elapsed > $month && $prev_total_session < $month ) ? 0 : 0;
                                                                                                    if(($percentage > 100 && $cn == 2) || ($percentage > 200  && $cn == 4) || ($percentage > 300  && $cn == 6)){
                                                                                                        ?>      
                                                                                                                <div class="progress progress-xs">
                                                                                                                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td><span class="badge bg-info">100%</span></td>
                                                                                                        <?php
                                                                                                    }
                                                                                                    else if($prev_percent < 100 && $cn == 4){
                                                                                                        ?>
                                                                                                                <div class="progress progress-xs">
                                                                                                                    <div class="progress-bar progress-bar-danger" style="width: <?=$prev_percent?>%"></div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td><span class="badge bg-info"><?=$prev_percent?>%</span></td>
                                                                                                        <?php
                                                                                                    }
                                                                                                    else if($prev_next < 100 && $prev_next > 0 && $cn == 6){
                                                                                                        ?>
                                                                                                                <div class="progress progress-xs">
                                                                                                                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td><span class="badge bg-info">100%</span></td>
                                                                                                        <?php
                                                                                                    }
                                                                                                    else{
                                                                                                        ?>
                                                                                                                <div class="progress progress-xs">
                                                                                                                    <div class="progress-bar progress-bar-danger" style="width: <?=$zero_percent?>%"></div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td><span class="badge bg-info"><?=$zero_percent?>%</span></td>
                                                                                                        <?php
                                                                                                    }
                                                                                                ?>
                                                                                                
                                                                                        </tr>
                                                                                    <?php
                                                                                    $sl++;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-12 p-3 text-center">
                                                                <a href="courses.php?action=Manage" class="btn btn-outline-secondary"> <i class="fas fa-arrow-left pr-2"></i> Back</a>
                                                                <a class="btn btn-outline-info" href="courses.php?action=Edit&edit_id=<?php echo $crs_info->crs_id; ?>">
                                                                    <i class="fas fa-pencil-alt pr-2">
                                                                    </i> Edit
                                                                </a>
                                                                <button class="btn btn-outline-danger" onclick="deleteData(<?php echo $crs_info->crs_id; ?>)">
                                                                    <i class="fas fa-trash pr-2">
                                                                    </i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- /.content -->
                        </div>
                        <!-- /.content-wrapper -->
                    <?php
            }
        }
    ?>
    

    <!-- Footer -->
    <?php include "inc/footer.php"; ?>

    <!-- Control Sidebar -->
    <?php include "inc/controlbar.php"; ?>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>