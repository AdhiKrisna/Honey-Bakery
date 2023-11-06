<?php   
    include 'functions.php';
    session_start();
    if(empty($_SESSION['username'])){
        header("location:login.php?login=false");
    }
    if($_SESSION['username'] != 'admin'){
        header("location:login.php?login=user");
    }
    $username = $_SESSION['username'];
    ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction Page</title>
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
                        <a class="nav-link rounded" href="newMenu.php">New Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="transaction.php"
                            style="background-color: #E1C78F;">Transaction</a>
                    </li>

                </ul>
            </div>

            <a class="nav-link navbar-nav d-flex rounded p-2 mx-3 "
                href="edit.php?username=<?=$_SESSION['username']?>">Profile</a>
            <a class="nav-link navbar-nav d-flex mx-3" href="login.php">Logout</a>

        </div>
    </nav>


    <?php if(!isset($_GET['transID'])) : ?>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-8">
                <center class="mt-4">
                    <h1 style="color: #4d310f !important;">ORDER HONEY BAKERY</h1>
                </center>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Bread(s)</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                            <!-- <th colspan="2" scope="col">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = mysqli_query($conn ,"SELECT * FROM transaction");
                            while($data= mysqli_fetch_array($query)) :
                        ?>
                        <tr>
                            <td><?= $data['transaction_id'] ?></td>
                            <td><?= $data['customer'] ?></td>
                            <td><?= $data['amount_bread'] ?></td>
                            <td><?= $data['total'] ?></td>
                            <td>
                                <a href="transaction.php?transID=<?=$data['transaction_id']?>"
                                    style="text-decoration:none">
                                    <div class="btn btn-primary">Detail</div>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <?php else :
         $transID = $_GET['transID'];
         $query = mysqli_query($conn ,"SELECT * FROM transaction WHERE transaction_id = $transID");
        $data= mysqli_fetch_array($query); 
     ?>
    <center class="mt-4">
        <h1 style="color: #4d310f !important;">DETAIL ORDER</h1>
        <h3 style="color: #4d310f !important;"><?= $data['customer'] ?></h3>
    </center>

    <div class="container">
        <div class="row">
            <?php
                $query = mysqli_query($conn ,"SELECT image, cake_name, d.quantity as amount, (price * d.quantity) as total FROM cake c INNER JOIN detail d INNER JOIN transaction t ON c.id_cake = d.cake_id AND d.transaction_id = t.transaction_id WHERE t.transaction_id = $transID;");
                while($data= mysqli_fetch_array($query)):
            ?>
            <div class="col-md-3 mt-4 d-flex">
                <div class="card" style="width: 18rem;">
                    <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..." style="aspect-ratio:1/1;">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $data['cake_name']?></h5>
                        <p class="card-text">Amount :  <?= $data['amount']   ?></p>    
                        <p class="card-text">Rp. <?= number_format($data['total'],2,'.',',')  ?></p>    
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>