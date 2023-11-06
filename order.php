<?php   
    include 'functions.php';
    session_start();
    if(empty($_SESSION['username'])){
        header("location:login.php?login=false");
    }
    $username = $_SESSION['username'];
    ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Page</title>
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
                    <li class="nav-item">
                        <a class="nav-link rounded" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php if($_SESSION['username'] == 'admin'): ?>
                            <a class="nav-link rounded" href="newMenu.php">New Menu</a>
                        <?php else: ?>
                            <a class="nav-link rounded disabled" href="#">New Menu</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="#" style="background-color: #E1C78F;">Order</a>
                    </li>
                    <li class="nav-item">
                        <?php if($_SESSION['username'] == 'admin'): ?>
                            <a class="nav-link rounded" href="transaction.php">Transaction</a>
                        <?php else: ?>
                        <a class="nav-link rounded disabled" href="#">Transaction</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>

            <a class="nav-link navbar-nav d-flex rounded p-2 mx-3 "
                href="edit.php?username=<?=$_SESSION['username']?>">Profile</a>
            <a class="nav-link navbar-nav d-flex mx-3" href="login.php">Logout</a>

        </div>
    </nav>

    <form action="process.php" method="post">
        <center class="mt-4">
            <h1 style="color: #4d310f !important;">ADD ORDER</h1>
            <div class="card" style="width: 18rem;">
                <div class="card-header" style="">
                    Customer
                </div>
                <div class="card-body bg-warning-subtle">
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer" name="customer">
                    </div>
                </div>
            </div>
        </center>
        <div class="container">
            <div class="row">
                <?php  
                    $query = mysqli_query($conn, "SELECT * FROM cake");
                    while($data = mysqli_fetch_array($query)):
                ?>
                <div class="col-md-3 mt-4 d-flex">
                    <div class="card" style="width: 18rem;">
                        <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..."
                            style="aspect-ratio:1/1;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $data['cake_name']?></h5>
                            <p class="card-text">Rp. <?= number_format($data['price'],2,'.',',')  ?></p>
                            <input type="number" class="form-control" id="amount" name="amount[<?=$data['id_cake']?>]" placeholder="Bread Amount" min="0">
                            <input type="hidden" class="form-control" id="idCake" name="idCake[<?=$data['id_cake']?>]" value="<?=$data['id_cake']?>">
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <center>
            <button class="btn btn-primary my-4" type="submit" name="order">Add Order</button>
        </center>
    </form>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>