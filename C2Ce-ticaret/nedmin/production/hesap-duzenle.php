<?php 

include 'header.php'; 
require_once 'CLASS/Hesap.php';

$hesaplarim=$admindbservices->Hesap($_GET['hesap_id']);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hesap Düzenleme <small>,

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <?php

            $form->TextBox("hesap_adi",$hesaplarim->get_hesap_adi(),"Hesap Ad");
            $form->TextBox("hesap_iban",$hesaplarim->get_hesap_iban(),"Hesap IBAN");

            ?>


            <input type="hidden" name="hesap_id" value="<?php echo $hesaplarim->get_hesap_id(); ?>"> 


            <div class="ln_solid"></div>

            <?php $form->Button("hesapduzenle","Güncelle"); ?>

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
