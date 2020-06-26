<?php
require_once '../dbcon.php';
unset($_SESSION['SBUser']);
header('Location: login.php');