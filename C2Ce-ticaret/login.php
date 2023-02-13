<?php require_once 'header.php' ?>
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <br>
        <br>
        <br>
        <?php

        if (isset($_COOKIE['userLogin'])) 
        {
          $login=json_decode($_COOKIE['userLogin']);
          $gecici=$login->kullanici_password;
          $pass=openssl_decrypt($gecici, "AES-128-ECB", "admins_coz");
          if (isset($_COOKIE['oturumdurum']))
              Header("Location:index.php");
      }
      ?>

      <h2 class="title-section">Üye Giriş İşlemleri</h2>
      <div class="registration-details-area inner-page-padding">

        <?php 

        $value=array("hata","exit","kayitok","captchahata","mailno");
        $key=array("Hata!","Bilgi!","Bilgi!","Hata!","Hata!");
        $text=array("Hatalı Giriş","Başarıyla Çıkış Yapıldı","Kaydınız başarılı giriş yapabilirsiniz.","Güvenlik Kodu Hatalı","Mail sunucumuzda problem var lütfen daha sonra tekrar deneyiniz...");
        $button_types=array("danger","success","success","danger","danger");
        $formpanel->Durum_liste($value,$text,$key,$button_types);

        ?>

        <form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                    <div class="form-group">
                        <label class="control-label" for="first-name">Mail Adresiniz *</label>
                        <input type="text" id="first-name" required="" 

                        <?php
                        if (isset($_COOKIE['userLogin'])) {
                           echo 'value="'.$login->kullanici_mail.'"';
                       } else {

                        echo 'placeholder="Mail Adresinizi Giriniz.."';
                    }
                    ?>


                    name="kullanici_mail" class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                <div class="form-group">
                    <label class="control-label" for="last-name">Şifreniz Tekrar *</label>
                    <input type="password" id="last-name" required="" 

                    <?php
                    if (isset($_COOKIE['userLogin'])) {
                        echo 'value="'.$pass.'"';
                    } else {

                        echo 'placeholder="Şifrenizi Tekrar Giriniz..."';
                    }
                    ?>


                    name="kullanici_password" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div align="right" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                <div class="form-group">
                    <label class="control-label" for="first-name">Güvenlik Kodu *</label>

                    <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                    <a class="btn btn-danger btn-xs" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Değiştir ]</a>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                          
                <div class="form-group">
                    <label class="control-label" for="last-name">Güvenlik Kodunu Giriniz *</label>
                    <input type="text" id="last-name" required="" placeholder="Güvenlik Kodunu Giriniz" name="captcha_code" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- CREAT AN ACCOUNT? -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                           
                <div class="form-group">
                    <?php 
                    if (isset($_COOKIE['userLogin'])) {
                        ?>

                        <span class="checkbox"><input type="checkbox" name="remember_me" checked>Beni Hatırla</span>  

                    <?php }  else {?>
                        <span class="checkbox"><input type="checkbox" name="remember_me">Beni Hatırla</span>
                    <?php } ?>  
                </div>
            </div>                                      
        </div>





        <div class="row">


         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                           
            <div class="pLace-order">
                <button class="update-btn disabled" type="submit" name="musterigiris" >Gönder</button>
                <button style="background-color: red" class="update-btn disabled" data-toggle="modal" data-target="#sifremiunuttum" type="submit" name="musterigiris" >Şifremi Unuttum</button>
                <br>
                <br>
                <a href="misafir">Üye Olmadan Devam Et</a>
            </div>
        </div>
    </div> 
</form>                      
</div> 
</div>
</div>

<!-- Modal Başlangıç -->


<div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>-->
  </div>
  <div class="modal-body">
    <form action="mailphp/sifremi-unuttum.php" method="POST">
        <div class="form-group">
           <p><b>Uyarı:</b> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
       </div>
       <div class="form-group">
        <label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
        <input type="email" class="form-control" name="kullanici_mail" id="recipient-name">
    </div>

    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
    <button type="submit" name="sifremiunuttum" class="btn btn-primary">Şifre Talep Et</button>
</form>
</div>
</div>
</div>
</div>
<!-- Modal Bitiş -->
<!-- Registration Page Area End Here -->
<?php require_once 'footer.php' ?>