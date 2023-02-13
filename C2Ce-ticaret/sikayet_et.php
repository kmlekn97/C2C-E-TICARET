<?php 
require_once 'header.php';
$kullanicicek=$dbservice->karsilastirurunListele(htmlspecialchars($_GET['urun_id']));
$kullanicilarim=$cons->Kullanici_ekle($kullanicicek);
$urunlerim=$cons->Urun_ekle($kullanicicek);
$durum=0;
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
        $text=array("İşlem Başarısız","Şikayet Başvurunuz Alınmıştır...");
        $button_types=array("danger","success");
        $formpanel->Durum_liste($value,$text,$key,$button_types);

        if ($durum==0)
        {
          ?>

          <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

            <div class="settings-details tab-content">
              <div class="tab-pane fade active in" id="Personal">
                <h2 class="title-section">ŞİKAYET</h2>
                <div class="personal-info inner-page-padding"> 


                  <?php

                  $formpanel->TextArea("sikayet_nedeni",null,"Şikayet Nedeni:",null,null,"ckeditor",true);

                  ?>

                <input type="hidden" name="kullanici_id" value="<?php echo $kullanicilarim->get_kullanici_id() ?>"> 

                <?php

                $formpanel->Button("update-btn","sikayet_basvuru","login-update","Mağaza Şikayet","Bu Mağazayı Şikayet Etmek istiyormusunuz? İşlem geri alınamaz...");

                ?>
   

             </div> 
           </div> 



         </div> 

       </form> 
     <?php } ?>
   </div>  
 </div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>