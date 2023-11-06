<?php  
    include "functions.php";
    // aaaaa
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
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
                <a class="nav-link active navbar-brand" href="index.php">Honey Bakery</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php if(empty($_SESSION['username'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link rounded active" href="index.php" style="background-color: #E1C78F;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded disabled" href="#">New Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded disabled" href="">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded disabled" href="#">Transaction</a>
                    </li>

                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link rounded active" href="index.php" style="background-color: #E1C78F;">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php if($_SESSION['username'] == 'admin'): ?>
                            <a class="nav-link rounded" href="newMenu.php">New Menu</a>
                        <?php else: ?>
                            <a class="nav-link rounded disabled" href="#">New Menu</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <?php if($_SESSION['username'] == 'admin'): ?>
                            <a class="nav-link rounded" href="transaction.php">Transaction</a>
                        <?php else: ?>
                        <a class="nav-link rounded disabled" href="#">Transaction</a>
                        <?php endif; ?>

                    </li>
                    <?php endif ; ?>
                </ul>
            </div>

            <?php if(empty($_SESSION['username'])) : ?>
            <a class="nav-link rounded navbar-nav d-flex mx-3" href="login.php">Login</a>
            <?php else: ?>
            <a class="nav-link rounded navbar-nav d-flex mx-3" href="edit.php?username=<?=$_SESSION['username']?>">Profile</a>
            <a class="nav-link rounded navbar-nav d-flex mx-3" href="login.php?login=logout">Logout</a>
            <?php endif ; ?>
        </div>
    </nav>
    
    <center class="my-3">
        <h1 style="color: #4d310f !important;">WELCOME TO HONEY BAKERY</h1>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <center>
                    <div class="card">
                        <div class="card-header" style="font-size:20px;">
                            <a class="breadType" href="index.php">Type Bread</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-warning-subtle">
                                <a class="breadType" href="index.php?type=yeast">Yeast Bread</a>
                            </li>
                            <li class="list-group-item bg-warning-subtle">
                                <a class="breadType" href="index.php?type=common">Common Bread</a>
                            </li>
                            <li class="list-group-item bg-warning-subtle">
                                <a class="breadType" href="index.php?type=cake">Cake</a>
                            </li>
                            <li class="list-group-item bg-warning-subtle">
                                <a class="breadType" href="index.php?type=combined">Combined Bread</a>
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
            <div class="col-10">
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="background-color: #E1C78F; font-size:20px; font-weight:bold; height:44px">
                    <a href="index.php" class="breadType">Bread</a>
                </div>
                <div class="row p-2 mx-3">
                    <?php  
                        $query = mysqli_query($conn, "SELECT * FROM cake");
                        while($data = mysqli_fetch_array($query)):
                    ?>

                    <?php if(isset($_GET['type'])) :?>
                        <?php if($_GET['type'] == 'yeast'): ?>
                            <?php if($data['type'] == 'Yeast Bread'): ?>
                            <div class="col-md-4 mt-4 d-flex">
                                <div class="card" style="width: 18rem;">
                                    <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..."
                                        style="aspect-ratio:1/1;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $data['cake_name']?></h5>
                                        <p class="card-text">Rp. <?= number_format($data['price'],2,'.',',')  ?></p>
                                        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') : ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="edit.php?editCake=<?=$data['id_cake']?>" class="btn btn-primary">Edit</a>
                                            <a href="process.php?delete=<?=$data['id_cake']?>" class="btn btn-danger">Delete</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php elseif($_GET['type'] == 'common'): ?>
                            <?php if($data['type'] == 'Common Bread'): ?>
                            <div class="col-md-4 mt-4 d-flex">
                                <div class="card" style="width: 18rem;">
                                    <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..."
                                        style="aspect-ratio:1/1;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $data['cake_name']?></h5>
                                        <p class="card-text">Rp. <?= number_format($data['price'],2,'.',',')  ?></p>
                                        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') : ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="edit.php?editCake=<?=$data['id_cake']?>" class="btn btn-primary">Edit</a>
                                            <a href="process.php?delete=<?=$data['id_cake']?>" class="btn btn-danger">Delete</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php elseif($_GET['type'] == 'cake'): ?>
                            <?php if($data['type'] == 'Cake'): ?>
                            <div class="col-md-4 mt-4 d-flex">
                                <div class="card" style="width: 18rem;">
                                    <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..."
                                        style="aspect-ratio:1/1;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $data['cake_name']?></h5>
                                        <p class="card-text">Rp. <?= number_format($data['price'],2,'.',',')  ?></p>
                                        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') : ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="edit.php?editCake=<?=$data['id_cake']?>" class="btn btn-primary">Edit</a>
                                            <a href="process.php?delete=<?=$data['id_cake']?>" class="btn btn-danger">Delete</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php elseif($_GET['type'] == 'combined'): ?>
                            <?php if($data['type'] == 'Combined Bread'): ?>
                            <div class="col-md-4 mt-4 d-flex">
                                <div class="card" style="width: 18rem;">
                                    <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..."
                                        style="aspect-ratio:1/1;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $data['cake_name']?></h5>
                                        <p class="card-text">Rp. <?= number_format($data['price'],2,'.',',')  ?></p>
                                        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') : ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="edit.php?editCake=<?=$data['id_cake']?>" class="btn btn-primary">Edit</a>
                                            <a href="process.php?delete=<?=$data['id_cake']?>" class="btn btn-danger">Delete</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endif; //endif if(get == 'type') ?>

                        <?php else: //else if isset get ?>
                            <div class="col-md-4 mt-4 d-flex">
                                <div class="card" style="width: 18rem;">
                                    <img src="img/asset/<?=$data['image']?>" class="card-img-top" alt="..."
                                        style="aspect-ratio:1/1;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $data['cake_name']?></h5>
                                        <p class="card-text">Rp. <?= number_format($data['price'],2,'.',',')  ?></p>
                                        <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') : ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="edit.php?editCake=<?=$data['id_cake']?>" class="btn btn-primary">Edit</a>
                                            <a href="process.php?delete=<?=$data['id_cake']?>" class="btn btn-danger">Delete</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; //endif if isset get?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>