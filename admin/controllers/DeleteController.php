<?php
    include "Database.php";
    session_start();
    $db = new Database();

    if( isset( $_GET['action'] ) && !empty( $_GET['action'] )){
        if($_GET['action'] == "delete"){

            $table      = $_GET['table'];
            $delete_id  = $_GET['delete_id'];

            $data = array(
                "where" => array(
                    'id' => $delete_id
                ),
                'return_type' => 'single'
            );

            if($table == "mentors" || $table == "students"){
                $tbl_user = 'users';
                $userInfo = $db->select($tbl_user, $data);

                // Remove User Image
                // unlink('img/users/' . $userInfo->image);

                $file_data = array(
                    'file_name' => $userInfo->image
                );

                $delFileMeta = $db->delete('uploaded_file_info',$file_data);
                
                $data_new = array(
                    'user_FK' => $userInfo->id
                );

                $userByTypeDel = $db->delete($table, $data_new);

                if($userByTypeDel){
                    $del_data = array(
                        'id' => $delete_id
                    );
                    $userDel = $db->delete($tbl_user, $del_data);
                    if($userDel){
                        $_SESSION['message'] = "Record Deleted Successfully..";
                        $_SESSION['type']    = "success";
                        header("location: ../$table.php?action=Manage");
                        exit();
                    }
                    else{
                        $_SESSION['message'] = "Record NOT Deleted Successfully..";
                        $_SESSION['type']    = "error";
                        die("MySQLi Query Failed.   " . mysqli_error($db));
                        header("location: ../$table.php?action=Manage");
                        exit();
                    }
                }
            }
            else if($table == 'departments'){
                $del_data = array(
                    'dept_id' => $delete_id
                );
                $userDel = $db->delete($table, $del_data);
                if($userDel){
                    $_SESSION['message'] = "Record Deleted Successfully..";
                    $_SESSION['type']    = "success";
                    header("location: ../$table.php?action=Manage");
                    echo "Done";
                    exit();
                }
                else{
                    $_SESSION['message'] = "Record NOT Deleted Successfully..";
                    $_SESSION['type']    = "error";
                    die("MySQLi Query Failed.   " . mysqli_error($db));
                    header("location: ../$table.php?action=Manage");
                    exit();
                }
            }
            else{
                $_SESSION['message'] = "Record NOT Deleted Successfully..";
                $_SESSION['type']    = "error";
                die("MySQLi Query Failed.   " . mysqli_error($db));
                header("location: ../$table.php?action=Manage");
                echo "";
                exit();
            }
        }
        else{
            $_SESSION['message'] = "Record NOT Deleted Successfully..";
            $_SESSION['type']    = "error";
            die("MySQLi Query Failed.   " . mysqli_error($db));
            echo "";
            exit();
        }
    }
?>