<?php
error_reporting(0);

$searchkeyword=(rtrim($_POST['kelime']));
function ara($deger,$kelimegelen,$metin,$value)
{

	require_once 'nedmin/netting/class.crud-guncel.php';
	require_once 'services/DBService.php';
	$dbsql=new crud();
	$dbservice=new DBService($dbsql,$cons);

	$arasor=$dbservice->searchpost($kelimegelen,$deger);
	while ($aracek=$arasor->fetch(PDO::FETCH_ASSOC))
	{
		echo "<div class='kelime' onClick='tamamla(\"".$aracek[$value]."\")'>".$aracek[$value]."         <b>$metin</b>"."</div>";
		echo "<br>";
	}
}

if (strlen($searchkeyword)>2)
{
	ara("urun.urun_ad",$searchkeyword,"ÜRÜN","urun_ad");
	ara("marka.marka_adi",$searchkeyword,"MARKA","marka_adi");
	ara("kategori.kategori_ad",$searchkeyword,"KATEGORİ","kategori_ad");

}

else
{
	echo "";
}



?>