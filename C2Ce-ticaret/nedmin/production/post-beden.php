<?php
require_once '../netting/baglan.php';
require_once 'CLASS/Sınıf_Islem.php';
require_once '../netting/class.crud-guncel.php';
$dbsql=new crud();
$cons=new Sınıf_Islem();
require_once '../../services/AdminDBServices.php';
$admindbservices=new AdminDBServices($dbsql,$cons);
$beden=htmlspecialchars($_POST["beden"]);
echo '<option>'."Bir Beden Seçiniz...".'</option>';
$arraylistbeden=array();
$bedenlist=new ArrayList($arraylistbeden);
$bedenlist=$admindbservices->postbedenListele($beden);
$bedenlist=$bedenlist->toArray();
foreach ($bedenlist as $bedenlerim) 
{

  echo '<option value="'.$bedenlerim->get_beden_id().'">'.$bedenlerim->get_beden_icerik().'</option>';
}

?>