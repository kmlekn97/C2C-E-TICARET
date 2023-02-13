<?php 

include 'header.php'; 

$mesajlar=$admindbservices->MesajDetaygetir();

$kullanicilarim=$cons->Kullanici_ekle($kullanicicek);


if ($mesajlar->get_mesaj_okunma()==0) {
  $admindbservices->MesajDurumDegistir($_GET['mesaj_id'],1);
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
            <h2>Mesaj Detay <small>

              <?php $form->Durum_cek(); ?>

            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

              <div class="form-group">
                <label class="col-sm-3 control-label">Mesaj Konu</label>
                <div class="col-sm-9"style="margin-top: 8px;">
                  <p><?php echo $mesajlar->get_mesaj_konu(); ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Mesaj Detayı</label>
                <div class="col-sm-9">
                  <p><?php echo html_entity_decode($mesajlar->get_mesaj_detay()) ?></p>
                </div>
              </div>

              <?php 

              if (htmlspecialchars($_GET['gidenmesaj'])!="ok") { 


                $form->TextBox("urun_ad", $kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(),"Cevap Verilen Kullanıcı","disabled");
                $form->TextBox("mesaj_konu",null,"Mesaj Konu");
                $form->TextArea("mesaj_detay",null,"Mesaj Detay",null,"Mesaj Detay","ckeditor");


                ?>
                <script src="js/CK.js"></script>

                <input type="hidden" name="kullanici_gel" value="<?php echo htmlspecialchars($_GET['kullanici_gon']) ?>">



                <div class="ln_solid"></div>

                <?php $form->Button("mesajcevapver","GÖNDER"); ?>

              <?php } ?>    

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

 $('#kullanici_tc').change(function(){

  $('#kullanici_passwordone').val( $('#kullanici_tc').val());
  $('#kullanici_passwordtwo').val( $('#kullanici_tc').val());

});

</script>
