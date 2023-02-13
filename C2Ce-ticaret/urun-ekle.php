<?php 

require_once 'header.php'; 

islemanakontrol();

?>

<script src="js/jquery-footer.js"></script>
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
        $text=array("İşlem Başarısız","Kayıt Başarılı");
        $button_types=array("danger","success");
        $formpanel->Durum_liste($value,$text,$key,$button_types);

        ?>

      <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Ürün Ekleme</h2>
            <div class="personal-info inner-page-padding"> 

              <?php

              $formpanel->FileChooser("urunfoto_resimyol","Kapak Fotoğrafı",true);
              $formpanel->TextBox("barkod_no",null,"Barkod",true,null,"Barkod No giriniz...");
              $formpanel->TextBox("urun_kdv",null,"KDV Oranı",true,null,"KDV Oranı giriniz...");
              $formpanel->Kategori_listele();
              $formpanel->Alt_Kategori_Listele("alt_kategori_id","Alt Kategori");
              $formpanel->Alt_Kategori_Detay_Listele("alt_kategori_detay_id","Alt Kategori İçerik");
              $formpanel->Marka_Listele("marka_id","marka","select2","Marka");
              $formpanel->Renkleri_listele();
              $formpanel->Beden_listele();
              $formpanel->TextBox("urun_ad",null,"Adı",true,null,"Ürün Adı...");
              $formpanel->TextArea("urun_detay",null,"Açıklama",null,"Ürün Açıklaması...","ckeditor",true);
              $formpanel->TextBox("urun_fiyat",null,"Fiyat",true,null,"Ürün Fiyat...");
              $formpanel->TextBox("urun_stok",null,"Stok",true,null,"Ürün Stok...");
              $formpanel->Button("update-btn","magazaurunekle","login-update","Ürün Ekle");

              ?>      

         </div> 
       </div> 

     </div> 

   </form> 
 </div>  
</div>  
</div>  
</div> 
<!-- Settings Page End Here -->


<?php require_once 'footer_sorgulu.php'; ?>

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



    $("#select2").change(function(){

      var tip=$("#select1").val();
      var tip_alt=$("#select2").val();


      if (tip=="4" || tip=="15") {

       if(tip_alt=="30")
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