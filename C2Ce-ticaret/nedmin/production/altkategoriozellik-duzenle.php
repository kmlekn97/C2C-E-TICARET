<?php 

include 'header.php'; 
require_once 'CLASS/Alt_kategori_ozellik.php';

$ozellikcek=$admindbservices->urunOzellikGetir("urun_ozellikleri_id",$_GET['urun_ozellikleri_id']);

$urunozellik=$cons->Alt_kategori_ozellik_ekle($ozellikcek);


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Özellik Düzenleme <small>,

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

            <?php $form->TextBox("ozellik_adi",$urunozellik->get_ozellik_adi(),"Özellik Ad") ?>

            <?php $form->ComboBoxDurum("ozellik_durum",$urunozellik->get_ozellik_durum(),"Özellik Durum") ?>

            <input type="hidden" name="alt_kategori_detay_id" value="<?php echo $urunozellik->get_alt_kategori_detay_id(); ?>">  

            <input type="hidden" name="urun_ozellikleri_id" value="<?php echo htmlspecialchars($_GET['urun_ozellikleri_id']) ?>"> 


            <div class="ln_solid"></div>

            <?php $form->Button("ozellikduzenle","Güncelle"); ?>

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
