<?php

include '../dbcon.php';

if (!is_logged_in()){
    login_error_redirect();
}
//session_start();
if (!has_permission('admin')){
    permission_error_redirect('../index.php');
}
if (isset($_GET['delete'])){
    $delete_id = sanitize($_GET['delete']);
    $con->query("DELETE FROM user WHERE user_id = '$delete_id'");
    $_SESSION['success_flash']= 'کاربر مورد نظر حذف کردید.';
    header('Location: ../index1.php');
}
if (isset($_GET['add'])){
    $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
    $username = ((isset($_POST['username']))?sanitize($_POST['username']):'');
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
    $errors = array();

    if ($_POST){

        $usernameQuery = $con->query("SELECT * FROM user WHERE username = '$username'");
        $usernameCount = mysqli_num_rows($usernameQuery);

        if ($usernameCount != 0 ){
            $errors[] = 'نام کاربری در پایگاه اطلاعاتی موجود میباشد.';
        }
        $required = array('name','username','password', 'confirm', 'permissions');
        foreach ($required as $f){
            if (empty($_POST[$f])){
                $errors[]= 'شما باید تمام فیلد ها را کامل کنید';
                break;

            }
        }
        if (strlen($password )< 6 ){
            $errors[] = 'کلمه عبور باید بشتر از ۶ رقم باشد.';
        }

        if ($password != $confirm){
            $errors[] = 'کلمه عبوور با تکرار آن یکسان نیست .';
        }


        if (!empty($errors)) {
            echo display_errors($errors);
        }else{
            /////add user to database
            $hashed = password_hash($password,PASSWORD_DEFAULT);
            $con->query("INSERT INTO user (full_name,username,password,permissions)
                                VALUES ('$name','$username','$hashed','$permissions')");
            $_SESSION['success_flash']= 'کاربر اضافه شد.';
            header('Location: ../index.php');



        }
    }
    ?>
    <head>
        <link rel="stylesheet" href="../css/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>
    <h2 class="text-center">اضافه کردن کاربر جدید</h2>
    <form action="users.php?add=1" method="post">
        <div class="form-group col-md-6">
            <label for="name">نام کامل:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="username">نام کابری:</label>
            <input type="text" name="username" id="username" class="form-control" value="<?=$username;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="password">کلمه عبور:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$username;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="confirm">تکرار کلمه عبور:</label>
            <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$username;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="name">سطح دسترسی:</label>
           <select class="form-control" name="permissions">
               <option value="editor"<?=(($permissions =='')?'selected':'');?>> </option>
               <option value="editor"<?=(($permissions =='editor')?'selected':'');?>>کاربر </option>
               <option value="admin,editor"<?=(($permissions =='admin,editor')?'selected':'');?>> مدیریت</option>
           </select>
        </div>
        <div class="form-group col-md-6 text-right" style="margin-top: 25px">
            <a href="users.php" class="btn btn-default">انصراف</a>
            <input type="submit" value="اضافه کردن" class="btn btn-primary">
        </div>
    </form>


<?php
}else{

    //show users in table
$userQuery = $con->query("SELECT * FROM user ORDER BY full_name");

?>

<h2 class="text-center">کاربران</h2>

<a href="./admin/users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">اضافه کردن کاربر</a>

<table class="table table-bordered table-striped table-sm " >
    <thead><th></th><th> نام</th><th>نام کاربری</th><th>تاریخ ثبت</th><th>آخرین ورود</th><th>سطح دسترسی</th></thead>
    <tbody>
    <?php while ($user = mysqli_fetch_assoc($userQuery)):?>
        <tr>
            <td>
                <?php if ($user['user_id'] != $user_data['user_id']): ?>
                <a href="index.php?delete=<?=$user['user_id']; ?>"><span class="glyphicon glyphicon-remove-sign"> حذف</span> </a>

            <?php endif ?>

            </td>
            <td><?=$user['full_name'];?></td>
            <td><?=$user['username'];?></td>
         <?   //change date to jalali?>
            <td><?=pertty_date($user['join_date'])."   " .pertty_time($user['join_date']);?></td>
            <td><?=($user['last_login']=='1970-01-01 00:00:00')?'وارد نشده':pertty_date($user['last_login'])."   " .pertty_time($user['last_login']);?></td>
            <td><?=($user['permissions']=='admin,editor')?'مدیر':'',($user['permissions']=='editor')?'کاربر':'';?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>


<?php } ?>
