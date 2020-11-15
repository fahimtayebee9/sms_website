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
                                            <h3 class="card-title">Responsive Hover Table</h3>

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
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Mentor</th>
                                                        <th>Duration</th>
                                                        <th>Class Time (day)</th>
                                                        <th>Class Start Date</th>
                                                        <th>Course Fee</th>
                                                        <th>Class Status (online/offline)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $getCrList = "SELECT * FROM courses INNER JOIN mentors ON courses.mentor_FK = mentors.mentor_id INNER JOIN users ON users.id = mentors.user_FK";
                                                        $resultCrs = mysqli_query($db,$getCrList);
                                                        while($rowCrs = mysqli_fetch_assoc($resultCrs)){
                                                            ?>
                                                                <tr>
                                                                    <td><?=$rowCrs['crs_customID']?></td>
                                                                    <td><?=$rowCrs['crs_title']?></td>
                                                                    <td><?=$rowCrs['name']?></td>
                                                                    <td><span class="tag tag-success"><?=$rowCrs['duration']?></span></td>
                                                                    <td>
                                                                        <?php
                                                                            $startTime = explode(' ',str_replace($engDATE, $bangDATE, date("h:i A",strtotime($rowCrs['crs_time_start']))));
                                                                            $endTime = explode(' ',str_replace($engDATE, $bangDATE, date("h:i A",strtotime($rowCrs['crs_time_end']))));
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
                                                                                if($rowCrs['crs_classDay'] == 1){
                                                                                    echo substr($bangDATE[count($bangDATE)-7] , 0 , 9);
                                                                                }  
                                                                                else if($rowCrs['crs_classDay'] == 2){
                                                                                    echo substr($bangDATE[count($bangDATE)-6] , 0 , 9);
                                                                                } 
                                                                                else if($rowCrs['crs_classDay'] == 3){
                                                                                    echo substr($bangDATE[count($bangDATE)-5] , 0 , 9);
                                                                                }
                                                                                else if($rowCrs['crs_classDay'] == 4){
                                                                                    echo substr($bangDATE[count($bangDATE)-4] , 0 , 15);
                                                                                }
                                                                                else if($rowCrs['crs_classDay'] == 5){
                                                                                    echo substr($bangDATE[count($bangDATE)-3] , 0 , 23);
                                                                                }
                                                                                else if($rowCrs['crs_classDay'] == 6){
                                                                                    echo substr($bangDATE[count($bangDATE)-2] , 0 , 24);
                                                                                }
                                                                                else if($rowCrs['crs_classDay'] == 7){
                                                                                    echo substr(end($bangDATE) , 0 , 15);
                                                                                }
                                                                            ?>
                                                                        )
                                                                    </td>
                                                                    <td><?=str_replace($engDATE, $bangDATE,$rowCrs['crs_fee']) . " টাকা"?></td>
                                                                    <td><?=str_replace($engDATE, $bangDATE, date("d F, Y",strtotime($rowCrs['cls_startDate'])))?></td>
                                                                    <td>
                                                                        <?php 
                                                                            if($rowCrs['crs_onOff'] == 0){
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
                                    <li class="breadcrumb-item active">Add New Course</li>
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
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            <?php
        }
        else if($action == "View"){

        }
        else if($action == "Insert"){

        }
        else if($action == "Update"){

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