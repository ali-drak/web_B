<div class="main" >
<?php
include 'header.php';

if (!is_logged_in()){
    header('Location: admin/logout.php');
}


?>

    <div class="navbar">
        <a  id="main-page" class="active">صفحه اصلی</a>

        <script>

            //open page in main content index whith jquery
            $("#main-page").click(function(){
                $("#main").load('index.php');


            });

        </script>

        <div class="dropdown1">
            <button class="dropbtn1">ثبت
                <i class="fa fa-caret-down"></i>
            </button>

            <div class="dropdown-content1">
                <?php
                //enable this item menu when admin logined
                if (has_permission('admin')):?>
                <a id="in-save">ثبت مشخصات</a>
                <script>
                    $("#in-save").click(function(){
                        $("#center_main").load('save-info.php');

                    });

                </script>
                <?php endif; ?>
                <a id="save_T">ثبت مشخصات تحصیلی</a>
                <script>
                    $("#save_T").click(function(){
                        $("#center_main").load('save-info-T.php');

                    });

                </script>

            </div>
        </div>
        <?php
        //enable this item menu when admin logined
        if (has_permission('admin')):?>
        <div class="dropdown1">
            <button class="dropbtn1">گزارشات
                <i class="fa fa-caret-down1"></i>
            </button>
            <div class="dropdown-content1">
                <a id="T-H-J">گزارش هزینه، جایزه</a>
                <script>
                    $("#T-H-J").click(function(){
                        $("#center_main").load('rep-T-H-J.php');

                    });

                </script>
                <a id="T-F-Tah">گزارش تعداد فرزندان درحال تحصیل</a>
                <script>
                    $("#T-F-Tah").click(function(){
                        $("#center_main").load('rep-T-F-Tah.php');

                    });

                </script>
                <a id="H-R-Ham">گزارش هزینه دریافتی هر همکار</a>
                <script>
                    $("#H-R-Ham").click(function(){
                        $("#center_main").load('rep-H-R-Ham.php');

                    });

                </script>
            </div>
        </div>
        <?php endif; ?>
        <?php
        //enable this item menu when admin logined
        if (has_permission('admin')):?>
            <a id="estlam" class="active">استعلام</a>
            <script>
                $("#estlam").click(function(){
                    $("#center_main").load('rep-R-H-J.php').dialog({model:true});

                });

            </script>

        <?php endif; ?>
        <div class="dropdown1">
            <button class="dropbtn1">لیست اسامی
                <i class="fa fa-caret-down1"></i>
            </button>
            <div class="dropdown-content1">
                <a id="Nane_R_J">اسامی فرزندان دریافت جایزه</a>
                <script>
                    $("#Nane_R_J").click(function(){
                        $("#center_main").load('rep_N_F_R_J.php');

                    });

                </script>
                <a  id="Name_R_H">اسامی فرزندان دریافت هزینه</a>
                <script>
                    $("#Name_R_H").click(function(){
                        $("#center_main").load('rep_N_F_R_H.php');

                    });

                </script>

            </div>
        </div>

            <?php
            //enable this item menu when admin logined
            if (has_permission('admin')):?>
                <a id="users"class="active" >کاربران
                    <script>
                        $("#users").click(function(){
                            $("#center_main").load('admin/users.php');


                        });

                    </script>
                </a>
            <?php endif; ?>

        <div class="dropdown1">
            <button class="dropbtn1">سلام!<?=$user_data['first'];?>
                <i class="fa fa-caret-down1"></i>
            </button>
            <div class="dropdown-content1">
                <a id="change_password">تغییر کلمه عبور</a>
                <script>
                    $("#change_password").click(function(){
                        $("#center_main").load('admin/change_password.php').dialog({model:true});
                        //('question-submit-form.php').dialog({model:true});

                    });

                </script>
                <a href="admin/logout.php">خروج از حساب کاربری</a>
            </div>
        </div>
    </div>




    <body dir="rtl">
<div class="center_main " id="center_main">
    <?php
    //check for sent of hamkar registered
    if (isset($_POST,$_POST['code_estkh'], $_POST['fname'], $_POST['lname'] , $_POST['c_shobe'])){


    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $query_1 = "insert into info_hamkar(code_estekh, Fname, Lname, code_shobe) values ('".$_POST['code_estkh']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['c_shobe']."') ";
    $result_1= mysqli_query($con,$query_1);

    //check for sent of farzand-hamkar registered

    }elseif(isset($_POST['txtfname'],$_POST['txtlname'] ,$_POST['txt_c_meli'] , $_POST['txt_date'] ,$_POST['txt_c_est'],$_POST['txt_c_shobe'])) {


    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    $query_2 = "insert into info_f_hamkar(fname, lname, code_meli,date_tavalod,code_estekh,code_hesab) values ('" . $_POST['txtfname'] . "','" . $_POST['txtlname'] . "','" . $_POST['txt_c_meli'] . "','" . $_POST['txt_date'] . "','" . $_POST['txt_c_est'] . "','" . $_POST['txt_c_shobe'] . "') ";
    $result_2 = mysqli_query($con, $query_2);

    //check for sent of information tahsil registered

    }elseif(isset($_POST['txtc_pa'],$_POST['txtc_m'] ,$_POST['txtmoadel'] , $_POST['txtd_tahsil'] )){

    $d=date('Y/m/d');
    $date_now=pertty_date($d);

    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    if(($date_now - '0001//') != $_POST['txtd_tahsil'] ){

        $errors[] = 'امکان ثبت وجود ندارد. برای ثبت به مرکز مراجعه نمایید. ';
    }else {
    //addslashes  in pic entered from user
    $pic = addslashes(file_get_contents($_FILES["pic_karname"]["tmp_name"]));
    ///mablagh hazineh
    $mablagh_db = 1700000;
    $mablagh_d1 = 2200000;
    $mablagh_d2 = 2800000;
    $mablagh_dn = 3400000;
    //////////////
    ////mablagh jayze
    $mablagh_j_db = 1700000;
    $mablagh_j_d1 = 2200000;
    $mablaghj_d2 = 3400000;
    $mablagh_j_v_kkn_dn = 2200000;
    $mablagh_j_v_kad_dn = 3400000;
    $mablagh_j_v_r123_dn = 6700000;
    $mablagh_dn_15_16 = 2200000;
    $mablagh_dn_16_17 = 3400000;
    $mablagh_dn_17_b = 4500000;
    $tx_cm = $_POST['txtc_m'];
    $tx_cp = $_POST['txtc_pa'];
    $tx_dt = $_POST['txtd_tahsil'];
    $tx_modl = $_POST['txtmoadel'];
    $query_h = "SELECT `code_hesab` FROM info_f_hamkar WHERE info_f_hamkar.code_meli='$tx_cm'";
    $result_h = mysqli_query($con, $query_h);
    $cod_hesab_get = mysqli_fetch_assoc($result_h);
    $cod_hesab = $cod_hesab_get['code_hesab'];

    // insert into table tahsil
    if ($_POST['txtc_pa'] == true) {
    $query_3 = "insert into info_tahsil(code_paye, code_meli, moadel,sal_tahsil,img_karname ) values ('" . $_POST['txtc_pa'] . "','" . $_POST['txtc_m'] . "','" . $_POST['txtmoadel'] . "','" . $_POST['txtd_tahsil'] . "','$pic') ";
    $result_3 = mysqli_query($con, $query_3);
    // insert into table hazineh for dabestan
    if ($tx_cp == 1) {
    $query_1 = "insert into hazineh(code_meli,code_paye,sal_tahsil,date_akh_mad,mablagh ) values (' $tx_cm','$tx_cp','$tx_dt','$tx_dt',' $mablagh_db') ";
    // insert into table jayze for dabestan

    $result_4 = mysqli_query($con, $query_1);
    if ($tx_modl >= 19 or $tx_modl = 'خیلی خوب') {
    $q1 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_j_db')";
    $r1 = mysqli_query($con, $q1);

    }
    // insert into table hazineh for doreh aval
    } elseif ($tx_cp == 2) {
    $query_2 = "insert into hazineh(code_meli,code_paye,sal_tahsil,date_akh_mad,mablagh ) values (' $tx_cm','$tx_cp','$tx_dt','$tx_dt',' $mablagh_d1') ";

    $result_4 = mysqli_query($con, $query_2);
    // insert into table jayze for doreh aval

    if ($tx_modl >= 18) {
    $q1 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_j_d1')";
    $r1 = mysqli_query($con, $q1);

    }
    // insert into table hazineh for doreh dovom

    } elseif ($tx_cp == 3) {
    $query_3 = "insert into hazineh(code_meli,code_paye,sal_tahsil,date_akh_mad,mablagh ) values (' $tx_cm','$tx_cp','$tx_dt','$tx_dt',' $mablagh_d2') ";

    $result_4 = mysqli_query($con, $query_3);
    // insert into table jayze for doreh dovom
    if ($tx_modl >= 17) {
    $q1 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablaghj_d2')";
    $r1 = mysqli_query($con, $q1);

    }
    // insert into table hazineh for daneshgah

    } elseif ($tx_cp == 5) {
    $query_4 = "insert into hazineh(code_meli,code_paye,sal_tahsil,date_akh_mad,mablagh ) values (' $tx_cm','$tx_cp','$tx_dt','$tx_dt',' $mablagh_dn') ";
    $result_4 = mysqli_query($con, $query_4);
    }
    // insert into table jayze for vorood kardani be karshenasi daneshgah

    if ($tx_cp == 41) {
    $q1 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_j_v_kkn_dn')";
    $r1 = mysqli_query($con, $q1);
    // insert into table jayze for vorood  be karshenasi arshad daneshgah

    } elseif ($tx_cp == 42) {
    $q2 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_j_v_kad_dn')";
    $r1 = mysqli_query($con, $q2);


    // insert into table jayze for moadel daneshgah 15-16

    } elseif ($tx_modl >= 15 and $tx_modl <= 16 and $tx_cp == 5) {
    $q3 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_dn_15_16')";
    $r1 = mysqli_query($con, $q3);
    // insert into table jayze for moadel daneshgah 16-17

    } elseif ($tx_modl > 16 and $tx_modl <= 17 and $tx_cp == 5) {
    $q4 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_dn_16_17')";
    $r1 = mysqli_query($con, $q4);
    // insert into table jayze for moadel daneshgah >17

    } elseif ($tx_modl > 17 and $tx_cp == 5) {
    $q5 = "insert into jayze(code_meli, code_paye, date_akh_mad,code_hesab, mablagh) VALUES ('$tx_cm','$tx_cp','$tx_dt','$cod_hesab','$mablagh_dn_17_b')";
    $r1 = mysqli_query($con, $q5);

    }


    }

    }
    }

    ?>
    <?php

    //delete users on database whith admin
    if (isset($_GET['delete'])){
        $delete_id = sanitize($_GET['delete']);
        $con->query("DELETE FROM user WHERE user_id = '$delete_id'");
        $_SESSION['success_flash']= 'کاربر مورد نظر حذف کردید.';
    }
////report آمار تعداد و میزان کمک هزینه فرزندان به تفکیک مقاطع تحصیلی
    if (isset($_POST['txt_azsal'], $_POST['txt_tasal'],$_POST['submit_T_H'])){

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        ///////////// //dabestan
        $dabstan = "SELECT sum(mablagh),COUNT(code_meli) FROM hazineh WHERE code_paye=1 AND sal_tahsil BETWEEN '".$_POST['txt_azsal']."' AND '".$_POST['txt_tasal']."' ";
        $result_1= mysqli_query($con,$dabstan);
        $dabstan_row=mysqli_fetch_assoc($result_1);
        ////////// //doreh_aval  rahnamaei

        $doreh_aval = "SELECT sum(mablagh),COUNT(code_meli) FROM hazineh WHERE code_paye=2 AND sal_tahsil BETWEEN '".$_POST['txt_azsal']."' AND '".$_POST['txt_tasal']."' ";
        $result_1= mysqli_query($con,$doreh_aval);
        $doreh_aval_row=mysqli_fetch_assoc($result_1);

        ///////////doreh_dovom

        $doreh_dovom = "SELECT sum(mablagh),COUNT(code_meli) FROM hazineh WHERE code_paye=3 AND sal_tahsil BETWEEN '".$_POST['txt_azsal']."' AND '".$_POST['txt_tasal']."' ";
        $result_1= mysqli_query($con,$doreh_dovom);
        $doreh_dovom_row=mysqli_fetch_assoc($result_1);

        ////////////////tahsil_dar_daneshgah

        $tahsil_dar_daneshgah = "SELECT sum(mablagh),COUNT(code_meli) FROM hazineh WHERE code_paye=4 AND sal_tahsil BETWEEN '".$_POST['txt_azsal']."' AND '".$_POST['txt_tasal']."' ";
        $result_1= mysqli_query($con,$tahsil_dar_daneshgah);
        $tahsil_dar_daneshgah_row=mysqli_fetch_assoc($result_1);
        ////////////////////////sum
        $count_all=$dabstan_row['COUNT(code_meli)']+$doreh_aval_row['COUNT(code_meli)']+$doreh_dovom_row['COUNT(code_meli)']+$tahsil_dar_daneshgah_row['COUNT(code_meli)'];
        $sum_all=$dabstan_row['sum(mablagh)']+$doreh_aval_row['sum(mablagh)']+$doreh_dovom_row['sum(mablagh)']+$tahsil_dar_daneshgah_row['sum(mablagh)'];

        echo "<div id='save1' ><table border=\"1\" >
<tr><h4 align=\"center\">بسمه تعالی</h4></tr>
<tr><h3 align=\"center\">آمار تعداد و میزان کمک هزینه فرزندان به تفکیک مقاطع تحصیلی</h3></tr>
<tr><h3 align=\"center\">(سال تحصیلی ۹۶-۹۵)</h3></tr>
<tr><table ><tr><td align=\"right\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=\"right\"><h4 align=\"right\">:فرم شماره ۲</h4></td></tr></table></tr>
<tr><table  class=\"table table-bordered table-striped table-sm \" align='center' width=\"50%\" border=\"1\" dir=\"rtl\">
          <tr>
             <td>ردیف</td>
              <td>سال تحصیلی</td>
              <td>تعداد افراد مشمول کمک هزینه</td>
              <td>)میزان کمک هزینه پرداختی (ریال</td>
          </tr>
          <tr>
             <td>۱</td>
              <td>دبستان</td>
              <td>" . $dabstan_row['COUNT(code_meli)'] . "</td>
              <td>" . $dabstan_row['sum(mablagh)'] . "</td>
          </tr>
          <tr>
             <td>۲</td>
              <td>)دوره اول متوسطه (راهنمایی</td>
              <td>" . $doreh_aval_row['COUNT(code_meli)'] . "</td>
              <td>" . $doreh_aval_row['sum(mablagh)'] . "</td>
          </tr>
          <tr>
             <td>۳</td>
              <td>)دوره دوم متوسطه (دبیرستان و یا پیش دانشگاهی</td>
              <td>" . $doreh_dovom_row['COUNT(code_meli)'] . "</td>
              <td>" . $doreh_dovom_row['sum(mablagh)'] . "</td>
          </tr>
          <tr>
             <td>۴</td>
              <td>تحصیل در دانشگاه</td>
              <td>" . $tahsil_dar_daneshgah_row['COUNT(code_meli)'] . "</td>
              <td>" . $tahsil_dar_daneshgah_row['sum(mablagh)'] . "</td>
          </tr>
          <tr>
             
              <td colspan=\"2\">جمع کل: </td>
              <td>" . $count_all . "</td>
              <td>" . $sum_all . "</td>
          </tr>

</table></tr>
<tr><table align=\"center\">
<tr>
<td ><h5>ریاست یا معاونت اداره/اداره امور شعب/شعب مستقل 		</h5></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td ><h5>محل مهر و امضاء ریس یا معاون دایره اقدام کنده</h5></td>
</tr>
</table></tr>
</table></div>";


////report آمار تعداد و میزان جایزه فرزندان به تفکیک مقاطع تحصیلی

    }elseif(isset($_POST['txtj_azsal'], $_POST['txtj_tasal'],$_POST['submit_T_J'])) {


        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


        $dabstanj = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE  info_tahsil.moadel >= 19  AND info_tahsil.code_paye = 1 AND date_akh_mad BETWEEN '" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";

        $result_6 = mysqli_query($con, $dabstanj);
        $dabsrow = mysqli_fetch_assoc($result_6);
////////////////////////////////////////////
/// doreh_aval
        $doreh_avalj = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE ( info_tahsil.moadel >= 18 or info_tahsil.moadel= \"خیلی خوب\") AND info_tahsil.code_paye = 2 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $doreh_avalj);
        $doreh_avalj = mysqli_fetch_assoc($result_6);
        ///////////////////////////////
        /// doreh_dovim_j
        $doreh_dovomj = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE info_tahsil.moadel >= 17 AND info_tahsil.code_paye = 3 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $doreh_dovomj);
        $dore_dovomj = mysqli_fetch_assoc($result_6);
        /////////////////////////////////
        /// vorood_danshgah_KKN

        $vorood_danshgah_KKN = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE  info_tahsil.code_paye = 41 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $vorood_danshgah_KKN);
        $vorood_dansh_KKN = mysqli_fetch_assoc($result_6);
        /// vorood_danshgah_KAD
        $vorood_danshgah_KAD = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE  info_tahsil.code_paye = 42 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $vorood_danshgah_KAD);
        $vorood_dansh_KAD = mysqli_fetch_assoc($result_6);
        ///maghta_danesh 15 ta 16
        $magh_danesh_15_16 = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE (info_tahsil.moadel BETWEEN 15 AND 16) AND info_tahsil.code_paye = 5 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $magh_danesh_15_16);
        $magh_dan_15_16 = mysqli_fetch_assoc($result_6);
        ///maghta_danesh 16 ta 17
        $magh_danesh_16_17 = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE (info_tahsil.moadel BETWEEN 16 AND 17) AND info_tahsil.code_paye = 5 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $magh_danesh_16_17);
        $magh_dan_16_17 = mysqli_fetch_assoc($result_6);
        ///maghta_danesh 18 be bala
        $magh_danesh_17 = "SELECT sum(jayze.mablagh),COUNT(jayze.code_meli) FROM `jayze` INNER JOIN info_tahsil on info_tahsil.code_meli = jayze.code_meli WHERE info_tahsil.moadel >= 17 AND info_tahsil.code_paye = 5 AND date_akh_mad BETWEEN'" . $_POST['txtj_azsal'] . "' AND '" . $_POST['txtj_tasal'] . "'  ";
        $result_6 = mysqli_query($con, $magh_danesh_17);
        $magh_dan_17 = mysqli_fetch_assoc($result_6);
        ////////////////////////sum
        $count_all_j=$dabsrow['COUNT(jayze.code_meli)']+$doreh_avalj['COUNT(jayze.code_meli)']+$dore_dovomj['COUNT(jayze.code_meli)']+$vorood_dansh_KKN['COUNT(jayze.code_meli)']+$vorood_dansh_KAD['COUNT(jayze.code_meli)']+$magh_dan_15_16['COUNT(jayze.code_meli)']+$magh_dan_16_17['COUNT(jayze.code_meli)']+$magh_dan_17['COUNT(jayze.code_meli)'];
        $sum_all_j=$dabsrow['sum(jayze.mablagh)']+$doreh_avalj['sum(jayze.mablagh)']+$dore_dovomj['sum(jayze.mablagh)']+$vorood_dansh_KKN['sum(jayze.mablagh)']+$vorood_dansh_KAD['sum(jayze.mablagh)']+$magh_dan_15_16['sum(jayze.mablagh)']+$magh_dan_16_17['sum(jayze.mablagh)']+ $magh_dan_17['sum(jayze.mablagh)'];


        echo "<div id='save2'><table  class=\"table table-bordered table-striped table-sm \" width=\"750\" border=\"0\" dir=\"rtl\" align=\"center\" >
 
    <tr>
      <td>&nbsp;</td>
      <td><h4 align=\"center\">بسمه تعالی</h4></td>
      
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><h3 align=\"center\" border=\"0\">آمار تعداد و میزان جایزه فرزندان به تفکیک مقاطع تحصیلی</h3>
<h3 align=\"center\">(سال تحصیلی ۹۶-۹۵)</h3></td>
      
    </tr>
    <tr>
      <td></td>
      <td border=\"0\"><h4 align=\"right\">فرم شماره ۴:</h4><table><tbody></tbody></table></td>
      
    </tr>
    <tr>
      <td></td>
      <td colspan=\"1\"> <table width=\"90%\" border=\"4\" dir=\"rtl\" align=\"center\">
          <tbody><tr>
             <td>ردیف</td>
              <th colspan=\"3\">سال های تحصیلی</th>
              
              <td>تعداد افراد مشمول جایزه</td>
              <td>)میزان جایزه پرداختی (ریال</td>
          </tr>
          <tr>
             <td>۱</td>
              <th colspan=\"3\">دبستان</th>
              
              <td>".$dabsrow['COUNT(jayze.code_meli)'] ."</td>
              <td>".$dabsrow['sum(jayze.mablagh)']."</td>
          </tr>
          <tr>
             <td>۲</td>
              <th colspan=\"3\">)دوره اول متوسطه (راهنمایی</th>
              
               <td>".$doreh_avalj['COUNT(jayze.code_meli)'] ."</td>
              <td>".$doreh_avalj['sum(jayze.mablagh)']."</td>
          </tr>
          <tr>
             <td>۳</td>
              <th colspan=\"3\">)دوره دوم متوسطه (دبیرستان و یا پیش دانشگاهی</th>
               <td>".$dore_dovomj['COUNT(jayze.code_meli)'] ."</td>
              <td>".$dore_dovomj['sum(jayze.mablagh)']."</td>
              
          </tr>
           <tr height=\"20%\">
             <td rowspan=\"2\">۴</td>
              
               <th rowspan=\"2\">ورود به دانشگاه:</th>
              
              <td>کاردانی و کارشناسی ناپیوسته</td>
              
               <td style=\"border:none\"></td> 
                <td>".$vorood_dansh_KKN['COUNT(jayze.code_meli)'] ."</td>
              <td>".$vorood_dansh_KKN['sum(jayze.mablagh)']."</td>
              
              </tr><tr><td>کارشناسی، کارشناسی ارشد و دکترا</td>
              <td style=\"border:none\"></td> 
               <td>".$vorood_dansh_KAD['COUNT(jayze.code_meli)'] ."</td>
              <td>".$vorood_dansh_KAD['sum(jayze.mablagh)']."</td>
              </tr>
              
              
          
          <tr>
             <td rowspan=\"3\">۵</td>
              <th rowspan=\"3\">تحصیل در دانشگاه</th>
              
              <td>معدل ۱۵ تا ۱۶ (دو ترم متوالی)</td><td style=\"border:none\"></td>
               <td>".$magh_dan_15_16['COUNT(jayze.code_meli)'] ."</td>
              <td>".$magh_dan_15_16['sum(jayze.mablagh)']."</td>
              
              </tr><tr><td>معدل ۱۶ تا ۱۷ (دو ترم متوالی)</td><td style=\"border:none\"></td> 
               <td>".$magh_dan_16_17['COUNT(jayze.code_meli)'] ."</td>
              <td>".$magh_dan_16_17['sum(jayze.mablagh)']."</td>
              </tr>
              <tr><td>معدل ۱۷ به بالا (دو ترم متوالی)</td><td style=\"border:none\"></td> 
               <td>".$magh_dan_17['COUNT(jayze.code_meli)'] ."</td>
              <td>".$magh_dan_17['sum(jayze.mablagh)']."</td>
              </tr>
              
             
          
          <tr>
             
              <th colspan=\"3\">:جمع کل </th><td style=\"border:none\"></td> 
              
              <td>".$count_all_j."</td>
              <td>".$sum_all_j."</td>
          </tr>

</table></td>
      
    </tr>
    <tr>
      
      <td></td>
      <td><table  style=\"border:none\"><tbody><tr>&nbsp;</tr><tr>&nbsp;</tr><tr>&nbsp;</tr><tr>&nbsp;</tr><tr>&nbsp;</tr><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h5>محل مهر و امضاء ریس یا معاون دایره اقدام کنده</h5></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><h5>ریاست یا معاونت اداره/اداره امور شعب/شعب مستقل </h5></td></tr></tbody></table>  </td>
       
     
    </tr>
  </tbody>
</table></div>
";
///report
    }elseif(isset($_POST['submit_T_F_T'], $_POST['txtc_shobe'],$_POST['txt_cSetkh'])) {
        $C_stekh=$_POST['txt_cSetkh'];
        //echo $C_stekh;
        $T_F_T = "SELECT * FROM `info_f_hamkar` WHERE code_estekh = '$C_stekh'";
        $result_T = mysqli_query($con,$T_F_T);


        echo  "<table  class=\"table table-bordered table-striped table-sm \" id='save3' width='60%' border='1' dir='rtl' align='center' style='margin-top: 1%'>
                            <tr>
                            <td align='center'>نام</td>
                            <td align='center'>نام خانوادگی</td>
                            <td align='center'>کد ملی</td>
                            <td align='center'>تاریخ تولد</td>
</tr>
";
        while ($T_F_T_R = mysqli_fetch_assoc($result_T))
        {
            echo " <tr>
                            <td align='center'>".$T_F_T_R['fname']."</td>
                            <td align='center'>".$T_F_T_R['lname']."</td>
                            <td align='center'>".$T_F_T_R['code_meli']."</td>
                            <td align='center'>".$T_F_T_R['date_tavalod']."</td>
</tr>";
        }

        echo "</table>";
    }elseif(isset($_POST['submit1_N_R_J'], $_POST['txt_azsal'],$_POST['txt_tasal'])) {

        // echo "submit1_N_R_J";
        $N_R_J = "SELECT info_hamkar.Fname,info_hamkar.Lname ,info_hamkar.code_estekh,info_f_hamkar.fname,info_tahsil.code_paye, info_tahsil.moadel,jayze.mablagh,info_f_hamkar.code_hesab,info_tahsil.sal_tahsil
FROM `info_f_hamkar` 
	INNER JOIN info_hamkar ON info_hamkar.code_estekh= info_f_hamkar.code_estekh
    INNER JOIN info_tahsil ON info_tahsil.code_meli= info_f_hamkar.code_meli
    INNER 	JOIN jayze ON jayze.code_meli=info_f_hamkar.code_meli
    WHERE info_f_hamkar.code_estekh = info_hamkar.code_estekh  and info_tahsil.sal_tahsil BETWEEN '".$_POST['txt_azsal']."' AND '".$_POST['txt_tasal']."' and jayze.daryaft = 0
ORDER BY info_hamkar.code_estekh asc
";
        $result_N = mysqli_query($con,$N_R_J);


        echo  "<table  class=\"table table-bordered table-striped table-sm \"  width=\"800\" border=\"2\" dir=\"rtl\" align=\"center\" style='margin-top: 1%'>
    <tr style=\"border:0\" ><th style=\"border:0;text-align: center\"  colspan=\"4\" align=\"center\" width=\"100%\" height=\"50px\" >فهرست اسامی فرزندان مشمول دریافت جایزه تحصیلی</th></tr>

  <tbody>
    <tr>
      <th scope=\"col\" width=\"40\" >ردیف</th>
      <th scope=\"col\" width=\"220\">نام و نام خانوادگی همکار</th>
      <th scope=\"col\" width=\"80\" >شماره استخدامی</th>
     <td width=\"300\">
      <table width=\"100%\" dir=\"rtl\" border=\"1\" >
      <th colspan=\"3\" style=\"border:0\">مشخصات فرزند</th>
      <tr><td bordercolor=\"#000000\" align=\"center\" width=\"30\">نام</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"30\">کد</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"40\">مبلغ</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"90\">شماره حساب</td>
      </tr>
      </table>
      </td>
      
     
      <th scope=\"col\" width=\"110\" >جمع مبلغ به ریال</th>
    </tr>
   
";
        $sum_mablagh=0;
        $radif=1;
        while ($N_R_J_R = mysqli_fetch_assoc($result_N))
        {
            $cod_est_Befor=$N_R_J_R['fname'];

            echo "<tr>
      <td align='center'>".$radif."</td>
      <td align='center'>".$N_R_J_R['Fname']." ".$N_R_J_R['Lname']."</td>
      <td align='center'>".$N_R_J_R['code_estekh']."</td>
      ";
            echo "<td width=\"350\">
                          <table  class=\"table table-bordered table-striped table-sm \" width=\"100%\" dir=\"rtl\" border=\"none\" >
                          
                          <tr> <td align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['fname']."</td>
                          <td  align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['code_paye']."</td>
                          <td  align=\"center\" width=\"50\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['mablagh']."</td>
                          <td  align=\"center\" width=\"100\"  height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['code_hesab']."</td>
                          </tr>
                          </table>
                          </td>
                         ";



            // echo " ";

            echo " <td>".$N_R_J_R['mablagh']."</td>";
            $sum_mablagh=$sum_mablagh+ $N_R_J_R['mablagh'];

            echo " </tr>";
            $radif=$radif+1;
        }
        echo "<tr>
      <th colspan=\"4\">جمع کل</th>
 
      <td>$sum_mablagh</td>
</tr>";

        echo "</table>";

    }elseif(isset($_POST['submit2_N_R_H'], $_POST['txt_azsal'],$_POST['txt_tasal'])) {

        // echo "submit1_N_R_J";
        $N_R_H = "SELECT info_hamkar.Fname,info_hamkar.Lname ,info_hamkar.code_estekh,info_f_hamkar.fname,info_tahsil.code_paye, hazineh.mablagh,info_tahsil.sal_tahsil
FROM `info_f_hamkar` 
	INNER JOIN info_hamkar ON info_hamkar.code_estekh= info_f_hamkar.code_estekh
    INNER JOIN info_tahsil ON info_tahsil.code_meli= info_f_hamkar.code_meli
    INNER 	JOIN hazineh ON hazineh.code_meli=info_f_hamkar.code_meli
    WHERE info_f_hamkar.code_estekh = info_hamkar.code_estekh  and info_tahsil.sal_tahsil BETWEEN '". $_POST['txt_azsal']."' AND '". $_POST['txt_tasal']."' and hazineh.daryaft = 0
ORDER BY info_hamkar.code_estekh asc
";
        $result_N = mysqli_query($con,$N_R_H);


        echo "<table  class=\"table table-bordered table-striped table-sm \" width=\"800\" border=\"2\" dir=\"rtl\" align=\"center\" style='margin-top: 1%'>
  <tr  ><th  style=\"border:0;text-align: center\" colspan=\"7\" align=\"center\" width=\"100%\" height=\"50px\" >فهرست اسامی فرزندان مشمول دریافت جایزه تحصیلی</th></tr>

    <tr>
      <th scope=\"col\" width=\"30\" >ردیف</th>
      <th scope=\"col\" width=\"110\">نام و نام خانوادگی همکار</th>
      <th scope=\"col\" width=\"80\" >شماره استخدامی</th>
     <td width=\"300\">
      <table width=\"100%\" dir=\"rtl\" border=\"1\" >
      <th colspan=\"4\" style=\"border:0\">مشخصات فرزند</th>
      <tr><td bordercolor=\"#000000\" align=\"center\" width=\"30\">نام</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"30\">کد</td>
<td bordercolor=\"#000000\" align=\"center\" width=\"40\">مبلغ</td>
</tr>
      </table>
      </td>
<th scope=\"col\" width=\"110\" > مبلغ به ریال</th>
    </tr>  
";
        $sum_mablagh=0;
        $radif=1;
        while ($N_R_H_R = mysqli_fetch_assoc($result_N))
        {


            echo "<tr>
      <td align='center'>".$radif."</td>
      <td align='center'>".$N_R_H_R['Fname']." ".$N_R_H_R['Lname']."</td>
      <td align='center'>".$N_R_H_R['code_estekh']."</td>
      ";
            echo "<td width=\"350\">
                          <table  class=\"table table-bordered table-striped table-sm \" width=\"100%\" dir=\"rtl\" border=\"none\" >
                          
                          <tr> <td align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_H_R['fname']."</td>
                          <td  align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_H_R['code_paye']."</td>
                          <td  align=\"center\" width=\"50\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_H_R['mablagh']."</td>
                          </tr>
                          </table>
                          </td>
                         ";

            // echo " ";

            echo " <td>".$N_R_H_R['mablagh']."</td>";
            $sum_mablagh=$sum_mablagh+ $N_R_H_R['mablagh'];
            echo " </tr>";
            $radif=$radif+1;
        }
        echo "<tr>
      <th colspan=\"4\">جمع کل</th>
      
      <td>$sum_mablagh</td>
</tr>";

        echo "</table>";

    }elseif(isset($_POST['sunmit_R_H_J'], $_POST['code_meli'])) {


        $N_R_J = "SELECT info_hamkar.Fname,info_hamkar.Lname ,info_hamkar.code_estekh,info_f_hamkar.fname,jayze.code_paye, info_tahsil.moadel,jayze.mablagh,info_f_hamkar.code_hesab,info_tahsil.sal_tahsil,jayze.code_pay
FROM `info_f_hamkar`
INNER JOIN info_hamkar ON info_hamkar.code_estekh= info_f_hamkar.code_estekh
INNER JOIN info_tahsil ON info_tahsil.code_meli= info_f_hamkar.code_meli
INNER 	JOIN jayze ON jayze.code_meli=info_f_hamkar.code_meli
WHERE info_f_hamkar.code_estekh = info_hamkar.code_estekh  and info_tahsil.sal_tahsil BETWEEN 95 and 98 AND info_f_hamkar.code_meli = '". $_POST['code_meli']."' AND jayze.daryaft= 1
";



        $result_N = mysqli_query($con,$N_R_J);


        echo  "<table  class=\"table table-bordered table-striped table-sm \"  width=\"800\" border=\"2\" dir=\"rtl\" align=\"center\" style='margin-top: 1%'>
  <tbody>
    <tr>
      <th scope=\"col\" width=\"40\" >ردیف</th>
      <th scope=\"col\" width=\"220\">نام و نام خانوادگی همکار</th>
      <th scope=\"col\" width=\"80\" >شماره استخدامی</th>
     <td width=\"300\">
      <table width=\"100%\" dir=\"rtl\" border=\"1\" >
      <th colspan=\"3\" style=\"border:0\">مشخصات فرزند</th>
      <tr><td bordercolor=\"#000000\" align=\"center\" width=\"30\">نام</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"30\">کد</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"30\">معدل</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"40\">مبلغ</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"90\">شماره حساب</td>
       <td bordercolor=\"#000000\" align=\"center\" width=\"90\">کد پرداخت</td>
      </tr>
      </table>
      </td>
      
     
      <th scope=\"col\" width=\"110\" >جمع مبلغ به ریال</th>
    </tr>
   
";
        $sum_mablagh=0;
        $radif=1;
        while ($N_R_J_R = mysqli_fetch_assoc($result_N))
        {
            $cod_est_Befor=$N_R_J_R['fname'];

            echo "<tr>
      <td align='center'>".$radif."</td>
      <td align='center'>".$N_R_J_R['Fname']." ".$N_R_J_R['Lname']."</td>
      <td align='center'>".$N_R_J_R['code_estekh']."</td>
      ";
            echo "<td width=\"350\">
                          <table  class=\"table table-bordered table-striped table-sm \" width=\"100%\" dir=\"rtl\" border=\"none\" >
                          
                          <tr> <td align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['fname']."</td>
                          <td  align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['code_paye']."</td>
                          <td  align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['moadel']."</td>
                          <td  align=\"center\" width=\"50\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['mablagh']."</td>
                          <td  align=\"center\" width=\"100\"  height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['code_hesab']."</td>
                          <td  align=\"center\" width=\"100\"  height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_J_R['code_pay']."</td>
                          </tr>
                          </table>
                          </td>
                         ";
            $c=0;




            echo " <td>".$N_R_J_R['mablagh']."</td>";
            $sum_mablagh=$sum_mablagh+ $N_R_J_R['mablagh'];

            echo " </tr>";
            $radif=$radif+1;
        }
        echo "<tr>
      <th colspan=\"4\">جمع کل</th>
    
      <td>$sum_mablagh</td>
      
      
</tr>";

        echo "</table>";

    }elseif(isset($_POST['submit_H_R_Ham'], $_POST['az_tarikh'],$_POST['ta_tarikh'],$_POST['codeـestkh'])) {

        $N_R_H = "SELECT info_hamkar.Fname,info_hamkar.Lname ,info_hamkar.code_estekh,info_f_hamkar.fname,hazineh.code_paye, info_tahsil.moadel,hazineh.mablagh,info_tahsil.sal_tahsil
FROM `info_f_hamkar` 
INNER JOIN info_hamkar ON info_hamkar.code_estekh= info_f_hamkar.code_estekh 
INNER JOIN info_tahsil ON info_tahsil.code_meli= info_f_hamkar.code_meli 
INNER JOIN hazineh ON hazineh.code_meli=info_f_hamkar.code_meli
WHERE info_f_hamkar.code_estekh = info_hamkar.code_estekh and info_tahsil.sal_tahsil
BETWEEN '".$_POST['az_tarikh']."' and '".$_POST['ta_tarikh']."'  AND info_f_hamkar.code_estekh = '".$_POST['codeـestkh']."' and hazineh.daryaft = 0
";
        $result_N = mysqli_query($con,$N_R_H);

        echo "<table  class=\"table table-bordered table-striped table-sm \" width=\"800\" border=\"2\" dir=\"rtl\" align=\"center\" style='margin-top: 1%'>
  
    <tr>
      <th scope=\"col\" width=\"40\" >ردیف</th>
      <th scope=\"col\" width=\"130\">نام و نام خانوادگی همکار</th>
      <th scope=\"col\" width=\"80\" >شماره استخدامی</th>
     <td width=\"300\">
      <table width=\"100%\" dir=\"rtl\" border=\"1\" >
      <th colspan=\"3\" style=\"border:0\">مشخصات فرزند</th>
      <tr><td bordercolor=\"#000000\" align=\"center\" width=\"30\">نام</td>
      <td bordercolor=\"#000000\" align=\"center\" width=\"30\">کد</td>
<td bordercolor=\"#000000\" align=\"center\" width=\"40\">مبلغ</td>
</tr>
      </table>
      </td>
<th scope=\"col\" width=\"110\" > مبلغ به ریال</th>
    </tr>  
";
        $Sum_mablagh=0;
        $radif=1;
        while ($N_R_H_R = mysqli_fetch_assoc($result_N))
        {


            echo "<tr>
      <td align='center'>".$radif."</td>
      <td align='center'>".$N_R_H_R['Fname']." ".$N_R_H_R['Lname']."</td>
      <td align='center'>".$N_R_H_R['code_estekh']."</td>
      ";
            echo "<td width=\"350\">
                          <table  class=\"table table-bordered table-striped table-sm \" width=\"100%\" dir=\"rtl\" border=\"none\" >
                          
                          <tr> <td align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_H_R['fname']."</td>
                          <td  align=\"center\" width=\"40\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_H_R['code_paye']."</td>
                          <td  align=\"center\" width=\"50\" height=\"20\" style=\" border-left:inset; border-bottom:none; border-top:none; border-right:none\" align='center'>".$N_R_H_R['mablagh']."</td>
                         
                          </tr>
                          </table>
                          </td>
                         ";


            echo " <td>".$N_R_H_R['mablagh']."</td>";
            $Sum_mablagh = $Sum_mablagh + $N_R_H_R['mablagh'] ;
            echo " </tr>";
            $radif=$radif+1;

        }

        echo "<tr>
      <th colspan=\"4\">جمع کل</th>
      
      <td>$Sum_mablagh</td>
</tr>";

        echo "</table>";
    }
    if (!empty($errors)){
    echo display_errors( $errors);}
    ?>



</div>


</body>

<?php
include 'footer.php';
?>


</div>