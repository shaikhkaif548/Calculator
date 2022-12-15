<?php

include_once "database.php";

class authentication extends database{

    public function Login()
    {

        if (isset($_POST['login']))
        {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $pass_error = "Invalid email format";
            }

            $select_user_query = $this->findByEmail($email);

            while ($row = mysqli_fetch_array($select_user_query))
            {
                $id = $row['id'];
                $first_name = $row['firstname'];
                $last_name = $row['lastname'];
                $dob = $row['dob'];

                $db_email = $row['email'];
                $db_password = $row['password_hash'];

                if (password_verify($password, $db_password))
                {

                    $_SESSION['userloggedin'] = true;
                    $_SESSION['id'] = $id;
                    $_SESSION['firstname'] = $first_name;
                    $_SESSION['lastname'] = $last_name;
                    $_SESSION['dob'] = $dob;
                    header("Location: index.php");
                    exit();
                } else
                {

                    $pass_error = "<center>Password is invalid.</center>";
                }
            }
        }
    }

}

class authenticationRegister extends database{

    public function register()
    {

        if(isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = date('Y-m-d', strtotime($_POST['dob']));
    $email = $_POST['email'];
    $password_hash = $_POST['password_hash'];
    $confirm_password = $_POST['confirm_password'];
    
    $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
  ;

     if ($_POST["password_hash"] !== $_POST["confirm_password"]) {
            $message ="password doest match!";
         } else  {
            $select_useremail_query = $this->insertDataUsers($firstname,$lastname,$dob,$email,$password_hash);;
         } 
         
        }
    }

}

class profile extends database {
    
    public function profileUpdate() {
    
        

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



        
    }
    
}





