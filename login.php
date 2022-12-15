<?php session_start(); ?>
<?php include "navigation.php" ?>
<?php include "authentication.php"; ?>

<?php
$auth_obj = new authentication();
$auth_obj->Login();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span class="text-warning">Calculator.com</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php
                    if (isset($_POST['submit']))
                    {
                        echo $link;
                    }
                    ?>
                </li>
            </ul>

        </div>
    </div>
</nav>


<form action="login.php" method="post">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mt-5">LOGIN HERE</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-user"></span><input type="text" class="form-control mb-4 " name="email" placeholder="Enter Your Email" aria-label="email" aria-describedby="basic-addon1">
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password" aria-label="password" aria-describedby="basic-addon1">
                        <p class="text-center mt-1 text-danger mt-3"><small></small></p>
                        <?php
                        if (isset($_POST['login']))
                        {
                            echo $pass_error;
                        }
                        ?> 
                    </div>
                </div>
                <div class="col-md-4">

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" name="login" class="btn btn-secondary text-center mt-3 d-grid gap-2 col-6 mx-auto mt-2 bg">Login</button>
                        <div class="row">
                            <div class="col-md-12">
                                <a  class="btn btn-dark text-center mt-3 d-grid gap-2 col-6 mx-auto mt-2 bg" href="registration.php">New Registration !</a>

                            </div>
                        </div>
                    </div>


                </div>
            </div><?php unset($_SESSION['firstname']); ?> 
        </div>

</form>

