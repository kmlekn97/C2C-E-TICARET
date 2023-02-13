
<?php 

require_once 'header.php'; 

islemanakontrol();

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
       $text=array("İşlem Başarısız"," Marka Başvurunuz Alınmıştır...");
       $button_types=array("danger","success");
       $formpanel->Durum_liste($value,$text,$key,$button_types);

       ?>
       <script src="js/jquery-footer.js"></script>


       <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Marka Ekleme</h2>
            <div class="personal-info inner-page-padding"> 

              <?php

              $formpanel->Kategori_listele();
              $formpanel->Alt_Kategori_listele("alt_kategori_id","Alt Kategori");
              $formpanel->Alt_Kategori_Detay_Listele("alt_kategori_detay_id","Alt Kategori İçerik");
              $formpanel->TextBox("marka_adi",null,"Adı",true,null,"Marka Adı...");

              ?>

              <input type="hidden" name="kullanici_id" value="<?php echo $kullanicilarim->get_kullanici_id() ?>">

              <?php 

              $formpanel->Button("update-btn","magazamarkaekle","login-update","Marka Ekle","Bu Markayı Eklemek istiyormusunuz? İşlem geri alınamaz...");

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


<?php require_once 'footer_sorgulu.php'; ?>
