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
            <h2>Çalışan Ekle <small>,

             <?php $form->Durum_cek(); ?>


           </small></h2>
           
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

            <?php 

            $form->TextBox("calisan_maas",null,"Maaş",0,"Maaş Miktarı giriniz");
            $form->TextBox("calisan_departman",null,"Departman",1,"Departman giriniz");

            ?> 

            <input type="hidden" name="kullanici_id" value="<?php echo htmlspecialchars($_GET['kullanici_id']) ?>"> 

            <div class="ln_solid"></div>

            <?php $form->Button("calisanekle","Kaydet"); ?>

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

