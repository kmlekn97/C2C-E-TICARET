<?php require_once 'header.php'; ?>


<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <br>
        <br>
        <br>


        <h2 class="title-section">Üyeliksiz Sipariş</h2>
        <div class="registration-details-area inner-page-padding">

            <form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">
                <div class="row">
                 <?php

                 $kullanici_adi=$formpanel->TextBox("kullanici_ad",null,"Adınız",true,null,"Adınızı Giriniz...");
                 $formpanel->TextBox("kullanici_soyad",null,"Soyadınız",true,null,"Soyadınızı Giriniz...");

                 ?>
             </div>


             <div class="row">

                <?php

                $formpanel->TextBox("kullanici_mail",null,"Mail Adresiniz",true,null,"Mail Adresinizi Giriniz...");
                $formpanel->TextBox("kullanici_gsm",null,"Cep Telefonu",true,null,"Cep Telefonu Giriniz...");
                $formpanel->TextArea("kullanici_adres",null,"Teslimat Adresi",null,"Adres Giriniz...","ckeditor",true);

                ?>

            </div>

            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                           
                <div class="pLace-order">
                    <button class="update-btn disabled" type="submit" name="sepetmisafir" >TAMAMLA</button>
                </div>
            </div>
        </div> 
    </form>                      
</div> 
</div>
</div>

<?php require_once 'footer.php' ?>