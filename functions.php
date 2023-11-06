<?php  
//connect
    $conn = mysqli_connect("localhost", "root", "", "bakery");
//upload
    function uploadImage(){
        // $image = $_POST['image']; 
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $tempName = $_FILES['image']['tmp_name']; 
        $success = true;
        if($error === 4){
            $success = false;
            echo"
                <script>
                    alert('Menu created without picture');
                </script>
            ";
        }
        $validFileExtension = ['jpg', 'jpeg', 'png', 'svg']; //list ekstensi yg valid
        $FileExtension = explode('.', $name); //memecah nama file  menjadi array setiap ada karakter '.'
        $FileExtension = strtolower(end($FileExtension)); //to lower semua nama file agar masuk ke file ekstensi yang VALID

        if($success){
            if(!in_array($FileExtension, $validFileExtension)){
                echo"
                    <script>
                        alert('Not valid file extension!');
                    </script>
                ";
                return false;
            }
            if($size > 1000000000){
                echo"
                    <script>
                        alert('Too big size image!');
                        document.location.href = 'add.php';
                    </script>
                ";
                return false;
            }
        }
        move_uploaded_file($tempName, 'img/asset/'.$name);
        return $name;
    }
    function editImage(){
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $tempName = $_FILES['image']['tmp_name']; 
        
        $validFileExtension = ['jpg', 'jpeg', 'png', 'svg']; //list ekstensi yg valid
        $FileExtension = explode('.', $name); //memecah nama file  menjadi array setiap ada karakter '.'
        $FileExtension = strtolower(end($FileExtension)); //to lower semua nama file agar masuk ke file ekstensi yang VALID

            if(!in_array($FileExtension, $validFileExtension)){
                echo"
                    <script>
                        alert('Not valid file extension!');
                    </script>
                ";
                return false;
            }
            if($size > 1000000000){
                echo"
                    <script>
                        alert('Too big size image!');
                        document.location.href = 'add.php';
                    </script>
                ";
                return false;
            }
        
        move_uploaded_file($tempName, 'img/asset/'.$name);
        return $name;
    }
    
?>