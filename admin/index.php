<?php require('../inc/connect.php') ?>
<?php require('filter.php') ?>
<?php require('essentials.php') ?>
<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
    redirect('dashboard.php');
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql            = "SELECT * FROM `admin_cred` WHERE `admin_username` = '$username' AND admin_pass = '$password'";
    $result         = mysqli_query($conn, $sql);
    if($result -> num_rows > 0){
        alert("successfully loged in ", "success");
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['admin'] = true;
        $_SESSION['id']    = $row['id'];
        redirect('dashboard.php');        
    }
    else{
        alert("Login failed due to invalid credientials", "danger");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../inc/links.php') ?>
    <title>ADMIN - LOGIN</title>
</head>

<body class="bg-light">
    <div class="login_form bg-white rounded">
        <form method="POST" >
            <h5 class="text-center bg-dark text-white p-3 rounded">ADMIN LOGIN PANEL</h5>
            <div class="p-3 rounded">
                <input type="text" class="form-control text-center mb-3 p-2" id="username" placeholder="Admin Name" name="username">
                <input type="password" class="form-control text-center mb-3 p-2" id="logpass" placeholder="Password" name="password">
                <div class="d-flex justify-content-center ">
                    <button class="btn custom-bg text-white text-center mb-1 shadow-none" type="submit" name="login">LOGIN</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>