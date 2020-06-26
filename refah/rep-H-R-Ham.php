<?php require('dbcon.php');

if (!is_logged_in()){
    login_error_redirect();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>گزارش هزینه دریافتی هر همکار</title>
</head>
<body>

<form name="rep-H-R-Ham" action="" method="post" style="margin-top: 1%">
    <div class="form-group "><center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" >گزارش هزینه دریافتی هر همکار</label></center></div>
<div class="form-group"> <center><label id="l1">:کد استخدامی</label></center>
    <center><input type="text" name="codeـestkh" id="codeـestkh"/></center></div>
    <div class="form-group"> <center><label id="l2">:از تاریخ</label></center>
        <center><input type="text" name="az_tarikh" id="az_tarikh"/></center></div>
    <div class="form-group"> <center><label id="l3">:تا تاریخ</label></center>
        <center><input type="text" name="ta_tarikh" id="ta_tarikh"/></center></div>

    <div class="form-group"> <center style="margin-top: 20px"><button type="submit" name="submit_H_R_Ham" id="submit_H_R_Ham" class="btn-success">جستجو</button> </center></div>


</form>


</body>
</html>