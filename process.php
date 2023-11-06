<?php 
    include "functions.php";
    session_start();

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
        $data = mysqli_num_rows($query);
        if($data > 0){
            $_SESSION['username'] = $username;
            header("location:index.php");
        }
        else{
            header("location:login.php?login=fail");
        }
    }
    if(isset($_POST['edit'])){
        if($_POST['edit'] == 'user'){
            $oldUsername = $_SESSION['username'];
            $newUsername = $_POST['username'];
            $password = $_POST['password'];
            $query = mysqli_query($conn, "UPDATE user SET username = '$newUsername' WHERE username = '$oldUsername'");
            $query = mysqli_query($conn, "UPDATE user SET password = '$password' WHERE username = '$newUsername'");
            session_destroy();
            header("location:login.php?login=edit");
        }
        elseif($_POST['edit'] == 'cake'){
            $id_cake = $_POST['id_cake'];
            $cake_name = $_POST['cakeName'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            
            if(isset($_FILES['image'])){
                if($_FILES['image']['size'] != 0){
                    $query = mysqli_query($conn, "SELECT image FROM cake WHERE id_cake = $id_cake");
                    $image = mysqli_fetch_array($query);
                    unlink('img/asset/'.$image['image']); // hapus file
                    $newImage = editImage(); //upload
                    $query = mysqli_query($conn, "UPDATE cake SET image = '$newImage' WHERE id_cake = $id_cake");
                    echo"
                        <script>
                            alert('Edit Cake Success!');
                            document.location.href = 'index.php';
                        </script>
                    ";
                }else{
                    echo"
                        <script>
                            alert('Edit Success. Not updating picture!');
                            document.location.href = 'index.php';
                        </script>
                    ";
                }
            }
            $query = mysqli_query($conn, "UPDATE cake SET cake_name = '$cake_name' WHERE id_cake = $id_cake");
            $query = mysqli_query($conn, "UPDATE cake SET type = '$type' WHERE id_cake = $id_cake");
            $query = mysqli_query($conn, "UPDATE cake SET price = $price WHERE id_cake = $id_cake");
        }
    }
    if(isset($_POST['add'])){
        if($_POST['add'] == 'menu'){
            $cake_name = $_POST['cakeName']; 
            $type = $_POST['type']; 
            $price = $_POST['price']; 
            // upload image
            $image = uploadImage();
            $query = "INSERT INTO cake VALUES ('','$cake_name','$type', $price, '$image')";
            mysqli_query($conn, $query);    
            echo"
            <script>
                alert('Add Cake Menu Success!');
                document.location.href = 'index.php';
            </script>";
        }
    }
    if(isset($_GET['delete'])){
        $id_cake = $_GET['delete'];
        $query = mysqli_query($conn, "SELECT image FROM cake WHERE id_cake = $id_cake");
        $image = mysqli_fetch_array($query);
        unlink('img/asset/'.$image['image']); // hapus file

        $delete = mysqli_query($conn, "DELETE FROM cake WHERE id_cake = $id_cake");
        
        echo"
            <script>
                alert('Delete Cake Menu Success!');
                document.location.href = 'index.php';
            </script>"
        ;
    }
    if(isset($_POST['order'])){
        $customer = $_POST['customer'];
        $amountBread = 0;
        $totalPrice = 0;
        
        foreach ($_POST['amount'] as $idCake => $quantity) {
            if($quantity != ''){
                $cake = mysqli_query($conn, "SELECT * FROM cake WHERE id_cake = $idCake");
                $data = mysqli_fetch_array($cake);
                $price = $data['price'] * $quantity;    
                $totalPrice += $price;            
                $amountBread++;
            }
        }
        //insert into table transaction
        $addOrder = mysqli_query($conn, "INSERT INTO transaction VALUES ('','$customer',$amountBread,$totalPrice)");

        ///take transaction ID
        $takeTransactionId = mysqli_query($conn, "SELECT * FROM transaction WHERE customer = '$customer' AND amount_bread = $amountBread AND total = $totalPrice");
        $data = mysqli_fetch_array($takeTransactionId);
        $transactionID = $data['transaction_id'];

        //insert into table detail
        foreach ($_POST['amount'] as $idCake => $quantity) {
            if($quantity != ''){
                $cake = mysqli_query($conn, "SELECT * FROM cake WHERE id_cake = $idCake");
                $data = mysqli_fetch_array($cake);
                $price = $data['price'] * $quantity;    
                $detail = mysqli_query($conn, "INSERT INTO detail VALUES ('',$transactionID, $idCake, $quantity, $price)");
            }
        }
        if($_SESSION['username'] == 'admin'){
            echo"
                <script>
                    alert('Order Success!');
                    document.location.href = 'transaction.php';
                </script>"
            ;
        }
        else{
            echo"
            <script>
                alert('Order Success!');
                document.location.href = 'index.php';
            </script>"
        ;
        }

    }
?>