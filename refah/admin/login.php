<?php
include('../dbcon.php');
require_once '../helpers/helpers.php';

//include 'helpers/helpers.php';
?>
<?php

//$hashed = password_hash(123456,PASSWORD_DEFAULT);
//echo $hashed;

$errors = array();
//echo $username;
if ($_POST){
    $username = ((isset($_POST['username']))?sanitize($_POST['username']):'');;

    $password =((isset($_POST['password']))?sanitize($_POST['password']):'');
    //form validation
    if (empty($_POST['username'])|| empty($_POST['password'])){
        $errors[]= ' شما باید نام کاربری و کلمه عبور کامل کنید';
    }

   // password is more than 6 characters
    if (strlen($password) < 6){
        $errors[] = 'کلمه عبور باید بسشتر از ۶ کلمه باشد';
    }
    // check if username exists in the database
    $query =$con->query("SELECT * FROM user WHERE username = '$username'");
    $user =mysqli_fetch_assoc($query);
   // echo $user['user_íd'];
    $userCount = mysqli_num_rows($query);//echo $userCount .$user['user_id'];

    if ($userCount < 1){
        $errors[] = 'نام کاربری موجود نمی باشد';
    }

    if (!password_verify($password,$user['password'])){
        $errors[] = 'کلمه عبور صحیح نمی باشد. دوباره امتحان کنید.';
      //  echo  date("Y-m-d H:i:s");
    }



    //check for errors
    if (!empty($errors)){
        echo display_errors( $errors);
    }else{
        // log user in
        $user_id = 0;
        $user_id = $user['user_id'];
       // echo $user_id;
        login($user_id);
    }
}
?>
<html>
<head>
    <title>refah1</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <style>
        #menu ul{

        //  list-style-type:none;

        // margin-right:1px;
        // padding-bottom:10px;
            float: right;
            direction: rtl;

        }
        @keyframes myanim {
            0%{opacity: 0.3;}
            100%{opacity: 1.0;}

        }
        #menu ul li{
            display:inline;
            text-align: center;
            color: white;
            font-family: "B Titr", serif;
        //text-decoration: none;
            width: 20%;
            padding:  6px 16px;
            background: #b1b3b4;


        // height: 110px;
        // overflow: hidden;
        //   border-left: 1px solid #ceffff;
            margin-top: 0px;
        // animation: myanim 1s;
        // -webkit-transition: height 0.5s ease-out ;
        //  transition: height 0.3s ease-out;

        }
        #menu li:hover{
            background: #3e3b3a;
            border-radius: 10px;
            cursor: pointer;


    </style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (refah1.psd) -->
<table id="Table_01" width="1024" height="769" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
            <img src="../images/refah1_01.gif" width="375" height="131" alt=""></td>
        <td colspan="6">
            <img src="../images/refah1_02.gif" width="364" height="131" alt=""></td>
        <td colspan="2">
            <img src="../images/refah1_03.gif" width="285" height="131" alt=""></td>
    </tr>
    <tr>
        <td colspan="9" style="background-color: #c6c8c9;width:1024px;height: 40px">
            <div id="menu" style="background-color: #b1b3b4;width:1010px;height: 60px;margin-left: 7px;border-radius:10px 10px 10px 10px">

            </div>

            <!--            <img src="images/refah1_04.gif" width="1024" height="40" alt=""></td>-->
    </tr>
    <tr>
        <td colspan="9">
            <img src="../images/refah1_05.gif" width="1024" height="51" alt=""></td>
    </tr>
    <tr>
        <td colspan="2" rowspan="8">
            <img src="../images/refah1_06.gif" width="422" height="435" alt=""></td>
        <td colspan="2">
            <img src="../images/refah1_07.png" width="184" height="218" alt=""></td>
        <td colspan="5" rowspan="4">
            <img src="../images/refah1_08.gif" width="418" height="301" alt=""></td>

    </tr>
    <form method="post" action="">
        <tr>
            <td colspan="2" style="background-color: #c6c8c9;width:184px; height:44px ">
                <!--            <img src="images/refah1_09.gif" width="184" height="44" alt="">-->
                <input type="text" name="username" style="width:184px; height:30px;border-radius: 10px">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #c6c8c9;width:184px; height:28px ">
                <input type="password" name="password" style="width:184px; height:28px;border-radius: 10px">
                <!--
                    <img src="images/refah1_10.gif" width="184" height="28" alt="">-->
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #c6c8c9;width:184px; height:11px ">
                <img src="../images/refah1_11.gif" width="184" height="11" alt="">


            </td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: #c6c8c9;width:192px; height:28px ">
                <table style="background-color: #cccccc;width:192px; height:28px ">

                </table>
                <!--            <img src="images/refah1_12.gif" width="192" height="28" alt=""></td>-->
            <td colspan="4" rowspan="2">
                <img src="../images/refah1_13.gif" width="410" height="45" alt=""></td>
        </tr>
        <tr>
            <td colspan="3">
                <img src="../images/refah1_14.gif" width="192" height="17" alt=""></td>
        </tr>
        <tr>
            <td  style="background-color: #c6c8c9;width:92px; height:34px ">
                <!--            <img src="images/refah1_15.gif" width="92" height="34" alt="">-->
                <button name="cancel" style="width:92px;font-family: 'B Titr'; height:34px ;margin:0;">انصراف</button>
            </td>
            <td colspan="3" style="background-color: #c6c8c9;width:101px; height:34px ">
                <!--            <img src="images/refah1_15.gif" width="92" height="34" alt="">-->
                <button name="submit_L_G" type="submit" value="Submit" style="width:98px;font-family: 'B Titr'; height:34px ;margin:0;">ورود</button>
            </td>
    </form>
    <td colspan="3" rowspan="2">
        <img src="../images/refah1_17.gif" width="409" height="89" alt=""></td>
    </tr>
    <tr>
        <td colspan="4">
            <img src="../images/refah1_18.gif" width="193" height="55" alt=""></td>
    </tr>
    <tr>
        <!--        <td colspan="8">-->
        <td colspan="8" style="background-color: #bbbdbe;width:1024px;height: 40px">
            <!--            <img src="images/refah1_19.gif" width="1020" height="111" alt=""></td>-->
        <td>
            <img src="../images/refah1_20.gif" width="4" height="111" alt=""></td>
    </tr>
    <tr>
        <td>
            <img src="images/spacer.gif" width="375" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="47" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="92" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="92" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="8" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="1" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="124" height="1" alt=""></td>
        <td>
            <img src="images/spacer.gif" width="281" height="1" alt=""></td>
        <td>
            <img src="images/
			spacer.gif" width="4" height="1" alt=""></td>
    </tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>
