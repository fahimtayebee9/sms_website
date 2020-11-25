<?php
    $table = 'departments';
    $data  = array(
        'order_by' => 'dept_id DESC'
    );
    $all_dept = $db->select($table, $data);

    foreach($all_dept as $dept){
        ?>
            <!-- Modal -->
            <div class="modal fade" id="view<?=$dept->dept_id?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal__container" role="document">
                        <div class="modal-content" >
                            <div class="modal-header modal__header justify-content-between">
                                <h4 class="m-0">Department Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-product">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold" width="40%">Department Name</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$dept->dept_title?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Description</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td ><?=$dept->dept_desc?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Parent Department</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                if($dept->sub_dept != 0){
                                                                    $searchData = array(
                                                                        'where' => array(
                                                                        'dept_id' => $dept->sub_dept
                                                                        ),
                                                                        'return_type' => 'single'
                                                                    );
                                                                    $resparent    = $db->select('departments',$searchData);
                                                                    echo $resparent->dept_title;
                                                                }
                                                                else{
                                                                    echo "None";
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Status</td>
                                                        <td class="font-weight-bold pr-1 pl-1"> : </td>
                                                        <td >
                                                            <?php
                                                                if ( $dept->dept_status == 0 ){ ?>
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                <?php }
                                                                else if ( $dept->dept_status == 1 ){ ?>
                                                                    <span class="badge badge-success">Active</span>
                                                                <?php }
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
                                <a class="btn btn-outline-info btn-sm" href="departments.php?edit=<?=$dept->dept_id?>"><i class="fas fa-pencil-alt pr-1"></i> Edit</a>
                                <button class="btn btn-outline-danger btn-sm" onclick="deleteData('departments',<?=$dept->dept_id;?>)">
                                    <i class="fas fa-trash pr-1"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
    }
?>