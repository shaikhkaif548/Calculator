<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "navigation.php" ?>
<?php include "includes/functions.php"; ?>



<?php

$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];

if(isset($_POST['update'])){

  $id = $_SESSION['id'];
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];

  $Query = "UPDATE users SET firstname= '$first_name', lastname= '$last_name' WHERE id= {$id}";
  $run = mysqli_query($connection,$Query);
  $updatequery = "<h3 class='text-white text-center mt-4'>profile updated!</h3>"; 

}

?>
<?php


if(isset($_POST['updatepassword'])) {

global $connection;

$id = $_SESSION['id'];

$oldpassword = $_POST['password'];
$np = $_POST['np'];
$confirmpassword = $_POST['c_np'];

if($oldpassword == '' || empty($np) || empty($confirmpassword)) {

  return "All Field is Required";
}

if($np !== $confirmpassword) {

  return "The Confirmation password does not matched";

}


$query = "SELECT * FROM users WHERE id = {$id}";
$pass_update_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($pass_update_query)) {

  $db_password = $row['password_hash'];

  if(password_verify($oldpassword,$db_password)) {

    $another_hash = password_hash($np, PASSWORD_DEFAULT);

    $update_pass_query = "UPDATE users SET password_hash= '$another_hash' WHERE id= {$id}";
    $run_pass_query = mysqli_query($connection,$update_pass_query);

    $pass_change = "<h3 class='text-white text-center mt-4'>Password Change Alhamdulillah xd!</h3>";

  }

}

}



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
          <a class="nav-link" name="logout" aria-current="page" href="calculator.php">Back To Calc</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>


<form action="profile.php" method="post">
<div class="container">
  <div class="card mt-5">
    <div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mt-5 fw-bold text-white">UPDATE USER INFORMATION </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

        <div class="row">
    <div class="col-md-12">
        <i class="bi bi-people"></i>
        <input type="text" class="form-control mb-4" name="firstname" value="<?php if(isset($first_name)) { echo $first_name;} ?>" placeholder="Enter Your Firstname">
        <input type="text" class="form-control" name="lastname" value="<?php if(isset($last_name)) { echo $last_name;} ?>" placeholder="Enter Your Lastname">  
        <?php if(isset($updatequery)) { echo $updatequery; } ?>
                 
        <p class="text-center mt-1 text-danger mt-3"><small></small></p>
    </div>
        </div>
        <div class="row">
    <div class="col-md-12">
    <button type="submit" name="update" value="update" class="btn btn-dark text-center d-grid gap-2 col-6 mx-auto mt-4 mb-2 bg">Update names</button>
    </div>
    </div>
    </form> 


    

 


<!-- FOR PASSOWRDD -->



    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mt-5 fw-bold text-white mb-4">UPDATE PASSWORD</h2>
        </div>
    </div>

    <form action="profile.php" method="post">
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error text-white"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
        <div class="row">
    <div class="col-md-12">
        <i class="bi bi-people"></i>
        <input type="password" class="form-control mb-4" name="password" placeholder="Old Password" >
        <input type="password" class="form-control mb-4" name="np" placeholder="New Password" >
        <input type="password" class="form-control mb-4" name="c_np" placeholder="Confirm New Password" >
        <?php if(isset($pass_change)) { echo $pass_change; } ?>  
                 
        <p class="text-center mt-1 text-danger mt-3"><small></small></p>
    </div>
        </div>
        
        <div class="row">
    <div class="col-md-12">
    <button type="submit" name="updatepassword" class="btn btn-dark text-center d-grid gap-2 col-6 mx-auto mt-4 mb-4 bg">Update Password</button>
    </div>
    </div>
        </div>
        
        
    
    
</div>
    </div>
</div>  

</form> 
    </div>
  </div>












