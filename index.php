<?php session_start(); ?>
<?php include "database.php"; ?>
<?php include "calculation.php"; ?>

<?php
if (!isset($_SESSION['userloggedin']))
{

    header("Location: login.php");
    exit();
}
if (isset($_SESSION['firstname']))
{

    $first_name = $_SESSION['firstname'];
    $last_name = $_SESSION['lastname'];

    date_default_timezone_set('Asia/Kolkata');
    $date = $_SESSION['dob'];

    if (date('m-d', strtotime($date)) == date('m-d'))
    {
        $birthday = "<p>Happy Birthday!</p>\n";
    }

    if (date('m-d', strtotime($date)) !== date('m-d'))
    {
        $birthday = "";
    }
}

$obj = new calculation();

if (isset($_POST['submit']))
{
    $value1 = $_POST['value1'];
    $method = $_POST['method'];
    $value2 = $_POST['value2'];

    $result = $obj->calc($value1, $method, $value2);
    $obj->insertDataNumbers($value1, $method, $value2);
}





if (isset($_GET['process']))
{

    $process = $_GET['process'];
    switch ($process)
    {
        case 'delete':
            $obj->delete($_GET['id']);
            break;

        case 'deleteAll':
            $obj->deleteAll();
            break;
    }
}
?>
<?php include "navigation.php" ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href=""><span class="text-warning">Calculator.com</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" name="logout" aria-current="page" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" name="logout" aria-current="page" href="profile.php">My Profile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<title>Calculator</title>
</head> 
<body>

    <h1 class="text-center mt-4">Welcome To Calculator <i><small class="text-success fw-bold"><?php
                echo $first_name;
                echo "";
                echo $last_name;
                ?></small></i></h1>
        <h1 class="text-center mt-4"><i><small class="text-primary fw-bold"><?php echo $birthday; ?></i></h1></small>


        <div class="container">
            <div class="row mt-5">
                <div class="col-md-2">

                </div>
                <div class="col-md-4">
                    <form action="index.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="value1" placeholder="value1" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="value2" placeholder="value2" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-text" id="basic-addon1"></span>


                            </div>
                        </div>

                        <select class="form-select" name="method" aria-label="Default select example">
                            <option  class="text-center" value="+">+</option>
                            <option  class="text-center" value="-">-</option>
                            <option  class="text-center" value="*">*</option>
                            <option  class="text-center" value="/">/</option>
                        </select>

                        <div class="card mt-3">
                            <div class="card-body bg-dark text-white text-center fw-bold">
                                <?php
                                if (isset($_POST['submit']))
                                {
                                    echo $result;
                                }
                                ?>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-secondary text-center mt-3 d-grid gap-2 col-6 mx-auto mt-2 bg">Calculate</button>

                        <br><br>

                    </form>

                </div>
                <div class="col-md-4 box rounded">
                    <div class="">
                        <table class = "table table-hover">
                            <thead>
                                <tr>
                                    <th>Value1</th>
                                    <th>Method</th>
                                    <th>Value2</th>
                                    <th>Result</th>
                                    <th><a class='btn btn-danger' href='index.php?process=deleteAll'>DELETE ALL</a></th>
                                </tr>
                            </thead>
                            <?php
                            $recive_query = "SELECT * FROM numbers";
                            $select_result = mysqli_query($connection, $recive_query);

                            while ($row = mysqli_fetch_assoc($select_result))
                            {
                                $id = $row['id'];
                                $value1 = $row['value1'];
                                $method = $row['method'];
                                $value2 = $row['value2'];

                                echo "<tr>";

                                $id = $row['id'];
                                echo "<td>{$value1}</td>";
                                echo "<td>{$method}</td>";
                                echo "<td>{$value2}</td>";
//                                    echo "<td> calc($value1,$method,$value2)</td>";

                                echo "<td>" . $obj->calc($value1, $method, $value2) . "</td>";

                                echo "<td><a class='btn btn-success' href='index.php?process=delete&id={$id}'>DELETE</a></td>";

                                echo "<tr>";
                            }
                            ?>
                        </table>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <div id="display" class="p-3 border border-2 border-dark"></div>
                    <div class="buttons">
                        <div class="btn btn-dark button fs-5 fw-bold">1</div>
                        <div class="btn btn-dark button fs-5 fw-bold">2</div>
                        <div class="btn btn-dark button fs-5 fw-bold">3</div>
                        <div class="btn btn-dark button fs-5 fw-bold">+</div>
                        <br><br>
                        <div class="btn btn-dark button fs-5 fw-bold">4</div>
                        <div class="btn btn-dark button fs-5 fw-bold">5</div>
                        <div class="btn btn-dark button fs-5 fw-bold">6</div>
                        <div class="btn btn-dark button fs-5 fw-bold">-</div>
                        <br><br>
                        <div class="btn btn-dark button fs-5 fw-bold">7</div>
                        <div class="btn btn-dark button fs-5 fw-bold">8</div>
                        <div class="btn btn-dark button fs-5 fw-bold">9</div>
                        <div class="btn btn-dark button fs-5 fw-bold">*</div>
                        <br><br>
                        <div class="btn btn-dark button fs-5 fw-bold">C</div>
                        <div class="btn btn-dark button fs-5 fw-bold">/</div>                
                        <div class="btn btn-dark button fs-5 fw-bold">.</div>
                        <div class="btn btn-dark button fs-5 fw-bold">0</div><br><br>
                        <div id="equal" class="btn btn-dark button fs-2 text-center fw-bolder">=</div>
                    </div>
                </div>
            </div>
        </div>


        <script src="calc.js"></script>



        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
</body>
</html>
