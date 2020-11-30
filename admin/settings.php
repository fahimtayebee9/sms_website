<?php include "inc/header.php"; ?>

  <!-- Navbar -->
  <?php include "inc/top_nav.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "inc/side_bar.php"; ?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if (isset( $_GET['action'] ) && $_GET['action'] == "Edit"){ 
                            if(!empty( $_GET['edit_id']) && $_GET['edit_id'] != 0){
                                $editID = $_GET['edit_id'];
                                $data_ed = array(
                                    'where' => array(
                                        'web_id' => $editID
                                    ),
                                    'return_type' => 'single'
                                );

                                $editWeb = $db->select('web_info',$data_ed);
                                ?>  
                                    <div class="card card-accent-primary">
                                        <div class="card-header align-items-center card-webinfo d-flex justify-content-between">
                                            <h5>Update Website Settings</h5>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <a href="settings.php" class="btn btn-tool">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Add New Favicon</label>
                                                            <img src="img/website/no-prev.png" id="favicon_view" alt="" width="320px" height="120px" class="text-left d-block">
                                                            <div class="input-group mt-3">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="web_favicon" name="web_favicon"  accept="image/*" onchange="document.getElementById('favicon_view').src = window.URL.createObjectURL(this.files[0]); document.getElementById('choose_file').innerHTML = this.files[0].name;">
                                                                    <label class="custom-file-label" for="exampleInputFile" id="choose_file">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Add New Logo</label>
                                                            <img src="img/website/no-prev.png" id="logo_view" alt="" width="320px" height="120px" class="text-left d-block">
                                                            <div class="input-group mt-3">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="web_logo" name="web_logo"  accept="image/*" onchange="document.getElementById('logo_view').src = window.URL.createObjectURL(this.files[0]); document.getElementById('choose_file').innerHTML = this.files[0].name;">
                                                                    <label class="custom-file-label" for="exampleInputFile" id="choose_file">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Contact Number</label>
                                                            <input type="text" name="contact_no" id="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Address</label>
                                                            <input type="text" name="web_address" id="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Team Member</label>
                                                            <select name="team_member" id="select2team_member" class="form-control" multiple>
                                                                <option value=""></option>
                                                                <?php
                                                                    $data = array(
                                                                        'order_by' => 'id DESC',
                                                                        'where' => array(
                                                                            'role' => 2
                                                                        )
                                                                    );
                                                                    $data_prev = array(
                                                                        'select' => 'team_members'
                                                                    );
                                                                    $member_list = $db->select('users',$data);
                                                                    $prev_member_list = $db->select('web_info',$data_prev);
                                                                    $prev_member = explode(',' , $prev_member_list->team_members);
                                                                    foreach($member_list as $member){
                                                                        ?>
                                                                            <option value="<?=$member->id?>" <?php if(in_array($member->id, $prev_member)){ echo "selected";}?>>
                                                                                <?=$member->name?>
                                                                            </option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Services</label>
                                                            <select name="web_services" id="select2services" class="form-control" multiple>
                                                                <option value=""></option>
                                                                <?php
                                                                    $data = array(
                                                                        'order_by' => 'id DESC',
                                                                        'where' => array(
                                                                            'role' => 2
                                                                        )
                                                                    );
                                                                    $data_prev = array(
                                                                        'select' => 'team_members'
                                                                    );
                                                                    $member_list = $db->select('users',$data);
                                                                    $prev_member_list = $db->select('web_info',$data_prev);
                                                                    $prev_member = explode(',' , $prev_member_list->team_members);
                                                                    foreach($member_list as $member){
                                                                        ?>
                                                                            <option value="<?=$member->id?>" <?php if(in_array($member->id, $prev_member)){ echo "selected";}?>>
                                                                                <?=$member->name?>
                                                                            </option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Website Description</label>
                                                            <textarea class="web_desc" name="web_desc" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                    <div class="card card-accent-primary ">
                        <div class="card-header bg-navy card-webinfo d-flex align-items-center justify-content-between">
                                <h5>Current Website Information</h5>
                                <a href="settings.php?action=Edit&edit_id=<?=$webinfo->web_id?>" class="btn btn-info text-right">Edit</a>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" class="pb-3">
                                                <div class="img-area d-flex justify-content-center m-auto">
                                                    <div class="left pr-5">
                                                        <label for="" class="d-block text-center">Favicon</label>
                                                        <img src="img/website/<?=$webinfo->web_favicon?>" class="d-block" alt="" width="200px" height="120px">
                                                    </div>
                                                    <div class="right pl-5">
                                                        <label for="" class="d-block text-center">Logo</label>
                                                        <img src="img/website/<?=$webinfo->web_logo?>" class="d-block" alt="" width="200px" height="120px">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="12%" class="font-weight-bold">Title</td>
                                            <td class="pr-2 pl-2 font-weight-bold"> : </td>
                                            <td><?=$webinfo->web_title?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Description</td>
                                            <td class="pr-2 pl-2 font-weight-bold"> : </td>
                                            <td><?=$webinfo->web_desc?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Team Members</td>
                                            <td class="pr-2 pl-2 font-weight-bold"> : </td>
                                            <td> 
                                                <?php
                                                    if( !empty( $webinfo->team_members ) ){
                                                        $member_list = explode(',', $webinfo->team_members);
                                                        foreach($member_list as $mem){
                                                            $data_mem = array(
                                                                'where' => array(
                                                                    'id' => $mem
                                                                ),
                                                                'return_type' => 'single'
                                                            );
                                                            $mem_info = $db->select('users',$data_mem);
                                                            ?>
                                                                <label aria-label="<?=$mem_info->name?>" data-microtip-position="top" role="tooltip">
                                                                    <img src="img/users/<?=$mem_info->image?>" alt="" class="option-img">
                                                                </label>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Contact No</td>
                                            <td class="pr-2 pl-2 font-weight-bold"> : </td>
                                            <td><?=$webinfo->contact_no?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Address</td>
                                            <td class="pr-2 pl-2"> : </td>
                                            <td>
                                                <?php 
                                                    $addr = explode(',',$webinfo->web_address);
                                                    $count = 0;
                                                    while($count < sizeof($addr)){
                                                        $add = ( $count == 1 ) ? "<br>" : " ";
                                                        echo $add . $addr[$count];
                                                        $count++;
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Services</td>
                                            <td class="pr-2 pl-2 font-weight-bold"> : </td>
                                            <td>
                                                <?php
                                                    if(!empty($webinfo->web_services)){
                                                        $services_list = explode(',', $webinfo->web_services);
                                                        ?>
                                                            <ul class="list-unstyled">
                                                        <?php
                                                        foreach($services_list as $service){
                                                            ?>
                                                                <li>
                                                                    <i class="far fa-check-square"></i> <?php echo $service;?>
                                                                </li>
                                                            <?php
                                                        }
                                                        ?>
                                                            </ul>
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
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


    <!-- Footer -->
    <?php include "inc/footer.php"; ?>

    <!-- Control Sidebar -->
    <?php include "inc/controlbar.php"; ?>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>