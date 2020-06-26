<?php

require_once('../dbcon.php');
//require_once '../helpers/helpers.php';
//include 'helpers/helpers.php';
?>
<?php

//$hashed = password_hash(123456,PASSWORD_DEFAULT);
//echo $hashed;
$hashed= $user_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password,PASSWORD_DEFAULT);
$user_id = $user_data['user_id'];
$errors = array();


//echo $username;
if ($_POST){

    //form validation
    if (empty($_POST['old_password'])|| empty($_POST['password']) || empty($_POST['confirm'])){
        $errors[]= ' شما باید تمام کادرها را کامل کنید';
    }

    // password is more than 6 characters
    if (strlen($password) < 6){
        $errors[] = 'کلمه عبور باید بسشتر از ۶ کلمه باشد';
    }
    //  if new password matches confirm
    if ($password != $confirm){
        $errors[]= 'کلمه علور جدید با تکرار آن یکسان نیست!';
    }

    if (!password_verify($old_password,$hashed)){
        $errors[]= 'کلمه عبور فعلی نادرست می باشد. دوباره امتحان کنید.';
    }





    //check for errors
    if (!empty($errors)){
        echo display_errors( $errors);
    }else{
        // change password
        $con->query("UPDATE user SET password = '$new_hashed' WHERE  user_id = '$user_id' ");
        $_SESSION['success_flash']= 'کلمه عبور شما با موفقیت تغییر یافت';
        header('Location: ../index.php');
    }
}
?>
<html>
<head>
    <title>refah1</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link href="../css/main.css" rel="stylesheet" type="text/css">
<style>
  <!-- // body{ // background-image: url("../_downloadfiles_wallpapers_2880_1800_tom_clancys_ghost_recon_wildlands_17318.jpg");
      background-size: 100vw 100vh;
      direction: rtl;
      float: right;
  width: 100%} -->
</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (refah1.psd) -->
<div id="login-form">
    <div></div>
    <h2 class="text-center">تغییر کلمه عبور</h2><hr>
    <form method="post" action="admin/change_password.php">
        <div class="form-group">
            <label for="old_password">کلمه عبور فعلی:</label>
            <input type="password" name="old_password" style="width:184px; height:30px;border-radius: 10px" value="<?=$old_password;?>">
        </div>
        <div class="form-group">
            <label for="password">کلمه عبور جدید :</label>
            <input type="password" name="password" style="width:184px; height:28px;border-radius: 10px" value="<?=$password;?>">
        </div>
        <div class="form-group">
            <label for="confirm"> تکرار کلمه عبور جدید :</label>
            <input type="password" name="confirm" style="width:184px; height:28px;border-radius: 10px" value="<?=$confirm;?>">
        </div>
        <div class="form-group">

            <a href="index.php"> <input name="su" type="button" value="انصراف" style="width:98px;font-family: 'B Titr'; height:34px ;margin:0;align-self: center"></a>
            <input name="submit_L_G" type="submit" value="ورود" style="width:98px;font-family: 'B Titr'; height:34px ;margin:0;align-self: center">
        </div>
    </form>
    <p class="text-right"><a href="../index.php" alt="home">نمایش وب سایت</a> </p>

</div>


</body>
</html>
