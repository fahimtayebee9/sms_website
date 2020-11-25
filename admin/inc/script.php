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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>

<!-- sweetalert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>


  <script>

    // MENTOR ADD DEPT
    $(function () {
      $('#select2dept').select2()

      //Initialize Select2 Elements
      $('#select2dept').select2({
        theme: 'bootstrap4',
        placeholder: 'Please Select the Parent Department',
        tags: true,
        allowClear: true,
        closeOnSelect: true
      })
    })

    // MENTOR ADD DEPT
    $(function () {
      $('#select2crs').select2()

      //Initialize Select2 Elements
      $('#select2crs').select2({
        theme: 'bootstrap4',
        placeholder: 'Please Assign the Courses',
        tags: true,
        allowClear: true,
        closeOnSelect: true
      })
    })

    // MENTOR ADD SKILLS
    $(function () {
      $('#select2skills').select2()

      //Initialize Select2 Elements
      $('#select2skills').select2({
        theme: 'bootstrap4',
        placeholder: 'Please Select Skills',
        tags: true,
        allowClear: true,
        closeOnSelect: true
      })
    }) 

    $(function () {
      $('#select2adddept').select2()

      //Initialize Select2 Elements
      $('#select2adddept').select2({
        theme: 'bootstrap4',
        placeholder: 'Please Select Parent Department',
        tags: true,
        allowClear: true,
        closeOnSelect: true
      })
    })
  </script>

    <!-- IMAGE SELECT ACTION -->
  <script>
    function getfileinfo(){
      var file_name = document.getElementById('profile_image').files[0].name;
      var sizeKb = Math.ceil(document.getElementById('profile_image').files[0].size / 1024);
      var sizeMb = document.getElementById('profile_image').files[0].size / (1024 * 1024);
      var file_type = document.getElementById('profile_image').files[0].type;
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
    
    function resetPreview(){
      document.getElementById('preview_block').style.display = "none";
      document.getElementById('file_name').innerHTML = "File Name : ";
      document.getElementById('file_size').innerHTML = "File Size : ";
      document.getElementById('preview_file').src = "";
      document.getElementById('profile_image').value = null;
      document.getElementById('choose_file').innerHTML = "Choose File";

    }

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
      var loc = "controllers/DeleteController.php?action=delete&delete_id=" + delete_id + "&table="+table_name;
      
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
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
    }

    function loadMain(table){
      if(table_name == "mentors"){
        setTimeout(loadPageMentor, 2400);
      }
      else if(table_name == "departments"){
        setTimeout(loadPageDept, 2400);
      }
    } 

    function loadPageMentor(){
      window.location = "mentors.php?action=Manage";
    }
    function loadPageDept(){
      window.location = "departments.php?action=Manage";
    }
  </script>

  <!-- TEXT AREA -->
  <script>
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


  <!-- CKEDITOR PLUGIN -->
  <script src="plugins/ckeditor/ckeditor.js"></script>

<?php
	ob_end_flush();
?>
</body>
</html>