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
            <h2>Api Ayarlar <small>

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

             <?php $form->TextBox("ayar_analystic",$ayarlarim->get_ayar_analystic(),"Analystic Kodu") ?>

             <?php $form->TextBox("ayar_maps",$ayarlarim->get_ayar_maps(),"Maps Api") ?>

             <?php $form->TextBox("ayar_zopim",$ayarlarim->get_ayar_zopim(),"Zopim Api") ?>


             <div class="ln_solid"></div>

             <?php $form->Button("apiayarkaydet","Güncelle"); ?>

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
