<?php
    include "Database.php";
    session_start();
    $db = new Database();

    if( isset( $_REQUEST['action'] ) && !empty( $_REQUEST['action'] )){
        if($_REQUEST['action'] == "add"){
            $curriculam_id = 0;
            if( !empty( $_POST['cur_session_title'] ) && !empty( $_POST['cur_session_duration'] ) ){
                $cur_titles = $_POST['cur_session_title'];
                $cur_durations = $_POST['cur_session_duration'];

                $data = array();

                $count_titles    = sizeof($cur_titles);
                $count_durations = sizeof($cur_durations);

                $val = 1;
                while($val <= $count_durations && $val <= $count_titles){
                    $col_name_title = 'cur_session_' . $val . '_title';
                    $col_name_duration = 'cur_session_' . $val . '_duration';
                    $data[$col_name_title] = $cur_titles[$val-1];
                    $data[$col_name_duration] = $cur_durations[$val-1];
                    $val++;
                }

                $col_desc = 'cur_desc';
                $cur_desc = $_POST['cur_desc'];

                $data[$col_desc] = $cur_desc;
                
                $insert_cur = $db->insert('curriculams',$data);

                if($insert_cur){
                    $curriculam_id = $insert_cur;
                }
            }
            
            $crs_data = array(
                'crs_customID'          => $_POST['crs_customID'],
                'crs_title'             => $_POST['crs_title'],
                'crs_desc'              => $_POST['crs_desc'],
                'crs_fee'               => $_POST['crs_fee'],
                'crs_time_start'        => $_POST['crs_time_start'],
                'crs_time_end'          => $_POST['crs_time_end'],
                'crs_classDay'          => implode(',',$_POST['crs_classDay']),
                'cls_startDate'         => $_POST['cls_startDate'],
                'duration'              => $_POST['duration'] . " মাস",
                'curriculam_id'         => $curriculam_id,
                'mentor_FK'             => $_POST['mentor_FK'],
                'student_capacity'      => $_POST['student_capacity'],
                'student_count'         => '0',
                'crs_onOff'             => $_POST['crs_onOff'],
                'crs_status'            => $_POST['crs_status']
            );

            $insert_crs = $db->insert('courses' , $crs_data );

            if($insert_crs){
                $_SESSION['message'] = "New Course Added Successfully..";
                $_SESSION['type']    = "success";
                header("location: ../courses.php?action=Manage");
                exit();
            }
            else{
                $_SESSION['message_arr'] = "Operation Failed..";
                $_SESSION['type']    = "error";
                header("location: ../courses.php?action=Manage");
                exit();
            }
        }
    }

?>