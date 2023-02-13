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
            <h2>Marka Ekle <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />



            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php

              $form->TextBox("marka_adi",null,"Marka Ad",null,"Marka adını giriniz");
              $islem->Kategori_listele(null,"Kategori Seç");
              $islem->Alt_Kategori_listele(null,null,"Alt Kategori Seç");
              $islem->Alt_Kategori__detay_listele(null,null,"Alt Kategori Detay");

              ?>


          <input type="hidden" name="kullanici_id" value="<?php echo $kullanicilarim->get_kullanici_id(); ?>"> 





          <div class="ln_solid"></div>

          <?php

          $form->Button("markaekle","Kaydet");

          ?>

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


