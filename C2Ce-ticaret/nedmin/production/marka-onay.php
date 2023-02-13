<?php 

include 'header.php'; 
require_once 'CLASS/Alt_kategori_detay.php';

$kullanicilarim;
$arraylistkullanici=array();
$kullanicilist=new ArrayList($arraylistkullanici);
$kullanicilist=$admindbservices->kullaniciListele($_GET['kullanici_id']);
$kullanicilist=$kullanicilist->toArray();
foreach ($kullanicilist as $kullanici) 
{
  $kullanicilarim=$kullanici;
}

$markalarim;
$arraylistmarka=array();
$markalist=new ArrayList($arraylistmarka);
$markalist=$admindbservices->markaArrayListele($_GET['marka_id']);
$markalist=$markalist->toArray();
foreach ($markalist as $marka) 
{
  $markalarim=$marka;
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
            <h2>Marka Onay İşlemleri <small>

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
            <form action="../netting/islem.php" method="POST"  data-parsley-validate class="form-horizontal form-label-left">



              <?php 

              $form->TextBox("kullanici_mail",$kullanicilarim->get_kullanici_mail(),"Mail","disabled");
              $form->TextBox("kullanici_ad",$kullanicilarim->get_kullanici_ad(),"Ad","disabled");
              $form->TextBox("kullanici_soyad",$kullanicilarim->get_kullanici_soyad(),"Soyad","disabled");
              $form->TextBox("kullanici_gsm",$kullanicilarim->get_kullanici_gsm(),"GSM","disabled");
              $form->TextArea("kullanici_adres",$kullanicilarim->get_kullanici_adres(),"Adres","disabled");
              $form->TextBox("marka_adi",$markalarim->get_marka_adi(),"Marka");
              $islem->Kategori_listele($markalarim->get_kategori_id(),"Kategoriler");
              $islem->Alt_Kategori_listele($markalarim->get_alt_kategori_id(),$markalarim->get_kategori_id(),"Alt Kategoriler");
              $islem->Alt_Kategori__detay_listele($markalarim->get_alt_kategori_detay_id(),$markalarim->get_alt_kategori_id(),"Alt Kategori Detay"); 

              ?>

              <input type="hidden" name="marka_id" value="<?php echo htmlspecialchars($_GET['marka_id']) ?>"> 


              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">


                  <button type="submit" name="markaonaykayit" class="btn btn-success">Başvuruyu Onayla</button>

                </form>


                <a onclick="return confirm('Marka başvurusunu iptal etmek istiyormusunuz?')" class="btn btn-danger" href="../netting/islem.php?markaonay=red&kullanici_id=<?php echo $kullanicilarim->get_kullanici_id(); ?>">Başvuruyu İptal Et</a>

              </div>
            </div>





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