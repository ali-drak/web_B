
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>infoH-save</title>
    <?php require('dbcon.php');

    if (!is_logged_in()){
        login_error_redirect();
    }?>
</head>
<body>

<form method="post" action=""  >

    <div class="form-group"> <center style="margin-bottom: 50px ;font-size: 40px"><label id="l7" >ثبت مشخصات همکار</label></center></div>
    <div class="form-group"> <center><label id="l1">:کد استخدامی</label></center>
        <center><input type="number" name="code_estkh"  id="code_estkh"/></center></div>
    <div class="form-group"> <center><label id="l2">:نام</label></center>
        <center><input type="text" name="fname" id="fname"/></center></div>
    <div class="form-group"> <center><label id="l3">:نام خانوادگی</label></center>
        <center><input type="text" name="lname" id="lname"/></center></div>
    <div class="form-group"> <center><label id="l4">:کد شعبه</label></center>
        <center><input type="number" name="c_shobe" id="c_shobe"/></center></div>
    <div class="form-group"> <center style="margin-top: 20px"><button type="submit" class="btn-success" >ثبت</button> </center></div>



</form>
<br>
<hr>
<center>
    <form method="post" action=""  >

        <div class="form-group"> <center style="margin-bottom: 30px ;font-size: 40px"><label id="l7" >ثبت مشخصات فرزند همکار</label></center></div>
       <div class="form-group"> <center><label id="l2">:نام</label></center>
           <center><input type="text" name="txtfname" id="fname"/></center></div>
        <div class="form-group"> <center><label id="l3">:نام خانوادگی</label></center>
            <center><input type="text" name="txtlname" id="lname"/></center></div>
        <div class="form-group"> <center><label id="l1">:کد ملی</label></center>
            <center><input type="text" name="txt_c_meli" id="code-meli"/></center></div>
        <div class="form-group"> <center><label id="l6">:تاریخ تولد</label></center>
            <center><input type="text" name="txt_date" id="date-tavalod"/></center></div>
        <div class="form-group"> <center><label id="l5">:کد استخدامی</label></center>
            <center><input type="text" name="txt_c_est" id="code-estkh"/></center></div>
        <div class="form-group"> <center><label id="l4">:شماره حساب</label></center>
            <center><input type="text" name="txt_c_shobe" id="c-shobe"/></center></div>
        <div class="form-group"> <center style="margin-top: 20px"><button type="submit" >ثبت</button> </center></div>


    </form>
</center>

</body>
</html>