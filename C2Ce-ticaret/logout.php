<?php
session_start();
unset($_SESSION['userkullanici_id']);
if ($_COOKIE['remmeber_me']==0)
setcookie("userLogin",json_encode($admins),strtotime("-30 day"),"/");	
setcookie("oturumdurum",1,strtotime("-30 day"),"/");
session_destroy();
header("Location:login.php?durum=exit");

?>