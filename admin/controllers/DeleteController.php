<?php
    include "Database.php";
    session_start();
    $db = new Database();

    if( isset( $_POST['action'] ) && !empty( $_POST['action'] )){
        if($_POST['action'] == "delete"){

            $table      = $_POST['table'];
            $delete_id  = $_POST['delete_id'];

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
            else{
                $_SESSION['message'] = "Record NOT Deleted Successfully..";
                $_SESSION['type']    = "error";
                die("MySQLi Query Failed.   " . mysqli_error($db));
                header("location: ../$table.php?action=Manage");
                echo "Done";
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