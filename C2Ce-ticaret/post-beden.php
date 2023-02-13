<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$dbsql=new crud();
$cons=new Sınıf_Islemleri();
$dbservice=new DBService($dbsql,$cons);
$beden=htmlspecialchars($_POST["beden"]);
$arraylistbeden=array();
$bedenlist=new ArrayList($arraylistbeden);
$bedenlist=$dbservice->bedenlistelemepost($beden);
$bedenlist=$bedenlist->toArray();
foreach ($bedenlist as $bedenlerim) 
{
	if($adet==0)
	{
		echo '<option>'."Bir Beden Seçiniz...".'</option>';
		$adet++;
	}
	echo '<option value="'.$bedenlerim->get_beden_id().'">'.$bedenlerim->get_beden_icerik().'</option>';
}

?>