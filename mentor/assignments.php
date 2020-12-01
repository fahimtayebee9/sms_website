<?php include "inc/header.php";?>

<!-- Left Panel -->
<?php include "inc/side_bar.php";?>
<!-- Left Panel -->

<?php $asm_table = 'assignments';?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php include "inc/top_nav.php";?>
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-8 float-right">
            <div class="page-header pp-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                        <li class="active">Courses</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
            <?php
                $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
                if ($action == "Manage") {
                    $data_asm = array(
                        'select' => '*',
                        'order_by' => 'asm_id DESC',
                    );
                    $asm_list = $db->select($asm_table, $data_asm);

                    ?>
                        <div class="card">
                            <div class="card-header bg-dark">
                                <strong class="card-title text-light">All Assignments</strong>
                            </div>
                            <div class="card-body">
                                <div id="bootstrap-data-table-export_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="assignments"
                                                class="table table-striped table-bordered dataTable no-footer" role="grid"
                                                aria-describedby="bootstrap-data-table-export_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1" aria-sort="ascending"
                                                            aria-label="Name: activate to sort column descending" style="width: 5%;">
                                                            Sl#</th>
                                                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Position: activate to sort column ascending"
                                                            style="width: 556px;">Title</th>
                                                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Salary: activate to sort column ascending"
                                                            style="width: 209px;">Publish Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Salary: activate to sort column ascending"
                                                            style="width: 209px;">Submission Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Salary: activate to sort column ascending"
                                                            style="width: 209px;">Batch No</th>
                                                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Salary: activate to sort column ascending"
                                                            style="width: 209px;">Total Submissions</th>
                                                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Salary: activate to sort column ascending"
                                                            style="width: 209px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sl = 0;
                                                        foreach ($asm_list as $asm) {
                                                            $sl++;
                                                            ?>
                                                                <tr>
                                                                    <td><?=$sl?></td>
                                                                    <td><?=$asm->asm_title?></td>
                                                                    <td><?=$asm->asm_publishDate?></td>
                                                                    <td><?=$asm->asm_submissionDate?></td>
                                                                    <td><?=$asm->course_FK?></td>
                                                                    <td><?=$asm->total_submissions?></td>
                                                                    <td>
                                                                        <a class="btn btn-outline-secondary btn-sm" data-toggle="modal" href="#productmodal<?=$asm->asm_id?>">
                                                                            <i class="ti-eye">
                                                                            </i>
                                                                        </a>
                                                                        <a class="btn btn-outline-primary btn-sm" href="mentors.php?action=Edit&edit=<?=$asm->asm_id?>">
                                                                            <i class="ti-pencil-alt">
                                                                            </i>
                                                                        </a>
                                                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteData('assignments', <?=$asm->asm_id?>)">
                                                                            <i class="ti-trash">
                                                                            </i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    <?php
                } else if ($action == "Add") {

                } else if ($action == "Edit") {

                } else if ($action == "View") {

                }
            ?>
    </div> <!-- .content -->
</div>
<!-- /#right-panel -->

<!-- Right Panel -->

<?php include "inc/script.php";?>