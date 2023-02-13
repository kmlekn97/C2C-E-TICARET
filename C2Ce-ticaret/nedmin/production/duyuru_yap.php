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
            <h2>DUYURU <small>
             <?php $form->Durum_cek(); ?>
           </small></h2>

           <div class="clearfix">
            <?php $form->Buttonhref("DUYURU !!!","duyuru_yap.php",); ?>

          </div>
        </div>
        <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

            <?php
            $islemler=array("Tüm Satıcılar","Satıcı(A.Ş.)","Satıcı(L.T.D.)","Bireysel Satıcı","Alıcı","Teknik Personel","Şirket Çalışanı");

            $form->ComboBox($islemler,"Gönderilecek Kişiler","GÖNDERİLECEK KİŞİLER","kullanici_tip","kullanici_tip"); 
            $form->TextBox("mesaj_konu",null,"Mesaj Konu",null,"Mesaj Konu");
            $form->TextArea("mesaj_detay",null,"Mesaj Detay",null,"Mesaj Detay","ckeditor");
            ?>

            <script src="js/CK.js"></script>


            <div class="ln_solid"></div>
            <?php $form->Button("duyurugonder","Kaydet"); ?>
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
