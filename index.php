<?php
session_start();
function base_url()
{   
    return "http://localhost/Tmtopup_Generator/"; //URL ของโฟเดอร์ที่เก็บไฟล์นี้
}
define("BASEPATH",dirname(__FILE__));

if(!empty($_SESSION['usegen']))
{
    require_once BASEPATH . DIRECTORY_SEPARATOR . "tmt" . DIRECTORY_SEPARATOR . "gen.php"; //กรณีมี session
}
else
{
    $error = "คุณไม่ได้รับสิทธิ์ให้เข้าใช้หน้านี้";
    require_once BASEPATH . DIRECTORY_SEPARATOR . "tmt" . DIRECTORY_SEPARATOR . "error.php"; //Require ไฟล์
}