<?php 

include 'header.php'; 
$Urunlerim;
$arraylisturun=array();
$urunlist=new ArrayList($arraylisturun);
$urunlist=$admindbservices->UrunListele($_GET['urun_id']);
$urunlist=$urunlist->toArray();
foreach ($urunlist as $Urun) 
{
  $Urunlerim=$Urun;
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
            <h2>Ürün Düzenleme <small>

              <?php $form->Durum_cek(); ?>


            </small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Resim <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <img width="200" src="../../<?php echo $Urunlerim->get_urunfoto_resimyol(); ?>">
                </div>
              </div>

              <?php

              $form->FileChooser("urunfoto_resimyol",null,"Kapak Fotoğrafı");
              $form->TextBox("barkod_no",$Urunlerim->get_barkod_no(),"Barkod",true);
              $form->TextBox("urun_kdv",$Urunlerim->get_urun_kdv(),"KDV Oranı");
              $islem->Kategori_listele($Urunlerim->get_kategori_id(),"Kategori Seç");
              $islem->Alt_Kategori_listele($Urunlerim->get_alt_kategori_id(),$Urunlerim->get_kategori_id(),"Alt Kategori Seç");
              $islem->Alt_Kategori__detay_listele($Urunlerim->get_alt_kategori_detay_id(),$Urunlerim->get_alt_kategori_id(),"Alt Kategori Detay Seç");
              $islem->Beden_listele("beden_id","beden",null,$Urunlerim->get_beden_id());
              $islem->Marka_listele($Urunlerim->get_kategori_id(),$Urunlerim->get_marka_id());
              $islem->Renkleri_listele("renk","renk_id",null,$Urunlerim->get_renk_id());
              $form->TextBox("urun_ad",$Urunlerim->get_urun_ad(),"Ürün Ad");
              $form->TextArea("urun_detay",$Urunlerim->get_urun_detay(),"Ürün Detay",null,null,"ckeditor");
              $form->TextBox("urun_fiyat",$Urunlerim->get_urun_fiyat(),"Ürün Fiyat",null,"Ürün Fiyat giriniz");
              $form->TextBox("urun_stok",$Urunlerim->get_urun_stok(),"Ürün stok",null,"Ürün stok giriniz");
              $form->ComboBoxDurum("urun_onecikar",$Urunlerim->get_urun_onecikar(),"Ürün Öne Çıkar");
              $form->ComboBoxDurum("urun_durum",$Urunlerim->get_urun_durum(),"Ürün Durum");

              ?>



              <input type="hidden" name="urun_id" value="<?php echo $Urunlerim->get_urun_id(); ?>"> 
              <input type="hidden" value="<?php echo $Urunlerim->get_urunfoto_resimyol(); ?>" name="eski_yol">


              <div class="ln_solid"></div>

              <?php $form->Button("urunduzenle","Güncelle"); ?>

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
<script type="text/javascript">

  $(document).ready(function(){
    var adet=0;
    $("#select3").change(function(){

      var tip=$("#select1").val();
      var tip_alt=$("#select2").val();

      
      if (tip=="4" || tip=="15") {

       if(tip_alt=="30" || tip_alt=="62")
       {
        $("#beden").hide();
        $("#icerik").hide();
      }
      else
      {
        $("#beden").show();
        $("#icerik").show();
      }
      



    }
    else{
      $("#beden").hide();
      $("#icerik").hide();
    } 

  }).change();


  });

</script>