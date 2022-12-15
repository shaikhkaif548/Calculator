<?php session_start(); ?>
<?php include "navigation.php" ?>
<?php include "includes/functions.php"; ?>
<?php include "authentication.php"; ?>

<?php 

$authR_obj = new authenticationRegister();
$authR_obj->register();

//if(isset($_POST['submit'])) {
//
//    $firstname = $_POST['firstname'];
//    $lastname = $_POST['lastname'];
//    $dob = date('Y-m-d', strtotime($_POST['dob']));
//    $email = $_POST['email'];
//    $password_hash = $_POST['password_hash'];
//    $confirm_password = $_POST['confirm_password'];
//    
//    $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
//  
//    $sql = "SELECT * FROM users WHERE email='$email'";
//    $conn = mysqli_query($connection,$sql);
//    $present = mysqli_num_rows($conn);
//    if($present>0) {
//
//      $_SESSION['email_alert']='1';
//
//    } else {
//
//        insertDataUsers($firstname,$lastname,$dob,$email,$password_hash);
        $message = "<h2 class='text-center text-warning mt-3'>Registration successful!</h2>";
        $link = '<a href="login.php" class="nav-link active">Login here!</a>';
//
//    }
//
//     if ($_POST["password_hash"] !== $_POST["confirm_password"]) {
//            $message ="password doest match!";
//         } else  {
//            insertDataUsers($firstname,$lastname,$dob,$email,$password_hash);
//         } 
//         
//        }
//
//
?>

<?php
//
//$msg ='';
//if(isset($_SESSION['email_alert'])) {
//
//    $msg = "Email id already Exists!!";
//
//}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="login.php"><span class="text-warning">Calculator.com</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <?php if(isset($_POST['submit'])) { echo $link; } ?>
        </li>
      </ul>
    </div>
  </div>

</nav>
<section class="join-us ">
<form action="registration.php" method="post">

<div class="container">
  <div class="card mt-5">
    <div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mt-5 fw-bold text-white">REGISTER HERE!</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

        <div class="row">
    <div class="col-md-12">
        <h2><?php //echo $msg; ?></h2>
        <i class="bi bi-people"></i>
        <input type="text" class="form-control mb-4" name="firstname" placeholder="Enter Your Firstname">
        <input type="text" class="form-control mb-4" name="lastname" placeholder="Enter Your Lastname">
        <input type="date" class="form-control mb-4" name="dob" placeholder="Enter Your DOB" >
        <input type="email" class="form-control mb-4" name="email" placeholder="Enter Your Email">
        <input type="password" class="form-control mb-4" name="password_hash" placeholder="Enter Your Password">
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Your Password">
        <?php if(isset($_POST['submit'])) { echo $message; } ?>  
                 
        <p class="text-center mt-1 text-danger mt-3"><small></small></p>
    </div>
        </div>
        <div class="col-md-4">
            
        </div>
        <div class="row">
    <div class="col-md-12">
    <button type="submit" name="submit" class="btn btn-dark text-center mt-3 d-grid gap-2 col-6 mx-auto mt-4 bg">Submit</button>
    </div>
    </div>
    
    
</div>
    </div>
</div> <?php unset($_SESSION['email_alert']); ?> 

</form> 
    </div>
  </div>


