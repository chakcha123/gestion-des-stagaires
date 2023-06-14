<?php
require 'db.php';
$m = "";

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mdp1']) && isset($_POST['mdp2'])){
        if(($_POST['mdp1'])===($_POST['mdp2'])){
        $ins = "INSERT INTO T_CHAKCHA (firstname, lastname, email,mdp)
                VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[email]','$_POST[mdp1]')";
        if (mysqli_query($conn, $ins)) {
            $m = "sign up successfully";
        } else {
            $m = "Error: " . $ins . "<br>" . mysqli_error($conn);
        }
        }
        else{
            $m = "password is not correct";
    }
}else if($_SERVER["REQUEST_METHOD"] === "POST"){
    $m="3mr dak l9lawi";
}else{
    $m="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Document</title>

    <style>
        /* Custom CSS styles */
        .form-card {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
        }
        .container{
            padding:40px;
        }
        
         
    </style>
</head>
<body>
    <center><h1 style="padding:40px;color:blue">Sign up page</h1></center>
    <div class="container">
        <div class="card form-card" id="hh">
            <div class="card-body">
                <h5 class="card-title">Sign up</h5>
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="mdp1" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="mdp2" class="form-control" placeholder="Confirm Password">
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary"><br> <label><?php echo $m ?></label>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


