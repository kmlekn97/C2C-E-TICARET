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
            <h2>Cari İşlem <small>,

              <?php $form->Durum_cek(); ?>


            </small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php 

              $islemler=array("Gelir","Gider");

              $form->ComboBox($islemler,"İşlem Tipi Seçiniz...","İşlem Tipi","islem_tip","select1"); 
              $form->TextBox("islem_ucret",null,"İşlem Miktar",null,"İşlem Miktarı giriniz");
              $form->TextArea("islem_aciklama",null,"İşlem Açıklama",null,"İşlem Açıklama giriniz");

              ?>


              <input type="hidden" name="hesap_id" value="<?php echo htmlspecialchars($_GET['hesap_id']); ?>">

              <div class="ln_solid"></div>
              <?php $form->Button("cariekle","Kaydet"); ?>

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
