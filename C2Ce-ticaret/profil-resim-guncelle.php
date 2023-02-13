
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
               $text=array("İşlem Başarısız","İşlem Başarılı");
               $button_types=array("danger","success");
               $formpanel->Durum_liste($value,$text,$key,$button_types);

               ?> 

            <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Profil Resim Güncelleme</h2>
                        <div class="personal-info inner-page-padding"> 

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mevcut Resim</label>
                                <div class="col-sm-9">
                                    <img  src="<?php echo $kullanicilarim->get_kullanici_magazafoto(); ?>">
                                </div>
                            </div>

                            <?php

                            $formpanel->FileChooser("kullanici_magazafoto","Profil Resminizi Seçiniz");

                            ?>

                            <input type="hidden" name="eski_yol" value="<?php echo $kullanicicek['kullanici_magazafoto'] ?>">

                            <?php $formpanel->Button("update-btn","kullaniciresimguncelle","login-update","Güncelle"); ?>

                         </div>                                        
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