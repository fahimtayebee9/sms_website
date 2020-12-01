<?php include "inc/header.php";?>

    <!-- Left Panel -->
    <?php include "inc/side_bar.php";?>
    <!-- /#left-panel -->

    <?php
        $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
            'May','June','July','August','September','October','November','December','Saturday','Sunday',
            'Monday','Tuesday','Wednesday','Thursday','Friday');
        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
            'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
            বুধবার','বৃহস্পতিবার','শুক্রবার' 
        );
    ?>
    
    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include "inc/top_nav.php";?>
        <!-- Header-->

        <?php $crs_table = 'courses';?>

        <div class="breadcrumbs">
            <div class="col-sm-8 float-right">
                <div class="page-header pp-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                            <li class="active">Courses</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
                <?php
                    $data_mentor = array(
                        'where' => array(
                            'user_FK' => $_SESSION['user_id']
                        ),
                        'return_type' => 'single'
                    );
                    $mentor = $db->select('mentors',$data_mentor);

                    $data_crs = array(
                        'where' => array(
                            'mentor_FK' => $mentor->mentor_id
                        ),
                        'order_by' => 'crs_id DESC'
                    );
                    $crs_list = $db->select($crs_table,$data_crs);

                    $data_crs = array(
                        'where' => array(
                            'mentor_FK' => $mentor->mentor_id
                        ),
                        'return_type' => 'count'
                    );
                    $crs_count = $db->select($crs_table,$data_crs);

                    $action = isset($_GET['action']) ? $_GET['action'] : "Manage";

                    if($action == "Manage"){
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">All Assigned Courses <small><span class="badge badge-success float-right mt-1"><?=$crs_count?></span></small></strong>
                                </div>
                                <div class="card-body">
                                    <table id="courses" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="courses_info">
                                        <thead class="thead-dark">
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">SL#</th>
                                                <th class="sorting" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Batch No</th>
                                                <th class="sorting" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-label="Mentor Name: activate to sort column ascending">Course Title</th>
                                                <th class="sorting" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Course Duration</th>
                                                <th class="sorting" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-label="Skills: activate to sort column ascending" width="30%">Progress</th>
                                                <th class="sorting" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" width="5%">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="courses" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $count = 0;
                                                foreach($crs_list as $crs){
                                                    $count++;
                                                    ?>
                                                        <tr>
                                                            <td><?=$count?></td>
                                                            <td><span class="badge badge-info"><?=$crs->crs_customID?></span></td>
                                                            <td><?=$crs->crs_title?></td>
                                                            <td>
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
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $duration = str_replace($bangDATE, $engDATE, explode(' ', $crs->duration)[0]);
                                                                    $time_elasped = strtotime(date("y-m-d")) - strtotime($crs->cls_startDate);
                                                                    $month = $time_elasped / (60*60*24*30);
                                                                    $percentage = number_format(( $month / $duration ) * 100 , 2);
                                                                ?>
                                                                <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?=$percentage?>%" 
                                                                        aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100"><?=$percentage?>%</div>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($percentage == 100){
                                                                        ?>
                                                                            <span class="badge badge-success">Completed</span>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                            <span class="badge badge-warning">Running</span>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="justify-content-center text-center">
                                                                <a class="btn btn-outline-secondary btn-sm" href="courses.php?action=View&view_id=<?=$crs->crs_id?>">
                                                                    <i class="ti-eye"></i>
                                                                </a>
                                                                <a class="btn btn-outline-primary btn-sm" href="courses.php?action=Edit&edit_id=<?php echo $crs->crs_id; ?>">
                                                                    <i class="ti-pencil-alt"></i>
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
                        <?php
                    }
                    else if($action == "View"){
                        if(isset($_GET['view_id'])){
                            $view_id = $_GET['view_id'];
                            $data_cc2 = array(
                                'where' => array(
                                    'crs_id' => $view_id
                                ),
                                'return_type' => 'single'
                            );
                            $crs_info  = $db->select($crs_table, $data_cc2);

                            ?>
                                <div class="card">
                                    <div class="card-header bg-navy color-palette">
                                        <h4 class="card-title font-weight-bold text-center float-none m-0"><?=$crs_info->crs_title?> ( <span class="badge badge-info"><?=$crs_info->crs_customID?></span> ) </h4>
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
                                                                <td class="font-weight-bold" width="30%">Class Start Time</td>
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
                                                                <td class="font-weight-bold">Class End Time</td>
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
                                                                <td class="font-weight-bold" width="35%">Student Capacity</td>
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
                                                                <th class="w-25">Duration</th>
                                                                <th width="48%">Progress</th>
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
                                                                                <td>
                                                                                    <?php
                                                                                        $col_no = ( $cn % 2 == 0 && $cn > 1 ) ?  $cn : 0;
                                                                                        $col_data = null;
                                                                                        if(isset($col_no) && $col_no != 0){
                                                                                            $col_data = array(
                                                                                                'return_type' => 'column',
                                                                                                'col_no' => $col_no+1
                                                                                            );
                                                                                        }
                                                                                        $col_res = $db->select('curriculams',$col_data);
                                                                                        echo $col_res;
                                                                                    ?>
                                                                                </td>
                                                                                <td>
                                                                                    
                                                                                </td>
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
                                                    <a href="assignments.php?action=ViewCourse&view_id=<?=$crs_info->crs_id?>" class="btn btn-outline-info"> <i class="ti-eye pr-2"></i>Assignments</a>
                                                    <a class="btn btn-outline-secondary" href="courses.php">
                                                        <i class="ti-shift-left pr-2">
                                                        </i> Back
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                    else if($action == ""){

                    }
                ?>
            
        </div> <!-- .content -->
    </div>
    <!-- /#right-panel -->

    <!-- Right Panel -->

<?php include "inc/script.php";?>