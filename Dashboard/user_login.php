
<?php
session_start();
// echo " <small>Session ID: " . session_id() . "</small>";
include('config.php');
include('form.php');
// $error='';
//include("config.php");
//session_start();
//echo session_id();

// var_dump($_POST);

if (isset($_POST['submit'])) {
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is Invalid";
    }
    else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        

    $conn = mysqli_connect("");
 
    // $query = mysqli_query("SELECT * FROM users WHERE username='".$user."' AND password='".$pass."'");
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username= '" . $username . "' AND password='" . $password . "'");

    $rows = mysqli_num_rows($query);
    if ($rows == 1) {
    header("Location: viewlogs.php");
    }    
    else {
        $error = "Username or Password invalid";
    }
    // session_abort();

}

}

?>


