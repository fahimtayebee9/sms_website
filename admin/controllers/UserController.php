<?php
    include "Database.php";
    session_start();
    $db = new Database();

    if( isset( $_REQUEST['action'] ) && !empty( $_REQUEST['action'] )){
        if($_REQUEST['action'] == "edit"){
            if( isset( $_POST['user_id'])){
                $edit_id = $_POST['user_id'];
                // Preapre the Image
                $imageName    = $_FILES['profile_image']['name'];
                $imageSize    = $_FILES['profile_image']['size'];
                $imageTmp     = $_FILES['profile_image']['tmp_name'];

                $imageAllowedExtension = array("jpg", "jpeg", "png");
                $ext_arr = explode('.', $imageName);
                $imageExtension = strtolower( end( $ext_arr ) );

                $password    = $_POST['password'];
                $repassword  = $_POST['repassword'];

                $formErrors = array();

                if ( strlen($_POST['fullname']) < 3 ){
                    $formErrors[] = 'User name is too short!!!';
                }

                $condition = array(
                    'where' =>array(
                        'id' => $edit_id
                    )
                );
                
                if( empty( $imageName ) && empty( $_POST['password'] )){
                    if( empty( $formErrors ) ){
                        $data = array(
                            'name'      => $_POST['fullname'],
                            'email'     => $_POST['email'],
                            'phone'     => $_POST['phone'],
                            'address'   => $_POST['address'],
                            'status'    => $_SESSION['status'],
                            'role'      => $_SESSION['role']
                        );
    
                        $condition_mentor = array(
                            'where' =>array(
                                'user_FK' => $edit_id
                            )
                        );

                        $table = 'users';
    
                        $addUser = $db->update($table, $data , $condition);
    
                        if ( $addUser ){
                            $_SESSION['message'] = "Information Updated Successfully..";
                            $_SESSION['type']    = "success";
                            header("location: ../profile.php");
                            exit();
                        }
                        else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                        }
                    }
                }
                else if( empty( $imageName ) && !empty( $_POST['password'] ) ){
                    if ( $password != $repassword ){
                        $formErrors[] = 'Password Doesn\'t match!!!';
                    }

                    if( empty( $formErrors ) ){
                        $data = array(
                            'name'      => $_POST['fullname'],
                            'email'     => $_POST['email'],
                            'password'  => sha1($_POST['password']),
                            'phone'     => $_POST['phone'],
                            'address'   => $_POST['address'],
                            'status'    => $_SESSION['status'],
                            'role'      => $_SESSION['role']
                        );
    
                        $addUser = $db->update($table, $data , $condition);
    
                        if ( $addUser ){
                            $_SESSION['message'] = "Information Updated Successfully..";
                            $_SESSION['type']    = "success";
                            header("location: ../profile.php");
                            exit();
                        }
                        else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                        }
                    }

                }
                else if( !empty( $imageName ) && empty( $_POST['password'] ) ){
                    if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                        $formErrors[] = "Not a valid file format";
                    }
                    if ( !empty($imageSize) && $imageSize > 2097152 ){
                        $formErrors[] = "Image size to large";
                    }
                    if( empty( $formErrors ) ){
                        
                        $table = 'users';

                        $user = $db->select($table,$condition);

                        unlink('../img/users/' . $user->image);

                        $image = rand(100000,1000000) . "__" . $imageName;
                        // Upload the Image to its own Folder Location
                        move_uploaded_file($imageTmp, "../img/users/" . $image );

                        $data = array(
                            'name'      => $_POST['fullname'],
                            'email'     => $_POST['email'],
                            'phone'     => $_POST['phone'],
                            'address'   => $_POST['address'],
                            'status'    => $_SESSION['status'],
                            'role'      => $_SESSION['role'],
                            'image'     => $image
                        );

                        $addUser = $db->update($table, $data , $condition);

                        if ( $addUser ){
                            $_SESSION['message'] = "Information Updated Successfully..";
                            $_SESSION['type']    = "success";
                            header("location: ../profile.php");
                            exit();
                        }
                        else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                        }
                    }
                }
                else if( !empty( $imageName ) && !empty( $_POST['password'] ) ){

                    if ( $password != $repassword ){
                        $formErrors[] = 'Password Doesn\'t match!!!';
                    }

                    if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                        $formErrors[] = "Not a valid file format";
                    }
                    if ( !empty($imageSize) && $imageSize > 2097152 ){
                        $formErrors[] = "Image size to large";
                    }
                    if( empty( $formErrors ) ){
                        
                        $table = 'users';

                        $user = $db->select($table,$condition);

                        unlink('../img/users/' . $user->image);

                        $image = rand(100000,1000000) . "__" . $imageName;
                        // Upload the Image to its own Folder Location
                        move_uploaded_file($imageTmp, "../img/users/" . $image );

                        $data = array(
                            'name'      => $_POST['fullname'],
                            'email'     => $_POST['email'],
                            'password'  => sha1($_POST['password']),
                            'phone'     => $_POST['phone'],
                            'address'   => $_POST['address'],
                            'status'    => $_SESSION['status'],
                            'role'      => $_SESSION['role'],
                            'image'     => $image
                        );

                        $addUser = $db->update($table, $data , $condition);

                        if ( $addUser ){
                            $_SESSION['message'] = "Information Updated Successfully..";
                            $_SESSION['type']    = "success";
                            header("location: ../profile.php");
                            exit();
                        }
                        else{
                            die("MySQLi Query Failed." . mysqli_error($db));
                        }
                    }
                }
            }
        }

    }
?>