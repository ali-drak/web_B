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

<form method="post" action="" style=" margin-top: 1% ">
    <div class="form-group"> <center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" > گزارش تعداد و میزان هزینه تحصیلی </label></center></div>
    <div class="form-group"> <center><label id="l1">:از سال</label></center>
        <center><input type="text" name="txt_azsal" id="az-sal"/></center></div>
    <div class="form-group"> <center><label id="l2">:تا سال</label></center>
        <center><input type="text" name="txt_tasal" id="ta-sal"/></center></div>

    <div class="form-group"> <center style="margin-top: 20px"><button type="submit"  id="submit1" name="submit_T_H" class="btn-success">جستجو</button> </center></div>
    <script>
    //    $("#save").click(function(){
    //        $("#center_main").load("rep.php");
    //    });

    </script>


</form>
<br>
<hr>
<center>
    <form method="post" action="">

        <div class="form-group"> <center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" >گزارش تعداد و میزان جایزه تحصیلی</label></center></div>
        <div class="form-group"> <center><label id="l1">:از سال</label></center>
            <center><input type="text" name="txtj_azsal" id="az-sal"/></center></div>
        <div class="form-group"> <center><label id="l2">:تا سال</label></center>
            <center><input type="text" name="txtj_tasal" id="ta-sal"/></center></div>

        <div class="form-group"> <center style="margin-top: 20px"><button type="submit"  id="submit2"  name="submit_T_J" class="btn-success" >جستجو</button> </center></div>



    </form>
</center>
<script>
  //  $("#save2").click(function(){
  //      $("#center_main").load("rep.php");
  //  });

</script>
</body>
</html>