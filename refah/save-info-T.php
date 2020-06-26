<?php
require('dbcon.php');
if (!is_logged_in()){
    login_error_redirect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>infoH-saveHT</title>
    <script src="js/jquery-3.3.1.js">
    </script>
</head>
<body>

<form   method="post" action="" enctype="multipart/form-data"  style="margin-top: 1%" >
    <div class="form-group"> <center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" >ثبت مشخصات تحصیلی</label></center></div>
    <div class="form-group"> <center><label id="l1">:پایه تحصیلی</label></center>
        <center><input type="text" name="txtc_pa"/></center></div>
    <div class="form-group"> <center><label id="l2">:کد ملی</label></center>
        <center><input type="text" name="txtc_m" id="name"/></center></div>
    <div class="form-group"> <center><label id="l3">:معدل</label></center>
        <center><input type="text" name="txtmoadel" id="moadel"/></center></div>
    <div class="form-group"> <center><label id="l4">:سال تحصیلی</label></center>
        <center><input type="text" name="txtd_tahsil" id="date-tahsil"/></center></div>
    <div class="form-group"> <center><label id="l5">:تصویر کارنامه</label></center>
        <center><input type="file" name="pic_karname" id="pic_karname" class="btn-secondary" /></center></div>
    <div class="form-group"> <center style="margin-top: 20px"><button type="submit"name="submit" value="insert" id="save"  class="btn-success" >ثبت</button> </center></div>
    <script>
        $("#save").click(function(){
            $("#center_main").load("register1.php");
        });

    </script>


</form>


</body>
</html>