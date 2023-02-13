<?php 

include 'header.php'; 

$alt_kategori_detay="";
$kategorialtcek=$admindbservices->altkategoricek($_GET['alt_kategori_id']);
$arraylistaltkategoridetay=array();
$altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
$altkategoridetaylist=$admindbservices->altkategoridetaylarimiListele($_GET['alt_kategori_detay_id'],$kategorialtcek);
$altkategoridetaylist=$altkategoridetaylist->toArray();
foreach ($altkategoridetaylist as $altkategoridetay) 
{
  $alt_kategori_detay=$altkategoridetay;
}
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Alt Kategori Detay Düzenleme <small>,

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

            <?php $form->TextBox("alt_kategori_detay_ad",$alt_kategori_detay->get_alt_kategori_detay_ad(),"Alt Kategori Detay Ad"); ?>

            <?php $form->TextBox("alt_kategori_detay_sira",$alt_kategori_detay->get_alt_kategori_detay_sira(),"Alt Kategori Detay Sıra"); ?>

            <?php $form->ComboBoxDurum("alt_kategori_detay_durum",$alt_kategori_detay->get_alt_kategori_detay_durum(),"Kategori Durum"); ?>


            <input type="hidden" name="alt_kategori_id" value="<?php echo $alt_kategori_detay->get_alt_kategori_id(); ?>">

            <input type="hidden" name="alt_kategori_detay_id" value="<?php echo $alt_kategori_detay->get_alt_kategori_detay_id(); ?>">  


            <div class="ln_solid"></div>

            <?php $form->Button("altkategoridetayduzenle","Güncelle"); ?>

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
