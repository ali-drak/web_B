<?php require('dbcon.php');

if (!is_logged_in()){
    login_error_redirect();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rep-R-H-J</title>
    <script src="jquery-3.3.1.js">
    </script>

</head>
<body>

<form name="rep-R-H-J" action="" method="post"  style="margin-top: 1%">
    <div class="form-group"> <center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" >استعلام دریافت هزینه یا جایزه</label></center></div>
    <div class="form-group"> <center><label id="l1">:کد ملی</label></center>
        <center><input type="text" name="code_meli" id="code_meli"/></center></div>

    <div class="form-group"> <center style="margin-top: 20px"><button id="sunmit_R_H_J" name="sunmit_R_H_J" class="btn-success" >جستجو</button> </center></div>


</form>


</body>
</html>