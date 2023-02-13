<?php 

include 'header.php'; 
require_once 'CLASS/Slider.php';


$slidersor=$dbsql->wread("slider","slider_id",htmlspecialchars($_GET['slider_id']));
$slidercek=$slidersor->fetch(PDO::FETCH_ASSOC);

$slider=$cons->Slider_ekle($slidercek);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Slider Düzenleme <small>

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <img width="300" src="../../<?php echo $slider->get_slider_resimyol(); ?>">
              </div>
            </div>

            <?php

            $form->TextBox("slider_resimyol",null,"Resim Seç");  
            $form->TextBox("slider_ad",$slider->get_slider_ad(),"Slider Ad");    
            $form->TextBox("slider_link",$slider->get_slider_link(),"Slider Url");
            $form->TextBox("slider_sira",$slider->get_slider_sira(),"Slider Sıra");
            $form->ComboBoxDurum("slider_durum",$slider->get_slider_durum(),"Slider Durum");        

            ?>

          <input type="hidden" name="slider_id" value="<?php echo $slider->get_slider_id(); ?>">
          <input type="hidden" name="eski_yol" value="<?php echo $slider->get_slider_resimyol(); ?>">


          <div class="ln_solid"></div>

          <?php

          $form->Button("sliderduzenle","Güncelle");


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
