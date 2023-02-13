<?php 

include 'header.php'; 


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Ekle <small>

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

            <?php

            $form->TextBox("kullanici_ad",null,"Adı",null,"Ad giriniz");
            $form->TextBox("kullanici_soyad",null,"Soyadı",null,"Soyad giriniz");
            $form->TextBox("kullanici_mail",null,"Mail Adresi",null,"Mail Adresi giriniz");
            $form->TextBox("kullanici_tc",null,"T.C.",null,"T.C. giriniz");
            $form->TextBox("kullanici_gsm",null,"Tel No",null,"Tel No giriniz");
            $form->TextBox("kullanici_unvan",null,"Kullanıcı Unvan",null,"Kullanıcı Unvan giriniz");
            $kullanici_tipleri=array("Alıcı","Bireysel Satıcı","Satıcı(L.T.D.)","Satıcı(A.Ş.)","Şirket Çalışanı","Teknik");
            $form->ComboBox($kullanici_tipleri,"Bir Tip Seçiniz...","Kullanıcı Tipi","kullanici_tip","kullanici_tip");
            $form->PasswordTextBox("kullanici_passwordone","Şifre",null,"Şifre Girin...");
            $form->PasswordTextBox("kullanici_passwordtwo","Şifre Tekrar",null,"Şifre Tekrar Girin...");  

            ?>

          <div class="ln_solid"></div>

          <?php $form->Button("kullaniciadminekaydet","Kaydet"); ?>

        </form>



      </div>
    </div>
  </div>
</div>



<hr>
<hr>
<hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>


<script type="text/javascript">

 $('#kullanici_tc').change(function(){

  $('#kullanici_passwordone').val( $('#kullanici_tc').val());
  $('#kullanici_passwordtwo').val( $('#kullanici_tc').val());

});
 
</script>
