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
            <h2>Genel Ayarlar <small>

              <?php $form->Durum_cek(); ?>


            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Logo<br><span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <?php 
                  if (strlen($ayarlarim->get_ayar_logo())>0) {?>

                    <img width="200"  src="../../<?php echo $ayarlarim->get_ayar_logo(); ?>">

                  <?php } else {?>


                    <img width="200"  src="../../dimg/logo-yok.png">


                  <?php } ?>


                </div>
              </div>

              <?php

              $form->FileChooser("ayar_logo",null,"Resim Seç");

              ?>

              <input type="hidden" name="eski_yol" value="<?php echo $ayarlarim->get_ayar_logo(); ?>">

              <?php $form->Button("logoduzenle","Güncelle","primary");  ?>

            </form>

            <hr>

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php

              $form->TextBox("ayar_title",$ayarlarim->get_ayar_title(),"Site Başlığı");
              $form->TextBox("ayar_description",$ayarlarim->get_ayar_description(),"Site Açıklaması");
              $form->TextBox("ayar_keywords",$ayarlarim->get_ayar_keywords(),"Site Anahtar Kelime");
              $form->TextBox("ayar_author",$ayarlarim->get_ayar_author(),"Site Yazar");

              ?>



              <div class="ln_solid"></div>

              <?php $form->Button("genelayarkaydet","Güncelle"); ?>
    
            </form>

            <hr>

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php $form->ComboBoxDurum("ayar_bakim",$ayarlarim->get_ayar_bakim(),"Site Durum"); ?>

          <div class="ln_solid"></div>
          <?php $form->Button("sitedurumdegistir","Güncelle"); ?>

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
