
<?php 

require_once 'header.php'; 

islemanakontrol();
$urunlerim=$dbservice->stokislemurungetir();

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

                            $formpanel->TextBox("urun_stok",null,"Stok",true,null,$urunlerim->get_urun_stok());

                            ?>


                            <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> 


                            <div class="form-group">

                                <div align="right" class="col-sm-12">
                                 <button class="btn btn-success btn" name="stokekle" id="login-update">Stok Ekle</button>
                                 <button class="btn btn-warning btn" name="stokdus" id="login-update">Stok Düş</button>

                             </div>

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
