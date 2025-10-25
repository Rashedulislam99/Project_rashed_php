<?php session_start();
require_once("configs/db_config.php");


$db=new mysqli("localhost","root","","batch66");
$tx="core_";
//require_once("library/classes/system_log.class.php");

//echo password_hash("admin123",PASSWORD_DEFAULT);

if (isset($_POST["btnSignIn"])) {

  $username = trim($_POST["txtUsername"]);
  $password = trim($_POST["txtPassword"]);

  if ($username != "" && $password != "") {
    header("location:home");
  } else {
    header("location:index.php");
  }
  //echo $username," ",$password;
  //$result=$db->query("select u.id,u.username,r.name from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.username='$username' and u.password='$password'");
  $result = $db->query("select u.id,u.full_name,u.password,u.email,u.photo,u.mobile,u.role_id,r.name role from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.name='$username' and u.inactive=0");


  $user = $result->fetch_object();

  if ($user && password_verify($password, $user->password)) {

    $_SESSION["uid"] = $user->id;
    $_SESSION["uname"] = $user->full_name;
    $_SESSION["uphoto"] = $user->photo;
    $_SESSION["email"] = $user->email;
    $_SESSION["mobile"] = $user->mobile;
    $_SESSION["role_id"] = $user->role_id;
    $_SESSION["urole"] = $user->role;

    header("location:home");
  } else {
    echo "Incorrect username or password";
  }



  //  $now=date("Y-m-d H:i:s");
  //  $log=new System_log("","LOGIN","Successfully logged in user : $uid-$_username",$now);
  //  $log->save();



}

?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<head>
  <title>@@title | Mantis Bootstrap 5 Admin Template</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template &amp; use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="assets/css/style-preset.css">
</head>

<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <form class="auth-form" method="post" action="#">
        <div class="auth-header">
          <a href="#"><img src="assets/images/logo-dark.svg" alt="img"></a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="#" class="link-primary">Don't have an account?</a>
            </div>
            <div class="form-group mb-3">
              <label class="form-label" for="txtUsername">UserName</label>
              <input name="txtUsername" type="text" class="form-control" placeholder="Email Address">
            </div>
            <div class="form-group mb-3">
              <label class="form-label" for="txtPassword">Password</label>
              <input name="txtPassword" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="d-flex mt-1 justify-content-between">
              <div class="form-check">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
              </div>
              <h5 class="text-secondary f-w-400">Forgot Password?</h5>
            </div>
            <div class="form-group mb-3">
              <input name="btnSignIn" type="submit" class="form-control btn btn-primary" value="Login">
            </div>
            <!-- <div class="d-grid mt-4">
              <button name="btnSignIn" type="button" class="btn btn-primary">Login</button>
            </div> -->
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="assets/js/plugins/popper.min.js"></script>
  <script src="assets/js/plugins/simplebar.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/fonts/custom-font.js"></script>
  <script src="assets/js/pcoded.js"></script>
  <script src="assets/js/plugins/feather.min.js"></script>



</body>
<!-- [Body] end -->

</html>