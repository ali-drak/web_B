<?php
require_once 'helpers/helpers.php';

//set database login
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "refah_tahsil";



$con = mysqli_connect($servername, $username, $password) or die("Could not connect database");
mysqli_select_db($con,$dbname) or die("Could not select database");
mysqli_set_charset($con,"utf8");

session_start();
//check for success login
if (isset($_SESSION['SBUser'])){
    //check for isset user in database
    $user_id =$_SESSION['SBUser'];
    $query= $con->query("SELECT * FROM user WHERE user_id='$user_id'");
    $user_data=mysqli_fetch_assoc($query);
    $fn = explode(' ',$user_data['full_name']);
    $user_data['first']=$fn[0];



}
////set style for display success and unset session
if (isset($_SESSION['success_flash'])){
    echo '<div class="bg-dander" style="background-color: #cd8c79">
<p class="text-success text-center">'.$_SESSION['success_flash'].'</p> </div>';
    unset($_SESSION['success_flash']);
}
////set style for display error unset session

if (isset($_SESSION['error_flash'])){
    echo '<div class="bg-dander" style="background-color: #cd8c79">
<p class="text-danger text-center">'.$_SESSION['error_flash'].'</p> </div>';
    unset($_SESSION['error_flash']);
}


?>
<link rel="stylesheet" href="../css/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/main.css">


