
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


         <?php 
         require_once 'hesap-sidebar.php'; 
         ?>


         <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

            <?php

            $value=array("hata","ok");
            $key=array("Hata!","Bilgi!");
            $text=array("İşlem Başarısız","Kayıt Başarılı...");
            $formpanel->Durum_cek($value,$text,$key);

            ?>

            <?php 

            if ($kullanicilarim->get_kullanici_magaza() ==1 &&  $kullanicilarim->get_magaza_adi() != ""){?>

                <div class="alert alert-danger">
                    <strong>Bilgi!</strong> Mağaza Blokeli
                </div>                   

            <?php }
            ?>


            <form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Hesap Bilgilerimi Düzenle</h2>
                        <div class="personal-info inner-page-padding"> 


                            <?php 

                            $formpanel->TextBox("mail_adres",$kullanicilarim->get_kullanici_mail(),"Kayıtlı Mail (Değiştiremezsiniz)",null,"disabled");
                            $formpanel->TextBox("kullanici_ad",$kullanicilarim->get_kullanici_ad(),"Ad");
                            $formpanel->TextBox("kullanici_soyad",$kullanicilarim->get_kullanici_soyad(),"Soyad");
                            $formpanel->TextBox("kullanici_gsm",$kullanicilarim->get_kullanici_gsm(),"Telefon GSM");
                            $formpanel->Button("update-btn","musteribilgiguncelle","login-update","Bilgileri Güncelle");
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