
<?php 

require_once 'header.php'; 

islemanakontrol();

$mesajcek=$dbservice->mesajdetayListesi();
$mesajlarim=$cons->Mesaj_ekle($mesajcek);
$kullanicilarim=$cons->Kullanici_ekle($mesajcek);

if ($mesajlarim->get_mesaj_okunma()==0) {
  $dbservice->mesajdurumdegistir();
}

?>

<!-- Header Area End Here -->

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">



    <div class="row settings-wrapper">


      <?php require_once 'hesap-sidebar.php' ?>


      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12"> 

       <?php 

       $value=array("hata","ok");
       $key=array("Hata!","Bilgi!");
       $text=array("İşlem Başarısız"," Mesajınız Başarıyla Gönderildi");
       $button_types=array("danger","success");
       $formpanel->Durum_liste($value,$text,$key,$button_types);

       ?>

       <form action="nedmin/netting/kullanici.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">


        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Mesaj Gönderme İşlemleri</h2>
            <div class="personal-info inner-page-padding"> 

             <div class="form-group">
              <label class="col-sm-3 control-label">Mesaj Konu</label>
              <div class="col-sm-9">
                <p><?php echo $mesajlarim->get_mesaj_konu(); ?></p>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Mesaj Detayı</label>
              <div class="col-sm-9">
               <p><?php echo html_entity_decode($mesajlarim->get_mesaj_detay()); ?></p>
             </div>
           </div>

           <?php 

           if ($_GET['gidenmesaj']!="ok") { 

            $formpanel->TextBox("kullanici",$kullanicilarim->get_kullanici_ad()." ".$kullanicilarim->get_kullanici_soyad(),"Cevap Verilen Kullanıcı",true,"disabled");
            $formpanel->TextBox("mesaj_konu",null,"Konu",true,null,"Mesaj Konu");
            $formpanel->TextArea("mesaj_detay",null,"Mesajınız",null,"Mesaj Girin...","ckeditor");


            ?>

            <input type="hidden" name="kullanici_gel" value="<?php echo htmlspecialchars($_GET['kullanici_gon']) ?>">

            <?php $formpanel->Button("update-btn","mesajcevapver","login-update","Mesaj Gönder"); ?>

          <?php } ?>    

        </div> 
      </div> 

    </div> 

  </form> 
</div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer.php'; ?>

<script type="text/javascript">

  $(document).ready(function(){


    $("#kullanici_tip").change(function(){


      var tip=$("#kullanici_tip").val();

      if (tip=="PERSONAL") {


        $("#kurumsal").hide();
        $("#tc").show();



      } else if (tip=="PRIVATE_COMPANY") {

        $("#kurumsal").show();
        $("#tc").hide();

      }


    }).change();



  });

</script>