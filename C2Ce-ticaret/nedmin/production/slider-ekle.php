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
            <h2>Slider Ekleme <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php

              $form->FileChooser("slider_resimyol",null,"Resim Seç");
              $form->TextBox("slider_ad",null,"Slider Ad",null,"Slider adını giriniz");
              $form->TextBox("slider_link",null,"Slider Url",null,"Slider Url giriniz");
              $form->TextBox("slider_sira",null,"Slider Sıra",null,"Slider Sıra giriniz");
              $form->ComboBoxDurum("slider_durum",null,"Slider Durum");

              ?>

            <div class="ln_solid"></div>

            <?php

            $form->Button("sliderkaydet","Kaydet");

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
