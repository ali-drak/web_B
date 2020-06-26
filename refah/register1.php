<?php
include('dbcon.php');

include 'header.php';
//check for logined or not
if (!is_logged_in()){
    header('Location: admin/logout.php');
}
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

        echo 'امکان ثبت وجود ندارد. برای ثبت به مرکز مراجعه نمایید. ';
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

<!--<script>
	alert('مشخصات ثبت شد!');
	window.location = 'index.php';
</script>-->