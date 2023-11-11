<!doctype html>
<html lang="en">

<head>
    <link rel='stylesheet' href='css/style.css'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel='stylesheet' href='css/style.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-warning-subtle">
        <div class="container-fluid p-1 mx-4">
            <div class="navbar-brand d-flex ">
                <a class="mx-3"><img src="img/logo.png" alt="" style="width:30px;"></a>
                <a class="nav-link active navbar-brand" href="#">Honey Bakery</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php if(empty($_SESSION['username'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded disabled" href="#">New Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded disabled" href="#">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded disabled" href="#">Transaction</a>
                    </li>

                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="newMenu.php">New Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="transaction.php">Transaction</a>
                    </li>
                    <?php endif ; ?>
                </ul>
            </div>

            <?php if(empty($_SESSION['username'])) : ?>
            <a class="nav-link navbar-nav d-flex mx-3 p-2 rounded" style="background-color: #E1C78F;"
                href="login.php">Login</a>
            <?php else: ?>
            <a class="nav-link navbar-nav d-flex mx-3" href="edit.php?username=<?=$_SESSION['username']?>">Profile</a>
            <a class="nav-link navbar-nav d-flex mx-3" href="logout.php">Logout</a>
            <?php endif ; ?>

        </div>
    </nav>

    <center class="mt-4">
        <h1 style="color: #4d310f !important;">LOGIN PAGE</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <?php 
                    if(isset($_GET['login'])){
                        if($_GET['login'] == "fail")
                            echo "Login Failed. Try Again!";
                        else if($_GET['login'] == 'logout'){
                            session_start();
                            session_destroy();
                            echo "Logout Success!";
                        }
                        else if($_GET['login'] == 'false')
                            echo "Not Login Yet. Login First!";
                        else if($_GET['login'] == 'edit')
                            echo "Profile has been changed. Login again!";
                        else if($_GET['login'] == 'user')
                            echo "You are not admin. Login to admin first!";
                    }
                    else
                        echo "Login Here";
                ?>
            </div>
            <div class="card-body bg-warning-subtle">
                <form action="process.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button class="btn btn-primary" type="submit" name="login">Submit</button>
                </form>
            </div>
        </div>
    </center>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>