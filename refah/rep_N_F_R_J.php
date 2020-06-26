<?php require('dbcon.php');

if (!is_logged_in()){
    login_error_redirect();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rep-T-H-J</title>

    <script src="jquery-3.3.1.js">
    </script>
</head>
<body>

<form method="post" action="" style="margin-top: 1%">
    <div class="form-group"><center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" > اسامی فرزندان  دریافت  جایزه</label></center></div>
   <div class="form-group"> <center><label id="l1">:از سال</label></center>
    <center><input type="text" name="txt_azsal" id="az-sal"/></center></div>
    <div class="form-group"> <center><label id="l2">:تا سال</label></center>
        <center><input type="text"  name="txt_tasal" id="ta-sal"/></center></div>

    <div class="form-group"> <center style="margin-top: 20px"><button type="submit"  class="btn-success" id="submit1_N_R_J" name="submit1_N_R_J">جستجو</button> </center></div>
    <script>
        //    $("#save").click(function(){
        //        $("#center_main").load("rep.php");
        //    });

    </script>


</form>

</body>
</html>