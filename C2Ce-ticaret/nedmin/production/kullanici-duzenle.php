<?php 

include 'header.php'; 
$kullanicilarim;
$arraylistkullanici=array();
$kullanicilist=new ArrayList($arraylistkullanici);
$kullanicilist=$admindbservices->kullaniciListele($_GET['kullanici_id']);
$kullanicilist=$kullanicilist->toArray();
foreach ($kullanicilist as $kullanici) 
{
  $kullanicilarim=$kullanici;
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
            <h2>Kullanıcı Düzenleme <small>

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

            $zaman=explode(" ",$kullanicilarim->get_kullanici_zaman());
            $form->TextBox("kullanici_mail",$kullanicilarim->get_kullanici_mail(),"Mail","disabled");
            $form->TextBox("zaman",$zaman[0],"Kayıt Tarihi","disabled");
            $form->TextBox("saat",$zaman[1],"Kayıt Saati","disabled");
            $form->TextBox("kullanici_tc",$kullanicilarim->get_kullanici_tc(),"T.C.");
            $form->TextBox("kullanici_ad",$kullanicilarim->get_kullanici_ad(),"Ad");
            $form->TextBox("kullanici_soyad",$kullanicilarim->get_kullanici_soyad(),"Soyad");
            $form->TextBox("kullanici_gsm",$kullanicilarim->get_kullanici_gsm(),"Gsm");
            $form->TextBox("kullanici_adres",$kullanicilarim->get_kullanici_adres(),"Adres");
            $form->TextBox("kullanici_ilce",$kullanicilarim->get_kullanici_ilce(),"İlçe");
            $form->TextBox("kullanici_il",$kullanicilarim->get_kullanici_il(),"İl");
            $form->TextBox("kullanici_unvan",$kullanicilarim->get_kullanici_unvan(),"Kullanıcı Unvan");
            $form->Kullanicitypeselected($kullanicilarim->get_kullanici_tip(),$kullanicilarim->get_kullanici_magaza(),"kullanici_tip","Kullanıcı Tipi");
            $form->ComboBoxDurum("kullanici_durum",$kullanicilarim->get_kullanici_durum(),"Kullanıcı Durum");

            ?>

            <input type="hidden" name="kullanici_id" value="<?php echo htmlspecialchars($_GET['kullanici_id']); ?>"> 


            <div class="ln_solid"></div>

            <?php $form->Button("kullaniciduzenle","Güncelle"); ?>

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
