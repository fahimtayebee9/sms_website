<?php
    include "Database.php";
    session_start();
    $db = new Database();
    $table = 'departments';

    if( isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
        global $table;
        if($_REQUEST['action'] == "add"){
            $data = array(
                'dept_title'  => $_POST['name'],
                'dept_desc'   => $_POST['desc'],
                'sub_dept'    => $_POST['sub_Dept'],
                'dept_status' => $_POST['status']
            );
            
            $AddSuccess = $db->insert($table, $data);

            if ( $AddSuccess ){
                $_SESSION['message'] = "Department Added Successfully";
                $_SESSION['type']    = "success";
                header("Location: ../departments.php");
                exit();
            }
            else{
                die("MySQL Connection Faild." . mysqli_error($db));
            }
        }

        if($_REQUEST['action'] == "edit"){
            $data = array(
                'dept_title'  => $_POST['name'],
                'dept_desc'   => $_POST['desc'],
                'sub_dept'    => $_POST['sub_Dept'],
                'dept_status' => $_POST['status']
            );

            $condition = array(
                'where' => array(
                    'dept_id' => $_POST['updateID']
                )
            );
            
            $AddSuccess = $db->update($table, $data,$condition);

            if ( $AddSuccess ){
                $_SESSION['message'] = "Department Updated Successfully";
                $_SESSION['type']    = "success";
                header("Location: ../departments.php");
                exit();
            }
            else{
                die("MySQL Connection Faild." . mysqli_error($db));
            }
        }
    }
?>