<?php
    include "Database.php";
    session_start();
    $db = new Database();

    if( isset( $_REQUEST['action'] ) && !empty( $_REQUEST['action'] )){
        if($_REQUEST['action'] == "add"){
            $password    = $_POST['password'];
            $repassword  = $_POST['repassword'];
            
            // Preapre the Image
            $imageName    = $_FILES['profile_image']['name'];
            $imageSize    = $_FILES['profile_image']['size'];
            $imageTmp     = $_FILES['profile_image']['tmp_name'];
            
            $formErrors = array();

            if ( strlen($_POST['fullname']) < 3 ){
                $formErrors[] = 'User name is too short!!!';
            }
            if ( $password != $repassword ){
                $formErrors[] = 'Password Doesn\'t match!!!';
            }

            $imageAllowedExtension = array("jpg", "jpeg", "png");
            $ext_arr = explode('.', $imageName);
            $imageExtension = strtolower( end( $ext_arr ) );

            if ( !empty($imageName) ){
                if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                    $formErrors[] = "Not a valid file format";
                }
                if ( !empty($imageSize) && $imageSize > 2097152 ){
                    $formErrors[] = "Image size to large";
                }
            }


            if ( empty($formErrors) ){
                if(!empty($imageName)){
                    $image = rand(100000,1000000) . "__" . $imageName;
                    // Upload the Image to its own Folder Location
                    move_uploaded_file($imageTmp, "../img/users/" . $image );

                    $file_data = array(
                        'file_name' => $image,
                        'file_size' => round( ( $imageSize / ( 1024 * 1024 ) ), 3),
                        'file_type' => $imageExtension
                    );

                    $insFile = $db->insert('uploaded_file_info', $file_data);

                    $data = array(
                        'name'      => $_POST['fullname'],
                        'email'     => $_POST['email'],
                        'password'  => sha1($_POST['password']),
                        'phone'     => $_POST['phone'],
                        'address'   => $_POST['address'],
                        'status'    => $_POST['status'],
                        'role'      => $_POST['role'],
                        'image'     => $image,
                        'join_date' => date("y-m-d")
                    );

                    $table = 'users';
                    $addUser = $db->insert($table, $data);

                    if ( $addUser ){
                        
                        $select_data = array(
                            'where' => array(
                                'email'     => $data['email'],
                                'password'  => $data['password']
                            ),
                            'return_type'   => 'single'
                        );

                        $userData = $db->select($table, $select_data);

                        $mentor_data = array(
                            'mentor_dept'       => $_POST['department'],
                            'skills'            => implode(',', $_POST['skills'] ),
                            'portfolio_link'    => $_POST['link'],
                            'mentor_desc'       => $_POST['desc'],
                            'crs_taking'        => implode(',', $_POST['crs_taking'] ),
                            'user_FK'           => $userData->id
                        );

                        $mentor_table = 'mentors';

                        $addMentor = $db->insert($mentor_table, $mentor_data);

                        if($addMentor){
                            $_SESSION['message'] = "New Mentor Add Successfully..";
                            $_SESSION['type']    = "success";
                            header("location: ../mentors.php?action=Manage");
                            exit();
                        }
                    }
                    else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                    }
                }
                else{

                    $data = array(
                        'name'      => $_POST['fullname'],
                        'email'     => $_POST['email'],
                        'password'  => $_POST['password'],
                        'phone'     => $_POST['phone'],
                        'address'   => $_POST['address'],
                        'status'    => $_POST['status'],
                        'role'      => $_POST['role'],
                        'join_date' => date("y-m-d")
                    );

                    $table = 'users';
                    $addUser = $db->insert($table, $data);
                    
                    if ( $addUser ){
                        $select_data = array(
                            'where' => array(
                                'email'     => $data['email'],
                                'password'  => $data['password']
                            ),
                            'return_type'   => 'single'
                        );

                        $userData = $db->select($table, $select_data);

                        $mentor_data = array(
                            'mentor_dept'       => $_POST['department'],
                            'skills'            => implode(',', $_POST['skills'] ),
                            'portfolio_link'    => $_POST['link'],
                            'mentor_desc'       => $_POST['desc'],
                            'user_FK'           => $userData->id
                        );

                        $mentor_table = 'mentors';

                        $addMentor = $db->insert($mentor_table, $mentor_data);

                        if($addMentor){
                            $_SESSION['message'] = "New Mentor Add Successfully..";
                            $_SESSION['type']    = "success";
                            header("location: ../mentors.php?action=Manage");
                            exit();
                        }
                    }
                    else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                    }
                }
            }
            else{
                $_SESSION['message_arr'] = $formErrors;
                $_SESSION['type']    = "error";
                header("location: ../mentors.php?action=Manage");
                exit();
            }
        }

        if($_REQUEST['action'] == "edit"){
            if( isset( $_POST['edit_id'])){
                $edit_id = $_POST['edit_id'];
                // Preapre the Image
                $imageName    = $_FILES['profile_image']['name'];
                $imageSize    = $_FILES['profile_image']['size'];
                $imageTmp     = $_FILES['profile_image']['tmp_name'];

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
                            'status'    => $_POST['status'],
                            'role'      => $_POST['role']
                        );
    
                        $condition_mentor = array(
                            'where' =>array(
                                'user_FK' => $edit_id
                            )
                        );

                        $table = 'users';
    
                        $addUser = $db->update($table, $data , $condition);
    
                        if ( $addUser ){
    
                            $mentor_data = array(
                                'mentor_dept'       => $_POST['department'],
                                'skills'            => implode(',', $_POST['skills'] ),
                                'portfolio_link'    => $_POST['link'],
                                'mentor_desc'       => $_POST['desc'],
                                'crs_taking'        => implode(',', $_POST['crs_taking'] )
                            );
    
                            $mentor_table = 'mentors';
    
                            $addMentor = $db->update($mentor_table, $mentor_data, $condition_mentor);
    
                            if($addMentor){
                                $_SESSION['message'] = "Mentor Updated Successfully..";
                                $_SESSION['type']    = "success";
                                header("location: ../mentors.php?action=Manage");
                                exit();
                            }
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
                            'status'    => $_POST['status'],
                            'role'      => $_POST['role']
                        );
    
                        $condition_mentor = array(
                            'where' =>array(
                                'user_FK' => $edit_id
                            )
                        );
    
                        $addUser = $db->update($table, $data , $condition);
    
                        if ( $addUser ){
    
                            $mentor_data = array(
                                'mentor_dept'       => $_POST['department'],
                                'skills'            => implode(',', $_POST['skills'] ),
                                'portfolio_link'    => $_POST['link'],
                                'mentor_desc'       => $_POST['desc'],
                                'crs_taking'        => implode(',', $_POST['crs_taking'] )
                            );
    
                            $mentor_table = 'mentors';
    
                            $addMentor = $db->update($mentor_table, $mentor_data, $condition_mentor);
    
                            if($addMentor){
                                $_SESSION['message'] = "Mentor Updated Successfully..";
                                $_SESSION['type']    = "success";
                                header("location: ../mentors.php?action=Manage");
                                exit();
                            }
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
                            'status'    => $_POST['status'],
                            'role'      => $_POST['role'],
                            'image'     => $image
                        );

                        $condition_mentor = array(
                            'where' =>array(
                                'user_FK' => $edit_id
                            )
                        );

                        $addUser = $db->update($table, $data , $condition);

                        if ( $addUser ){

                            $mentor_data = array(
                                'mentor_dept'       => $_POST['department'],
                                'skills'            => implode(',', $_POST['skills'] ),
                                'portfolio_link'    => $_POST['link'],
                                'mentor_desc'       => $_POST['desc'],
                                'crs_taking'        => implode(',', $_POST['crs_taking'] )
                            );

                            $mentor_table = 'mentors';

                            $addMentor = $db->update($mentor_table, $mentor_data, $condition_mentor);

                            if($addMentor){
                                $_SESSION['message'] = "Mentor Updated Successfully..";
                                $_SESSION['type']    = "success";
                                header("location: ../mentors.php?action=Manage");
                                exit();
                            }
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