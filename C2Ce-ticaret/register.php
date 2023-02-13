<?php require_once 'header.php' ?>
<br>
<br>
<br>
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <p>Premium WordPress Themes, Web Templates and Many More ...</p>
            <div class="banner-search-area input-group">
                <input class="form-control" placeholder="Search Your Keywords . . ." type="text">
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>  
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here --> 
<!-- Inner Page Banner Area Start Here -->



<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">

        <h2 class="title-section">Üye Kayıt İşlemleri</h2>
        <div class="registration-details-area inner-page-padding">

          <?php 

          $value=array("farklisifre","eksiksifre","mukerrerkayit","basarisiz");
          $key=array("Hata!","Hata!","Hata!","Hata!");
          $text=array("Girdiğiniz şifreler eşleşmiyor.","Şifreniz minimum 6 karakter uzunluğunda olmalıdır.","Bu kullanıcı daha önce kayıt edilmiş.","Kayıt Yapılamadı Sistem Yöneticisine Danışınız.");
          $button_types=array("danger","danger","danger","danger");
          $formpanel->Durum_liste($value,$text,$key,$button_types);

          ?> 

          <form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">

             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                          
                    <?php $formpanel->MultiText("email","kullanici_mail","Mail Adresiniz",null,"Mail Adresinizi Giriniz (Kullanıcı Adınız Olacak!)"); ?>     

                </div>

            </div>


            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <?php $formpanel->MultiText("text","kullanici_ad","Adınız",null,"Adınızı Giriniz..."); ?>                                          
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">   

                    <?php $formpanel->MultiText("text","kullanici_soyad","Soyadınız",null,"Soyadınızı Giriniz..."); ?>  

                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php 

                    $formpanel->MultiText("password","kullanici_passwordone","Şifreniz",null,"Şifrenizi Giriniz..");
                    
                    ?> 
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php 

                    $formpanel->MultiText("password","kullanici_passwordtwo","Şifreniz Tekrar",null,"Şifrenizi Tekrar Giriniz...");
                    
                    ?> 
                </div>

                
            </div>



            <div class="row">


             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                           
                <div class="pLace-order">
                    <button class="update-btn disabled" type="submit" name="musterikaydet" >Gönder</button>
                </div>
            </div>
        </div> 
    </form>                      
</div> 
</div>
</div>
<!-- Registration Page Area End Here -->
<?php require_once 'footer.php' ?>