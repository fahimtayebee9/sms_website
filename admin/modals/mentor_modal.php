<div id="quickview-wrapper">
    <?php
        $mentorSql = "SELECT * FROM mentors INNER JOIN users ON users.id = mentors.user_FK INNER JOIN departments ON mentors.mentor_dept = departments.dept_id";
        $res_mentor = mysqli_query($db,$mentorSql);
        while($rowMentor = mysqli_fetch_assoc($res_mentor)){
                $mentor_name = $rowMentor['name'];
                $mentor_image = $rowMentor['image'];
                $mentor_status = $rowMentor['status'];
                $mentor_id = $rowMentor['id'];
                $mentor_email = $rowMentor['email'];
                $mentor_phone = $rowMentor['phone'];
                $mentor_address = $rowMentor['address'];
                $mentor_skills = $rowMentor['skills'];
                $mentor_dept   = $rowMentor['mentor_dept'];
                $mentor_desc   = $rowMentor['mentor_desc'];
                $mentor_link   = $rowMentor['portfolio_link'];
                $mentor_role   = $rowMentor['role'];
                $mentor_joinDate = $rowMentor['join_date'];
                $dept_title      = $rowMentor['dept_title'];
            ?>
            
                <!-- Modal -->
                <div class="modal fade" id="productmodal<?=$mentor_id?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg modal__container" role="document">
                        <div class="modal-content" >
                            <div class="modal-header modal__header justify-content-between">
                                <h4 class="m-0">Profile Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center w-25 m-auto pb-3">
                                    <img src="img/users/<?=$mentor_image?>" width="180px" style="border-radius:50%;" alt="product image">
                                </div>

                                <div class="modal-product">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold">Name</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$mentor_name?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Email</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$mentor_email?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Phone</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$mentor_phone?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Address</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$mentor_address?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Department</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$dept_title?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Join Date</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=date("d M, Y", strtotime($mentor_joinDate))?></td>
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
                                                        <td ><?=$mentor_desc?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Skills</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                $skills_list = explode(',',$mentor_skills);
                                                                foreach($skills_list as $skill){
                                                                    $getSkill = "SELECT * FROM skills WHERE sk_id = $skill";
                                                                    $resSk    = mysqli_query($db,$getSkill);
                                                                    while($rowSk = mysqli_fetch_assoc($resSk)){
                                                                        ?>
                                                                            <span class="badge badge-secondary"><?=$rowSk['sk_title']?></span>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Portfolio Link</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><a href="http://<?=$mentor_link?>"><?=$mentor_link?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Role</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                if($mentor_status == 1){
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
                                                                if($mentor_status == 1){
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
                                <a class="btn btn-outline-info" href="mentors.php?action=Edit&edit_id=<?=$mentor_id?>"><i class="fas fa-pencil-alt pr-2"></i> Edit</a>
                                <a class="btn btn-outline-danger" href="mentors.php?action=Edit&edit_id=<?=$mentor_id?>"><i class="fas fa-trash-alt pr-2"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php
        }
    ?>
</div>