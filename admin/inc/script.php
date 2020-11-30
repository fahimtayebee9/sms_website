<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- DATATABLES -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- TIME PCIKER PLUGIN -->
<script src="plugins/MDTimePicker/mdtimepicker.min.js"></script>

<!-- sweetalert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- FILE SELECTOR PLUGIN -->
<script src="assets/js/file-select.js"></script> 

<!-- Element ADD PLUGIN -->
<script src="assets/js/course_script.js"></script> 

<!-- CKEDITOR PLUGIN -->
<!-- <script src="plugins/ckeditor/ckeditor.js"></script> -->

  <!-- CONFIGURE TIME PICKER -->
  <script>
    $(document).ready(function(){
      $('#time_start').mdtimepicker(); 
    });
    $('#time_start').mdtimepicker({
      timeFormat: 'hh:mm:ss.000', 
      format: 'hh:mm tt',      
      // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
      theme: 'dark',        
      readOnly: true,       
      hourPadding: false,
      clearBtn: false
    }); 

    $(document).ready(function(){
      $('#time_end').mdtimepicker(); 
    });
    $('#time_end').mdtimepicker({
      timeFormat: 'hh:mm:ss.000', 
      format: 'hh:mm tt',   
      // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
      theme: 'dark',        
      readOnly: true,       
      hourPadding: false,
      clearBtn: false
    }); 

    // $('#time_start').change(function(e){
    //   mdtimepicker('#time_end', 'setMinTime', e.value);
    // }); 
  </script>

  <!-- DATA TABLE INSTALLATION -->
  <script>
    $(document).ready(function() {
        $('#example1').DataTable( {
            order: [[1, 'desc']],
            rowGroup: {
                dataSrc: 1
            }
        } );
    } );
  </script>

  <!-- ALL SELECT2 BOX INITIALIZATIONS -->
  <script src="assets/js/select2-initialization.js">

    
  </script>


    <!-- GET INFO -->
  <script>
    function getinfo(){
      alert(document.getElementById('prev_img').files[0].name);
      var file_name = document.getElementById('prev_img').files[0].name;
      var sizeKb = Math.ceil(document.getElementById('prev_img').files[0].size / 1024);
      var sizeMb = document.getElementById('prev_img').files[0].size / (1024 * 1024);
      var file_type = document.getElementById('prev_img').files[0].type;
      document.getElementById('preview_block').style.display = "block";
      document.getElementById('preview_block').style.maxHeight = "200px";
      document.getElementById('file_name').innerHTML = file_name;
      document.getElementById('file_size').innerHTML = sizeMb.toFixed(3) + " Mb";
      document.getElementById('choose_file').innerHTML = file_name;
      var valid_types = ["jpg", "jpeg", "png", "gif"];
      var type_check = valid_types.includes(file_type.split('/')[1].toLowerCase());

      if(type_check){
        document.getElementById('preview_file').src = window.URL.createObjectURL(document.getElementById('profile_image').files[0]);
        document.getElementById('file_type').innerHTML = file_type.split('/')[1] + "";
        document.getElementById('validate').innerHTML  = "";
      }
      else{
        $("#preview_file").attr("src", "https://webstockreview.net/images/google-docs-icon-png-3.png");
        document.getElementById('file_type').innerHTML = file_type.split('/')[1];
        document.getElementById('validate').innerHTML  = "(not valid file)";
      }
    }
  </script>


    <!-- DELETE DATA ALL -->
  <script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500
      });
    function deleteData(table_name, delete_id){
      if(!delete_id.includes('_')){
        Swal.fire({
          title: 'Do You Want To Delete?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete!'
        }).then((result) => {
          if ( result.dismiss === Swal.DismissReason.cancel ) {
            Swal.fire(
              'Cancelled',
              'Your Record is safe &#128515',
              'error'
            )
          }
          else if (result.isConfirmed === Swal.isConfirmed) {
            var loc_2 = "controllers/DeleteController.php?action=delete&delete_id=" + delete_id + "&table="+table_name;
            window.location = loc_2;
          } 
        })
      }
      else if(delete_id.includes('_')){
        var del_idArr = delete_id.split('_');
        Swal.fire({
          title: 'Do You Want To Delete Both Curriculum And Course?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete Both!'
        }).then((result) => {
          if ( result.dismiss === Swal.DismissReason.cancel ) {
            var loc = "controllers/DeleteController.php?action=delete&delete_id=" + del_idArr[0] + "&table="+table_name;
            window.location = loc;
          }
          else if (result.isConfirmed === Swal.isConfirmed) {
            var loc_2 = "controllers/DeleteController.php?action=delete&delete_id=" + del_idArr[0] + "&table="+table_name+"&del_msg=true&cur_id="+del_idArr[1];
            window.location = loc_2;
          } 
        })
        
      }
    }

  </script>

  <!-- DELETE CURRICULUMS CONFIRMATION -->
  <script>
    <?php
      if(isset( $_SESSION['confirm_del'] )){
        ?>
          var loc = "controllers/DeleteController.php?action=delete&delete_id=" + <?=$_SESSION['cur_delete']?> + "&table=curriculams";
          Swal.fire({
            title: 'Are you sure?',
            text: "<?=$_SESSION['confirm_del']?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if ( result.dismiss === Swal.DismissReason.cancel ) {
              Swal.fire(
                'Cancelled',
                'Your Record is safe &#128515',
                'error'
              )
            }
            else if (result.isConfirmed === Swal.isConfirmed) {
              window.location = loc;
            } 
          })
        <?php
        unset($_SESSION['confirm_del'],$_SESSION['cur_delete'],$_SESSION['type']);
      }
    ?>
  </script>

  <!-- TEXT AREA -->
  <script>
    $(function () {
      $('.textarea').summernote()
    })
    $(function () {
      $('.web_desc').summernote()
    })
    $(function () {
      $('.textarea').summernote()
    })
  </script>

  <!-- FORM VALIDATION MENTOR ADD -->
  <script>
    function validateEmail(){
      if(document.getElementById('email').value.includes('@gmail.com') || document.getElementById('email').value.includes('@yahoo.com')){
        document.getElementById('email').classList.remove('is-invalid');
        document.getElementById('email').classList.add('is-valid');
      }
      else if(!document.getElementById('email').value.includes('@gmail.com') || !document.getElementById('email').value.includes('@yahoo.com')){
        document.getElementById('email').classList.add('is-invalid');
      }
    }
  </script>

  <script>
    // Check 
    var Toast = Swal.mixin({
      toast: true,
      // position: 'top-end',
      showConfirmButton: false,
      timer: 3500
    });

    <?php
      if(isset($_SESSION['img_err'])){
            ?>
              Toast.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?=$_SESSION['img_err']?>',
                showConfirmButton: false,
                timer: 3500
              })
            <?php
        unset($_SESSION['img_err']);
      }

      if(isset($_SESSION['img_name'])){
        ?>
          Toast.fire({
            position: 'top-end',
            icon: 'error',
            title: '<?=$_SESSION['img_name']?>',
            showConfirmButton: false,
            timer: 3500
          })
        <?php
        unset($_SESSION['img_name']);
      }
    ?>
  </script>

    <!-- TAKE ACTION -->
    <script>
      function takeaction(){
        $('.nav-link').classList.add('active');
      }
    </script>

    <!-- TOAST -->
    <script>
        var Toast = Swal.mixin({
          toast: true,
          // position: 'top-end',
          showConfirmButton: false,
          timer: 3500
        });

        <?php
          
          if(isset($_SESSION['message'])){
              if(isset($_SESSION['type'])){
                ?>
                  Toast.fire({
                    position: 'top-end',
                    icon: '<?=$_SESSION['type']?>',
                    title: '<?=$_SESSION['message']?>',
                    showConfirmButton: false,
                    timer: 3500
                  })
                <?php
              }
            unset($_SESSION['message'],$_SESSION['type']);
          }
        ?>
    </script>

  <!-- <script>
    // REMOVING NOTIFICATION COUNT
    function removeCount(){
      var xhttp = new XMLHttpRequest();
      xhttp.open('POST', 'controllers/category_controller.php', true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send('new_count=Found');
      xhttp.onreadystatechange = function (){
          if(this.readyState == 4 && this.status == 200){
              if(this.responseText != ""){
                document.getElementById('new_count').style.display = "none";
              }else{
                document.getElementById('new_count').style.display = "";
              }
          }	
      }
    }
  </script> -->


  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard2.js"></script>

  <?php
    ob_end_flush();
  ?>
</body>
</html>