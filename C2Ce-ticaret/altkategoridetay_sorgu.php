<?php
require_once 'nedmin/netting/kategori-sorgula.php';
$ksorgu=new Kategori();

$kategorilerim=$dbservice->AltKategoriDetayListelemetekil();

$sayfada = 1;
$sorgu=$dbservice->PacinationAltKategoriDetay($where);
$toplam_icerik=$sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;

$toplam_urun=0;
$where="";
$ozellik="";
$ozellikadet=0;

$ozellikvarmi=0;
$ozellikgroup=0;
$ozellikgroupadet=0;

$arraylist=array();
$ozelliklist=new ArrayList($arraylist);
$ozellikliste=$dbservice->Urunozelliklistele();
$ozellikliste=$ozellikliste->toArray();

foreach ($ozellikliste as $urunozelliklerim) 
{
 $ozellik="";
 $ozellik.=seo($urunozelliklerim->get_ozellik_adi()).',';  
 $ozellikdizi=explode(",",$ozellik);
 $ozellikadet=count($ozellikdizi);
 for ($i=0; $i<$ozellikadet; $i++)
 {
   if (htmlspecialchars(isset($_GET[$ozellikdizi[$i]])))
   {
     $ozellikvarmi=1;
     $ozellikgroupadet++;
   }

 }
}

if ($ozellikvarmi==1)
{

  $where.=$ksorgu->sorgula(htmlspecialchars($_GET['alt_kategori_detay_id']),1,2); 


  $where.=$dbservice->AltKategoriDetaySorguAdd();

  if ($ozellikgroupadet>1)
    $ozellikgroup=1;
  else
    $ozellikgroup=0;

  $order=$dbservice->OzellikOrder();

  $adet=$dbservice->pagealtkategoridetayadet($order,$where,"sfsf");

  $urunsor=$dbservice->AltKategoridetaytumUrunlerilistele($ozellikgroup,$where,$order,$limit,$sayfada);

  $say=$urunsor->rowCount();
  $toplam_urun=$urunsor->rowCount();

  if ($say==0) {
                                            //echo "Bu kategoride ürün Bulunamadı";
  }
}

else if (htmlspecialchars(isset($_GET['renk'])) || htmlspecialchars(isset($_GET['fiyat'])) || htmlspecialchars(isset($_GET['marka'])) || htmlspecialchars(isset($_GET['beden'])))
{

  $where.=$ksorgu->sorgula(htmlspecialchars($_GET['alt_kategori_detay_id']),0,2); 

  if ($kategorilerim->get_kategori_id()==13)
  {
    $where=$dbservice->SiralamaSorguelektronik($where);
  }
  else
  {
    $where=$dbservice->SiralamaSorgu($where);
  }
  $adet=$dbservice->pagealtkategoridetayadet($order,$where,"sfsf");
  $durum=0;

  if (htmlspecialchars(isset($_GET['siralama'])))
  {
   if (htmlspecialchars($_GET['siralama'])=="ASC") {
   }
   else if (htmlspecialchars($_GET['siralama'])=="DESC") {
   }
   else if (htmlspecialchars($_GET['siralama'])=="yeni") {
   }
   else{

    $adet=$dbservice->pagealtkategoridetaycoksatanadet($order,$where,"dad");

    if ($adet != 0){
      $urunsor=$dbservice->GenelSorgulualtkategoridetay($where,$limit,$sayfada);
      $say=$urunsor->rowCount();
      $toplam_urun=$urunsor->rowCount();
      
    }
    else{
      $say=0;
      $toplam_urun=0;
    }

    $durum=1;

    if ($say==0) {
        //echo "Bu kategoride ürün Bulunamadı";
    }
  }   
}

if ($durum==0)
{
 $urunsor=$dbservice->altkategoridetayurundurumsifir($where,$limit,$sayfada);

 $say=$urunsor->rowCount();
 $toplam_urun=$urunsor->rowCount();

 if ($say==0) {
  //echo "Bu kategoride ürün Bulunamadı";
 }
}


}


else
{
  if (htmlspecialchars(isset($_GET['alt_kategori_detay_id']))) {

    if ($kategorilerim->get_kategori_id()==13)
    {
      $where=$dbservice->SiralamaSorguelektronik($where);
    }
    else
    {
      $where=$dbservice->SiralamaSorgu($where);
    }

    $adet=$dbservice->pagealtkategoridetayadet($order);

    $durum=0;

    if (htmlspecialchars(isset($_GET['siralama'])))
    {
      if (htmlspecialchars($_GET['siralama'])=="ASC") {
      }
      else if (htmlspecialchars($_GET['siralama'])=="DESC") {
      }
      else if (htmlspecialchars($_GET['siralama'])=="yeni") {
      }
      else 
      {
        $adet=$dbservice->pagealtkategoridetaycoksatanadet($order);
        $urunsor=$dbservice->altkategorilimit($where,$sayfada,$limit);
        $say=$urunsor->rowCount();
        $adet=$say;
        $toplam_urun=$urunsor->rowCount();

        $durum=1;

        if ($say==0) {
          //echo "Bu kategoride ürün Bulunamadı";
        }
      }   


    }
    if ($durum==0)
    {
      $urunsor=$dbservice->altkategorilimitkosullu($where,$sayfada,$limit);
      $say=$urunsor->rowCount();
      $toplam_urun=$urunsor->rowCount();



      if ($urunsor==0) {
                                            //echo "Bu kategoride ürün Bulunamadı";
      }
    }


  } else {

    $urunsor=$dbservice->altkategorilimitkosullucoksatan($where,$sayfada,$limit);
    $say=$urunsor->rowCount();
    $toplam_urun=$urunsor->rowCount();

    if ($say==0) {
                                            //echo "Bu kategoride ürün Bulunamadı";
    }



  }
  if (htmlspecialchars($_GET['siralama'])!="coksatanlar")
  {
    $adet=$dbservice->pagealtkategoridetayadet($order,$where);
  }
  else
  {
    $adet=$dbservice->pagealtkategoridetaycoksatanadet($where);
  }
  
}
echo "<b> $adet Adet Ürün Listelendi...</b> <br>";

$toplam_icerik=$adet;
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;

?>