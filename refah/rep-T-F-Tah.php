<?php require('dbcon.php');

if (!is_logged_in()){
    login_error_redirect();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rep-T-F-Tah</title>
</head>
<body>

<form name="rep-T-F-Tah" method="post" action=""  style="margin-top: 1%">
    <div class="form-group">  <center style=" margin-bottom: 50px ;font-size: 40px"><label id="l7" >گزارش تعداد فرزندان درحال تحصیل</label></center></div>
 <div class="form-group">   <center><label id="l1">:کد استخدامی</label></center>
     <center><input type="text" name="txt_cSetkh" id="code-estkh"/></center></div>
    <div class="form-group"> <center><label id="l2">:نام</label></center>
        <center><input type="text" name="txtname" id="name"/></center></div>
    <div class="form-group"> <center><label id="l3">:نام خانوادگی</label></center>
        <center><input type="text" name="txtfname" id="fname"/></center></div>
    <div class="form-group"> <center><label id="l4">:کد شعبه</label></center>
        <center><input type="text" name="txtc_shobe" id="c-shobe"/></center></div>
    <div class="form-group"> <center style="margin-top: 20px"><button type="submit" class="btn-success" name="submit_T_F_T">جستجو</button> </center></div>


</form>


</body>
</html>