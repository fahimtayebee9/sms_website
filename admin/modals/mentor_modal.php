
<div id="quickview-wrapper">
    <?php
        $table = "mentors";
        $data = array(
            'order_by' => 'mentor_id DESC'
        );
        $allusers = $db->select($table,$data);

        
        foreach($allusers as $mentor){
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
            
                <!-- Modal -->
                <div class="modal fade" id="productmodal<?=$userInfo->id?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg modal__container" role="document">
                        <div class="modal-content" >
                            <div class="modal-header modal__header justify-content-between">
                                <h4 class="m-0">Profile Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center w-25 m-auto pb-3">
                                    <img src="img/users/<?=$userInfo->image?>" width="180px" style="border-radius:50%;" alt="product image">
                                </div>

                                <div class="modal-product">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold">Name</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$userInfo->name?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Email</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$userInfo->email?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Phone</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$userInfo->phone?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Address</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$userInfo->address?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Department</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                $table = "departments";
                                                                $data = array(
                                                                    'where' => array(
                                                                        'dept_id' => $mentor->mentor_dept
                                                                    ),
                                                                    'return_type' => 'single'
                                                                );
                                                                
                                                                $deptInfo = $db->select($table,$data);
                                                                echo $deptInfo->dept_title;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Join Date</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=date("d M, Y", strtotime($userInfo->join_date))?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold">Description</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$mentor->mentor_desc?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Skills</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
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
                                                                            <span class="badge badge-secondary"><?=$skillsInfo->sk_title?></span>
                                                                        <?php
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Portfolio Link</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><a href="http://<?=$mentor->portfolio_link?>"><?=$mentor->portfolio_link?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Role</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                if($userInfo->status == 1){
                                                                    ?>
                                                                        <span class="badge badge-info">Mentor</span>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                        <span class="badge badge-danger">Student</span>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Status</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                if($userInfo->status == 1){
                                                                    ?>
                                                                        <span class="badge badge-success">Active</span>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                        <span class="badge badge-danger">Inactive</span>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                            
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <a class="btn btn-outline-info" href="mentors.php?action=Edit&edit_id=<?=$userInfo->id?>"><i class="fas fa-pencil-alt pr-2"></i> Edit</a>
                                <a class="btn btn-outline-danger" href="mentors.php?action=Edit&edit_id=<?=$userInfo->id?>"><i class="fas fa-trash-alt pr-2"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php
        }
    ?>
</div>