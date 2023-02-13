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
            <h2>Renk Düzenleme <small>

              <?php $form->Durum_cek(); ?>


            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />



            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php

              $form->TextBox("renk_adi",null,"Renk Ad","Renk adını giriniz");
              $form->TextBox("renk_kodu",null,"Renk Kodu","Renk Kodu giriniz");

              ?>

              <div class="ln_solid"></div>

              <?php $form->Button("renkekle","Kaydet"); ?> 

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


