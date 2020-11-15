<?php
  include "inc/db_config.php";
  ob_start();
  
  session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>SMS</b>W</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="index.php?action=SignIn" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="rememberme">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="signin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- sweetalert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
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
</body>
</html>

<?php
  $action = isset($_GET['action']) ? $_GET['action'] : "";
  if($action == "SignIn"){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $email = $_POST['email'];
      $password = sha1($_POST['password']);

      $remember   = $_POST['rememberme'];

      $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
      $result = mysqli_query($db ,$sql);

      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          if(isset($remember)){
            setcookie("email",$email,time() + (86400 * 30), "/");
            setcookie("password",$password,time() + (86400 * 30), "/");
          }
          else{
            if($row['status'] == 0){
              $_SESSION['message'] = "USER NOT AVAILABLE..." ;
              $_SESSION['type'] = "error";
              header("location: my-account.php?action=SignIn");
              exit();
              break;
            }
            else if($row['role'] == 1 && $row['status'] == 1){
              $_SESSION['user_id'] = $row['id'];
              $_SESSION['name'] = $row['name'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['phone'] = $row['phone'];
              $_SESSION['address'] = $row['address'];
              $_SESSION['password'] = $row['password'];
              $_SESSION['image'] = $row['image'];
              $_SESSION['role'] = $row['role'];
              $_SESSION['status'] = $row['status'];
              $_SESSION['join_date'] = $row['join_date'];
              
              $_SESSION['message'] = "LOGIN SUCCESS";
              $_SESSION['type'] = "success";
              header("location: dashboard.php");
              exit();
            }
          }
        }
      }
      else {
        $_SESSION['message'] = "Invalid Username or password..." ;
        $_SESSION['type'] = "error";
        header("location: index.php?error");
        exit();
      }
    }
  }

?>

<?php ob_end_flush();?>