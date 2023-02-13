<?php 
session_start();
unset($_SESSION['kullanici_id']);
if ($_COOKIE['remmeber_me']==0)
setcookie("adminsLogin",json_encode($admins),strtotime("-30 day"),"/");	
setcookie("oturumdurum",1,strtotime("-30 day"),"/");
session_destroy();
header("Location:login.php?durum=exit");

 ?>