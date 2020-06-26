<?php

//echo eroros
function display_errors($errors){
    $display= '<ul class="bg-danger" style="background-color: #cd3421;color: #c6cdc2">';
    foreach ($errors as $error){
        $display.='<li class="text-danger">'.$error.'</li>';
    }
    $display.='</ul>';
    return $display;
}
//check for sql injction
function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");

}
//func for login and inser time/date enter in database
function login($user_id){
    $_SESSION['SBUser']= $user_id;
    global $con ;
    $date = date("Y-m-d H:i:s");
    $con->query("UPDATE user SET last_login ='$date' WHERE user_id ='$user_id'");
    $_SESSION['success_flash'] = 'شما وارد شدید';
    header('Location: ../index.php');
}
//func for check login
function is_logged_in(){

    if (isset($_SESSION['SBUser']) && $_SESSION['SBUser']>0){
        return true;
    }
    return false;
}
//func for don`t have permission
function permission_error_redirect($url = './admin/login.php'){
    $_SESSION['error_flash'] = 'شما اجازه دسترسی به این صفحه را ندارید!';
    header('Location: '.$url);
}

function login_error_redirect($url = './admin/login.php'){
    $_SESSION['error_flash'] = 'شما باید برا دسترسی وارد  شوید';
    header('Location: '.$url);
}

function has_permission($permission = 'admin'){
    global $user_data;
    $permissions = explode(',', $user_data['permissions']);//var_dump($permissions);die();
    if (in_array($permission,$permissions,true)){
        return true;
    }
    return false;
}
//func for change date miladi to jalali
function pertty_date($date){
    $Y=date(date("Y ",strtotime($date)));
    $m=date(date("m ",strtotime($date)));
    $d=date(date("d ",strtotime($date)));
    return gregorian_to_jalali($Y,$m,$d,'/');
   // return gregorian_to_jalali(date("Y,m,d ",strtotime($date)));
}
function pertty_time($time){
    
    return date("h:i A",strtotime($time));
}
date_default_timezone_set('Asia/Tehran');

function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy>1600){
        $jy=979;
        $gy-=1600;
    }else{
        $jy=0;
        $gy-=621;
    }
    $gy2=($gm>2)?($gy+1):$gy;
    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
    $jy+=33*((int)($days/12053));
    $days%=12053;
    $jy+=4*((int)($days/1461));
    $days%=1461;
    if($days > 365){
        $jy+=(int)(($days-1)/365);
        $days=($days-1)%365;
    }
    $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
    $jd=1+(($days < 186)?($days%31):(($days-186)%30));
    return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}
