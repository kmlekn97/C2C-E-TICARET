<?php
$toplam_urun=0;
require_once 'nedmin/netting/kategori-sorgula.php';
$ksorgu=new Kategori();
$getirilen_say=0;

$kategorilerim=$dbservice->AltKategoriListelemetekil();
$sayfada = 2; 
$sorgu=$dbservice->PacinationAltKategori($where);
$toplam_icerik=$sorgu->rowCount();
$getirilen_say+=$toplam_icerik;
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;
if (htmlspecialchars(isset($_GET['renk'])) || htmlspecialchars(isset($_GET['fiyat'])) || htmlspecialchars(isset($_GET['marka'])) || htmlspecialchars(isset($_GET['beden'])))
{

    $where="";
    $where.=$ksorgu->sorgula(htmlspecialchars($_GET['alt_kategori_id']),0,1);

    if ($kategorilerim->get_kategori_id()==13)
    {
        $where=$dbservice->SiralamaSorguelektronik($where);
    }
    else
    {
        $where=$dbservice->SiralamaSorgu($where);
    }
    $adet=$dbservice->pagealtkategoriadet($where,"sfsf");

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

         $urunsor=$dbservice->Altkategoricoksatan($where,$limit,$sayfada);
         $say=$urunsor->rowCount();
         $toplam_urun=$urunsor->rowCount();
         $adet=$dbservice->pagealtkategoricoksatanadet($where,"sfsf");
         $adet=$say;
         $durum=1;

         if ($say==0) {
         }
     }   
 }


 if ($durum==0)
 {

    $urunsor=$dbservice->AltKategoriSorguluurunListeleme($where,$limit,$sayfada);
    $say=$urunsor->rowCount();
    $toplam_urun=$urunsor->rowCount();

    if ($say==0) {
    }
}
}

else
{

    if (htmlspecialchars(isset($_GET['alt_kategori_id']))) {
        $durum=0;
        if ($kategoricek['kategori_id']==13)
        {
           $where=$dbservice->SiralamaSorguelektronik($where);
       }
       else
       {
        $where=$dbservice->SiralamaSorgu($where);

    }

    $adet=$dbservice->pagealtkategoriadet();

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
            $urunsor=$dbservice->Altkategoricoksatanlimitli($where,$limit,$sayfada);
            $say=$urunsor->rowCount();
            $toplam_urun=$urunsor->rowCount();
            $adet=$dbservice->pagealtkategoricoksatanadet();
            $durum=1;

            if ($say==0) {
            }
        }   
    }
    if ($durum==0)
    {

        $urunsor=$dbservice->AltkategoriGenelurunListeleme($where,$sayfada,$limit);
        $say=$urunsor->rowCount();
        $toplam_urun=$urunsor->rowCount();



        if ($say==0) {
                                            //echo "Bu kategoride ürün Bulunamadı";
        }
    }

} else {

    $urunsor=$dbservice->AltkategoriGenelurunlistelesorgusuz($sayfada,$limit);
    $say=$urunsor->rowCount();
    $toplam_urun=$urunsor->rowCount();

    if ($say==0) {
    }
}
if (htmlspecialchars($_GET['siralama'])!="coksatanlar")
{
  $adet=$dbservice->pagealtkategoriadet($where);
}
else
{
  $adet=$dbservice->pagealtkategoricoksatanadet($where);
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