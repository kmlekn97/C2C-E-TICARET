<?php 

include 'header.php'; 
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Ekle <small>

             <?php $form->Durum_cek(); ?>

           </small></h2>

           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <br />

          <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
          <form action="../netting/islem.php"method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

            <?php

            $form->FileChooser("urunfoto_resimyol",null,"Kapak Fotoğrafı");
            $form->TextBox("barkod_no",null,"Barkod",null,"Barkod Girin:");
            $form->TextBox("urun_kdv",null,"Kdv Oranı",null,"Kdv Oranı Girin:");
            $islem->Kategori_listele(null,"Kategori Seç");
            $islem->Alt_Kategori_listele(null,null,"Alt Kategori Seç");
            $islem->Alt_Kategori__detay_listele(null,null,"Alt Kategori Detay Seç");
            $islem->Marka_listele1();
            $islem->Renkleri_listele();
            $islem->Beden_listele("beden_id");
            $form->TextBox("urun_ad",null,"Ürün Ad",null,"Ürün adını giriniz");
            $form->TextArea("urun_detay","","Ürün Detay",null,"Ürün Detay giriniz","ckeditor");
            $form->TextBox("urun_fiyat",null,"Ürün Fiyat",null,"Ürün Fiyat giriniz");
            $form->TextBox("urun_stok",null,"Ürün stok",null,"Ürün stok giriniz");

            ?>                  

            <script src="js/CK.js"></script>
            <div class="ln_solid"></div>

            <?php $form->Button("urunekle","Kaydet"); ?>

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