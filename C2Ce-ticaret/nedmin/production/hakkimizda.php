<?php 

include 'header.php'; 

$hakkimizda=$admindbservices->Hakkimizda();

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hakkımızda Ayarları <small>

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

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php

              $form->TextBox("hakkimizda_baslik",$hakkimizda->get_hakkimizda_baslik(),"Başlık");
              $form->TextArea("hakkimizda_icerik",html_entity_decode($hakkimizda->get_hakkimizda_icerik()."adda"),"İçerik",null,null,"ckeditor");
              $form->TextBox("hakkimizda_video",$hakkimizda->get_hakkimizda_video(),"Video");
              $form->TextBox("hakkimizda_vizyon",$hakkimizda->get_hakkimizda_vizyon(),"Vizyon");
              $form->TextBox("hakkimizda_misyon",$hakkimizda->get_hakkimizda_misyon(),"Misyon");

              ?>

               <script src="js/CK.js"></script>

            <div class="ln_solid"></div>

            <?php $form->Button("hakkimizdakaydet","Güncelle","primary"); ?>

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
