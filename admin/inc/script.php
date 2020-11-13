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
  </script>


  <!-- <script>
    function getSubCategory(){
      var cat_id = document.getElementById(event.target.id).value;
      var xhttp = new XMLHttpRequest();
      xhttp.open('POST', 'controllers/category_controller.php', true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send('cat_id='+ cat_id);
      xhttp.onreadystatechange = function (){
          if(this.readyState == 4 && this.status == 200){
              if(this.responseText != ""){
                  if(this.responseText == "0"){
                    document.getElementById('sub_id').disabled = true;
                    document.getElementById('sub_id').innerHTML = "<option value='0'>Please select the category</option>";
                  }
                  else{
                    document.getElementById('sub_id').disabled = "";
                    document.getElementById('sub_id').innerHTML = this.responseText;
                  }
              }else{
                  document.getElementById('sub_id').innerHTML = "";
                  document.getElementById('sub_id').disabled = true;
              }
          }	
      }
    }
  </script> -->

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

  <!-- <script>
    function updateComment(cmt_id,is_parent){
      var status_up = document.getElementById('status').value;
      var xhttp = new XMLHttpRequest();
      xhttp.open('POST', 'controllers/category_controller.php', true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send('updateID='+cmt_id+"&status_up="+status_up+"&is_parent="+is_parent);
      xhttp.onreadystatechange = function (){
          if(this.readyState == 4 && this.status == 200){
              if(this.responseText != ""){
                Toast.fire({
                  position: 'center-start',
                  icon: 'success',
                  title: 'Comment Status Has been Updated',
                  showConfirmButton: false,
                  timer: 1500
                })
              }else{
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Comment Status Not Updated',
                  showConfirmButton: false,
                  timer: 1500
                })
              }
          }	
      }
    }
  </script> -->

 <!-- <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'center-start',
      showConfirmButton: false,
      timer: 3500
    });

    function deletePost(delete_id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        timer: 4000
      }).then((result) => {
        if (result.isConfirmed) {
          var xhttp = new XMLHttpRequest();
          xhttp.open('POST', 'controllers/post_controller.php', true);
          xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhttp.send('delete_id='+delete_id);
          xhttp.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
              if(this.responseText != ""){
                Toast.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Your Post has been deleted.',
                  showConfirmButton: false,
                  timer: 2500
                })
              }else{
                Swal.fire(
                  'Post Not Deleted!',
                  'Your Post has Not been deleted.',
                  'error'
                )
              }
              setTimeout(loadPage, 2400);
            }	
          }
        }
      })
    }
    function loadPage(){
      window.location = "post.php?do=Manage";
    }
  </script> -->

  <!-- CKEDITOR PLUGIN -->
  <script src="plugins/ckeditor/ckeditor.js"></script>

  <!-- <script>
      CKEDITOR.replace('ckeditor');
  </script> -->


<?php
	ob_end_flush();
?>
</body>
</html>