<?php 

include 'header.php'; 
$kategorim;
$alt_kategori;
$arraylistkategori=array();
$kategorilist=new ArrayList($arraylistkategori);
$kategorilist=$admindbservices->kategoriListele($_GET['kategori_id']);
$kategorilist=$kategorilist->toArray();
foreach ($kategorilist as $kategori) 
{
  $kategorim=$kategori;
}
$arraylistaltkategori=array();
$altkategorilist=new ArrayList($arraylistaltkategori);
$altkategorilist=$admindbservices->altkategoriSiraliListele($_GET['kategori_id']);
$altkategorilist=$altkategorilist->toArray();
foreach ($altkategorilist as $altkategori) 
{
 $alt_kategori=$altkategori;
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
            <h2>Kategori Düzenleme <small>,

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

              <?php

              $form->TextBox("kategori_ad",$kategorim->get_kategori_ad(),"Kategori Ad");
              $form->TextBox("kategori_oran",$kategorim->get_kategori_oran(),"Kategori Komisyon");
              $form->TextBox("kategori_sira",$kategorim->get_kategori_sira(),"Kategori Sıra");
              $onecikar=array("Evet","Hayır");
              $value=array("1","0");
              $form->ComboBoxValue($onecikar,"kategori_onecikar",$value,$kategorim->get_kategori_onecikar(),"Kategori Öne Çıkar");
              $form->ComboBoxDurum("kategori_durum",$kategorim->get_kategori_durum(),"Kategori Durum");


              ?>

              <input type="hidden" name="kategori_id" value="<?php echo $kategorim->get_kategori_id() ?>"> 
              <input type="hidden" name="alt" value="<?php echo $alt_kategori->get_alt_kategori_id(); ?>"> 


              <div class="ln_solid"></div>

              <?php $form->Button("kategoriduzenle","Güncelle"); ?>

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
