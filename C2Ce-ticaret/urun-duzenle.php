<?php 

require_once 'header.php'; 

islemanakontrol();

$urunlerim=$dbservice->urun_duzeleurunListesi();

?>


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

       if(tip_alt=="30" || tip_alt=="62")
       {
        $("#beden").hide();
        $("#icerik").hide();
        $("#genel").hide();
      }
      else
      {
        $("#beden").show();
        $("#icerik").show();
        $("#genel").show();
      }


    }
    else{
      $("#beden").hide();
      $("#icerik").hide();
      $("#genel").hide();
    } 


  }).change();



  });

</script>

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
            <h2 class="title-section">Ürün Düzenle</h2>
            <div class="personal-info inner-page-padding"> 


              <div class="form-group">
                <label class="col-sm-3 control-label">Mevcut Fotoğraf</label>
                <div class="col-sm-9">
                 <img width="200" src="<?php echo $urunlerim->get_urunfoto_resimyol(); ?>">
               </div>
             </div>

             <?php 

             $formpanel->FileChooser("urunfoto_resimyol","Fotoğraf",true);
             $formpanel->TextBox("barkod_no",$urunlerim->get_barkod_no(),"Barkod",true);
             $formpanel->TextBox("urun_kdv",$urunlerim->get_urun_kdv(),"KDV Oranı",true);
             $formpanel->Kategori_listele($urunlerim->get_kategori_id());
             $formpanel->Alt_Kategori_Listele("alt_kategori_id","Alt Kategori",$urunlerim->get_alt_kategori_id(),$urunlerim->get_kategori_id());
             $formpanel->Alt_Kategori_Detay_Listele("alt_kategori_detay_id","Alt Kategori İçerik",$urunlerim->get_alt_kategori_detay_id(),$urunlerim->get_alt_kategori_id());
             $formpanel->Beden_listele($urunlerim->get_beden_id(),"genel");
             $formpanel->Marka_Listele("marka_id","marka","select2","Marka",$urunlerim->get_kategori_id(),$urunlerim->get_marka_id());
             $formpanel->Renkleri_listele($urunlerim->get_renk_id());
             $formpanel->TextBox("urun_ad",$urunlerim->get_urun_ad(),"Adı",true);
             $formpanel->TextArea("urun_detay",$urunlerim->get_urun_detay(),"Açıklama",null,null,"ckeditor",true);
             $formpanel->TextBox("urun_fiyat",$urunlerim->get_urun_fiyat(),"Fiyat",true);
             $formpanel->TextBox("urun_stok",$urunlerim->get_urun_stok(),"Stok",true);

             ?>

            <input type="hidden" value="<?php echo $urunlerim->get_urun_id() ?>" name="urun_id">
            <input type="hidden" value="<?php echo $urunlerim->get_urunfoto_resimyol() ?>" name="eski_yol">


            <?php $formpanel->Button("update-btn","magazaurunduzenle","login-update","Ürün Düzenle"); ?>

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