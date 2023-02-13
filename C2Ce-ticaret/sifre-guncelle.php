
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

              $value=array("farklisifre","eksiksifre","mukerrerkayit","basarisiz");
              $key=array("Hata!","Hata!","Hata!","Hata!");
              $text=array("Girdiğiniz şifreler eşleşmiyor.","Şifreniz minimum 6 karakter uzunluğunda olmalıdır.","Bu kullanıcı daha önce kayıt edilmiş.","Kayıt Yapılamadı Sistem Yöneticisine Danışınız.");
              $button_types=array("danger","danger","danger","danger");
              $formpanel->Durum_liste($value,$text,$key,$button_types);

              ?> 


              <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Şifre Güncelleme</h2>
                        <div class="personal-info inner-page-padding"> 

                            <?php

                            $formpanel->PasswordText("kullanici_eskipassword",null,"Eski Şifre","Eski Şifrenizi Giriniz");
                            $formpanel->PasswordText("kullanici_passwordone",null,"Şifreniz","Şifrenizi Giriniz");
                            $formpanel->PasswordText("kullanici_passwordtwo",null,"Şifreniz Tekrar","Şifrenizi Tekrar Giriniz");
                            $formpanel->Button("update-btn","musterisifreguncelle","login-update","Şifre Güncelle");

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