<?php 

include 'header.php'; 

$altkategori=$admindbservices->altKategoriListele($_GET['alt_kategori_id']);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Alt Kategori Düzenleme <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

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


              <?php $form->TextBox("alt_kategori_ad",$altkategori->get_alt_kategori_ad(),"Alt Kategori Ad"); ?>

              <?php $form->TextBox("alt_kategori_sira",$altkategori->get_alt_kategori_sira(),"Alt Kategori Sıra"); ?>


              <?php $form->ComboBoxDurum("alt_kategori_durum",$altkategori->get_alt_kategori_durum(),"Kategori Durum"); ?>
              
              <input type="hidden" name="kategori_id" value="<?php echo $altkategori->get_kategori_id() ?>"> 

              <input type="hidden" name="alt_kategori_id" value="<?php echo $altkategori->get_alt_kategori_id() ?>"> 

              <div class="ln_solid"></div>

              <?php $form->Button("altkategoriduzenle","Güncelle"); ?>
              
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
