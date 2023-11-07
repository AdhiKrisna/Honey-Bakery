<?php   
    include 'functions.php';
    session_start();
    if(empty($_SESSION['username'])){
        header("location:login.php?login=false");
    }
    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $dataEdit = mysqli_fetch_array($query);
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
                        <a class="nav-link rounded" href="#">Order</a>
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
            
            <?php if(empty($_SESSION['username'])) : ?>
            <a class="nav-link navbar-nav d-flex mx-3 p-2 rounded" style="background-color: #E1C78F;"
            href="login.php">Login</a>
            <?php else: ?>
                <?php if(isset($_GET['editCake'])): ?>
                    <a class="nav-link navbar-nav d-flex rounded p-2 mx-3 " href="edit.php">Profile</a>
                <?php else: ?>
                    <a class="nav-link navbar-nav d-flex rounded p-2 mx-3 " href="edit.php"
                    style="background-color: #E1C78F;">Profile</a>
                <?php endif; ?>
                <a class="nav-link navbar-nav d-flex mx-3" href="login.php">Logout</a>
            <?php endif ; ?>

        </div>
    </nav>
    
    <center class="mt-4">
        <?php if(isset($_GET['editCake'])) : ?>
            <?php 
                if($_SESSION['username'] != 'admin'){
                    header("location:login.php?login=user");
                }
                $id_cake = $_GET['editCake'];
                $query = mysqli_query($conn, "SELECT * FROM cake WHERE id_cake = $id_cake");
                $dataEdit = mysqli_fetch_array($query); 
                $type = array('Yeast Bread', 'Common Bread', 'Cake', 'Combined Bread');
            ?>
        <h1 style="color: #4d310f !important;">EDIT CAKE</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body bg-warning-subtle">
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id_cake" value="<?=$dataEdit['id_cake']?>">
                        <label for="cakeName" class="form-label">Cake Name</label>
                        <input type="text" class="form-control" id="cakeName" name="cakeName"
                        value="<?=$dataEdit['cake_name']?>">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" aria-label="Default select example" id="type" name="type">
                        <?php for($i = 0; $i < count($type); $i++): ?>
                            <?php if($type[$i] == $dataEdit['type']): ?>
                                <option selected value="<?=$dataEdit['type']?>" ><?=$dataEdit['type']?></option>
                            <?php else :?>
                                <option value="<?=$type[$i]?>"><?=$type[$i];?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" min="1"
                            value="<?=$dataEdit['price']?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" value="<?=$dataEdit['image']?>">
                    </div>
                    <button class="btn btn-primary" type="submit" name="edit" value="cake">Save</button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <h1 style="color: #4d310f !important;">EDIT PROFILE</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body bg-warning-subtle">
                <form action="process.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?=$dataEdit['username']?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?=$dataEdit['password']?>">
                    </div>
                    <button class="btn btn-primary" type="submit" name="edit" value="user">Save</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </center>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>