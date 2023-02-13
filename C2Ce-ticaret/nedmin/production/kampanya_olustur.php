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
            <h2>Kampanya Oluşturma<small>,

             <?php $form->Durum_cek(); ?>


           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

          <?php

          $form->FileChooser("Kampanya Logosu",null,"Kampanya Logo");
          $form->TextBox("kampanya_adi",null,"Kampanya Adı",null,"Kampanya Adı Giriniz...");
          $form->TextArea("kampanya_aciklama",null,"Kampanya Detay",null,"Kampanya Detay Giriniz...","ckeditor");
          $form->TextBox("kampanya_oran",null,"İndirim Oranı","autofocus","İndirim Oranı Girin...");

          ?>
          <script src="js/CK.js"></script>


          <?php 


          $islem->Kategori_listele(null,"Kategori"); 

          $form->DateTime("kampanyabaslangic_tarihi",null,"Başlangıç Tarihi","Başlangıç Tarihi giriniz");
          $form->DateTime("kampanyabitis_tarihi",null,"Bitiş Tarihi","Bitiş Tarihi giriniz");
          ?>

          <div class="ln_solid"></div>

          <?php $form->Button("kampanyaolustur","OLUŞTUR"); ?>

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
