
<?php 

require_once 'header.php'; 
require_once 'CLASS/Siparis.php';
require_once 'CLASS/Iade.php';
require_once 'CLASS/Urun.php';
require_once 'CLASS/Marka.php';
require_once 'CLASS/Renk.php';
require_once 'CLASS/Beden.php';

islemanakontrol();

$siparissor=$dbservice->SiparisListeleme();
$sipariscek=$dbservice->vericek($siparissor);

$urunlerim=$cons->Urun_ekle($sipariscek);
$kullanicilarim=$cons->Kullanici_ekle($sipariscek);
$siparislerim=$cons->Siparis_ekle($sipariscek);
$siparis_detaylarim=$cons->Siparis_Detay_ekle($sipariscek);
//$iadelerim=$cons->Iade_ekle($sipariscek);

$arraylistmarka=array();
$markalist=new ArrayList($arraylistmarka);
$markalist=$dbservice->Markalari_getir($urunlerim->get_marka_id());
$markalist=$markalist->toArray();
foreach ($markalist as $markalarim)
{
  $marka=$markalarim->get_marka_adi();
}

$arraylistrenk=array();
$renkliste=new ArrayList($arraylistrenk);
$renkliste=$dbservice->Renkleri_getir($urunlerim->get_renk_id());
$renkliste=$renkliste->toArray();
foreach ($renkliste as $renklerim) 
{
  $renk=$renklerim->get_renk_adi();
}

$arraylistbeden=array();
$bedenlist=new ArrayList($arraylistbeden);
$bedenlist=$dbservice->bedenlisteleme($urunlerim->get_beden_id());
$bedenlist=$bedenlist->toArray();
foreach ($bedenlist as $bedenlerim) 
{
  $beden=$bedenlerim->get_beden_icerik();
}

?>



<!-- Header Area End Here -->

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">



    <div class="row settings-wrapper">


      <?php require_once 'hesap-sidebar.php' ?>


      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

        <?php

        $value=array("hata","ok");
        $key=array("Hata!","Bilgi!");
        $text=array("İşlem Başarısız","İade Başvurunuz Alınmıştır...");
        $formpanel->Durum_cek($value,$text,$key);

        ?>


      <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">İADE</h2>
            <div class="personal-info inner-page-padding"> 


              <center> <b> <?php  echo " ".$urunlerim->get_urun_ad()." ".$marka." ".$renk." ".$beden." ".$urunlerim->get_barkod_no(); ?></b></center>


              <div class="form-group">
                <label class="col-sm-3 control-label">İade Edilecek Ürün</label>
                <div class="col-sm-9">
                 <img width="200" src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>">
               </div>
             </div>

             <?php 
             
             $turler=array("Değişim","Para İadesi");
             $formpanel->ComboBox($turler,"İade Türü Seçiniz...","İade Türü ","iade_turu","select1");
             $formpanel->TextArea("iade_detay",null,"Açıklama",null,null,"ckeditor");

             ?>

          <input type="hidden" name="siparisdetay_id" value="<?php echo $siparis_detaylarim->get_siparisdetay_id(); ?>"> 


          <input type="hidden" name="siparis_id" value="<?php echo htmlspecialchars($_GET['siparis_id']) ?>"> 

          <input type="hidden" name="kullanici_id" value="<?php echo $kullanicilarim->get_kullanici_id() ?>"> 


          <input type="hidden" name="urun_id" value="<?php echo $urunlerim->get_urun_id() ?>"> 



          <?php

          $formpanel->Button("update-btn","iade_basvuru","login-update","Ürün İade","Bu Ürünü İade Etmek istiyormusunuz? İşlem geri alınamaz...");

          ?>     

       </div> 
     </div> 



   </div> 

 </form> 
</div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>