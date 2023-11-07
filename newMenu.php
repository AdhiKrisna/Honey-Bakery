<?php   
    include 'functions.php';
    session_start();
    if(empty($_SESSION['username'])){
        header("location:login.php?login=false");
    }
    if($_SESSION['username'] != 'admin'){
        header("location:login.php?login=user");
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Menu</title>
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
                        <a class="nav-link rounded" href="newMenu.php"  style="background-color: #E1C78F;">New Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded" href="transaction.php">Transaction</a>
                    </li>

                </ul>
            </div>

            <a class="nav-link navbar-nav d-flex rounded p-2 mx-3 " href="edit.php?username=<?=$_SESSION['username']?>">Profile</a>
            <a class="nav-link navbar-nav d-flex mx-3" href="logout.php">Logout</a>

        </div>
    </nav>

    <center class="mt-4">
        <h1 style="color: #4d310f !important;">ADD NEW MENU</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body bg-warning-subtle">
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="cakeName" class="form-label">Cake Name</label>
                        <input type="text" class="form-control" id="cakeName" name="cakeName" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" aria-label="Default select example" id="type" name="type">
                        <?php  $type = array('Yeast Bread', 'Common Bread', 'Cake', 'Combined Bread'); ?>
                        <?php for($i = 0; $i < count($type); $i++): ?>
                                <option value="<?=$type[$i]?>"><?=$type[$i];?></option>
                        <?php endfor; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" min="1">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button class="btn btn-primary" type="submit" name="add" value="menu">Save</button>
                </form>
            </div>
        </div>
    </center>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>