
<?php 

require_once 'header.php'; 

islemanakontrol();

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
               $text=array("İşlem Başarısız","Reklam Başvurunuz Alınmıştır...");
               $button_types=array("danger","success");
               $formpanel->Durum_liste($value,$text,$key,$button_types);
               
               ?>



               <form action="nedmin/netting/islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Reklam Verme</h2>
                        <div class="personal-info inner-page-padding">

                            <?php

                            $formpanel->FileChooser("slider_resimyol","Kapak Fotoğrafı");
                            $formpanel->TextBox("slider_link",null,"Link",true,null,"Reklam Linki Girin...");
                            $formpanel->TextBox("slider_sure",null,"Gün Sayısını",true,null,"Gün Sayısını Giriniz Girin...");

                            ?> 



                            <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> 

                            <?php $formpanel->Button("update-btn","slider_create","slider_create","Öde","Bu Resmi Eklemek istiyormusunuz? İşlem geri alınamaz..."); ?>

                         </div>        



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
  $("#slider_sure").keyup(function (){
      var sure=Number($("#slider_sure").val());
      if (this.value.match(/[^0-9]/g)){
        this.value = this.value.replace(/[^0-9]/g,'');
        alert("Lütfen Rakam Giriniz...");
        $('#slider_create').prop('disabled', true);
    }
    else if (sure > 45 || sure < 1){
        alert("1-45 Arası Olmalı...");
        $('#slider_create').prop('disabled', true);
    }
    else
    {
        $('#slider_create').prop('disabled', false);
    }

});
</script>